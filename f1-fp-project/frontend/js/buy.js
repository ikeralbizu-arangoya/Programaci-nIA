function buy(){
 fetch('http://localhost:3000/tickets/buy',{
  method:'POST',
  headers:{'Content-Type':'application/json'},
  body:JSON.stringify({buyer:buyer.value, race:'GP España 2026'})
 }).then(()=>alert('Compra realizada'));
}
