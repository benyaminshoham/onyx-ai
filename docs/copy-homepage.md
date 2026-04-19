# Homepage Copy — Onyx AI
**Rewritten with marketing-copy skill. Structure references for re-injection into `mockups/homepage.html`.**

---

## S01 — Hero
`section#hero`

| Field | Element | Copy |
|---|---|---|
| Section label | `.label` | `01 — ברוכים הבאים` |
| Headline line 1 | `h1` (plain) | `פחות עבודה ידנית.` |
| Headline line 2 | `h1 > span.hero-accent` (Electric color) | `יותר תוצאות.` |
| Subheading | `p.hero-sub` | `קורסים, ייעוץ, ואוטומציות AI — למפתחים שרוצים להפוך ל-AI-native, ולבעלי עסקים שרוצים לחסוך 10+ שעות בשבוע.` |
| CTA primary | `a.btn.btn-primary` | `אני מפתח/ת — בוא/י נבנה →` |
| CTA secondary | `a.btn.btn-secondary` | `אני בעל/ת עסק — רוצה לחסוך →` |
| Tagline (small, mono, below CTAs) | `p.hero-tagline` | `Build Smarter · Ship Faster · Teach Better` |

**Headline alternatives (A/B test):**
- Alt A: `פחות עבודה ידנית.` / `יותר תוצאות.`
- Alt B: `500+ מפתחים ועסקים כבר` / `עובדים עם AI. את/ה הבא/ה?`

---

## S02 — Audience Fork
`section#fork`

| Field | Element | Copy |
|---|---|---|
| Section label | `.label` | `02 — מה מחפשים?` |
| **Card 1 — Developer** | `.fork-card:first-child` | |
| Card title | `h3` | `אני מפתח/ת` |
| Card body | `p` | `ה-developers שמשלבים AI בקוד שלהם שולחים מהר יותר ושווים יותר לשוק. נהפוך אותך לאחד מהם — עם Claude API, MCP, ו-Cursor.` |
| Card link | `a.fork-link` | `לקורסים ולייעוץ למפתחים →` |
| **Card 2 — Business** | `.fork-card:last-child` | |
| Card title | `h3` | `אני בעל/ת עסק` |
| Card body | `p` | `עסקים שמאמצים AI חוסכים 10+ שעות עבודה בשבוע — בלי לגייס, בלי ידע בתכנות. נבנה לך את האוטומציות ביחד.` |
| Card link | `a.fork-link` | `לאוטומציה עסקית →` |

---

## S03 — Pillars
`section#pillars`

| Field | Element | Copy |
|---|---|---|
| Section label | `.label` | `03 — מה עושים כאן` |
| **Pillar 1** | `.pillar:nth-child(1)` | |
| Title | `h4` | `בנייה` |
| Body | `p` | `מוצרי AI שעובדים — מהרעיון הראשון ועד production, מהיר ומדויק.` |
| **Pillar 2** | `.pillar:nth-child(2)` | |
| Title | `h4` | `הוראה` |
| Body | `p` | `קורסים מעשיים שמשנים איך אתה עובד — לא תיאוריה, רק מה שעובד בשטח.` |
| **Pillar 3** | `.pillar:nth-child(3)` | |
| Title | `h4` | `אוטומציה` |
| Body | `p` | `תהליכים עסקיים שרצים לבד, 24/7 — בלי כוח אדם נוסף, בלי טעויות אנוש.` |
| **Pillar 4** | `.pillar:nth-child(4)` | |
| Title | `h4` | `ייעוץ` |
| Body | `p` | `ליווי אישי מהאסטרטגיה להטמעה — כי AI נכון לעסק שלך לא נראה כמו AI נכון לאחר.` |

---

## S04 — Social Proof
`section#proof`

