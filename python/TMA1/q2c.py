import random


def get_valid_number(prompt, min_val, max_val):
    """Ensures the user enters a valid number within a given range."""
    while True:
        try:
            value = int(input(prompt))
            if min_val <= value <= max_val:
                return value
            else:
                print(f"Input must be between {min_val} and {max_val}.")
        except ValueError:
            print("Invalid input. Please enter a valid number.")


def get_expression(level, operator):
    """Generates a mathematical expression and the correct answer."""
    lower_bound = 10 ** (level - 1)
    upper_bound = (10 ** level) - 1

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
    correct_needed = get_valid_number("Enter number of correct answers before proceeding to the next level (2-5): ", 2,
                                      5)
    max_level = get_valid_number("Enter highest level to complete (1-5): ", 1, 5)

    current_level = 1
    correct_count = 0
    wrong_count = 0

    while True:
        operator = random.choice(['+', '-', '*'])
        question, correct_answer = get_expression(current_level, operator)

        try:
            user_answer = int(input(f"Level {current_level}, {question} "))
        except ValueError:
            user_answer = None

        if user_answer == correct_answer:
            correct_count += 1
            wrong_count = 0  # Reset wrong answer count
            if correct_count < correct_needed:
                print(
                    f"Correct! Answer the next {correct_needed - correct_count} questions correctly to proceed to the next level.")
            else:
                if current_level == max_level:
                    print(f"Correct! Well done! You have completed the highest level {max_level}! You have passed.")
                    break
                else:
                    print(
                        f"Correct! Well done! You have answered {correct_needed} questions correctly, proceeding to the next level {current_level + 1}.")
                    current_level += 1
                    correct_count = 0  # Reset correct answer count for the new level
        else:
            print(f"Wrong! The answer is {correct_answer}.")
            wrong_count += 1
            correct_count = 0  # Reset correct streak

            if wrong_count < correct_needed:
                print(
                    f"If you answer the next {correct_needed - wrong_count} questions wrongly, you will drop one level.")
            else:
                if current_level == 1:
                    print("Sorry, you have answered too many questions wrongly at level 1! You have failed.")
                    break
                else:
                    print(
                        f"You have answered {correct_needed} questions wrongly, retake level {current_level - 1} again.")
                    current_level -= 1
                    wrong_count = 0  # Reset wrong count after dropping a level


# Run the program
math_practice()