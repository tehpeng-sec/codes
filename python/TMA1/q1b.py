# Define the AP Cash table based on eligibility criteria
ap_cash_table = {
    "0_to_1_property": {
        "up_to_34000": [200, 600, 600, 600, 250],
        "34000_to_100000": [150, 350, 350, 350, 150],
        "above_100000": [100, 200, 200, 200, 100]
    },
    "more_than_1_property": [100, 200, 200, 200, 100]
}

# Get user input for birth year
birth_year = int(input("Enter year of birth: "))
age_in_2026 = 2026 - birth_year

# Check if the user is eligible (21 years or older in any year from 2023 to 2027)
if age_in_2026 < 21 and (2026 - birth_year) < 21:
    print(f"You are only {age_in_2026} in 2026, not eligible for AP Cash")
else:
    total_ap_cash = 0
    property_start_year = int(input("From which reference year do you own >1 property (0 for NA): "))

    if property_start_year == 0:  # Owns 0 to 1 property
        if age_in_2026 >= 21:  # Already eligible in 2023
            assessable_income = int(input("Assessable Income: "))

            if assessable_income <= 34000:
                total_ap_cash = sum(ap_cash_table["0_to_1_property"]["up_to_34000"])
            elif assessable_income <= 100000:
                total_ap_cash = sum(ap_cash_table["0_to_1_property"]["34000_to_100000"])
            else:
                total_ap_cash = sum(ap_cash_table["0_to_1_property"]["above_100000"])
        else:  # Becomes eligible between 2024 and 2027
            total_ap_cash = sum(ap_cash_table["0_to_1_property"]["up_to_34000"][(age_in_2026 - 20):])

    else:  # Owns more than 1 property from a certain year
        for i, year in enumerate(range(2023, 2028)):  # Iterating from 2023 to 2027
            if birth_year + 21 <= year:  # Only count years where the user is 21+
                if year >= property_start_year:
                    total_ap_cash += ap_cash_table["more_than_1_property"][i]
                else:
                    assessable_income = int(input("Assessable Income: ")) if i == 0 else assessable_income
                    if assessable_income <= 34000:
                        total_ap_cash += ap_cash_table["0_to_1_property"]["up_to_34000"][i]
                    elif assessable_income <= 100000:
                        total_ap_cash += ap_cash_table["0_to_1_property"]["34000_to_100000"][i]
                    else:
                        total_ap_cash += ap_cash_table["0_to_1_property"]["above_100000"][i]

    print(f"You will receive a total of ${total_ap_cash} AP Cash over five years.")