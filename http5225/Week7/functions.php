<?php
session_start();

function set_message($message, $className = 'info') {
    $_SESSION['message'] = $message;
    $_SESSION['className'] = $className;
}

function get_message() {
    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-' . $_SESSION['className'] . ' mt-3">' .
             $_SESSION['message'] . '</div>';
        unset($_SESSION['message'], $_SESSION['className']);
    }
}

//Require login before accessing secure pages
function secure_page() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}

// Simple password hashing wrapper
function hash_pass($plain) {
    return password_hash($plain, PASSWORD_BCRYPT);
}

//Check password
function verify_pass($plain, $hashed) {
    return password_verify($plain, $hashed);
}
?>
