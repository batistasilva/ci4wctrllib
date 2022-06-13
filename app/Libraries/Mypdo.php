<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Libraries;

/**
 * Description of Mypdo
 *
 * @author batista
 */
use PDO;
use App\Entities\User;

//define('DB_TYPE', 'mysql');
define('DB_HOST', getenv('database.default.hostname'));
define('DB_NAME', getenv('database.default.database'));
define('DB_USER', getenv('database.default.username'));
define('DB_PASS', getenv('database.default.password'));
define('DB_PARAM', getenv('database.default.charset'));

class Mypdo {

    protected $conn;
    ///That is necessarily to pdo return class from type entity 
    protected $userType = 'App\Entities\User'; // configure entity to use

    public function __construct() {
        $this->conn = $this->Conn();
    }  

    public function Conn() {
        $URL = "mysql:dbname=".DB_NAME.";host=".DB_HOST.";charset=".DB_PARAM.";";
     /*  
        print "<pre>";
        echo '<br/> Url: '.$URL;
        print "</pre>";
        exit();
*/
        try {//"mysql:dbname=demo;host=localhost;charset=utf8;"
            $this->conn = new PDO($URL, DB_USER, DB_PASS, $driver_options = array());
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //print_r('<br> Connection Sucessfully...!!!</br>');
            return $this->conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllUsers() {
        $sth = $this->conn->prepare("SELECT * FROM users");

        $sth->execute();
        //
        $users = $sth->fetchAll(PDO::FETCH_CLASS, $this->userType);
        //
        return $users;
    }

    public function getUserID($id) {
        //$data = $this->db->query("SELECT * from tbl_users")->getResult();
        //$data = $this->db->query("SELECT * from tbl_users")->getResult('array');
        //$data = $this->db->query("SELECT * from tbl_users")->getResultArray();
        //$data = $this->db->query("SELECT * from tbl_users WHERE id = 3")->getRow();
        //$id = '1';

        try {
            // $q = "SELECT * FROM news WHERE something_id = '3'";
            // $stmt = $this->mypdo->prepare($q); //<--PROBLEM
            // $data = $stmt->execute();

            $stmt = $this->conn->prepare('SELECT  * FROM user WHERE id=?');
            // $user = new User();
            /**
             * If sql clean from error
             * enter to persist
             */
            if ($stmt) {
                try {
                    $stmt->execute([$id]);
                    $user = $stmt->fetchObject($this->userType);
                    // var_dump($user);
                    // print_r($obj);
                    return $user;
                } catch (PDOException $e) {
                    return $e->getMessage();
                }
            } else {
                $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
                //
                return $msg;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insertUser($user) {
        $insert = $this->conn->prepare("INSERT INTO user(username, password, passwd_hint, userkey, email, status, allow_access, note) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        if ($insert) {
            try {
                $insert->execute(array($user->getUsername(), 'abcd', 'tips', '124456', $user->getEmail(), $user->getStatus(), 'Y', 'blah blah blah!'));
            } catch (PDOException $e) {
                $msg = "Erro saving data..." . $this->conn->errorInfo();
                print "<pre>";
                print_r($msg);
                print "</pre>";
                exit();
                return $msg;
            }
        } else {
            $msg = "\nPDO::errorInfo():\n" . $this->conn->errorInfo();
            //
            return $msg;
        }
    }

    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public function my_insert($class_obj, $query) {
        // ksort($data);

        foreach ($class_obj as $key => $value) {
            echo "<br/>$key => $value\n";
        }
        //exit();

        $sth = $this->conn->prepare($query);

        foreach ($class_obj as $key => $value) {
            echo "<br/>Chave..: .$key - Valor..: .$value";
            $sth->bindValue(":$key", $value);
        }

        //exit();

        /**
         * If sql clean from error
         * enter to persist
         */
        if ($sth) {
            try {
                $sth->execute();
            } catch (PDOException $e) {
                $msg = "ERRO NA INCLUSÃO SQL: " . $e->getMessage();
                return $msg;
            }
        } else {
            $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
            //
            return $msg;
        }
    }

    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public function insert($table, $data) {
        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $sth = $this->conn->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

        // echo "<br/>FieldNames...: .$fieldNames";
        // echo "<br/>FieldValues...: .$fieldValues";

        foreach ($data as $key => $value) {
            //  echo "<br/>Chave..: .$key - Valor..: .$value";
            $sth->bindValue(":$key", $value);
        }
        /**
         * If sql clean from error
         * enter to persist
         */
        if ($sth) {
            try {
                $sth->execute();
            } catch (PDOException $e) {
                $msg = "ERRO NA INCLUSÃO SQL: " . $e->getMessage();
                return $msg;
            }
        } else {
            $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
            //
            return $msg;
        }
    }

    /**
     * update
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    public function update($table, $data, $where) {
        ksort($data);

        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        /**
         * If sql clean from error
         * enter to persist
         */
        if ($sth) {
            try {
                $sth->execute();
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            $msg = "\nPDO::errorInfo():\n" . $this->db->errorInfo();
            // echo $msg;
            //
            return $msg;
        }
    }

    /**
     * delete
     * 
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     */
    public function delete($table, $where, $limit = 1) {
        $URL_NAME = "DELETE FROM $table WHERE $where LIMIT $limit";
        return $this->exec($URL_NAME);
    }

}
