<?php

namespace App\Libraries;

//loading model
use App\Models\User;

class Slug {

    protected $db;

    public function __construct() {

        $this->db = db_connect();
    }

    //.. any database operation with $this->db instance 
// Select/Find
    public function getData() {
        //$data = $this->db->query("SELECT * from tbl_users")->getResult();
        //$data = $this->db->query("SELECT * from tbl_users")->getResult('array');
        //$data = $this->db->query("SELECT * from tbl_users")->getResultArray();
        //$data = $this->db->query("SELECT * from tbl_users WHERE id = 3")->getRow();

        $data = $this->db->query("SELECT * FROM ci4tutorial.news WHERE id = 3")->getRowArray();

        return $data;
    }

// delete query
    public function deleteRawQuery() {
        $query = "Delete from tbl_users where id = 2";

        if ($this->db->query($query)) {
            echo "<h3>Data has been deleted</h3>";
        } else {
            echo "<h3>Failed to delete data</h3>";
        }
    }

// update query
    public function updateRawQuery() {
        $query = "Update tbl_users SET name = 'Sanju', email = 'online@gmail.com', phone_no = '7896541230' WHERE id = 2";

        if ($this->db->query($query)) {
            echo "<h3>Data has been updated</h3>";
        } else {
            echo "<h3>Failed to update data</h3>";
        }
    }

// Insert data
    public function insertRaw() {
        $query = "Insert into tbl_users(name, email, phone_no) values('Sanjay', 'sanjay@gmail.com', '2222222222')";

        if ($this->db->query($query)) {
            echo "<h3>Data has been inserted</h3>";
        } else {
            echo "<h3>Failed to insert data</h3>";
        }
    }

    public function modelOperation() {

        $userModel = new User();
        //... model based operations
    }

    // This function converts a string into slug format
    public function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

}
