var ctx = document.getElementById('ch').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: 'Parchases',
            data: [20, 30, 50, 40, 25, 30, 56],
            /*borderColor: [
                '#000033'
            ],*/
            backgroundColor: [
                'green',
                'orange',
                'red',
                'blue',
                'magenta',
                'cyan',
                'purple'
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        responsive: true
    }
});