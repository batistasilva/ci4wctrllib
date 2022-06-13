<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Controller;

use entity\Company as ECompany;
use entity\Tools as ETools;
use entity\CompanyAddr as ECpnyAddr;
use entity\Sessionmsg as ESMsg;
use entity\Msg as EMsg;

class Ctrlcpny extends Controller {

    public $smsg;
    private $msg;
    public $cpny;
    public $cpny_temp;
    public $addr_temp;
    public $addr;
    private $tools;
/*
    public function __construct() {
        parent::__construct();
        //
        $this->cpny = new ECompany();
        $this->cpny_temp = new ECompany();
        $this->addr = new ECpnyAddr();
        $this->addr_temp = new ECpnyAddr();
        $this->tools = new ETools();

        //Auth::handleLogin();
        $this->smsg = new ESMsg();
        $this->msg = new EMsg(NULL, NULL, NULL, NULL, NULL, NULL);
    }
*/
    /**
     * Method responsible for open 
     * show data in index view..
     */
    public function index()
    {
        $model = new NewsModel();
        print_r('Inside News::Index().....!!!');

        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive',
        ];

        echo view('templates/header', $data);
        echo view('news/overview', $data);
        echo view('templates/footer', $data);
    }


    /**
     * Open form to add new Company...
     */
    public function cpnyAdd() {
        //
        $this->cpny = new ECompany();
        $this->addr = new ECpnyAddr();
        //
        $this->cpny->setAddr($this->addr);

        $data['cpny'] = $this->cpny;

        //Load Temaplate
        $this->load->view('header', $data);
        $this->load->view('mngcpny/addcpny', $data);
        $this->load->view('footer', $data);
        //    
    }

    /**
     * Save data to Company that come from form,
     * To entity Company.
     */
    public function cpnyAddSave() {

        // Field Rules
        // $this->form_validation->set_rules('nextid', 'RegID', 'trim|required');
        $this->form_validation->set_rules('nameraz', 'Coporation Name', 'trim|required');
        $this->form_validation->set_rules('namefan', 'Alias Name', 'trim|required');
        $this->form_validation->set_rules('numcnpj', 'CNPJ/CPF', 'trim|required');
        $this->form_validation->set_rules('numie', 'ID/I.E.', 'trim|required');
        //$this->form_validation->set_rules('zipid', 'ZipID', 'integer|required');
        $this->form_validation->set_rules('zipcode', 'Zip Code', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('number', 'Number', 'integer|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('district', 'District', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('reference', 'Reference', 'trim|required');
        $this->form_validation->set_rules('business_phone', 'Business Phone', 'trim|required');
        //$this->form_validation->set_rules('mobil_phone', 'Mobil Phone', 'integer|required');
        //$this->form_validation->set_rules('nextel_phone', 'Nextel Phone', 'integer|required');
        //$this->form_validation->set_rules('nextel_id', 'Nextel ID', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');


        $this->cpny = new ECompany();
        $this->cpny_temp = new ECompany();

        $this->tools = new ETools();

        //
        $this->cpny->setLongname($this->input->post('nameraz'));
        $this->cpny->setShortname($this->input->post('namefan'));
        $this->cpny->setCnpj($this->input->post('numcnpj'));
        $this->cpny->setIe($this->input->post('numie'));
        $this->cpny->setBussiness_phone($this->input->post('business_phone'));
        $this->cpny->setMobil_phone($this->input->post('mobil_phone'));
        $this->cpny->setNextel_phone($this->input->post('nextel_phone'));
        $this->cpny->setNextelid($this->input->post('nextel_id'));
        $this->cpny->setEmail($this->input->post('email'));
        $this->cpny->setStatus($this->input->post('status'));
        $this->cpny->setNote($this->input->post('message'));
        //
        $this->cpny_temp->setLongname($this->input->post('nameraz'));
        $this->cpny_temp->setShortname($this->input->post('namefan'));
        $this->cpny_temp->setCnpj($this->input->post('numcnpj'));
        $this->cpny_temp->setIe($this->input->post('numie'));
        $this->cpny_temp->setBussiness_phone($this->input->post('business_phone'));
        $this->cpny_temp->setMobil_phone($this->input->post('mobil_phone'));
        $this->cpny_temp->setNextel_phone($this->input->post('nextel_phone'));
        $this->cpny_temp->setNextelid($this->input->post('nextel_id'));
        $this->cpny_temp->setEmail($this->input->post('email'));
        $this->cpny_temp->setStatus($this->input->post('status'));
        $this->cpny_temp->setNote($this->input->post('message'));
        //
        $this->addr = new ECpnyAddr();
        $this->addr_temp = new ECpnyAddr();
        //
        $this->addr->setZipid($this->input->post('zipid'));
        $this->addr->setZipcode($this->input->post('zipcode'));
        $this->addr->setAddress($this->input->post('address'));
        $this->addr->setAddr_number($this->input->post('number'));
        $this->addr->setDistrict($this->input->post('district'));
        $this->addr->setCity($this->input->post('city'));
        $this->addr->setState($this->input->post('state'));
        $this->addr->setReference($this->input->post('reference'));
        //
        $this->addr_temp->setZipid($this->input->post('zipid'));
        $this->addr_temp->setZipcode($this->input->post('zipcode'));
        $this->addr_temp->setAddress($this->input->post('address'));
        $this->addr_temp->setAddr_number($this->input->post('number'));
        $this->addr_temp->setDistrict($this->input->post('district'));
        $this->addr_temp->setCity($this->input->post('city'));
        $this->addr_temp->setState($this->input->post('state'));
        $this->addr_temp->setReference($this->input->post('reference'));
        //        

        $this->cpny->setAddr($this->addr);
        $this->cpny_temp->setAddr($this->addr_temp);

        //
        if ($this->form_validation->run() == FALSE) {
            //

            $data['cpny'] = $this->cpny;

            //Load Temaplate
            $this->load->view('header', $data);
            $this->load->view('mngcpny/addcpny', $data);
            $this->load->view('footer', $data);
            // 
            // exit();
        } else {

            //Get next id to add
            $result_id = $this->Company_model->get_next_id(); //getNextID();
            //
            $str_cnpj = $this->tools->cleanIntegerToDb($this->input->post('numcnpj'));
            $this->cpny->setCnpj($str_cnpj);
            //
            $str_ie = $this->tools->cleanIntegerToDb($this->input->post('numie'));
            $this->cpny->setIe($str_ie);
            //
            $bphone = $this->tools->cleanInputPhone($this->input->post('business_phone'));
            $this->cpny->setBussiness_phone($bphone);
            //
            $mphone = $this->tools->cleanInputPhone($this->input->post('mobil_phone'));
            $this->cpny->setMobil_phone($mphone);
            //
            $nphone = $this->tools->cleanInputPhone($this->input->post('nextel_phone'));
            $this->cpny->setNextel_phone($nphone);
            //
            $nid = $this->tools->cleanInputPhone($this->input->post('nextel_id'));
            $this->cpny->setNextelid($nid);

            $this->cpny->setId($result_id);
            $this->addr->setCompany_id($result_id);


            $date = date_create(date('Y/m/d H:i'));
            $date_new_create = date_format($date, "Y-m-d H:m:s");

            $this->cpny->setDate_create($date_new_create);

            /**
             * Here!, Call the first method to add company.
             */
            $this->msg = $this->Company_model->AddCpny($this->cpny);
            // $this->msg = $this->Addrcpny_model->addAddress($addr_data);

            if ($this->msg->getStatus() == TRUE) {
                //
                //
                $this->msg = $this->Addrcpny_model->addAddress($this->addr);

                //
                if ($this->msg->getStatus() == FALSE) {
                    //
                    $this->Company_model->CleanCpny($this->cpny->getId());
                    $this->Addrcpny_model->CleanAddr($this->cpny->getId());
                    //
                }
            }

            /*    print "<pre>";
              print_r($this->msg);
              print "</pre>";
              exit(); */
            // $this->smsg = new ESMsg();
            //
            if ($this->msg->getStatus() !== TRUE) {
                //           
                $this->smsg->setMsg($this->msg->getMsgError());
                //Sessionmsg_model
                $this->Sessionmsg_model->wtFSMsg($this->smsg);
                //
                $data['cpny'] = $this->cpny_temp; //for recovery last data putted
                //Load Temaplate
                $this->load->view('header', $data);
                $this->load->view('mngcpny/addcpny', $data);
                $this->load->view('footer', $data);
            } else {
                $this->cpny = new ECompany();
                $this->addr = new ECpnyAddr();
                $this->cpny->setAddr($this->addr);
                //
                $this->smsg->setMsg($this->msg->getMsgSuccess());
                //
                $this->Sessionmsg_model->wtFSMsg($this->smsg);
                //
                $data['cpny'] = $this->cpny;

                //Load Temaplate
                $this->load->view('header', $data);
                $this->load->view('mngcpny/addcpny', $data);
                $this->load->view('footer', $data);
            }
        }
    }

    /**
     * Prepare data to form edit.
     */
    public function cpnyEdit($vcpny_id) {
        $tools = new ETools();
        $this->cpny = new ECompany();
        // 
        //$this->view->title = 'OSSB Solutions - Alteração de Empresa';
        //
        
        $this->cpny = $this->Company_model->getCustonCpny($vcpny_id);
        /*
          if (isset($this->cpny)) {
          echo $this->cpny->getCompany_id();   // access attributes
          echo $this->cpny->getLongname();   // access class methods
          }

          exit();
         */
        /**
         * Make this think only to format some fields.
         */
        //Used to format data
        $vcnpj = $this->cpny->getCnpj();
        //  echo '<br/>Cnpj..:' . $vcnpj;
        $vcnpj = $tools->format_data($vcnpj, "cnpj");
        //  echo '<br/>Cnpj..:' . $vcnpj;
        $this->cpny->setCnpj($vcnpj);
        //
        $vie = $this->cpny->getIe();
        $vie = $tools->format_data($vie, "ie");
        $this->cpny->setIe($vie);
        //
        $vphone = $this->cpny->getBussiness_phone();
        //  echo '<br/>Phone..:' . $vphone;
        $vphone = $tools->format_data($vphone, "phone");
        $this->cpny->setBussiness_phone($vphone);
        //  echo '<br/>Phone..:' . $vphone;
        //

        $vmobil = $this->cpny->getMobil_phone();
        //   echo '<br/>Mobil..:' . $vmobil;
        if (strlen($vmobil) > 2) {
            $vmobil = $tools->format_data($vmobil, "mobil");
            $this->cpny->setMobil_phone($vmobil);
            //   echo '<br/>Mobil..:' . $vmobil;
        }
        //
        $vnextel = $this->cpny->getNextel_phone();
        //   echo '<br/>Nextel..:' . $vnextel;
        if (strlen($vnextel) > 2) {
            $vnextel = $tools->format_data($vnextel, "phone");
            $this->cpny->setNextel_phone($vnextel);
            //   echo '<br/>Nextel..:' . $vnextel;
        }
        /*
          print "<pre>";
          print_r($obj);
          print "</pre>";
          exit();
         */
        //  exit();
        $data['cpny'] = $this->cpny;
        //
        //print "<pre>";
        //print_r($obj);
        //print "</pre>";
        //exit();
        $this->load->view('header');
        $this->load->view('mngcpny/editcpny', $data);
        $this->load->view('footer');
    }

    /**
     * Save data to form edit to database..
     * 
     * @param type $cpny_id
     */
    public function cpnyEditSave($cpny_id) {
        //
        $tools = new ETools();
        //
        $vnamefan = $tools->clean_input($_POST['namefan']);
        $vzipid = $tools->clean_input($_POST['zipid']);
        $vzipcode = $tools->clean_input($_POST['zipcode']);
        $vaddress = $tools->clean_input($_POST['address']);
        $vnumber = $tools->clean_input($_POST['number']);
        $vcity = $tools->clean_input($_POST['city']);
        $vdistrict = $tools->clean_input($_POST['district']);
        $vstate = $tools->clean_input($_POST['state']);
        $vreference = $tools->clean_input($_POST['reference']);
        $vbusiness_phone = $tools->clean_int_input($_POST['business_phone']);
        $vmobil_phone = $tools->clean_int_input($_POST['mobil_phone']);
        $vnextel_phone = $tools->clean_int_input($_POST['nextel_phone']);
        $vnextelid_phone = $tools->clean_input($_POST['nextel_id']);
        $vemail = $tools->clean_input($_POST['email']);
        $vnote = $tools->clean_input($_POST['message']);
        $vstatus = $tools->clean_input($_POST['status']);

        $this->smsg = new ESMsg();

        if (empty($vstatus) || empty($vstate) || empty($vnamefan) || empty($vzipcode) || empty($vaddress) || empty($vcity) || empty($vdistrict) || empty($vstate) ||
                empty($vbusiness_phone)) {
            //
            $createCompanyErro = "Erro: Todos os campos são de Preenchimento Obrigatório!!";

            $this->smsg->setMsg($createCompanyErro);
            //
            $this->Sessionmsg_model->wtFSMsg($this->smsg);

            header('location: ' . URL . 'mngcpny/index');
            exit;
        }

        $cpny = new Company();
        $addrcpny = new CompanyAddr();

        $cpny->setCompany_id($cpny_id);
        $cpny->setStatus($vstatus);
        $cpny->setShortname($vnamefan);
        //
        $addrcpny->setCompany_id($cpny_id);
        $addrcpny->setZipid($vzipid);
        $addrcpny->setZipcode($vzipcode);
        $addrcpny->setAddress($vaddress);
        $addrcpny->setAddr_number($vnumber);
        $addrcpny->setDistrict($vdistrict);
        $addrcpny->setCity($vcity);
        $addrcpny->setState($vstate);
        $addrcpny->setReference($vreference);
        //
        $cpny->setBussiness_phone($vbusiness_phone);
        $cpny->setMobil_phone($vmobil_phone);
        $cpny->setNextel_phone($vnextel_phone);
        $cpny->setNextelid($vnextelid_phone);
        $cpny->setEmail($vemail);
        $cpny->setNote($vnote);
        //
        $cpny->setAddr($addrcpny);

        /**
         * Here!, Call the first method to add company.
         */
        $result = $this->model->updateCpny($cpny);
        $this->smsg = new ESMsg();
        //
        if (isset($result)) {
            //
            $this->smsg->setMsg("updateCpny(): " . $result);
            //
            $this->Sessionmsg_model->wtFSMsg($this->smsg);
            //
            header('location: ' . URL . 'mngcpny/editcpny');
            exit();
        } else {
            //
            $this->smsg->setMsg("Empresa Alterada com Sucesso!");
            //
            $this->Sessionmsg_model->wtFSMsg($this->smsg);
            //
            header('location: ' . URL . 'mngcpny/index');
            exit();
        }
    }

    /**
     * Delete company selected from table, in case 
     * where it has not customer.
     * @param type $cpny_id
     */
    public function cpnyDel($cpny_id) {
        //
        /**
         * Here!, Call the first method to add company.
         */
        $this->msg = $this->Company_model->deleteCpny($cpny_id);
        $this->smsg = new ESMsg();
        //
        if ($this->msg->getStatus() !== TRUE) {
            //  

            $this->smsg->setMsg($this->msg->getMsgError());
            //Sessionmsg_model
            $this->Sessionmsg_model->wtFSMsg($this->smsg);
            //
            $data['cpny_list'] = $this->Company_model->get_list();
            //Load Temaplate
            $this->load->view('header', $data);
            $this->load->view('mngcpny/index', $data);
            $this->load->view('footer', $data);
        } else {
            $this->cpny = new ECompany();
            $this->addr = new ECpnyAddr();
            $this->cpny->setAddr($this->addr);
            //
            $this->smsg->setMsg($this->msg->getMsgSuccess());
            //
            $this->Sessionmsg_model->wtFSMsg($this->smsg);
            $data['cpny_list'] = $this->Company_model->get_list();
            //
            $this->load->view('header', $data);
            $this->load->view('mngcpny/index', $data);
            $this->load->view('footer', $data);
        }
    }

    public function srchzip() {
        //
        $vzipcode = $this->tools->clean_input($_GET['zipcode']);
        //echo '---> '.$vzipcode;
        //$vzipcode = $this->clean_input($_POST['zipcode']);
        $obj = $this->Company_model->getZipCode($vzipcode);
        //
        echo json_encode($obj);
    }

}
