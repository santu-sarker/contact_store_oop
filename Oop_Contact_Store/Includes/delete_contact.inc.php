<?php session_start();
include "../Database/contact_operation.data.php";

$delete_user = new Contacts();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {
        $contact_id = $_POST['delete_id'];
        $user_id = $_SESSION['login_session_id'];
        $response = $delete_user->delete_contact($contact_id, $user_id);
        if ($response['error'] == 100) {
            $_SESSION['contact_type'] = "success";
            $_SESSION['contact_msg'] = "Contact deleted Successfully";
            header("location: ../index.php");

        } else if ($response['error'] == 404) {
            $_SESSION['contact_type'] = "danger";
            $_SESSION['contact_msg'] = "Connection Error Occured";
            header("location: ../index.php");

        } else if ($response['error'] == 101) {
            $_SESSION['contact_type'] = "danger";
            $_SESSION['contact_msg'] = "Failed to delete";
            header("location: ../index.php");

        }

    }
}
/*
$response = $delete_user->delete_contact($user_id, $contact_id);

if ($response['error'] == 100) {
$_SESSION['contact_type'] = "success";
$_SESSION['contact_msg'] = "Contact deleted Successfully";
header("location: ../index.php");

} else if ($response['error'] == 404) {
$_SESSION['contact_type'] = "danger";
$_SESSION['contact_msg'] = "Connection Error Occured";
header("location: ../index.php");

} else if ($response['error'] == 101) {
$_SESSION['contact_type'] = "danger";
$_SESSION['contact_msg'] = "Failed to delete";
header("location: ../index.php");

}
 */
