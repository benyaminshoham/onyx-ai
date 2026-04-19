# Onyx AI — WordPress Implementation Plan

**Version 1.0 · 2026-04-17**

---

## Overview

This document defines the complete WordPress implementation strategy for the Onyx AI website as specified in `onyx-ai-website-plan.md` and `brand.md`. The approach uses a fully custom block theme with a companion Gutenberg blocks plugin, so all content is authored natively in the block editor.

**Tech decisions:**
- **Theme type:** Block theme (FSE — Full Site Editing), not classic theme. Enables site editor control of headers, footers, and templates.
- **Block approach:** Custom plugin (`onyx-ai-blocks`) registers all brand-specific Gutenberg blocks. Theme provides layout, color, and typography tokens only.
- **No page builder:** Elementor, Divi, etc. are explicitly excluded. Gutenberg only.
- **No heavy plugin dependencies:** Avoid page-builder plugins, visual editors, or anything that locks content to a proprietary format.

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
│       │   ├── page-landing.html    # No-nav template for /lp/* pages
│       │   ├── archive.html
│       │   └── 404.html
│       ├── parts/                   # Template parts
│       │   ├── header.html
│       │   ├── header-minimal.html  # Logo-only header for landing pages
│       │   ├── footer.html
│       │   └── footer-minimal.html  # Logo + legal only for landing pages
│       └── patterns/                # Block patterns (reusable section blueprints)
│           ├── hero-homepage.php
│           ├── hero-landing.php
│           ├── audience-fork.php
│           ├── course-card-grid.php
│           ├── service-card-grid.php
│           ├── testimonial-strip.php
│           ├── newsletter-cta.php
│           └── about-teaser.php
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
        │   ├── course-card/
        │   ├── service-card/
        │   ├── resource-card/
        │   ├── section-label/
        │   ├── tag-badge/
        │   ├── cta-button/
        │   ├── testimonial/
        │   ├── newsletter-optin/
        │   ├── about-teaser/
        │   ├── faq-accordion/
        │   └── landing-section/
        ├── build/                   # Compiled block assets
        ├── assets/
        │   ├── fonts/               # Self-hosted Google Fonts (Syne, DM Sans, DM Mono, Heebo)
        │   └── icons/               # Lucide icon subset as SVG sprites
        └── package.json
```

---

## Phase 1 — Theme Foundation

### 1.1 `theme.json` — Design Tokens

The entire brand design system from `brand.md` is encoded as `theme.json` tokens. This makes every color, font, and spacing value available in the block editor UI and enforces brand consistency globally.

**Colors to register:**

| Slug | Hex | Name |
|---|---|---|
| `onyx` | `#0A0A0F` | Onyx |
| `onyx-deep` | `#050508` | Onyx Deep |
| `onyx-mid` | `#14141E` | Onyx Mid |
| `surface` | `#1C1C2A` | Surface |
| `border` | `#2A2A3E` | Border |
| `electric` | `#5B5FFF` | Electric |
| `electric-light` | `#7B7FFF` | Electric Light |
| `electric-dim` | `#2A2D8A` | Electric Dim |
| `teal` | `#00D4AA` | Teal |
| `amber` | `#FFB74D` | Amber |
| `white` | `#F0F2FF` | White |
| `silver` | `#C8CCDD` | Silver |
| `silver-muted` | `#6B6F8A` | Silver Muted |

**Font families to register:** Syne, DM Sans, DM Mono, Heebo (for Hebrew RTL content).

**Spacing scale to register:** xs (8px), sm (12px), md (16px), lg (24px), xl (48px), 2xl (80px).

**Typography presets:** Display, H1–H4, Subheading, Body, Body Strong, Caption/Label, Code, Tag/Badge — all mapped to Syne/DM Sans/DM Mono with exact weights, sizes, line-heights, and letter-spacing from `brand.md`.

### 1.2 Global Styles

