<?php

// define variables and set to empty values
// $emailErr = $streetErr = $cityErr = $streetnumberErr = $zipcodeErr = "";

$errors = [];
$email = $street = $city = $streetnumber = $zipcode = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["email"])) {
    $errors['emailErr'] = "* Email is required";
  } else {
    $email = test_input($_POST["email"]);

    // The easiest and safest way to check whether an email address is well-formed is to use PHP's filter_var() function.
    // In the code below, if the e-mail address is not well-formed, then store an error message:

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['emailErr'] = "* Invalid email format";
    }
  }

  if (empty($_POST["street"]) || !isset($_POST["street"])) {
    $errors['streetErr'] = "* Street is required";
  } else {
    $street = test_input($_POST["street"]);

    // The code below shows a simple way to check if the name field only contains letters, dashes, apostrophes and whitespaces. 
    // If the value of the name field is not valid, then store an error message:

    if (!preg_match("/^[a-zA-Z-' ]*$/", $street)) {
      $errors['streetErr'] = "* Only letters and white space allowed";
    } else {
      $_SESSION["street"] = $street;
    }
  }

  if (empty($_POST["city"]) || !isset($_POST["city"])) {
    $errors['cityErr'] = "* City is required";
  } else {
    $city = test_input($_POST["city"]);

    if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
      $errors['cityErr'] = "* Only letters and white space allowed";
    } else {
      $_SESSION["city"] = $city;
    }
  }

  if (empty($_POST["streetnumber"]) || !isset($_POST["streetnumber"])) {
    $errors['streetnumberErr'] = "* Streetnumber is required";
  } else {

    $streetnumber = test_input($_POST["streetnumber"]);

    if (!is_numeric($streetnumber)) {
      $errors['streetnumberErr'] = "* Only numbers allowed";
    } else {
      $_SESSION["streetnumber"] = $streetnumber;
    }
  }

  if (empty($_POST["zipcode"]) || !isset($_POST["zipcode"])) {
    $errors['zipcodeErr'] = "* Zipcode is required";
  } else {
    $zipcode = test_input($_POST["zipcode"]);
    if (!is_numeric($zipcode)) {
      $errors['zipcodeErr'] = "* Only numbers allowed";
    } else {
      $_SESSION["zipcode"] = $zipcode;
    }
  }

  // Checking if forms are filled in correctly
  if (empty($errors)) {

    // CHECK THE DELIVERY TIME
    if (isset($_POST['express_delivery'])) {
      echo "<div class='alert alert-success' role='alert'>Order sent. The delivery will arrive in 45 minutes.</div>";
    } else {
      echo "<div class='alert alert-success' role='alert'>Order sent. The delivery will arrive in 2 hours.</div>";
    }
  } else {

    //  Display errors
    foreach ($errors as $val) {
      echo "<div class='alert alert-warning' role='alert'><span class='message'>$val</div>";
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

function test_input($data)
{
  $data = trim($data); // Strip whitespace (or other characters) from the beginning and end of a string
  $data = stripslashes($data); // Unquotes a quoted string
  $data = htmlspecialchars($data); // Convert special characters to HTML entities
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
