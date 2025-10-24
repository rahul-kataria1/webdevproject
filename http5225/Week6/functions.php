<?php
session_start();

// set message
function set_message($message, $className = 'info') {
    $_SESSION['message'] = $message;
    $_SESSION['className'] = $className;
}

// get message
function get_message() {
    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-' . $_SESSION['className'] . ' mt-3" role="alert">'
              . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
        unset($_SESSION['className']);
    }
}
?>
