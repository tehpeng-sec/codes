#!/bin/bash

echo "Delete files older than 180 days"
#find /opt/hash/*.txt -type f -mtime +180 -delete 
#find /tmp/hash/*.txt -type f -mtime +180 -delete 
#find /tmp/hash/*.txt -type f -mtime +180 -delete

TIMESTAMP=`date +%Y%m%d`
HOSTNAME=`hostname`
FILENAME="${HOSTNAME}_${TIMESTAMP}.txt"
EXCLUDED="${HOSTNAME}_excluded_${TIMESTAMP}.txt"
RESULT="${HOSTNAME}_Result_${TIMESTAMP}.txt"

echo "Starting"

#create/overwrite new txt files
cat /dev/null > $FILENAME
cat /dev/null > $EXCLUDED
cat /dev/null > $RESULT

#using find command to generate a list of files excluding /sys and /proc which are virtual filesystem
ARRAY=`find / -regextype posix-extended -regex "/(sys|proc)" -prune -o -type f`

filecount=0

echo "Hashing all files to SHA1, SHA256 and MD5"
echo "Please be patient as this will take a while ..."
for i in $ARRAY; do
	#echo $i

	((filecount++))

	#md5 hash output for files, length of md5 is 32 hex
	md5sum  "$i" 2>> $EXCLUDED | head -c 33 >> $FILENAME

	#sha1 hash output for files, length of sha1 is 40 hex
	sha1sum "$i" 2>> $EXCLUDED | head -c 41 >> $FILENAME
		
	#sha256 hash output for files
	sha256sum "$i" >> $FILENAME 2>> $EXCLUDED
done
echo "Processed $filecount files"

echo "Comparing hashes..."
#remove blank line in hash.txt as it will affect the grep
grep -w --color=always --file hash.txt $FILENAME > $RESULT
echo "Completed"
ls -lh "$RESULT"
cat "$RESULT"
