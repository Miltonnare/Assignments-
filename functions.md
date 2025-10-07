🔹 Definition

A function is a block of reusable code designed to perform a specific task.
Instead of repeating the same code multiple times, you can define it once and call (use) it whenever needed.

🔹 Purpose of Functions

Functions are used to:

Avoid repetition (Write once, use many times).

Make code modular (Break a big program into smaller, manageable parts).

Improve readability (Each function does one clear thing).

Simplify debugging and maintenance.

Allow collaboration (Multiple developers can work on different functions independently).

🔹 Structure of a Function

A function typically has:

Name – identifies the function.

Parameters (inputs) – values the function can accept.

Body – the block of statements to execute.

Return value (output) – the result sent back to where it was called.


def greet(name):         # Function definition with parameter
    print("Hello", name)

greet("Abdi")            # Function call

###TYPES OF FUNCTIONS###

🔹 1. Built-in Functions

These are functions already provided by the programming language — you don’t have to define them.

Examples

Python:

print(), len(), max(), type(), range()

JavaScript:

alert(), parseInt(), Math.sqrt(), console.log()

 They save time since you reuse existing code instead of writing from scratch.

🔹 2. User-Defined Functions

These are the functions that you create to perform specific tasks in your program.
function greet(name) {
    console.log("Hello " + name);
}
🔹 Summary Table
Type	            Description	                Example
Built-in	        Predefined in the language	print(), len(), Math.sqrt()
User-defined	    Created by programmer	    def greet():
Anonymous/Lambda	No name, short tasks	    lambda x: x*2
Recursive	        Calls itself	            Factorial, Fibonacci
Parametered/Non-parametered	Accepts input or not	def add(a,b)
Return/Non-return	Returns value or not	    return a+b
Library	            Imported from module	                math.sqrt()