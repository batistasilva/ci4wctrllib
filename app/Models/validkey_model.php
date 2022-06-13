<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validkey_model
 *
 * @author batista
 */
class Validkey_Model extends Model
{

    public function __construct()
    {
        // echo '<br><h1>Inside validkey_model Construct!!!</h1><br>';
        parent::__construct();
    }

//
    public function validkey($email, $strkey)
    {
        session_start();

        //echo '<br><h1>Inside run() login_model!!!</h1><br>';

        $sth = $this->db->prepare("SELECT userid FROM users WHERE email = :email AND userkey = :userkey");
        //
        $sth->execute(array(
            ':email'   => $email,
            ':userkey' => $strkey
        ));

        $data = $sth->fetch();        
        $count = $sth->rowCount();
               
        if ($count > 0) {

            $data_status = array(
                'status' => true
            );

            $result = $this->db->update('users', $data_status, "`userid` = {$data['userid']}");

            /**
             * If password match, enter to go to dashboard
             */
           if (!isset($result)) {
                header('location: ' . URL . 'user/userkeyokay');
                exit();
            } else {
                $_SESSION['userkey_error'] = "Não foi possível validar a chave de acesso, tente novamente...!$result";
                header('location: ' . URL . 'user/userkeyerror');
                exit();
            }
        } else {
            $_SESSION['userkey_error'] = "Não foi possível encontrar a chave para validação, tente novamente...!";
            header('location: ' . URL . 'user/userkeyerror');
            exit();
        }
    }

}
