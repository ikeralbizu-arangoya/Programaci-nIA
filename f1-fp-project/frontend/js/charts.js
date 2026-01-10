fetch('http://localhost:3000/charts')
.then(r=>r.json())
.then(data=>{
 new Chart(document.getElementById('chart'),{
  type:'bar',
  data:{
    labels:data.map(d=>d.winner),
    datasets:[{data:data.map(d=>d.total)}]
  }
 });
});