- Default background: `#0A0A0F` (dark mode throughout)
- Default body text: Silver `#C8CCDD`, DM Sans 300
- Default heading: White `#F0F2FF`, Syne
- Max content width: 1200px
- Section padding: `clamp(48px, 8vw, 80px)` top/bottom
- RTL support declared for Hebrew content (WordPress `is_rtl()` hook)

### 1.3 Font Loading

Self-host Syne, DM Sans, DM Mono, and Heebo as WOFF2 files inside the plugin's `assets/fonts/` directory. Enqueue via `wp_enqueue_style()` in the plugin, not from Google Fonts CDN, for performance and privacy compliance.

### 1.4 FSE Templates

| Template | Used by |
|---|---|
| `home.html` | Homepage (static front page) |
| `page.html` | About, Courses index, Services index, Resources, Blog index, Privacy, Terms |
| `page-landing.html` | All `/lp/*` pages — no nav, minimal footer |
| `single.html` | Blog post pages |
| `archive.html` | Category archive pages |
| `404.html` | 404 error page |

The `page-landing.html` template uses `header-minimal.html` (logo only, not linked) and `footer-minimal.html` (logo + Privacy + Terms). Landing pages are assigned this template in the WordPress editor.

---

## Phase 2 — Custom Gutenberg Blocks Plugin

Each block is a standard `@wordpress/scripts`-compiled block with `block.json`, `edit.js` (editor UI), `save.js` (or `render.php` for dynamic blocks), and `style.scss`. Blocks use the InspectorControls panel for configuration options.

### Block Registry

---

#### `onyx-ai/hero`

**Used on:** Homepage, landing pages (via variant), individual course/service pages.

**Attributes:**
- `eyebrow` (string) — small section label above headline (e.g., `01 — AI לעסקים`)
- `headline` (rich text) — display-size headline, supports inline color spans
- `subheading` (string) — one-line subheading
- `ctaPrimaryLabel` / `ctaPrimaryUrl` (string)
- `ctaSecondaryLabel` / `ctaSecondaryUrl` (string)
- `variant` — `homepage` (two CTAs, audience-fork style) | `landing` (single CTA) | `course` (with price badge)
- `backgroundDecoration` — boolean, enables animated gradient orb background

**Output:** Full-width section with centered or left-aligned content depending on variant.

---

#### `onyx-ai/audience-fork`

**Used on:** Homepage section 2.

**Attributes:**
- Two fork cards, each with: `headline`, `description`, `linkLabel`, `linkUrl`, `audience` (`dev` | `biz`), `icon`

**Output:** Two side-by-side cards on desktop (stacked on mobile), Electric border accent, developer path vs. business owner path.

---

#### `onyx-ai/pillars`

**Used on:** Homepage section 3, About page.

**Attributes:**
- Array of up to 6 pillar items, each: `icon` (Lucide slug), `label`, `description`
- `columns` — 2 | 3 | 4

**Output:** Icon grid with label and one-line description. Uses Teal for icon color.

---

#### `onyx-ai/proof-strip`

**Used on:** Homepage section 4.

**Attributes:**
- Array of stat items: `number`, `label`
- Array of quote items: `quote`, `author`, `role`
- `logos` — boolean (show logo strip)

**Output:** Three large number stats, horizontal divider, 2–3 quote callouts, optional logo strip.

---

#### `onyx-ai/course-card`

**Used on:** Courses index grid, Homepage featured courses, Landing pages.

**Attributes:**
- `title`, `audienceTag` (Electric | Teal), `description`, `price`, `ctaLabel`, `ctaUrl`, `coursePageId`
- `featured` — boolean, adds highlighted border treatment

**Output:** Card with eyebrow audience tag, title, description, price badge, CTA button.

**Note:** Dynamic block — renders via `render.php` so course data can optionally be pulled from a Course custom post type (Phase 4 option).

---

#### `onyx-ai/service-card`

**Used on:** Services index grid, About page offerings overview.

**Attributes:**
- `icon`, `title`, `description`, `audienceTag`, `linkUrl`

**Output:** Card with icon, title, one-line description, audience tag badge, arrow link.

---

