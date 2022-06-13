<?php

/* * **
  CREATE TABLE
  `user` (id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(25) NOT NULL,
  password VARCHAR(256) NOT NULL,
  passwd_hint VARCHAR(256),
  email VARCHAR(256) NOT NULL,
  status CHAR(1) NOT NULL,
  allow_access CHAR(1) NOT NULL,
  note TEXT,
  created_at TIMESTAMP DEFAULT current_timestamp()  NOT NULL,
  updated_at TIMESTAMP DEFAULT 0000-00-00 00:00:00  NOT NULL,
  deleted_at TIMESTAMP DEFAULT 0000-00-00 00:00:00  NOT NULL,
  PRIMARY KEY (id));
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity {
  private $id;
  private $username;
  private $password;
  private $passwd_hint;
  private $email;
  private $status;
  private $allow_access;
  private $note;
  private $created_at; 
  private $updated_at;
  private $deleted_at;
  
    //
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPasswd_hint() {
        return $this->passwd_hint;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getAllow_access() {
        return $this->allow_access;
    }

    public function getNote() {
        return $this->note;
    }

    public function getCreated_at() {
        $date_create = date_create($this->created_at);
        $this->created_at = date_format($date_create, "d-m-Y");        
        return $this->created_at;
    }

    public function getUpdated_at() {
        $date_update = date_create($this->updated_at);
        $this->updated_at = date_format($date_update, "d-m-Y");           
        return $this->updated_at;
    }

    public function getDeleted_at() {
        $date_delete= date_create($this->deleted_at);
        $this->deleted_at = date_format($date_delete, "d-m-Y");           
        return $this->deleted_at;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setUsername($username): void {
        $this->username = $username;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function setPasswd_hint($passwd_hint): void {
        $this->passwd_hint = $passwd_hint;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    public function setAllow_access($allow_access): void {
        $this->allow_access = $allow_access;
    }

    public function setNote($note): void {
        $this->note = $note;
    }

    public function setCreated_at($created_at): void {
        $this->created_at = $created_at;
    }

    public function setUpdated_at($updated_at): void {
        $this->updated_at = $updated_at;
    }

    public function setDeleted_at($deleted_at): void {
        $this->deleted_at = $deleted_at;
    }



}
