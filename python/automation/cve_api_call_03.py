import requests
import json
from datetime import datetime, timedelta

def fetch_high_critical_cves(keywords):
    end_date = datetime.utcnow()
    start_date = end_date - timedelta(days=30)

    start_date_str = start_date.strftime("%Y-%m-%dT%H:%M:%S.%f")[:-3] + "Z"
    end_date_str = end_date.strftime("%Y-%m-%dT%H:%M:%S.%f")[:-3] + "Z"

    base_url = "https://services.nvd.nist.gov/rest/json/cves/2.0"
    all_results = []

    for keyword in keywords:
        params = {
            "keywordSearch": keyword,
            "pubStartDate": start_date_str,
            "pubEndDate": end_date_str,
            "resultsPerPage": 2000  # max limit
        }

        print(f"Fetching CVEs for: {keyword}")
        try:
            response = requests.get(base_url, params=params)
            response.raise_for_status()
            data = response.json()

            for item in data.get("vulnerabilities", []):
                cve = item.get("cve", {})
                cve_id = cve.get("id", "N/A")
                description = cve.get("descriptions", [{}])[0].get("value", "No description")
                metrics = cve.get("metrics", {})

                score = None
                severity = None

                if "cvssMetricV31" in metrics:
                    score = metrics["cvssMetricV31"][0]["cvssData"]["baseScore"]
                    severity = metrics["cvssMetricV31"][0]["cvssData"]["baseSeverity"]
                elif "cvssMetricV30" in metrics:
                    score = metrics["cvssMetricV30"][0]["cvssData"]["baseScore"]
                    severity = metrics["cvssMetricV30"][0]["cvssData"]["baseSeverity"]
                elif "cvssMetricV2" in metrics:
                    score = metrics["cvssMetricV2"][0]["cvssData"]["baseScore"]
                    severity = metrics["cvssMetricV2"][0]["baseSeverity"]

                if severity in ["HIGH", "CRITICAL", "High", "Critical"]:
                    all_results.append({
                        "vendor": keyword,
                        "cve_id": cve_id,
                        "score": score,
                        "severity": severity,
                        "description": description
                    })

        except requests.exceptions.RequestException as e:
            print(f"Failed to fetch CVEs for {keyword}: {e}")

    return all_results

# List of vendors to search
vendors = ["Microsoft", "Fortinet", "Splunk", "Elasticsearch", "Cisco", "Nozomi", "CrowdStrike"]

# Fetch filtered results
filtered_cves = fetch_high_critical_cves(vendors)

# Save to JSON file
with open("filtered_cve_results.json", "w") as f:
    json.dump(filtered_cves, f, indent=4)

print(f"Saved {len(filtered_cves)} high/critical CVEs to filtered_cve_results.json")