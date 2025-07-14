// For adding new accomplishments
// Displays a form to enter a new accomplishment.
// On submit, adds the entry to the JSON file and redirects to the main page.

<?php
// If the form is submitted, process the new accomplishment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = trim($_POST['text'] ?? '');

    if ($text !== '') {
        $file = 'accomplishments.json';
        $accomplishments = [];
        if (file_exists($file)) {
            $accomplishments = json_decode(file_get_contents($file), true);
        }

        // Generate a unique ID (timestamp + random number)
        $id = time() . rand(1000, 9999);

        // Add new accomplishment
        $accomplishments[] = ['id' => $id, 'text' => $text];

        // Save back to file
        file_put_contents($file, json_encode($accomplishments, JSON_PRETTY_PRINT));

        // Redirect to index
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Accomplishment</title>
</head>
<body>
    <h1>Add New Accomplishment</h1>
    <form method="post">
        <label>
            What did you accomplish?<br>
            <input type="text" name="text" required>
        </label>
        <br><br>
        <input type="submit" value="Add">
    </form>
    <br>
    <a href="index.php">Back to List</a>
</body>
</html>
