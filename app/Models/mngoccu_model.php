<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

require_once 'Msg.php';
require_once 'SMsg.php';
require_once 'Occupation.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mngstaff
 *
 * @author batista
 */
class Mngoccu_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->occu = new Occupation();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    
    public function getOCCuTypeToCombobox() {
        return $this->db->selectObjList('SELECT occupation_id, shortname, longname FROM occupation ORDER BY shortname;', $array = array(), "Occupation");
    }
    
    /**
     * Method to add news occutypes for customers
     * @param type $occutype
     */
    public function occuTypeSave($occutype) {
        $date = date_create($occutype->getDate_create());
        $date_new_create = date_format($date, "Y-m-d H:m:s");
        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        /*         * *
         * Add new occutype for customers
         */
        $result = $this->db->insert('occupation', array(
            'shortname' => $occutype->getShortname(),
            'longname' => $occutype->getLongname(),
            'date_create' => $date_new_create));
        //
        return $result;
    }


}
