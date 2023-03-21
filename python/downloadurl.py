import urllib.request

url = "https://github.com/keepassxreboot/keepassxc/releases/download/2.7.4/KeePassXC-2.7.4-Win64.zip"
filename = "KeePassXC-2.7.4-Win64.zip"

urllib.request.urlretrieve(url, filename)