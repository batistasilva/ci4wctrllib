<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/Msg.php';
require_once 'util/Tools.php';
require_once 'models/SMsg.php';
require_once 'models/Jobtitle.php';

/**
 * Description of mngoccupation
 *
 * @author batista
 */
class Mngjob extends Controller {

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
     * Method to add new Jobtitle 
     * for table.
     */
    public function AddJobTitle() {
        //
        $tools = new Tools();
        //
        $vlongname = $tools->clean_input($_POST['longname']);
        $vshortname = $tools->clean_input($_POST['shortname']);
        //
        $jobtitle = new Jobtitle();
        //
        $jobtitle->setShortname($vshortname);
        $jobtitle->setLongname($vlongname);

        $result = $this->model->addJobTitle($jobtitle);
        //
        if (isset($result)) {
            $this->msg->setMsg("AddJobTitle(): " . $result);
            echo $this->msg->getMsgError();
        } else {        
            $this->msg->setMsg('Função Cadastrada com Sucesso!!!');
            echo $this->msg->getMsgSuccess();
        }       
    }

    /**
     * Metho to get all jobtitle to populate 
     * combo box when was added.
     */
    public function updateJobTitle() {
        //
        $alljobtitle = $this->model->getJobTitleList();

        if (isset($alljobtitle)) {
            //
            echo '<label for="ComboJobTitle">Função:</label>';
            echo '<select name="jobtitle_id" class="form-control text-center" style=" width: 360px;" >';
            //
            foreach ($alljobtitle as $job) {

                echo '<option value="';
                echo $job->getJobtitle_id();
                echo '">';
                echo $job->getShortname();
                echo '</option>';
            }
            //
            echo '</select>';
        }
    }

}
