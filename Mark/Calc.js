
// readline()...Terminal 

const readline=require('readline')

const rl=readline.createInterface({
    input:process.stdin,
    output:process.stdout
})



const operator=prompt("Enter an operator:");

const num1=parseFloat(prompt("Enter first Number:"));
const num2=parseFloat(prompt("Enter first Number:"));

let result;

if(operator=='+'){
    result=num1+num2;  
}
else if(operator=='-'){
    result=num1-num2;
}
else if(operator=='*'){
    result=num1*num2;
}

else if(operator=='/'){
    result=num1/num2;
}

else {
    console.log("InValid Operation!")
}


console.log(result);

console.log(`${num1} ${operator} ${num2}=${result}`);

