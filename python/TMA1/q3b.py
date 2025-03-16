import itertools


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


def guessNRIC(masked: str) -> list:

    if len(masked) != 9 or masked[0] not in ('S', 'T') or masked[-1].isalpha() == False:
        print("Invalid NRIC! NRIC should start with S or T")
        return []

    masked_indices = [i for i, char in enumerate(masked) if char == 'X']
    if len(masked_indices) < 1 or len(masked_indices) > 4:
        print("Number of masked digits should be between 1 to 4.")
        return []

    valid_nrics = []
    for replacements in itertools.product('0123456789', repeat=len(masked_indices)):
        nric_candidate = list(masked)
        for index, digit in zip(masked_indices, replacements):
            nric_candidate[index] = digit
        nric_candidate = ''.join(nric_candidate)
        if verifyNRIC(nric_candidate):
            valid_nrics.append(nric_candidate)

    return valid_nrics


def main():

    while True:
        masked_nric = input("Enter NRIC with 1-4 masked digits (<Enter> to exit): ").upper()
        if masked_nric == "":
            print("Program exited")
            break
        valid_permutations = guessNRIC(masked_nric)
        if valid_permutations:
            print(f"{masked_nric} has {len(valid_permutations)} permutations: {valid_permutations}")


if __name__ == "__main__":
    main()
