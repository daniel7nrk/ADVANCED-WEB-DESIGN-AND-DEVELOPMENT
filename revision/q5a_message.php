<?php
// Question 5 (a): function using the concatenation operator (.)
function generateMessage($firstName, $lastName, $roomNumber) {
    return "Welcome " . $firstName . " " . $lastName . "! Your room number is " . $roomNumber . ".";
}

echo generateMessage("John", "Doe", 205);
// Output: Welcome John Doe! Your room number is 205.
?>


<?php
// Question 5 (b): same function, now including the current date
function generateMessage($firstName, $lastName, $roomNumber) {
    return "Welcome " . $firstName . " " . $lastName . "! Your room number is " . $roomNumber
         . ". Checked in on " . date("F j, Y") . ".";
}
 
echo generateMessage("Jane", "Smith", 310);
// Example output: Welcome Jane Smith! Your room number is 310. Checked in on April 13, 2026.
?>
 

 