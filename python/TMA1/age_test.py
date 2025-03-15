# Get user input for birth year
birth_year = int(input("Enter year of birth: "))

# Calculate the year the user turns 21
year_turns_21 = birth_year + 21

# Check if the user turns 21 between 2024 and 2027
if 2024 <= year_turns_21 <= 2027:
    print(f"You will turn 21 in the year {year_turns_21}.")
else:
    print("You will not turn 21 between 202024 and 2027.")