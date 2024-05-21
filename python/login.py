import requests

def make_api_call(url, payload, headers=None):
    # Make the API call
    response = requests.post(url, json=payload, headers=headers)
    
    # Check if the request was successful
    if response.status_code == 200:
        # Parse the response JSON and save it as a variable
        result = response.json()
        return result
    else:
        # Handle errors
        response.raise_for_status()

# Example usage
url = 'https://api.example.com/endpoint'
payload = {
    'key1': 'value1',
    'key2': 'value2'
}
headers = {
    'Content-Type': 'application/json',
    'Authorization': 'Bearer YOUR_ACCESS_TOKEN'
}

try:
    result = make_api_call(url, payload, headers)
    print("API call successful. Result:")
    print(result)
except requests.exceptions.RequestException as e:
    print(f"API call failed: {e}")
