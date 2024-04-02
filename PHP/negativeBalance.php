<?php
echo "<link rel='stylesheet' href='..\css\style.css'>";

require_once __DIR__ . "../../vendor/autoload.php";
$client = new MongoDB\Client("mongodb://localhost:27017");
$database = $client->selectDatabase('dbforlab');
 $collection = $database -> users;
 $filter = ['balance' => ['$lt' => 0]];
 $projection = ['projection' => ['_id'=>0, 'login' => 1, 'staticIP' => 1, 'balance'=> 1, 'message'=>1]];
 $cursor = $collection -> find($filter, $projection);
 $data = array();
 echo "<table>
        <thead>
        <tr>
        <th>Login</th>
        <th>IP</th>
        <th>Balance</th>
        <th>Message</th>
        </tr>
        </thead>";
foreach($cursor as $document){
    $login = $document['login'];
    $staticIP = $document['staticIP'];
    $balance = $document['balance'];
    $message = $document['message'];
    $data[] = array(
        'login' => $login,
        'staticIP' => $staticIP,
        'balance' => $balance,
        'message' => $message
    );
    echo "<tbody>
    <tr>
    <td>$login</td>
    <td>$staticIP</td>
    <td>$balance</td>
    <td>$message</td>
    </tr>
    </tbody>";
}
echo "</table>";

echo '<script src="../JS/script.js"></script>';
  
echo "<script>
const data = " . json_encode($data) . ";
storageFunction('balance');
</script>";
echo "<button onclick=\"window.location.href='../HTML/index.html'\">Return</button>";
?>