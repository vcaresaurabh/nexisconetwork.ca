#!/bin/bash
# ============================================================
# 🚀 3D ANIMATED WEBSITE — FULL PROJECT SETUP SCRIPT
# ============================================================
# Run this script inside your git repo root:
#   chmod +x setup.sh && ./setup.sh
#
# This script will:
# 1. Initialize Next.js 15 with TypeScript + Tailwind
# 2. Install the full 3D + animation stack
# 3. Create the project folder structure
# 4. Set up config files (ESLint, TSConfig, Tailwind)
# 5. Create boilerplate components to get started
# 6. Set up Git hooks and conventions
# ============================================================

set -e  # Exit on error

echo ""
echo "╔══════════════════════════════════════════════════════════╗"
echo "║  🚀  3D Animated Website — Project Setup                ║"
echo "║  Stack: Next.js 15 + R3F + GSAP + Tailwind v4           ║"
echo "╚══════════════════════════════════════════════════════════╝"
echo ""

# ──────────────────────────────────────────────
# STEP 1: Initialize Next.js Project
# ──────────────────────────────────────────────
echo "📦 Step 1/6: Initializing Next.js 15 project..."

npx create-next-app@latest . \
  --typescript \
  --tailwind \
  --eslint \
  --app \
  --src-dir \
  --import-alias "@/*" \
  --turbopack \
  --yes

echo "✅ Next.js initialized"

# ──────────────────────────────────────────────
# STEP 2: Install Core Dependencies
# ──────────────────────────────────────────────
echo ""
echo "📦 Step 2/6: Installing 3D + Animation dependencies..."

# 3D Engine
npm install three @react-three/fiber @react-three/drei @react-three/postprocessing

# Animations
npm install gsap @gsap/react
npm install lenis
npm install framer-motion

# Utilities
npm install clsx tailwind-merge

# Dev dependencies
npm install -D @types/three
npm install -D prettier prettier-plugin-tailwindcss

echo "✅ All dependencies installed"

# ──────────────────────────────────────────────
# STEP 3: Create Folder Structure
# ──────────────────────────────────────────────
echo ""
echo "📁 Step 3/6: Creating project folder structure..."

# Components
mkdir -p src/components/canvas
mkdir -p src/components/sections
mkdir -p src/components/ui
mkdir -p src/components/layout
mkdir -p src/components/providers

# Other src directories
mkdir -p src/hooks
mkdir -p src/lib
mkdir -p src/shaders
mkdir -p src/types

# Public assets
mkdir -p public/models
mkdir -p public/textures
mkdir -p public/images
mkdir -p public/fonts

# Docs
mkdir -p docs

echo "✅ Folder structure created"

# ──────────────────────────────────────────────
# STEP 4: Create Config Files
# ──────────────────────────────────────────────
echo ""
echo "⚙️  Step 4/6: Setting up config files..."

# Prettier config
cat > .prettierrc.json << 'PRETTIER'
{
  "semi": true,
  "singleQuote": true,
  "tabWidth": 2,
  "trailingComma": "es5",
  "printWidth": 100,
  "bracketSpacing": true,
  "jsxSingleQuote": false,
  "arrowParens": "always",
  "plugins": ["prettier-plugin-tailwindcss"]
}
PRETTIER

# Prettier ignore
cat > .prettierignore << 'IGNORE'
node_modules
.next
out
public
*.glb
*.gltf
*.hdr
IGNORE

# VS Code settings for the project
mkdir -p .vscode

cat > .vscode/settings.json << 'VSCODE'
{
  "editor.formatOnSave": true,
  "editor.defaultFormatter": "esbenp.prettier-vscode",
  "editor.codeActionsOnSave": {
    "source.fixAll.eslint": "explicit",
    "source.organizeImports": "explicit"
  },
  "typescript.tsdk": "node_modules/typescript/lib",
  "typescript.enablePromptUseWorkspaceTsdk": true,
  "tailwindCSS.experimental.classRegex": [
    ["clsx\\(([^)]*)\\)", "(?:'|\"|`)([^']*)(?:'|\"|`)"],
    ["cn\\(([^)]*)\\)", "(?:'|\"|`)([^']*)(?:'|\"|`)"]
  ],
  "files.associations": {
    "*.glsl": "glsl",
    "*.vert": "glsl",
    "*.frag": "glsl"
  },
  "emmet.includeLanguages": {
    "typescript": "html",
    "typescriptreact": "html"
  }
}
VSCODE

