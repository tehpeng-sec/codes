#!/bin/bash

# Input text file
INPUT_FILE="data.txt"

# Output JSON file
OUTPUT_FILE="data.json"

# Check if input file exists
if [ ! -f "$INPUT_FILE" ]; then
    echo "Error: Input file '$INPUT_FILE' not found."
    exit 1
fi

# Start of JSON array
echo "[" > "$OUTPUT_FILE"

# Read each line from input file
while IFS='=' read -r key value; do
    # Trim leading/trailing whitespace from key and value
    key=$(echo "$key" | awk '{$1=$1};1')
    value=$(echo "$value" | awk '{$1=$1};1')

    # Create JSON object
    echo "  {" >> "$OUTPUT_FILE"
    echo "    \"$key\": \"$value\"" >> "$OUTPUT_FILE"
    echo "  }," >> "$OUTPUT_FILE"
done < "$INPUT_FILE"

# Remove trailing comma from last JSON object
sed -i '$ s/,$//' "$OUTPUT_FILE"

# End of JSON array
echo "]" >> "$OUTPUT_FILE"

echo "Conversion complete. JSON output saved to '$OUTPUT_FILE'."