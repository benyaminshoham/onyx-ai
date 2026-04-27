# Deployment Guide — Onyx AI

## Production Server

| Property | Value |
|---|---|
| Domain | ai.onyx-wp.com |
| Host | vps63513.dreamhostps.com |
| SSH User | dh_qwdak4 |
| SSH Password | &iJgxBR?R* |
| Remote WordPress Root | /home/dh_qwdak4/ai.onyx-wp.com |

Connect via SSH:
```bash
ssh dh_qwdak4@vps63513.dreamhostps.com
# password: &iJgxBR?R*
```

Or use `sshpass` for scripted commands:
```bash
sshpass -f /tmp/ssh_pass ssh dh_qwdak4@vps63513.dreamhostps.com "<command>"
sshpass -f /tmp/ssh_pass scp <local> dh_qwdak4@vps63513.dreamhostps.com:<remote>
```

---

## Database policy

**Code deploys to production. Database never does.**

The production database contains live user accounts, admin credentials, and settings that must not be overwritten. Pushing the local database to production causes admin roles to break (option keys like `wp_dj9fjq_user_roles` get stomped by local values).

**To sync database: production → local only.**

---

## Releasing a version

Each release lives in `dist/<version>/` and contains:

| File | Purpose |
|---|---|
| `onyx-ai-theme-<version>.zip` | Production-ready theme package |
| `onyx-ai-blocks-<version>.zip` | Production-ready plugin package (no node_modules/src) |
| `deploy.sh` | Self-contained deploy script for this version |
| `RELEASE-NOTES.md` | Changelog and migration notes |

### To cut a new release

```bash
VERSION="1.0.x"
mkdir -p dist/$VERSION

# 1. Build assets
cd wp-content/plugins/onyx-ai-blocks && npm run build && cd -

# 2. Package theme
cd wp-content/themes
zip -r ../../dist/$VERSION/onyx-ai-theme-${VERSION}.zip \
  onyx-ai --exclude "*.DS_Store" --exclude "__MACOSX*"
cd -

# 3. Package plugin (strip dev files)
cd wp-content/plugins
zip -r ../../dist/$VERSION/onyx-ai-blocks-${VERSION}.zip \
  onyx-ai-blocks \
  --exclude "*.DS_Store" --exclude "__MACOSX*" \
  --exclude "onyx-ai-blocks/node_modules/*" \
  --exclude "onyx-ai-blocks/src/*" \
  --exclude "onyx-ai-blocks/package.json" \
  --exclude "onyx-ai-blocks/package-lock.json" \
  --exclude "onyx-ai-blocks/webpack.config.js"
cd -

# 4. Copy & update deploy.sh and RELEASE-NOTES.md from previous version, then edit
```

### To deploy a release

```bash
bash dist/<version>/deploy.sh
```

The script prompts for the SSH password on first run and caches it in `/tmp/ssh_pass` for the session.

### Tag the release in git

After a successful deploy, tag the commit and push the tag:

```bash
VERSION="1.0.x"
git tag "v${VERSION}" -m "Release v${VERSION}"
git push origin "v${VERSION}"
```

Tags are listed at `https://github.com/benyaminshoham/onyx-ai/tags`.

---

## Deployment Process (code only)

### What to deploy
- Theme: `wp-content/themes/onyx-ai`
- Plugin: `wp-content/plugins/onyx-ai-blocks`

### Step 1 — Package theme and plugin

```bash
# Write SSH password to temp file
echo -n '&iJgxBR?R*' > /tmp/ssh_pass

cd /Users/benyamin/Documents/htdocs/onyx-ai/wp-content/themes
zip -r /tmp/onyx-ai-theme.zip onyx-ai --exclude "*.DS_Store" --exclude "__MACOSX*"

cd /Users/benyamin/Documents/htdocs/onyx-ai/wp-content/plugins
zip -r /tmp/onyx-ai-blocks.zip onyx-ai-blocks \
  --exclude "*.DS_Store" \
  --exclude "__MACOSX*" \
  --exclude "onyx-ai-blocks/node_modules/*" \
  --exclude "onyx-ai-blocks/src/*" \
  --exclude "onyx-ai-blocks/package.json" \
  --exclude "onyx-ai-blocks/package-lock.json" \
  --exclude "onyx-ai-blocks/webpack.config.js"
```

