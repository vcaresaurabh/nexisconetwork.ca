#!/usr/bin/env bash
# ============================================================
# Nexisco Network — Development Startup Script
# Usage: ./start.sh [port]   (default port: 8000)
# ============================================================

set -euo pipefail

PORT="${1:-8000}"
ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PUBLIC_DIR="${ROOT_DIR}/public_html"
PID_FILE="${ROOT_DIR}/.server.pid"
LOG_FILE="${ROOT_DIR}/.server.log"

# ── Colour helpers ──────────────────────────────────────────
GREEN='\033[0;32m'
CYAN='\033[0;36m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
RESET='\033[0m'
BOLD='\033[1m'

print_banner() {
cat << 'EOF'
  ╔══════════════════════════════════════════════════╗
  ║   NEXISCO NETWORK  —  Smart IT. Seamless Support  ║
  ╚══════════════════════════════════════════════════╝
EOF
}

log_info()    { echo -e "  ${CYAN}→${RESET}  $*"; }
log_success() { echo -e "  ${GREEN}✓${RESET}  $*"; }
log_warn()    { echo -e "  ${YELLOW}!${RESET}  $*"; }
log_error()   { echo -e "  ${RED}✗${RESET}  $*" >&2; }

# ── Stop any existing server ────────────────────────────────
stop_server() {
  if [[ -f "$PID_FILE" ]]; then
    local pid
    pid=$(cat "$PID_FILE")
    if kill -0 "$pid" 2>/dev/null; then
      kill "$pid" 2>/dev/null || true
      log_info "Stopped existing server (PID ${pid})"
    fi
    rm -f "$PID_FILE"
  fi

  # Also kill anything on the target port
  local existing_pid
  existing_pid=$(lsof -ti tcp:"$PORT" 2>/dev/null || true)
  if [[ -n "$existing_pid" ]]; then
    kill "$existing_pid" 2>/dev/null || true
    sleep 0.5
  fi
}

# ── Check PHP ───────────────────────────────────────────────
check_php() {
  if ! command -v php &>/dev/null; then
    log_error "PHP is not installed or not in PATH."
    exit 1
  fi
  local php_version
  php_version=$(php -r "echo PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;")
  log_info "PHP ${php_version} found"
}

# ── Check config ────────────────────────────────────────────
check_config() {
  if [[ ! -f "${PUBLIC_DIR}/config/config.php" ]]; then
    log_warn "config.php not found — copying from config.sample.php"
    cp "${PUBLIC_DIR}/config/config.sample.php" "${PUBLIC_DIR}/config/config.php"
    log_success "config.php created (edit it before production use)"
  fi
}

# ── Build CSS if needed ─────────────────────────────────────
build_css() {
  local css_file="${PUBLIC_DIR}/assets/css/app.css"
  local src_file="${ROOT_DIR}/src/input.css"

  if [[ ! -f "$css_file" ]] || [[ "$src_file" -nt "$css_file" ]]; then
    log_info "Building CSS…"
    if npm run build 2>&1 | tail -1; then
      log_success "CSS built successfully"
    else
      log_warn "CSS build failed — site may look unstyled"
    fi
  else
    log_info "CSS is up to date"
  fi
}

# ── Start PHP server ────────────────────────────────────────
start_server() {
  php -S "localhost:${PORT}" \
      -t "$PUBLIC_DIR" \
      > "$LOG_FILE" 2>&1 &
  local pid=$!
  echo $pid > "$PID_FILE"

  # Wait briefly to confirm it started
  sleep 0.8
  if kill -0 "$pid" 2>/dev/null; then
    log_success "PHP dev server running (PID ${pid})"
  else
    log_error "Server failed to start. Check ${LOG_FILE}"
    rm -f "$PID_FILE"
    exit 1
  fi
}

# ── Route smoke test ────────────────────────────────────────
smoke_test() {
  local routes=(
    "/"
    "/services"
    "/about"
    "/contact"
    "/book"
    "/membership"
    "/faq"
    "/partners"
    "/privacy"
    "/terms"
    "/services/virus-malware-removal"
    "/sitemap.xml"
    "/robots.txt"
  )

  echo ""
  echo -e "  ${BOLD}Route smoke test:${RESET}"
  local pass=0 fail=0
  for route in "${routes[@]}"; do
    local status
    status=$(curl -s -o /dev/null -w "%{http_code}" "http://localhost:${PORT}${route}")
    if [[ "$status" == "200" ]]; then
      echo -e "    ${GREEN}${status}${RESET}  ${route}"
      ((pass++))
    else
      echo -e "    ${RED}${status}${RESET}  ${route}"
      ((fail++))
    fi
  done

  echo ""
  if [[ $fail -eq 0 ]]; then
    log_success "All ${pass} routes returned 200"
  else
    log_warn "${pass} passed, ${fail} failed"
  fi
}

# ── Main ────────────────────────────────────────────────────
main() {
  echo ""
  print_banner
  echo ""

  check_php
  check_config
  build_css
  stop_server
  start_server
  smoke_test

  echo ""
  echo -e "  ${BOLD}${GREEN}Server is running!${RESET}"
  echo ""
  echo -e "  ${CYAN}URL:${RESET}    http://localhost:${PORT}"
  echo -e "  ${CYAN}Admin:${RESET}  http://localhost:${PORT}/admin"
  echo -e "  ${CYAN}Logs:${RESET}   tail -f ${LOG_FILE}"
  echo -e "  ${CYAN}Stop:${RESET}   kill \$(cat ${PID_FILE})"
  echo ""
  echo -e "  ${YELLOW}Watching logs (Ctrl+C to exit):${RESET}"
  echo "  ────────────────────────────────────────────"
  tail -f "$LOG_FILE" 2>/dev/null
}

# Handle Ctrl+C gracefully
trap 'echo ""; log_info "Shutting down..."; stop_server; exit 0' INT TERM

main
