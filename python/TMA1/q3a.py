def compute_check_letter(nric: str) -> str:

    weights = [2, 7, 6, 5, 4, 3, 2]
    check_letters = "ABCDEFGHIZJ"

    # Extract prefix and numeric part
    prefix = nric[0]
    numbers = nric[1:8]

    # Compute weighted sum
    total = sum(int(num) * weight for num, weight in zip(numbers, weights))

    # If prefix is 'T', add 4 to the sum
    if prefix == 'T':
        total += 4

    # Compute check digit
    remainder = total % 11
    check_digit = 11 - remainder

    # Get corresponding check letter
    return check_letters[check_digit - 1]


def verifyNRIC(nric: str) -> bool:

    if len(nric) != 9 or nric[0] not in ('S', 'T') or not nric[1:8].isdigit():
        return False  # Invalid format

    expected_letter = compute_check_letter(nric)
    return nric[-1] == expected_letter


# Sample test
print(verifyNRIC('S7928964G'))