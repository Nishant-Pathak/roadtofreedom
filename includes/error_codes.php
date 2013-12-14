<?php

function IsError($code) {
   if( intval(($code % 10000 ) / 1000) == 1) {
        return true;
    }
    return false;
}

function GetError($code) {
    if( IsError($code)) {
        return "ERROR!";
    }
    return "SUCCESS!";
};

function GetSeverity($code) {
    if(IsError($code)) {
        return "alert-danger";
    }
    return "alert-success";
}

$error_codes = array(
    "DEFAULT"                    => array(11000, "Broken Link---/~/----- ."),
    "VALID_LOGOUT"               => array(10010, "Logged Out Successfully."),
    "INVALID_LOGOUT"             => array(11010, "Invalid logout. Please try again."),
    "VALID_LOGIN"                => array(10020, "Logged in Successfully."),
    "INVALID_LOGIN"              => array(11020, "Invalid login. Please try again."),
    "VALID_REGISTRATION"         => array(10030, "Your account has been registered. Please login."),
    "INVALID_REGISTRATION"       => array(11030, "Unable to register. Please retry."),
    "INVALID_REGISTRATION_1"     => array(11031, "Unable to register. Mail Id already exist.")
);

function getAlertBanner($eStr) {
    global $error_codes;
    if(!array_key_exists($eStr, $error_codes)) {
       return "";
    }
    $msg = $error_codes[$eStr];
    $alertBanner = "";
    $alertBanner .= '<div class="alert '.GetSeverity($msg[0]).' alert-fade" style="display: block;">';
    $alertBanner .= '<strong>'.GetError($msg[0]).'</strong> '.$msg[1];
    $alertBanner .= '</div>';
    return $alertBanner;
}

?>