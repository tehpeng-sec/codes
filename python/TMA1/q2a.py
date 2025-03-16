import random

def getExpression(level, operator):

    # Define number ranges based on the level
    lower_bound = 10 ** (level - 1)  # Lower bound for the number of digits
    upper_bound = (10 ** level) - 1  # Upper bound for the number of digits

    # Operation for attraction
    if operator == '+':
        num1 = random.randint(lower_bound, upper_bound)
        num2 = random.randint(lower_bound, upper_bound)
        answer = num1 + num2
        expression = f"{num1} + {num2} = "

    # Operation for subtraction
    elif operator == '-':
        num1 = random.randint(lower_bound, upper_bound)
        num2 = random.randint(lower_bound, num1)
        answer = num1 - num2
        expression = f"{num1} - {num2} = "

    # Operation for multiplication
    elif operator == '*':
        num1 = random.randint(max(2, lower_bound), upper_bound)
        num2 = random.randint(2, 9)
        answer = num1 * num2
        expression = f"{num1} * {num2} = "

    # Operator verification
    else:
        raise ValueError("Invalid operator. Use '+', '-', or '*'.")

    return expression, answer


# Example function calls for testing
print(getExpression(1, "+"))
print(getExpression(2, "-"))
print(getExpression(3, "*"))