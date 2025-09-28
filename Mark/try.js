let p = new Promise(function(resolve){
     setTimeout(() => resolve(10), 100);
});
let r = new Promise(function(resolve){
     setTimeout(() => resolve(30), 200);
});
p.then(a => {
     console.log(a);
     return 20;
})
.then(a => {
     console.log(a);
     return r;
})
.then(a => { 
     console.log(a);
})
