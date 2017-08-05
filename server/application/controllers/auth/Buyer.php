<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buyer extends Auth {

    public function __construct() {
        parent::__construct();
        $this->load->model('Buyer_model');
    }
    
    public function addBuyer(){
        $Post = $this->getPostInput();
        //Validation Of Input Data
        if($this->getUserRoleId() == 1){
            $this->form_validation->set_rules('UserID','User ID','trim|required|numeric|exist[seller_master.user_id]');
        }
        $this->form_validation->set_rules('CompanyName','Company Name','trim|required|strtolower|max_length[100]');
        $this->form_validation->set_rules('BuyerName','Buyer Name','trim|required|alpha|strtolower|max_length[50]');
        $this->form_validation->set_rules('PositionInCompany','Position In Company','trim|alpha|required|strtolower|max_length[50]');
        $this->form_validation->set_rules('AlternateNumber','Alternate Number','trim|required|exact_length[10]|numeric');
        $this->form_validation->set_rules('TotalNumOfEmployees','total_num_of_employees','trim|required|numeric|in_list[1,2,3,4,5]');
        $this->form_validation->set_rules('TotalAnnualRevenue','Total Annual Revenue','trim|required|numeric|in_list[1,2,3,4,5]');
        $this->form_validation->set_rules('EstablishmentYear','Establishment Year','trim|required|numeric|greater_than[1800]|less_than_equal_to['.date("Y").']');
        $this->form_validation->set_rules('FrequencyOfRequirement','Frequency Of Requirement','trim|required|in_list[monthly,quarterly,yearly]');
        $this->form_validation->set_rules('Address','Address','trim|alpha_numeric_spaces|required|strtolower|max_length[255]');
        $this->form_validation->set_rules('Pincode','Pincode','trim|required|numeric|exact_length[6]');
        $this->form_validation->set_rules('City','City','trim|alpha|required|strtolower|max_length[50]');
        $this->form_validation->set_rules('State','State','trim|alpha|required|strtolower|max_length[50]');
        $this->form_validation->set_rules('Country','Country','trim|alpha|required|strtolower|max_length[50]');
        $this->form_validation->set_data($Post);
        if ($this->form_validation->run() == TRUE){
            if($this->getUserRoleId() == 1){
                $request['user_id'] = $Post['UserID'];
            }else{
                $request['user_id'] = $this->getUserId();
            }
            $request['company_name'] = $Post['CompanyName'];
            $request['buyer_name'] = $Post['BuyerName'];
            $request['position_in_company'] = $Post['PositionInCompany'];
            $request['alternate_number'] = $Post['AlternateNumber'];
            $request['total_num_of_employees'] = $Post['TotalNumOfEmployees'];
            $request['total_annual_revenue'] = $Post['TotalAnnualRevenue'];
            $request['year_of_establishment'] = $Post['EstablishmentYear'];
            $request['frequency_of_requirement'] = $Post['FrequencyOfRequirement'];
            
            $request['address'] = $Post['Address'];
            $request['pincode'] = $Post['Pincode'];
            $request['city'] = $Post['City'];
            $request['state'] = $Post['State'];
            $request['country'] = $Post['Country'];
            
            $request['is_deleted'] = 0;
            $request['created_by'] = $this->getUserId();
            $request['created_date'] = $this->getCurrentTimeStemp();
            $request['callfrom'] = "update";
            $this->Buyer_model->updateBuyer($request);
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
    
    public function editBuyer(){
        $Post = $this->getPostInput();
        //Validation Of Input Data
        if($this->getUserRoleId() == 1){
            $this->form_validation->set_rules('UserID','User ID','trim|required|numeric|exist[seller_master.user_id]');
        }
        $this->form_validation->set_rules('CompanyName','Company Name','trim|strtolower|max_length[100]');
        $this->form_validation->set_rules('BuyerName','Buyer Name','trim|alpha|strtolower|max_length[50]');
        $this->form_validation->set_rules('PositionInCompany','Position In Company','trim|alpha|strtolower|max_length[50]');
        $this->form_validation->set_rules('AlternateNumber','Alternate Number','trim|exact_length[10]|numeric');
        $this->form_validation->set_rules('TotalNumOfEmployees','total_num_of_employees','trim|numeric|in_list[1,2,3,4,5]');
        $this->form_validation->set_rules('TotalAnnualRevenue','Total Annual Revenue','trim|numeric|in_list[1,2,3,4,5]');
        $this->form_validation->set_rules('EstablishmentYear','Establishment Year','trim|numeric|greater_than[1800]|less_than_equal_to['.date("Y").']');
        $this->form_validation->set_rules('FrequencyOfRequirement','Frequency Of Requirement','trim|in_list[monthly,quarterly,yearly]');
        $this->form_validation->set_rules('Address','Address','trim|alpha_numeric_spaces|strtolower|max_length[255]');
        $this->form_validation->set_rules('Pincode','Pincode','trim|numeric|exact_length[6]');
        $this->form_validation->set_rules('City','City','trim|alpha|strtolower|max_length[50]');
        $this->form_validation->set_rules('State','State','trim|alpha|strtolower|max_length[50]');
        $this->form_validation->set_rules('Country','Country','trim|alpha|strtolower|max_length[50]');
        $this->form_validation->set_data($Post);
        if ($this->form_validation->run() == TRUE){
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
            if(isset($Post['BuyerName'])){$request['buyer_name'] = $Post['BuyerName'];}
            if(isset($Post['PositionInCompany'])){$request['position_in_company'] = $Post['PositionInCompany'];}
            if(isset($Post['AlternateNumber'])){$request['alternate_number'] = $Post['AlternateNumber'];}
            if(isset($Post['TotalNumOfEmployees'])){$request['total_num_of_employees'] = $Post['TotalNumOfEmployees'];}
            if(isset($Post['TotalAnnualRevenue'])){$request['total_annual_revenue'] = $Post['TotalAnnualRevenue'];}
            if(isset($Post['EstablishmentYear'])){$request['year_of_establishment'] = $Post['EstablishmentYear'];}
            if(isset($Post['FrequencyOfRequirement'])){$request['frequency_of_requirement'] = $Post['FrequencyOfRequirement'];}
            
            if(isset($Post['Address'])){$request['address'] = $Post['Address'];}
            if(isset($Post['Pincode'])){$request['pincode'] = $Post['Pincode'];}
            if(isset($Post['City'])){$request['city'] = $Post['City'];}
            if(isset($Post['State'])){$request['state'] = $Post['State'];}
            if(isset($Post['Country'])){$request['country'] = $Post['Country'];}
            
            $request['updated_by'] = $this->getUserId();
            $request['updated_date'] = $this->getCurrentTimeStemp();
            $request['callfrom'] = "update";
            $this->Buyer_model->updateBuyer($request);
        }else{
            $response['status'] = 400;
            $response['message'] = 'Validation Error';
            $response['errors'] = $this->form_validation->error_array();
            $response['line'] = __LINE__;
            $response['function'] = __FUNCTION__;
            $response['controller'] = __CLASS__;
        }
        $this->jsonOutput($response,$response['status']);
    }
}