### Step 2 — Upload files to production (sequentially — parallel scp corrupts zips)

```bash
sshpass -f /tmp/ssh_pass scp /tmp/onyx-ai-theme.zip dh_qwdak4@vps63513.dreamhostps.com:/tmp/
sshpass -f /tmp/ssh_pass scp /tmp/onyx-ai-blocks.zip dh_qwdak4@vps63513.dreamhostps.com:/tmp/
```

### Step 3 — Deploy theme and plugin on production

```bash
sshpass -f /tmp/ssh_pass ssh dh_qwdak4@vps63513.dreamhostps.com "
  WP=\$HOME/ai.onyx-wp.com
  rm -rf \$WP/wp-content/themes/onyx-ai    && unzip -q /tmp/onyx-ai-theme.zip  -d \$WP/wp-content/themes/
  rm -rf \$WP/wp-content/plugins/onyx-ai-blocks && unzip -q /tmp/onyx-ai-blocks.zip -d \$WP/wp-content/plugins/
  wp --path=\$WP theme  activate onyx-ai
  wp --path=\$WP plugin activate onyx-ai-blocks
  rm /tmp/onyx-ai-theme.zip /tmp/onyx-ai-blocks.zip
"
```

### Step 4 — Verify

```bash
sshpass -f /tmp/ssh_pass ssh dh_qwdak4@vps63513.dreamhostps.com "
  WP=\$HOME/ai.onyx-wp.com
  wp --path=\$WP option get siteurl
  wp --path=\$WP theme  list --fields=name,status
  wp --path=\$WP plugin list --fields=name,status
"
```

---

## Pull database from production to local

Use this when you need fresh production content locally.

```bash
echo -n '&iJgxBR?R*' > /tmp/ssh_pass

# Export on production (exclude users/usermeta — keep local dev account)
sshpass -f /tmp/ssh_pass ssh dh_qwdak4@vps63513.dreamhostps.com "
  WP=\$HOME/ai.onyx-wp.com
  wp --path=\$WP db export /tmp/onyx-ai-prod.sql --exclude_tables=wp_dj9fjq_users,wp_dj9fjq_usermeta
"

# Download
sshpass -f /tmp/ssh_pass scp dh_qwdak4@vps63513.dreamhostps.com:/tmp/onyx-ai-prod.sql /tmp/

# Rewrite prefix: wp_dj9fjq_ → wp_
sed 's/`wp_dj9fjq_/`wp_/g' /tmp/onyx-ai-prod.sql > /tmp/onyx-ai-local.sql

# Import locally (drop old tables first)
wp --path=/Users/benyamin/Documents/htdocs/onyx-ai db query '
  DROP TABLE IF EXISTS
    `wp_commentmeta`, `wp_comments`, `wp_links`,
    `wp_options`, `wp_postmeta`, `wp_posts`,
    `wp_term_relationships`, `wp_term_taxonomy`,
    `wp_termmeta`, `wp_terms`;'

wp --path=/Users/benyamin/Documents/htdocs/onyx-ai db import /tmp/onyx-ai-local.sql

# Restore local URLs
wp --path=/Users/benyamin/Documents/htdocs/onyx-ai option update siteurl 'http://localhost:8888/onyx-ai'
wp --path=/Users/benyamin/Documents/htdocs/onyx-ai option update home 'http://localhost:8888/onyx-ai'
wp --path=/Users/benyamin/Documents/htdocs/onyx-ai search-replace 'https://ai.onyx-wp.com' 'http://localhost:8888/onyx-ai' --skip-columns=guid --quiet
wp --path=/Users/benyamin/Documents/htdocs/onyx-ai cache flush

# Cleanup
sshpass -f /tmp/ssh_pass ssh dh_qwdak4@vps63513.dreamhostps.com "rm /tmp/onyx-ai-prod.sql"
rm /tmp/onyx-ai-prod.sql /tmp/onyx-ai-local.sql
```

---

## Notes

- **Never push the local DB to production** — it overwrites `wp_dj9fjq_user_roles` and other prefixed option keys with local values, breaking admin roles.
- **Parallel `scp` corrupts zips** — always upload files sequentially.
- **Production DB prefix is `wp_dj9fjq_`** — remember to rewrite prefix in both directions when pulling to local.
- All wp-cli commands on production use `--path=$HOME/ai.onyx-wp.com`.
