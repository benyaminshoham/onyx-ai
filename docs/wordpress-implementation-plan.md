# Onyx AI — WordPress Implementation Plan

**Version 2.0 · 2026-04-19**

---

## Overview

This document defines the complete WordPress implementation strategy for the Onyx AI website as specified in `onyx-ai-website-plan.md` and `brand.md`. The approach uses a fully custom block theme with a companion Gutenberg blocks plugin, so all content is authored natively in the block editor.

**Tech decisions:**
- **Theme type:** Block theme (FSE — Full Site Editing). Enables site editor control of headers, footers, and templates.
- **Block approach:** Custom plugin (`onyx-ai-blocks`) registers all brand-specific Gutenberg blocks. Theme provides layout, color, and typography tokens only.
- **No page builder:** Elementor, Divi, etc. are explicitly excluded. Gutenberg only.
- **No heavy plugin dependencies:** Avoid page-builder plugins, visual editors, or anything that locks content to a proprietary format.
- **Content as database:** All page content is authored in the Gutenberg editor as block content stored in the WordPress database — not hardcoded in templates.

---

## Repository Structure

```
onyx-ai/
├── themes/
│   └── onyx-ai/                     # Custom block theme
│       ├── theme.json               # Design tokens (colors, typography, spacing)
│       ├── style.css                # Theme header + minimal global styles
│       ├── functions.php            # Theme bootstrap (font enqueue, supports)
│       ├── templates/               # FSE page templates
│       │   ├── index.html
│       │   ├── home.html
│       │   ├── single.html
│       │   ├── page.html
│       │   ├── archive.html
│       │   └── 404.html
│       ├── parts/                   # Template parts
│       │   ├── header.html
│       │   └── footer.html
│       └── patterns/                # Block patterns (reusable section blueprints)
│           ├── hero-homepage.php
│           ├── audience-fork.php
│           ├── service-card-grid.php
│           ├── recorded-card-grid.php
│           ├── testimonial-strip.php
│           ├── newsletter-cta.php
│           ├── about-teaser.php
│           └── faq-section.php
│
└── plugins/
    └── onyx-ai-blocks/              # Custom Gutenberg blocks plugin
        ├── onyx-ai-blocks.php       # Plugin header + bootstrap
        ├── includes/
        │   └── class-onyx-ai-blocks.php
        ├── src/                     # Block source (one directory per block)
        │   ├── hero/
        │   ├── audience-fork/
        │   ├── pillars/
        │   ├── proof-strip/
        │   ├── service-card/
        │   ├── recorded-card/
        │   ├── section-label/
        │   ├── tag-badge/
        │   ├── cta-button/
        │   ├── testimonial/
        │   ├── newsletter-optin/
        │   ├── about-teaser/
        │   └── faq-accordion/
        ├── build/                   # Compiled block assets
        ├── assets/
        │   ├── fonts/               # Self-hosted Google Fonts (Exo 2, DM Sans, DM Mono, Heebo)
        │   └── icons/               # Lucide icon subset as SVG sprites
        └── package.json
```

---

## Phase 1 — Theme Foundation

### 1.1 `theme.json` — Design Tokens

The entire brand design system from `brand.md` is encoded as `theme.json` tokens.

**Colors to register:**

| Slug | Hex | Name |
|---|---|---|
| `charcoal` | `#1A1814` | Charcoal (primary background) |
| `charcoal-deep` | `#0F0D0A` | Charcoal Deep |
| `charcoal-mid` | `#252018` | Charcoal Mid |
| `surface` | `#2E2820` | Surface |
| `border` | `#3D3528` | Border |
| `mustard` | `#C8922A` | Mustard (primary CTA accent) |
| `mustard-light` | `#D4A84B` | Mustard Light |
| `mustard-dim` | `#3D2E10` | Mustard Dim |
| `teal` | `#00D4AA` | Teal |
| `amber` | `#FFB74D` | Amber |
| `white` | `#F5F0E8` | White |
| `silver` | `#C8BFB0` | Silver |
| `silver-muted` | `#7A7060` | Silver Muted |

**Font families to register:** Exo 2, DM Sans, DM Mono, Heebo (for Hebrew RTL content).

**Spacing scale to register:** xs (8px), sm (12px), md (16px), lg (24px), xl (48px), 2xl (80px).

