import requests
from datetime import datetime
import json

# Get current year and month
now = datetime.utcnow()
year = now.year
month = now.month
month_str = f"{month:02d}"  # Pad single digit month with zero

# Construct filter: updates released this month
# Note: releaseDate is in ISO format, so we use string comparison
start_date = f"{year}-{month_str}-01T00:00:00Z"
end_date = f"{year}-{month_str}-31T23:59:59Z"
odata_filter = f"initialReleaseDate ge {start_date} and initialReleaseDate le {end_date}"

# API Endpoint
api_url = "https://api.msrc.microsoft.com/sug/v2.0/en-US/updates"
headers = {
    "Accept": "application/json"
}

# Call the API with OData filtering
response = requests.get(api_url, headers=headers, params={'$filter': odata_filter})

# Check response
if response.status_code == 200:
    updates = response.json().get("value", [])

    # Extract relevant info
    results = []
    for item in updates:
        results.append({
            "ID": item.get("ID"),
            "CVE": item.get("CveNumber"),
            "Title": item.get("Title"),
            "Severity": item.get("Severity"),
            "AffectedProduct": item.get("ProductFamily"),
            "InitialReleaseDate": item.get("InitialReleaseDate")
        })

    # Output to JSON
    with open("ms_updates_this_month.json", "w") as f:
        json.dump(results, f, indent=2)

    print(f"✅ {len(results)} updates saved to ms_updates_this_month.json")
else:
    print(f"❌ API Error {response.status_code}: {response.text}")