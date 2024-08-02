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
$login_id = trim($_POST['login_id']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);
$email = trim($_POST['email']);
$date_of_birth = trim($_POST['date_of_birth']);
$gender = trim($_POST['gender']);
$nationality = trim($_POST['nationality']);
$address = trim($_POST['address']);
$city = trim($_POST['city']);
$country = trim($_POST['country']);
$height = trim($_POST['height']);
$weight = trim($_POST['weight']);
$primary_sport = trim($_POST['primary_sport']);
$secondary_sports = trim($_POST['secondary_sports']);
$awards = trim($_POST['awards']);
$education_level = trim($_POST['education_level']);
$athletic_achievements = trim($_POST['athletic_achievements']);

// pictures uploads
if ($_FILES['profile_picture']['name'] == "") {
    $response["error"] = true;
    $response["error_message"] = "Please Upload Pictures";
    echo json_encode($response);
    exit(0);
}

if (count($_FILES['sport_pictures']['name']) != 3) {
    $response["error"] = true;
    $response["error_message"] = "Please Upload Only 3 Sports Pictures";
    echo json_encode($response);
    exit(0);
}

$profile_picture = time() . "_" . $_FILES['profile_picture']['name'];
$sport_pics = $_FILES['sport_pictures'];
$pics_string = "";
foreach ($sport_pics['tmp_name'] as $key => $tmpName) {
    $pics_string .= $sport_pics['name'][$key] . "|next|";
}

// check for password and retyped password matching
if ($password != $confirm_password) {
    $response["error"] = true;
    $response["invalid_field"] = "password";
    $response["error_message"] = "Passwords do not match";
    echo json_encode($response);
    exit(0);
}

// check for email in database if already exists to avoid saving duplicate emails
$sql = "SELECT * FROM athletes WHERE email ='$email'";
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
$sql = "SELECT * FROM athletes WHERE login_id='$login_id'";
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
$athlete_pass = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO `athletes`(`login_id`, `email`, `password`, `first_name`, `last_name`, `date_of_birth`, `gender`, `nationality`, `address`, `city`, `country`, `height`, `weight`, `primary_sport`, `secondary_sports`, `awards`, `education_level`, `athletic_achievements`, `profile_picture`, `sport_pictures`) VALUES ('$login_id','$email','$athlete_pass','$first_name','$last_name','$date_of_birth','$gender','$nationality','$address','$city','$country','$height','$weight','$primary_sport','$secondary_sports','$awards','$education_level','$athletic_achievements','$profile_picture','$pics_string')";

$qry = $pdo->prepare($sql);
$qry->execute();
if ($qry->rowCount()) {
    $response["error"] = false;
    $response["error_message"] = "";

    // no upload files as the database entry is successfull
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], '../uploads/profile_pics/' . $profile_picture);
    foreach ($sport_pics['tmp_name'] as $key => $tmpName) {
        move_uploaded_file($tmpName, '../uploads/sport_pics/' . $sport_pics['name'][$key]);
    }

    echo json_encode($response);
    exit(0);
} else {
    $response["error"] = true;
    $response["error_message"] = "Registeration failed! Please try again later";
    echo json_encode($response);
    exit(0);
}

?>