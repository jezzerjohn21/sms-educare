<?php
session_start();

// Check if the session variable 'visited' is not set
if(!isset($_SESSION['visited'])) {
  // Set the session variable 'visited' to true
  $_SESSION['visited'] = true;

  // Open the text file containing the visitor count
  $file = fopen("visitor_count.txt", "r+");

  // Lock the file for writing
  flock($file, LOCK_EX);

  // Read the current visitor count from the file
  $count = fgets($file);

  // Increment the visitor count
  $count++;

  // Write the new visitor count back to the file
  fseek($file, 0);
  fputs($file, $count);

  // Release the file lock and close the file
  flock($file, LOCK_UN);
  fclose($file);
}

// Open the text file containing the visitor count
$file = fopen("visitor_count.txt", "r");

// Read the current visitor count from the file
$count = fgets($file);

// Close the file
fclose($file);

// Display the visitor count as a ticket on the left side of the screen
echo '<div style="position: fixed; top: 50%; left: 0;"><img src="gear.gif" style="width: 30px;"> '.$count.'</div>';
?>
