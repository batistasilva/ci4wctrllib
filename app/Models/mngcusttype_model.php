<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'CustType.php';
/**
 * Description of mngcusttype_model
 *
 * @author sistema
 */
class MngCustType_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->custtype = new CustType();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }
    //
    /**
     * Method to get All Cust Type List to
     * populate combobox.
     * @return type
     */
    public function getCustTypeToCombobox() {
        /*   $ctypel = $this->db->selectObjList('SELECT custtype_id, shortname, longname FROM cust_type ORDER BY shortname;', $array = array(), "CustType");
          print "<pre>";
          print_r($ctypel);
          print "</pre>";
          exit(); */
        return $this->db->selectObjList('SELECT custtype_id, shortname, longname FROM cust_type ORDER BY shortname;', $array = array(), "CustType");
    }
    
    /**
     * Method to add news types for customers
     * @param type $custtype
     */
    public function custTypeSave($custtype) {
        $date = date_create($custtype->getDate_create());
        $date_new_create = date_format($date, "Y-m-d H:m:s");
        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        /*         * *
         * Add new custtype for customers
         */
        $result = $this->db->insert('cust_type', array(
            'shortname' => $custtype->getShortname(),
            'longname' => $custtype->getLongname(),
            'date_create' => $date_new_create));
        //
        return $result;
    }
    
}
