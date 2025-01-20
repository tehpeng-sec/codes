#!/bin/bash

file_name="largefile.txt"

# Get the file size
file_size=$(stat -c%s "$file_name")

# Display File Size
echo "The size of $file_name is $file_size"
echo ""

# Display Current Permissions
current_permissions=$(ls -l "$file_name")
echo "The current file permission is following: $current_permissions"
echo ""
        
if [ "$file_size" -lt 2000 ]; then

    chmod 760 "$file_name"
        echo "The file permission has been changed. The new file permission are as follow."
        ls -l "$file_name"
        echo ""
        
else
    
    days_elapsed=$(( ( $(date +%s) - $(date -d "2024-01-01" +%s) ) / 86400 ))
    
    echo "Days elapsed are $days_elapsed."

fi