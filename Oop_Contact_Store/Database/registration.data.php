<?php
include __DIR__ . "./database.data.php";

class Registration extends Database
{
    public function create_user($user_name, $user_number, $user_email, $pass, $gender)
    {
        $message = array();
        $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
        $query = "SELECT * FROM master_useroop WHERE user_email = '$user_email' or user_number = '$user_number';";
        $user_exists = $this->read($query);
        if ($user_exists == 404) {

            return 404; // connection error

        } else if ($user_exists == 202) {
            $query = "INSERT INTO master_useroop(user_name ,user_number, user_email, user_password,user_gender) VALUES('$user_name','$user_number','$user_email','$hash_pass','$gender');";
            $create_res = $this->create($query);
            if ($create_res) {
                return 100; // user created successfully
            }

        } else {
            return 102; // user already exists
        }

    }

}
