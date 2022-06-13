<?php
/*******************************
 * Changed from ci3.x to ci4.x
 * 
 ***/

namespace App\Models;
use CodeIgniter\Model;

require_once 'UrlsPage.php';


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mngurls_model
 *
 * @author sistema
 */
class MngUrls_Model extends Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * Method to get next id to Class UrlsPage
     * and set for it.
     * @return type
     */
    public function getUrlID() {
        $urls = $this->db->getNextIDObj('SELECT getNextSeq("urls_seq") as url_id;', "UrlsPage");
        //
        return $urls;
    }

    /**
     * Method to Add New Application
     * to UrlsPage.
     * @param type $url
     * @return type
     */
    public function AddAppUrl($url) {
        $urlpg = new UrlsPage();
        $urlpg = $url;
        //
        /*
          print "<pre>";
          print_r($urlpg);
          print "</pre>";
          exit();
         */

        /*
         * Add new address to state_sp
         */
        $result = $this->db->insert('urls_page', array(
            'url_id' => $urlpg->getUrl_id(),
            'app_name' => $urlpg->getApp_name(),
            'page' => $urlpg->getPage(),
            'note' => $urlpg->getNote(),
            'date_create' => $urlpg->getDate_create()
        ));
        //
        return $result;
    }

    /**
     * Method to get AppUrl Class Object
     * @param type $url_id
     * @return type
     */
    public function getAppUrl($url_id) {
        $app_url = $this->db->selectObj('SELECT url_id, app_name, page, note '
                . 'FROM urls_page '
                . 'WHERE url_id = :url_id', array(':url_id' => $url_id), "UrlsPage");
        //
        return $app_url;
    }
    
    /**
     * Method to get AppUrl Class Object
     * @param type $url_id
     * @return type
     */
    public function getAppUrlSingle($url_id) {
        $app_url = $this->db->SingleObj('SELECT url_id, app_name, page, note '
                . 'FROM urls_page '
                . 'WHERE url_id = :url_id', array(':url_id' => $url_id));
        //
        return $app_url;
    }    

    /**
     * Method to Update Application To
     * UrlsPage.
     * @param type $url
     * @return type
     */
    public function EditAppUrl($url) {
        $urlpg = new UrlsPage();
        $urlpg = $url;
        //
        /*
          print "<pre>";
          print_r($urlpg);
          print "</pre>";
          exit();
         */

        /*
         * Add new address to state_sp
         */
        $result = $this->db->update('urls_page', array(
            'app_name' => $urlpg->getApp_name(),
            'page' => $urlpg->getPage(),
            'note' => $urlpg->getNote(),
            'date_change' => $urlpg->getDate_change()), "url_id = {$urlpg->getUrl_id()}");
        //
        return $result;
    }

    /**
     * Method to get a list from object
     * UrlPage for list in a table to
     * edit or update.
     * @return type
     */
    public function getUrlToTable() {
        return $this->db->selectObjList('SELECT url_id, app_name, page, DATE_FORMAT(date_create,"%d-%m-%Y %H:%i:%s") as date_create  
FROM urls_page ORDER BY app_name;', $array = array(), "UrlsPage");
    }

    /**
     * Method to get all urls from table urlspage 
     * to populate in a combobox.
     * @return type
     */
    public function getUrlToCombobox() {
        return $this->db->selectObjList('SELECT url_id, app_name, page FROM urls_page ORDER BY app_name;', $array = array(), "UrlsPage");
    }    
    
    /**
     * Method to Delete Application
     * from UrlsPage.
     * @param type $url
     */
    public function DeleteAppUrl($url_id) {
        //Remove UrlPage
        $result = $this->db->delete('urls_page', "url_id = '$url_id'");
        
        if ($result == 1)
            return 'Okay';
        
        return $result;
    }

}
