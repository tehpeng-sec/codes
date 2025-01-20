#!/bin/bash

# File Name Check
while true; do

    # Prompt for the file name
    echo "Please enter the name of the file:"
    read file_name
	echo ""

    # Check if the file exist in the folder
    if [ -f "$file_name" ]; then

        echo "The list of users are the following:"

        # Display the list of users
        awk -F':' '($7 == "/bin/bash" || $7 == "/bin/sh") {print $1}' "$file_name"
		echo ""

        echo "The user with the smallest UID is the following:"

        # Display the user with the smalles UID
        awk -F':' '($7 == "/bin/bash"|| $7 == "/bin/sh") {print $1,$3}' "$file_name" | sort -n | head -n 1
		echo ""

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
			
			# Change the permission of the File
            chmod 760 "$file_name"
            echo "The file permission has been changed. The new file permission are as follow."
			# Show the new permission
            ls -l "$file_name"
            echo ""
        
        else
			# Calculate the elapsed Days
            days_elapsed=$(( ( $(date +%s) - $(date -d "2024-01-01" +%s) ) / 86400 ))
            echo "Days elapsed are $days_elapsed."

        fi

        break
    else
        echo "The file is not in the folder. Please try again"
    fi
done
