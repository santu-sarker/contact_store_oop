<?php
include __DIR__ . "./database.data.php";

class Login_User extends Database
{
    public function user($verify_key, $password)
    {
        $message = array();
        $query = "";
        if (is_numeric($verify_key)) {
            $query = "SELECT * FROM master_useroop WHERE  user_number = '$verify_key';";

        } else {
            $query = "SELECT * FROM master_useroop WHERE  user_email = '$verify_key';";
        }
        $user_exists = $this->read($query);
        if ($user_exists == 404) {
            $message['error'] = 404;
            return $message; //connection error
        } else if ($user_exists == 202) {
            $message['error'] = 102;
            return $message; // user does not exists
        } else {

            $hash_password = $user_exists[0]['user_password'];
            if (password_verify($password, $hash_password)) {

                $message['error'] = 100; // code for successful login
                $message['login_session_id'] = $user_exists[0]['user_id'];
                $message['login_session_name'] = $user_exists[0]['user_name'];
                return $message;
            } else {
                $message['error'] = 101; // code for invalid verify key or password
                return $message;
            }

        }

    }

}
