def calculate():
    while True:
        try:
            num1 = float(input("Enter the first number: "))
            operator = input("Enter operator (+, -, *, /): ")
            num2 = float(input("Enter the second number: "))

            if operator == '+':
                result = num1 + num2
            elif operator == '-':
                result = num1 - num2
            elif operator == '*':
                result = num1 * num2
            elif operator == '/':
                if num2 == 0:
                    print("Error: Division by zero is not allowed.")
                    continue  # Ask for input again
                result = num1 / num2
            else:
                print("Error: Invalid operator. Please use +, -, *, or /.")
                continue # Ask for input again

            print(f"Result: {result}")

        except ValueError:
            print("Error: Invalid input. Please enter valid numbers.")
        except Exception as e:
            print(f"An unexpected error occurred: {e}")

        another_calculation = input("Do you want to perform another calculation? (yes/no): ").lower()
        if another_calculation != 'yes':
            break

calculate()