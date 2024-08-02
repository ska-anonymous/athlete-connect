<?php
// make a response object to send back to ajax request which holds data about the login whether successfull or not.
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
$user_login = trim($_POST['user_login']);
$user_pass = trim($_POST['user_pass']);

// check for login email or id if exists then compare passwords to grant login
$sql = "SELECT * FROM agents WHERE email='$user_login' OR login_id='$user_login'";
$qry = $pdo->prepare($sql);
$qry->execute();

if ($qry->rowCount()) {
    $data = $qry->fetch(PDO::FETCH_ASSOC);
    $password_hash = $data['password'];
    if (password_verify($user_pass, $password_hash)) {
        session_start();
        $_SESSION['agent_logged'] = true;
        $_SESSION['agent_id'] = $data['agent_id'];
        $_SESSION['agent'] = $data;
    } else {
        $response["error"] = true;
        $response["incorrect_field"] = "user_pass";
        $response["error_message"] = "Incorrect Password";
    }

} else {
    $response["error"] = true;
    $response["incorrect_field"] = "user_login";
    $response["error_message"] = "Incorrect Email or Login ID";
}

header("content-type:application/json");
echo json_encode($response);

?>