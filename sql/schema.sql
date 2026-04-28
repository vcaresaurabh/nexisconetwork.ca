-- Nexisco Network — Database Schema
-- MySQL 8.0+ / MariaDB 10.6+
-- Run: mysql -u root -p nexisco_db < schema.sql

CREATE DATABASE IF NOT EXISTS nexisco_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE nexisco_db;

-- ── Bookings ─────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS bookings (
  id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  booking_ref     VARCHAR(20)  NOT NULL UNIQUE,
  service_slug    VARCHAR(60)  NOT NULL,
  preferred_date  DATE         NOT NULL,
  preferred_time  VARCHAR(10)  NOT NULL,
  name            VARCHAR(120) NOT NULL,
  email           VARCHAR(254) NOT NULL,
  phone           VARCHAR(20)  NOT NULL,
  notes           TEXT,
  newsletter      TINYINT(1)   NOT NULL DEFAULT 0,
  status          ENUM('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  ip_address      VARCHAR(45)  NOT NULL,
  created_at      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_email   (email),
  INDEX idx_status  (status),
  INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Contact Form Submissions ──────────────────────────────────────
CREATE TABLE IF NOT EXISTS contacts (
  id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name            VARCHAR(120) NOT NULL,
  email           VARCHAR(254) NOT NULL,
  phone           VARCHAR(20),
  subject         VARCHAR(200),
  message         TEXT         NOT NULL,
  status          ENUM('new','read','replied','archived') NOT NULL DEFAULT 'new',
  ip_address      VARCHAR(45)  NOT NULL,
  created_at      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_email   (email),
  INDEX idx_status  (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Newsletter Subscribers (CASL compliant) ───────────────────────
CREATE TABLE IF NOT EXISTS newsletter (
  id                INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  email             VARCHAR(254) NOT NULL UNIQUE,
  subscribed        TINYINT(1)   NOT NULL DEFAULT 1,
  casl_consent      TINYINT(1)   NOT NULL DEFAULT 0,
  consent_timestamp DATETIME,           -- CASL requires storing express consent timestamp
  consent_method    VARCHAR(100),        -- 'website_footer', 'booking_form', etc.
  unsubscribed_at   DATETIME,
  ip_address        VARCHAR(45)  NOT NULL,
  created_at        DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at        DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_subscribed (subscribed)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Partner Applications ──────────────────────────────────────────
CREATE TABLE IF NOT EXISTS partners (
  id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  business_name   VARCHAR(200) NOT NULL,
  contact_name    VARCHAR(120) NOT NULL,
  email           VARCHAR(254) NOT NULL,
  phone           VARCHAR(20),
  website         VARCHAR(500),
  partner_type    VARCHAR(100),
  message         TEXT,
  status          ENUM('pending','reviewing','approved','rejected') NOT NULL DEFAULT 'pending',
  ip_address      VARCHAR(45)  NOT NULL,
  created_at      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Admin Users ───────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS admin_users (
  id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username     VARCHAR(60)  NOT NULL UNIQUE,
  password     VARCHAR(255) NOT NULL,  -- bcrypt hash
  last_login   DATETIME,
  login_ip     VARCHAR(45),
  created_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default admin user (password: 'change_me' — UPDATE IMMEDIATELY)
-- Run: php -r "echo password_hash('your_new_password', PASSWORD_DEFAULT);"
INSERT IGNORE INTO admin_users (username, password)
VALUES ('admin', '$2y$12$placeholder_replace_with_real_hash_IMMEDIATELY');
