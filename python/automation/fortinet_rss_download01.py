import subprocess
import os
import xmltodict
import json

def download_file(url, output_filename):
    try:
        subprocess.run(["curl", "-o", output_filename, url], check=True)
        print(f"File downloaded successfully as {output_filename}")
    except subprocess.CalledProcessError as e:
        print(f"Error downloading file: {e}")

def is_xml(file_path):
    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            content = f.read()
            return content.strip().startswith('<?xml') or content.strip().startswith('<')
    except Exception as e:
        print(f"Error reading file: {e}")
        return False

def convert_xml_to_json(xml_file, json_file):
    try:
        with open(xml_file, 'r', encoding='utf-8') as f:
            xml_content = xmltodict.parse(f.read())

        with open(json_file, 'w', encoding='utf-8') as f:
            json.dump(xml_content, f, indent=2)

        print(f"Converted XML to JSON and saved as {json_file}")
    except Exception as e:
        print(f"Error converting XML to JSON: {e}")

def main():
    url = "https://filestore.fortinet.com/fortiguard/rss/ir.xml"
    xml_filename = "ir.xml"
    json_filename = "ir.json"

    download_file(url, xml_filename)

    if os.path.exists(xml_filename) and is_xml(xml_filename):
        convert_xml_to_json(xml_filename, json_filename)
    else:
        print("Downloaded file is not a valid XML.")

if __name__ == "__main__":
    main()