# VS Code recommended extensions
cat > .vscode/extensions.json << 'EXTENSIONS'
{
  "recommendations": [
    "dbaeumer.vscode-eslint",
    "esbenp.prettier-vscode",
    "bradlc.vscode-tailwindcss",
    "csstools.postcss",
    "cesium.gltf-vscode",
    "slevesque.shader",
    "dtoplak.vscode-glsllint",
    "connor4312.codesong",
    "eamodio.gitlens",
    "mhutchie.git-graph",
    "formulahendry.auto-rename-tag",
    "christian-kohler.path-intellisense",
    "usernamehw.errorlens",
    "rangav.vscode-thunder-client",
    "yoavbls.pretty-ts-errors",
    "streetsidesoftware.code-spell-checker"
  ]
}
EXTENSIONS

echo "✅ Config files created"

# ──────────────────────────────────────────────
# STEP 5: Create Boilerplate Components
# ──────────────────────────────────────────────
echo ""
echo "🧩 Step 5/6: Creating boilerplate components..."

# ---- Global CSS ----
cat > src/app/globals.css << 'CSS'
@import "tailwindcss";

/* ============================
   DESIGN SYSTEM TOKENS
   ============================ */
:root {
  /* Backgrounds */
  --bg-primary: #0a0a0a;
  --bg-secondary: #111111;
  --bg-tertiary: #1a1a1a;

  /* Text */
  --text-primary: #ffffff;
  --text-secondary: #a0a0a0;
  --text-tertiary: #666666;

  /* Accent — CUSTOMIZE THIS PER PROJECT */
  --accent-primary: #00ff88;
  --accent-secondary: #0066ff;
  --accent-gradient: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));

  /* Glass / Surfaces */
  --border-subtle: rgba(255, 255, 255, 0.06);
  --border-medium: rgba(255, 255, 255, 0.12);
  --glass-bg: rgba(255, 255, 255, 0.03);
  --glass-border: rgba(255, 255, 255, 0.08);
}

/* ============================
   BASE STYLES
   ============================ */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html {
  scroll-behavior: auto; /* Lenis handles smooth scroll */
}

body {
  background-color: var(--bg-primary);
  color: var(--text-primary);
  overflow-x: hidden;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/* Lenis smooth scroll */
html.lenis, html.lenis body {
  height: auto;
}

.lenis.lenis-smooth {
  scroll-behavior: auto !important;
}

.lenis.lenis-smooth [data-lenis-prevent] {
  overscroll-behavior: contain;
}

.lenis.lenis-stopped {
  overflow: hidden;
}

/* ============================
   UTILITY CLASSES
   ============================ */
.text-gradient {
  background: var(--accent-gradient);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.glass {
  background: var(--glass-bg);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid var(--glass-border);
}

.glow {
  box-shadow: 0 0 40px rgba(0, 255, 136, 0.15);
}

/* Hide scrollbar but keep functionality */
.no-scrollbar::-webkit-scrollbar {
  display: none;
}
.no-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

/* Selection */
::selection {
  background: var(--accent-primary);
  color: var(--bg-primary);
}
CSS

# ---- Utility: cn() helper ----
cat > src/lib/utils.ts << 'UTILS'
import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';

/**
 * Merge Tailwind classes with clsx
 * Usage: cn("p-4", condition && "bg-red-500", "text-white")
 */
export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs));
}

/**
 * Clamp a value between min and max
 */
export function clamp(value: number, min: number, max: number): number {
  return Math.min(Math.max(value, min), max);
}

/**
 * Linear interpolation
 */
export function lerp(start: number, end: number, factor: number): number {
  return start + (end - start) * factor;
}

/**
 * Map a value from one range to another
 */
export function mapRange(
  value: number,
  inMin: number,
  inMax: number,
  outMin: number,
  outMax: number
): number {
  return ((value - inMin) * (outMax - outMin)) / (inMax - inMin) + outMin;
}
UTILS

# ---- Smooth Scroll Provider (Lenis) ----
cat > src/components/layout/SmoothScroll.tsx << 'SMOOTH'
'use client';

import { ReactLenis } from 'lenis/react';
import { type ReactNode } from 'react';

interface SmoothScrollProps {
  children: ReactNode;
}

export default function SmoothScroll({ children }: SmoothScrollProps) {
  return (
    <ReactLenis
      root
      options={{
        lerp: 0.1,
        duration: 1.2,
        smoothWheel: true,
        wheelMultiplier: 1,
        touchMultiplier: 2,
      }}
    >
      {children}
    </ReactLenis>
  );
}
SMOOTH

# ---- Three.js Scene Provider ----
cat > src/components/providers/ThreeProvider.tsx << 'THREE_PROVIDER'
'use client';

