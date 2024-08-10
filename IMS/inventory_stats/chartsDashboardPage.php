<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Inventory Management System</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div id="dashboard_main_container">
        <?php include "../dashboard/dashboardSideBarTemplate.php"; ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include "../dashboard/dashboardTopNavTemplate.php"; ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <h1 class="chartHeader">Inventory Analysis</h1>
                    <!-- Dropdown for selecting chart type -->
                    <div class="selectContainer">
                        <select id="chartType" onchange="updateChart()">
                            <option value="receive_date">Pallets Recieved by Date</option>
                            <option value="dispatch_date">Pallets Dispatched by Date</option>
                            <option value="line_chart">Material Dispatched by Date</option>
                        </select>
                    </div>
                    <div class="chartContainer">
                        <canvas id="myChart"></canvas>
                    </div>
                    <script>
                        let chart;

                        function fetchChartData(chartType) {
                            return fetch(`getChartData.php?chartType=${encodeURIComponent(chartType)}`)
                                .then(response => response.json());
                        }

                        function updateChart() {
                            const chartType = document.getElementById('chartType').value;
                            fetchChartData(chartType).then(data => {
                                if (data.error) {
                                    console.error(data.error);
                                    return;
                                }

                                if (chart) {
                                    chart.destroy();
                                }

                                const ctx = document.getElementById('myChart').getContext('2d');

                                const colors = {
                                    'Tile': '#fc9d03',
                                    'Wood': '#36a2eb',
                                    'Carpet': '#ff6384',
                                    'Setting Material': '#4bc0c0'
                                };

                                const defaultBackgroundColor = '#f5ad42';

                                const datasets = data.datasets.map(dataset => ({
                                    label: dataset.label,
                                    data: dataset.data,
                                    backgroundColor: chartType === 'line_chart' ? colors[dataset.label] : defaultBackgroundColor,
                                    borderColor: chartType === 'line_chart' ? colors[dataset.label] : 'grey',
                                    borderWidth: 2,
                                    fill: chartType !== 'line_chart', // Fill the background for non-line charts
                                    tension: 0.4,
                                    pointRadius: chartType === 'line_chart' ? 5 : 0, // Points only on line chart
                                    pointHoverRadius: chartType === 'line_chart' ? 7 : 0 // Hover effect only on line chart
                                }));

                                chart = new Chart(ctx, {
                                    type: chartType === 'line_chart' ? 'line' : 'bar',
                                    data: {
                                        labels: data.labels,
                                        datasets: datasets
                                    },
                                    options: {
                                        scales: {
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: data.xLabel
                                                }
                                            },
                                            y: {
                                                beginAtZero: true,
                                                title: {
                                                    display: true,
                                                    text: data.yLabel
                                                }
                                            }
                                        }
                                    }
                                });
                            });
                        }

                        // Initialize the chart with the default selection
                        updateChart();
                    </script>
                </div>
            </div> 
        </div>
    </div>
    <script src="../dashboard/dashboard.js"></script>
    <script src="https://kit.fontawesome.com/ec3dee1045.js" crossorigin="anonymous"></script>
</body>
</html>
