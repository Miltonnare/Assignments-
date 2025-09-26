import random as number
def Guess():
    num=number.randint(1,100)
    
    user=int(input("Guess number between(1 to 100):"))

    if user==num:
        print(f"Superb you are correct{num}")
    elif user>num:
        print(f"Too High{num}")
    elif user<num:
        print(f"Too Low")

    print(num)



Guess()