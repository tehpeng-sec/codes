# Create a table to input the data from the table.
ap_cash_property_table = {

    # Define the values for property ownership fom 0 to 1.
    "0_to_1": {
        "up_to_34K": [200, 600, 600, 600, 250],
        "34K_to_100K": [150, 350, 350, 350, 150],
        "more_than_100K": [100,200,200,100,100]
    },
    # Define the values for property ownership of more than 1.
    "more_than_1_property": [100,200,200,100,100]
}

birth_year = int(input("Enter year of birth: ")) # Ask for an input and classified it as Integer.
year_turn_21 = birth_year + 21 #Calculate the year which the user will turn 21.

# Check if the user will turn 21 between the years 2024 and 2027.
if 2024 <= year_turn_21 <= 2027:

    # If yes print out the amount to receive.
    print("You will receive a total of $850 AP Cash over five years.")
else:
    total_ap_cash = 0
    property_ownership_start = int(input("From which reference year do you own >1 property (0 for NA): "))

    if property_ownership_start == 0:
        assessable_income = int(input("Assessable Income: "))

        if assessable_income <= 34000:
            total_ap_cash = sum(ap_cash_property_table["0_to_1"]["up_to_34K"])
        elif assessable_income <= 100000:
            total_ap_cash = sum(ap_cash_property_table["0_to_1"]["34K_to_100K"])
        else:
            total_ap_cash = sum(ap_cash_property_table["0_to_1"]["more_than_100K"])

    else:
        for i, year in enumerate(range(2023,2028)):
            if birth_year + 21 <= year:
                if year >= property_ownership_start:
                    total_ap_cash += ap_cash_property_table["more_than_1_property"][i]
                else:
                    assessable_income = int(input("Assessable Income: ")) if i == 0 else assessable_income
                    if assessable_income <= 34000:
                        total_ap_cash += ap_cash_property_table["0_to_1"]["up_to_34K"][i]
                    elif assessable_income <= 100000:
                        total_ap_cash += ap_cash_property_table["0_to_1"]["34K_to_100K"][i]
                    else:
                        total_ap_cash += ap_cash_property_table["0_to_1"]["more_than_100K"][i]

    print(f"You will receive a total of ${total_ap_cash} AP Cash over five years.")