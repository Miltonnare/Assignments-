
# name=input("Enter your name: ")

# print(f'My name is {name} ')

# name = input("Enter your name: ")
# print("Hello,", name)


try:
    number = int(input("Enter a number: "))
    print(10 / number)
except ValueError:
    print("Please enter a valid number!")
except ZeroDivisionError:
    print("Cannot divide by zero!")

x = 10
if x == 5:
    print("Equal")
else:
    print("Not Equal")
