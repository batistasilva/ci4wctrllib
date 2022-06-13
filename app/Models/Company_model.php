<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

//require_once 'Msg.php';
//require_once 'SMsg.php';
//require_once 'Customer.php';
//require_once 'Company.php';
//require_once 'CompanyAddr.php';
//require_once 'CustType.php';
//require_once 'Occupation.php';
//require_once 'Staff.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use entity\Company as ECompany;
use entity\CompanyAddr as ECpnyaddr;
use entity\Msg as EMsg;

/**
 * Description of Users
 *
 * @author batista
 */
class Company_Model extends Model {

    private $company_table;
    private $addr_table;
    public $cpny;
    public $addr;
    public $msg;

    function __construct() {
        parent::__construct();
        $this->load->library('mydb');
        $this->company_table = 'company';
        $this->addr_table = 'companyaddr';
        //
        $this->cpny = new ECompany();
        $this->addr = new ECpnyaddr();

        $this->msg = new EMsg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    public function get_list() {
        $query = $this->db->get($this->company_table);

        return $query->result();
    }

    /**
     * Method to get NextID to use in company database.
     * @return type
     */
    public function get_next_id() {

        $query = $this->db->query('SELECT getNextSeq("company_seq as id");');
        //    print "<pre>";

        $object = $query->result()[0];

        //   print_r($object);

        $array = get_object_vars($object);

        //    print_r($array);
        //    print_r($array['getNextSeq("company_seq as id")']);

        $result_id = $array['getNextSeq("company_seq as id")'];
        //echo $result_id;//[0]['id'];
        //    print "</pre>";
        // exit(); 

        return $result_id;
    }

    public function getCustonCpny($id) {

        $sql = "SELECT cp.company_id, cp.cnpj, cp.ie, cp.shortname, 
            cp.longname, cp.bussiness_phone, cp.mobil_phone, 
            cp.nextel_phone, cp.nextelid, cp.email, 
            cp.status, cp.note, cp.date_create, cp.date_change, 
            ad.company_id, ad.zipcode, ad.zipid, ad.address, 
            ad.addr_number, ad.district, ad.city, ad.state, ad.reference 
            FROM $this->company_table as cp, companyaddr as ad 
                WHERE cp.company_id = ad.company_id 
                AND cp.company_id = ?;";

        $result = $this->db->query($sql, $id);

        $this->cpny = $result->custom_row_object(0, 'entity\Company');

        /*  if (isset($this->cpny)) {
          echo $this->cpny->getCompany_id();   // access attributes
          echo $this->cpny->getLongname();   // access class methods
          }
         */
        /*  print "<pre>";
          print_r($this->cpny);
          print "</pre>";
          exit(); */


        return $this->cpny;
    }

    /*     * *
     * Method to get All Company to Show in Data Table.
     */

    public function getAllForCustonObj() {
        $query = $this->db->query("SELECT * FROM $this->table ORDER BY shortname;");
        $this->allcpny = $query->custom_result_object('entity\Company');
        //     print "<pre>";
        //     print_r($this->cpny);
        //     print "</pre>";
        //     exit();
        return $this->allcpny;
    }

    public function add($data) {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    /**
     * Method to get a list from object
     * Company for list in a table to
     * edit or update.
     * @return type
     */
    public function getCpnyToTable() {
        return $this->db->selectObjList('SELECT company_id, longname, shortname, status, date_create FROM company ORDER BY company_id DESC;', $array = array(), "Company");
    }

    /**
     * Metho to get All Company to
     * populate combobox.
     * @return type
     */
    public function getCpnyToCombobox() {
        return $this->db->selectObjList('SELECT company_id, shortname, longname FROM company ORDER BY shortname;', $array = array(), "Company");
    }

    /**
     * Method used to get object Company for 
     * a id informed.
     * @param type $vcpny_id
     * @return type
     */
    function getCpny($vcpny_id) {
        $cpny = $this->db->selectObj('SELECT company_id, cnpj, ie, shortname, longname, '
                . 'bussiness_phone, mobil_phone, nextel_phone, nextelid, email, status, note, date_create, date_change '
                . 'FROM company '
                . 'WHERE company_id = :company_id', array(':company_id' => $vcpny_id), "Company");
        //
        $addrcpny = $this->db->selectObj('SELECT company_id, zipcode, zipid, address, addr_number, district, city, state, reference '
                . 'FROM companyaddr '
                . 'WHERE company_id = :company_id', array(':company_id' => $vcpny_id), "CompanyAddr");

        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        //
        $cpny->setAddr($addrcpny);
        //
        return $cpny;
    }

    /**
     * Method to add a new Company and. 
     */
    public function AddCpny($cpny) {
        $this->cpny = $cpny;

        /*
          print "<pre>";
          print_r($cpny);
          print "</pre>";
          exit();
         */

        //
        $result_cpny = $this->db->insert($this->company_table, $this->cpny);
        $this->msg->setStatus($result_cpny);

        if (!$this->msg->getStatus()) {
            $error = $this->db->error(); // Has keys 'code' and 'message'
            $this->msg->setMsgError($error[0] . ' - ' . $error[1]);
            //
        }
        /*
          print "<pre>";
          print_r($this->msg);
          print "</pre>";
          exit();
         */

        //
        return $this->msg;
    }

    /*     * *
     * Method designed to delete a start company
     * for id informed.
     */

    public function CleanCpny($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->company_table);
    }

    /*
     * Metho to update company and your 
     * address.
     */

    public function updateCpny($cpny) {
        //
        $datetoday = date_create(date('Y/m/d H:i'));
        $date_today = date_format($datetoday, "Y-m-d H:i");
        //
        $addr = $cpny->getAddr();

        /**
         * do update to company
         */
        $result = $this->db->update('company', array(
            'shortname' => $cpny->getShortname(),
            'bussiness_phone' => $cpny->getBussiness_phone(),
            'mobil_phone' => $cpny->getMobil_phone(),
            'nextel_phone' => $cpny->getNextel_phone(),
            'nextelid' => $cpny->getNextelid(),
            'email' => $cpny->getEmail(),
            'status' => $cpny->getStatus(),
            'note' => $cpny->getNote(),
            'date_change' => $date_today), "company_id = {$cpny->getCompany_id()}");
        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();

        /**
         * If result is free error, enter to update 
         * address.
         */
        if (!isset($result)) {
            /**
             * do update to companyaddr
             */
            $result = $this->db->update('companyaddr', array(
                'zipid' => $addr->getZipid(),
                'zipcode' => $addr->getZipcode(),
                'address' => $addr->getAddress(),
                'addr_number' => $addr->getAddr_number(),
                'district' => $addr->getDistrict(),
                'city' => $addr->getCity(),
                'state' => $addr->getState(),
                'reference' => $addr->getReference()), "company_id = {$addr->getCompany_id()}");
//
            if (!isset($result)) {
                //not valid response for add zip code yet..
                if (intval($addr->getZipid()) == 0) {
                    //                   print "<pre>";
                    //                   print_r($cpny);
                    //                   print "</pre>";
                    //                   exit();
                    $this->addZipCode($cpny);
                }
            }
        }
        //            
        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit(); 
        return $result;
    }

    /**
     * I stop here for test anyway to put data in web frame for confirm 
     * if delete or not the customer and user, them whem I will have got the
     * best way to do this, I will continue the remove action.
     * @param type $cpny_id
     * @return \Msg
     */
    public function deleteCpny($cpny_id) {
        //
        $arr  = $this->mydb->GetMultiResults("CALL delete_company($cpny_id,@res);SELECT @res AS res");

        $status = $arr[1][0]['res'];
        /*print "<pre>";
        print_r($arr);
        print "</pre>";
        exit();*/

        if (!$status) {
            //    
            $this->msg->setStatus(TRUE);
            $this->msg->setMsgSuccess("Empresa Excluída com Sucesso!");
            //
            return $this->msg;
        } else {
            $error = $this->db->error(); // Has keys 'code' and 'message'
            $this->msg->setMsgError(' deleteCpny(): '.' - '.$error['code'].' - '.$error['message']);
            $this->msg->setStatus(FALSE);
             //
            return $this->msg;
        }
    }

    /*
     * Methodo to search zipcode to local database
     * from the state_sp.
     */

    public function getZipCode($vzipcode) {

        $this->db->select('id, street, complement, district, city, state');
        $this->db->from('state_sp');
        $this->db->where('postalcode =', $vzipcode);
        $query = $this->db->get();

        if ($query->result()) {
            $row = $query->result()[0];
        } else {
            $row = FALSE;
        }

        /* print "<pre>";
          print_r($row);
          print "</pre>";
          exit(); */
        //
        return $row;
    }

    /*
     * Method to add a new cep to state_sp 
     * when a new zipcode was found in correio.
     */

    public function addZipCode($postal) {
        // $postalc = new PostalCode();
        // $postalc = $postal;
        // $date = date_create($postal->getDate_create());
        // $date_new_create = date_format($date, "Y-m-d H:m:s");
        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        /*         * *
         * Add new address to state_sp
         */
        $result = $this->db->insert('state_sp', array(
            'postalcode' => $postal->getPostalcode(),
            'street' => $postal->getStreet(),
            'complement' => $postal->getComplement(),
            'district' => $postal->getDistrict(),
            'city' => $postal->getCity(),
            'state' => $postal->getState(),
            'country' => $postal->getCountry(),
            'date_create' => $postal->getDate_create()
        ));
        //
        return $result;
    }

}
