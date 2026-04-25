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
sshpass -p '&iJgxBR?R*' ssh dh_qwdak4@vps63513.dreamhostps.com "<command>"
sshpass -p '&iJgxBR?R*' scp <local> dh_qwdak4@vps63513.dreamhostps.com:<remote>
```

---

## Deployment Process

### What to deploy
- Theme: `wp-content/themes/onyx-ai`
- Plugin: `wp-content/plugins/onyx-ai-blocks`
- Database: all tables **except** `wp_users`, `wp_usermeta`, and the two URL options (`siteurl`, `home`) in `wp_options`

### Step 1 — Package theme and plugin

```bash
cd /Users/benyamin/Documents/htdocs/onyx-ai/wp-content/themes
zip -r /tmp/onyx-ai-theme.zip onyx-ai --exclude "*.DS_Store" --exclude "__MACOSX*"

cd /Users/benyamin/Documents/htdocs/onyx-ai/wp-content/plugins
zip -r /tmp/onyx-ai-blocks.zip onyx-ai-blocks --exclude "*.DS_Store" --exclude "__MACOSX*"
```

### Step 2 — Export local database and rewrite table prefix

Local uses `wp_`, production uses `wp_dj9fjq_`. The prefix must be rewritten before import.

```bash
# Export everything except wp_users / wp_usermeta
wp --path=/Users/benyamin/Documents/htdocs/onyx-ai db export /tmp/onyx-ai-data.sql \
  --exclude_tables=wp_users,wp_usermeta

# Rewrite all backtick-quoted table names: `wp_ → `wp_dj9fjq_
# Covers CREATE TABLE, INSERT INTO, DROP TABLE, LOCK TABLES (mysqldump always quotes table names)
sed 's/`wp_/`wp_dj9fjq_/g' /tmp/onyx-ai-data.sql > /tmp/onyx-ai-data-prod.sql
```

### Step 3 — Upload files to production

```bash
sshpass -f /tmp/ssh_pass scp /tmp/onyx-ai-theme.zip    dh_qwdak4@vps63513.dreamhostps.com:/tmp/
sshpass -f /tmp/ssh_pass scp /tmp/onyx-ai-blocks.zip   dh_qwdak4@vps63513.dreamhostps.com:/tmp/
sshpass -f /tmp/ssh_pass scp /tmp/onyx-ai-data-prod.sql dh_qwdak4@vps63513.dreamhostps.com:/tmp/onyx-ai-data.sql
```

### Step 4 — Deploy theme and plugin on production

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

### Step 5 — Import database on production

Production DB prefix is `wp_dj9fjq_`. The SQL was already rewritten in Step 2.

```bash
sshpass -f /tmp/ssh_pass ssh dh_qwdak4@vps63513.dreamhostps.com "
  WP=\$HOME/ai.onyx-wp.com

  # Save production URLs before import
  SITEURL=\$(wp --path=\$WP option get siteurl)
  HOME_URL=\$(wp --path=\$WP option get home)

  # Drop old wp_dj9fjq_ tables (keep users/usermeta) and any stray wp_ tables
  wp --path=\$WP db query 'DROP TABLE IF EXISTS
    \`wp_dj9fjq_commentmeta\`, \`wp_dj9fjq_comments\`, \`wp_dj9fjq_links\`,
    \`wp_dj9fjq_options\`, \`wp_dj9fjq_postmeta\`, \`wp_dj9fjq_posts\`,
    \`wp_dj9fjq_term_relationships\`, \`wp_dj9fjq_term_taxonomy\`,
    \`wp_dj9fjq_termmeta\`, \`wp_dj9fjq_terms\`;'

  wp --path=\$WP db import /tmp/onyx-ai-data.sql

  # Restore production URLs (import overwrites them with local values)
  wp --path=\$WP option update siteurl \"\$SITEURL\"
  wp --path=\$WP option update home \"\$HOME_URL\"
  wp --path=\$WP search-replace 'http://localhost:8888/onyx-ai' \"\$SITEURL\" --skip-columns=guid --quiet
  wp --path=\$WP cache flush
  rm /tmp/onyx-ai-data.sql
"
```

### Step 6 — Verify

```bash
sshpass -f /tmp/ssh_pass ssh dh_qwdak4@vps63513.dreamhostps.com "
  WP=\$HOME/ai.onyx-wp.com
  wp --path=\$WP db query 'SHOW TABLES;'
  wp --path=\$WP option get siteurl
  wp --path=\$WP option get home
  wp --path=\$WP theme  list --fields=name,status
  wp --path=\$WP plugin list --fields=name,status
"
```

---

## Notes

- **Production DB prefix is `wp_dj9fjq_`** — always rewrite the local `wp_` prefix before import (Step 2).
- **Never overwrite** `wp_dj9fjq_users`, `wp_dj9fjq_usermeta`, `siteurl`, or `home` — these hold production admin credentials and the live domain.
- All wp-cli commands on production use `--path=$HOME/ai.onyx-wp.com` (not a hardcoded `/home/...` path).
