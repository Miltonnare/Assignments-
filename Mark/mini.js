// Mini Shop Program (using readline)

const readline = require("readline");

// Create interface for input/output
const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

// Step 1: Function to greet the user
function greet(name) {
  console.log(`Hello ${name}! Welcome to the Mini Shop.`);
}

// Step 2: Function to show the menu
function showMenu() {
  console.log("\nHere is our menu:");
  console.log("1. Apple - $2");
  console.log("2. Banana - $1");
  console.log("3. Orange - $3");
}

// Step 3: Function to get price
function getPrice(choice) {
  if (choice === "1") return 2;
  else if (choice === "2") return 1;
  else if (choice === "3") return 3;
  else return 0;
}

// --- Main Program ---
rl.question("What is your name? ", function(name) {
  rl.question("How old are you? ", function(ageInput) {
    const age = parseInt(ageInput);
    greet(name);
    showMenu();

    rl.question("Pick a number (1-3): ", function(choice) {
      let price = getPrice(choice);

      if (price === 0) {
        console.log("Sorry, that is not on the menu.");
      } else {
        if (age < 10) {
          price -= 1;
          console.log("You get a $1 discount!");
        }
        console.log(`The final price is: $${price}`);
      }

      console.log("Thank you for shopping, goodbye!");
      rl.close();
    });
  });
});
