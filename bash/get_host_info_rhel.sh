#!/bin/bash

# Get date and time
date_time=$(date "+%Y-%m-%d %H:%M:%S")

# Get system information
hostname=$(hostname)
ip_addresses=$(hostname -I)
os_version=$(cat /etc/redhat-release)

# Get BIOS information
bios_version=$(dmidecode -s bios-version)
serial_number=$(dmidecode -s system-serial-number)

# Get installed patches
installed_patches=$(yum list installed)

# Get installed software
installed_software=$(rpm -qa)

# Create JSON structure
json_data=$(cat <<EOF
{
  "date_time": "$date_time"
  "hostname": "$hostname",
  "ip_addresses": "$ip_addresses",
  "os_version": "$os_version",
  "bios_version": "$bios_version",
  "serial_number": "$serial_number",
  "installed_patches": "$installed_patches",
  "installed_software": "$installed_software",

}
EOF
)

# Write JSON to a file
json_filename="$(hostname)_system_info.json"
echo "$json_data" > "$json_filename"

echo "System information has been saved to $json_filename"
