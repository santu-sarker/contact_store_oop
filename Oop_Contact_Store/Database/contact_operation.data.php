<?php
include __DIR__ . "./database.data.php";

class Contacts extends Database
{
    public function get_contact($user_id)
    {
        $message = array();
        $query = "SELECT contact_id ,  contact_name,contact_number,contact_email , reg_date FROM master_contactoop WHERE  user_id = '$user_id';";
        $contact_res = $this->read($query); // reading all contact from database

        if ($contact_res == 202) {
            $message['error'] = 102; //no data found
            return $message;
        } else if ($contact_res == 404) {
            $message['error'] = 404; // connection error
            return $message;
        } else {
            $message['error'] = 100; // data fetched successfully
            $message['response'] = $contact_res;
            return $message;
        }
    }
    public function add_contact($contact_name, $contact_number, $contact_email, $user_id)
    {
        $message = array();
        $query = "SELECT * FROM master_contactoop WHERE user_id = '$user_id' AND
        contact_email = '$contact_email'  AND contact_number = '$contact_number' ;";
        $contact = $this->read($query);
        if ($contact == 202) {
            $query = "INSERT INTO master_contactoop(contact_name ,contact_number, contact_email, user_id) VALUES('$contact_name','$contact_number','$contact_email','$user_id');";
            $contact_insert = $this->create($query);
            if ($contact_insert == 100) {
                $message['error'] = 100; // contact inserted
                return $message;
            } else if ($contact_insert == 102) {
                $message['error'] = 102; // failed contact insert
                return $message;
            } else if ($contact_insert == 404) {
                $message['error'] = 404; // connection error
                return $message;
            }
        } else if ($contact == 404) {
            $message['error'] = 404; // connection error
            return $message;
        } else {
            $message['error'] = 103; // contact already exists
            return $message;
        }
    }
    public function edit_contact($contact_id, $contact_name, $contact_number, $contact_email, $user_id)
    {
        $message = array();
        $query = "UPDATE  master_contactoop SET contact_name = '$contact_name' , contact_number= '$contact_number' , contact_email = '$contact_email', user_id = " . $user_id . "  where contact_id = " . $contact_id . ";";
        $update_res = $this->update($query);
        if ($update_res == 100) {
            $message['error'] = 100; //updated successfully
            return $message;
        } else if ($update_res == 101) {
            $message['error'] = 101; //failed to update
            return $message;
        } else if ($update_res == 404) {
            $message['error'] = 404; //connection error
            return $message;
        }
    }
    public function delete_contact($contact_id, $user_id)
    {
        $message = array();
        $query = "DELETE FROM master_contactoop WHERE contact_id= '$contact_id' AND user_id = '$user_id';";

        $delete_res = $this->delete($query);
        if ($delete_res == 100) {
            $message['error'] = 100; //deleted successfully
            return $message;
        } else if ($delete_res == 101) {
            $message['error'] = 101; //failed to delete
            return $message;
        } else if ($delete_res == 404) {
            $message['error'] = 404; //connection error
            return $message;
        }
    }
}
