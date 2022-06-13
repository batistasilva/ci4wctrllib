<?php

require_once 'models/Msg.php';
require_once 'util/Tools.php';
require_once 'util/ToolsImage.php';
require_once 'models/SMsg.php';
require_once 'models/Customer.php';
require_once 'models/Company.php';
require_once 'models/CustType.php';
require_once 'models/Occupation.php';
require_once 'models/Staff.php';
require_once 'models/Local.php';
require_once 'models/Department.php';
require_once 'models/TypeAccount.php';
require_once 'models/mnglocal_model.php';
require_once 'models/mngcust_model.php';
require_once 'models/mngcpny_model.php';
require_once 'models/mngjob_model.php';
require_once 'models/mnglocal_model.php';
require_once 'models/mngdptm_model.php';
require_once 'models/mngtypeaccount_model.php';
require_once 'models/mngbank_model.php';
require_once 'models/mngzipcode_model.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mngstaff
 *
 * @author sistema
 */
class Mngstaff extends Controller {

    public $smsg;
    private $msg;

    public function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->smsg = new SMsg();
        $this->msg = new Msg(NULL, NULL, NULL, NULL, NULL, NULL);
    }

    /**
     * Method responsible for open 
     * show data in index view..
     */
    public function index() {
        //echo 'Bem vindo ao (Index mngstaff) dos Colaboradores!!!';
        //exit();
        $this->view->title = 'OSSB Solutions - Cadastro de Colaboradores';
        $this->view->StaffList = $this->model->getStaffToTable();
        //Class to be user for finish object session
        $this->view->smsg         = $this->smsg;
        /* $obj = $this->model->getStaffList();
          print "<pre>";
          print_r($obj);
          print "</pre>";
          exit(); */

//
        $this->view->render('header');
        $this->view->render('mngstaff/index');
        $this->view->render('footer');
    }

    public function searchstaff() {
        $cust  = new Mngcust_Model();
        $cpny  = new Mngcpny_Model();
        $job   = new Mngjob_Model();
        $local = new MngLocal_Model();
        //
        
        $this->view->title = 'OSSB Solutions - Pesquisa de Colaboradores';
        // exit();
        $this->view->CpnyList     = $cpny->getCpnyToCombobox();
        $this->view->CustList     = $cust->getCustomerToCombox();
        $this->view->JobTitleList = $job->getJobTitleToCombobox();
        $this->view->LocalList    = $local->getLocalToCombobox();
        $this->view->StaffList    = $this->model->getStaffToTable();
        //Class to be user for finish object session
        $this->view->smsg         = $this->smsg;
        //

        //
        $this->view->render('header');
        $this->view->render('mngstaff/searchstaff');
        $this->view->render('footer');
    }

    /**
     * Prepare data to form edit.
     */
    public function viewstaff($staff_id) {
        $tools = new Tools();
        //
        $this->view->title = 'OSSB Solutions - Visualização de Colaboradores';
        $this->view->staff = $this->model->getStaffView($staff_id);
        //$obj = $this->model->getStaffView($staff_id);
        //
       /* print "<pre>";
          print_r($obj);
          print "</pre>";
          exit();*/
        
        $this->view->render('header');
        $this->view->render('mngstaff/viewstaff');
        $this->view->render('footer');
    }

    
    /**
     * Prepare data to form edit.
     */
    public function changestaff($staff_id) {
        $tools = new Tools();
        //
        $this->view->title = 'OSSB Solutions - Alteração para Status do Colaborador';
        $this->view->staff = $this->model->getStaffView($staff_id);
        //$obj = $this->model->getStaffView($staff_id);
        //
        $this->view->render('header');
        $this->view->render('mngstaff/changestaff');
        $this->view->render('footer');
    }    
    
    /**
     * Prepare data to form edit...
     */
    public function addstaff() {
        $cust  = new Mngcust_Model();
        $cpny  = new Mngcpny_Model();
        $job   = new Mngjob_Model();
        $local = new MngLocal_Model();      
        $dptm  = new MngDptm_Model();
        $tpacc = new MngTypeAccount_Model();
        $bank  = new MngBank_Model();
        
        //
        $tools = new Tools();
        // echo 'Bem vindo ao (addstaff mngstaff) de Colaboradores!!!';    
        $this->view->title = 'OSSB Solutions - Cadastro de Colaboradores';
        // exit();
        //Get next id to add
        $this->view->StaffPer        = $tools->getStaffPID();
        $this->view->CpnyList        = $cpny->getCpnyToCombobox();
        $this->view->CustList        = $cust->getCustomerToCombox();
        $this->view->JobTitleList    = $job->getJobTitleToCombobox();
        $this->view->LocalList       = $local->getLocalToCombobox();
        $this->view->DepartList      = $dptm->getDepartmentToCombobox();
        $this->view->TypeAccountList = $tpacc->getTypeAccountToCombobox();
        $this->view->BankList        = $bank->getBankToCombobox();
        //
        
        $this->view->render('header');
        $this->view->render('mngstaff/addstaff');
        $this->view->render('footer');
    }

    /**
     * Prepare data to form edit.
     */
    public function editstaff($staff_id) {
        $cust  = new Mngcust_Model();
        $cpny  = new Mngcpny_Model();
        $job   = new Mngjob_Model();
        $local = new MngLocal_Model();      
        $dptm  = new MngDptm_Model();
        $tpacc = new MngTypeAccount_Model();
        $bank  = new MngBank_Model();
        $tools = new Tools();
        //
        $this->view->title = 'OSSB Solutions - Alteração de Colaboradores';
        // exit();
        //Get next id to add
        $this->view->StaffPer        = $tools->getStaffPID();
        $this->view->CpnyList        = $cpny->getCpnyToCombobox();
        $this->view->CustList        = $cust->getCustomerToCombox();
        $this->view->JobTitleList    = $job->getJobTitleToCombobox();
        $this->view->LocalList       = $local->getLocalToCombobox();
        $this->view->DepartList      = $dptm->getDepartmentToCombobox();
        $this->view->TypeAccountList = $tpacc->getTypeAccountToCombobox();
        $this->view->BankList        = $bank->getBankToCombobox();
        
        $this->view->staff = $this->model->getStaff($staff_id);

        $this->view->render('header');
        $this->view->render('mngstaff/editstaff');
        $this->view->render('footer');
    }

    /**
     * Save data from form to database.
     */
    public function addSave() {
        //
        $tools = new Tools();
        //    
        $vstaff_id      = $tools->clean_int_input($_POST['staff_id']);
        $vperson_id     = $tools->clean_int_input($_POST['person_id']);
        $vcompany_id    = $tools->clean_int_input($_POST['company_id']);
        $vacronym       = $tools->clean_int_input($_POST['acronym']);
        $vstatus        = $tools->clean_input($_POST['status']);
        $vcustomer_id   = $tools->clean_int_input($_POST['customer_id']);
        $vjobtitle_id   = $tools->clean_int_input($_POST['jobtitle_id']);
        //
        $vname          = $tools->clean_input($_POST['name']);
        $vsurname       = $tools->clean_input($_POST['surname']);
        $vbirthdate     = $tools->clean_input_date($_POST['birthdate']);
        $vgender        = $tools->clean_input($_POST['gender']);
        $vnationality   = $tools->clean_input($_POST['nationality']);
        
        $vcountrystate  = '';
        if(isset($_POST['country_city_state']))
        $vcountrystate  = $tools->clean_input($_POST['country_city_state']);
        
        $vmaritalstate  = $tools->clean_input($_POST['maritalstate']);
        $vnaturality    = $tools->clean_input($_POST['naturality']);
        $vnaturality_state = $tools->clean_input($_POST['naturality_state']);
        $vblood_person  = $tools->clean_input($_POST['blood_person']);
        $vcolor_person  = $tools->clean_input($_POST['color_person']);
        $vfirstjob      = $tools->clean_input($_POST['firstjob']);

        $vspecial_nebe  = $tools->clean_input($_POST['special_nebe']);
        $vfathername    = $tools->clean_input($_POST['fathername']);
        $vmothername    = $tools->clean_input($_POST['mothername']);
      
        $vwifesname = '';
        if(isset($_POST['wifesname']))
        $vwifesname     = $tools->clean_input($_POST['wifesname']);
        
        $vnumcpf        = $tools->clean_int_input($_POST['numcpf']);
        $vnumrg         = $tools->clean_int_input($_POST['numrg']);
        $vorganissuer   = $tools->clean_input($_POST['organissuer']);
        $vdateofchip    = $tools->clean_input_date($_POST['dateofchip']);
       
        $vnumcrsm = '';
        if(isset($_POST['numcrsm']))
        $vnumcrsm       = $tools->clean_input($_POST['numcrsm']);
        
        $vctps          = $tools->clean_int_input($_POST['ctps']);
        $vctpsserie     = $tools->clean_int_input($_POST['ctpsserie']);
        $vdateofissue   = $tools->clean_input_date($_POST['dateofissue']);
        $vpispasep      = $tools->clean_int_input($_POST['pispasep']);
        $vyearlastcontb = $tools->clean_input_date($_POST['yearlastcontrib']);
        $vcertnascmaryd = $tools->clean_input($_POST['certnascmaryd']);
        $vnumcnh        = $tools->clean_int_input($_POST['numcnh']);
        $vcnhcat        = $tools->clean_input($_POST['cnhcat']);
        $vcnhdateexpire = $tools->clean_input_date($_POST['cnhdateexpire']);
        $vtitlevote     = $tools->clean_int_input($_POST['titlevotesec']);
        $vtitlevotesec  = $tools->clean_int_input($_POST['titlevotesec']);
        $vtitlevotezn   = $tools->clean_int_input($_POST['titlevotezn']);
        $vdateadm       = $tools->clean_input_date($_POST['dateadm']);
        $vdepartment_id = $tools->clean_int_input($_POST['department_id']);
        $vworkload      = $tools->clean_int_input($_POST['workload']);
        $vstarttime     = $tools->clean_int_input($_POST['starttime']);
        $vendtime       = $tools->clean_int_input($_POST['endtime']);
        $vsalary        = $tools->clean_int_input($_POST['salary']);
        $vtransportiket = $tools->clean_int_input($_POST['transpticket']);
        $vtransptkqt1   = $tools->clean_int_input($_POST['transptkqt1']);
        $vtransptkvl1   = $tools->clean_int_input($_POST['transptkvl1']);
        $vtransptkqt2   = $tools->clean_int_input($_POST['transptkqt2']);
        $vtransptkvl2   = $tools->clean_int_input($_POST['transptkvl2']);
        $vtransptkqt3   = $tools->clean_int_input($_POST['transptkqt3']);
        $vtransptkvl3   = $tools->clean_int_input($_POST['transptkvl3']);
        $vtypeaccount_id= $tools->clean_int_input($_POST['typeaccount_id']);
        $vbank_id       = $tools->clean_int_input($_POST['bank_id']);
        $voperation     = $tools->clean_int_input($_POST['operation']);
        $vagency        = $tools->clean_input($_POST['agency']);
        $vcurrentaccount= $tools->clean_input($_POST['currentaccount']);
        $vaccount_holder= $tools->clean_input($_POST['account_holder']);
        $vrefname       = $tools->clean_input($_POST['refname']);
        $vrefaddress    = $tools->clean_input($_POST['refaddress']);
        $vrefphone      = $tools->clean_int_input($_POST['refphone']);
        $vrefemail      = $tools->clean_input($_POST['refemail']);
        $veducation_id  = $tools->clean_int_input($_POST['education_id']);
        $vyearcompletion= $tools->clean_input_date($_POST['yearcompletion']);
        $vothereducation= $tools->clean_input($_POST['othereducation']);
        $vzipcode  = $tools->clean_input($_POST['zipcode']);
        $vzipid    = $tools->clean_int_input($_POST['zipid']);
        $vaddress  = $tools->clean_input($_POST['address']);
        $vaddr_number   = $tools->clean_int_input($_POST['addr_number']);
        $vaddr_comp     = $tools->clean_input($_POST['addr_comp']);
        $vaddr_dist     = $tools->clean_input($_POST['addr_dist']);
        $vaddr_city     = $tools->clean_input($_POST['addr_city']);
        $vaddr_state    = $tools->clean_input($_POST['addr_state']);       
        $vaddr_ref      = $tools->clean_input($_POST['addr_ref']);
        //        
        $vhome_phone    = $tools->clean_int_input($_POST['home_phone']);
        $vmobil_phone   = $tools->clean_int_input($_POST['mobil_phone']);
        $vnextel_phone  = $tools->clean_int_input($_POST['nextel_phone']);
        $vnextel_id     = $tools->clean_int_input($_POST['nextel_id']);
        $vmail          = $tools->clean_input($_POST['email']);
        $vcontact_phone = $tools->clean_int_input($_POST['contact_phone']);
        $vcontact_mobil = $tools->clean_int_input($_POST['contact_mobil']);  
        $vcontact_name  = $tools->clean_int_input($_POST['contact_name']);        
        $vcontact_msg   = $tools->clean_input($_POST['contact_msg']);
        $vstaff_msg     = $tools->clean_input($_POST['staff_msg']);

        //                     
        if (empty($vstaff_id) || empty($vperson_id) || empty($vcompany_id) ||
                empty($vacronym) || empty($vstatus) || empty($vcustomer_id) ||
                empty($vjobtitle_id) || empty($vname) || empty($vsurname) ||
                empty($vbirthdate) || empty($vgender) || empty($vnationality) ||
                empty($vmaritalstate) || empty($vnaturality) ||
                empty($vnaturality_state) || empty($vblood_person) || empty($vcolor_person) ||
                empty($vfirstjob) || empty($vspecial_nebe) || empty($vfathername) ||
                empty($vmothername) || empty($vnumcpf) || empty($vnumrg) || empty($vorganissuer) ||
                empty($vdateofchip) || empty($vctps) || empty($vctpsserie) || empty($vdateofissue) ||
                empty($vpispasep) || empty($vtitlevote) || empty($vtitlevotesec) ||
                empty($vtitlevotezn) || empty($vdateadm) || empty($vdepartment_id) || empty($vworkload) ||
                empty($vstarttime) || empty($vendtime) || empty($vsalary) ||
                empty($veducation_id) || empty($vzipcode) || 
                empty($vaddress) || empty($vaddr_dist) || empty($vaddr_city) ||
                empty($vaddr_state) || empty($vhome_phone)) {
            //

            $this->smsg->setApp('mngstaff');
            $this->smsg->setMsg('Erro: Campos obrigatórios devem ser preenchidos!!');
            $this->smsg->setInfo('warn');
            //
            $this->smsg->setSMsg();

            header('location: ' . URL . 'mngstaff/addstaff');
            exit;
        }

        $staff = new Staff();

        //Staff
        $staff->setStaff_id($vstaff_id);

        $staff->setPerson_id($vperson_id);
        $staff->setCompany_id($vcompany_id);
        //
        //$local = new Local();
        $local = $tools->getLocalIDToAcronym($vacronym);
        // $local_id = $local->getLocal_id();
        //
        $staff->setLocal_id($local->getLocal_id());
        //
        $staff->setStatus($vstatus);
        $staff->setCustomer_id($vcustomer_id);
        $staff->setJobtitle_id($vjobtitle_id);
        //Person
        //
        $vimagepath = "public/images/no_person.png";
        //
        $staff->setName($vname);
        $staff->setSurname($vsurname);
        $staff->setImagepath($vimagepath);
        $staff->setBirthdate($vbirthdate);
        $staff->setGender($vgender);
        $staff->setNationality($vnationality);
        $staff->setNaturality($vnaturality);
        $staff->setNaturality_state($vnaturality_state);
        $staff->setCountry_city_state($vcountrystate);
        $staff->setMarital_state($vmaritalstate);
        $staff->setBloodperson($vblood_person);
        $staff->setColorperson($vcolor_person);
        $staff->setFirstjob($vfirstjob);
        $staff->setSpecialnbearer($vspecial_nebe);
        $staff->setFathername($vfathername);
        $staff->setMothername($vmothername);
        $staff->setWifesname($vwifesname);
        
        //Docs
        $staff->setCpf($vnumcpf);
        $staff->setRg($vnumrg);
        $staff->setRg_organissuer($vorganissuer);
        $staff->setRg_dateofchip($vdateofchip);
        $staff->setCrsm($vnumcrsm);
        $staff->setCtps($vctps);
        $staff->setCtpsserie($vctpsserie);
        $staff->setCtps_dateofissuer($vdateofissue);
        $staff->setPispasep($vpispasep);
        $staff->setYearlastcontrib($vyearlastcontb);
        $staff->setBirthormary_certif($vcertnascmaryd);
        $staff->setCnh($vnumcnh);
        $staff->setCnh_cat($vcnhcat);
        $staff->setCnh_dateofexpire($vcnhdateexpire);
        $staff->setTitlevote($vtitlevote);
        $staff->setTitlevote_sec($vtitlevotesec);
        $staff->setTitlevote_zone($vtitlevotezn);
        
        //Admis
        $staff->setDate_admis($vdateadm);
        $staff->setDepartment_id($vdepartment_id);
        $staff->setWorkload($vworkload);
        $staff->setStarttime($vstarttime);
        $staff->setEndtime($vendtime);
        $staff->setSalary($vsalary);
        $staff->setTransp_ticket($vtransportiket);
        $staff->setTransptkqt1($vtransptkqt1);
        $staff->setTransptkvl1($vtransptkvl1);
        $staff->setTransptkqt2($vtransptkqt2);
        $staff->setTransptkvl2($vtransptkvl2);
        $staff->setTransptkqt3($vtransptkqt3);
        $staff->setTransptkvl3($vtransptkvl3);
        
        //Bank
        $staff->setTypeaccount_id($vtypeaccount_id);
        $staff->setBank_id($vbank_id);
        $staff->setOperation($voperation);
        $staff->setAgency($vagency);
        $staff->setAccount($vcurrentaccount);
        $staff->setAccount_holder($vaccount_holder);
       
        //Ref
        $staff->setRefname($vrefname);
        $staff->setRefaddress($vrefaddress);
        $staff->setRefphone($vrefphone);
        $staff->setRefemail($vrefemail);
        
        //Education
        $staff->setEducation_id($veducation_id);
        $staff->setYear_completion($vyearcompletion);
        $staff->setOthereducation($vothereducation);
        
        //AddrPerson
        $staff->setZipid($vzipid);
        $staff->setZipcode($vzipcode);
        $staff->setAddress($vaddress);
        $staff->setAddr_number($vaddr_number);
        $staff->setComplement($vaddr_comp);
        $staff->setDistrict($vaddr_dist);
        $staff->setCity($vaddr_city);
        $staff->setState($vaddr_state);
        $staff->setReference($vaddr_ref);
        
        //ContactPerson
        $staff->setEmail($vmail);
        $staff->setHome_phone($vhome_phone);
        $staff->setMobil_phone($vmobil_phone);
        $staff->setNextel_phone($vnextel_phone);
        $staff->setNextel_id($vnextel_id);
        $staff->setContact_phone($vcontact_phone);
        $staff->setContact_mobil($vcontact_mobil);
        $staff->setContact_name($vcontact_name);       
        $staff->setContact_msg($vcontact_msg);
        $staff->setStaff_msg($vstaff_msg);

        /**
         * Here!, Call modal method to add Staff.
         */
        $result = $this->model->createNewStaff($staff);
        //
        if (isset($result)) {
            $this->smsg->setApp('mngstaff');
            $this->smsg->setMsg("Erro na Inclusão: createNewStaff(): " . $result);
            $this->smsg->setInfo('error');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngstaff/addstaff');
            exit();
        } else {
            //
            $this->smsg->setApp('mgncust');
            $this->smsg->setMsg("Colaborador Cadastrado com Sucesso!");
            $this->smsg->setInfo('okay');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngstaff/index');
            exit();
        }
    }

    /**
     * Save data to form edit to database..
     * 
     * @param type $staff_id
     */
    public function editSave($staff_id) {
        //
        $tools = new Tools();
        //    
        $vperson_id     = $tools->clean_int_input($_POST['person_id']);
        $vcompany_id    = $tools->clean_int_input($_POST['company_id']);
        $vacronym       = $tools->clean_int_input($_POST['acronym']);
        $vstatus        = $tools->clean_input($_POST['status']);
        $vcustomer_id   = $tools->clean_int_input($_POST['customer_id']);
        $vjobtitle_id   = $tools->clean_int_input($_POST['jobtitle_id']);
        //
        $vname          = $tools->clean_input($_POST['name']);
        $vsurname       = $tools->clean_input($_POST['surname']);
        $vbirthdate     = $tools->clean_input_date($_POST['birthdate']);
        $vgender        = $tools->clean_input($_POST['gender']);
        $vnationality   = $tools->clean_input($_POST['nationality']);
        
        $vcountrystate  = '';
        if(isset($_POST['country_city_state']))
        $vcountrystate  = $tools->clean_input($_POST['country_city_state']);
        
        $vmaritalstate  = $tools->clean_input($_POST['maritalstate']);
        $vnaturality    = $tools->clean_input($_POST['naturality']);
        $vnaturality_state = $tools->clean_input($_POST['naturality_state']);
        $vblood_person  = $tools->clean_input($_POST['blood_person']);
        $vcolor_person  = $tools->clean_input($_POST['color_person']);
        $vfirstjob      = $tools->clean_input($_POST['firstjob']);

        $vspecial_nebe  = $tools->clean_input($_POST['special_nebe']);
        $vfathername    = $tools->clean_input($_POST['fathername']);
        $vmothername    = $tools->clean_input($_POST['mothername']);
      
        $vwifesname = '';
        if(isset($_POST['wifesname']))
        $vwifesname     = $tools->clean_input($_POST['wifesname']);
        
        $vnumcpf        = $tools->clean_int_input($_POST['numcpf']);
        $vnumrg         = $tools->clean_int_input($_POST['numrg']);
        $vorganissuer   = $tools->clean_input($_POST['organissuer']);
        $vdateofchip    = $tools->clean_input_date($_POST['dateofchip']);
       
        $vnumcrsm = '';
        if(isset($_POST['numcrsm']))
        $vnumcrsm       = $tools->clean_input($_POST['numcrsm']);
        
        $vctps          = $tools->clean_int_input($_POST['ctps']);
        $vctpsserie     = $tools->clean_int_input($_POST['ctpsserie']);
        $vdateofissue   = $tools->clean_input_date($_POST['dateofissue']);
        $vpispasep      = $tools->clean_int_input($_POST['pispasep']);
        $vyearlastcontb = $tools->clean_input_date($_POST['yearlastcontrib']);
        $vcertnascmaryd = $tools->clean_input($_POST['certnascmaryd']);
        $vnumcnh        = $tools->clean_int_input($_POST['numcnh']);
        $vcnhcat        = $tools->clean_input($_POST['cnhcat']);
        $vcnhdateexpire = $tools->clean_input_date($_POST['cnhdateexpire']);
        $vtitlevote     = $tools->clean_int_input($_POST['titlevotesec']);
        $vtitlevotesec  = $tools->clean_int_input($_POST['titlevotesec']);
        $vtitlevotezn   = $tools->clean_int_input($_POST['titlevotezn']);
        $vdateadm       = $tools->clean_input_date($_POST['dateadm']);
        $vdepartment_id = $tools->clean_int_input($_POST['department_id']);
        $vworkload      = $tools->clean_int_input($_POST['workload']);
        $vstarttime     = $tools->clean_int_input($_POST['starttime']);
        $vendtime       = $tools->clean_int_input($_POST['endtime']);
        $vsalary        = $tools->clean_int_input($_POST['salary']);
        $vtransportiket = $tools->clean_int_input($_POST['transpticket']);
        $vtransptkqt1   = $tools->clean_int_input($_POST['transptkqt1']);
        $vtransptkvl1   = $tools->clean_int_input($_POST['transptkvl1']);
        $vtransptkqt2   = $tools->clean_int_input($_POST['transptkqt2']);
        $vtransptkvl2   = $tools->clean_int_input($_POST['transptkvl2']);
        $vtransptkqt3   = $tools->clean_int_input($_POST['transptkqt3']);
        $vtransptkvl3   = $tools->clean_int_input($_POST['transptkvl3']);
        $vtypeaccount_id= $tools->clean_int_input($_POST['typeaccount_id']);
        $vbank_id       = $tools->clean_int_input($_POST['bank_id']);
        $voperation     = $tools->clean_int_input($_POST['operation']);
        $vagency        = $tools->clean_input($_POST['agency']);
        $vcurrentaccount= $tools->clean_input($_POST['currentaccount']);
        $vaccount_holder= $tools->clean_input($_POST['account_holder']);
        $vrefname       = $tools->clean_input($_POST['refname']);
        $vrefaddress    = $tools->clean_input($_POST['refaddress']);
        $vrefphone      = $tools->clean_int_input($_POST['refphone']);
        $vrefemail      = $tools->clean_input($_POST['refemail']);
        $veducation_id  = $tools->clean_int_input($_POST['education_id']);
        $vyearcompletion= $tools->clean_input_date($_POST['yearcompletion']);
        $vothereducation= $tools->clean_input($_POST['othereducation']);
        $vzipcode  = $tools->clean_input($_POST['zipcode']);
        $vzipid    = $tools->clean_int_input($_POST['zipid']);
        $vaddress  = $tools->clean_input($_POST['address']);
        $vaddr_number   = $tools->clean_int_input($_POST['addr_number']);
        $vaddr_comp     = $tools->clean_input($_POST['addr_comp']);
        $vaddr_dist     = $tools->clean_input($_POST['addr_dist']);
        $vaddr_city     = $tools->clean_input($_POST['addr_city']);
        $vaddr_state    = $tools->clean_input($_POST['addr_state']);       
        $vaddr_ref      = $tools->clean_input($_POST['addr_ref']);
        //        
        $vhome_phone    = $tools->clean_int_input($_POST['home_phone']);
        $vmobil_phone   = $tools->clean_int_input($_POST['mobil_phone']);
        $vnextel_phone  = $tools->clean_int_input($_POST['nextel_phone']);
        $vnextel_id     = $tools->clean_int_input($_POST['nextel_id']);
        $vmail          = $tools->clean_input($_POST['email']);
        $vcontact_phone = $tools->clean_int_input($_POST['contact_phone']);
        $vcontact_mobil = $tools->clean_int_input($_POST['contact_mobil']);  
        $vcontact_name  = $tools->clean_int_input($_POST['contact_name']);        
        $vcontact_msg   = $tools->clean_input($_POST['contact_msg']);
        $vstaff_msg     = $tools->clean_input($_POST['staff_msg']);

        //                     
        if (empty($staff_id) || empty($vperson_id) || empty($vcompany_id) ||
                empty($vacronym) || empty($vstatus) || empty($vcustomer_id) ||
                empty($vjobtitle_id) || empty($vname) || empty($vsurname) ||
                empty($vbirthdate) || empty($vgender) || empty($vnationality) ||
                empty($vmaritalstate) || empty($vnaturality) ||
                empty($vnaturality_state) || empty($vblood_person) || empty($vcolor_person) ||
                empty($vfirstjob) || empty($vspecial_nebe) || empty($vfathername) ||
                empty($vmothername) || empty($vnumcpf) || empty($vnumrg) || empty($vorganissuer) ||
                empty($vdateofchip) || empty($vctps) || empty($vctpsserie) || empty($vdateofissue) ||
                empty($vpispasep) || empty($vtitlevote) || empty($vtitlevotesec) ||
                empty($vtitlevotezn) || empty($vdateadm) || empty($vdepartment_id) || empty($vworkload) ||
                empty($vstarttime) || empty($vendtime) || empty($vsalary) ||
                empty($veducation_id) || empty($vzipcode) || 
                empty($vaddress) || empty($vaddr_dist) || empty($vaddr_city) ||
                empty($vaddr_state) || empty($vhome_phone)) {
            //

            $this->smsg->setApp('mngstaff');
            $this->smsg->setMsg('Erro: Campos obrigatórios devem ser preenchidos!!');
            $this->smsg->setInfo('warn');
            //
            $this->smsg->setSMsg();

            header('location: ' . URL . 'mngstaff');
            exit;
        }

        $staff = new Staff();

        //Staff
        $staff->setStaff_id($staff_id);

        $staff->setPerson_id($vperson_id);
        $staff->setCompany_id($vcompany_id);
        //
        //$local = new Local();
        $local = $tools->getLocalIDToAcronym($vacronym);
        // $local_id = $local->getLocal_id();
        //
        $staff->setLocal_id($local->getLocal_id());
        //
        $staff->setStatus($vstatus);
        $staff->setCustomer_id($vcustomer_id);
        $staff->setJobtitle_id($vjobtitle_id);
        //Person
        //
        $vimagepath = "public/images/no_person.png";
        //
        $staff->setName($vname);
        $staff->setSurname($vsurname);
        $staff->setImagepath($vimagepath);
        $staff->setBirthdate($vbirthdate);
        $staff->setGender($vgender);
        $staff->setNationality($vnationality);
        $staff->setNaturality($vnaturality);
        $staff->setNaturality_state($vnaturality_state);
        $staff->setCountry_city_state($vcountrystate);
        $staff->setMarital_state($vmaritalstate);
        $staff->setBloodperson($vblood_person);
        $staff->setColorperson($vcolor_person);
        $staff->setFirstjob($vfirstjob);
        $staff->setSpecialnbearer($vspecial_nebe);
        $staff->setFathername($vfathername);
        $staff->setMothername($vmothername);
        $staff->setWifesname($vwifesname);
        
        //Docs
        $staff->setCpf($vnumcpf);
        $staff->setRg($vnumrg);
        $staff->setRg_organissuer($vorganissuer);
        $staff->setRg_dateofchip($vdateofchip);
        $staff->setCrsm($vnumcrsm);
        $staff->setCtps($vctps);
        $staff->setCtpsserie($vctpsserie);
        $staff->setCtps_dateofissuer($vdateofissue);
        $staff->setPispasep($vpispasep);
        $staff->setYearlastcontrib($vyearlastcontb);
        $staff->setBirthormary_certif($vcertnascmaryd);
        $staff->setCnh($vnumcnh);
        $staff->setCnh_cat($vcnhcat);
        $staff->setCnh_dateofexpire($vcnhdateexpire);
        $staff->setTitlevote($vtitlevote);
        $staff->setTitlevote_sec($vtitlevotesec);
        $staff->setTitlevote_zone($vtitlevotezn);
        
        //Admis
        $staff->setDate_admis($vdateadm);
        $staff->setDepartment_id($vdepartment_id);
        $staff->setWorkload($vworkload);
        $staff->setStarttime($vstarttime);
        $staff->setEndtime($vendtime);
        $staff->setSalary($vsalary);
        $staff->setTransp_ticket($vtransportiket);
        $staff->setTransptkqt1($vtransptkqt1);
        $staff->setTransptkvl1($vtransptkvl1);
        $staff->setTransptkqt2($vtransptkqt2);
        $staff->setTransptkvl2($vtransptkvl2);
        $staff->setTransptkqt3($vtransptkqt3);
        $staff->setTransptkvl3($vtransptkvl3);
        
        //Bank
        $staff->setTypeaccount_id($vtypeaccount_id);
        $staff->setBank_id($vbank_id);
        $staff->setOperation($voperation);
        $staff->setAgency($vagency);
        $staff->setAccount($vcurrentaccount);
        $staff->setAccount_holder($vaccount_holder);
       
        //Ref
        $staff->setRefname($vrefname);
        $staff->setRefaddress($vrefaddress);
        $staff->setRefphone($vrefphone);
        $staff->setRefemail($vrefemail);
        
        //Education
        $staff->setEducation_id($veducation_id);
        $staff->setYear_completion($vyearcompletion);
        $staff->setOthereducation($vothereducation);
        
        //AddrPerson
        $staff->setZipid($vzipid);
        $staff->setZipcode($vzipcode);
        $staff->setAddress($vaddress);
        $staff->setAddr_number($vaddr_number);
        $staff->setComplement($vaddr_comp);
        $staff->setDistrict($vaddr_dist);
        $staff->setCity($vaddr_city);
        $staff->setState($vaddr_state);
        $staff->setReference($vaddr_ref);
        
        //ContactPerson
        $staff->setEmail($vmail);
        $staff->setHome_phone($vhome_phone);
        $staff->setMobil_phone($vmobil_phone);
        $staff->setNextel_phone($vnextel_phone);
        $staff->setNextel_id($vnextel_id);
        $staff->setContact_phone($vcontact_phone);
        $staff->setContact_mobil($vcontact_mobil);
        $staff->setContact_name($vcontact_name);       
        $staff->setContact_msg($vcontact_msg);
        $staff->setStaff_msg($vstaff_msg);

        /*
          print "<pre>";
          print_r($staff);
          print "</pre>";
          exit();
         */
        /**
         * Here!, Call modal method to add Staff.
         */
        $result = $this->model->updateNewStaff($staff);
        //
        if (isset($result)) {
            $this->smsg->setApp('mngstaff');
            $this->smsg->setMsg("Erro na Alteração: updateNewStaff(): " . $result);
            $this->smsg->setInfo('error');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngstaff/editstaff/'.$staff_id);
            exit();
        } else {
            //
            $this->smsg->setApp('mgncust');
            $this->smsg->setMsg("Colaborador Atualizado com Sucesso!");
            $this->smsg->setInfo('okay');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngstaff/index');
            exit();
        }
    }

    /**
     * Method to add new Cust Type 
     * for table.
     */
    public function addCTypeSave() {
       $ctype = new MngCustType_Model();
        //
        $tools = new Tools();
        //        
        $vlongname = $tools->clean_input($_POST['longname']);
        $vshortname = $tools->clean_input($_POST['shortname']);
        //
        $custtype = new CustType();
        //
        $custtype->setShortname($vshortname);
        $custtype->setLongname($vlongname);

        /**
         * Here!, Call the first method to add new 
         * custtype.
         */
        $result = $ctype->custTypeSave($custtype);
        //
        if (isset($result)) {
            $this->smsg->setApp('mngstaff');
            $this->smsg->setMsg("addCTypeSave(): " . $result);
            $this->smsg->setInfo('error');
            //
            echo json_encode($this->smsg->getMsg());
            //
        } else {
            //
            $this->smsg->setApp('mngstaff');
            $this->smsg->setMsg("Tipo de Cliente Cadastrado com Sucesso!");
            $this->smsg->setInfo('okay');
            //
            echo json_encode($this->smsg->getMsg());
            //
        }
        //        
    }

    /**
     * Method to add new Occupation Type 
     * for table.
     */
    public function addOCCTypeSave() {
        $occu = new Mngoccu_Model();
        //
        $tools = new Tools();
        //        
        $vlongname = $tools->clean_input($_POST['longname']);
        $vshortname = $tools->clean_input($_POST['shortname']);
        //
        $occutype = new Occupation();
        //
        $occutype->setShortname($vshortname);
        $occutype->setLongname($vlongname);

        /**
         * Here!, Call the first method to add new 
         * custtype.
         */
        $result = $occu->occuTypeSave($occutype);
        //
        if (isset($result)) {
            $this->smsg->setApp('mngstaff');
            $this->smsg->setMsg("addOCCTypeSave(): " . $result);
            $this->smsg->setInfo('error');
            //
            echo json_encode($this->smsg->getMsg());
            //
        } else {
            //
            $this->smsg->setApp('mngstaff');
            $this->smsg->setMsg("Área de Atuação Cadastrada com Sucesso!</br>");
            $this->smsg->setInfo('okay');
            //
            echo json_encode($this->smsg->getMsg());
            //
        }
        //        
    }

    /**
     * Make inactive staff selected from table. 
     * @param type $staff_id
     */
    public function InactStaff($staff_id) {
        //
        $tools = new Tools();
        $staff = new Staff();
        //
        $resig_date = $tools->clean_input_date($_POST['resignation_date']);
        //
        $staff->setStaff_id($staff_id);
        $staff->setStatus('I');
        $staff->setResignation_date($resig_date);
        //
        $result = $this->model->changeStatusStaff($staff);
        //print_r($msg);
        // exit();
        //
      //
        if (isset($result)) {
            $this->smsg->setApp('mngstaff');
            $this->smsg->setMsg("Erro na Alteração: InactStaff(): " . $result);
            $this->smsg->setInfo('error');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngstaff/changestaff/'.$staff_id);
            exit();
        } else {
            //
            $this->smsg->setApp('mgncust');
            $this->smsg->setMsg("Alteração Efetuada com Sucesso!");
            $this->smsg->setInfo('okay');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngstaff/viewstaff/'.$staff_id);
            exit();
        }
    }

    /**
     * Method to Search Name 
     * by ZipCode. 
     */
    public function findZip() {
        $zipcode = new MngZipCode_Model();
        //
        $tools = new Tools();
        //        
        $vzipcode = $tools->clean_input($_GET['zipcode']);
        // $vzipcode = $this->clean_input($_POST['zipcode']);
        $obj = $zipcode->getZipCode($vzipcode);
        //
        //return $obj;
        echo json_encode($obj);
    }

    
    /**
     * Method to Search All Staff
     * to informed name.
     */
    public function SearchByName() {
        $tools = new Tools();
        //
        $vcompany_id = $tools->clean_int_input($_POST['company_id']);
        $vacronym = $tools->clean_int_input($_POST['acronym']);
        $vstatus = $tools->clean_input($_POST['status']);
        $vcustomer_id = $tools->clean_int_input($_POST['customer_id']);
        $vjobtitle_id = $tools->clean_int_input($_POST['jobtitle_id']);
        //  
        $vname = $tools->clean_input($_POST['name']);
        $vsurname = $tools->clean_input($_POST['surname']);

        //$local = new Local();
        $local = $tools->getLocalIDToAcronym($vacronym);
        //
        $staff = new Staff();
        //
        $staff->setCompany_id($vcompany_id);
        $staff->setLocal_id($local->getLocal_id());
        $staff->setStatus($vstatus);
        $staff->setCustomer_id($vcustomer_id);
        $staff->setJobtitle_id($vjobtitle_id);
        $staff->setName($vname);
        $staff->setSurname($vsurname);
        //
        $type_option = $tools->getOptionToQuery($vcustomer_id, $vjobtitle_id);
        //
        $staff_list = $this->model->getAllStaffsByName($staff, $type_option);
        /*
        print '<pre>';
        print_r($staff_list);
        print '</pre>';
        exit();*/

        if (isset($staff_list)) {
            $this->ShowDataTable($staff_list);
        } else {
            $this->msg->setMsg("(Pesquisa por Nome): Colaborador não Encontrado para Dados Informados!!!");
            echo $this->msg->getMsgError();
        }
    }

    /**
     * Method to Search All Staff
     * to informed date off admission.
     */
    public function SearchByDateAdmis() {
        $tools = new Tools();
        //
        $vcompany_id = $tools->clean_int_input($_POST['company_id']);
        $vacronym = $tools->clean_int_input($_POST['acronym']);
        $vstatus = $tools->clean_input($_POST['status']);
        $vcustomer_id = $tools->clean_int_input($_POST['customer_id']);
        $vjobtitle_id = $tools->clean_int_input($_POST['jobtitle_id']);
        //  
        $vdateadm = $tools->clean_input($_POST['dateadm']);

        //$local = new Local();
        $local = $tools->getLocalIDToAcronym($vacronym);
        //
        $staff = new Staff();
        $staff->setCompany_id($vcompany_id);
        $staff->setLocal_id($local->getLocal_id());
        $staff->setStatus($vstatus);
        $staff->setCustomer_id($vcustomer_id);
        $staff->setJobtitle_id($vjobtitle_id);
        $staff->setDate_admis($vdateadm);
        //
        $type_option = $tools->getOptionToQuery($vcustomer_id, $vjobtitle_id);
        //
        $staff_list = $this->model->getAllStaffsByDateAdmis($staff, $type_option);

        if (isset($staff_list)) {
            $this->ShowDataTable($staff_list);
        } else {
            $this->msg->setMsg("(Pesquisa por Data de Admissão): Colaborador não Encontrado para Dados Informados!!!");
            echo $this->msg->getMsgError();
        }
    }

    /**
     * Method to Search All Staff
     * to informed Cpf.
     */
    public function SearchByCpf() {
        $tools = new Tools();
        //
        $vcompany_id = $tools->clean_int_input($_POST['company_id']);
        $vacronym = $tools->clean_int_input($_POST['acronym']);
        $vstatus = $tools->clean_input($_POST['status']);
        $vcustomer_id = $tools->clean_int_input($_POST['customer_id']);
        $vjobtitle_id = $tools->clean_int_input($_POST['jobtitle_id']);
        //  
        $vcpf = $tools->clean_int_input($_POST['numcpf']);

        //$local = new Local();
        $local = $tools->getLocalIDToAcronym($vacronym);
        //
        $staff = new Staff();
        $staff->setCompany_id($vcompany_id);
        $staff->setLocal_id($local->getLocal_id());
        $staff->setStatus($vstatus);
        $staff->setCustomer_id($vcustomer_id);
        $staff->setJobtitle_id($vjobtitle_id);
        $staff->setCpf($vcpf);
        //
        $type_option = $tools->getOptionToQuery($vcustomer_id, $vjobtitle_id);
        //        
        $staff_list = $this->model->getAllStaffsByCpf($staff, $type_option);

        if (isset($staff_list)) {
            $this->ShowDataTable($staff_list);
        } else {
            $this->msg->setMsg("(Pesquisa por CPF): Colaborador não Encontrado para Dados Informados!!!");
            echo $this->msg->getMsgError();
        }
    }

    /**
     * Method to Search All Staff
     * to informed RG.
     */
    public function SearchByRG() {
        $tools = new Tools();
        //
        $vcompany_id = $tools->clean_int_input($_POST['company_id']);
        $vacronym = $tools->clean_int_input($_POST['acronym']);
        $vstatus = $tools->clean_input($_POST['status']);
        $vcustomer_id = $tools->clean_int_input($_POST['customer_id']);
        $vjobtitle_id = $tools->clean_int_input($_POST['jobtitle_id']);
        //  
        $vrg = $tools->clean_int_input($_POST['numrg']);

        //$local = new Local();
        $local = $tools->getLocalIDToAcronym($vacronym);
        //
        $staff = new Staff();
        $staff->setCompany_id($vcompany_id);
        $staff->setLocal_id($local->getLocal_id());
        $staff->setStatus($vstatus);
        $staff->setCustomer_id($vcustomer_id);
        $staff->setJobtitle_id($vjobtitle_id);
        $staff->setRg($vrg);
        //
        $type_option = $tools->getOptionToQuery($vcustomer_id, $vjobtitle_id);

        $staff_list = $this->model->getAllStaffsByRG($staff, $type_option);

        if (isset($staff_list)) {
            $this->ShowDataTable($staff_list);
        } else {
            $this->msg->setMsg("(Pesquisa por RG): Colaborador não Encontrado para Dados Informados!!!");
            echo $this->msg->getMsgError();
        }
    }

    /**
     * Method to Show data Table
     * to Search List.
     * @param type $data_list
     */
    function ShowDataTable($data_list) {
        //
        echo '<div class="scroll-area" data-spy="scroll" data-offset="0">';
        echo '<table id = "TableSearch" cellspacing="0">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Nome</th>';
        echo '<th>Função</th>';
        echo '<th>Admissão</th>';
        echo '<th>Local</th>';
        echo '<th>Telefone</th>';
        echo '<th>Status</th>';
        echo '<th>Ações</th>';
        echo '<th>Ações</th>';
        echo '<th>Ações</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        //
        foreach ($data_list as $stf) {
            echo '<tr style="width: 1024px;">';
            echo '<td style="width: 250px;">';
            echo $stf->getName();
            echo '</td>';
            echo '<td style="width: 200px;">' . $stf->getLongname() . '</td>';
            echo '<td>';
            echo $stf->getDate_admis();
            echo '</td>';
            echo '<td>';
            echo $stf->getShortname();
            echo '</td>';
            echo '<td>';
            echo $stf->getHome_phone();
            echo '</td>';
            echo '<td>';
            echo $stf->getStatus() == 'A' ? "Ativo" : "Inativo";
            echo '</td>';
            echo "<td><a href='" . URL . 'mngstaff/editstaff/' . $stf->getStaff_id() . "'>Alterar</a></td>";
            echo "<td><a href='" . URL . 'mngstaff/viewstaff/' . $stf->getStaff_id() . "'>Exibir</a></td>";
            echo "<td><a  onclick='"; 
            if($stf->getStatus() == 'I') echo 'return false;';
            echo "' href='" . URL . 'mngstaff/changestaff/' . $stf->getStaff_id() . "'>Mudar Status</a></td>";
            echo '</tr>';
        }
        //
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        //
    }

    /**
     * Method to Upload File by
     * jQuery.
     */
    public function UploadFile() {
        $tools_img = new ToolsImage();
//
        $tools = new Tools();
//
        $vperson_id = $_POST['person_id'];
        $vname = $tools->clean_input($_POST['name']);
        $vsurname = $tools->clean_input($_POST['surname']);
        $vacronym = $_POST['acronym'];
        $vcustomer_id = $_POST['customer_id'];
        $vcompany_id = $_POST['company_id'];
//
        $customer = $tools->getCustomerToID($vcustomer_id);
        $vcust_alias = $customer->getAliasname();
//
        $company = $tools->getCompanyToID($vcompany_id);
        $vshortname = $tools->feel_str2($company->getShortname());


        $vnewacro = $tools->feel_str2($vacronym);
        $valiascust = $tools->feel_str2($vcust_alias);
        $image_name = $_FILES['image_file']['name']; //file name

        $home_path = "public/images/" . $vshortname . "/" . $vnewacro . "/" . $valiascust . '/';
        $imgname = $home_path . $image_name;

        $result = $tools_img->UploadImage($home_path);

//if enter, it because image was uploaded.
        if ($result) {
//
            $person = new Person();
//
            $mydate = date("Y-m-d H:m:s");
            $person->setPerson_id($vperson_id);
            $person->setName($vname);
            $person->setSurname($vsurname);
            $person->setImagepath($imgname);
            $person->setDate_create($mydate);
//                    //
            $result = $this->model->insertImageToDb($person);

            if (isset($result)) {
//
                $this->msg->setMsg("UploadFile(): " . $result);
                echo $this->msg->getMsgError();
//
            } else {
//
                $this->msg->setMsg("Processo Executado com Sucesso!!!</br>");
                echo $this->msg->getMsgSuccess();
//
            }
//
        } else {
//
            $this->msg->setMsg("UploadFile(): Não foi Possível enviar a Imagem!!!");
            echo $this->msg->getMsgError();
        }
    }

    /**
     * Method to Upload File Update by
     * jQuery.
     */
    public function UploadFileUpdate() {
        $tools_img = new ToolsImage();
        $tools = new Tools();

//
        $vperson_id = $_POST['person_id'];
        $vname = $tools->clean_input($_POST['name']);
        $vsurname = $tools->clean_input($_POST['surname']);
        $vlocal_id = $_POST['local_id'];
        $vcustomer_id = $_POST['customer_id'];
        $vcompany_id = $_POST['company_id'];
//
        $local = $tools->getLocalToID($vlocal_id);

        $customer = $tools->getCustomerToID($vcustomer_id);
        $vcust_alias = $customer->getAliasname();
//
        $company = $tools->getCompanyToID($vcompany_id);
        $vshortname = $tools->feel_str2($company->getShortname());
        $vnewacro = $tools->feel_str2($local->getAcronym());
        $valiascust = $tools->feel_str2($vcust_alias);

        $image_name = $tools->feel_str2($_FILES['image_file']['name']); //file name

        $home_path = "public/images/" . $vshortname . "/" . $vnewacro . "/" . $valiascust . '/';
//
        $imgname = $home_path . $image_name;

        $result = $tools_img->UploadImage($home_path);
//
        if ($result) {
//
            $person = new Person();
//
            $person->setPerson_id($vperson_id);
            $person->setImagepath($imgname);
//

            $result = $this->model->updateImageToDb($person);

            if (isset($result)) {
//
                $this->msg->setMsg("UploadFileUpdate(): " . $result);
                echo $this->msg->getMsgError();
//
            } else {
//
                $this->msg->setMsg("Processo Executado com Sucesso!!!</br>");
                echo $this->msg->getMsgSuccess();
//
            }
//
        } else {
//
            $this->msg->setMsg("UploadFileUpdate(): Não foi Possível enviar a Imagem!!!");
            echo $this->msg->getMsgError();
        }
    }

    /**
     * Method to Upload File by
     * jQuery.
     */
    public function UpdateCropImg($person_id) {
        $tools_img = new ToolsImage();
//
        $result = $tools_img->UpdateImagem($person_id);
//
        if (isset($result)) {
//
            $this->msg->setMsg("UpdateCropImg(): " . $result);
            echo $this->msg->getMsgError();
//
        } else {
//
            $this->msg->setMsg("Alteração Executada com Sucesso!!!</br>");
            echo $this->msg->getMsgSuccess();
//
        }
    }

    /**
     * Method to get person to person_id
     * @param type $person_id
     */
    public function getStaffPhoto($person_id) {
//
        $person = $this->model->getStaffPhoto($person_id);
//
        echo json_encode($person);
    }

}
