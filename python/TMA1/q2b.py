import random

def get_valid_level():

    while True:
        try:
            level = int(input("Enter highest level to complete (1-5): "))
            if 1 <= level <= 5:
                return level
            else:
                print("Highest level must be between 1 and 5.")
        except ValueError:
            print("Invalid input. Please enter a number between 1 and 5.")

def get_expression(level, operator):
    """Generates a mathematical expression and the correct answer."""
    lower_bound = 10**(level-1)
    upper_bound = (10**level) - 1

    if operator == '+':
        num1 = random.randint(lower_bound, upper_bound)
        num2 = random.randint(lower_bound, upper_bound)
        answer = num1 + num2
        expression = f"{num1} + {num2} = ?"

    elif operator == '-':
        num1 = random.randint(lower_bound, upper_bound)
        num2 = random.randint(lower_bound, num1)
        answer = num1 - num2
        expression = f"{num1} - {num2} = ?"

    elif operator == '*':
        num1 = random.randint(max(2, lower_bound), upper_bound)
        num2 = random.randint(2, 9)
        answer = num1 * num2
        expression = f"{num1} * {num2} = ?"

    return expression, answer

def math_practice():
    """Main function that controls the math practice game."""
    max_level = get_valid_level()  # Ask for valid level input
    current_level = 1

    while True:
        operator = random.choice(['+', '-', '*'])
        question, correct_answer = get_expression(current_level, operator)

        try:
            user_answer = int(input(f"Level {current_level}, {question} "))
        except ValueError:
            print(f"Wrong! The answer is {correct_answer}. Sorry, retake level {max(1, current_level - 1)} again.")
            current_level = max(1, current_level - 1)
            continue

        if user_answer == correct_answer:
            if current_level == max_level:
                print(f"Correct! Well done! You have completed the highest level {max_level}! You have passed.")
                break
            else:
                print(f"Correct! Well done! Proceeding to the next level {current_level + 1}.")
                current_level += 1
        else:
            print(f"Wrong! The answer is {correct_answer}. Sorry, retake level {max(1, current_level - 1)} again.")
            if current_level == 1:
                print("Wrong! The answer is", correct_answer, "Sorry, you have answered wrongly at level 1! You have failed.")
                break
            current_level = max(1, current_level - 1)

# Run the program
math_practice()