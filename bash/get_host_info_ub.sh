#!/bin/bash

# Get current date and time
current_datetime=$(date '+%Y-%m-%d %H:%M:%S')

# Get hostname
hostname=$(hostname)

# Get IP addresses
ip_addresses=$(ip addr | awk '/inet / {print $2}')

# Get OS version
os_version=$(lsb_release -a 2>/dev/null | grep Description | awk -F'\t' '{print $2}' | tr -d '\n')

# Get BIOS version
bios_version=$(dmidecode -s bios-version 2>/dev/null)

# Get serial number
serial_number=$(dmidecode -s system-serial-number 2>/dev/null)

# Get installed patches
installed_patches=$(apt list --installed 2>/dev/null)

# Get installed software
installed_software=$(dpkg --get-selections)

# Construct JSON
json_data=$(cat <<EOF
{
  "DateTime": "$current_datetime"  
  "Hostname": "$hostname",
  "IPAddresses": "$ip_addresses",
  "OSVersion": "$os_version",
  "BIOSVersion": "$bios_version",
  "SerialNumber": "$serial_number",
  "InstalledPatches": "$installed_patches",
  "InstalledSoftware": "$installed_software",

}
EOF
)

# Write JSON to file
json_filename="${hostname}_system_info.json"
echo "$json_data" > system_details.json

echo "System details have been saved to system_details.json"
