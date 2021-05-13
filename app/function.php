<?php
include_once 'login.php';
global $dbhost, $dbuser, $dbpass, $dbname;

$conn = @new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn->connect_error) {
} else {
    $system_error_message = $conn->connect_error;
    $user_error_message = "Помилка із підключенням до бази даних!";
    handle_error($user_error_message, $system_error_message);
}


function handle_error($user_error_message, $system_error_message)
{
    header("Location: show_error.php?" .
        "error_message={$user_error_message}&" .
        "system_error_message={$system_error_message}");
    exit();
}

?>