#### `onyx-ai/resource-card`

**Used on:** Resources page grid, Homepage free resources teaser.

**Attributes:**
- `typeBadge` — `article` | `tool` | `template` | `video` | `download`
- `title`, `description`, `ctaLabel`, `ctaUrl`
- `gated` — boolean, replaces CTA with email opt-in trigger

**Output:** Card with type badge (color-coded per type), title, description, CTA.

---

#### `onyx-ai/section-label`

**Used on:** All pages, preceding major sections.

**Attributes:**
- `number` (string, e.g., `01`)
- `label` (string, e.g., `קורסים`)

**Output:** `01 — קורסים` in DM Mono 400, 10px, uppercase, Silver Muted, with correct letter-spacing. Thin Electric left border accent.

---

#### `onyx-ai/tag-badge`

**Used on:** Course cards, resource cards, anywhere a pill label is needed.

**Attributes:**
- `text`
- `variant` — `electric` | `teal` | `amber`

**Output:** Pill badge per brand spec.

---

#### `onyx-ai/cta-button`

**Used on:** All pages.

**Attributes:**
- `label`, `url`
- `variant` — `primary` | `secondary` | `ghost`
- `arrow` — boolean (appends `→`)
- `size` — `default` | `large`

**Output:** Brand-spec button. Primary: Electric fill + white text. Secondary: transparent + Electric-Light text + Electric-Dim border. Ghost: Surface fill + Silver text.

---

#### `onyx-ai/testimonial`

**Used on:** Landing pages, Homepage proof strip, individual service/course pages.

**Attributes:**
- `quote`, `author`, `role`, `avatarUrl`
- `layout` — `card` | `inline` | `featured`

**Output:** Testimonial card in Surface background with quote, author, role, optional avatar.

---

#### `onyx-ai/newsletter-optin`

**Used on:** Homepage section 8, Blog sidebar, Resources page, Blog post footers.

**Attributes:**
- `headline`, `subtext`
- `hook` — the specific reason to subscribe (replaces generic "subscribe")
- `buttonLabel`
- `formProvider` — `mailchimp` | `convertkit` | `custom` (stores API endpoint or embed code)
- `layout` — `full-width` | `inline` | `sidebar`

**Output:** Email field + button form, full-width dark section or inline card depending on layout.

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

**Used on:** Courses index, individual course/service pages, landing pages.

**Attributes:**
- Array of FAQ items: `question`, `answer` (rich text)

**Output:** Accessible accordion (`<details>`/`<summary>` pattern), animated with brand easing. Surface background cards.

---

#### `onyx-ai/landing-section`

**Used on:** Landing pages only.

**Purpose:** Wraps each of the 10 standard landing page sections (Hero, Problem, Solution, What's Included, Who It's For, Social Proof, About, FAQ, Final CTA, Minimal Footer). Acts as a labeled container in the editor so content authors can identify sections at a glance.

**Attributes:**
- `sectionType` — enum of the 10 section types
- `backgroundColor` — inherits from theme palette

**Output:** Semantic section wrapper with optional top divider.

---

### Block Patterns

Block patterns are pre-composed block layouts registered in the theme's `patterns/` directory. They appear in the "Onyx AI" category in the block inserter and give editors one-click access to complete page section layouts.

| Pattern | Composition |
|---|---|
| `hero-homepage` | `section-label` + `hero` (homepage variant) |
| `hero-landing` | `hero` (landing variant) — no nav, above fold |
| `audience-fork` | `section-label` + `audience-fork` |
| `course-card-grid` | `section-label` + 3× `course-card` in Columns block |
| `service-card-grid` | `section-label` + 4× `service-card` in Columns block |
| `testimonial-strip` | `proof-strip` + 3× `testimonial` (inline) |
| `newsletter-cta` | `section-label` + `newsletter-optin` (full-width) |
| `about-teaser` | `about-teaser` block |
| `landing-page-full` | All 10 `landing-section` wrappers pre-stacked |
| `faq-section` | `section-label` + `faq-accordion` |

