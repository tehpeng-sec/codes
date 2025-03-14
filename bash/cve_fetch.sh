#!/bin/bash

# Get the current date in UTC (ISO 8601 format)
end_date=$(date -u +"%Y-%m-%dT%H:%M:%S.%3NZ")

# Get the date 30 days ago in UTC (ISO 8601 format)
start_date=$(date -u -v-30d +"%Y-%m-%dT%H:%M:%S.%3NZ")

# NVD API URL
BASE_URL="https://services.nvd.nist.gov/rest/json/cves/2.0"

# Make API request using curl
response=$(curl -s "${BASE_URL}?pubStartDate=${start_date}&pubEndDate=${end_date}")

# Extract totalResults (total number of CVEs) using jq
total_cves=$(echo "$response" | jq -r '.totalResults')

# Print the result
echo "Total CVEs in the past 30 days: $total_cves"