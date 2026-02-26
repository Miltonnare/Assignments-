



def math(a,b):
    def add():
        return a+b
    def sub():
        return a-b
    def mul():
        return a*b
    def div():
        return a/b
    print("Addition:",add())
    print("Subtraction:",sub())
    print("Multiplication:",mul())
    print("Division:",div())
a=int(input("Enter first number: "))
b=int(input("Enter second number: "))

math(a,b)

    