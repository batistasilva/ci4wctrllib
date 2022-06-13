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
use entity\CompanyAddr as ECpnyAddr;
use entity\Msg as EMsg;

/**
 * Description of Users
 *
 * @author batista
 */
class Addrcpny_Model extends Model {

    private $addr_table;
    private $addr;
    public $msg;
    
    function __construct() {
       parent::__construct();
       $this->addr_table = 'companyaddr';
       //
       $this->addr = new ECpnyAddr();
       //$this->smsg = new SMsg();
       $this->msg = new EMsg(NULL, NULL, NULL, NULL, NULL, NULL);
    }


    public function get_list() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get($id_name, $id) {
        $this->db->where($id_name, $id);
        $query = $this->db->get($this->table);
        return $query->row();
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
     * Method to get NextID to use in company database.
     * @return type
     */
    public function get_next_id() {
        $result_id = $this->db->query('SELECT getNextSeq("company_seq as id");');
        $last_id = $result_id[0]['id'];
        //
       /* print "<pre>";
        print_r($last_id);
        print "</pre>";
        exit();*/
        return $last_id;
    }    
    
    
    /**
     * Method to add a new Address Company
     * Return result from acction to db insert
     * in msg.
     */
    public function addAddress($addr) {
        $this->addr = new ECpnyAddr();
        $this->addr = $addr;
        
         /* print "<pre>";
          print_r($this->addr);
          print "</pre>";
          exit();*/
         
        /**
         * Add address to company
         */
        $this->db->set('company_id', $this->addr->getCompany_id());
        $this->db->set('zipid', $this->addr->getZipid());
        $this->db->set('zipcode', $this->addr->getZipcode());
        $this->db->set('address', $this->addr->getAddress());
        $this->db->set('addr_number', $this->addr->getAddr_number());
        $this->db->set('district', $this->addr->getDistrict());
        $this->db->set('city', $this->addr->getCity());
        $this->db->set('state', $this->addr->getState());
        $this->db->set('reference', $this->addr->getReference());
        
        $result = $this->db->insert($this->addr_table);
        //
        $this->msg->setStatus($result);        
        
        if (!$this->msg->getStatus()) {            
            $error = $this->db->error(); // Has keys 'code' and 'message'
            $this->msg->setMsgError(' addAddress(): '.' - '.$error['code'].' - '.$error['message']);
        } else {
            $this->msg->setMsgSuccess("Empresa Cadastrada com Sucesso!");
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
     * Method designed to delete Address Company
     * for id informed.
     */
    public function CleanAddr($id) {
        $this->db->where('company_id', $id);
        $this->db->delete($this->addr_table);
    }

}
