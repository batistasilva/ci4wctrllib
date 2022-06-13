<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/Msg.php';
require_once 'util/Tools.php';
require_once 'models/SMsg.php';

/**
 * Description of mngoccupation
 *
 * @author batista
 */
class Mngoccu extends Controller {
    public $smsg;
    private $msg;
    //
    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    /**
     * Method to add new Cust Type 
     * for table.
     */
    public function addOccupation() {
        //$data = json_decode($app->request->getBody());
        //
        if (isset($result)) {
            $this->smsg->setApp('mngoccu');
            $this->smsg->setMsg("addOccupation(): " . $result);
            $this->smsg->setInfo('error');
            //
            echo json_encode($this->smsg->getMsg());
            //
        } else {
            //
            $this->smsg->setApp('mngoccu');
            $this->smsg->setMsg("Função Cadastrado com Sucesso!");
            $this->smsg->setInfo('okay');
            //
            echo json_encode($this->smsg->getMsg());
            //
        }
        //        
    }
}
