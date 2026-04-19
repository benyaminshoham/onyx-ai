# Onyx AI — Brand Style Guide
**Version 1.0 · Benyamin · Israel**

---

## About the Brand

Onyx AI is the personal brand of Benyamin, a veteran developer, instructor, and entrepreneur in the Israeli high-tech industry. The brand covers four core offerings:

1. **Building** — software and products with AI
2. **Teaching** — developers and non-technical people how to use AI
3. **Automating** — business workflows and processes with AI
4. **Consulting** — escorting business owners through AI adoption

**Market:** Israel  
**Audiences:** Tech professionals & developers · Non-technical business owners & entrepreneurs  
**Content language:** Hebrew (all public-facing copy) · English (internal/operational)

---

## Logo

### Logomark
A hexagonal geometry with a central node and six connecting spokes — referencing circuit nodes, neural networks, and structured systems. Two nested hexagons (outer stroke, inner semi-transparent fill) with a solid circle at center.

**Construction:**
- Outer hexagon: stroke only, `#C8922A`, 1.5px weight
- Inner hexagon: `#C8922A` fill at 15% opacity
- Center node: solid circle, `#C8922A`
- Six spokes connecting outer to inner vertices: `#C8922A` at 60% opacity, 1px
- Background tile: rounded rectangle `rx=12`, fill `#252018`

### Wordmark
- Typeface: **Exo 2 800**
- Text: `ONYX AI` — "ONYX" in `#F5F0E8`, " AI" in `#C8922A`
- Letter-spacing: −0.02em
- Font-size: 28px (scales proportionally)

### Tagline beneath wordmark
- Typeface: **DM Mono 400**
- Text: `Build · Teach · Transform`
- Size: 9px, letter-spacing: 0.22em, uppercase
- Color: `#6B6F8A`

### Logo variants
| Variant | Usage |
|---|---|
| Full (mark + wordmark + tagline) | Primary — website header, presentations |
| Full (mark + wordmark) | Secondary — social profiles, email signatures |
| Mark only | Favicon, app icon, watermarks, small placements |
| On-light version | White/light backgrounds — mark tile becomes `#EEEEF8` |

### Clear space
Maintain minimum clear space of 1× the mark height on all sides.

### Don'ts
- Do not change the Electric accent color on the wordmark
- Do not use the logo on busy photographic backgrounds without a backing tile
- Do not stretch, rotate, or add effects to the mark
- Do not use the wordmark without the mark

---

## Color System

### Primary Palette

| Name | Hex | Usage |
|---|---|---|
| **Charcoal** | `#1A1814` | Primary background |
| **Charcoal Deep** | `#0F0D0A` | Footer, extreme depth |
| **Charcoal Mid** | `#252018` | Logo tile, overlays |
| **Surface** | `#2E2820` | Cards, panels, inputs |
| **Border** | `#3D3528` | Dividers, card borders |

### Accent Palette

| Name | Hex | Usage |
|---|---|---|
| **Mustard** | `#C8922A` | Primary CTA, links, logo accent |
| **Mustard Light** | `#D4A84B` | Hover states, secondary emphasis |
| **Mustard Dim** | `#3D2E10` | Tag backgrounds, subtle accent fills |
| **Teal** | `#00D4AA` | Success, code labels, positive states |
| **Amber** | `#FFB74D` | Highlights, warmth, attention |

### Text Palette

| Name | Hex | Usage |
|---|---|---|
| **White** | `#F5F0E8` | Headings, primary emphasis |
| **Silver** | `#C8BFB0` | Body text, default |
| **Silver Muted** | `#7A7060` | Captions, labels, secondary info |

### Light Mode (for pages with light backgrounds)
- Background: `#F5F0E8`
- Surface: `#EDE8E0`
- Text primary: `#1A1814`
- Text secondary: `#3D3528`
- Border: `#D4CDBE`
- Accent: `#C8922A` (unchanged)

### Color Rules
- Mustard is the single CTA color — never use teal or amber for primary actions
- Teal is reserved for code, data, and success states
- Amber is used sparingly — maximum one instance per page section
- On dark backgrounds, body text is always Silver (`#C8BFB0`), never pure white
- On light backgrounds, body text is `#3D3528`, headings `#1A1814`

### Textures & Gradients
- **Noise texture** — apply a subtle fractal noise overlay on all dark backgrounds at 3–4% opacity; breaks the flat look without competing with content
- **Gradients** — use warm brown-to-anthracite direction (e.g. `#C8922A` → transparent for accent orbs, `#1A1814` → `#252018` for section transitions); never blue-purple gradients

---

## Typography

### Font Stack

| Font | Weight(s) | Role | Source |
|---|---|---|---|
| **Exo 2** | 300–800 | Display, headings, wordmark, buttons. Geometric/futuristic, works in Hebrew fallback. | Google Fonts |
| **Heebo** | 300–800 | Primary body font for Hebrew text | Google Fonts |
| **DM Sans** | 300–500 | English body text, UI prose | Google Fonts |
| **DM Mono** | 300–500 | Section labels, captions, tags, code, mono eyebrows | Google Fonts |

### Type Scale

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

### Typography Rules
- Headings are always in sentence case (not Title Case, not ALL CAPS)
- Caption/label text is always uppercase via `text-transform: uppercase`
- Section labels follow the pattern: `01 — Section Name`
- Never use bold inside body paragraphs — restructure the sentence instead
- Minimum body font size: 14px
- Hebrew text: **Heebo** is the primary Hebrew body font. **Exo 2** serves as the display/heading font and has decent Hebrew glyph coverage as a fallback. DM Mono is used for code and labels in both Hebrew and English contexts.