**Typography presets — mapped to brand spec:**

| Style | Font | Weight | Size | Line-height | Tracking | Color |
|---|---|---|---|---|---|---|
| Display | Exo 2 | 800 | 42–64px | 1.0 | −0.03em | `#F5F0E8` |
| H1 | Exo 2 | 800 | 36px | 1.1 | −0.02em | `#F5F0E8` |
| H2 | Exo 2 | 700 | 28px | 1.15 | −0.015em | `#F5F0E8` |
| H3 | Exo 2 | 700 | 22px | 1.2 | −0.01em | `#F5F0E8` |
| H4 | Exo 2 | 500 | 18px | 1.3 | 0 | `#F5F0E8` |
| Subheading | Exo 2 | 500 | 16px | 1.4 | 0 | `#C8BFB0` |
| Body (Hebrew) | Heebo | 300 | 15–16px | 1.7 | 0 | `#C8BFB0` |
| Body (English) | DM Sans | 300 | 15–16px | 1.7 | 0 | `#C8BFB0` |
| Body strong | Heebo / DM Sans | 500 | 15–16px | 1.7 | 0 | `#F5F0E8` |
| Caption / Label | DM Mono | 400 | 10px | 1.5 | +0.16em | `#7A7060` |
| Code inline | DM Mono | 400 | 13px | 1.5 | +0.02em | `#00D4AA` |
| Tag / Badge | DM Mono | 400 | 10px | 1 | +0.10em | varies |

### 1.2 Global Styles

- Default background: `#1A1814` (Charcoal — warm dark)
- Default body text: Silver `#C8BFB0`, Heebo 300 (Hebrew) / DM Sans 300 (English)
- Default heading: White `#F5F0E8`, Exo 2
- Max content width: 1200px
- Section padding: `clamp(48px, 8vw, 80px)` top/bottom
- RTL support declared for Hebrew content (`is_rtl()` hook)
- Noise texture overlay on dark backgrounds: fractal noise at 3–4% opacity

### 1.3 Font Loading

Self-host Exo 2, DM Sans, DM Mono, and Heebo as WOFF2 files inside the plugin's `assets/fonts/` directory. Enqueue via `wp_enqueue_style()` in the plugin, not from Google Fonts CDN, for performance and privacy compliance.

### 1.4 FSE Templates

| Template | Used by |
|---|---|
| `home.html` | Homepage (static front page) |
| `page.html` | About, Developers, Business, Organizations, Blog index, Terms, Privacy |
| `single.html` | Blog post pages |
| `archive.html` | Blog category archive pages |
| `404.html` | 404 error page |

All pages use the standard header and footer. There are no nav-suppressed templates.

---

## Phase 2 — Custom Gutenberg Blocks Plugin

Each block is a standard `@wordpress/scripts`-compiled block with `block.json`, `edit.js`, `save.js` (or `render.php` for dynamic blocks), and `style.scss`.

### Block Registry

---

#### `onyx-ai/hero`

**Used on:** Homepage, audience hub pages.

**Attributes:**
- `eyebrow` (string) — section label above headline (e.g., `01 — AI לעסקים`)
- `headline` (rich text) — display-size headline, supports inline Mustard color spans
- `subheading` (string)
- `ctaPrimaryLabel` / `ctaPrimaryUrl`
- `ctaSecondaryLabel` / `ctaSecondaryUrl`
- `variant` — `homepage` | `audience` (audience hub variant, single CTA)
- `backgroundDecoration` — boolean, enables animated warm gradient orb

**Output:** Full-width section, centered or left-aligned depending on variant.

---

#### `onyx-ai/audience-fork`

**Used on:** Homepage section 2.

**Attributes:**
- Three fork cards, each: `headline`, `description`, `linkLabel`, `linkUrl`, `audience` (`dev` | `biz` | `org`), `icon`

**Output:** Three side-by-side cards on desktop (stacked on mobile), Mustard border accent, one card per audience path.

---

#### `onyx-ai/pillars`

**Used on:** Homepage section 3, About page.

**Attributes:**
- Array of up to 6 pillar items, each: `icon` (Lucide slug), `label`, `description`
- `columns` — 2 | 3 | 4

**Output:** Icon grid with label and one-line description. Teal for icon color.

---

#### `onyx-ai/proof-strip`

**Used on:** Homepage section 4, audience hub pages.

