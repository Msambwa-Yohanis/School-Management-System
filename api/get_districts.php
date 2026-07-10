<?php
header('Content-Type: application/json');

require_once '../config/regions_districts.php';

if (isset($_GET['region'])) {
    $region = $_GET['region'];
    
    if (isset($regions_districts[$region])) {
        echo json_encode([
            'success' => true,
            'districts' => $regions_districts[$region]
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Region not found'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Region parameter required'
    ]);
}
?>