import { Canvas } from '@react-three/fiber';
import { Preload, AdaptiveDpr, AdaptiveEvents } from '@react-three/drei';
import { Suspense, type ReactNode } from 'react';

interface ThreeProviderProps {
  children: ReactNode;
  className?: string;
}

export default function ThreeProvider({ children, className }: ThreeProviderProps) {
  return (
    <div className={className} style={{ position: 'fixed', inset: 0, zIndex: 0 }}>
      <Canvas
        camera={{ position: [0, 0, 5], fov: 45, near: 0.1, far: 100 }}
        dpr={[1, 2]}
        gl={{
          antialias: true,
          alpha: true,
          powerPreference: 'high-performance',
        }}
      >
        <Suspense fallback={null}>
          {children}
          <Preload all />
        </Suspense>
        <AdaptiveDpr pixelated />
        <AdaptiveEvents />
      </Canvas>
    </div>
  );
}
THREE_PROVIDER

# ---- Example 3D Scene ----
cat > src/components/canvas/Scene.tsx << 'SCENE'
'use client';

import { useRef } from 'react';
import { useFrame } from '@react-three/fiber';
import { Float, Environment, MeshDistortMaterial } from '@react-three/drei';
import * as THREE from 'three';

export default function Scene() {
  const meshRef = useRef<THREE.Mesh>(null);

  useFrame((state) => {
    if (!meshRef.current) return;
    meshRef.current.rotation.y = state.clock.elapsedTime * 0.2;
  });

  return (
    <>
      {/* Lighting */}
      <ambientLight intensity={0.5} />
      <directionalLight position={[10, 10, 5]} intensity={1} />

      {/* Floating 3D Object */}
      <Float speed={2} rotationIntensity={0.5} floatIntensity={1}>
        <mesh ref={meshRef} scale={1.5}>
          <icosahedronGeometry args={[1, 4]} />
          <MeshDistortMaterial
            color="#00ff88"
            roughness={0.2}
            metalness={0.8}
            distort={0.3}
            speed={2}
          />
        </mesh>
      </Float>

      {/* Environment */}
      <Environment preset="city" />
    </>
  );
}
SCENE

# ---- Custom Hook: useScrollProgress ----
cat > src/hooks/useScrollProgress.ts << 'SCROLL_HOOK'
'use client';

import { useRef, useState, useEffect } from 'react';

/**
 * Track scroll progress of an element (0 to 1)
 * Usage:
 *   const { ref, progress } = useScrollProgress();
 *   <div ref={ref}>...</div>
 */
export function useScrollProgress<T extends HTMLElement = HTMLDivElement>() {
  const ref = useRef<T>(null);
  const [progress, setProgress] = useState(0);

  useEffect(() => {
    const element = ref.current;
    if (!element) return;

    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          const handleScroll = () => {
            const rect = element.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            const elementTop = rect.top;
            const elementHeight = rect.height;

            const scrollProgress =
              1 - (elementTop - windowHeight) / -(windowHeight + elementHeight);
            setProgress(Math.max(0, Math.min(1, scrollProgress)));
          };

          window.addEventListener('scroll', handleScroll, { passive: true });
          handleScroll();

          return () => window.removeEventListener('scroll', handleScroll);
        }
      },
      { threshold: 0 }
    );

    observer.observe(element);
    return () => observer.disconnect();
  }, []);

  return { ref, progress };
}
SCROLL_HOOK

# ---- Custom Hook: useMediaQuery ----
cat > src/hooks/useMediaQuery.ts << 'MEDIA_HOOK'
'use client';

import { useState, useEffect } from 'react';

/**
 * Responsive breakpoint hook
 * Usage:
 *   const isMobile = useMediaQuery('(max-width: 768px)');
 *   const prefersReducedMotion = useMediaQuery('(prefers-reduced-motion: reduce)');
 */
export function useMediaQuery(query: string): boolean {
  const [matches, setMatches] = useState(false);

  useEffect(() => {
    const media = window.matchMedia(query);
    setMatches(media.matches);

    const listener = (event: MediaQueryListEvent) => setMatches(event.matches);
    media.addEventListener('change', listener);
    return () => media.removeEventListener('change', listener);
  }, [query]);

  return matches;
}
MEDIA_HOOK

# ---- GSAP Animation Utilities ----
cat > src/lib/animations.ts << 'ANIMATIONS'
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Register GSAP plugins
if (typeof window !== 'undefined') {
  gsap.registerPlugin(ScrollTrigger);
}

/**
 * Fade up animation on scroll
 */
