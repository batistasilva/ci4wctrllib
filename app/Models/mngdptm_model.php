<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

require_once 'Msg.php';
require_once 'SMsg.php';
require_once 'Department.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mngdptm
 *
 * @author batista
 */
class MngDptm_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->dptm = new Department();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    /**
     * Method to get a list from object
     * Customer for list in a table to
     * edit or update.
     * @return type
     */
    public function getDepartToTable() {
        return $this->db->selectObjList('SELECT department_id, shortname, longname, date_create '
                        . 'FROM department ORDER BY shortname;', $array = array(), "Department");
    }
    

    /**
     * Method to get All Department List to
     * populate combobox.
     * @return type
     */
    public function getDepartmentToCombobox() {
        /*
          print "<pre>";
          print_r($ctypel);
          print "</pre>";
          exit(); */
        return $this->db->selectObjList('SELECT department_id, shortname, longname FROM department ORDER BY shortname;', $array = array(), "Department");
    }
    
    
    function getDepartment($vdepart_id) {
        $depart = $this->db->selectObj('SELECT department_id, shortname, longname '
                . 'FROM department '
                . 'WHERE department_id = :department_id', array(':department_id' => $vdepart_id), "Department");
        //
 
        /*          print "<pre>";
          print_r($addrcust);
          print "</pre>";
          exit(); */
        //
        return $depart;
    }


 
    /*
     * Method to add a new Department 
     */
    public function addDepartment($depart) {
        $date = date_create($depart->getDate_create());
        $date_new_create = date_format($date, "Y-m-d H:m:s");
        $odepart = new Department();
        $odepart = $depart;
        
        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        /*         * *
         * Add new address to state_sp
         */
        $result = $this->db->insert('department', array(
            'longname' => $depart->getLongname(),
            'shortname' => $depart->getShortname(),
            'date_create' => $date_new_create
        ));
    }

 
    /*
     * Method to update department.
     */
    public function updateDepartment($depart) {
        //
        $datetoday = date_create(date('Y/m/d H:i'));
        $date_today = date_format($datetoday, "Y-m-d H:i");
        //
        $mdepart = new Department();
        $mdepart = $depart;

        /**
         * do update to jobtitle
         */
        $rs_head = $this->db->update('department', array(
            'shortname' => $mdepart->getShortname(),
            'longname' => $mdepart->getLongname(),
            'date_change' => $date_today), "department_id = {$mdepart->getDepartment_id()}");

        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        return $rs_head;
    }


    /**
     * Delete department whem have not more assoceate from 
     * staff.
     * @param type $department_id
     * @return type
     */
    public function deleteDepartment($depart_id) {
        // $msg = new Msg("", "", false);
        //$cpny_id = 20;
        //
        $status = $this->db->selectObj('SELECT staff_id FROM staff WHERE department_id = :department_id', array(':department_id' => $depart_id), "Staff");

        if (!$status) {
            //Remove Jobtitle
            $result = $this->db->delete('department', "department_id = '$depart_id'");
            //    
            if ($result === 1) {
                $this->msg->setType('Okay');
                $this->msg->setStatusError(FALSE);
                $this->msg->setMsg("Departamento excluido com Sucesso!");
            } else {
                $this->msg->setType('Error');
                $this->msg->setStatusError(TRUE);
                $this->msg->setMsg("Departamento não pode ser removido!!!");
            }
            //
            return $this->msg;
        } else {
            $this->msg->setType('Error');
            $this->msg->setStatusError(TRUE);
            $this->msg->setMsg("Departamento não pode ser removido!, Há Colaboradores Associados ao Departamento!");
            //
           // print_r($this->msg);
           // exit();
           // return $this->msg;
        }
    }

}
