<?php
require_once __DIR__ . "../../vendor/autoload.php";
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $database = $client->selectDatabase('dbforlab');

    $ip = $_GET["ip"];

    $collection = $database -> network;
    $cursor = $collection->findOne(['adressIP' => $ip]);



    $inputTraffic = $cursor['inputTraffic']; 
    $outputTraffic = $cursor['outputTraffic']; 

    $totalTraffic = $inputTraffic + $outputTraffic;
    $data[] = array(
        'adressIp' => $ip,
        'totalTraffic' => $totalTraffic
    );

    echo "Total traffic to user with IP <b>{$ip}</b> is <b>{$totalTraffic}</b><br>";
    echo '<script src="../JS/script.js"></script>';
  
    echo "<script>
    const data = " . json_encode($data) . ";
    storageFunction('traffic');
    </script>";


echo "<button onclick=\"window.location.href='../HTML/index.html'\">Return</button>";
    
?>