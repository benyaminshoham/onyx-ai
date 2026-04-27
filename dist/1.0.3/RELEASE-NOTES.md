# Release Notes — v1.0.3

**Date:** 2026-04-27
**Type:** Code-only release (no database migration required)

---

## Mobile Support

- **Hamburger menu** — header navigation replaced with a hamburger icon on screens ≤900px; tapping opens a full-screen overlay drawer styled to match the Onyx AI dark theme
- **Footer grid** — forced 5-column footer grid now collapses to 2 columns at ≤768px and 1 column at ≤480px
- **Service spotlight** — card padding reduced from 48px to 24px on mobile (≤768px)
- **About teaser** — padding and gap reduced from 40px to 24px on mobile (≤768px)
- **Blog / service / resource grids** — added breakpoints for 2-column (≤960px) and 1-column (≤600px) layouts
- **Header CTA button** — hidden on ≤480px to keep the header uncluttered alongside the hamburger

## Bug Fixes

- **Horizontal scroll on mobile** — eliminated by adding `overflow-x: clip` to `.wp-site-blocks` and `max-width: 100%` to all media elements
- **Newsletter form** — input + button now stack vertically at ≤480px instead of overflowing
- **Tables & code blocks** — scroll horizontally within their own container on mobile rather than pushing page width

## Version Bumps

- Theme `style.css` and `ONYX_AI_THEME_VERSION` constant: `1.0.0` / `1.0.2` → `1.0.3`
- Plugin header and `ONYX_AI_BLOCKS_VERSION` constant: `1.0.0` / `1.0.1` → `1.0.3`

---

## Deployment

No migration script required — code files only.

```bash
bash dist/1.0.3/deploy.sh
```
