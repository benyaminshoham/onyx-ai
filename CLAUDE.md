# Onyx AI — Claude Instructions

## WordPress Development

When writing or reviewing any WordPress code (theme, plugin, blocks, or configuration),
always invoke the `anthropic-skills:wordpress-dev` skill first to load official coding
standards and best practices before producing any output.

## WordPress Site Management

**No MCP server is configured for this site.** Use `wp-cli` for all WordPress operations
(reading options, managing posts, flushing cache, running queries, etc.).

- Local site root: `/Users/benyamin/Documents/htdocs/onyx-ai`
- Run wp-cli commands from that directory, e.g. `wp option get siteurl`
- Never attempt to call WordPress MCP tools for this project.

---

## Project Reference Docs

Use these documents when relevant — don't load all of them for every task.

| File | When to use |
|---|---|
| [docs/brand.md](docs/brand.md) | Any task involving colors, typography, spacing, UI components, logo, voice, or visual design |
| [docs/onyx-ai-website-plan.md](docs/onyx-ai-website-plan.md) | Any task involving site structure, page layout, navigation, SEO strategy, or content planning |
| [docs/wordpress-implementation-plan.md](docs/wordpress-implementation-plan.md) | Any task involving theme architecture, block development, plugin choices, page build order, or WordPress configuration |
| [docs/gutenberg-block-rules.md](docs/gutenberg-block-rules.md) | **Required reading for every block build or modification** — static vs SSR blocks, render.php setup, block comment JSON rules, validation errors, `$wpdb->update()` vs `wp_update_post()` |
