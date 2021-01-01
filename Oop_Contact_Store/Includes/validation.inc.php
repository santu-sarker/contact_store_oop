<?php
class Validation
{
    // ***** function to sanitaize form input  data to prevent cross site attack **********
    public function validate_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        return $data;
    }

// *********** function to check if 2 password actually match & not less than 6 digit **********
    public function pass_check($pass, $confirm_pass)
    {
        if (strlen($pass) >= 6 && (strcmp($pass, $confirm_pass) == 0)) {
            return true;
        } else {
            return false;
        }

    }

// *********** function to validate the email address  ***************
    public function email_check($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return true;
        } else {
            return false;
        }
    }

}
