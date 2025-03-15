import random

def getExpression(level, operator):

    # Define number ranges based on the level
    lower_bound = 10 ** (level - 1)  # Lower bound for the number of digits
    upper_bound = (10 ** level) - 1  # Upper bound for the number of digits

    if operator == '+':  # Addition
        num1 = random.randint(lower_bound, upper_bound)
        num2 = random.randint(lower_bound, upper_bound)
        answer = num1 + num2
        expression = f"{num1} + {num2} = "

    elif operator == '-':  # Subtraction
        num1 = random.randint(lower_bound, upper_bound)
        num2 = random.randint(lower_bound, num1)  # Ensuring num2 is less than num1
        answer = num1 - num2
        expression = f"{num1} - {num2} = "

    elif operator == '*':  # Multiplication
        num1 = random.randint(max(2, lower_bound), upper_bound)  # First operand should not start with 1 in level 1
        num2 = random.randint(2, 9)  # Second operand is always a single digit (2-9)
        answer = num1 * num2
        expression = f"{num1} * {num2} = "

    else:
        raise ValueError("Invalid operator. Use '+', '-', or '*'.")

    return expression, answer


# Example function calls for testing
print(getExpression(1, "+"))  # Example output: "3 + 1 = ", 4
print(getExpression(2, "-"))  # Example output: "23 - 17 = ", 6
print(getExpression(3, "*"))  # Example output: "234 * 8 = ", 1872