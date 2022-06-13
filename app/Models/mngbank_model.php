<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

require_once 'Msg.php';
require_once 'SMsg.php';
require_once 'Bank.php';

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
class MngBank_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->bank = new Bank();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    /**
     * Method to get All Bank List to
     * populate combobox.
     * @return type
     */
    public function getBankToCombobox() {
        /*
          print "<pre>";
          print_r($ctypel);
          print "</pre>";
          exit(); */
        return $this->db->selectObjList('SELECT bankbranch_id, description, number FROM bank_branch ORDER BY description;', $array = array(), "Bank");
    } 

    
    function getBank($vbank_id) {
        $bank = $this->db->selectObj('SELECT bankbranch_id, description, number '
                . 'FROM bank_branch '
                . 'WHERE bankbranch_id = :bankbranch_id', array(':bankbranch_id' => $vbank_id), "Bank");
        //

        /*          print "<pre>";
          print_r($addrcust);
          print "</pre>";
          exit(); */
        //
        return $bank;
    }
       

    /*
     * Method to add a new Department 
     */

    public function addBank($bank) {
        $obank = new Bank();
        $obank = $bank;
        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        /*         * *
         * Add new address to state_sp
         */
        $result = $this->db->insert('bank_branch', array(
            'description' => $obank->getDescription(),
            'number' => $obank->getNumber()
        ));
    }

    /*
     * Method to update bankbranch.
     */

    public function updateBank($bank) {
        $mbank = new Bank();
        $mbank = $bank;
        /**
         * do update to jobtitle
         */
        $rs_head = $this->db->update('bank_branch', array(
            'description' => $mbank->getDescription(),
            'number' => $mbank->getNumber()), "bankbranch_id = {$mbank->getBank_id()}");
        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        return $rs_head;
    }

    /**
     * Delete department whem have not more assoceate from 
     * staff.
     * @param type $bank_id
     * @return type
     */
    public function deleteBank($bank_id) {
        // $msg = new Msg("", "", false);
        //$cpny_id = 20;
        //
        $status = $this->db->selectObj('SELECT staff_id FROM staff WHERE bankbranch_id = :bankbranch_id', array(':bankbranch_id' => $bank_id), "Bank");

        if (!$status) {
            //Remove Jobtitle
            $result = $this->db->delete('bank_branch', "bankbranch_id = '$bank_id'");
            //    
            if ($result === 1) {
                $this->msg->setType('Okay');
                $this->msg->setStatusError(FALSE);
                $this->msg->setMsg("Banco Removido com Sucesso!");
            } else {
                $this->msg->setType('Error');
                $this->msg->setStatusError(TRUE);
                $this->msg->setMsg("Banco não pode ser removido!!!");
            }
            //
            return $this->msg;
        } else {
            $this->msg->setType('Error');
            $this->msg->setStatusError(TRUE);
            $this->msg->setMsg("Banco não pode ser removido!, Há Colaboradores Associados ao Banco!");
            //
            // print_r($this->msg);
            // exit();
            // return $this->msg;
        }
    }

}
