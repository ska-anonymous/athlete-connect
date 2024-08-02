<?php
session_start();
if (!$_SESSION['athlete_logged']) {
    header('location:dashboard/login.php');
} else {
    header('location:dashboard/index.php');
}
?>