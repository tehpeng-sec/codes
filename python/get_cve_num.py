import requests
from datetime import datetime, timedelta

# Define the base URL for NIST NVD API
BASE_URL = "https://services.nvd.nist.gov/rest/json/cves/2.0"

# Get the date range (past 30 days)
end_date = datetime.utcnow().strftime("%Y-%m-%dT%H:%M:%S.%f")[:-3] + "Z"
start_date = (datetime.utcnow() - timedelta(days=30)).strftime("%Y-%m-%dT%H:%M:%S.%f")[:-3] + "Z"

# Define query parameters
params = {
    "pubStartDate": start_date,
    "pubEndDate": end_date,
}

# Send the request to NVD API
response = requests.get(BASE_URL, params=params)

# Check for a successful response
if response.status_code == 200:
    data = response.json()
    total_cves = data.get("totalResults", 0)
    print(f"Total CVEs in the past 30 days: {total_cves}")
else:
    print(f"Failed to retrieve CVE data: {response.status_code}")