<?php
/***********************************
타임:          Class
이름:          Category
용도:          Category 템플렛 클래스 ( WEB 버전 )
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

class Category extends CI_Controller {    
    
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
        
        $user_status = 1;
        
        if ( $type == 'create' ) {
            $this->form_validation->set_rules('category_name','카테고리 이름','trim|required');            
        }
        
        /*******************
        data query
        *******************/     
        if ($this->form_validation->run() == TRUE || $type == 'update') {
            $this->load->model('category_model');
            
            $category_id = 0;
            $user_id = 0;
            $category_state = 1;
            $category_description = '';
            $category_picture = '';
            
            $update_data = array();
            if ( isset( $_POST['category_id'] ) ) {
                $category_id = (int)$this->input->post('category_id',TRUE);
            };            
            if ( isset( $_POST['category_state'] ) ) {
                $category_state = $this->input->post('category_state',TRUE);
                $update_data['category_state'] = array (
                    'key' => 'category_state',
                    'type' => 'int',
                    'value' => $category_state
                );                
            };
            if ( isset( $_POST['category_name'] ) ) {
                $category_name = $this->input->post('category_name',TRUE);
                $update_data['category_name'] = array (
                    'key' => 'category_name',
                    'type' => 'string',
                    'value' => $category_name
                );                
            };
            if ( isset( $_POST['user_id'] ) ) {
                $user_id = (int)$this->input->post('user_id',TRUE);
                $update_data['user_id'] = array (
                    'key' => 'user_id',
                    'type' => 'int',
                    'value' => $user_id
                );
            };
            if ( isset( $_POST['category_description'] ) ) {
                $category_description = $this->input->post('category_description',TRUE);
                $update_data['category_description'] = array (
                    'key' => 'category_description',
                    'type' => 'string',
                    'value' => $category_description
                );                
            };
            if ( isset( $_POST['category_picture'] ) ) {
                $category_picture = $this->input->post('category_picture',TRUE);
                $update_data['category_picture'] = array (
                    'key' => 'category_picture',
                    'type' => 'string',
                    'value' => $category_picture
                );                
            };
            
            $row = $this->category_model->out('id',array(
                'category_id' => $category_id
            ));
            
            if ( $row ) {
                // 이미 등록된 카테고리
                $update_data['category_id'] = $row[0]['category_id'];
                $this->category_model->update('update',$update_data);
            } else {
                // 카테고리 등록 필요
                $category_id = mt_rand();
                $row = $this->category_model->update('create',array(
                    'category_id' => $category_id,
                    'user_id' => $user_id,
                    'category_name' => $category_name,
                    'category_description' => $category_description,
                    'category_picture' => $category_picture,
                    'category_status' => 1,
                    'category_state' => 1
                ));
            }
            
            $outrow = array();
            
            if ( $row ) {
                $row = $this->category_model->out('id',array(
                    'category_id' => $category_id
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
            if ( isset($_POST['category_name']) ) {
                if ( 0 < strlen(strip_tags(form_error('category_name'))) ) {
                    //$validation['user_google_id'] = strip_tags(form_error('user_google_id'));
                    $validation['category_name'] = 103; //전달된 파라미터가 없음                    
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
		$this->load->model('category_model'); 
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
            $params_data['campaign_id'] = 0;
        };
        if ( isset($_GET['category_id']) ) {
            $params_data['category_id'] = (int)$_GET['category_id'];            
        } else {
            $params_data['category_id'] = 0;
        };
        
        $row = $this->category_model->out($type,$params_data);        
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