**Attributes:**
- Array of stat items: `number`, `label`
- Array of quote items: `quote`, `author`, `role`

**Output:** Large number stats, divider, 2–3 quote callouts.

---

#### `onyx-ai/service-card`

**Used on:** All audience hub pages (group programs, personal services, organizational services).

**Attributes:**
- `icon`, `title`, `description`, `audienceTag`
- `serviceType` — `group` | `personal` | `organizational`
- `format` (string) — e.g., `חצי יום · מפגש אחד`, `לפי שעה`
- `nextDate` (string) — optional, shown on `group` type cards
- `price` (string) — optional
- `ctaLabel` / `ctaUrl`
- `featured` — boolean

**Output:** Card with icon, title, description, format badge, optional next-date and price, CTA button. `group` type cards show the next cohort date when set. `featured` adds highlighted Mustard border treatment.

---

#### `onyx-ai/recorded-card`

**Used on:** Audience hub pages — "קורסים מוקלטים" section.

**Attributes:**
- `title` (string)
- `audienceTag` — `dev` | `biz` | `org`
- `description` (string) — 2–3 line description
- `price` (string, e.g., `₪890`)
- `duration` (string, e.g., `4 שעות`)
- `moduleCount` (string, e.g., `12 שיעורים`)
- `thumbnailUrl` / `thumbnailAlt`
- `ctaLabel` / `ctaUrl`
- `featured` — boolean

**Output:** Card with thumbnail at top, audience tag badge, title, module count + duration metadata row (DM Mono, Silver Muted), description, price badge (Mustard), CTA button. Visually distinct from `service-card`: thumbnail signals "watch/learn" rather than "book a session."

**Note:** Dynamic block — renders via `render.php` so data can optionally be pulled from the `onyx_course` custom post type (Phase 4 option).

---

#### `onyx-ai/section-label`

**Used on:** All pages, preceding major sections.

**Attributes:**
- `number` (string, e.g., `01`)
- `label` (string, e.g., `קורסים`)

**Output:** `01 — קורסים` in DM Mono 400, 10px, uppercase, Silver Muted `#7A7060`, +0.18em tracking. Thin Mustard left border accent (flips to right in RTL via logical CSS).

---

#### `onyx-ai/tag-badge`

**Used on:** Service cards, recorded cards, anywhere a pill label is needed.

**Attributes:**
- `text`
- `variant` — `mustard` | `teal` | `amber`

**Output:**

| Variant | Background | Text |
|---|---|---|
| mustard | `#3D2E10` | `#D4A84B` |
| teal | `rgba(0,212,170,0.12)` | `#00D4AA` |
| amber | `rgba(255,183,77,0.12)` | `#FFB74D` |

Border-radius: 100px · Padding: 5px 12px · Font: DM Mono 400, 10px, uppercase, +0.10em.

---

#### `onyx-ai/cta-button`

**Used on:** All pages.

**Attributes:**
- `label`, `url`
- `variant` — `primary` | `secondary` | `ghost`
- `arrow` — boolean (appends `→`)
- `size` — `default` | `large`

**Output:**

| Variant | Background | Text | Border |
|---|---|---|---|
| primary | `#C8922A` | `#FFFFFF` | none |
| secondary | transparent | `#D4A84B` | 1px `#3D2E10` |
| ghost | `#2E2820` | `#C8BFB0` | 0.5px `#3D3528` |

Border-radius: 8px · Padding: 12px 24px · Font: Exo 2 600, 13px, +0.04em.

---

#### `onyx-ai/testimonial`

**Used on:** Audience hub pages, homepage proof strip.

**Attributes:**
- `quote`, `author`, `role`, `avatarUrl`
- `layout` — `card` | `inline` | `featured`

**Output:** Testimonial card in Surface `#2E2820` background.

---

#### `onyx-ai/newsletter-optin`

**Used on:** Homepage, blog post footers.

**Attributes:**
- `headline`, `subtext`, `hook`, `buttonLabel`
- `formProvider` — `mailchimp` | `convertkit` | `custom`
- `layout` — `full-width` | `inline` | `sidebar`

**Output:** Email field + button form. Full-width dark section or inline card.

---

#### `onyx-ai/about-teaser`

**Used on:** Homepage section 9.

