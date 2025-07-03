document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('bookDownloadsChart').getContext('2d');
    if (ctx) {
        var chartLabels = JSON.parse(document.getElementById('chart-labels').textContent);
        var chartData = JSON.parse(document.getElementById('chart-data').textContent);

        var bookDownloadsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Total Downloads',
                    data: chartData,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Downloads'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Book Title'
                        }
                    }
                }
            }
        });
    }
});