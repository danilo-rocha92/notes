<?php
// *** Logout the current user.
$logoutGoTo = "../?login=true";
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['SS_UserLogin'] = NULL;
$_SESSION['SS_UserID'] = NULL;
$_SESSION['SS_UserGroupID'] = NULL;
$_SESSION['SS_UserName'] = NULL;
unset($_SESSION['SS_UserLogin']);
unset($_SESSION['SS_UserID']);
unset($_SESSION['SS_UserGroupID']);
unset($_SESSION['SS_UserName']);
unset($_SESSION['PrevUrl']);
if ($logoutGoTo != "") {
    header("Location: $logoutGoTo");
    exit;
}
?>