**Attributes:**
- `photoUrl`, `photoAlt`
- `bio` (short rich text, ~2 lines)
- `credibilityLine` (string)
- `linkLabel`, `linkUrl`

**Output:** Photo + bio side-by-side card, credibility line in DM Mono, link to About page.

---

#### `onyx-ai/faq-accordion`

**Used on:** Audience hub pages.

**Attributes:**
- Array of FAQ items: `question`, `answer` (rich text)

**Output:** Accessible accordion (`<details>`/`<summary>`), animated with brand easing. Surface background cards.

---

### Block Patterns

Registered in the theme's `patterns/` directory under the "Onyx AI" category.

| Pattern | Composition |
|---|---|
| `hero-homepage` | `section-label` + `hero` (homepage variant) |
| `audience-fork` | `section-label` + `audience-fork` (3 cards) |
| `service-card-grid` | `section-label` + 3–4× `service-card` in Columns block |
| `recorded-card-grid` | `section-label` + 2–3× `recorded-card` in Columns block |
| `testimonial-strip` | `proof-strip` + 3× `testimonial` (inline) |
| `newsletter-cta` | `section-label` + `newsletter-optin` (full-width) |
| `about-teaser` | `about-teaser` block |
| `faq-section` | `section-label` + `faq-accordion` |

---

## Phase 3 — Plugin Stack

Only essential plugins. No page builders.

| Plugin | Purpose | Notes |
|---|---|---|
| **Yoast SEO** (or Rank Math) | Hebrew meta titles, meta descriptions, structured data, sitemap | |
| **WP Rocket** (or Perfmatters) | Caching, asset minification, lazy loading | |
| **Redirection** | URL redirects management | |
| **Contact Form 7** (or Gravity Forms) | Lead capture on consultation CTAs | Only if newsletter plugin doesn't cover all cases |
| **Email marketing integration** | MailChimp / ConvertKit / ActiveCampaign plugin | Connects `newsletter-optin` block |

**Explicitly not used:** Elementor, WPBakery, Divi, ACF, or WooCommerce.

---

## Phase 4 — Content Structure

### Custom Post Types

At launch, all content uses standard WordPress post types (Pages and Posts). One optional CPT may be added:

**`onyx_course`** (optional, Phase 4+):
- Fields: title, description, audience, price, duration, module count, thumbnail, external purchase URL, audience tag
- If registered, `recorded-card` block queries it dynamically
- If not registered at launch, recorded-card blocks are manually authored in the editor

At launch, skip the CPT and author all content manually. Add it when the course catalog grows large enough to benefit from a structured data layer.

### Blog Taxonomy

Register a custom taxonomy `onyx_content_cluster` on `post`:

| Term | Slug | Audience |
|---|---|---|
| AI לעסקים | `ai-business` | Business owners |
| AI למפתחים | `ai-developers` | Developers |
| מדריכים מעשיים | `practical-guides` | Both |
| דעות ומגמות | `opinions-trends` | Both |

### URL Structure

| Page | WordPress setup |
|---|---|
| `/` | Static front page → Homepage page |
| `/developers` | Page with slug `developers` |
| `/business` | Page with slug `business` |
| `/organizations` | Page with slug `organizations` |
| `/about` | Page with slug `about` |
| `/blog` | Blog posts page (Settings → Reading) |
| `/blog/[slug]` | Standard WordPress posts |
| `/terms` | Page with slug `terms` |
| `/privacy` | Page with slug `privacy` |

Permalink structure: `/%postname%/`

---

## Phase 5 — Page-by-Page Content Implementation

All pages built in the Gutenberg editor using custom blocks and patterns. Content stored in the WordPress database — no hardcoded templates.

### Build order (recommended)

**Round 1 — Foundations (before any content pages)**
1. Theme installed, `theme.json` complete, all design tokens confirmed
2. All custom blocks built and tested in isolation
3. All block patterns registered
4. FSE templates built (home, page, single, archive)
5. Header and footer template parts built

**Round 2 — Core pages**
6. Homepage — all 10 sections assembled from patterns
7. About page
8. Blog index (template-driven, no content authoring needed)

**Round 3 — Audience hub pages**
9. Developers Hub (`/developers`) — hero, journey, service-card grids, recorded-card grid, FAQ, CTA
10. Business Hub (`/business`) — same structure, business-specific content
11. Organizations Hub (`/organizations`) — org services primary, supporting services secondary, FAQ, CTA

