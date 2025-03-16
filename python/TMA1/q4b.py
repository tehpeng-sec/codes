import random

def generate_board():
    board = [1] * 6 + [0] * 2 + [-1] * 2
    random.shuffle(board)
    return board


def get_valid_picks():
    while True:
        try:
            picks = list(map(int, input("Enter your 4 picks (comma-separated, 0-9): ").split(',')))
            if len(picks) != 4 or not all(0 <= pick <= 9 for pick in picks):
                raise ValueError
            return picks
        except ValueError:
            print("Invalid input. Please enter 4 numbers between 0 and 9, separated by commas.")


def calculate_score(board, picks):
    if any(board[pick] == -1 for pick in picks):
        return "bomb"
    return sum(board[pick] for pick in picks)


def play_game():
    board = generate_board()
    print("The treasures are planted... You have 5 chances!!")
    attempts = 5
    found_treasures = 0

    for round_num in range(1, attempts + 1):
        print(f"Round {round_num}: ")
        picks = get_valid_picks()
        result = calculate_score(board, picks)

        if result == "bomb":
            print("You hit a bomb!!")
            continue

        print(f"You got {result} hits!!")
        found_treasures += result

        if found_treasures >= 4:
            print("You are the winner!!")
            return

    print("You lost!!")
    print("The treasures are in:", board)


def main():
    play_game()


if __name__ == "__main__":
    main()
