<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/Msg.php';
require_once 'util/Tools.php';
require_once 'models/SMsg.php';
require_once 'models/TypeAccount.php';

/**
 * Description of mngtypeaccount
 *
 * @author batista
 */
class MngTypeAccount extends Controller {

    public $smsg;
    private $msg;

    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    /**
     * Method to add new Type Account
     * for table.
     */
    public function AddTypeAccount() {
        //
        $tools = new Tools();
        //
        $vdescrip = $tools->clean_input($_POST['description']);
        $vacronym = $tools->clean_input($_POST['acronym']);
//
        $typeaccount = new Typeaccount();
//
        $typeaccount->setDescription($vdescrip);
        $typeaccount->setAcronym($vacronym);

        $result = $this->model->addTypeAccount($typeaccount);
//
       if (isset($result)) {
            $this->msg->setMsg("AddTypeAccount(): " . $result);
            echo $this->msg->getMsgError();
        } else {        
            $this->msg->setMsg('Tipo de Conta Cadastrado com Sucesso!!!');
            echo $this->msg->getMsgSuccess();
        }
//        
    }

    public function updateTypeAccountList() {
        //
        $alltypeaccount = $this->model->getTypeAccountToCombobox();
        //
       /*   print "<pre>";
          print_r($alltypeaccount);
          print "</pre>";
          exit();         //        
        */
        if (isset($alltypeaccount)) {
            echo '<label for = "InputAccountType">Tipo de Conta:</label>';
            echo '<select name = "typeaccount_id" class = "form-control text-center" style = " width: 390px;" >';
            foreach ($alltypeaccount as $type) {
                echo '<option value="';
                echo $type->getTypeaccount_id();
                echo '">';
                echo $type->getDescription();
                echo '</option>';
            }
            echo '</select>';
        }
        //
    }

}
