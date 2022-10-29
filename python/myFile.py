from pathlib import Path

myFiles = ['accounts.txt', 'details.csv', 'invite.docx']

for filename in myFiles:
    print(Path(r'C:\Users\Al', filename))

