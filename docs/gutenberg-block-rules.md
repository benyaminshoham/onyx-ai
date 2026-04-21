# Gutenberg Block Format Rules

Rules that must be followed every time a custom block is built or modified.

---

## 1. Static vs Dynamic Blocks

**Static block** — `save()` returns JSX. WordPress stores the rendered HTML alongside the block comment. The editor validates stored HTML against `save()` on every load. Any mismatch triggers "Attempt recovery".

**Dynamic block (SSR)** — `save()` returns `null`. WordPress stores only the block comment with attributes. PHP `render.php` generates HTML on every page request. **No validation errors ever.**

### Rule: prefer dynamic (SSR) blocks

Use `render.php` + `save() { return null; }` for any block whose output depends on attributes. Only use static `save()` when the block is purely structural (e.g., a container with inner blocks whose content changes via child blocks, not PHP logic).

---

## 2. Adding `render.php` to a Block

In `block.json`:
```json
{
  "render": "file:./render.php",
  "editorScript": "file:./index.js"
}
```

In `index.js`:
```js
save() {
  return null;
},
```

`render.php` receives `$attributes`, `$content`, `$block`:
```php
<?php
$title = isset( $attributes['title'] ) ? $attributes['title'] : '';
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
  <h2><?php echo esc_html( $title ); ?></h2>
</div>
```

Use `get_block_wrapper_attributes()` — it adds the `wp-block-{namespace}-{name}` class and any `supports` classes automatically.

---

## 3. Updating a Static Block to SSR

When converting an existing static block that already has saved HTML in the DB:

1. Add `render.php` + set `save() = null` + rebuild
2. **Remove the stored HTML from post_content** — the block comment must become self-closing:
   - Before: `<!-- wp:name {...} --><div>...</div><!-- /wp:name -->`
   - After: `<!-- wp:name {...} /-->`
3. Write to DB with `$wpdb->update()` **not** `wp_update_post()` — the latter calls `wp_unslash()` which strips backslashes from JSON, making it invalid.

---

## 4. Block Comment Attribute JSON

The block comment stores attributes as JSON: `<!-- wp:name {"key":"value"} /-->`.

### Critical rule: always write via `$wpdb->update()` when content contains JSON

`wp_update_post()` internally calls `wp_unslash()`, which strips all backslashes from `post_content`. This corrupts JSON strings that contain escaped double quotes (e.g., HTML attributes inside string values: `class=\"foo\"`).

**Wrong:**
```php
wp_update_post( [ 'ID' => $id, 'post_content' => $content ] ); // strips \" → "
```

**Correct:**
```php
global $wpdb;
$wpdb->update( $wpdb->posts, [ 'post_content' => $content ], [ 'ID' => $id ] );
wp_cache_delete( $id, 'posts' );
```

### Always validate JSON before writing

```php
$json = wp_json_encode( $attrs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
$decoded = json_decode( $json, true );
assert( $decoded !== null, 'JSON encode failed' );
```

---

## 5. Attribute HTML Values

When a block attribute stores HTML (e.g., a headline with `<span>` tags), use `RichText` in the editor and `wp_kses_post()` in render.php output:

```php
echo wp_kses_post( $attributes['headline'] );
```

Never use `esc_html()` on HTML-containing attributes — it escapes the tags.

---

## 6. Block Validation Errors ("Attempt recovery")

| Cause | Fix |
|-------|-----|
| `save()` output doesn't match stored HTML | Convert block to SSR (`render.php`) |
| New attributes added to `save()` but stored HTML doesn't have them | Add `deprecated` entry OR convert to SSR |
| Stored HTML exists but `save()` returns `null` | Remove stored HTML from post_content, make comment self-closing |
| Block comment JSON is invalid (unescaped quotes) | Write attributes via `$wpdb->update()`, validate JSON |

---

## 7. Deprecations (for static blocks only)

When you must change `save()` output of a static block without SSR, add a `deprecated` entry so the editor can migrate old content:

```js
registerBlockType( metadata.name, {
  deprecated: [
    {
      attributes: { /* old attribute schema */ },
      save( { attributes } ) {
        // old save() output
      },
    },
  ],
  save( { attributes } ) {
    // new save() output
  },
} );
```

---

## 8. Block Registration Checklist

Before committing a new or modified block:

- [ ] `block.json` has `"render": "file:./render.php"` (for dynamic blocks)
- [ ] `save()` returns `null` when using `render.php`
- [ ] `render.php` uses `get_block_wrapper_attributes()` for the wrapper element
- [ ] All output in `render.php` is escaped (`esc_html`, `esc_url`, `wp_kses_post`)
- [ ] Block comment JSON is valid — test with `json_decode()`
- [ ] Post content written via `$wpdb->update()` if it contains JSON block comments
- [ ] After rebuild, verify no "Attempt recovery" appears in the block editor
- [ ] Front-end output matches mockup after SSR conversion
