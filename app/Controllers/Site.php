<?php

namespace App\Controllers;

use App\Libraries\Slug; // Import library


class Site extends BaseController
{
    public function generateMySlug()
    {
        $slug = new Slug(); // create an instance of Library

        $string = "Online Web Tutor Blog";

        echo $slug->slugify($string); // calling method
    }
    
    public function getUsers(){
          //$slug = new Slug();
        $mypdo = new Mypdo();
        //$user = new User();
        $user = $mypdo->getUser();
        //
        echo 'Id: '.$user->getId().'</br>';
        echo 'User: '.$user->getUsername().'</br>';        
       /* 
        print "<pre>";
        print_r($user);
        print "</pre>";*/
        //
        exit();        
    }
    
}
