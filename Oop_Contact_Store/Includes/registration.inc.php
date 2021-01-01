<?php session_start();
include "../Database/registration.data.php";
include __DIR__ . "./validation.inc.php";

$register = new Registration();
$validate = new Validation();

// ******* getting form data through post method ****************
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit'])) {
        $user_name = $validate->validate_input($_REQUEST['user_name']);
        $user_number = $validate->validate_input($_REQUEST['user_number']);
        $user_email = $validate->validate_input($_REQUEST['user_email']);
        $pass = $validate->validate_input($_REQUEST['user_pass']);
        $confirm_pass = $validate->validate_input($_REQUEST['user_confirm_password']);
        $gender = $_REQUEST['gender'];
        $check_password = $validate->pass_check($pass, $confirm_pass);
        $check_email = $validate->email_check($user_email);

        if ($check_email == true && $check_password == true) {

            $user = $register->create_user($user_name, $user_number, $user_email, $pass, $gender);
            if ($user == 404) {
                $_SESSION['error_type'] = "danger";
                $_SESSION['error'] = "something went Wronge , Please Try Again";
                header("location: ../registration.php?connection_Error");
                exit();
            } else if ($user == 102) {
                $_SESSION['error_type'] = "danger";
                $_SESSION['error'] = "User Already Exists";
                header("location: ../registration.php?user_Already_Exists");
                exit();
            } else if ($user == 100) {
                $_SESSION['error_type'] = "success";
                $_SESSION['error'] = "registration successfull";
                header("location: ../registration.php?Registration_Successful");

            }

        } else {
            $_SESSION['error_type'] = "danger";
            $_SESSION['error'] = "Password or Email Error";
            header("location: ../registration.php");
            exit();
        }

    }
}