---

## Voice & Tone

### Brand Personality
Confident · Warm · Direct · Practical · Encouraging

### Core Voice Principles

**Do:**
- Speak directly: "You will build this in one afternoon."
- Use numbered, actionable structure
- Be technically precise — the audience will notice vagueness
- Acknowledge difficulty honestly: "This part is tricky. Here's how to think about it."
- Sound like a senior developer who genuinely wants people to succeed

**Don't:**
- Use hype without substance: ~~"Revolutionary AI-powered synergy"~~
- Over-explain basics to technical audiences
- Use corporate filler language
- Soften things with excessive hedging: ~~"You might want to potentially consider..."~~
- Use English buzzwords untranslated in Hebrew copy

### Tone by Context
| Context | Tone |
|---|---|
| Website hero / landing pages | Confident, energizing, action-oriented |
| Course materials | Clear, structured, patient, step-by-step |
| Social media (LinkedIn, etc.) | Direct, opinionated, occasionally provocative |
| Email / nurture | Warm, personal, conversational |
| Sales pages | Focused on outcomes and transformation |

---

## Taglines

| Type | Text |
|---|---|
| **Primary** | Build Smarter. Ship Faster. Teach Better. |
| **Sub-tagline** | AI expertise, from idea to production. |
| **Code variant** | `// Your AI. Your advantage.` |
| **Short** | Build the Future |
| **Hebrew primary** | לבנות חכם יותר. לשלוח מהר יותר. ללמד טוב יותר. |

---

## UI Components

### Buttons

| Variant | Background | Text | Border | Usage |
|---|---|---|---|---|
| Primary | `#C8922A` | `#FFFFFF` | none | Main CTA |
| Secondary | transparent | `#D4A84B` | 1px `#3D2E10` | Secondary action |
| Ghost | `#2E2820` | `#C8BFB0` | 0.5px `#3D3528` | Tertiary / nav |

- Border-radius: 8px
- Padding: 12px 24px
- Font: Syne 600, 13px, letter-spacing +0.04em
- Include directional arrow `→` on primary CTAs

### Tags / Badges

| Variant | Background | Text |
|---|---|---|
| Mustard | `#3D2E10` | `#D4A84B` |
| Teal | `rgba(0,212,170,0.12)` | `#00D4AA` |
| Amber | `rgba(255,183,77,0.12)` | `#FFB74D` |

- Border-radius: 100px (pill)
- Padding: 5px 12px
- Font: DM Mono 400, 10px, uppercase, +0.10em tracking

### Cards

- Background: `#2E2820`
- Border: 0.5px solid `#3D3528`
- Border-radius: 12px
- Padding: 24px
- Eyebrow: DM Mono, 11px, `#C8922A`, uppercase, +0.14em tracking
- Title: Exo 2 700, 18px, `#F5F0E8`
- Body: Heebo 300, 15px, `#C8BFB0`, 1.65 line-height

### Dividers
- 0.5px solid `#2A2A3E`
- Never use thicker dividers

### Section labels (numbered)
- Pattern: `01 — Section Name`
- Font: DM Mono 400, 10px, uppercase, +0.18em tracking, `#6B6F8A`
- Margin-bottom: 20px before section content

---

## Spacing & Layout

### Spacing Scale
| Token | Value | Usage |
|---|---|---|
| xs | 8px | Component-internal gaps |
| sm | 12px | Between related elements |
| md | 16px | Between components |
| lg | 24px | Card padding, section internal |
| xl | 48px | Between sections |
| 2xl | 80px | Page-level vertical rhythm |

### Layout Grid
- Max content width: 1200px
- Gutter: 24px (mobile), 40px (desktop)
- Columns: 12-column grid, 20px gap
- Section padding: 80px top/bottom (desktop), 48px (mobile)

---

## Iconography

- Style: Line icons, 1.5px stroke, rounded line-caps
- Size: 16px (inline), 24px (UI), 32px (feature icons)
- Color: Inherits from context — Electric for active/CTA, Silver for neutral, Teal for success
- Recommended library: Lucide Icons (matches the geometric brand aesthetic)

---

## Motion & Animation

- Easing: `cubic-bezier(0.16, 1, 0.3, 1)` — fast in, slow settle
- Duration: 200ms (micro), 400ms (transition), 600ms (entrance)
- Page entrances: staggered fade-up (`translateY(16px)` → `0`, opacity `0` → `1`)
- Hover on cards: `transform: translateY(-2px)`, border brightens to `#3A3A5C`
- No spinning loaders — use skeleton screens or pulse animations
- Respect `prefers-reduced-motion`

---

## Assets Checklist

When building out the full asset library, produce the following:

- [ ] Logo SVG — full, dark background
- [ ] Logo SVG — full, light background  
- [ ] Logo SVG — mark only
- [ ] Logo PNG exports — 1x and 2x for each variant
- [ ] Favicon — 32×32 and 64×64
- [ ] OG image template (1200×630)
- [ ] LinkedIn banner (1584×396)
- [ ] Business card (front + back)
- [ ] Email signature
- [ ] Presentation template (16:9)
- [ ] Social post templates (square + story)
- [ ] Course card template

---

*Onyx AI Brand System · v1.0 · 2026*
