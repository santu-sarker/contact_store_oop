<?php session_start();
include "../Database/login_user.data.php";
include __DIR__ . "./validation.inc.php";

$validate = new Validation();
$log_user = new Login_User();
// ******* getting form data through post method ****************
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit'])) {
        $verify_key = $validate->validate_input($_REQUEST['verify_key']);

        $pass = $validate->validate_input($_REQUEST['input_password']);
        $login_check = isset($_REQUEST['login_check']);

        $user = $log_user->user($verify_key, $pass);
        if ($user['error'] == 100) {
            $_SESSION['login_err_type'] = "success";
            $_SESSION['login_session_id'] = $user['login_session_id'];
            $_SESSION['login_session_name'] = $user['login_session_name'];

            if ($login_check) {
                login_save($_SESSION['login_session_id'], $_SESSION['login_session_name']);
            }
            header("location: ../index.php");

        } else if ($user['error'] == 101) {
            $_SESSION['login_err_type'] = "danger";
            $_SESSION['login_err'] = "Invalid Credentials ";
            header("location: ../login.php?Invalid_Credentials");

        } else if ($user['error'] == 102) {
            $_SESSION['login_err_type'] = "danger";
            $_SESSION['login_err'] = "User Do Not  Exists";
            header("location: ../login.php?User_do_not_exists");

        } else if ($user['error'] == 404) {
            $_SESSION['login_err_type'] = "warning";
            $_SESSION['login_err'] = "Connection Error !";
            header("location: ../login.php?Connection_Error");

        }

    }

}

function login_save($session_id, $session_name)
{
    $login_session_id = $session_id;
    $login_session_name = $session_name;

    setcookie("id", $login_session_id, time() + (86400 * 2), "/");
    setcookie("name", $login_session_name, time() + (86400 * 2), "/");

}
