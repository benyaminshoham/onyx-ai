# Onyx AI — Website Plan
**Version 2.0 · 2026**

---

## Strategic Overview

The site is organized around three user audiences — not service types. Each audience has a dedicated hub page presenting the services most relevant to them. The homepage establishes who Benyamin is and immediately routes each visitor to their path.

"Group activities" — workshops and monthly group programs — are referred to as **סדנאות** and **תהליכים**, never "courses" or "קורסים".

The **main site** (homepage, audience hubs, services, blog, resources) is built for SEO, credibility, and organic traffic. **Landing pages** (`/lp/*`) are isolated conversion pages for paid and social campaigns — no nav, one CTA, one offer.

---

## Audience Segments

| Audience | Hebrew | What they need |
|---|---|---|
| Developers | מפתחים | Integrate AI into their code, tools, and workflow |
| Business owners | בעלי עסקים | Use AI to save time and automate daily operations |
| Companies & organizations | חברות וארגונים | Roll out AI adoption across a team or entire company |

---

## Services Overview

All seven services are organized into two formats:

### תהליכים קבוצתיים (Group Programs)

| Service | Hebrew | Format | Audience |
|---|---|---|---|
| התנעה לעסקים | Launch for Business | Half-day workshop | Business owners |
| התנעה למפתחים | Launch for Developers | Half-day workshop | Developers |
| האצה לעסקים | Acceleration for Business | Monthly group program | Business owners |
| האצה למפתחים | Acceleration for Developers | Monthly group program | Developers |

### עבודה אישית (Personal Work)

| Service | Hebrew | Format | Audience |
|---|---|---|---|
| ליווי | Mentoring | Ongoing, hourly | All |
| ייעוץ | Consulting | Focused sessions, hourly | All |
| פיתוח | Development | Project-based | All |

---

## Site Map

### 1. Homepage — `/`

**Purpose:** Universal entry. Establish credibility, present all services, and route each visitor to their audience path.

**Sections:**

1. **Hero** — Three-line headline, audience-fork CTAs
2. **Audience fork** — Three path cards: מפתחים · בעלי עסקים · חברות וארגונים
3. **What Benyamin does** — Four pillars: Building / Teaching / Automating / Consulting
4. **Social proof** — Numbers + 2 testimonials
5. **Group programs** — 4 cards (the 4 group תהליכים), organized by audience
6. **Personal work** — 3 cards (ליווי · ייעוץ · פיתוח)
7. **Featured program** — Spotlight on the current open group program
8. **Free resources teaser** — 3 cards
9. **Newsletter opt-in** — Single field, specific hook
10. **About teaser** — Photo, 2-line bio, link to full About
11. **Footer**

---

### 2. Developers Hub — `/developers`

**Purpose:** Central destination for all developer-facing services. Where a developer lands after clicking through from a social post, ad, or the homepage fork.

**Sections:**
- Hero — developer-specific headline and positioning
- Their journey — the progression: התנעה → האצה → ליווי
- Group programs — התנעה למפתחים + האצה למפתחים cards with full detail
- Personal services — ייעוץ + ליווי + פיתוח cards
- Proof — developer-specific testimonials or results
- FAQ — format, prerequisites, tools used (Cursor, Claude API, MCP)
- CTA — book a call or join the next group

**SEO targets:** "קורס AI למפתחים", "Cursor סדנה", "Claude API ישראל", "AI assisted development"

---

### 3. Business Owners Hub — `/business`

**Purpose:** Central destination for all business-facing services.

**Sections:**
- Hero — business-owner-specific headline and positioning
- Their journey — התנעה → האצה → ליווי progression
- Group programs — התנעה לעסקים + האצה לעסקים cards with full detail
- Personal services — ייעוץ + ליווי cards (פיתוח if applicable)
- Proof — business-owner testimonials
- FAQ — no technical background needed, what tools are used, ROI expectations
- CTA — join next workshop or book consultation

**SEO targets:** "AI לעסקים קטנים", "אוטומציה עסקית", "ייעוץ AI ישראל", "ChatGPT לעסקים"

---

### 4. Companies & Organizations — `/organizations`

**Purpose:** Larger teams and companies looking for structured AI adoption — team workshops, strategic consulting, and custom development.

**Sections:**
- Hero — organizational framing: rolling out AI across a team, not just one person
- What we build together — three paths: סדנה לצוות · ייעוץ אסטרטגי · פיתוח מותאם
- Services — ייעוץ + ליווי + פיתוח presented with organizational scope
- Proof — results or case studies from company-level work
- Process — how an engagement works from first call to delivery
- CTA — "ספרו לי על הצוות שלכם" — discovery call

**Note:** No group programs in this path. Organizations get tailored scope via ייעוץ, ליווי, and פיתוח.

**SEO targets:** "הטמעת AI בארגון", "AI לצוותים", "ייעוץ AI לחברות", "סדנת AI לצוות"

---

### 5. Services Index — `/services`

**Purpose:** SEO-friendly overview of all seven services. Not a sales page — a clear index that helps visitors understand the full offering and choose their path.

