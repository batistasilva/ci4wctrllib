<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/Msg.php';
require_once 'util/Tools.php';
require_once 'models/SMsg.php';
require_once 'models/Bank.php';

/**
 * Description of mngbank
 *
 * @author batista
 */
class MngBank extends Controller {

    public $smsg;
    private $msg;

    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
// $this->model = new Model();
// $this->view  = new View();
    }

    /**
     * Method to add new Bank
     * for table.
     */
    public function AddBank() {
        //
        $tools = new Tools();
        //
        $vdescrip = $tools->clean_input($_POST['description']);
        $vnumber = $tools->clean_int_input($_POST['number']);
//
        $bank = new Bank();
//
        $bank->setDescription($vdescrip);
        $bank->setNumber($vnumber);

        $result = $this->model->addBank($bank);
        
        if (isset($result)) {
            $this->msg->setMsg("AddBank(): " . $result);
            echo $this->msg->getMsgError();
        } else {        
            $this->msg->setMsg('Banco Cadastrado com Sucesso!!!');
            echo $this->msg->getMsgSuccess();
        }
//        
    }

    /**
     * Method to update banklist.
     */
    public function updateBanksList() {

        $allbanks = $this->model->getBankToCombobox();
     /*   print "<pre>";
        print_r($allbanks);
        print "</pre>";
        exit();
*/
        if (isset($allbanks)) {
            echo '<label for = "InputBanks">Bancos:</label>';
            echo '<select name = "bank_id" class = "form-control text-center" style = " width: 390px;" >';
            foreach ($allbanks as $bank) {
                echo '<option value="';
                   echo $bank->getBankbranch_id();
                   echo '">';
                   echo $bank->getDescription();
                   echo '</option>';
            }
            echo '</select>';
        } 
    }

}
