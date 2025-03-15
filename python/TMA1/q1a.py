# Get user input for the birth year
birth_year = int(input("Enter year of birth: ")) # Ask for an input and classified it as Integer
age_in_2026 = int(2026 - birth_year) # Calculate the age of the user in 2026 and classify it as integer

#  Eligibility Check
# If the users age is lesser than 21, print the output
if age_in_2026 < 21: #
    print(f"You are only {age_in_2026} in 2026, not eligible for AP Cash")

# If the user is age is more than 21.
else:
    # Ask for preperty count
    property_count = input("Do you own more than 1 property? (Y/N): ").strip().upper()

    if property_count == "Y":
        print("You will receive $100 AP Cash in Dec 2025")
    else:
        # Get assessable income
        assessable_income = int(input("Assessable Income: "))

        # Determine AP Cash based on income
        if assessable_income <= 34000:
            print("You will receive $600 AP Cash in Dec 2025")
        elif assessable_income <= 100000:
            print("You will receive $350 AP Cash in Dec 2025")
        else:
            print("You will receive $200 AP Cash in Dec 2025")