**Round 4 — Legal and infrastructure**
12. Terms of use page
13. Privacy policy page
14. 404 page (FSE template)
15. SEO plugin configuration (meta, sitemap)
16. Newsletter integration wired to `newsletter-optin` block

---

## Phase 6 — RTL & Hebrew Considerations

- `<html lang="he" dir="rtl">` set via `language_attributes()` when WordPress language is set to Hebrew
- All block CSS uses logical properties (`margin-inline-start`, `padding-inline-end`) rather than left/right
- Heebo font applied as `font-family` when `is_rtl()` is true
- Navigation, footer columns, and card layouts tested in RTL
- `onyx-ai/section-label` Mustard left border accent becomes right border accent in RTL via logical CSS

---

## Phase 7 — SEO Implementation

- Yoast SEO (or Rank Math) configured for Hebrew content
- Every page has a manually authored Hebrew `<title>` (≤60 chars) and `<meta description>` (≤160 chars)
- Blog posts use Article structured data (auto-generated by Yoast)
- XML sitemap generated automatically — submitted to Google Search Console
- Every blog post links internally to at least one audience hub page

---

## Phase 8 — Performance Baseline

- Target: Lighthouse Performance score ≥ 90 on mobile
- Fonts: WOFF2, `font-display: swap`, preloaded in `<head>`
- Images: WebP format, `loading="lazy"` on all below-fold images, explicit `width`/`height`
- JavaScript: All block scripts deferred, no render-blocking JS
- CSS: Critical CSS inlined for above-fold content (WP Rocket)
- No unused plugin CSS/JS loaded on frontend

---

## Motion & Animation

- Easing: `cubic-bezier(0.16, 1, 0.3, 1)` — fast in, slow settle
- Duration: 200ms (micro), 400ms (transition), 600ms (entrance)
- Page entrances: staggered fade-up (`translateY(16px)` → `0`, opacity `0` → `1`)
- Hover on cards: `transform: translateY(-2px)`, border brightens to `#4D4030` (warm)
- Respect `prefers-reduced-motion`

---

## Development Toolchain

```
Node.js ≥ 20
@wordpress/scripts       # Build tool for blocks (webpack config included)
@wordpress/blocks        # Block registration API
@wordpress/block-editor  # InspectorControls, RichText, etc.
@wordpress/components    # Panel, Toggle, etc.
sass                     # SCSS compilation (via @wordpress/scripts)
wp-env                   # Local WordPress environment for development
```

**Local development:** `@wordpress/env` (wp-env) — Docker-based, zero-config. Run `wp-env start` inside the project root.

**Block build:** `npm run build` compiles all blocks in `src/` to `build/`. `npm run start` watches for changes.

---

## Deliverables Checklist

### Theme (`onyx-ai`)
- [ ] `theme.json` with full warm brand token set (Charcoal/Mustard palette)
- [ ] `style.css` with theme header
- [ ] `functions.php` (font enqueue, theme supports, pattern registration)
- [ ] FSE templates: `home`, `page`, `single`, `archive`, `404`
- [ ] Template parts: `header`, `footer`
- [ ] Block patterns (all 8 listed above)

### Plugin (`onyx-ai-blocks`)
- [ ] Plugin bootstrap file with proper header
- [ ] All 13 custom blocks built, tested, documented
- [ ] Self-hosted fonts (Exo 2, DM Sans, DM Mono, Heebo) in WOFF2
- [ ] Lucide icon subset as inline SVG or sprite
- [ ] `block.json` for every block (metadata, attributes, supports)
- [ ] Editor styles matching frontend render

### Pages (8 total)
- [ ] Homepage (all 10 sections)
- [ ] Developers Hub (`/developers`)
- [ ] Business Hub (`/business`)
- [ ] Organizations Hub (`/organizations`)
- [ ] About
- [ ] Blog index (template only, no content authoring)
- [ ] Terms
- [ ] Privacy

### Configuration
- [ ] SEO plugin installed and configured
- [ ] Newsletter integration connected
- [ ] Sitemap submitted to Google Search Console
- [ ] WP language set to Hebrew
- [ ] Permalink structure set to `/%postname%/`

---

*Onyx AI WordPress Implementation Plan · v2.0 · 2026-04-19*
