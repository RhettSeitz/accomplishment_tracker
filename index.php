<?php
// Load accomplishments from the JSON file
$accomplishmentsFile = 'accomplishments.json';
$accomplishments = [];
if (file_exists($accomplishmentsFile)) {
    $accomplishments = json_decode(file_get_contents($accomplishmentsFile), true);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Accomplishment Tracker</title>
</head>
<body>
    <h1>Today's Accomplishments</h1>
    <a href="add.php">Add New Accomplishment</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Accomplishment</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($accomplishments as $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item['id']); ?></td>
            <td><?php echo htmlspecialchars($item['text']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo urlencode($item['id']); ?>">Edit</a> |
                <a href="delete.php?id=<?php echo urlencode($item['id']); ?>" onclick="return confirm('Delete this accomplishment?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
