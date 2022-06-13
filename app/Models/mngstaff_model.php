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
require_once 'Company.php';
require_once 'Jobtitle.php';
require_once 'Department.php';
require_once 'TypeAccount.php';
require_once 'Local.php';
require_once 'Staff.php';
require_once 'view/StaffTableView.php';
require_once 'view/StaffView.php';
require_once 'Bank.php';

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
class Mngstaff_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->staff = new Staff();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    /**
     * Method to get a list from object
     * Customer for list in a table to
     * edit or update.
     * @return type
     */
    public function getStaffToTable() {
        return $this->db->selectObjList('SELECT stf.staff_id, ps.name, ps.surname, jb.longname, ad.date_admis, lc.shortname, pc.home_phone, stf.status 
FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb 
WHERE stf.person_id = ps.person_id 
AND   stf.local_id  = lc.local_id
AND   stf.staff_id = ad.staff_id
AND   stf.person_id = pc.person_id
AND   stf.jobtitle_id = jb.jobtitle_id
ORDER BY ps.`name` DESC;', $array = array(), "StaffTableView");
    }

    /**
     * Method used to get object Staff for 
     * a id informed.
     * @param type $staff_id
     * @return type
     */
    function getStaff($staff_id) {
        //
        $staff = new Staff();
        //
        $staff = $this->db->selectObj('SELECT staff_id, person_id, local_id, customer_id, '
                . 'company_id, jobtitle_id, department_id, firstjob, staff_msg, status '
                . 'FROM staff '
                . 'WHERE staff_id = :staff_id', array(':staff_id' => $staff_id), "Staff");

        $staffadmis = $this->db->selectObj('SELECT date_admis, salary, transp_ticket, '
                . 'transptkqt1, transptkvl1, transptkqt2, transptkvl2, transptkqt3, '
                . 'transptkvl3, workload, starttime, endtime, resignation_date '
                . 'FROM staffadmis '
                . 'WHERE staff_id = :staff_id', array(':staff_id' => $staff_id), 'StaffAdmis');

        //Set data to staff staffadmis
        $staff->setStaffAdmis($staffadmis);

        $person = $this->db->selectObj('SELECT person_id, name, surname, birthdate, gender, '
                . 'naturality, naturality_state, nationality, country_city_state, '
                . 'bloodperson, colorperson, marital_state, specialnbearer, imagepath, '
                . 'fathername, mothername, wifesname FROM person '
                . 'WHERE person_id = :person_id', array(':person_id' => $staff->getPerson_id()), 'Person');

        //Set data to staff person
        $staff->setPerson($person);

        $person_addr = $this->db->selectObj('SELECT person_id, zipid, zipcode, address, addr_number, '
                . 'complement, district, city, state, reference FROM personaddr '
                . 'WHERE person_id = :person_id', array(':person_id' => $staff->getPerson_id()), 'PersonAddr');

        //Set data to staff personaddr  
        $staff->setPersonAddr($person_addr);


        $person_bank = $this->db->selectObj('SELECT person_id, typeaccount_id, bank_id, '
                . 'operation, agency, account, account_holder FROM personbank '
                . 'WHERE person_id = :person_id', array(':person_id' => $staff->getPerson_id()), 'PersonBank');

        //Set data to staff PersonBank
        $staff->setPersonBank($person_bank);

        $person_contact = $this->db->selectObj('SELECT person_id, email, home_phone, mobil_phone, '
                . 'nextel_phone, nextel_id, contact_phone, contact_mobil, contact_name, contact_msg FROM personcontact '
                . 'WHERE person_id = :person_id', array(':person_id' => $staff->getPerson_id()), 'PersonContact');

        //Set data to staff PersonContact
        $staff->setPersonContact($person_contact);


        $person_doc = $this->db->selectObj('SELECT person_id, rg, rg_organissuer, rg_dateofchip, '
                . 'crsm, crsm_serie, crsm_cat, cpf, ctps, ctpsserie, ctps_dateofissuer, '
                . 'pispasep, yearlastcontrib, birthormary_certif, cnh, cnh_cat, cnh_dateofexpire, '
                . 'titlevote, titlevote_sec, titlevote_zone FROM persondoc '
                . 'WHERE person_id = :person_id', array(':person_id' => $staff->getPerson_id()), 'PersonDoc');


        //Set data to staff PersonDoc
        $staff->setPersonDoc($person_doc);


        $person_education = $this->db->selectObj('SELECT person_id, education_id, year_completion, '
                . 'othereducation '
                . 'FROM personeducation '
                . 'WHERE person_id = :person_id', array(':person_id' => $staff->getPerson_id()), 'PersonEducation');

        //Set data to staff PersonEducation
        $staff->setPersonEducation($person_education);


        $personref = $this->db->selectObj('SELECT person_id, refname, refaddress, refphone, '
                . 'refemail '
                . 'FROM personref '
                . 'WHERE person_id = :person_id', array(':person_id' => $staff->getPerson_id()), 'PersonRef');
        //
        //Set data to staff PersonRef
        $staff->setPersonRef($personref);

        /* print "<pre>";
          print_r($staff);
          print "</pre>";
          exit(); */

        //
        //
        return $staff;
    }

    /**
     * Method used to get object Staff Only for 
     * informed id.
     * @param type $staff_id
     * @return type
     */
    function getStaffOnly($staff_id) {
        //
        $staff = $this->db->SingleObj('SELECT stf.staff_id, stf.person_id, stf.local_id, stf.customer_id, '
                . 'stf.company_id, stf.jobtitle_id, stf.department_id, stf.firstjob, stf.staff_msg, stf.status, pc.email '
                . 'FROM staff stf, personcontact pc '
                . 'WHERE stf.staff_id = :staff_id AND stf.person_id = pc.person_id', array(':staff_id' => $staff_id));  
        /* print "<pre>";
          print_r($staff);
          print "</pre>";
          exit(); */
        //
        //
        return $staff;
    }    
    
    /**
     * Method to get to Informed ID
     * and Show.
     * @param type $staff_id
     */
    public function getStaffView($staff_id) {
        //
        $staff_view = new StaffView();

        $staff_view = $this->db->selectObj('
            SELECT stf.staff_id, stf.status, sta.date_admis, sta.resignation_date, 
            sta.salary, sta.workload, sta.starttime, sta.endtime, sta.transp_ticket, 
            sta.transptkqt1, sta.transptkvl1, sta.transptkqt2, sta.transptkvl2, 
            sta.transptkqt3, sta.transptkvl3, cp.shortname as company_name, 
            ct.aliasname as customer_name, ps.name, ps.surname, ps.imagepath as photo, 
            ps.birthdate as date_birth, jb.longname as jobtitle, lc.shortname as local_name, 
            pc.email, pc.mobil_phone, pc.nextel_phone, pc.nextel_id, pc.home_phone, pc.contact_phone,
            pc.contact_mobil, pc.contact_name, pa.zipcode, pa.address, pa.addr_number, 
            pa.complement, pa.district, pa.city, pa.`state`, ta.acronym, bb.description as bank_name, 
            pb.operation, pb.agency, pb.account, pb.account_holder  
FROM staff stf, 
     staffadmis sta, 
     person ps,
     personbank pb,
     type_account ta,
     bank_branch bb,
     personaddr pa, 
     personcontact pc, 
     local lc, 
     jobtitle jb, 
     company cp, 
     customer ct 
WHERE stf.staff_id  = :staff_id
AND stf.person_id   = ps.person_id
AND stf.person_id   = pa.person_id 
AND stf.person_id   = pc.person_id 
AND stf.person_id   = pb.person_id 
AND pb.typeaccount_id = ta.typeaccount_id
AND pb.bank_id = bb.bankbranch_id 
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.staff_id    = sta.staff_id 
ORDER BY ps.`name` DESC;', array(':staff_id' => $staff_id), 'StaffView');
        //
        //Format date to show
        $staff_view->setDataToView();

        return $staff_view;
    }

    /**
     * Method to get AllStaff to Selected
     * (W) = With 
     * (C) = Customer
     * (J) = Jobtitle
     * Option in Combobox.
     * @param type $staff, type $type
     * @return staff_list
     */
    public function getAllStaffs($staff, $type) {
        if ($type == 'WCJ') {//To Search to (W)ith, (C)ustomer and (J)obTitle Selected
            //
            $staffs = $this->db->selectObjList('
                SELECT stf.staff_id, ps.name, ps.surname 
                FROM staff stf, person ps 
                WHERE stf.status      = :status 
                AND   stf.company_id  = :company_id 
                AND   stf.customer_id = :customer_id 
                AND   stf.local_id    = :local_id 
                AND   stf.jobtitle_id = :jobtitle_id 
                AND   stf.person_id   = ps.person_id 
                ORDER BY ps.`name` DESC;'
                    , array(
                        ':status' => $staff->getStatus(),
                        ':company_id'  => $staff->getCompany_id(),
                        ':customer_id' => $staff->getCustomer_id(),
                        ':local_id'    => $staff->getLocal_id(),
                        ':jobtitle_id' => $staff->getJobtitle_id()), 'StaffTableView');
            //
        //
        } elseif ($type == 'WOC') {//To Search to Customer Selected, Without Jobtitle!
            //
            $staffs = $this->db->selectObjList('
                SELECT stf.staff_id, ps.name, ps.surname 
                FROM staff stf, person ps, local lc, jobtitle jb, company cp, customer ct 
                WHERE stf.status    = :status
                AND stf.company_id  = :company_id 
                AND stf.customer_id = :customer_id 
                AND stf.local_id    = :local_id 
                AND stf.person_id   = ps.person_id 
                AND stf.company_id  = cp.company_id 
                AND stf.customer_id = ct.customer_id 
                AND stf.local_id    = lc.local_id 
                AND stf.jobtitle_id = jb.jobtitle_id 
                ORDER BY ps.`name` DESC;'
                    , array(
                ':status'      => $staff->getStatus(),
                ':company_id'  => $staff->getCompany_id(),
                ':customer_id' => $staff->getCustomer_id(),
                ':local_id'    => $staff->getLocal_id()), 'StaffTableView');
            //
        //
        } elseif ($type == 'WOJ') {//To Search To Jobtitle Selected and Without Customer
            //
            $staffs = $this->db->selectObjList('
                SELECT stf.staff_id, ps.name, ps.surname 
                FROM staff stf, person ps, local lc, jobtitle jb, company cp, customer ct 
                WHERE stf.status    = :status
                AND stf.company_id  = :company_id 
                AND stf.local_id    = :local_id 
                AND stf.jobtitle_id = :jobtitle_id 
                AND stf.person_id   = ps.person_id 
                AND stf.company_id  = cp.company_id 
                AND stf.customer_id = ct.customer_id 
                AND stf.local_id    = lc.local_id 
                AND stf.jobtitle_id = jb.jobtitle_id 
                AND stf.person_id   = pc.person_id 
                AND stf.staff_id    = ad.staff_id 
                ORDER BY ps.`name` DESC;'
                    , array(
                ':status'      => $staff->getStatus(),
                ':company_id'  => $staff->getCompany_id(),
                ':local_id'    => $staff->getLocal_id(),
                ':jobtitle_id' => $staff->getJobtitle_id()), 'StaffTableView');
            //
        //
        } elseif ($type == 'WOCJ') {//Search in All Customer and JobTitle
            //
            $staffs = $this->db->selectObjList('
                SELECT stf.staff_id, ps.name, ps.surname 
                FROM staff stf, person ps, local lc, jobtitle jb, company cp, customer ct 
                WHERE stf.status    = :status 
                AND stf.company_id  = :company_id 
                AND stf.local_id    = :local_id 
                AND stf.person_id   = ps.person_id 
                AND stf.company_id  = cp.company_id 
                AND stf.customer_id = ct.customer_id 
                AND stf.jobtitle_id = jb.jobtitle_id 
                AND stf.local_id    = lc.local_id 
                ORDER BY ps.`name` DESC;'
                    , array(
                ':status'        => $staff->getStatus(),
                ':company_id'    => $staff->getCompany_id(),
                ':local_id'      => $staff->getLocal_id()), 'StaffTableView');
        }
        //
        return $staffs;
    }

    /**
     * Method to get AllStaffByName
     * Informed.
     * @param type $staff, type $type
     * @return staff_list
     */
    public function getAllStaffsByName($staff, $type) {
        if ($type == 'WCJ') {//To Search to (C)ustomer and (J)obTitle Selected
            //
            $staffs = $this->db->selectObjList('
                SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, 
                ps.name, ps.surname, jb.longname, ad.date_admis, lc.shortname, 
                pc.home_phone, stf.status 
                FROM staff stf, person ps, local lc, staffadmis ad, 
                personcontact pc, jobtitle jb, company cp, customer ct 
WHERE ps.name       = :name 
AND ps.surname      = :surname 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.customer_id = :customer_id
AND stf.local_id    = :local_id 
AND stf.jobtitle_id = :jobtitle_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':name' => $staff->getName(),
                ':surname' => $staff->getSurname(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':customer_id' => $staff->getCustomer_id(),
                ':local_id' => $staff->getLocal_id(),
                ':jobtitle_id' => $staff->getJobtitle_id()), 'StaffTableView');
            //
        //
        } elseif ($type == 'WOC') {//To Search to Customer Selected an Without Jobtitle!
            //
            $staffs = $this->db->selectObjList('
                SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, 
                ps.name, ps.surname, jb.longname, ad.date_admis, lc.shortname, 
                pc.home_phone, stf.status 
                FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, 
                jobtitle jb, company cp, customer ct 
WHERE ps.name       = :name 
AND ps.surname      = :surname 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.customer_id = :customer_id
AND stf.local_id    = :local_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':name' => $staff->getName(),
                ':surname' => $staff->getSurname(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':customer_id' => $staff->getCustomer_id(),
                ':local_id' => $staff->getLocal_id()), 'StaffTableView');
            //
        //
        } elseif ($type == 'WOJ') {//To Search To Jobtitle Selected and Without Customer
            //
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, 
                cp.company_id, ct.customer_id, ps.name, ps.surname, jb.longname, 
                ad.date_admis, lc.shortname, pc.home_phone, stf.status 
                FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, 
                jobtitle jb, company cp, customer ct 
WHERE ps.name       = :name 
AND ps.surname      = :surname 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.local_id    = :local_id 
AND stf.jobtitle_id = :jobtitle_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':name' => $staff->getName(),
                ':surname' => $staff->getSurname(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':local_id' => $staff->getLocal_id(),
                ':jobtitle_id' => $staff->getJobtitle_id()), 'StaffTableView');
            //
        //
        } elseif ($type == 'WOCJ') {//Search in All Customer and JobTitle
            //
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, cp.company_id, 
                ct.customer_id, ps.name, ps.surname, jb.longname, ad.date_admis, lc.shortname, 
                pc.home_phone, stf.status 
                FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb, 
                company cp, customer ct 
WHERE ps.name       = :name 
AND ps.surname      = :surname 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.local_id    = :local_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.local_id    = lc.local_id 
AND stf.person_id   = pc.person_id 
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':name' => $staff->getName(),
                ':surname' => $staff->getSurname(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':local_id' => $staff->getLocal_id()), 'StaffTableView');
        }
        //
        return $staffs;
    }

    /**
     * Method to get AllStaffByDateAdmis
     * Informed.
     * @param type $staff
     * @return type
     */
    public function getAllStaffsByDateAdmis($staff, $type) {

        if ($type == 'WCJ') {//To Search to (C)ustomer and (J)obTitle Selected
            //
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, ps.name, ps.surname, jb.longname, ad.date_admis, lc.shortname, pc.home_phone, stf.status 
FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb, company cp, customer ct 
WHERE ad.date_admis = :date_admis 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.customer_id = :customer_id
AND stf.local_id    = :local_id 
AND stf.jobtitle_id = :jobtitle_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':date_admis' => $staff->getDate_admis(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':customer_id' => $staff->getCustomer_id(),
                ':local_id' => $staff->getLocal_id(),
                ':jobtitle_id' => $staff->getJobtitle_id()), 'StaffTableView');
            //
        } elseif ($type == 'WOC') {//To Search to Customer Selected an Without Jobtitle!
            //
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, ps.name, ps.surname, jb.longname, ad.date_admis, lc.shortname, pc.home_phone, stf.status 
FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb, company cp, customer ct 
WHERE ad.date_admis  = :date_admis 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.customer_id = :customer_id
AND stf.local_id    = :local_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':date_admis' => $staff->getDate_admis(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':customer_id' => $staff->getCustomer_id(),
                ':local_id' => $staff->getLocal_id()), 'StaffTableView');
            //
        } elseif ($type == 'WOJ') {//To Search To Jobtitle Selected and Without Customer
            //
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, ps.name, ps.surname, jb.longname, ad.date_admis, lc.shortname, pc.home_phone, stf.status 
FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb, company cp, customer ct 
WHERE ad.date_admis = :date_admis 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.local_id    = :local_id 
AND stf.jobtitle_id = :jobtitle_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':date_admis' => $staff->getDate_admis(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':local_id' => $staff->getLocal_id(),
                ':jobtitle_id' => $staff->getJobtitle_id()), 'StaffTableView');
            //
        } elseif ($type == 'WOCJ') {//Search in All Customer and JobTitle
            //
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, ps.name, ps.surname, jb.longname, ad.date_admis, lc.shortname, pc.home_phone, stf.status 
FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb, company cp, customer ct 
WHERE ad.date_admis  = :date_admis 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.local_id    = :local_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':date_admis' => $staff->getDate_admis(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':local_id' => $staff->getLocal_id()), 'StaffTableView');
            //
        }
        //
        //
        return $staffs;
    }

    /**
     * Method to get AllStaffsByCpf
     * Informed.
     * @param type $staff
     * @return type
     */
    public function getAllStaffsByCpf($staff, $type) {
        $stf = new Staff();
        $stf = $staff;
        //
        if ($type == 'WCJ') {//To Search to (C)ustomer and (J)obTitle Selected
            //
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, ps.name, ps.surname, pd.cpf, jb.longname, ad.date_admis, lc.shortname, pc.home_phone, stf.status 
FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb, company cp, customer ct, persondoc pd  
WHERE pd.cpf        = :cpf 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.customer_id = :customer_id
AND stf.local_id    = :local_id 
AND stf.jobtitle_id = :jobtitle_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.person_id   = pd.person_id  
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':cpf' => $stf->getCpf(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':customer_id' => $staff->getCustomer_id(),
                ':local_id' => $staff->getLocal_id(),
                ':jobtitle_id' => $staff->getJobtitle_id()), 'StaffTableView');
            //       
        } elseif ($type == 'WOC') {//To Search to Customer Selected an Without Jobtitle!
            //
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, ps.name, ps.surname, pd.cpf, jb.longname, ad.date_admis, lc.shortname, pc.home_phone, stf.status 
FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb, company cp, customer ct, persondoc pd  
WHERE pd.cpf        = :cpf 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.customer_id = :customer_id
AND stf.local_id    = :local_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.person_id   = pd.person_id  
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':cpf' => $stf->getCpf(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':customer_id' => $staff->getCustomer_id(),
                ':local_id' => $staff->getLocal_id()), 'StaffTableView');
            //
        } elseif ($type == 'WOJ') {//To Search To Jobtitle Selected and Without Customer
//
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, ps.name, ps.surname, pd.cpf, jb.longname, ad.date_admis, lc.shortname, pc.home_phone, stf.status 
FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb, company cp, customer ct, persondoc pd  
WHERE pd.cpf        = :cpf 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.local_id    = :local_id 
AND stf.jobtitle_id = :jobtitle_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.person_id   = pd.person_id  
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':cpf' => $stf->getCpf(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':local_id' => $staff->getLocal_id(),
                ':jobtitle_id' => $staff->getJobtitle_id()), 'StaffTableView');
            //
        } elseif ($type == 'WOCJ') {//Search in All Customer and JobTitle
            //
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, ps.name, ps.surname, pd.cpf, jb.longname, ad.date_admis, lc.shortname, pc.home_phone, stf.status 
FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb, company cp, customer ct, persondoc pd  
WHERE pd.cpf        = :cpf 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.local_id    = :local_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.person_id   = pd.person_id 
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':cpf' => $stf->getCpf(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':local_id' => $staff->getLocal_id()), 'StaffTableView');
            //
        }
        //
        return $staffs;
    }

    /**
     * Method to get AllStaffsByRG
     * Informed.
     * @param type $staff
     * @return type
     */
    public function getAllStaffsByRG($staff, $type) {
        $stf = new Staff();
        //
        $stf = $staff;
        if ($type == 'WCJ') {//To Search to (C)ustomer and (J)obTitle Selected
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, ps.name, ps.surname, pd.cpf, jb.longname, ad.date_admis, lc.shortname, pc.home_phone, stf.status 
FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb, company cp, customer ct, persondoc pd  
WHERE pd.rg         = :rg 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.customer_id = :customer_id
AND stf.local_id    = :local_id 
AND stf.jobtitle_id = :jobtitle_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.person_id   = pd.person_id  
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':rg' => $stf->getRg(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':customer_id' => $staff->getCustomer_id(),
                ':local_id' => $staff->getLocal_id(),
                ':jobtitle_id' => $staff->getJobtitle_id()), 'StaffTableView');
            //       
        } elseif ($type == 'WOC') {//To Search to Customer Selected an Without Jobtitle!
            //
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, ps.name, ps.surname, pd.cpf, jb.longname, ad.date_admis, lc.shortname, pc.home_phone, stf.status 
FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb, company cp, customer ct, persondoc pd  
WHERE pd.rg         = :rg 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.customer_id = :customer_id
AND stf.local_id    = :local_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.person_id   = pd.person_id  
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':rg' => $stf->getRg(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':customer_id' => $staff->getCustomer_id(),
                ':local_id' => $staff->getLocal_id()), 'StaffTableView');
            //
        } elseif ($type == 'WOJ') {//To Search To Jobtitle Selected and Without Customer
            //
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, ps.name, ps.surname, pd.cpf, jb.longname, ad.date_admis, lc.shortname, pc.home_phone, stf.status 
FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb, company cp, customer ct, persondoc pd  
WHERE pd.rg         = :rg 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.local_id    = :local_id 
AND stf.jobtitle_id = :jobtitle_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.person_id   = pd.person_id  
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':rg' => $stf->getRg(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':local_id' => $staff->getLocal_id(),
                ':jobtitle_id' => $staff->getJobtitle_id()), 'StaffTableView');
            //
        } elseif ($type == 'WOCJ') {//Search in All Customer and JobTitle
            //
            $staffs = $this->db->selectObjList('SELECT stf.staff_id, stf.status, cp.company_id, ct.customer_id, ps.name, ps.surname, pd.cpf, jb.longname, ad.date_admis, lc.shortname, pc.home_phone, stf.status 
FROM staff stf, person ps, local lc, staffadmis ad, personcontact pc, jobtitle jb, company cp, customer ct, persondoc pd  
WHERE pd.rg         = :rg 
AND stf.status      = :status 
AND stf.company_id  = :company_id 
AND stf.local_id    = :local_id 
AND stf.person_id   = ps.person_id
AND stf.company_id  = cp.company_id 
AND stf.customer_id = ct.customer_id
AND stf.local_id    = lc.local_id 
AND stf.jobtitle_id = jb.jobtitle_id
AND stf.person_id   = pc.person_id 
AND stf.person_id   = pd.person_id  
AND stf.staff_id    = ad.staff_id
ORDER BY ps.`name` DESC;', array(':rg' => $stf->getRg(),
                ':status' => $staff->getStatus(),
                ':company_id' => $staff->getCompany_id(),
                ':local_id' => $staff->getLocal_id()), 'StaffTableView');
            //
        }

        return $staffs;
    }

    /*
     * Method to add a new Staff to vltsegdb. 
     */

    public function createNewStaff($staff) {
        $stf = new Staff();
        $stf = $staff;
/*
        print "<pre>";
        print_r($staff);
        print "</pre>";
        exit();*/
//
        //Write Staff Head
        $rs_staff = $this->db->insert('staff', array(
            'staff_id' => $stf->getStaff_id(),
            'person_id' => $stf->getPerson_id(),
            'local_id' => $stf->getLocal_id(),
            'customer_id' => $stf->getCustomer_id(),
            'company_id' => $stf->getCompany_id(),
            'jobtitle_id' => $stf->getJobtitle_id(),
            'firstjob' => $stf->getFirstjob(),
            'department_id' => $stf->getDepartment_id(),
            'staff_msg' => $stf->getStaff_msg(),
            'status' => $stf->getStatus(),
            'date_create' => $stf->getDate_create()
        ));

        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_staff))
            return $rs_staff;

        //Write Staff Admis
        $rs_staffadmis = $this->db->insert('staffadmis', array(
            'staff_id' => $stf->getStaff_id(),
            'date_admis' => $stf->getDate_admis(),
            'salary' => $stf->getSalary(),
            'transp_ticket' => $stf->getTransp_ticket(),
            'transptkqt1' => $stf->getTransptkqt1(),
            'transptkvl1' => $stf->getTransptkvl1(),
            'transptkqt2' => $stf->getTransptkqt2(),
            'transptkvl2' => $stf->getTransptkvl2(),
            'transptkqt3' => $stf->getTransptkqt3(),
            'transptkvl3' => $stf->getTransptkvl3(),
            'workload' => $stf->getWorkload(),
            'starttime' => $stf->getStarttime(),
            'endtime' => $stf->getEndtime()
        ));

        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_staffadmis))
            return $rs_staffadmis;

        //Head Person
        $rs_person = $this->db->insert('person', array(
            'person_id' => $stf->getPerson_id(),
            'name' => $stf->getName(),
            'imagepath' => $stf->getImagepath(),
            'surname' => $stf->getSurname(),
            'birthdate' => $stf->getBirthdate(),
            'gender' => $stf->getGender(),
            'naturality' => $stf->getNaturality(),
            'naturality_state' => $stf->getNaturality_state(),
            'nationality' => $stf->getNationality(),
            'country_city_state' => $stf->getCountry_city_state(),
            'bloodperson' => $stf->getBloodperson(),
            'colorperson' => $stf->getColorperson(),
            'marital_state' => $stf->getMarital_state(),
            'specialnbearer' => $stf->getSpecialnbearer(),
            'fathername' => $stf->getFathername(),
            'mothername' => $stf->getMothername(),
            'wifesname' => $stf->getWifesname(),
            'status' => $stf->getStatus(),
            'date_create' => $stf->getDate_create()
        ));
        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_person))
            return $rs_person;



        //Person Address
        $rs_psaddr = $this->db->insert('personaddr', array(
            'person_id' => $stf->getPerson_id(),
            'zipid' => $stf->getZipid(),
            'zipcode' => $stf->getZipcode(),
            'address' => $stf->getAddress(),
            'addr_number' => $stf->getAddr_number(),
            'complement' => $stf->getComplement(),
            'district' => $stf->getDistrict(),
            'city' => $stf->getCity(),
            'state' => $stf->getState(),
            'reference' => $stf->getReference()
        ));

        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_psaddr))
            return $rs_psaddr;

        //Person Docs
        $rs_psdoc = $this->db->insert('persondoc', array(
            'person_id' => $stf->getPerson_id(),
            'rg' => $stf->getRg(),
            'rg_organissuer' => $stf->getRg_organissuer(),
            'rg_dateofchip' => $stf->getRg_dateofchip(),
            'crsm' => $stf->getCrsm(),
            'cpf' => $stf->getCpf(),
            'ctps' => $stf->getCtps(),
            'ctpsserie' => $stf->getCtpsserie(),
            'ctps_dateofissuer' => $stf->getCtps_dateofissuer(),
            'pispasep' => $stf->getPispasep(),
            'yearlastcontrib' => $stf->getYearlastcontrib(),
            'birthormary_certif' => $stf->getBirthormary_certif(),
            'cnh' => $stf->getCnh(),
            'cnh_cat' => $stf->getCnh_cat(),
            'cnh_dateofexpire' => $stf->getCnh_dateofexpire(),
            'titlevote' => $stf->getTitlevote(),
            'titlevote_sec' => $stf->getTitlevote_sec(),
            'titlevote_zone' => $stf->getTitlevote_zone()
        ));
        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_psdoc))
            return $rs_psdoc;


        //Person Banks
        $rs_psbank = $this->db->insert('personbank', array(
            'person_id' => $stf->getPerson_id(),
            'typeaccount_id' => $stf->getTypeaccount_id(),
            'bank_id' => $stf->getBank_id(),
            'agency' => $stf->getAgency(),
            'account' => $stf->getAccount(),
            'account_holder' => $stf->getAccount_holder()
        ));
        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_psbank))
            return $rs_psbank;


        //Person Contact
        $rs_pscontact = $this->db->insert('personcontact', array(
            'person_id' => $stf->getPerson_id(),
            'email' => $stf->getEmail(),
            'home_phone' => $stf->getHome_phone(),
            'mobil_phone' => $stf->getMobil_phone(),
            'nextel_phone' => $stf->getNextel_phone(),
            'nextel_id' => $stf->getNextel_id(),
            'contact_phone' => $stf->getContact_phone(),
            'contact_mobil' => $stf->getContact_mobil(),
            'contact_name' => $stf->getContact_name(),
            'contact_msg' => $stf->getContact_msg()
        ));
        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_pscontact))
            return $rs_pscontact;

        //Person Education
        $rs_pseducation = $this->db->insert('personeducation', array(
            'person_id' => $stf->getPerson_id(),
            'education_id' => $stf->getEducation_id(),
            'year_completion' => $stf->getYear_completion(),
            'othereducation' => $stf->getOthereducation()
        ));
        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_pseducation))
            return $rs_pseducation;

        //Person Reference
        $rs_psref = $this->db->insert('personref', array(
            'person_id' => $stf->getPerson_id(),
            'refname' => $stf->getRefname(),
            'refaddress' => $stf->getRefaddress(),
            'refphone' => $stf->getRefphone(),
            'refemail' => $stf->getRefemail()
        ));

        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_psref))
            return $rs_psref;
        //

        return $rs_staff;
    }

    /*
     * Metho to update Staff Person to vltsegdb. 
     */

    public function updateNewStaff($staff) {
        $stf = new Staff();
        $stf = $staff;
       /* print "<pre>";
        print_r($staff);
        print "</pre>";
        exit();*/
        
        //Write Staff Head
        $rs_staff = $this->db->update('staff', array(
            'person_id' => $stf->getPerson_id(),
            'local_id' => $stf->getLocal_id(),
            'customer_id' => $stf->getCustomer_id(),
            'company_id' => $stf->getCompany_id(),
            'jobtitle_id' => $stf->getJobtitle_id(),
            'firstjob' => $stf->getFirstjob(),
            'department_id' => $stf->getDepartment_id(),
            'staff_msg' => $stf->getStaff_msg(),
            'status' => $stf->getStatus(),
            'date_change' => $stf->getDate_change()
                ), "staff_id = {$stf->getStaff_id()}");

        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_staff))
            return $rs_staff;

        //Write Staff Admis
        $rs_staffadmis = $this->db->update('staffadmis', array(
            'date_admis' => $stf->getDate_admis(),
            'salary' => $stf->getSalary(),
            'transp_ticket' => $stf->getTransp_ticket(),
            'transptkqt1' => $stf->getTransptkqt1(),
            'transptkvl1' => $stf->getTransptkvl1(),
            'transptkqt2' => $stf->getTransptkqt2(),
            'transptkvl2' => $stf->getTransptkvl2(),
            'transptkqt3' => $stf->getTransptkqt3(),
            'transptkvl3' => $stf->getTransptkvl3(),
            'workload' => $stf->getWorkload(),
            'starttime' => $stf->getStarttime(),
            'endtime' => $stf->getEndtime()
                ), "staff_id = {$stf->getStaff_id()}");

        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_staffadmis))
            return $rs_staffadmis;

        //Head Person
        $rs_person = $this->db->update('person', array(
            'name' => $stf->getName(),
            'surname' => $stf->getSurname(),
            'birthdate' => $stf->getBirthdate(),
            'gender' => $stf->getGender(),
            'naturality' => $stf->getNaturality(),
            'naturality_state' => $stf->getNaturality_state(),
            'nationality' => $stf->getNationality(),
            'country_city_state' => $stf->getCountry_city_state(),
            'bloodperson' => $stf->getBloodperson(),
            'colorperson' => $stf->getColorperson(),
            'marital_state' => $stf->getMarital_state(),
            'specialnbearer' => $stf->getSpecialnbearer(),
            'fathername' => $stf->getFathername(),
            'mothername' => $stf->getMothername(),
            'wifesname' => $stf->getWifesname(),
            'status' => $stf->getStatus(),
            'date_change' => $stf->getDate_change()
                ), "person_id = {$stf->getPerson_id()}");
        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_person))
            return $rs_person;



        //Person Address
        $rs_psaddr = $this->db->update('personaddr', array(
            'zipid' => $stf->getZipid(),
            'zipcode' => $stf->getZipcode(),
            'address' => $stf->getAddress(),
            'addr_number' => $stf->getAddr_number(),
            'complement' => $stf->getComplement(),
            'district' => $stf->getDistrict(),
            'city' => $stf->getCity(),
            'state' => $stf->getState(),
            'reference' => $stf->getReference()
                ), " person_id = {$stf->getPerson_id()}");

        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_psaddr))
            return $rs_psaddr;

        //Person Docs
        $rs_psdoc = $this->db->update('persondoc', array(
            'rg' => $stf->getRg(),
            'rg_organissuer' => $stf->getRg_organissuer(),
            'rg_dateofchip' => $stf->getRg_dateofchip(),
            'crsm' => $stf->getCrsm(),
            'cpf' => $stf->getCpf(),
            'ctps' => $stf->getCtps(),
            'ctpsserie' => $stf->getCtpsserie(),
            'ctps_dateofissuer' => $stf->getCtps_dateofissuer(),
            'pispasep' => $stf->getPispasep(),
            'yearlastcontrib' => $stf->getYearlastcontrib(),
            'birthormary_certif' => $stf->getBirthormary_certif(),
            'cnh' => $stf->getCnh(),
            'cnh_cat' => $stf->getCnh_cat(),
            'cnh_dateofexpire' => $stf->getCnh_dateofexpire(),
            'titlevote' => $stf->getTitlevote(),
            'titlevote_sec' => $stf->getTitlevote_sec(),
            'titlevote_zone' => $stf->getTitlevote_zone()
                ), " person_id = {$stf->getPerson_id()}");
        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_psdoc))
            return $rs_psdoc;


        //Person Banks
        $rs_psbank = $this->db->update('personbank', array(
            'typeaccount_id' => $stf->getTypeaccount_id(),
            'bank_id' => $stf->getBank_id(),
            'agency' => $stf->getAgency(),
            'account' => $stf->getAccount(),
            'account_holder' => $stf->getAccount_holder()
                ), " person_id = {$stf->getPerson_id()}");
        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_psbank))
            return $rs_psbank;


        //Person Contact
        $rs_pscontact = $this->db->update('personcontact', array(
            'email' => $stf->getEmail(),
            'home_phone' => $stf->getHome_phone(),
            'mobil_phone' => $stf->getMobil_phone(),
            'nextel_phone' => $stf->getNextel_phone(),
            'nextel_id' => $stf->getNextel_id(),
            'contact_phone' => $stf->getContact_phone(),
            'contact_mobil' => $stf->getContact_mobil(),
            'contact_name' => $stf->getContact_name(),
            'contact_msg' => $stf->getContact_msg()
                ), " person_id = {$stf->getPerson_id()}");

        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_pscontact))
            return $rs_pscontact;

        //Person Education
        $rs_pseducation = $this->db->update('personeducation', array(
            'education_id' => $stf->getEducation_id(),
            'year_completion' => $stf->getYear_completion(),
            'othereducation' => $stf->getOthereducation()
                ), " person_id = {$stf->getPerson_id()}");

        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_pseducation))
            return $rs_pseducation;

        //Person Reference
        $rs_psref = $this->db->update('personref', array(
            'refname' => $stf->getRefname(),
            'refaddress' => $stf->getRefaddress(),
            'refphone' => $stf->getRefphone(),
            'refemail' => $stf->getRefemail()
                ), " person_id = {$stf->getPerson_id()}");

        /**
         * If is not free error,
         * enter to return error. 
         */
        if (isset($rs_psref))
            return $rs_psref;
        //

        return $rs_staff;
    }

    /**
     * Method to change staff status to Inactiv
     * when person is outing from job.
     * @param
     * @return \Msg
     */
    public function changeStatusStaff($staff) {

        /**
         * do update to staff
         */
        $rs_staff = $this->db->update('staff', array(
            'status' => $staff->getStatus()), "staff_id =  {$staff->getStaff_id()}");
        //
        if (!isset($rs_staff)) {
            $rs_staffadmis = $this->db->update('staffadmis', array(
                'resignation_date' => $staff->getResignation_date()), "staff_id = {$staff->getStaff_id()}");
            //
            return $rs_staffadmis;
        }

        return $rs_staff;
    }

    /**
     * Method to insert data person
     * from imagem to database, person table.
     * @param type $person
     * @return type
     */
    public function insertImageToDb($person) {
        /**
         * do update to person
         */
        $rs_person = $this->db->insert('person', array(
            'person_id' => $person->getPerson_id(),
            'name' => $person->getName(),
            'surname' => $person->getSurname(),
            'imagepath' => $person->getImagepath(),
            'date_create' => $person->getDate_create()
        ));
        //
        return $rs_person;
    }

    /**
     * Method to update data person
     * from imagem to database, table
     * person.
     * @param type $person
     * @return type
     */
    public function updateImageToDb($person) {
        /**
         * do update to person
         */
        $rs_person = $this->db->update('person', array(
            'imagepath' => $person->getImagepath()
                ), "person_id =  {$person->getPerson_id()}");
        //
        return $rs_person;
    }

}
