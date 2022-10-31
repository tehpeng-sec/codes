#!/bin/bash

TIMESTAMP=`date +%Y%m%d`
HOSTNAME=`hostname`
FILENAME="${HOSTNAME}_${TIMESTAMP}.txt"

sha1sum /home/adminsys/* > $FILENAME
ls -lh "$FILENAME"
cat "$FILENAME"
