
function greet(){
    console.log("Good Morning Amon");

}


greet();
greet();
greet();


// def greet():
//     print("Good Morning Amon")



// greet()

function Add(a,b){
   return a+b;
}


console.log(Add(8,10));

let toy="Motorbike";
function myRoom() {
    let toy = "car";  // private toy
    console.log(toy);
}

myRoom();
console.log(toy);  // ❌ error: toy is not known outside
