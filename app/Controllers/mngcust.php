<?php

require_once 'models/Msg.php';
require_once 'util/Tools.php';
require_once 'models/SMsg.php';
require_once 'models/Customer.php';
require_once 'models/Company.php';
require_once 'models/CustType.php';
require_once 'models/Occupation.php';
require_once 'models/PostalCode.php';
require_once 'models/mngcpny_model.php';
require_once 'models/mngoccu_model.php';
require_once 'models/mngcusttype_model.php';
require_once 'models/mngzipcode_model.php';



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mngcust
 *
 * @author sistema
 */
class Mngcust extends Controller {

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
        $this->view->title = 'OSSB Solutions - Cadastro de Clientes';
        $this->view->CustList = $this->model->getCustomerToTable();
        $this->view->smsg = $this->smsg;
        //
        $this->view->render('header');
        $this->view->render('mngcust/index');
        $this->view->render('footer');
    }

    /**
     * Prepare data to form edit...
     */
    public function addcust() {
        $cpny = new Mngcpny_Model();
        $ctype = new MngCustType_Model();
        $occu  = new Mngoccu_Model();
        //
        $this->view->title = 'OSSB Solutions - Cadastro de Clientes';
        //Get next id to add
        $this->view->CustID       = $this->model->getNextIDToAdd();
        $this->view->CpnyList     = $cpny->getCpnyToCombobox();
        $this->view->CustTypeList = $ctype->getCustTypeToCombobox();
        $this->view->OCCuTypeList = $occu->getOCCuTypeToCombobox();
        //
        $this->view->render('header');
        $this->view->render('mngcust/addcust');
        $this->view->render('footer');
    }

    /**
     * Save data from form to database.
     */
    public function addSave() {
        //
        $tools = new Tools();
        //    
        $vid = $tools->clean_int_input($_POST['nextid']);
        $vcompany_id = $tools->clean_int_input($_POST['company_id']);
        $vcusttype_id = $tools->clean_int_input($_POST['custtype_id']);
        $vcustoccutype_id = $tools->clean_int_input($_POST['custoccutype_id']);
        $vnat_indcorp = $tools->clean_input($_POST['nature_indcorp']);
        $vgender = $tools->clean_input($_POST['gender']);
        //
        $vcorpname = $tools->clean_input($_POST['corpname']);
        $vlongname = $tools->clean_input($_POST['longname']);
        $valiasname = $tools->clean_input($_POST['aliasname']);
        $vshorname = $tools->clean_input($_POST['shortname']);
        $vnumcnpj = $tools->clean_int_input($_POST['numcnpj']);
        $vnumcpf = $tools->clean_int_input($_POST['numcpf']);
        $vnumie = $tools->clean_int_input($_POST['numie']);
        $vnumrg = $tools->clean_int_input($_POST['numrg']);


        //Commercial
        $vcommercial_contact_name = $tools->clean_input($_POST['commercial_contact_name']);
        $vcomm_business_phone = $tools->clean_int_input($_POST['comm_business_phone']);
        $vcomm_mobil_phone = $tools->clean_int_input($_POST['comm_mobil_phone']);
        $vcomm_nextel_phone = $tools->clean_int_input($_POST['comm_nextel_phone']);
        $vcomm_nextel_id = $tools->clean_int_input($_POST['comm_nextel_id']);
        $vcomm_fax_phone = $tools->clean_int_input($_POST['comm_fax_phone']);
        $vcomm_email = $tools->clean_input($_POST['comm_email']);
        $vcomm_webpage = $tools->clean_input($_POST['comm_webpage']);
        $vcomm_note = $tools->clean_input($_POST['comm_note']);
        //
        //Invoice
        $vinvoice_contact_name = $tools->clean_input($_POST['invoice_contact_name']);
        $vinv_business_phone = $tools->clean_int_input($_POST['inv_business_phone']);
        $vinv_mobil_phone = $tools->clean_int_input($_POST['inv_mobil_phone']);
        $vinv_nextel_phone = $tools->clean_int_input($_POST['inv_nextel_phone']);
        $vinv_nextel_id = $tools->clean_int_input($_POST['inv_nextel_id']);
        $vinv_fax_phone = $tools->clean_int_input($_POST['inv_fax_phone']);
        $vinv_email = $tools->clean_input($_POST['inv_email']);
        $vinv_note = $tools->clean_input($_POST['inv_note']);
        //

        $vcondtcust = $tools->clean_input($_POST['condtcust']);
        $vstatus = $tools->clean_input($_POST['status']);
        $vcustnote = $tools->clean_input($_POST['note']);

        //
        //If nature corp not null, enter to get your type.
        if (!empty($vnat_indcorp)) {
            //
            if (empty($vid) || empty($vcompany_id) || empty($vcusttype_id) ||
                    empty($vgender) || empty($vcondtcust) || empty($vstatus) ||
                    empty($vcorpname) || empty($valiasname) ||
                    empty($vnumcnpj)) {
                //
                $this->smsg->setApp('mngcust');
                $this->smsg->setMsg('Erro: Campos obrigatórios devem ser preenchidos!!');
                $this->smsg->setInfo('warn');
                //
                $this->smsg->setSMsg();

                header('location: ' . URL . 'mngcust/addcust');
                exit;
            }
        } else {
            //
            $this->smsg->setApp('mngcust');
            $this->smsg->setMsg('Erro: Natureza Física ou Jurídica deve ser Selecionada!!');
            $this->smsg->setInfo('warn');
            //
            $this->smsg->setSMsg();

            header('location: ' . URL . 'mngcust');
            exit;
        }
        //
        $vcomm_addr_id = $tools->clean_input($_POST['comm_addr_id']);
        $vcomm_addr_zip = $tools->clean_input($_POST['comm_addr_zip']);
        $vcomm_address = $tools->clean_input($_POST['comm_address']);
        $vcomm_addr_number = $tools->clean_input($_POST['comm_addr_number']);
        $vcomm_addr_comp = $tools->clean_input($_POST['comm_addr_comp']);
        $vcomm_addr_dist = $tools->clean_input($_POST['comm_addr_dist']);
        $vcomm_addr_city = $tools->clean_input($_POST['comm_addr_city']);
        $vcomm_addr_state = $tools->clean_input($_POST['comm_addr_state']);
        $vcomm_addr_ref = $tools->clean_input($_POST['comm_addr_ref']);
        //
        $vinv_addr_id = $tools->clean_input($_POST['inv_addr_id']);
        $vinv_addr_zip = $tools->clean_input($_POST['inv_addr_zip']);
        $vinv_address = $tools->clean_input($_POST['inv_address']);
        $vinv_addr_number = $tools->clean_input($_POST['inv_addr_number']);
        $vinv_addr_comp = $tools->clean_input($_POST['inv_addr_comp']);
        $vinv_addr_dist = $tools->clean_input($_POST['inv_addr_dist']);
        $vinv_addr_city = $tools->clean_input($_POST['inv_addr_city']);
        $vinv_addr_state = $tools->clean_input($_POST['inv_addr_state']);
        $vinv_addr_ref = $tools->clean_input($_POST['inv_addr_ref']);
        //
        $cust = new Customer();
        //       
        $cust->setCustomer_id($vid); //Set Next ID for Customer
        $cust->setOccupation_id($vcustoccutype_id);
        $cust->setGender($vgender); // Customer Gender Male or Female    
        $cust->setDate_create($cust->getDate_create());

        /**
         * Used to Set Customer Details
         */
        if ($vnat_indcorp === 'F') {
            //set data for CustCorpDetails
            $cust->setCorpname($vlongname); //For Long Name
            $cust->setAliasname($vshorname); //For Short Name
            $cust->setCnpj($vnumcpf); //For Customer CPF
            $cust->setIe($vnumrg); //For Customer RG
        } else {
            //set data for CustCorpDetails
            $cust->setCorpname($vcorpname); //For Corporante Name
            $cust->setAliasname($valiasname); //For Corporate Short Name
            $cust->setCnpj($vnumcnpj); //For Customer CNPJ
            $cust->setIe($vnumie); //For Customer I.E.
        }

        //Contact Commercial
        $cust->setCommercial_contact_name($vcommercial_contact_name);
        $cust->setComm_business_phone($vcomm_business_phone); //For Business phone Contact Customer
        $cust->setComm_mobil_phone($vcomm_mobil_phone); //For Cel Phine Contact Customer
        $cust->setComm_nextel_phone($vcomm_nextel_phone); //For Nextel Phone Contact Customer
        $cust->setComm_nextel_id($vcomm_nextel_id); //For Nextel ID Customer Contact
        $cust->setComm_fax_phone($vcomm_fax_phone); //For Fax Contact Customer
        $cust->setComm_email($vcomm_email); //For E-mail Contact Customer
        $cust->setComm_webpage($vcomm_webpage); //For Webpager Contact Customer   
        $cust->setComm_note($vcomm_note);
        //
        //Contact Invoice
        $cust->setInvoice_contact_name($vinvoice_contact_name);
        $cust->setInv_business_phone($vinv_business_phone); //For Business phone Contact Customer
        $cust->setInv_mobil_phone($vinv_mobil_phone); //For Cel Phine Contact Customer
        $cust->setInv_nextel_phone($vinv_nextel_phone); //For Nextel Phone Contact Customer
        $cust->setInv_nextel_id($vinv_nextel_id); //For Nextel ID Customer Contact
        $cust->setInv_fax_phone($vinv_fax_phone); //For Fax Contact Customer
        $cust->setInv_email($vinv_email); //For E-mail Contact Customer
        $cust->setInv_note($vinv_note);

        //
        $cust->setCompany_id($vcompany_id); //Set Company for Customer     
        //


    
        //Commercial Address
        $cust->setComm_addr_id($vcomm_addr_id); //ID for commercial address
        $cust->setComm_addr_zip($vcomm_addr_zip); //Postal Code for commercial address
        $cust->setComm_address($vcomm_address); //Commercial Street Address
        $cust->setComm_addr_number($vcomm_addr_number); //Commercial Addr Number
        $cust->setComm_addr_comp($vcomm_addr_comp); //Commercial addr complement
        $cust->setComm_addr_dist($vcomm_addr_dist); //Commercial District Address
        $cust->setComm_addr_ref($vcomm_addr_ref); //Commercial Reference Address         
        $cust->setComm_addr_city($vcomm_addr_city); //Commercial City Address
        $cust->setComm_addr_state($vcomm_addr_state); //Commercial State Address
        //
        //Invoice Address
        $cust->setInv_addr_id($vinv_addr_id); //ID for Invoice address
        $cust->setInv_addr_zip($vinv_addr_zip); //Postal Code for invoice address
        $cust->setInv_address($vinv_address); //Invoice Street Address
        $cust->setInv_addr_number($vinv_addr_number); //Invoice Addr Number
        $cust->setInv_addr_comp($vinv_addr_comp); //Invoice addr complement
        $cust->setInv_addr_dist($vinv_addr_dist); //Invoice District Address
        $cust->setInv_addr_ref($vinv_addr_ref); //Invoice Reference Address         
        $cust->setInv_addr_city($vinv_addr_city); //Invoice City Address
        $cust->setInv_addr_state($vinv_addr_state); //Invoice State Address
        //
        //
        $cust->setCusttype_id($vcusttype_id); //Set CustType for Customer
        //
        $cust->setCondtcust($vcondtcust); //Condiction Financial, Good, Bad or Regular
        $cust->setNature_indcorp($vnat_indcorp); //For Nature Corporate or Individual 
        $cust->setStatus($vstatus); //For Status for Customer, Active or Inactive
        $cust->setNote($vcustnote);

        /*
          print "<pre>";
          print_r($cust);
          print "</pre>";
          exit();
         */
        /**
         * Here!, Call model method to add Customer.
         */
        $result = $this->model->createNewCust($cust);
        //
        if (isset($result)) {
            $this->smsg->setApp('mngcust');
            $this->smsg->setMsg("Erro na Inclusão: createNewCust(): " . $result);
            $this->smsg->setInfo('error');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngcust/addcust');
            exit();
        } else {
            //
            $this->smsg->setApp('mngcust');
            $this->smsg->setMsg("Cliente Cadastrado com Sucesso!");
            $this->smsg->setInfo('okay');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngcust/index');
            exit();
        }
    }

    /**
     * Method to add new Cust Type 
     * for table.
     */
    public function addCTypeSave() {
        //
        $ctype = new MngCustType_Model();
        $tools = new Tools();

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
            $this->msg->setMsg("addCTypeSave(): " . $result);
            echo $this->msg->getMsgError();
        } else {
            $this->msg->setMsg('Tipo de Cliente Cadastrado com Sucesso!!!');
            echo $this->msg->getMsgSuccess();
        }
    }

    /**
     * Metho to get all custtype to populate 
     * combo box when was added.
     */
    public function updateCustType() {
        $ctype = new MngCustType_Model();
        //
        $allcusttype = $ctype->getCustTypeToCombobox();

        if (isset($allcusttype)) {
            //
            echo '<label for="ComboCustType">Tipo de Cliente:</label>';
            echo '<select name="custtype_id" class="form-control text-center"style=" width: 360px;" >';
            //
            foreach ($allcusttype as $ctype) {
                echo '<option value="';
                echo $ctype->getCusttype_id();
                echo '">';
                echo $ctype->getShortname();
                echo '</option>';
            }
            //
            echo '</select>';
        }
    }

    /**
     * Method to add new Occupation Type 
     * for table.
     */
    public function addOCCTypeSave() {
        $occu = new Mngoccu_Model();
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
            $this->msg->setMsg("addOCCTypeSave(): " . $result);
            echo $this->msg->getMsgError();
        } else {
            $this->msg->setMsg('Área de Atuação Cadastrada com Sucesso!');
            echo $this->msg->getMsgSuccess();
        }

        //        
    }

    /**
     * Metho to get all oocutype to populate 
     * combo box when was added.
     */
    public function updateOCCType() {
        $occu = new Mngoccu_Model();
        //
        $alloccutype = $occu->getOCCuTypeToCombobox();

        if (isset($alloccutype)) {
            echo '<label for="ComboOccuType">Área de Atuação:</label>';
            echo '<select name="custoccutype_id" class="form-control text-center" style=" width: 360px;">';
            //
            foreach ($alloccutype as $octype) {
                echo '<option value="';
                echo $octype->getOccupation_id();
                echo '">';
                echo $octype->getShortname();
                echo '</option>';
            }
            //
            echo '</select>';
        }
    }

    /**
     * Prepare data to form edit.
     */
    public function editcust($vcust_id) {
        //
        $cpny = new Mngcpny_Model();
        $occu = new Mngoccu_Model();
        $ctype = new MngCustType_Model();

        $tools = new Tools();
        // 
        $this->view->title = 'OSSB Solutions - Alteração de Clientes';
        //
        $this->view->CpnyList     = $cpny->getCpnyToCombobox();
        $this->view->CustTypeList = $ctype->getCustTypeToCombobox();
        $this->view->OCCuTypeList = $occu->getOCCuTypeToCombobox();

        $this->view->cust = $this->model->getCust($vcust_id);

        $this->view->render('header');
        $this->view->render('mngcust/editcust');
        $this->view->render('footer');
    }

    /**
     * Save data to form edit to database..
     * 
     * @param type $cust_id
     */
    public function editSave($cust_id) {
        //
        $tools = new Tools();
        //    
        $vcompany_id = $tools->clean_int_input($_POST['company_id']);
        $vcusttype_id = $tools->clean_int_input($_POST['custtype_id']);
        $vcustoccutype_id = $tools->clean_int_input($_POST['custoccutype_id']);
        $vnat_indcorp = $tools->clean_input($_POST['nature_indcorp']);
        //
        $valiasname = $tools->clean_input($_POST['aliasname']);
        $vshorname = $tools->clean_input($_POST['shortname']);
        $vnumcnpj = $tools->clean_int_input($_POST['numcnpj']);
        $vnumcpf = $tools->clean_int_input($_POST['numcpf']);
        $vnumie = $tools->clean_int_input($_POST['numie']);
        $vnumrg = $tools->clean_int_input($_POST['numrg']);


        //Commercial
        $vcommercial_contact_name = $tools->clean_input($_POST['commercial_contact_name']);
        $vcomm_business_phone = $tools->clean_int_input($_POST['comm_business_phone']);
        $vcomm_mobil_phone = $tools->clean_int_input($_POST['comm_mobil_phone']);
        $vcomm_nextel_phone = $tools->clean_int_input($_POST['comm_nextel_phone']);
        $vcomm_nextel_id = $tools->clean_int_input($_POST['comm_nextel_id']);
        $vcomm_fax_phone = $tools->clean_int_input($_POST['comm_fax_phone']);
        $vcomm_email = $tools->clean_input($_POST['comm_email']);
        $vcomm_webpage = $tools->clean_input($_POST['comm_webpage']);
        $vcomm_note = $tools->clean_input($_POST['comm_note']);
        //
        //Invoice
        $vinvoice_contact_name = $tools->clean_input($_POST['invoice_contact_name']);
        $vinv_business_phone = $tools->clean_int_input($_POST['inv_business_phone']);
        $vinv_mobil_phone = $tools->clean_int_input($_POST['inv_mobil_phone']);
        $vinv_nextel_phone = $tools->clean_int_input($_POST['inv_nextel_phone']);
        $vinv_nextel_id = $tools->clean_int_input($_POST['inv_nextel_id']);
        $vinv_fax_phone = $tools->clean_int_input($_POST['inv_fax_phone']);
        $vinv_email = $tools->clean_input($_POST['inv_email']);
        $vinv_note = $tools->clean_input($_POST['inv_note']);
        //

        $vcondtcust = $tools->clean_input($_POST['condtcust']);
        $vstatus = $tools->clean_input($_POST['status']);
        $vcustnote = $tools->clean_input($_POST['note']);

        //
        //If nature corp not null, enter to get your type.
        //
            if (empty($vcompany_id) || empty($vcusttype_id) ||
                empty($vcondtcust) || empty($vstatus) ||
                empty($valiasname)) {
            //
            $this->smsg->setApp('mngcust');
            $this->smsg->setMsg('Erro: Campos obrigatórios devem ser preenchidos!!');
            $this->smsg->setInfo('warn');
            //
            $this->smsg->setSMsg();

            header('location: ' . URL . 'mngcust/editcust/' . $cust_id);
            exit;
        }
        //
        $vcomm_addr_id = $tools->clean_input($_POST['comm_addr_id']);
        $vcomm_addr_zip = $tools->clean_input($_POST['comm_addr_zip']);
        $vcomm_address = $tools->clean_input($_POST['comm_address']);
        $vcomm_addr_number = $tools->clean_input($_POST['comm_addr_number']);
        $vcomm_addr_comp = $tools->clean_input($_POST['comm_addr_comp']);
        $vcomm_addr_dist = $tools->clean_input($_POST['comm_addr_dist']);
        $vcomm_addr_city = $tools->clean_input($_POST['comm_addr_city']);
        $vcomm_addr_state = $tools->clean_input($_POST['comm_addr_state']);
        $vcomm_addr_ref = $tools->clean_input($_POST['comm_addr_ref']);
        //
        $vinv_addr_id = $tools->clean_input($_POST['inv_addr_id']);
        $vinv_addr_zip = $tools->clean_input($_POST['inv_addr_zip']);
        $vinv_address = $tools->clean_input($_POST['inv_address']);
        $vinv_addr_number = $tools->clean_input($_POST['inv_addr_number']);
        $vinv_addr_comp = $tools->clean_input($_POST['inv_addr_comp']);
        $vinv_addr_dist = $tools->clean_input($_POST['inv_addr_dist']);
        $vinv_addr_city = $tools->clean_input($_POST['inv_addr_city']);
        $vinv_addr_state = $tools->clean_input($_POST['inv_addr_state']);
        $vinv_addr_ref = $tools->clean_input($_POST['inv_addr_ref']);
        //
        $cust = new Customer();
        //       
        $cust->setCustomer_id($cust_id); //Set Next ID for Customer
        $cust->setOccupation_id($vcustoccutype_id);
        $cust->setDate_create($cust->getDate_create());
        /**
         * Used to Set Customer Details
         */
        if ($vnat_indcorp === 'F') {
            //set data for CustCorpDetails
            $cust->setAliasname($vshorname); //For Short Name
            $cust->setCnpj($vnumcpf); //For Customer CPF
            $cust->setIe($vnumrg); //For Customer RG
        } else {
            //set data for CustCorpDetails
            $cust->setAliasname($valiasname); //For Corporate Short Name
            $cust->setCnpj($vnumcnpj); //For Customer CNPJ
            $cust->setIe($vnumie); //For Customer I.E.
        }

        //Contact Commercial
        $cust->setCommercial_contact_name($vcommercial_contact_name);
        $cust->setComm_business_phone($vcomm_business_phone); //For Business phone Contact Customer
        $cust->setComm_mobil_phone($vcomm_mobil_phone); //For Cel Phine Contact Customer
        $cust->setComm_nextel_phone($vcomm_nextel_phone); //For Nextel Phone Contact Customer
        $cust->setComm_nextel_id($vcomm_nextel_id); //For Nextel ID Customer Contact
        $cust->setComm_fax_phone($vcomm_fax_phone); //For Fax Contact Customer
        $cust->setComm_email($vcomm_email); //For E-mail Contact Customer
        $cust->setComm_webpage($vcomm_webpage); //For Webpager Contact Customer   
        $cust->setComm_note($vcomm_note);
        //
        //Contact Invoice
        $cust->setInvoice_contact_name($vinvoice_contact_name);
        $cust->setInv_business_phone($vinv_business_phone); //For Business phone Contact Customer
        $cust->setInv_mobil_phone($vinv_mobil_phone); //For Cel Phine Contact Customer
        $cust->setInv_nextel_phone($vinv_nextel_phone); //For Nextel Phone Contact Customer
        $cust->setInv_nextel_id($vinv_nextel_id); //For Nextel ID Customer Contact
        $cust->setInv_fax_phone($vinv_fax_phone); //For Fax Contact Customer
        $cust->setInv_email($vinv_email); //For E-mail Contact Customer
        $cust->setInv_note($vinv_note);

        //
        $cust->setCompany_id($vcompany_id); //Set Company for Customer     
        //
       
        //Commercial Address
        $cust->setComm_addr_id($vcomm_addr_id); //ID for commercial address
        $cust->setComm_addr_zip($vcomm_addr_zip); //Postal Code for commercial address
        $cust->setComm_address($vcomm_address); //Commercial Street Address
        $cust->setComm_addr_number($vcomm_addr_number); //Commercial Addr Number
        $cust->setComm_addr_comp($vcomm_addr_comp); //Commercial addr complement
        $cust->setComm_addr_dist($vcomm_addr_dist); //Commercial District Address
        $cust->setComm_addr_ref($vcomm_addr_ref); //Commercial Reference Address         
        $cust->setComm_addr_city($vcomm_addr_city); //Commercial City Address
        $cust->setComm_addr_state($vcomm_addr_state); //Commercial State Address
        //
        //Invoice Address
        $cust->setInv_addr_id($vinv_addr_id); //ID for Invoice address
        $cust->setInv_addr_zip($vinv_addr_zip); //Postal Code for invoice address
        $cust->setInv_address($vinv_address); //Invoice Street Address
        $cust->setInv_addr_number($vinv_addr_number); //Invoice Addr Number
        $cust->setInv_addr_comp($vinv_addr_comp); //Invoice addr complement
        $cust->setInv_addr_dist($vinv_addr_dist); //Invoice District Address
        $cust->setInv_addr_ref($vinv_addr_ref); //Invoice Reference Address         
        $cust->setInv_addr_city($vinv_addr_city); //Invoice City Address
        $cust->setInv_addr_state($vinv_addr_state); //Invoice State Address
        //
        //
        $cust->setCusttype_id($vcusttype_id); //Set CustType for Customer
        //
        $cust->setCondtcust($vcondtcust); //Condiction Financial, Good, Bad or Regular
        $cust->setNature_indcorp($vnat_indcorp); //For Nature Corporate or Individual 
        $cust->setStatus($vstatus); //For Status for Customer, Active or Inactive
        $cust->setNote($vcustnote);

        /*
          print "<pre>";
          print_r($cust);
          print "</pre>";
          exit();
         */
        
        /**
         * Here!, Call model method to add Customer.
         */
        $result = $this->model->updateCust($cust);
        //
        if (isset($result)) {
            $this->smsg->setApp('mngcust');
            $this->smsg->setMsg("Erro na Alteração: updateCust(): " . $result);
            $this->smsg->setInfo('error');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngcust/editcust/' . $cust_id);
            exit();
        } else {
            //
            $this->smsg->setApp('mngcust');
            $this->smsg->setMsg("Cliente Alterado com Sucesso!");
            $this->smsg->setInfo('okay');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngcust/index');
            exit();
        }
    }

    /**
     * Delete customer selected from table, in case 
     * where it's not has staffs.
     * @param type $cust_id
     */
    public function removeCust($cust_id) {
        //
        $msg = $this->model->removeCust($cust_id);
        //print_r($msg);
        // exit();
        //
        if ($msg->getStatusError() === 0) {
            //
            $this->smsg->setApp('mngcust');
            $this->smsg->setMsg("deleteCust(): " . $this->msg->getMsg());
            $this->smsg->setInfo('error');
            //
            $this->smsg->setSMsg();
            //
            header('location: ' . URL . 'mngcust/index');
            exit();
        } else {
            //
            $this->smsg->setApp('mngcust');
            $this->smsg->setMsg("Cliente Removido com Sucesso!!!");
            $this->smsg->setInfo('okay');
            //
            $this->smsg->setSMsg();
            //            
            header('location: ' . URL . 'mngcust/index');
            exit();
        }
    }

    /**
     * Method to add new zip code to
     * database table.
     */
    public function addNewZipCode() {
        $tools = new Tools();
        $postal = new PostalCode();
        $pmodel = new MngZipCode_Model();
        //
        $vaddr_zip = $tools->clean_input($_POST['addrzip']);
        $vaddress = $tools->clean_input($_POST['address']);
        $vaddr_comp = $tools->clean_input($_POST['addrcomp']);
        $vaddr_dist = $tools->clean_input($_POST['addrdist']);
        $vaddr_city = $tools->clean_input($_POST['addrcity']);
        $vaddr_state = $tools->clean_input($_POST['addrstate']);
        //
        $postal->setCountry('Brasil');
        $postal->setPostalcode($vaddr_zip);
        $postal->setStreet($vaddress);
        $postal->setComplement($vaddr_comp);
        $postal->setDistrict($vaddr_dist);
        $postal->setCity($vaddr_city);
        $postal->setState($vaddr_state);
        //  
        $result = $pmodel->addZipCode($postal);
        //
        if (isset($result)) {
            $this->msg->setMsg("(Cadastro de Cep: addNewZipCode()), Erro: " . $result);
            echo $this->msg->getMsgError();
        } else {
            $this->msg->setMsg("Cep Cadastrado com Sucesso!!!");
            echo $this->msg->getMsgSuccess();
        }
    }

    public function findZip() {
        $pmodel = new MngZipCode_Model();
//
        $tools = new Tools();
        //
        $vzipcode = $tools->clean_input($_GET['zipcode']);
        // $vzipcode =  $tools->clean_input($_POST['zipcode']);
        $obj = $pmodel->getZipCode($vzipcode);
        //
        //return $obj;
        echo json_encode($obj);
    }

}