---

## Phase 3 — Plugin Stack

Only essential plugins. No page builders.

| Plugin | Purpose | Notes |
|---|---|---|
| **Yoast SEO** (or Rank Math) | Hebrew meta titles, meta descriptions, structured data, sitemap | Configure `noindex` on all `/lp/*` pages and lead magnet pages |
| **WP Rocket** (or Perfmatters) | Caching, asset minification, lazy loading | |
| **Redirection** | URL redirects management | For campaign URL management |
| **Contact Form 7** (or Gravity Forms) | Lead capture on consulting/service pages | Only if newsletter plugin doesn't cover all cases |
| **Email marketing integration** | MailChimp / ConvertKit / ActiveCampaign plugin | Connects `newsletter-optin` block |
| **Cloudinary** (or similar CDN) | Image delivery and optimization | Optional — WP Rocket covers basics |
| **WP Multilingual (WPML)** (optional) | If mixed Hebrew/English per-page is needed | Evaluate post-launch |

**Explicitly not used:** Elementor, WPBakery, Divi, Beaver Builder, ACF (Advanced Custom Fields — blocks handle all structured data natively), or WooCommerce (external course platform handles payments).

---

## Phase 4 — Content Structure

### Custom Post Types

At launch, all content uses standard WordPress post types (Pages and Posts). One optional CPT may be added:

**`onyx_course`** (optional, Phase 4+):
- Fields: title, description, audience, price, external URL, featured image, audience tag
- If registered, `course-card` block queries it dynamically
- If not registered at launch, course cards are fully manually authored in the block editor — no CPT dependency

**`onyx_resource`** (optional, Phase 4+):
- Fields: type badge, title, description, CTA, gated flag
- Same pattern as course CPT

At launch, skip CPTs and author all content manually. Add CPTs in a future phase when the catalog grows large enough to benefit from a structured data layer.

### Blog Taxonomy

Register a custom taxonomy `onyx_content_cluster` with four terms:

| Term | Slug | Audience |
|---|---|---|
| AI לעסקים | `ai-business` | Business owners |
| AI למפתחים | `ai-developers` | Developers |
| מדריכים מעשיים | `practical-guides` | Both |
| דעות ומגמות | `opinions-trends` | Both |

Assign this taxonomy to both `post` and `onyx_resource` post types. Used for the filter tabs on `/blog` and `/resources`.

### URL Structure

| Page | WordPress setup |
|---|---|
| `/` | Static front page → Homepage page |
| `/about` | Page with slug `about` |
| `/courses` | Page with slug `courses` |
| `/courses/[slug]` | Sub-pages or CPT archive URL |
| `/services` | Page with slug `services` |
| `/services/[slug]` | Sub-pages |
| `/blog` | Blog posts page (Settings → Reading) |
| `/blog/[slug]` | Standard WordPress posts |
| `/resources` | Page with slug `resources` |
| `/resources/[slug]` | Sub-pages for lead magnet opt-in pages |
| `/lp/[slug]` | Sub-pages under a parent `lp` page (noindex, landing template) |
| `/privacy` | Page with slug `privacy` |
| `/terms` | Page with slug `terms` |

Permalink structure: `/%postname%/`

---

## Phase 5 — Page-by-Page Content Implementation

Each page is built in the Gutenberg editor using the custom blocks and patterns above. This is the authoring sequence.

### Build order (recommended)

**Round 1 — Foundations (before any content pages)**
1. Theme installed, `theme.json` complete, all design tokens confirmed
2. All custom blocks built and tested in isolation
3. All block patterns registered
4. FSE templates built (home, page, page-landing, single, archive)
5. Header and footer template parts built

**Round 2 — Core pages**
6. Homepage — all 10 sections assembled from patterns
7. About page
8. Courses index
9. Services index

**Round 3 — Product pages**
10. 3× Individual course pages
11. 4× Individual service pages (consulting, bootcamp, workshop, community)

