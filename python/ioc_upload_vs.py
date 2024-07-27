import requests
import time

API_KEY = '1bee641f0a009c6675c5d81fcb0a940a0a811937c1d77508109250844b44f2c1'
API_URL = 'https://www.virustotal.com/vtapi/v2/ip-address/report'

def get_ip_report(ip_address):
    params = {
        'apikey': API_KEY,
        'ip': ip_address
    }
    response = requests.get(API_URL, params=params)
    if response.status_code == 200:
        return response.json()
    else:
        response.raise_for_status()

def main():
    with open('ip_addresses.txt', 'r') as file:
        ip_addresses = [line.strip() for line in file.readlines()]

    results = {}
    for ip in ip_addresses:
        try:
            result = get_ip_report(ip)
            results[ip] = result
            print(f"Report for IP {ip}:")
            print(result)
            print("\n")
            # Rate limiting: VirusTotal allows 4 requests per minute for free API users
            time.sleep(15)
        except requests.exceptions.RequestException as e:
            print(f"Error fetching report for IP {ip}: {e}")
    
    # Optionally, save the results to a JSON file
    with open('ip_reports.json', 'w') as json_file:
        json.dump(results, json_file, indent=4)

if __name__ == '__main__':
    main()