<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

require_once 'Msg.php';
require_once 'SMsg.php';
require_once 'TypeAccount.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mngbank
 *
 * @author batista
 */
class MngTypeAccount_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->typeaccount = new Typeaccount();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    /**
     * Method to get a list from object
     * Customer for list in a table to
     * edit or update.
     * @return type
     */
    public function getTypeAccountToTable() {
        return $this->db->selectObjList('SELECT typeaccount_id, description, acronym'
                        . ' FROM type_account ORDER BY description;', $array = array(), "TypeAccount");
    }

    /**
     * Method to get All Type Account List to
     * populate combobox.
     * @return type
     */
    public function getTypeAccountToCombobox() {
        /*
          print "<pre>";
          print_r($ctypel);
          print "</pre>";
          exit(); */
        return $this->db->selectObjList('SELECT typeaccount_id, description, acronym FROM type_account ORDER BY description;', $array = array(), "TypeAccount");
    }    
    
    
    function getTypeAccount($vtypeaccount_id) {
        $typeaccount = $this->db->selectObj('SELECT typeaccount_id, description, acronym '
                . 'FROM type_account '
                . 'WHERE typeaccount_id = :typeaccount_id', array(':typeaccount_id' => $vtypeaccount_id), "TypeAccount");
        //
         /*          print "<pre>";
          print_r($addrcust);
          print "</pre>";
          exit(); */
        //
        return $typeaccount;
    }


 
    /*
     * Method to add a new TypeAccount 
     */
    public function addTypeAccount($typeaccount) {
        $otypeaccount = new Typeaccount();
        $otypeaccount = $typeaccount;        
        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        /*         * *
         * Add new address to state_sp
         */
        $result = $this->db->insert('type_account', array(
            'description' => $otypeaccount->getDescription(),
            'acronym' => $otypeaccount->getAcronym()
        ));
        //
        return $result;
    }

 
    /*
     * Method to update type_account.
     */
    public function updateTypeAccount($typeaccount) {
        $mtypeaccount = new Typeaccount();
        $mtypeaccount = $typeaccount;
        /**
         * do update to type account
         */
        $rs_head = $this->db->update('type_account', array(
            'description' => $mtypeaccount->getDescription(),
            'acronym' => $mtypeaccount->getAcronym()), "typeaccount_id = {$mtypeaccount->getTypeaccount_id()}");
        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        return $rs_head;
    }


    /**
     * Delete type account whem have not more assoceate from 
     * staff.
     * @param type $typeaccount_id
     * @return type
     */
    public function deleteTypeAccount($typeaccount_id) {
        // $msg = new Msg("", "", false);
        //$cpny_id = 20;
        //
        $status = $this->db->selectObj('SELECT typeaccount_id FROM staffbank WHERE typeaccount_id = :typeaccount_id', array(':typeaccount_id' => $typeaccount_id), "TypeAccount");

        if (!$status) {
            //Remove Jobtitle
            $result = $this->db->delete('type_account', "typeaccount_id = '$typeaccount_id'");
            //    
            if ($result === 1) {
                $this->msg->setType('Okay');
                $this->msg->setStatusError(FALSE);
                $this->msg->setMsg("Typo de Conta Removido com Sucesso!");
            } else {
                $this->msg->setType('Error');
                $this->msg->setStatusError(TRUE);
                $this->msg->setMsg("Tipo de Conta não pode ser Removido!!!");
            }
            //
            return $this->msg;
        } else {
            $this->msg->setType('Error');
            $this->msg->setStatusError(TRUE);
            $this->msg->setMsg("Tipo de Conta não pode ser Removido!, Há Colaboradores Associados ao Tipo!");
            //
           // print_r($this->msg);
           // exit();
           // return $this->msg;
        }
    }

}
