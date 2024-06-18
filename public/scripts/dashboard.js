fetch('/typeTable=phone', {
   method: 'GET' 
})
.then(res => {
    console.log(res);
})
.catch(e => {
    console.log(e);
})