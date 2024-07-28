<?php
session_start(); // Start the session
unset($_SESSION['is_logged_in']);
unset($_SESSION['user_data']);
session_destroy();
// Redirect
header('Location: \hackathon-week-1\');
?>
