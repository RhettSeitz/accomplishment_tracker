1| <?php                       // Start of the PHP script

2| $file = 'accomplishments.json'; // Set the filename where accomplishments are stored
3| $accomplishments = [];          // Initialize an empty array for accomplishments
4| if (file_exists($file)) {       // Check if the accomplishments file exists
5|     $accomplishments = json_decode(file_get_contents($file), true); // Load and decode the JSON data into an array
6| }
7| 
8| $id = $_GET['id'] ?? '';        // Get the 'id' parameter from the URL query string (or set to empty if not present)
9| $newList = [];                  // Initialize an array to hold the filtered accomplishments
10| foreach ($accomplishments as $item) {   // Loop through each accomplishment
11|     if ($item['id'] != $id) {           // If the item's ID does NOT match the ID to delete
12|         $newList[] = $item; // Keep all except the one to delete
13|     }
14| }
15| 
16| // Save the updated list
17| file_put_contents($file, json_encode($newList, JSON_PRETTY_PRINT)); // Write the updated list back to the JSON file, nicely formatted
18| 
19| // Redirect back to index
20| header('Location: index.php'); // Send the browser back to the main page
21| exit;                         // Stop executing the script
22| ?>
23|
