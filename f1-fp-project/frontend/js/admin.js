function loadResults() {
  fetch('http://localhost:3000/results')
    .then(r => r.json())
    .then(data => {
      document.getElementById('adminResults').innerHTML =
        data.map(r =>
          `${r.season} - ${r.race} - ${r.winner}
           <button onclick="deleteResult(${r.id})">❌</button>`
        ).join('<br>');
    });
}

function addResult() {
  fetch('http://localhost:3000/results', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      season: season.value,
      race: race.value,
      winner: winner.value,
      team: team.value,
      points: points.value
    })
  }).then(loadResults);
}

function deleteResult(id) {
  fetch(`http://localhost:3000/results/${id}`, {
    method: 'DELETE'
  }).then(loadResults);
}

loadResults();
