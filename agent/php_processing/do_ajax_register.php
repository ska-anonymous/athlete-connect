<?php
// make a response array which data about the status of the the process, whether the registeration is successfull or not. and if not then why.

$response = array("error" => false, "error_message" => "");
try {
    require_once("db_connect.php");
} catch (Exception $e) {
    $response["error"] = true;
    $response["error_message"] = " Database Connection Failed ";
    echo json_encode($response);
    exit(0);
}

// fetch post form data
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);
$login_id = trim($_POST['login_id']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);
$city = trim($_POST['city']);
$country = trim($_POST['country']);
$agency_name = trim($_POST['agency_name']);
$agency_address = trim($_POST['agency_address']);
$athlete_benefits = trim($_POST['athlete_benefits']);


// now get profile picture uploaded
if ($_FILES['profile_picture']['name'] == "") {
    $response["error"] = true;
    $response["error_message"] = "Please Upload Profile Picture";
    echo json_encode($response);
    exit(0);
}

$profile_picture = time() . "_" . $_FILES['profile_picture']['name'];


// check for password and retyped password matching
if ($password != $confirm_password) {
    $response["error"] = true;
    $response["invalid_field"] = "password";
    $response["error_message"] = "Passwords do not match";
    echo json_encode($response);
    exit(0);
}

// check for email in database if already exists to avoid saving duplicate emails
$sql = "SELECT * FROM agents WHERE email='$email'";
$qry = $pdo->prepare($sql);
$qry->execute();
if ($qry->rowCount()) {
    $response["error"] = true;
    $response["invalid_field"] = "email";
    $response["error_message"] = "This Email \"$email\" already Exists";
    echo json_encode($response);
    exit(0);
}
// check for login_id in database if already exists to avoid saving duplicate login ids
$sql = "SELECT * FROM agents WHERE login_id='$login_id'";
$qry = $pdo->prepare($sql);
$qry->execute();
if ($qry->rowCount()) {
    $response["error"] = true;
    $response["invalid_field"] = "login_id";
    $response["error_message"] = "This login id \"$login_id\" already Exists";
    echo json_encode($response);
    exit(0);
}
// change the password to hash
$agent_pass = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO `agents`(`first_name`, `last_name`, `email`, `login_id`, `password`, `city`, `country`, `agency_name`, `agency_address`, `athlete_benefits`, `profile_picture`) VALUES ('$first_name','$last_name','$email','$login_id','$agent_pass','$city','$country','$agency_name','$agency_address','$athlete_benefits', '$profile_picture')";
$qry = $pdo->prepare($sql);
$qry->execute();
if ($qry->rowCount()) {
    $response["error"] = false;
    $response["error_message"] = "";
    // now move profile picture to folder as query is successfull
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], '../uploads/profile_pics/' . $profile_picture);
    echo json_encode($response);
    exit(0);
} else {
    $response["error"] = true;
    $response["error_message"] = "Registeration failed! Please try again later";
    echo json_encode($response);
    exit(0);
}

?>