export function fadeUp(
  element: gsap.TweenTarget,
  trigger: string | Element,
  options?: {
    y?: number;
    duration?: number;
    delay?: number;
    stagger?: number;
  }
) {
  const { y = 60, duration = 0.8, delay = 0, stagger = 0 } = options || {};

  return gsap.from(element, {
    y,
    opacity: 0,
    duration,
    delay,
    stagger,
    ease: 'power3.out',
    scrollTrigger: {
      trigger,
      start: 'top 85%',
      end: 'top 20%',
      toggleActions: 'play none none reverse',
    },
  });
}

/**
 * Parallax effect on scroll
 */
export function parallax(
  element: gsap.TweenTarget,
  trigger: string | Element,
  options?: {
    yPercent?: number;
    speed?: number;
  }
) {
  const { yPercent = -20, speed = 1 } = options || {};

  return gsap.to(element, {
    yPercent,
    ease: 'none',
    scrollTrigger: {
      trigger,
      start: 'top bottom',
      end: 'bottom top',
      scrub: speed,
    },
  });
}

/**
 * Pin section while animating content
 */
export function pinSection(
  trigger: string | Element,
  animation: gsap.core.Timeline,
  options?: {
    anticipatePin?: number;
  }
) {
  const { anticipatePin = 1 } = options || {};

  return ScrollTrigger.create({
    trigger,
    start: 'top top',
    end: `+=${window.innerHeight}`,
    pin: true,
    anticipatePin,
    animation,
    scrub: true,
  });
}

/**
 * Text split and reveal animation
 */
export function splitTextReveal(
  element: HTMLElement,
  options?: {
    type?: 'chars' | 'words';
    stagger?: number;
    duration?: number;
  }
) {
  const { type = 'words', stagger = 0.05, duration = 0.6 } = options || {};
  const text = element.textContent || '';

  // Split text into spans
  const items = type === 'chars' ? text.split('') : text.split(' ');
  element.innerHTML = items
    .map((item) => `<span class="inline-block overflow-hidden"><span class="inline-block">${item}${type === 'words' ? '&nbsp;' : ''}</span></span>`)
    .join('');

  const innerSpans = element.querySelectorAll('span > span');

  return gsap.from(innerSpans, {
    y: '100%',
    opacity: 0,
    duration,
    stagger,
    ease: 'power3.out',
    scrollTrigger: {
      trigger: element,
      start: 'top 85%',
      toggleActions: 'play none none reverse',
    },
  });
}
ANIMATIONS

# ---- Root Layout ----
cat > src/app/layout.tsx << 'LAYOUT'
import type { Metadata } from 'next';
import { Inter } from 'next/font/google';
import './globals.css';
import SmoothScroll from '@/components/layout/SmoothScroll';

const inter = Inter({
  subsets: ['latin'],
  display: 'swap',
  variable: '--font-inter',
});

export const metadata: Metadata = {
  title: '3D Animated Website',
  description: 'A stunning 3D animated website with scroll-based interactions',
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en" className={inter.variable}>
      <body>
        <SmoothScroll>
          {children}
        </SmoothScroll>
      </body>
    </html>
  );
}
LAYOUT

# ---- Homepage ----
cat > src/app/page.tsx << 'PAGE'
import HeroSection from '@/components/sections/HeroSection';

export default function Home() {
  return (
    <main>
      <HeroSection />
      {/* Add more sections here as you build them */}
      {/* <AboutSection /> */}
      {/* <FeaturesSection /> */}
      {/* <ShowcaseSection /> */}
      {/* <CTASection /> */}
      {/* <FooterSection /> */}
    </main>
  );
}
PAGE

# ---- Hero Section (starter) ----
cat > src/components/sections/HeroSection.tsx << 'HERO'
'use client';

import { useRef, useEffect } from 'react';
import dynamic from 'next/dynamic';
import gsap from 'gsap';
import { useGSAP } from '@gsap/react';

// Lazy load the 3D scene (important for performance)
const ThreeProvider = dynamic(
  () => import('@/components/providers/ThreeProvider'),
  { ssr: false }
);
const Scene = dynamic(() => import('@/components/canvas/Scene'), {
  ssr: false,
});

