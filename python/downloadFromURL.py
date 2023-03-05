import requests

url = "https://www.ntu.edu.sg/docs/default-source/ntu/nss_fin/tuition_fees/part_time_programmrs_tf/tuition-fees-pt-ug_2022_dec2022.pdf"
filename = "ntu.pdf"

response = requests.get(url)

with open(filename, "wb") as f:
    f.write(response.content)