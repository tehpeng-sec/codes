import requests
import json
from datetime import datetime, timedelta

# Set your optional NIST API key
API_KEY = ''  # Add your API key if available

# Common headers
HEADERS = {
    "Content-Type": "application/json"
}

# Current and past 7-day date range
end_date = datetime.utcnow()
start_date = end_date - timedelta(days=7)

# Format dates as ISO 8601
start_date_str = start_date.strftime("%Y-%m-%dT%H:%M:%S.%f")[:-3] + "Z"
end_date_str = end_date.strftime("%Y-%m-%dT%H:%M:%S.%f")[:-3] + "Z"

# Vendor keywords
vendors = {
    "Microsoft": "microsoft",
    "Fortinet": "fortinet",
    "Cisco": "cisco"
}

def fetch_cves(vendor_name, keyword):
    url = f"https://services.nvd.nist.gov/rest/json/cves/2.0"
    params = {
        "keywordSearch": keyword,
        "pubStartDate": start_date_str,
        "pubEndDate": end_date_str
    }
    if API_KEY:
        params["apiKey"] = API_KEY

    print(f"Fetching CVEs for {vendor_name}...")

    response = requests.get(url, headers=HEADERS, params=params)
    if response.status_code == 200:
        data = response.json()
        filename = f"{vendor_name}_CVEs_{end_date.date()}.json"
        with open(filename, "w", encoding="utf-8") as f:
            json.dump(data, f, indent=2)
        print(f"Saved {vendor_name} CVEs to: {filename}")
    else:
        print(f"Failed to retrieve CVEs for {vendor_name} - Status Code: {response.status_code}")

# Run for each vendor
for name, keyword in vendors.items():
    fetch_cves(name, keyword)