export default function HeroSection() {
  const sectionRef = useRef<HTMLElement>(null);
  const headlineRef = useRef<HTMLHeadingElement>(null);
  const sublineRef = useRef<HTMLParagraphElement>(null);

  useGSAP(() => {
    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

    tl.from(headlineRef.current, {
      y: 80,
      opacity: 0,
      duration: 1,
      delay: 0.3,
    })
      .from(
        sublineRef.current,
        {
          y: 40,
          opacity: 0,
          duration: 0.8,
        },
        '-=0.4'
      );
  }, { scope: sectionRef });

  return (
    <section
      ref={sectionRef}
      className="relative min-h-screen flex items-center justify-center overflow-hidden"
    >
      {/* 3D Background */}
      <ThreeProvider className="pointer-events-none">
        <Scene />
      </ThreeProvider>

      {/* Content Overlay */}
      <div className="relative z-10 text-center px-6 max-w-5xl mx-auto">
        <h1
          ref={headlineRef}
          className="text-[clamp(2.5rem,8vw,7rem)] font-bold leading-[0.95] tracking-tight"
        >
          Build Something
          <span className="text-gradient block">Extraordinary</span>
        </h1>

        <p
          ref={sublineRef}
          className="mt-6 text-lg md:text-xl max-w-2xl mx-auto"
          style={{ color: 'var(--text-secondary)' }}
        >
          A stunning 3D animated experience with scroll-based interactions,
          built with Next.js, Three.js, and GSAP.
        </p>
      </div>

      {/* Scroll indicator */}
      <div className="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2">
        <span className="text-xs uppercase tracking-[0.2em]" style={{ color: 'var(--text-tertiary)' }}>
          Scroll
        </span>
        <div className="w-[1px] h-12 bg-gradient-to-b from-white/40 to-transparent" />
      </div>
    </section>
  );
}
HERO

# ---- TypeScript declarations for shaders ----
cat > src/types/three.d.ts << 'TYPES'
declare module '*.glsl' {
  const value: string;
  export default value;
}

declare module '*.vert' {
  const value: string;
  export default value;
}

declare module '*.frag' {
  const value: string;
  export default value;
}

declare module '*.glb' {
  const value: string;
  export default value;
}

declare module '*.gltf' {
  const value: string;
  export default value;
}

declare module '*.hdr' {
  const value: string;
  export default value;
}
TYPES

echo "✅ Boilerplate components created"

# ──────────────────────────────────────────────
# STEP 6: Git Setup
# ──────────────────────────────────────────────
echo ""
echo "🔧 Step 6/6: Configuring Git..."

# Enhanced .gitignore
cat >> .gitignore << 'GITIGNORE'

# 3D Assets (track only compressed/final versions)
*.blend
*.blend1
*.fbx
*.max

# Editor
.vscode/*
!.vscode/settings.json
!.vscode/extensions.json

# OS
.DS_Store
Thumbs.db

# Debug
npm-debug.log*

# Env
.env*.local
GITIGNORE

# Git attributes for LFS (large 3D models)
cat > .gitattributes << 'GITATTR'
# 3D Models (track with Git LFS if enabled)
*.glb filter=lfs diff=lfs merge=lfs -text
*.gltf filter=lfs diff=lfs merge=lfs -text
*.hdr filter=lfs diff=lfs merge=lfs -text
*.exr filter=lfs diff=lfs merge=lfs -text

# Images
*.png filter=lfs diff=lfs merge=lfs -text
*.jpg filter=lfs diff=lfs merge=lfs -text
*.jpeg filter=lfs diff=lfs merge=lfs -text
*.webp filter=lfs diff=lfs merge=lfs -text

# Fonts
*.woff2 filter=lfs diff=lfs merge=lfs -text
*.woff filter=lfs diff=lfs merge=lfs -text
GITATTR

echo "✅ Git configured"

# ──────────────────────────────────────────────
# DONE
# ──────────────────────────────────────────────
echo ""
echo "╔══════════════════════════════════════════════════════════╗"
echo "║  ✅  SETUP COMPLETE!                                    ║"
echo "╠══════════════════════════════════════════════════════════╣"
echo "║                                                          ║"
echo "║  Next steps:                                             ║"
echo "║  1. Run: npm run dev                                     ║"
echo "║  2. Open: http://localhost:3000                          ║"
echo "║  3. Start building sections with Claude Code!            ║"
echo "║                                                          ║"
echo "║  Key files:                                              ║"
echo "║  • CLAUDE.md        → Project brain (Claude reads this)  ║"
echo "║  • src/app/page.tsx → Homepage (add sections here)       ║"
echo "║  • src/components/  → All your components                ║"
echo "║  • src/lib/         → Utilities & animations             ║"
echo "║                                                          ║"
echo "║  VS Code Extensions to install:                          ║"
echo "║  Open VS Code → Ctrl+Shift+P → 'Show Recommended'       ║"
echo "║                                                          ║"
echo "╚══════════════════════════════════════════════════════════╝"
echo ""
