<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

require_once 'Msg.php';
require_once 'SMsg.php';
require_once 'Local.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mngstafftype
 *
 * @author batista
 */
class MngLocal_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->local = new Local();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    /**
     * Method to get a list from object
     * Customer for list in a table to
     * edit or update.
     * @return type
     */
    public function getLocalToTable() {
        return $this->db->selectObjList('SELECT local_id, shortname, longname, acronym FROM local ORDER BY shortname;', $array = array(), "Local");
    }

    /**
     * Method to get Local to ID
     * @param type $vlocal_id
     * @return type
     */
    public function getLocal($vlocal_id) {
        $local = $this->db->selectObj('SELECT local_id, shortname, longname, acronym FROM local WHERE local_id = :local_id', array(':local_id' => $vlocal_id), "Local");
        //
        //
        return $local;
    }

    /**
     * Method to get All Local List to
     * populate combobox.
     * @return type
     */
    public function getLocalToCombobox() {
        /*
          print "<pre>";
          print_r($ctypel);
          print "</pre>";
          exit(); */
        return $this->db->selectObjList('SELECT local_id, shortname, longname, acronym FROM local ORDER BY shortname;', $array = array(), "Local");
    }    
 
    /*
     * Method to add a new Department 
     */
    public function addStaffLocal($stafflocal) {
        $date = date_create($stafflocal->getDate_create());
        $date_new_create = date_format($date, "Y-m-d H:m:s");
        $stafft = new Stafflocal();
        $stafft = $stafflocal;
        
        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        /*         * *
         * Add new StaffType
         */
        $result = $this->db->insert('staff_local', array(
            'longname' => $stafft->getLongname(),
            'shortname' => $stafft->getShortname(),
            'date_create' => $date_new_create
        ));
    }

 
    /*
     * Method to update local.
     */
    public function updateStaffLocal($stafflocal) {
        //
        $datetoday = date_create(date('Y/m/d H:i'));
        $date_today = date_format($datetoday, "Y-m-d H:i");
        //
        $stafft = new Stafflocal();
        $stafft = $stafflocal;

        /**
         * do update to jobtitle
         */
        $rs_head = $this->db->update('staff_local', array(
            'shortname' => $stafft->getShortname(),
            'longname' => $stafft->getLongname(),
            'date_change' => $date_today), "stafflocal_id = {$stafft->getStafflocal_id()}");

        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        return $rs_head;
    }


    /**
     * Delete department whem have not more assoceate from 
     * staff.
     * @param type $stafflocal_id
     * @return type
     */
    public function deleteStafftype($stafflocal_id) {
        // $msg = new Msg("", "", false);
        //$cpny_id = 20;
        //
        $status = $this->db->selectObj('SELECT local_id FROM staff WHERE local_id = :stafflocal_id', array(':stafflocal_id' => $stafflocal_id), "Staff");

        if (!$status) {
            //Remove Staff_local
            $result = $this->db->delete('staff_local', "stafflocal_id = '$stafflocal_id'");
            //    
            if ($result === 1) {
                $this->msg->setType('Okay');
                $this->msg->setStatusError(FALSE);
                $this->msg->setMsg("Local do Colaborador Removido com Sucesso!");
            } else {
                $this->msg->setType('Error');
                $this->msg->setStatusError(TRUE);
                $this->msg->setMsg("Local do Colaborador não pode ser Removido!!!");
            }
            //
            return $this->msg;
        } else {
            $this->msg->setType('Error');
            $this->msg->setStatusError(TRUE);
            $this->msg->setMsg("Local do Colaborador não pode ser Removido!, Está Associados a um Colaborador!");
            //
           // print_r($this->msg);
           // exit();
           // return $this->msg;
        }
    }

}
