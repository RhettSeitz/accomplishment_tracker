1| <?php // Start PHP script
2| // Load the existing accomplishments
3| // Loads the item by its ID.
4| // Shows its current text in the form.
5| // Updates the JSON file on submit.
6| 
7| $file = 'accomplishments.json'; // Path to the JSON file storing accomplishments
8| $accomplishments = []; // Initialize the accomplishments array
9| if (file_exists($file)) { // Check if the JSON file exists
10|     $accomplishments = json_decode(file_get_contents($file), true); // If so, load and decode its contents into an array
11| }
12| 
13| $id = $_GET['id'] ?? ''; // Get the ID from the query string, or use empty string if not set
14| $found = false; // Flag to track if the accomplishment is found
15| $accomplishmentText = ''; // Variable to store the text of the accomplishment to edit
16| 
17| foreach ($accomplishments as $index => $item) { // Loop through each accomplishment in the array
18|     if ($item['id'] == $id) { // If the current item's ID matches the one from the query string
19|         $found = true; // Set found flag to true
20|         $accomplishmentText = $item['text']; // Store the current text for editing
21|         $editIndex = $index; // Store the index to use for updating later
22|         break; // Stop looping since we've found the item
23|     }
24| }
25| 
26| if (!$found) { // If the accomplishment was not found
27|     echo "Accomplishment not found."; // Show an error message
28|     exit; // Stop execution
29| }
30| 
31| // Handle form submission
32| if ($_SERVER['REQUEST_METHOD'] === 'POST') { // If the form was submitted via POST
33|     $text = trim($_POST['text'] ?? ''); // Get the submitted text and trim whitespace
34|     if ($text !== '') { // If the text is not empty
35|         $accomplishments[$editIndex]['text'] = $text; // Update the text in the accomplishments array
36|         file_put_contents($file, json_encode($accomplishments, JSON_PRETTY_PRINT)); // Save the updated array back to the JSON file
37|         header('Location: index.php'); // Redirect back to the main page
38|         exit; // Stop execution after redirect
39|     }
40| }
41| ?> // End PHP script
42| 
43| <!DOCTYPE html> <!-- HTML document type declaration -->
44| <html> <!-- Start HTML -->
45| <head> <!-- Start head section -->
46|     <title>Edit Accomplishment</title> <!-- Page title -->
47| </head> <!-- End head -->
48| <body> <!-- Start body -->
49|     <h1>Edit Accomplishment</h1> <!-- Page header -->
50|     <form method="post"> <!-- Start form with POST method -->
51|         <label> <!-- Label for input -->
52|             What did you accomplish?<br> <!-- Prompt for user -->
53|             <input type="text" name="text" required value="<?php echo htmlspecialchars($accomplishmentText); ?>"> <!-- Text input pre-filled with current value, with HTML escaping for safety -->
54|         </label> <!-- End label -->
55|         <br><br> <!-- Line breaks for spacing -->
56|         <input type="submit" value="Update"> <!-- Button to submit the form -->
57|     </form> <!-- End form -->
58|     <br> <!-- Line break -->
59|     <a href="index.php">Back to List</a> <!-- Link to go back to the main list -->
60| </body> <!-- End body -->
61| </html> <!-- End HTML -->
62| 