**Sections:**
- Short intro — "כל הדרכים לעבוד יחד"
- Group programs grid — 4 cards with audience tags, format, and links
- Personal work grid — 3 cards with audience tags, format, and links
- Audience filter — toggle to filter by מפתחים / עסקים / ארגונים / הכל

**Individual service pages:** `/services/[slug]`

| Service | URL |
|---|---|
| התנעה לעסקים | `/services/hatanaa-business` |
| התנעה למפתחים | `/services/hatanaa-developers` |
| האצה לעסקים | `/services/haatza-business` |
| האצה למפתחים | `/services/haatza-developers` |
| ליווי | `/services/livui` |
| ייעוץ | `/services/yaauts` |
| פיתוח | `/services/pitua` |

Each service page is a full sales page (see Landing Page structure) but with the main site nav intact.

---

### 6. About — `/about`

**Purpose:** Trust and authority. Where both audiences come to decide if Benyamin is credible.

**Sections:**
- Personal story — developer background, teaching history, why AI, why now
- Experience and credentials — 15+ years, 500+ trained, 50+ businesses
- What he believes about AI adoption in Israel
- All services overview — brief cards linking to relevant pages
- CTA — book a call / reach out / follow on LinkedIn

---

### 7. Blog — `/blog`

**Purpose:** Primary SEO engine. Long-form Hebrew content targeting both audience segments.

**Post pages:** `/blog/[post-slug]`
Every post ends with a contextual CTA — a relevant service page or newsletter opt-in. Never a generic footer CTA.

**SEO content clusters:**

| Cluster | Audience | Example topics |
|---|---|---|
| AI לעסקים | Business owners | אוטומציה לעסקים קטנים, AI לשיווק, חיסכון בזמן עם קלוד |
| AI למפתחים | Developers | Cursor, Claude API, MCP, AI code review |
| מדריכים מעשיים | Both | How-to guides for specific tools |
| דעות ומגמות | Both | Commentary, hot takes, industry trends |

---

### 8. Resources — `/resources`

**Purpose:** Free value hub. SEO-supporting and list-building.

**Resource types:**
- Articles with takeaways
- Downloadable templates and prompt packs
- Lead magnets (gated with email opt-in)
- Video walkthroughs

**Lead magnet pages:** `/resources/[magnet-slug]` — dedicated opt-in pages for social promotion.

---

### 9. Landing Pages — `/lp/[slug]`

**Purpose:** Paid ads and social campaign destinations. No main nav, single CTA, minimal footer (logo + legal only).

**Standard section structure:**

1. Hero — outcome headline, subheading, CTA above fold
2. Problem — what's hard right now
3. Solution — what this offering gives them
4. What's included — visual breakdown
5. Who it's for (and who it's NOT for)
6. Social proof — testimonials or results
7. About Benyamin — 3-line credibility block
8. FAQ — 3–5 targeted questions
9. Final CTA — with urgency or scarcity
10. Minimal footer

**Landing pages planned at launch:**

| Page | Audience | Offer |
|---|---|---|
| `/lp/hatanaa-business` | Business owners | התנעה לעסקים |
| `/lp/hatanaa-dev` | Developers | התנעה למפתחים |
| `/lp/haatza-business` | Business owners | האצה לעסקים |
| `/lp/haatza-dev` | Developers | האצה למפתחים |
| `/lp/livui` | All | ליווי אישי |
| `/lp/orgs` | Companies | Organizational engagement |

Additional `/lp/*` pages created per campaign.

---

### 10. Legal — `/privacy` and `/terms`

Standard pages. Linked from all footers including landing page minimal footers.

---

## Navigation

**Main nav (desktop):**
`למפתחים` · `לעסקים` · `לארגונים` · `בלוג` · `אודות` + Primary CTA button (current open program)

**Mobile nav:** Hamburger menu, same items, CTA pinned to bottom of drawer.

**Landing pages (`/lp/*`):** Nav suppressed. Logo only. Minimal footer.

**Footer (main site):**
- Col 1: Logo + tagline + social links
- Col 2: ניווט — Home · About · Blog · Resources
- Col 3: לפי קהל — למפתחים · לעסקים · לארגונים · שירותים
- Col 4: שירותים — 4 group programs + 3 personal services
- Bottom bar: © Onyx AI · Privacy · Terms · contact

---

## SEO Architecture

- Every page has a unique Hebrew `<title>` and `<meta description>`
- Blog and Resources use structured article markup
- Homepage targets: "בינה מלאכותית לעסקים", "AI למפתחים", "ייעוץ AI ישראל", "אוטומציה עסקית"
- `/developers` and `/business` audience hubs target category-level keywords
- Every post and resource links internally to at least one service page
- `/lp/*` and lead magnet pages are `noindex`

---

## Page Count at Launch

| Type | Count |
|---|---|
| Static pages (Home, About, Developers, Business, Organizations, Services index, Resources, Blog index, Privacy, Terms) | 10 |
| Individual service pages | 7 |
| Landing pages | 6 |
| Lead magnet opt-in pages | 1–2 |
| **Total** | **~25 pages** |

Blog posts and resource cards added continuously post-launch.

---

*Onyx AI · Website Plan · v2.0 · 2026*
