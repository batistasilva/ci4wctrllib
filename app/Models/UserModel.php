<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Mypdo;
use App\Entities\User;

class UserModel extends Model {

   // protected $users = 'App\Entities\User'; // configure entity to use


    public function getUser($id) {
//$slug = new Slug();
        $mypdo = new Mypdo();
//$user = new User();
        $user = $mypdo->getUserID($id);
//
        /*
          echo 'Id: ' . $user->getId() . '</br>';
          echo 'User: ' . $user->getUsername() . '</br>';
          print "<pre>";
          print_r($user);
          print "</pre>";
         */
//
        return $user;
    }

    public function getUsers() {
        $mypdo = new Mypdo();
//
        $users = $mypdo->getAllUsers();
/*
        print "<pre>";
        print_r($users);
        print "</pre>";
        exit();
*/
        return $users;
    }

}
