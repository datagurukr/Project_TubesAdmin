<?php
/***********************************
타임:          Class
이름:          User
용도:          User 템플렛 클래스 ( WEB 버전 )
작성자:        전병훈
생성일자:      2017.05.15 20:32:39
업데이트일자:   
Var 1.0


status 200 : 정상
status 400 : 서버가 요청의 구문을 인식하지 못했다. ( 파라미터가 유효하지 않은 경우 )
status 401 : 이 요청은 인증이 필요하다. 서버는 로그인이 필요한 페이지에 대해 이 요청을 제공할 수 있다.
status 500 : 서버에 오류가 발생하여 요청을 수행할 수 없다.

************************************/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {    
    
    function __construct()
	{
		parent::__construct();
	}
    
    function edit ( $type = 'create' ) {
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
        
        /*******************
        data query
        *******************/     
        if ($this->form_validation->run() == TRUE || $type == 'update') {
            $this->load->model('user_model');        
            
            $user_name = '';
            $user_picture = '';
            $user_country = '';
            
            $update_data = array();
            if ( isset( $_POST['user_id'] ) ) {
                $user_id = (int)$this->input->post('user_id',TRUE);
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
            
            
            $row = $this->user_model->out('id',array(
                'user_id' => $user_id
            ));
            
            if ( $row ) {
                // 이미 등록된 회원
                $update_data['user_id'] = $row[0]['user_id'];
                $this->user_model->update('update',$update_data);
            } else {
                // 회원 등록
                if ( $type = 'create' ) {
                    
                }
            }

            $outrow = array();
            
            if ( $row ) {
                $row = $this->user_model->out('id',array(
                    'user_id' => $user_id
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
    
    function out ($type) {
        /*******************
        data
        *******************/
        $data = array();
        
        /*******************
        session
        *******************/
        $session = $this->session->all_userdata();          
        if ( isset( $_GET['session_id'] ) ) {
            $session_id = (int)$_GET['session_id'];
        } elseif( isset( $session['logged_in'] ) ) {
            $session_id = @$session['user_id'];
        } else {
            $session_id = 0;
        };
        $params_data['session_id'] = $session_id;
        
        /*******************
        response
        *******************/
        $response = array();        
        
        /*******************
        data query
        *******************/
		$this->load->model('user_model'); 
        if ( isset($_GET['q']) ) {
            $params_data['q'] = $_GET['q'];
        } else {
            $params_data['q'] = "";
        };                
        
        if ( isset($_GET['limit']) ) {
            $params_data['limit'] = (int)$_GET['limit'];
            if ( $params_data['limit'] == 0 ) {
                $params_data['limit'] = 20;
            };
        } else {
            $params_data['limit'] = 20;
        };        
        
        if ( isset($_GET['p']) ) {
            $params_data['p'] = (int)$_GET['p'];
            if ( $params_data['p'] == 0 ) {
                $params_data['p'] = 1;
            };
        } else {
            $params_data['p'] = 1;
        };
        $params_data['p'] = (($params_data['p'] * ($params_data['limit']*0.1)) * 10) - $params_data['limit'];
        if ( isset($_GET['order']) ) {
            if ( $_GET['order'] == 'desc' || $_GET['order'] == 'asc' ) {
                $params_data['order'] = $_GET['order'];
            } else {
                $params_data['order'] = 'desc';
            };
        } else {
            $params_data['order'] = 'desc';
        };
        if ( isset($_GET['user_id']) ) {
            $params_data['user_id'] = (int)$_GET['user_id'];            
        } else {
            $params_data['user_id'] = 0;
        };
        if ( isset($_GET['user_loginid']) ) {
            $params_data['user_loginid'] = $_GET['user_loginid'];            
        };        
        
        $row = $this->user_model->out($type,$params_data);        
        /*
        for ( $i = 0; $i < 20; $i++ ) {
            $row[$i]['user_id'] = $i;            
            $row[$i]['post_id'] = $i;
        }
        */
        if ( $row ) {
            $response['status'] = 200;
            $response['data'] = array(
                'out' => $row,
                'count' => count($row)
            );
        } else {
            $response['status'] = 200;
            $response['data'] = array(
                'out' => $row,
                'count' => 0
            );
        };
		$this->output
			 ->set_content_type('application/json')
			 ->set_output( json_encode($response) );               
    }
    
    
}
?>