| Field | Element | Copy |
|---|---|---|
| Section label | `.label` | `04 — במספרים` |
| **Stat 1** | `.stats-row > div:nth-child(1)` | |
| Number | `.stat-n` | `500+` |
| Label | `.stat-lbl` | `מקצוענים הוכשרו` |
| **Stat 2** | `.stats-row > div:nth-child(2)` | |
| Number | `.stat-n` | `50+` |
| Label | `.stat-lbl` | `עסקים שאוטמטו` |
| **Stat 3** | `.stats-row > div:nth-child(3)` | |
| Number | `.stat-n` | `15+` |
| Label | `.stat-lbl` | `שנה בפיתוח והוראה` |
| **Quote 1** | `.quote-card:nth-child(1)` | |
| Quote text | `p.quote-text` | `"תוך שבועיים שיפרתי את הפרודוקטיביות שלי פי 3. שיניתי לגמרי את הדרך שאני כותב קוד. זה לא מוגזם."` |
| Attribution | `.quote-by` | `דניאל כ. — מפתח Full Stack` |
| **Quote 2** | `.quote-card:nth-child(2)` | |
| Quote text | `p.quote-text` | `"חשבתי ש-AI זה לא בשבילי. אחרי הייעוץ עם בנימין אני מאוטמט 60% מהעבודה היומיומית שלי — ויש לי זמן לנהל עסק שוב."` |
| Attribution | `.quote-by` | `רחל מ. — בעלת סוכנות שיווק` |

---

## S05 — Featured Courses
`section#courses`

| Field | Element | Copy |
|---|---|---|
| Section label | `.label` | `05 — קורסים` |
| Section CTA | `.btn.btn-ghost` (below grid) | `לכל הקורסים →` |
| **Course 1** | `.course-card:nth-child(1)` | |
| Title | `.course-title` | `Claude API למפתחים` |
| Audience tag | `span.tag` (`tag-electric`) | `מפתחים` |
| Description | `p.course-desc` | `מ-API key ועד אפליקציה שרצה בproduction — Claude API, tool use, MCP, ו-agents. לא עוד תיאוריה.` |
| Price | `.course-price` | `₪890` |
| Price sub-label | `.course-price small` | `/ גישה עולמית` |
| CTA | `a.btn.btn-primary` | `לפרטים המלאים →` |
| **Course 2** | `.course-card:nth-child(2)` | |
| Title | `.course-title` | `AI לעסקים — מ-0 לאוטומציה` |
| Audience tag | `span.tag` (`tag-teal`) | `עסקים` |
| Description | `p.course-desc` | `חסוך/י 10+ שעות בשבוע — בלי לדעת לתכנת. בונים ביחד אוטומציות עם ChatGPT, Make, ו-Zapier שעובדות גם כשאתה לא.` |
| Price | `.course-price` | `₪690` |
| Price sub-label | `.course-price small` | `/ גישה עולמית` |
| CTA | `a.btn.btn-primary` | `לפרטים המלאים →` |
| **Course 3** | `.course-card:nth-child(3)` | |
| Title | `.course-title` | `Cursor — לפתח עם AI` |
| Audience tag | `span.tag` (`tag-electric`) | `מפתחים` |
| Description | `p.course-desc` | `שלח/י פיצ'רים ביום, לא בשבוע. Cursor ו-AI-assisted development — debug חכם, קוד מהיר, production לפני כולם.` |
| Price | `.course-price` | `₪490` |
| Price sub-label | `.course-price small` | `/ גישה עולמית` |
| CTA | `a.btn.btn-primary` | `לפרטים המלאים →` |

---

## S06 — Featured Service
`section#service`

