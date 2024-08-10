<?php
session_start(); // Start Sessions
include "../db.php"; // Database Credentials

// Get chart type from query parameter
$chartType = isset($_GET['chartType']) ? $_GET['chartType'] : '';

switch ($chartType) {
    case 'receive_date':
        $sql = "SELECT receive_date, COUNT(*) as record_count FROM inventory_received GROUP BY receive_date ORDER BY receive_date";
        $label = 'Total Number of Pallets Dispatched';
        $xLabel = 'Receive Date';
        $yLabel = 'Number of Pallets';
        break;

    case 'dispatch_date':
        $sql = "SELECT dispatch_date, COUNT(*) as record_count FROM inventory_dispatched GROUP BY dispatch_date ORDER BY dispatch_date";
        $label = 'Total Number of Pallets Dispatched';
        $xLabel = 'Date Dispatched';
        $yLabel = 'Number of Pallets';
        break;

        // prepared statemnt. Can be used to provide new ways of showing data
    // case 'material':
    //     $sql = "SELECT receive_date, material, COUNT(*) as record_count FROM inventory_received GROUP BY receive_date, material ORDER BY receive_date, material";
    //     $label = 'Material Received by Date';
    //     $xLabel = 'Receive Date';
    //     $yLabel = 'Pallets Dispatched';
    //     break;

    case 'line_chart':
        $sql = "SELECT dispatch_date, material, COUNT(*) as record_count FROM inventory_dispatched GROUP BY dispatch_date, material ORDER BY dispatch_date, material";
        $xLabel = 'Date Dispatched';
        $yLabel = 'Number of Pallets';
        break;

    default:
        echo json_encode(['error' => 'Invalid chart type']);
        exit;
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(['error' => 'Query failed: ' . mysqli_error($conn)]);
    exit;
}

$labels = [];
$data = [];

if ($chartType === 'line_chart') {
    $data = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $date = $row['dispatch_date'];
            if (!in_array($date, $labels)) {
                $labels[] = $date;
            }
            $data[$row['material']][] = $row['record_count'];
        }
    }

    $datasets = [];
    foreach ($data as $material => $counts) {
        $datasets[] = [
            'label' => $material,
            'data' => $counts
        ];
    }

    $response = [
        'labels' => $labels,
        'datasets' => $datasets,
        'xLabel' => $xLabel,
        'yLabel' => $yLabel
    ];
} else {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $labels[] = $row[array_keys($row)[0]]; // Dynamic column for labels
            $data[] = $row['record_count'];
        }
    }

    $response = [
        'labels' => $labels,
        'datasets' => [
            [
                'label' => $label,
                'data' => $data
            ]
        ],
        'xLabel' => $xLabel,
        'yLabel' => $yLabel
    ];
}

mysqli_close($conn);

echo json_encode($response);
?>
