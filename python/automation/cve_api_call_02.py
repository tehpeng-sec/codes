import requests
import json
from datetime import datetime, timedelta

def get_vendor_cve_count(keywords):
    # Calculate date range
    end_date = datetime.utcnow()
    start_date = end_date - timedelta(days=30)

    # Format dates for NIST API
    start_date_str = start_date.strftime("%Y-%m-%dT%H:%M:%S.%f")[:-3] + "Z"
    end_date_str = end_date.strftime("%Y-%m-%dT%H:%M:%S.%f")[:-3] + "Z"

    base_url = "https://services.nvd.nist.gov/rest/json/cves/2.0"
    results_by_keyword = {}

    for keyword in keywords:
        params = {
            "keywordSearch": keyword,
            "pubStartDate": start_date_str,
            "pubEndDate": end_date_str
        }

        try:
            response = requests.get(base_url, params=params)
            response.raise_for_status()
            data = response.json()
            results_by_keyword[keyword] = data.get("totalResults", 0)
        except requests.exceptions.RequestException as e:
            print(f"Error fetching data for {keyword}: {e}")
            results_by_keyword[keyword] = None

    # Add timestamp and total
    output_data = {
        "timestamp_utc": datetime.utcnow().isoformat() + "Z",
        "date_range": {
            "start": start_date_str,
            "end": end_date_str
        },
        "results": results_by_keyword,
        "total_cves": sum(v for v in results_by_keyword.values() if v is not None)
    }

    # Write to JSON file
    with open("cve_results.json", "w") as f:
        json.dump(output_data, f, indent=4)

    print("CVE results written to cve_results.json")

    return output_data

# Keywords to search for
vendors = ["Microsoft", "Fortinet", "Splunk", "Elasticsearch", "CrowdStrike"]

# Call the function
get_vendor_cve_count(vendors)