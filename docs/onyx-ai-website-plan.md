# Onyx AI — Website Plan
**Version 3.0 · 2026**

---

## Strategic Overview

The site routes three distinct audiences — developers, business owners, and companies/organizations — each to a dedicated hub page that presents all relevant services and recorded courses in one place. The homepage establishes credibility and routes visitors. The blog drives SEO.

"Group activities" — workshops and monthly group programs — are referred to as **סדנאות** and **תהליכים**, never "courses" or "קורסים". Recorded video lessons sold online are referred to as **קורסים מוקלטים**.

---

## Audience Segments

| Audience | Hebrew | What they need |
|---|---|---|
| Developers | מפתחים | Integrate AI into their code, tools, and workflow |
| Business owners | בעלי עסקים | Use AI to save time and automate daily operations |
| Companies & organizations | חברות וארגונים | Roll out AI adoption across a team or entire company |

---

## Services Overview

All ten services are organized into three formats.

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

### שירותים ארגוניים (Organizational Services)

| Service | Hebrew | Format | Audience |
|---|---|---|---|
| הטמעה עסקית | Business AI Implementation | Custom project · per-project pricing | Companies & organizations |
| הטמעה טכנולוגית | Tech Team AI Implementation | Custom project · per-project pricing | CTOs, VP R&D, dev managers |
| תשתית AI | AI Infrastructure | Custom project · per-scope pricing | Organizations building internal AI capability |

---

## Recorded Courses (קורסים מוקלטים)

Recorded video lessons sold online. Displayed on audience pages using the **recorded-card** component. Each recording belongs to one or more audience segments and is shown only on the relevant audience page(s).

| Course | Audience | Price |
|---|---|---|
| Claude API למפתחים | Developers | ₪890 |
| Cursor — לפתח עם AI | Developers | ₪490 |
| AI לעסקים — מ-0 לאוטומציה | Business owners | ₪690 |

Additional recordings added post-launch.

---

## Site Map

### 1. Homepage — `/`

**Purpose:** Universal entry. Establish credibility, present all offerings, and route each visitor to their audience path.

**Sections:**

1. **Hero** — Three-line headline, audience-fork CTAs
2. **Audience fork** — Three path cards: מפתחים · בעלי עסקים · חברות וארגונים
3. **What Benyamin does** — Four pillars: Building / Teaching / Automating / Consulting
4. **Social proof** — Numbers + 2 testimonials
5. **Featured offerings** — 3 featured cards (mix of recordings and programs)
6. **Featured program** — Spotlight on the current open group program
7. **Free resources teaser** — 3 cards
8. **Newsletter opt-in** — Single field, specific hook
9. **About teaser** — Photo, 2-line bio, link to full About
10. **Footer**

---

### 2. Developers Hub — `/developers`

**Purpose:** Single destination for all developer-facing services and recordings. Where a developer lands after clicking from the homepage fork, a social post, or an ad.

**Sections:**

1. Hero — developer-specific headline and positioning
2. Journey — the progression: התנעה → האצה → ליווי
3. Group programs — התנעה למפתחים + האצה למפתחים (service-card)
4. Personal services — ליווי · ייעוץ · פיתוח (service-card)
5. Organizational — הטמעה טכנולוגית (service-card)
6. Recorded courses — developer recordings (recorded-card)
7. Testimonials — developer-specific
8. FAQ — tools used (Cursor, Claude API, MCP), prerequisites, format
9. CTA — book a call or join the next group

**SEO targets:** "קורס AI למפתחים", "Cursor סדנה", "Claude API ישראל", "AI assisted development"

---

### 3. Business Owners Hub — `/business`

**Purpose:** Single destination for all business-facing services and recordings.

**Sections:**

1. Hero — business-owner-specific headline and positioning
2. Journey — התנעה → האצה → ליווי progression
3. Group programs — התנעה לעסקים + האצה לעסקים (service-card)
4. Personal services — ליווי · ייעוץ (service-card)
5. Organizational — הטמעה עסקית (service-card)
6. Recorded courses — business recordings (recorded-card)
7. Testimonials — business-owner specific
8. FAQ — no technical background needed, what tools are used, ROI expectations
9. CTA — join next workshop or book consultation

