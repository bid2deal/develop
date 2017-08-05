<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends Auth {

    public function __construct() {
        parent::__construct();
        $this->load->model('Seller_model');
    }
    
    public function addSeller(){
        $Post = $this->getPostInput();
        //Validation Of Input Data
        if($this->getUserRoleId() == 1){
            $this->form_validation->set_rules('UserID','User ID','trim|required|numeric|exist[seller_master.user_id]');
        }
        $this->form_validation->set_rules('CompanyName','Company Name','trim|required|strtolower|max_length[100]');
        $this->form_validation->set_rules('OwnerEmployee','Owner/Employee','trim|required|strtolower|max_length[50]');
        $this->form_validation->set_rules('PositionInCompany','Position In Company','trim|required|strtolower|max_length[50]');
        $this->form_validation->set_rules('AlternateNumber','Alternate Number','trim|required|exact_length[10]|numeric');
        $this->form_validation->set_rules('TypeOfSeller','Type Of Seller','trim|required|in_list[manufacturer,wholesaler]');
        $this->form_validation->set_rules('TotalNumOfEmployees','total_num_of_employees','trim|required|numeric|in_list[1,2,3,4,5]');
        $this->form_validation->set_rules('TotalAnnualRevenue','Total Annual Revenue','trim|required|numeric|in_list[1,2,3,4,5]');
        $this->form_validation->set_rules('EstablishmentYear','Establishment Year','trim|required|numeric|greater_than[1800]|less_than_equal_to['.date("Y").']');
        $this->form_validation->set_rules('ProductList','Product List','trim|alpha|required|max_length[255]');
        $this->form_validation->set_rules('CompanyRegDoc','Company Reg. Doc','trim|required|valid_base64');
        $this->form_validation->set_rules('CompanyRegDocMime','Company Reg. Doc','trim|required|in_list[JPG,JPEG,PNG,jpg,jpeg,png]');
        $this->form_validation->set_rules('GSTRegDoc','GST Reg. Doc','trim|required|valid_base64');
        $this->form_validation->set_rules('GSTRegDocMime','GST Reg. Doc','trim|required|in_list[JPG,JPEG,PNG,jpg,jpeg,png]');
        $this->form_validation->set_rules('LicenseDoc','License Doc','trim|valid_base64');
        $this->form_validation->set_rules('LicenseDocMime','License Doc','trim|in_list[JPG,JPEG,PNG,jpg,jpeg,png]');
        $this->form_validation->set_rules('Address','Address','trim|alpha_numeric_spaces|required|strtolower|max_length[255]');
        $this->form_validation->set_rules('Pincode','Pincode','trim|required|numeric|exact_length[6]');
        $this->form_validation->set_rules('City','City','trim|alpha|required|strtolower|max_length[50]');
        $this->form_validation->set_rules('State','State','trim|alpha|required|strtolower|max_length[50]');
        $this->form_validation->set_rules('Country','Country','trim|alpha|required|strtolower|max_length[50]');
        $this->form_validation->set_data($Post);
        if ($this->form_validation->run() == TRUE){
            if(isset($Post['LicenseDoc']) || isset($Post['LicenseDocMime'])){
                if(!isset($Post['LicenseDoc']) && !isset($Post['LicenseDocMime'])){
                    $response['status'] = self::HTTP_BAD_REQUEST;
                    $response['message'] = 'LicenseDoc & LicenseDocMime Both required';
                    $this->jsonOutput($response,$response['status']);
                }
            }
            if($this->getUserRoleId() == 1){
                $request['user_id'] = $Post['UserID'];
            }else{
                $request['user_id'] = $this->getUserId();
            }
            
            $request['company_name'] = $Post['CompanyName'];
            $request['owner_employee'] = $Post['OwnerEmployee'];
            $request['position_in_company'] = $Post['PositionInCompany'];
            $request['alternate_number'] = $Post['AlternateNumber'];
            $request['type_of_seller'] = $Post['TypeOfSeller'];
            $request['total_num_of_employees'] = $Post['TotalNumOfEmployees'];
            $request['total_annual_revenue'] = $Post['TotalAnnualRevenue'];
            $request['year_of_establishment'] = $Post['EstablishmentYear'];
            $request['product_list'] = $Post['ProductList'];
            $request['company_registration_doc'] = $Post['CompanyRegDoc'];
            $request['company_registration_doc_mime'] = $Post['CompanyRegDocMime'];
            $request['gst_registration_doc'] = $Post['GSTRegDoc'];
            $request['gst_registration_doc_mime'] = $Post['GSTRegDocMime'];
            if(isset($Post['LicenseDoc']) && isset($Post['LicenseDocMime'])){
                $request['license_doc'] = $Post['LicenseDoc'];
                $request['license_doc_mime'] = $Post['LicenseDocMime'];
            }
            
            $request['address'] = $Post['Address'];
            $request['pincode'] = $Post['Pincode'];
            $request['city'] = $Post['City'];
            $request['state'] = $Post['State'];
            $request['country'] = $Post['Country'];
            
            $request['is_deleted'] = 0;
            $request['created_by'] = $this->getUserId();
            $request['created_date'] = $this->getCurrentTimeStemp();
            $request['callfrom'] = "update";
            $this->Seller_model->updateSeller($request);
        }else{
            $response['status'] = 400;
            $response['message'] = 'Validation Error';
            $response['errors'] = $this->form_validation->error_array();
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
            $this->jsonOutput($response,$response['status']);
        }
        
    }
    
    public function editSeller(){
        $Post = $this->getPostInput();
        //Validation Of Input Data
        if($this->getUserRoleId() == 1){
            $this->form_validation->set_rules('UserID','User ID','trim|required|numeric|exist[seller_master.user_id]');
        }
        $this->form_validation->set_rules('CompanyName','Company Name','trim|strtolower|max_length[100]');
        $this->form_validation->set_rules('OwnerEmployee','Owner/Employee','trim|strtolower|alpha_numeric_spaces|max_length[50]');
        $this->form_validation->set_rules('PositionInCompany','Position In Company','trim|alpha_numeric_spaces|strtolower|max_length[50]');
        $this->form_validation->set_rules('AlternateNumber','Alternate Number','trim|exact_length[10]|numeric');
        $this->form_validation->set_rules('TypeOfSeller','Type Of Seller','trim|in_list[manufacturer,wholesaler]');
        $this->form_validation->set_rules('TotalNumOfEmployees','total_num_of_employees','trim|numeric|in_list[1,2,3,4,5]');
        $this->form_validation->set_rules('TotalAnnualRevenue','Total Annual Revenue','trim|numeric|in_list[1,2,3,4,5]');
        $this->form_validation->set_rules('EstablishmentYear','Establishment Year','trim|numeric|greater_than[1800]|less_than_equal_to['.date("Y").']');
        $this->form_validation->set_rules('ProductList','Product List','trim|alpha|max_length[255]');
        $this->form_validation->set_rules('CompanyRegDoc','Company Reg. Doc','trim|valid_base64');
        $this->form_validation->set_rules('CompanyRegDocMime','Company Reg. Doc','trim|in_list[JPG,JPEG,PNG,jpg,jpeg,png]');
        $this->form_validation->set_rules('GSTRegDoc','GST Reg. Doc','trim|valid_base64');
        $this->form_validation->set_rules('GSTRegDocMime','GST Reg. Doc','trim|in_list[JPG,JPEG,PNG,jpg,jpeg,png]');
        $this->form_validation->set_rules('LicenseDoc','License Doc','trim|valid_base64');
        $this->form_validation->set_rules('LicenseDocMime','License Doc','trim|alpha|in_list[JPG,JPEG,PNG,jpg,jpeg,png]');
        $this->form_validation->set_rules('Address','Address','trim|alpha_numeric_spaces|strtolower|max_length[255]');
        $this->form_validation->set_rules('Pincode','Pincode','trim|numeric|exact_length[6]');
        $this->form_validation->set_rules('City','City','trim|alpha|strtolower|max_length[50]');
        $this->form_validation->set_rules('State','State','trim|alpha|strtolower|max_length[50]');
        $this->form_validation->set_rules('Country','Country','trim|alpha|strtolower|max_length[50]');
        $this->form_validation->set_data($Post);
        if ($this->form_validation->run() == TRUE){
            if(isset($Post['CompanyRegDoc']) || isset($Post['CompanyRegDocMime'])){
                if(!isset($Post['CompanyRegDoc']) && !isset($Post['CompanyRegDocMime'])){
                    $response['status'] = self::HTTP_BAD_REQUEST;
                    $response['message'] = 'CompanyRegDoc & CompanyRegDocMime Both required';
                    $this->jsonOutput($response,$response['status']);
                }
            }
            if(isset($Post['GSTRegDoc']) || isset($Post['GSTRegDocMime'])){
                if(!isset($Post['GSTRegDoc']) && !isset($Post['GSTRegDocMime'])){
                    $response['status'] = self::HTTP_BAD_REQUEST;
                    $response['message'] = 'GSTRegDoc & GSTRegDocMime Both required';
                    $this->jsonOutput($response,$response['status']);
                }
            }
            if(isset($Post['LicenseDoc']) || isset($Post['LicenseDocMime'])){
                if(!isset($Post['LicenseDoc']) && !isset($Post['LicenseDocMime'])){
                    $response['status'] = self::HTTP_BAD_REQUEST;
                    $response['message'] = 'LicenseDoc & LicenseDocMime Both required';
                    $this->jsonOutput($response,$response['status']);
                }
            }
            if(isset($Post['Address']) || isset($Post['Pincode']) || isset($Post['City']) || isset($Post['State'])  || isset($Post['Country'])){
                if(!isset($Post['Address']) || !isset($Post['Pincode']) || !isset($Post['City']) || !isset($Post['State'])  || !isset($Post['Country'])){
                    $response['status'] = self::HTTP_BAD_REQUEST;
                    $response['message'] = 'Address,Pincode,City,State,Country All Required';
                    $this->jsonOutput($response,$response['status']);
                }
            }
            if($this->getUserRoleId() == 1){
                $request['user_id'] = $Post['UserID'];
            }else{
                $request['user_id'] = $this->getUserId();
            }
            if(isset($Post['CompanyName'])){$request['company_name'] = $Post['CompanyName'];}
            if(isset($Post['OwnerEmployee'])){$request['owner_employee'] = $Post['OwnerEmployee'];}
            if(isset($Post['PositionInCompany'])){$request['position_in_company'] = $Post['PositionInCompany'];}
            if(isset($Post['AlternateNumber'])){$request['alternate_number'] = $Post['AlternateNumber'];}
            if(isset($Post['TypeOfSeller'])){$request['type_of_seller'] = $Post['TypeOfSeller'];}
            if(isset($Post['TotalNumOfEmployees'])){$request['total_num_of_employees'] = $Post['TotalNumOfEmployees'];}
            if(isset($Post['TotalAnnualRevenue'])){$request['total_annual_revenue'] = $Post['TotalAnnualRevenue'];}
            if(isset($Post['EstablishmentYear'])){$request['year_of_establishment'] = $Post['EstablishmentYear'];}
            if(isset($Post['ProductList'])){$request['product_list'] = $Post['ProductList'];}
            if(isset($Post['CompanyRegDoc']) && isset($Post['CompanyRegDocMime'])){
                $request['company_registration_doc'] = $Post['CompanyRegDoc'];
                $request['company_registration_doc_mime'] = $Post['CompanyRegDocMime'];
            }
            if(isset($Post['GSTRegDoc']) && isset($Post['GSTRegDocMime'])){
                $request['gst_registration_doc'] = $Post['GSTRegDoc'];
                $request['gst_registration_doc_mime'] = $Post['GSTRegDocMime'];
            }
            if(isset($Post['LicenseDoc']) && isset($Post['LicenseDocMime'])){
                $request['license_doc'] = $Post['LicenseDoc'];
                $request['license_doc_mime'] = $Post['LicenseDocMime'];
            }
            if(isset($Post['Address'])){$request['address'] = $Post['Address'];}
            if(isset($Post['Pincode'])){$request['pincode'] = $Post['Pincode'];}
            if(isset($Post['City'])){$request['city'] = $Post['City'];}
            if(isset($Post['State'])){$request['state'] = $Post['State'];}
            if(isset($Post['Country'])){$request['country'] = $Post['Country'];}
            $request['updated_by'] = $this->getUserId();
            $request['updated_date'] = $this->getCurrentTimeStemp();
            $request['callfrom'] = "update";
            $this->Seller_model->updateSeller($request);
        }else{
            $response['status'] = self::HTTP_BAD_REQUEST;
            $response['message'] = 'Validation Error';
            $response['errors'] = $this->form_validation->error_array();
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
        }
        $this->jsonOutput($response,$response['status']);
    }
}
