<?php
/***********************************
타임:          Class
이름:          Auth
용도:          Post 템플렛 클래스 ( WEB 버전 )
작성자:        전병훈
생성일자:      2017.05.13 21:40:35
업데이트일자:   
Var 1.0


status 200 : 정상
status 400 : 서버가 요청의 구문을 인식하지 못했다. ( 파라미터가 유효하지 않은 경우 )
status 401 : 이 요청은 인증이 필요하다. 서버는 로그인이 필요한 페이지에 대해 이 요청을 제공할 수 있다.
status 500 : 서버에 오류가 발생하여 요청을 수행할 수 없다.

************************************/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {    
    
    function __construct()
	{
		parent::__construct();
	}
    
    function device () {
        /*******************
        data
        *******************/
        $data = array();
        
        /*******************
        response
        *******************/
        $response = array();        

        /*******************
        library
        *******************/        
        $this->load->library('form_validation');        
        
        $this->form_validation->set_rules('user_app_version_code','user_app_version_code','trim|required');
        $this->form_validation->set_rules('user_app_device_id','user_app_device_id','trim|required');
        
        /*******************
        data query
        *******************/     
        if ($this->form_validation->run() == TRUE ) {
            
            $outrow = array(
                array(
                    'auth' => 1
                )
            );
            $row = $outrow;
            
            if ( $row ) {
                $response['status'] = 200;
                $response['data'] = array(
                    'out' => $outrow,
                    'count' => count($outrow)
                );
            } else {
                $response['status'] = 500;
                $response['error'] = array (
                    'message' => 1
                );
            };        
        } else {
            /*******************
            validation
            *******************/
            $validation = array();
            if ( isset($_POST['user_app_version_code']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_app_version_code'))) ) {
                    //$validation['user_google_id'] = strip_tags(form_error('user_google_id'));
                    $validation['user_app_version_code'] = 101; //전달된 파라미터가 없음                    
                };
            };
            if ( isset($_POST['user_app_device_id']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_app_device_id'))) ) {
                    //$validation['user_google_id'] = strip_tags(form_error('user_google_id'));
                    $validation['user_app_device_id'] = 101; //전달된 파라미터가 없음                    
                };
            };            
            
            if ( count($validation) ) {
                $response['status'] = 400;
                $response['error'] = array (
                    'validation' => $validation
                );
            } else {
                $response['status'] = 500;
                $response['error'] = array (
                    'message' => '재시도 해주세요.'
                );
            }
        }
        
		$this->output
			 ->set_content_type('application/json')
			 ->set_output( json_encode($response) );          
    }
    
    function login () {
        /*******************
        data
        *******************/
        $data = array();
        
        /*******************
        response
        *******************/
        $response = array();        

        /*******************
        library
        *******************/        
        $this->load->library('form_validation');        
        
        $this->form_validation->set_rules('user_google_id','구글아이디','trim|required');
        
        /*******************
        data query
        *******************/     
        if ($this->form_validation->run() == TRUE ) {
            $this->load->model('user_model');        
            
            $user_google_id = '';
            $user_name = '';
            $user_picture = '';
            $user_country = '';
            $user_app_version_code = '';
            $user_app_version_name = '';
            $user_device_os = '';
            $user_device_name = '';
            $user_device_version = '';
            $user_gcm_id = '';
            $user_apns_id = '';
            
            $update_data = array();
            if ( isset( $_POST['user_google_id'] ) ) {
                $user_google_id = $this->input->post('user_google_id',TRUE);
            };
            if ( isset( $_POST['user_name'] ) ) {
                $user_name = $this->input->post('user_name',TRUE);
                //$this->form_validation->set_rules('user_status','상태','trim|required');
                $update_data['user_name'] = array (
                    'key' => 'user_name',
                    'type' => 'string',
                    'value' => $user_name
                );
            };
            if ( isset( $_POST['user_picture'] ) ) {
                $user_picture = $this->input->post('user_picture',TRUE);
                $update_data['user_picture'] = array (
                    'key' => 'user_picture',
                    'type' => 'string',
                    'value' => $user_picture
                );                
            };
            if ( isset( $_POST['user_country'] ) ) {
                $user_country = $this->input->post('user_country',TRUE);
                $update_data['user_country'] = array (
                    'key' => 'user_country',
                    'type' => 'string',
                    'value' => $user_country
                );                
            };
            if ( isset( $_POST['user_app_version_code'] ) ) {
                $user_app_version_code = (int)$this->input->post('user_app_version_code',TRUE);
                $update_data['user_app_version_code'] = array (
                    'key' => 'user_app_version_code',
                    'type' => 'int',
                    'value' => $user_app_version_code
                );                
            };
            if ( isset( $_POST['user_app_version_name'] ) ) {
                $user_app_version_name = $this->input->post('user_app_version_name',TRUE);
                $update_data['user_app_version_name'] = array (
                    'key' => 'user_app_version_name',
                    'type' => 'string',
                    'value' => $user_app_version_name
                );                
            };
            if ( isset( $_POST['user_device_os'] ) ) {
                $user_device_os = $this->input->post('user_device_os',TRUE);
                $update_data['user_device_os'] = array (
                    'key' => 'user_device_os',
                    'type' => 'string',
                    'value' => $user_device_os
                );                
            };
            if ( isset( $_POST['user_device_name'] ) ) {
                $user_device_name = $this->input->post('user_device_name',TRUE);
                $update_data['user_device_name'] = array (
                    'key' => 'user_device_name',
                    'type' => 'string',
                    'value' => $user_device_name
                );                
            };
            if ( isset( $_POST['user_device_version'] ) ) {
                $user_device_version = $this->input->post('user_device_version',TRUE);
                $update_data['user_device_version'] = array (
                    'key' => 'user_device_version',
                    'type' => 'string',
                    'value' => $user_device_version
                );                
            };
            if ( isset( $_POST['user_gcm_id'] ) ) {
                $user_gcm_id = $this->input->post('user_gcm_id',TRUE);
                $update_data['user_gcm_id'] = array (
                    'key' => 'user_gcm_id',
                    'type' => 'string',
                    'value' => $user_gcm_id
                );                
            };
            if ( isset( $_POST['user_apns_id'] ) ) {
                $user_apns_id = $this->input->post('user_apns_id',TRUE);
                $update_data['user_apns_id'] = array (
                    'key' => 'user_apns_id',
                    'type' => 'string',
                    'value' => $user_apns_id
                );                
            };
            
            $row = $this->user_model->out('login',array(
                'user_google_id' => $user_google_id
            ));
            
            if ( $row ) {
                // 이미 회원가입함
                $update_data['user_id'] = $row[0]['user_id'];
                $this->user_model->update('update',$update_data);
            } else {
                // 회원가입 필요
                $row = $this->user_model->update('create',array(
                    'user_id' => mt_rand(),
                    'user_google_id' => $user_google_id,
                    'user_name' => $user_name,
                    'user_picture' => $user_picture,
                    'user_country' => $user_country,
                    'user_app_version_code' => $user_app_version_code,
                    'user_app_version_name' => $user_app_version_name,
                    'user_device_os' => $user_device_os,
                    'user_device_name' => $user_device_name,
                    'user_device_version' => $user_device_version,
                    'user_gcm_id' => $user_gcm_id,
                    'user_apns_id' => $user_apns_id,
                    'user_status' => 1,
                    'user_state' => 1
                ));
            }
            
            $outrow = array();
            
            if ( $row ) {
                $row = $this->user_model->out('login',array(
                    'user_google_id' => $user_google_id
                ));
                array_push($outrow,$row[0]);                
            }
            
            /*******************
            Log write
            *******************/
            
            if ( $row ) {
                $response['status'] = 200;
                $response['data'] = array(
                    'out' => $outrow,
                    'count' => count($outrow)
                );
            } else {
                $response['status'] = 500;
                $response['error'] = array (
                    'message' => 1
                );
            };        
        } else {
            /*******************
            validation
            *******************/
            $validation = array();
            if ( isset($_POST['user_google_id']) ) {
                if ( 0 < strlen(strip_tags(form_error('user_google_id'))) ) {
                    //$validation['user_google_id'] = strip_tags(form_error('user_google_id'));
                    $validation['user_google_id'] = 101; //전달된 파라미터가 없음                    
                };
            };
            
            if ( count($validation) ) {
                $response['status'] = 400;
                $response['error'] = array (
                    'validation' => $validation
                );
            } else {
                $response['status'] = 500;
                $response['error'] = array (
                    'message' => '재시도 해주세요.'
                );
            }
        }
        
		$this->output
			 ->set_content_type('application/json')
			 ->set_output( json_encode($response) );          
    }    
    
    function logout () {
        /*******************
        data
        *******************/
        $data = array();
        
        /*******************
        response
        *******************/
        $response = array();        
        
        /*******************
        data query
        *******************/     
        $this->load->model('user_model');        
        $row = $this->user_model->out('id',array(
            'user_id' => $this->input->post('user_id',TRUE)
        ));

        /*******************
        Log write
        *******************/
        if ( $row ) {
            $this->push_update(0);
            $response['status'] = 200;
            $response['data'] = array(
                'out' => $row,
                'count' => count($row)
            );
        } else {
            $response['status'] = 500;
            $response['error'] = array (
                'message' => '재시도 해주세요.'
            );
        };        
        
		$this->output
			 ->set_content_type('application/json')
			 ->set_output( json_encode($response) );
    }
    
}
?>