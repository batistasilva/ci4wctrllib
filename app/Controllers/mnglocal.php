<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/Msg.php';
require_once 'util/Tools.php';
require_once 'models/SMsg.php';
require_once 'models/Stafflocal.php';

/**
 * Description of mngstafflocal
 *
 * @author batista
 */
class MngsLocal extends Controller {

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
     * Method to add new Stafflocal
     * for table.
     */
    public function AddStafflocal() {
        //
        $tools = new Tools();
        //        
        $vlongname = $tools->clean_input($_POST['longname']);
        $vshortname = $tools->clean_input($_POST['shortname']);
        //
        $stafft = new Stafflocal();
        //
        $stafft->setShortname($vshortname);
        $stafft->setLongname($vlongname);

        $result = $this->model->addStafflocal($stafft);
        //
        if (isset($result)) {
            $this->msg->setMsg("AddStafflocal(): " . $result);
            echo $this->msg->getMsgError();
        } else {        
            $this->msg->setMsg('Local do Colaborador Cadastrado com Sucesso!!!');
            echo $this->msg->getMsgSuccess();
        }
        //        
    }

}
