const ctx = document.getElementById('salesChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Nasi Liwet','Nasi Bakar','Nasi Timbel','Tumpeng'],
        datasets: [{
            data: [8, 12, 16, 20],
            backgroundColor: ['#FFE39F','#FFC107','#FFA726','#FF3D3D']
        }]
    },
    options: {
        plugins: { legend: { display: false } }
    }
});
