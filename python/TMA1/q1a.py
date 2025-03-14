# Get user input for the birth year
birth_year = int(input("Enter year of birth: ")) #Ask for an input and classified it as Integer
age_in_2026 = int(2026 - birth_year)

# Check if the user is eligible (21 years or older)
if age_in_2026 < 21:
    print(f"You are only {age_in_2026} in 2026, not eligible for AP Cash")
else:
    # Get property ownership information
    own_more_than_one_property = input("Do you own more than 1 property? (Y/N): ").strip().upper()

    if own_more_than_one_property == "Y":
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