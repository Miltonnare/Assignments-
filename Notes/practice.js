
function Add(a,b){
    console.log("The sum is: ",a+b);

}

function Sub(a,b){
    console.log("The difference is: ", a+b);

}

Add(5,6);
Sub(7,8);


for (let i=0;i<=5;i++){
    if(i===3){
        continue;
    }
    // console.log(i)

    if (i===4){
        break;
    }
     console.log(i)

}


try {
    for (let i=0;i<=5;i++){
    if(i===3){
        continue;
    }

    if(i===2){
        throw new error ("Expected errros");
    }
    

    if (i===4){
        break;
    }
     console.log(i)

}
} catch (error) {
    console.error("Caught an Error", error.message)
    
}

let i=5;
while(i<4){
    console.log("I love You!");
}


let Y=5;
X=+Y;

console.log(X);


for (let i = 1; i < 10; i++) {
  if (i === 3) {
     continue;
     }
  console.log("The number is " ,i);
}