<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

require_once 'Msg.php';
require_once 'SMsg.php';
require_once 'Jobtitle.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Jobtitle
 *
 * @author batista
 */
class Mngjob_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->jobt = new Jobtitle();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    /**
     * Method to get a list from object
     * Customer for list in a table to
     * edit or update.
     * @return type
     */
    public function getJobTitleToTable() {
        return $this->db->selectObjList('SELECT jobtitle_id, shortname, longname, date_create '
                        . 'FROM jobtitle ORDER BY shortname DESC;', $array = array(), "Jobtitle");
    }

    /**
     * Method to get All JobTitle List to
     * populate combobox.
     * @return type
     */
    public function getJobTitleToCombobox() {
        /*
          print "<pre>";
          print_r($ctypel);
          print "</pre>";
          exit(); */
        return $this->db->selectObjList('SELECT jobtitle_id, shortname, longname FROM jobtitle ORDER BY shortname;', $array = array(), "Jobtitle");
    }    
    
    
    function getJobTitle($vjob_id) {
        $jobtitle = $this->db->selectObj('SELECT jobtitle_id, shortname, longname '
                . 'FROM jobtitle '
                . 'WHERE jobtitle_id = :jobtitle_id', array(':jobtitle_id' => $vjob_id), "Jobtitle");
        //
 
        /*          print "<pre>";
          print_r($addrcust);
          print "</pre>";
          exit(); */
        //
        return $jobtitle;
    }


 
    /*
     * Method to add a new Occupation 
     */

    public function addJobTitle($jobtitle) {
        $date = date_create($jobtitle->getDate_create());
        $date_new_create = date_format($date, "Y-m-d H:m:s");
        $mjobtitle = new Jobtitle();
        $mjobtitle = $jobtitle;
        
       /* print "<pre>";
        print_r($obj);
        print "</pre>";
        exit();*/
        /*         * *
         * Add new address to state_sp
         */
        $result = $this->db->insert('jobtitle', array(
            'longname' => $mjobtitle->getLongname(),
            'shortname' => $mjobtitle->getShortname(),
            'date_create' => $date_new_create
        ));
    }

 
    /*
     * Method to update jobtitle.
     */
    public function updateJobTitle($jobtitle) {
        //
        $datetoday = date_create(date('Y/m/d H:i'));
        $date_today = date_format($datetoday, "Y-m-d H:i");
        //
        $mjob = new Jobtitle();
        $mjob = $jobtitle;

        /**
         * do update to jobtitle
         */
        $rs_head = $this->db->update('jobtitle', array(
            'shortname' => $mjob->getShortname(),
            'longname' => $mjob->getLongname(),
            'date_change' => $date_today), "jobtitle_id = {$mjob->getJobtitle_id()}");

        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        return $rs_head;
    }


    /**
     * Delete jobtitle whem have not more assoceate from 
     * employer.
     * @param type $jobtitle_id
     * @return type
     */
    public function deleteJobTitle($jobtitle_id) {
        // $msg = new Msg("", "", false);
        //$cpny_id = 20;
        //
        $status = $this->db->selectObj('SELECT staff_id FROM staff WHERE jobtitle_id = :jobtitle_id', array(':jobtitle_id' => $jobtitle_id), "Staff");

        if (!$status) {
            //Remove Jobtitle
            $result = $this->db->delete('jobtitle', "jobtitle_id = '$jobtitle_id'");
            //    
            if ($result === 1) {
                $this->msg->setType('Okay');
                $this->msg->setStatusError(FALSE);
                $this->msg->setMsg("Função removida com Sucesso!");
            } else {
                $this->msg->setType('Error');
                $this->msg->setStatusError(TRUE);
                $this->msg->setMsg("Função não pode ser removida!!!");
            }
            //
            return $this->msg;
        } else {
            $this->msg->setType('Error');
            $this->msg->setStatusError(TRUE);
            $this->msg->setMsg("Função não pode ser removida!, Há Colaboradores Associados à Função!");
            //
           // print_r($this->msg);
           // exit();
           // return $this->msg;
        }
    }

}