**Round 4 — Content and conversion pages**
12. Blog index (template-driven, no content authoring needed)
13. Resources page
14. 6× Landing pages under `/lp/`
15. 1–2 Lead magnet opt-in pages

**Round 5 — Legal and infrastructure**
16. Privacy policy page
17. Terms of use page
18. 404 page (FSE template)
19. SEO plugin configuration (meta, sitemap, noindex rules)
20. Newsletter integration wired to `newsletter-optin` block

---

## Phase 6 — RTL & Hebrew Considerations

- `<html lang="he" dir="rtl">` set via `language_attributes()` in the theme when WordPress language is set to Hebrew
- All block CSS uses logical properties (`margin-inline-start`, `padding-inline-end`) rather than left/right where layout depends on direction
- Heebo font loaded and applied as `font-family` when `is_rtl()` is true (filtered via `theme.json` or a body class hook)
- Navigation, footer columns, and card layouts tested in RTL
- The `onyx-ai/section-label` block's left border accent becomes a right border accent in RTL automatically via logical CSS properties

---

## Phase 7 — SEO Implementation

- Yoast SEO (or Rank Math) installed and configured for Hebrew content
- Every page has a manually authored Hebrew `<title>` (≤60 chars) and `<meta description>` (≤160 chars) set in the Yoast panel within the editor
- Blog posts and resources use Article structured data (auto-generated by Yoast)
- All `/lp/*` pages and `/resources/[magnet-slug]` pages set to `noindex, nofollow` in Yoast
- XML sitemap generated automatically — submitted to Google Search Console
- Every blog post and resource manually links to at least one course or service page (editorial rule, not automated)

---

## Phase 8 — Performance Baseline

- Target: Lighthouse Performance score ≥ 90 on mobile
- Fonts: WOFF2, `font-display: swap`, preloaded in `<head>`
- Images: WebP format, `loading="lazy"` on all below-fold images, explicit `width`/`height` to prevent CLS
- JavaScript: All block scripts deferred, no render-blocking JS
- CSS: Critical CSS inlined for above-fold content (WP Rocket handles this)
- No unused plugin CSS/JS loaded on frontend

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

**Local development:** `@wordpress/env` (wp-env) — Docker-based, zero-config local WP environment. Run `wp-env start` inside the project root.

**Block build:** `npm run build` compiles all blocks in `src/` to `build/`. `npm run start` watches for changes during development.

---

## Deliverables Checklist

### Theme (`onyx-ai`)
- [ ] `theme.json` with full brand token set
- [ ] `style.css` with theme header
- [ ] `functions.php` (font enqueue, theme supports, pattern registration)
- [ ] FSE templates: `home`, `page`, `page-landing`, `single`, `archive`, `404`
- [ ] Template parts: `header`, `header-minimal`, `footer`, `footer-minimal`
- [ ] Block patterns (all 10 listed above)

### Plugin (`onyx-ai-blocks`)
- [ ] Plugin bootstrap file with proper header
- [ ] All 14 custom blocks built, tested, documented
- [ ] Self-hosted fonts (Syne, DM Sans, DM Mono, Heebo) in WOFF2
- [ ] Lucide icon subset as inline SVG or sprite
- [ ] `block.json` for every block (metadata, attributes, supports)
- [ ] Editor styles matching frontend render

### Pages (~23 total)
- [ ] Homepage (all 10 sections)
- [ ] About
- [ ] Courses index
- [ ] 3× Course pages
- [ ] Services index
- [ ] 4× Service pages
- [ ] Blog index (template only)
- [ ] Resources
- [ ] 6× Landing pages
- [ ] 1–2 Lead magnet pages
- [ ] Privacy, Terms

### Configuration
- [ ] SEO plugin installed and configured
- [ ] All `/lp/*` and lead magnet pages set to `noindex`
- [ ] Newsletter integration connected
- [ ] Sitemap submitted to Google Search Console
- [ ] WP language set to Hebrew
- [ ] Permalink structure set to `/%postname%/`

---

*Onyx AI WordPress Implementation Plan · v1.0 · 2026-04-17*
