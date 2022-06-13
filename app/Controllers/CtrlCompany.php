<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CompanyModel;

/***
 * Class responsible for the requests and responses 
 * of the company's events.
 */
class CtrlCompany extends Controller {
    
    public function index()
    {
        //print_r('Apppath'.'Models/CompanyModel.php');
        $model = new CompanyModel();
        //print_r('Inside CtrlCompany::Index().....!!!');

        $data = [
            'cpny_list'  => $model->getUsers() ,
        ];
        
        print "<pre>";
        print_r($data);
        print "</pre>";
        
        echo view('templates/header', $data);
        echo view('cpnyview/index', $data);
        //echo view('templates/footer', $data);
    }  
    
    
    /***
     * Router example...
     * $routes->add('product/(:num)', 'Catalog::productLookupByID/$1');
     * $routes->add('cpnyedit/(:num)', ''CtrlCompany::viewCpnyId/$1');
     */
    public function viewCpnyID($cpny_id) {
        $model = new CompanyModel();
        // print_r('Inside CtrlCompany::viewCpnyID($cpny_id).....!!!');
        $data = [
            'cpny'  => $model->getUsers(),
        ];
        
        print "<pre>";
        print_r($data);
        print "</pre>";
        
        echo view('templates/header', $data);
        echo view('cpnyview/index', $data);
        echo view('templates/footer', $data);        
    }

    
    
}

