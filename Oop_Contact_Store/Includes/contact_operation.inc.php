<?php
include "./Database/contact_operation.data.php";

$contact = new Contacts();

$user_id = $_SESSION['login_session_id'];
$contact_details = $contact->get_contact($user_id);