**SEO targets:** "AI לעסקים קטנים", "אוטומציה עסקית", "ייעוץ AI ישראל", "ChatGPT לעסקים"

---

### 4. Companies & Organizations — `/organizations`

**Purpose:** Larger teams and companies looking for structured AI adoption.

**Sections:**

1. Hero — organizational framing: rolling out AI across a team
2. Organizational services — הטמעה עסקית · הטמעה טכנולוגית · תשתית AI (service-card, primary)
3. Supporting services — ייעוץ · ליווי · פיתוח with organizational scope (service-card)
4. Recorded courses — any org-relevant recordings (recorded-card)
5. Proof — results or case studies from company-level work
6. Process — how an engagement works from first call to delivery
7. FAQ — team size, timeline, what's included
8. CTA — "ספרו לי על הצוות שלכם" — discovery call

**SEO targets:** "הטמעת AI בארגון", "AI לצוותים", "ייעוץ AI לחברות", "סדנת AI לצוות"

---

### 5. About — `/about`

**Purpose:** Trust and authority. Where all audiences come to decide if Benyamin is credible.

**Sections:**

1. Personal story — developer background, teaching history, why AI, why now
2. Experience and credentials — 15+ years, 500+ trained, 50+ businesses
3. What he believes about AI adoption in Israel
4. Audience path overview — three cards linking to `/developers`, `/business`, `/organizations`
5. CTA — book a call / reach out / follow on LinkedIn

---

### 6. Blog — `/blog`

**Purpose:** Primary SEO engine. Long-form Hebrew content targeting both audience segments.

**Post pages:** `/blog/[post-slug]`

Every post ends with a contextual CTA — a relevant audience page or newsletter opt-in. Never a generic footer CTA.

**SEO content clusters:**

| Cluster | Audience | Example topics |
|---|---|---|
| AI לעסקים | Business owners | אוטומציה לעסקים קטנים, AI לשיווק, חיסכון בזמן עם קלוד |
| AI למפתחים | Developers | Cursor, Claude API, MCP, AI code review |
| מדריכים מעשיים | Both | How-to guides for specific tools |
| דעות ומגמות | Both | Commentary, hot takes, industry trends |

---

### 7. Terms & Privacy

- `/terms` — Terms of use
- `/privacy` — Privacy policy

Standard pages. Linked from all footers.

---

## Navigation

**Main nav (desktop):**
`למפתחים` · `לעסקים` · `לארגונים` · `בלוג` · `אודות` + Primary CTA button (current open program)

**Mobile nav:** Hamburger menu, same items, CTA pinned to bottom of drawer.

**Footer (main site):**
- Col 1: Logo + tagline + social links
- Col 2: ניווט — Home · About · Blog
- Col 3: לפי קהל — למפתחים · לעסקים · לארגונים
- Col 4: שירותים — 4 group programs + 3 personal services + 3 org services (linked to audience pages)
- Bottom bar: © Onyx AI · Privacy · Terms · contact

---

## SEO Architecture

- Every page has a unique Hebrew `<title>` and `<meta description>`
- Blog posts use structured article markup
- Homepage targets: "בינה מלאכותית לעסקים", "AI למפתחים", "ייעוץ AI ישראל", "אוטומציה עסקית"
- `/developers`, `/business`, `/organizations` target category-level keywords
- Every blog post links internally to at least one audience page

---

## Page Count at Launch

| Type | Count |
|---|---|
| Static pages (Home, About, Terms, Privacy) | 4 |
| Audience hub pages (Developers, Business, Organizations) | 3 |
| Blog index | 1 |
| **Total** | **8** |

Blog posts added continuously post-launch.

---

*Onyx AI · Website Plan · v3.0 · 2026*
