<?php
session_start();
if (!$_SESSION['agent_logged']) {
    header('location:dashboard/login.php');
} else {
    header('location:dashboard/index.php');
}
?>