| Field | Element | Copy |
|---|---|---|
| Section label | `.label` | `06 — שירות מובחר` |
| Status badge | `span.tag.tag-amber` | `פתוח לרישום` |
| Headline | `h2` | `Bootcamp AI לעסקים — 4 שבועות, אוטומציה אמיתית לעסק שלך` |
| Bullet 1 | `.s-bullets li:nth-child(1)` | `8 מפגשים חיים בזום — קבוצה אינטימית של עד 12 משתתפים, כי שאלות מקבלות תשובות` |
| Bullet 2 | `.s-bullets li:nth-child(2)` | `בונים ביחד אוטומציה שתחסוך 10+ שעות בשבוע — מותאמת אישית לעסק שלך` |
| Bullet 3 | `.s-bullets li:nth-child(3)` | `גישה לקהילה וחומרים גם לאחר הקורס — ההשקעה ממשיכה לעבוד` |
| CTA primary | `a.btn.btn-primary` | `שמור/י מקום עכשיו →` |
| Aside — price label | `.s-aside-lbl:nth-child(1)` | `מחיר לאדם` |
| Aside — price value | `.s-aside-val` | `₪1,490` |
| Aside — date label | `.s-aside-lbl:nth-child(3)` | `מועד הקרוב` |
| Aside — date value | `.s-aside-date` | `מאי 2026` |
| Aside — CTA | `a.btn.btn-secondary` | `שמור מקום` |

---

## S07 — Free Resources
`section#resources`

| Field | Element | Copy |
|---|---|---|
| Section label | `.label` | `07 — משאבים חינמיים` |
| Section CTA | `.btn.btn-ghost` (below grid) | `לכל המשאבים →` |
| **Resource 1** | `.res-card:nth-child(1)` | |
| Type badge | `.res-type` (teal) | `מאמר` |
| Title | `.res-title` | `10 אוטומציות AI שכל עסק צריך ב-2026` |
| Description | `p.res-desc` | `10 אוטומציות שאפשר להפעיל היום — ולא לחזור לאיך שעבדת אתמול.` |
| Link | `a.res-link` | `לקריאה` |
| **Resource 2** | `.res-card:nth-child(2)` | |
| Type badge | `.res-type` (electric-light) | `תבנית` |
| Title | `.res-title` | `Prompt Template Pack — Claude לעבודה יומיומית` |
| Description | `p.res-desc` | `20 פרומפטים שעובדים — לכתיבה, ניתוח, דיוורים, וסיכומי פגישות. להדביק ולרוץ.` |
| Link | `a.res-link` | `להורדה חינם` |
| **Resource 3** | `.res-card:nth-child(3)` | |
| Type badge | `.res-type` (amber) | `וידאו` |
| Title | `.res-title` | `Claude API בדקות — ההתחלה המהירה` |
| Description | `p.res-desc` | `סרטון 15 דקות: מ-API key ועד ה-call הראשון שרץ. אין תירוצים.` |
| Link | `a.res-link` | `לצפייה` |

---

## S08 — Newsletter
`section#newsletter`

| Field | Element | Copy |
|---|---|---|
| Section label | `.label` | `08 — ניוזלטר` |
| Headline | `h2` | `AI Update — מה שקורה, מה שעובד` |
| Body | `p` | `פעם בשבוע: כלי אחד שכדאי לנסות, טיפ שאפשר ליישם מחר, ותובנה ישירה מהשטח. ללא ספאם. ביטול בכל רגע.` |
| Input placeholder | `input[type="email"]` placeholder | `האימייל שלך` |
| Submit button | `button[type="submit"]` | `אני נרשם/ת →` |

---

## S09 — About Teaser
`section#about`

| Field | Element | Copy |
|---|---|---|
| Section label | `.label` | `09 — אודות` |
| Bio paragraph | `p.about-bio` | `בנימין הוא מפתח ותיק, מרצה, ויזם בהייטק הישראלי. 15+ שנה בפיתוח, 500+ סטודנטים, ו-50+ עסקים שליווה לאימוץ AI אמיתי — לא סמינרים, תוצאות.` |
| Credibility line | `p.about-cred` | `מפתח · מרצה · יזם · ישראל` |
| CTA | `a.btn.btn-ghost` | `על בנימין →` |
