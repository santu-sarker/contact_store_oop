<?php session_start();
include "../Database/contact_operation.data.php";
include __DIR__ . "./validation.inc.php";

$contact = new Contacts();
$validate = new Validation();
// ******* getting form data through post method ****************
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submit'])) {
        $contact_name = $validate->validate_input($_REQUEST['contact_name']);
        $contact_number = $validate->validate_input($_REQUEST['contact_number']);
        $contact_email = $validate->validate_input($_REQUEST['contact_email']);
        $contact_edit = $_REQUEST['update_contact'];
        if ($validate->email_check($contact_email) == false) {
            $_SESSION['contact_type'] = "warning";
            $_SESSION['contact_msg'] = "Invalid Email Adress";
            header("location: ../index.php");
        } else if ($contact_edit == "true") {
            $contact_id = $validate->validate_input($_REQUEST['contact_id']);
            //echo $contact_id . " || " . $contact_name . " " . $contact_email . " " . $contact_number . "||  " . $_SESSION['login_session_id'];
            $user = $contact->edit_contact($contact_id, $contact_name, $contact_number, $contact_email, $_SESSION['login_session_id']);
            if ($user['error'] == 100) {
                $_SESSION['contact_type'] = "success";
                $_SESSION['contact_msg'] = "Contact Updated Successfully";
                header("location: ../index.php");

            } else if ($user['error'] == 404) {
                $_SESSION['contact_type'] = "danger";
                $_SESSION['contact_msg'] = "Connection Error Occured";
                header("location: ../index.php");

            } else if ($user['error'] == 101) {
                $_SESSION['contact_type'] = "danger";
                $_SESSION['contact_msg'] = "Failed to update";
                header("location: ../index.php");

            }
        } else {
            $user = $contact->add_contact($contact_name, $contact_number, $contact_email, $_SESSION['login_session_id']);
            if ($user['error'] == 100) {
                $_SESSION['contact_type'] = "success";
                $_SESSION['contact_msg'] = "Contact Added Successfully";
                header("location: ../index.php?contact_added_successfully");

            } else if ($user['error'] == 404) {
                $_SESSION['contact_type'] = "danger";
                $_SESSION['contact_msg'] = "Connection Error";
                header("location: ../index.php?connection_error");
            } else if ($user['error'] == 103) {
                $_SESSION['contact_type'] = "danger";
                $_SESSION['contact_msg'] = "Contact Already Exists";
                header("location: ../index.php?contact_already_Exists");

            } else if ($user['error'] == 102) {
                $_SESSION['contact_type'] = "danger";
                $_SESSION['contact_msg'] = "something went wrong";
                header("location: ../index.php?failed_to_insert_data");

            }
        }
    }
}

/*
$user = edit_contact($contact_name, $contact_number, $contact_email, $_SESSION['login_session_id']);
if ($user['error'] == 100) {
$_SESSION['contact_type'] = "success";
$_SESSION['contact_msg'] = "Contact Updated Successfully";
header("location: ../index.php");

} else if ($user['error'] == 102) {
$_SESSION['contact_type'] = "danger";
$_SESSION['contact_msg'] = "Connection Error";
header("location: ../index.php");
} else if ($user['error'] == 101) {
$_SESSION['contact_type'] = "danger";
$_SESSION['contact_msg'] = "Failed Update Contacts";
header("location: ../index.php");

}

$user = edit_contact($contact_name, $contact_number, $contact_email, $_SESSION['login_session_id']);
if ($user['error'] == 100) {
$_SESSION['contact_type'] = "success";
$_SESSION['contact_msg'] = "Contact Updated Successfully";
header("location: ../index.php");

} else if ($user['error'] == 101 || $user['error'] == 102) {
$_SESSION['contact_type'] = "danger";
$_SESSION['contact_msg'] = "Connection Error";
header("location: ../index.php");
}
 */
