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

### Step 2 — Export local database (excluding users and URL options)

```bash
# Export everything except wp_users / wp_usermeta
wp --path=/Users/benyamin/Documents/htdocs/onyx-ai db export /tmp/onyx-ai-data.sql \
  --exclude_tables=wp_users,wp_usermeta

# Strip the two URL options so they don't overwrite production values
sed -i '' "/INSERT INTO \`wp_options\`.*'siteurl'/d" /tmp/onyx-ai-data.sql
sed -i '' "/INSERT INTO \`wp_options\`.*'home'/d" /tmp/onyx-ai-data.sql
```

### Step 3 — Upload files to production

```bash
sshpass -p '&iJgxBR?R*' scp /tmp/onyx-ai-theme.zip  dh_qwdak4@vps63513.dreamhostps.com:/tmp/
sshpass -p '&iJgxBR?R*' scp /tmp/onyx-ai-blocks.zip dh_qwdak4@vps63513.dreamhostps.com:/tmp/
sshpass -p '&iJgxBR?R*' scp /tmp/onyx-ai-data.sql   dh_qwdak4@vps63513.dreamhostps.com:/tmp/
```

### Step 4 — Deploy theme and plugin on production

```bash
sshpass -p '&iJgxBR?R*' ssh dh_qwdak4@vps63513.dreamhostps.com "
  WP=/home/dh_qwdak4/ai.onyx-wp.com
  cd \$WP/wp-content/themes  && rm -rf onyx-ai  && unzip -q /tmp/onyx-ai-theme.zip
  cd \$WP/wp-content/plugins && rm -rf onyx-ai-blocks && unzip -q /tmp/onyx-ai-blocks.zip
  wp --path=\$WP theme  activate onyx-ai
  wp --path=\$WP plugin activate onyx-ai-blocks
  rm /tmp/onyx-ai-theme.zip /tmp/onyx-ai-blocks.zip
"
```

### Step 5 — Import database on production

```bash
sshpass -p '&iJgxBR?R*' ssh dh_qwdak4@vps63513.dreamhostps.com "
  WP=/home/dh_qwdak4/ai.onyx-wp.com
  wp --path=\$WP db import /tmp/onyx-ai-data.sql
  wp --path=\$WP cache flush
  rm /tmp/onyx-ai-data.sql
"
```

### Step 6 — Verify

```bash
sshpass -p '&iJgxBR?R*' ssh dh_qwdak4@vps63513.dreamhostps.com "
  WP=/home/dh_qwdak4/ai.onyx-wp.com
  wp --path=\$WP option get siteurl
  wp --path=\$WP option get home
  wp --path=\$WP theme  list
  wp --path=\$WP plugin list
"
```

---

## Notes

- **Never overwrite** `wp_users`, `wp_usermeta`, `siteurl`, or `home` — these hold production admin credentials and the live domain.
- Run search-replace for content URLs only if post content contains hardcoded `localhost:8888/onyx-ai` references:
  ```bash
  wp --path=$WP search-replace 'http://localhost:8888/onyx-ai' 'http://ai.onyx-wp.com' --skip-columns=guid
  ```
- All wp-cli commands on production require `--path=/home/dh_qwdak4/ai.onyx-wp.com`.
