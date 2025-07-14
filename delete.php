<?php
$file = 'accomplishments.json';
$accomplishments = [];
if (file_exists($file)) {
    $accomplishments = json_decode(file_get_contents($file), true);
}

$id = $_GET['id'] ?? '';
$newList = [];
foreach ($accomplishments as $item) {
    if ($item['id'] != $id) {
        $newList[] = $item; // Keep all except the one to delete
    }
}

// Save the updated list
file_put_contents($file, json_encode($newList, JSON_PRETTY_PRINT));

// Redirect back to index
header('Location: index.php');
exit;
?>
