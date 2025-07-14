<?php
// Load the existing accomplishments
// Loads the item by its ID.
// Shows its current text in the form.
// Updates the JSON file on submit.

$file = 'accomplishments.json';
$accomplishments = [];
if (file_exists($file)) {
    $accomplishments = json_decode(file_get_contents($file), true);
}

$id = $_GET['id'] ?? '';
$found = false;
$accomplishmentText = '';

foreach ($accomplishments as $index => $item) {
    if ($item['id'] == $id) {
        $found = true;
        $accomplishmentText = $item['text'];
        $editIndex = $index;
        break;
    }
}

if (!$found) {
    echo "Accomplishment not found.";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = trim($_POST['text'] ?? '');
    if ($text !== '') {
        $accomplishments[$editIndex]['text'] = $text;
        file_put_contents($file, json_encode($accomplishments, JSON_PRETTY_PRINT));
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Accomplishment</title>
</head>
<body>
    <h1>Edit Accomplishment</h1>
    <form method="post">
        <label>
            What did you accomplish?<br>
            <input type="text" name="text" required value="<?php echo htmlspecialchars($accomplishmentText); ?>">
        </label>
        <br><br>
        <input type="submit" value="Update">
    </form>
    <br>
    <a href="index.php">Back to List</a>
</body>
</html>
