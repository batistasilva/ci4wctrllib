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

use entity\Sessionmsg as ESMsg;

/**
 * Description of Sessionmsg_model
 *
 * @author batista
 */
class Sessionmsg_Model extends Model {

    public $smsg;

    function __construct() {
        parent::__construct();
        $this->smsg = new ESMsg();
    }

    /**
     * Here define name of var to write
     * session message, who is made by
     * app name and message name.
     */
    public function wtFSMsg($smsg) {
        $this->smsg = new ESMsg();
        $this->smsg = $smsg;
        // Set message
        $this->session->set_flashdata('smsg', $this->smsg);
        //$this->session->set_userdata('smsg', $smsg);
    }

        
      
    /**
     * Load object Session Msg from
     * Session..
     * @return type
     */
    public function loadSMsg() {
        $this->smsg = new ESMsg();
        //
        $this->smsg = $this->session->flashdata('smsg');
        //
        return $this->smsg;
    }

    /*     * 
     * Metho for unset object
     * for session.
     * Name object should be
     * setted.
     */

    public function removeSMsg() {
        //unset($_SESSION['smsg']);
        //$this->session->unset('smsg');
        unset($_SESSION['smsg']);
    }

}
