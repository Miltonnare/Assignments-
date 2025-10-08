
const array=[5,4,6,7,10];

function findLargest(){
    let largerst=array[0];

    for (let i=1;i<array.length;i++){

 if(array[i]>largerst){
largerst=array[i];

             
        }
       

        

    }
    return largerst;
}

console.log("The Result: ",findLargest());

// This is a jaascript comment

