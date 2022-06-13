<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/Msg.php';
require_once 'util/Tools.php';
require_once 'models/SMsg.php';
require_once 'models/Department.php';

/**
 * Description of mngdepart
 *
 * @author batista
 */
class MngDptm extends Controller {

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
     * Method to add new Department
     * for table.
     */
    public function AddDepartment() {
        //
        $tools = new Tools();
        //
        $vlongname = $tools->clean_input($_POST['longname']);
        $vshortname = $tools->clean_input($_POST['shortname']);
//
        $depart = new Department();
//
        $depart->setShortname($vshortname);
        $depart->setLongname($vlongname);

        $result = $this->model->addDepartment($depart);
//
        if (isset($result)) {
            $this->msg->setMsg("AddDepartment(): " . $result);
            echo $this->msg->getMsgError();
        } else {        
            $this->msg->setMsg('Departamento Cadastrado com Sucesso!!!');
            echo $this->msg->getMsgSuccess();
//
        }
//        
    }

    /**
     * Method to get all department 
     * for update department list.
     */
    public function updateDptm() {
        //
        $alldptm = $this->model->getDepartmentToCombobox();
        //
        if (isset($alldptm)) {
            echo '<label for = "InputDepart">Departamento:</label>';
            echo '<select name = "staffdepart" class = "form-control text-center" style = " width: 210px;" >';
            //
            foreach ($alldptm as $depart) {

                echo '<option value="';
                echo $depart->getDepartment_id();
                echo '">';
                echo $depart->getShortname();
                echo '</option>';
            }
            //
            echo '</select>';
        }
    }

}
