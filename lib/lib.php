<?php

function pget($param_get) {
    $ret = null;
    if (isset($_GET[$param_get])) {
        $ret = filter_input(INPUT_GET, $param_get, FILTER_SANITIZE_SPECIAL_CHARS);
    } else
        $ret = null;
    return $ret;
}

function ppost($param_post) {
    $ret = null;
    if (isset($_POST[$param_post])) {
        $ret = filter_input(INPUT_POST, $param_post, FILTER_SANITIZE_SPECIAL_CHARS);
    } else
        $ret = null;
    return $ret;
}

function set_message($message) {
    $messages = $_SESSION['messages'];
    $messages[] = $message;
    $_SESSION['messages'] = $messages;
}

function get_messages() {
    $messages = $_SESSION['messages'];
    unset($_SESSION['messages']);
    return $messages;
}

function set_error($error) {
    $errors = $_SESSION['errors'];
    $errors[] = $error;
    $_SESSION['errors'] = $errors;
}

function get_errors() {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
    return $errors;
}

function count_errors() {
    $errors = $_SESSION['errors'];
    return count($errors);
}

function session_get($session_name, $default = '') {
    if (isset($_SESSION[$session_name])) {
        return $_SESSION[$session_name];
    }
    return $default;
}

function print_messages() {
    $errors = get_errors();
    $html = '';
    if (isset($errors) && count($errors) > 0) {
        $html = ' <div class="note note-danger">';
        foreach ($errors as $error) {
            $html .= '<h4 class="block">' . $error . '</h4>';
        }
        $html .= '</div>';
    }
    $messages = get_messages();
    if (isset($messages) && count($messages) > 0) {
        $html .= ' <div class="note note-success">';
        foreach ($messages as $message) {
            $html .= '<h4 class="block">' . $message . '</h4>';
        }
        $html .= '</div>';
    }
    if (isset($html)) {
        return $html;
    }
    return '';
}
