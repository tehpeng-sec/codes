#!/bin/bash

# MySQL database credentials
DB_USER="root"
DB_PASSWORD="password"
DB_NAME="database_name"

# Backup directory
BACKUP_DIR="/var/backups/mysql"

# Create backup directory if it doesn't exist
if [ ! -d "$BACKUP_DIR" ]; then
  mkdir -p "$BACKUP_DIR"
fi

# Backup file name
BACKUP_FILE="$BACKUP_DIR/$(date +%Y-%m-%d_%H-%M-%S)_backup.sql"

# Backup command
mysqldump --user=$DB_USER --password=$DB_PASSWORD $DB_NAME > $BACKUP_FILE

# Compress backup file
gzip $BACKUP_FILE

# Delete backups older than 7 days
find $BACKUP_DIR/* -mtime +7 -exec rm {} \;
