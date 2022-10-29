from pathlib import Path

import os

path = Path.cwd()

print(path)

os.chdir('D:\\Users\swamps')

path = Path.cwd()

print(path)
