#!/usr/bin/env bash
# Deploy script — Onyx AI v1.0.3
# Run from the repo root or from dist/1.0.3/
# Usage: bash dist/1.0.3/deploy.sh
set -euo pipefail

VERSION="1.0.3"
DIST_DIR="$(cd "$(dirname "$0")" && pwd)"
REMOTE_USER="dh_qwdak4"
REMOTE_HOST="vps63513.dreamhostps.com"
REMOTE_WP="\$HOME/ai.onyx-wp.com"
PASS_FILE="/tmp/ssh_pass"

THEME_ZIP="$DIST_DIR/onyx-ai-theme-${VERSION}.zip"
PLUGIN_ZIP="$DIST_DIR/onyx-ai-blocks-${VERSION}.zip"

# ── 0. Verify packages exist ────────────────────────────────────────────────
echo "==> Verifying packages..."
[ -f "$THEME_ZIP" ]  || { echo "ERROR: missing $THEME_ZIP";  exit 1; }
[ -f "$PLUGIN_ZIP" ] || { echo "ERROR: missing $PLUGIN_ZIP"; exit 1; }
echo "    theme:  $(du -h "$THEME_ZIP"  | cut -f1)"
echo "    plugin: $(du -h "$PLUGIN_ZIP" | cut -f1)"

# ── 1. SSH password ─────────────────────────────────────────────────────────
if [ ! -f "$PASS_FILE" ]; then
  echo "==> Writing SSH password to $PASS_FILE ..."
  read -rsp "SSH password for ${REMOTE_USER}@${REMOTE_HOST}: " SSH_PASS
  echo
  printf '%s' "$SSH_PASS" > "$PASS_FILE"
  chmod 600 "$PASS_FILE"
fi

SSH="sshpass -f $PASS_FILE ssh ${REMOTE_USER}@${REMOTE_HOST}"
SCP="sshpass -f $PASS_FILE scp"

# ── 2. Upload packages (sequentially — parallel scp corrupts zips) ──────────
echo "==> Uploading theme..."
$SCP "$THEME_ZIP"  "${REMOTE_USER}@${REMOTE_HOST}:/tmp/"
echo "==> Uploading plugin..."
$SCP "$PLUGIN_ZIP" "${REMOTE_USER}@${REMOTE_HOST}:/tmp/"

# ── 3. Deploy on production ─────────────────────────────────────────────────
echo "==> Deploying on production..."
$SSH "
  set -e
  WP=$REMOTE_WP

  echo '--- Replacing theme...'
  rm -rf \$WP/wp-content/themes/onyx-ai
  unzip -q /tmp/onyx-ai-theme-${VERSION}.zip -d \$WP/wp-content/themes/
  wp --path=\$WP theme activate onyx-ai

  echo '--- Replacing plugin...'
  rm -rf \$WP/wp-content/plugins/onyx-ai-blocks
  unzip -q /tmp/onyx-ai-blocks-${VERSION}.zip -d \$WP/wp-content/plugins/
  wp --path=\$WP plugin activate onyx-ai-blocks

  echo '--- Flushing cache...'
  wp --path=\$WP cache flush

  echo '--- Cleaning up...'
  rm /tmp/onyx-ai-theme-${VERSION}.zip /tmp/onyx-ai-blocks-${VERSION}.zip
"

# ── 4. Verify ────────────────────────────────────────────────────────────────
echo "==> Verifying..."
$SSH "
  WP=$REMOTE_WP
  wp --path=\$WP option get siteurl
  wp --path=\$WP theme  list --fields=name,status,version
  wp --path=\$WP plugin list --fields=name,status,version
"

echo ""
echo "✓ v${VERSION} deployed successfully."
