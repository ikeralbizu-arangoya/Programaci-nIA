// main.js
document.addEventListener("DOMContentLoaded", function() {
  // Botones info piloto (si existen)
  document.querySelectorAll('.btn-info-driver').forEach(btn => {
    btn.addEventListener('click', () => {
      alert("Función Info de piloto: " + btn.dataset.id);
    });
  });

  // Ergast loader (si existe botón)
  const ergastBtn = document.getElementById('btn-load-ergast');
  if (ergastBtn) {
    ergastBtn.addEventListener('click', () => {
      const target = document.getElementById('ergast-result');
      target.innerHTML = "Cargando...";
      fetch('/api/ergast/latest').then(r => r.json()).then(data => {
        if (data.error) {
          target.innerHTML = "<div class='text-danger'>Error: " + data.error + "</div>";
          return;
        }
        try {
          const race = data.MRData.RaceTable.Races[0];
          let html = `<h6>${race.raceName} — ${race.Circuit.circuitName}</h6><ol>`;
          race.Results.slice(0,5).forEach(res => {
            html += `<li>${res.position} - ${res.Driver.givenName} ${res.Driver.familyName} (${res.Constructor.name})</li>`;
          });
          html += "</ol>";
          target.innerHTML = html;
        } catch (err) {
          target.innerHTML = "<div class='text-danger'>No hay datos disponibles</div>";
        }
      }).catch(err => {
        target.innerHTML = "<div class='text-danger'>Error al conectar</div>";
      });
    });
  }
});
