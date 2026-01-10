fetch('http://localhost:3000/results')
.then(r=>r.json())
.then(data=>{
  document.getElementById('results').innerHTML =
    data.map(r=>`${r.season} - ${r.race} (${r.winner})`).join('<br>');
});

fetch('http://localhost:3000/merch')
.then(r=>r.json())
.then(data=>{
  document.getElementById('merch').innerHTML =
    data.map(m=>`${m.team} - ${m.product} ${m.price}€`).join('<br>');
});

fetch('http://localhost:3000/news')
.then(r=>r.json())
.then(data=>{
  document.getElementById('news').innerHTML =
    data.map(n=>`<b>${n.title}</b>: ${n.content}`).join('<br>');
});
