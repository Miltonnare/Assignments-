let array = [];
let p = new Promise (function(resolve, reject) {
     setTimeout(() => resolve(100), 1000);
});
p.then(a => {
     array.push(a);
     console.log(...array);
});
array.push(200);

