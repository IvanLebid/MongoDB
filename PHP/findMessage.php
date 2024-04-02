<?php
echo "<link rel='stylesheet' href='..\css\style.css'>";
require_once __DIR__ . "../../vendor/autoload.php";
$client = new MongoDB\Client("mongodb://localhost:27017");
$database = $client->selectDatabase('dbforlab');

$login = $_GET["login"];

$collection = $database->users;
$cursor = $collection -> find(['login'=> $login], ['projection' => ['_id'=>0, 'staticIP' => 1, 'message'=>1]]);
$data = array();

echo "<table>
        <thead>
        <tr>
        <th>IP</th>
        <th>Message</th>
        </tr>
        </thead>";
foreach($cursor as $document){
    $staticIP = $document['staticIP'];
    $message = $document['message'];
    $data[] = array(
        'staticIP' => $staticIP,
        'message' => $message
    );


    echo "<tbody>
    <tr>
    <td>$staticIP</td>
    <td> $message</td>
    </tr>
    </tbody>";
}
echo "</table>";

echo '<script src="../JS/script.js"></script>';
  
echo "<script>
const data = " . json_encode($data) . ";
storageFunction('message');
</script>";
echo "<button onclick=\"window.location.href='../HTML/index.html'\">Return</button>";
?>