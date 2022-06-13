<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

require_once 'Msg.php';
require_once 'SMsg.php';
require_once 'Customer.php';
require_once 'CustomerCommAddr.php';
require_once 'CustomerInvoAddr.php';
require_once 'CustomerComm.php';
require_once 'CustomerInvo.php';
require_once 'Company.php';
require_once 'CustType.php';
require_once 'Occupation.php';
require_once 'Staff.php';

/**
 * Description of Users
 *
 * @author batista
 */
class Mngcust_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->cust = new Customer();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    /**
     * Method to get a list from object
     * Customer for list in a table to
     * edit or update.
     * @return type
     */
    public function getCustomerToTable() {
        return $this->db->selectObjList('SELECT customer_id, condtcust, nature_indcorp, '
                        . 'status, date_create, aliasname  FROM customer ORDER BY customer_id DESC;', $array = array(), "Customer");
    }

    /**
     * Metho to get All Customer to
     * populate combobox.
     * @return type
     */
    public function getCustomerToCombox() {
        return $this->db->selectObjList('SELECT customer_id, corpname FROM customer ORDER BY corpname;', $array = array(), "Customer");
    }

    /**
     * Method to get All Occupation Type List to
     * populate combobox.
     * @return type
     */

    /**
     * Method used to get object Customer for 
     * a id informed.
     * @param type $vcust_id
     * @return type
     */
    function getCust($vcust_id) {

        $customer = new Customer();
        //
        $cust = $this->db->selectObj('SELECT customer_id, company_id, custtype_id, condtcust, nature_indcorp, occupation_id, cnpj, ie, corpname, aliasname,  '
                . 'gender, status, note '
                . 'FROM customer '
                . 'WHERE customer_id = :customer_id', array(':customer_id' => $vcust_id), "Customer");

        $customer->setCustomer($cust);

//
        $cust_comm = $this->db->selectObj('SELECT commercial_contact_name, comm_business_phone, comm_mobil_phone, comm_nextel_phone, comm_nextel_id, '
                . 'comm_fax_phone, comm_email, comm_webpage, comm_note '
                . 'FROM customer_commcont '
                . 'WHERE customer_id = :customer_id', array(':customer_id' => $vcust_id), 'CustomerComm');

        $customer->setCustomerComm($cust_comm);


        $cust_invo = $this->db->selectObj('SELECT invoice_contact_name, inv_business_phone, inv_mobil_phone, inv_nextel_phone, inv_nextel_id, '
                . 'inv_fax_phone, inv_email, inv_note '
                . 'FROM customer_invcont '
                . 'WHERE customer_id = :customer_id', array(':customer_id' => $vcust_id), 'CustomerInvo');

        $customer->setCustomerInvo($cust_invo);

        $cust_commaddr = $this->db->selectObj('SELECT comm_addr_id, comm_addr_zip, comm_address, comm_addr_number, comm_addr_comp, comm_addr_dist, '
                . 'comm_addr_city, comm_addr_state, comm_addr_ref '
                . 'FROM customer_commaddr '
                . 'WHERE customer_id = :customer_id', array(':customer_id' => $vcust_id), 'CustomerCommAddr');

        $customer->setCustomerCommAddr($cust_commaddr);

        $cust_invoaddr = $this->db->selectObj('SELECT inv_addr_id, inv_addr_zip, inv_address, inv_addr_number, inv_addr_comp, inv_addr_dist, '
                . 'inv_addr_city, inv_addr_state, inv_addr_ref '
                . 'FROM customer_invaddr '
                . 'WHERE customer_id = :customer_id', array(':customer_id' => $vcust_id), 'CustomerInvoAddr');

        $customer->setCustomerInvoAddr($cust_invoaddr);

        /*
        print "<pre>";
        print_r($customer);
        print "</pre>";
        exit();
        */
        //
        //
        return $customer;
    }

    /**
     * Method to get NextID to use in company database.
     * @return type
     */
    public function getNextIDToAdd() {
        $result = $this->db->getNextID('SELECT getNextSeq("customer_seq") as id;');
        $result = $result[0]['id'];
        //  print "<pre>";
        //  print_r($result[0]['id']);
        //  print "</pre>";
        //  exit();
        return $result;
    }

    /*
     * Method to add a new Customer and
     * your contact and address. 
     */

    public function createNewCust($cust) {
        $mcust = new Customer();
        $mcust = $cust;

        //
        $rs_head = $this->db->insert('customer', array(
            'customer_id' => $mcust->getCustomer_id(),
            'company_id' => $mcust->getCompany_id(),
            'custtype_id' => $mcust->getCusttype_id(),
            'condtcust' => $mcust->getCondtcust(),
            'nature_indcorp' => $mcust->getNature_indcorp(),
            'occupation_id' => $mcust->getOccupation_id(),
            'cnpj' => $mcust->getCnpj(),
            'ie' => $mcust->getIe(),
            'corpname' => $mcust->getCorpname(),
            'aliasname' => $mcust->getAliasname(),
            'gender' => $mcust->getGender(),
            'status' => $mcust->getStatus(),
            'note' => $mcust->getNote(),
            'date_create' => $mcust->getDate_create()));

        if (isset($rs_head))
            return $rs_head;

        $rs_comm = $this->db->insert('customer_commcont', array(
            'customer_id' => $mcust->getCustomer_id(),
            'commercial_contact_name' => $mcust->getCommercial_contact_name(),
            'comm_business_phone' => $mcust->getComm_business_phone(),
            'comm_mobil_phone' => $mcust->getComm_mobil_phone(),
            'comm_nextel_phone' => $mcust->getComm_nextel_phone(),
            'comm_nextel_id' => $mcust->getComm_nextel_id(),
            'comm_fax_phone' => $mcust->getComm_fax_phone(),
            'comm_email' => $mcust->getComm_email(),
            'comm_webpage' => $mcust->getComm_webpage(),
            'comm_note' => $mcust->getComm_note()));
        //
        if (isset($rs_comm))
            return $rs_comm;

        $rs_inv = $this->db->insert('customer_invcont', array(
            'customer_id' => $mcust->getCustomer_id(),
            'invoice_contact_name' => $mcust->getInvoice_contact_name(),
            'inv_business_phone' => $mcust->getInv_business_phone(),
            'inv_mobil_phone' => $mcust->getInv_mobil_phone(),
            'inv_nextel_phone' => $mcust->getInv_nextel_phone(),
            'inv_nextel_id' => $mcust->getInv_nextel_id(),
            'inv_fax_phone' => $mcust->getInv_fax_phone(),
            'inv_email' => $mcust->getInv_email(),
            'inv_note' => $mcust->getInv_note()));
        //
        if (isset($rs_inv))
            return $rs_inv;


        //
        $rs_commaddr = $this->db->insert('customer_commaddr', array(
            'customer_id' => $mcust->getCustomer_id(),
            'comm_addr_id' => $mcust->getComm_addr_id(),
            'comm_addr_zip' => $mcust->getComm_addr_zip(),
            'comm_address' => $mcust->getComm_address(),
            'comm_addr_number' => $mcust->getComm_addr_number(),
            'comm_addr_comp' => $mcust->getComm_addr_comp(),
            'comm_addr_dist' => $mcust->getComm_addr_dist(),
            'comm_addr_city' => $mcust->getComm_addr_city(),
            'comm_addr_state' => $mcust->getComm_addr_state(),
            'comm_addr_ref' => $mcust->getComm_addr_ref()));

        /**
         * If add details is not free
         * error, enter to return error. 
         */
        if (isset($rs_commaddr))
            return $rs_commaddr;


        //
        $rs_invaddr = $this->db->insert('customer_invaddr', array(
            'customer_id' => $mcust->getCustomer_id(),
            'inv_addr_id' => $mcust->getInv_addr_id(),
            'inv_addr_zip' => $mcust->getInv_addr_zip(),
            'inv_address' => $mcust->getInv_address(),
            'inv_addr_number' => $mcust->getInv_addr_number(),
            'inv_addr_comp' => $mcust->getInv_addr_comp(),
            'inv_addr_dist' => $mcust->getInv_addr_dist(),
            'inv_addr_city' => $mcust->getInv_addr_city(),
            'inv_addr_state' => $mcust->getInv_addr_state(),
            'inv_addr_ref' => $mcust->getInv_addr_ref()));

        /**
         * If add details is not free
         * error, enter to return error. 
         */
        if (isset($rs_invaddr))
            return $rs_invaddr;

        //
        return $rs_head;
    }

    /*
     * Metho to update customer and your 
     * address.
     */

    public function updateCust($cust) {
        $mcust = new Customer();
        $mcust = $cust;

        //
        $rs_head = $this->db->update('customer', array(
            'company_id' => $mcust->getCompany_id(),
            'custtype_id' => $mcust->getCusttype_id(),
            'condtcust' => $mcust->getCondtcust(),
            'occupation_id' => $mcust->getOccupation_id(),
            'aliasname' => $mcust->getAliasname(),
            'status' => $mcust->getStatus(),
            'note' => $mcust->getNote(),
            'date_change' => $mcust->getDate_change()), "customer_id = {$mcust->getCustomer_id()}");

        if (isset($rs_head))
            return $rs_head;

        $rs_comm = $this->db->update('customer_commcont', array(
            'commercial_contact_name' => $mcust->getCommercial_contact_name(),
            'comm_business_phone' => $mcust->getComm_business_phone(),
            'comm_mobil_phone' => $mcust->getComm_mobil_phone(),
            'comm_nextel_phone' => $mcust->getComm_nextel_phone(),
            'comm_nextel_id' => $mcust->getComm_nextel_id(),
            'comm_fax_phone' => $mcust->getComm_fax_phone(),
            'comm_email' => $mcust->getComm_email(),
            'comm_webpage' => $mcust->getComm_webpage(),
            'comm_note' => $mcust->getComm_note()), "customer_id = {$mcust->getCustomer_id()}");
        //
        if (isset($rs_comm))
            return $rs_comm;

        $rs_inv = $this->db->update('customer_invcont', array(
            'invoice_contact_name' => $mcust->getInvoice_contact_name(),
            'inv_business_phone' => $mcust->getInv_business_phone(),
            'inv_mobil_phone' => $mcust->getInv_mobil_phone(),
            'inv_nextel_phone' => $mcust->getInv_nextel_phone(),
            'inv_nextel_id' => $mcust->getInv_nextel_id(),
            'inv_fax_phone' => $mcust->getInv_fax_phone(),
            'inv_email' => $mcust->getInv_email(),
            'inv_note' => $mcust->getInv_note()), "customer_id = {$mcust->getCustomer_id()}");
        //
        if (isset($rs_inv))
            return $rs_inv;

        //
        $rs_commaddr = $this->db->update('customer_commaddr', array(
            'comm_addr_id' => $mcust->getComm_addr_id(),
            'comm_addr_zip' => $mcust->getComm_addr_zip(),
            'comm_address' => $mcust->getComm_address(),
            'comm_addr_number' => $mcust->getComm_addr_number(),
            'comm_addr_comp' => $mcust->getComm_addr_comp(),
            'comm_addr_dist' => $mcust->getComm_addr_dist(),
            'comm_addr_city' => $mcust->getComm_addr_city(),
            'comm_addr_state' => $mcust->getComm_addr_state(),
            'comm_addr_ref' => $mcust->getComm_addr_ref()), "customer_id = {$mcust->getCustomer_id()}");

        /**
         * If add details is not free
         * error, enter to return error. 
         */
        if (isset($rs_commaddr))
            return $rs_commaddr;

        //
        $rs_invaddr = $this->db->update('customer_invaddr', array(
            'inv_addr_id' => $mcust->getInv_addr_id(),
            'inv_addr_zip' => $mcust->getInv_addr_zip(),
            'inv_address' => $mcust->getInv_address(),
            'inv_addr_number' => $mcust->getInv_addr_number(),
            'inv_addr_comp' => $mcust->getInv_addr_comp(),
            'inv_addr_dist' => $mcust->getInv_addr_dist(),
            'inv_addr_city' => $mcust->getInv_addr_city(),
            'inv_addr_state' => $mcust->getInv_addr_state(),
            'inv_addr_ref' => $mcust->getInv_addr_ref()), "customer_id = {$mcust->getCustomer_id()}");

        /**
         * If add details is not free
         * error, enter to return error. 
         */
        if (isset($rs_invaddr))
            return $rs_invaddr;


        //
        return $rs_head;
    }

    /**
     * I stop here for test anyway to put data in web frame for confirm 
     * if delete or not the customer and user, them whem I will have got the
     * best way to do this, I will continue the remove action.
     * @param type $cpny_id
     * @return \Msg
     */
    public function removeCust($cust_id) {
        // $msg = new Msg("", "", false);
        //$cpny_id = 20;
        //
        $status = $this->db->selectObj('SELECT status FROM staff WHERE customer_id = :customer_id', array(':customer_id' => $cust_id), "Staff");

        if (!$status) {
            //
            //Remove Customer
            $rscustomer = $this->db->delete('customer', "customer_id = '$cust_id'");

            //Remove Customer Commercial
            $rscommcont = $this->db->delete('customer_commcont', "customer_id = '$cust_id'");

            //Remove Customer Invoice
            $rsinvcont = $this->db->delete('customer_invcont', "customer_id = '$cust_id'");

            //Remove Customer Commercial Address
            $rscommaddr = $this->db->delete('customer_commaddr', "customer_id = '$cust_id'");

            //Remove Customer Invoice Address
            $rsinvaddr = $this->db->delete('customer_invaddr', "customer_id = '$cust_id'");

            //    
            if (($rscustomer == 1) && ($rscommcont == 1) &&
                    ($rsinvcont == 1) && ($rscommaddr == 1) &&
                    ($rsinvaddr == 1)) {
                //
                $this->msg->setType('Okay');
                $this->msg->setStatusError(FALSE);
                $this->msg->setMsg("Cliente Excluido com Sucesso!");
            } else {
                $this->msg->setType('Error');
                $this->msg->setStatusError(TRUE);
                $this->msg->setMsg("Cliente não pode ser removido!!!");
            }
            //
            return $this->msg;
        } else {
            $this->msg->setType('Error');
            $this->msg->setStatusError(TRUE);
            $this->msg->setMsg("Cliente não pode ser removido!, Há Colaboradores Ativos!");
            //
            print_r($this->msg);
            exit();
            return $this->msg;
        }
    }

}
