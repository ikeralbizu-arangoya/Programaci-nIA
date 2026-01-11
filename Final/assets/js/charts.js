document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('pilotosChart');
    if(!ctx) return;

    fetch('chart_data_pilotos.php')
    .then(res => res.json())
    .then(data => {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Puntos Pilotos',
                    data: data.puntos,
                    backgroundColor: 'rgba(225,6,0,0.7)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
});
