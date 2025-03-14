from datetime import datetime

# Get the current year
current_year = datetime.now().year

# Get user input for birth year
birth_year = int(input("Enter year of birth: "))
age_in_2026 = current_year - birth_year

print(age_in_2026)