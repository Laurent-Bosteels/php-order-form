<?php 

// define variables and set to empty values
$emailErr = $streetErr = $cityErr = $streetnumberErr = $zipcodeErr = "";
$email = $street = $city = $streetnumber = $zipcode = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["email"])) {
    $emailErr = "* Email is required";
  } else {
    $email = test_input($_POST["email"]);

    // The easiest and safest way to check whether an email address is well-formed is to use PHP's filter_var() function.
    // In the code below, if the e-mail address is not well-formed, then store an error message:

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "* Invalid email format";
  }

  }
  
  if (empty($_POST["street"])) {
    $streetErr = "* Street is required";
  } else {
    $street = test_input($_POST["street"]);

    // The code below shows a simple way to check if the name field only contains letters, dashes, apostrophes and whitespaces. 
    // If the value of the name field is not valid, then store an error message:

    if (!preg_match("/^[a-zA-Z-' ]*$/",$street)) {
      $streetErr = "* Only letters and white space allowed";
    }

  }
  
  if (empty($_POST["city"])) {
    $cityErr = "* City is required";
  } else {
    $city = test_input($_POST["city"]);

    if (!preg_match("/^[a-zA-Z-' ]*$/",$city)) {
      $cityErr = "* Only letters and white space allowed";
    }

  }

  if (empty($_POST["streetnumber"])) {
    $streetnumberErr = "* Streetnumber is required";
  } else {

    $streetnumber = test_input($_POST["streetnumber"]);
    
    if (!is_numeric($streetnumber)) {
      $streetnumberErr = "* Only numbers allowed";
    }

  }

  if (empty($_POST["zipcode"])) {
    $zipcodeErr = "* Zipcode is required";
  } else {
    $zipcode = test_input($_POST["zipcode"]);

    if (!is_numeric($zipcode)) {
      $zipcodeErr = "* Only numbers allowed";
    }
  }
}

// The first thing we will do is to pass all variables through PHP's htmlspecialchars() function.
// When we use the htmlspecialchars() function, this would not be executed, because it would be saved as HTML escaped code
// The code is now safe to be displayed on a page or inside an e-mail.

// when the user submits the form:
// 1. Strip unnecessary characters (extra space, tab, newline) from the user input data (with the PHP trim() function)
// 2. Remove backslashes (\) from the user input data (with the PHP stripslashes() function)
// The next step is to create a function that will do all the checking
// Which is much more convenient than writing the same code over and over again.

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// In the following code we have added some new variables: 
// $emailErr = $streetErr = $cityErr = $streetnumberErr = $zipcodeErr
// These error variables will hold error messages for the required fields.


// Also added an if else statement for each $_POST variable. 
// This checks if the $_POST variable is empty (with the PHP empty() function). 
// If it is empty, an error message is stored in the different error variables, 
// and if it is not empty, it sends the user input data through the test_input() function:

// Then in the HTML form, we add a little script after each required field, 
/// which generates the correct error message if needed 
// (that is if the user tries to submit the form without filling out the required fields)

// NEXT STEP: how to keep the values in the input fields when the user hits the submit button.
// To show the values in the input fields after the user hits the submit button
// We add a little PHP script inside the value attribute of the input fields

