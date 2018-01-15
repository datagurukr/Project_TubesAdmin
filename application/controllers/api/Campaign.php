<?php
/***********************************
타임:          Class
이름:          Campaign
용도:          Campaign 템플렛 클래스 ( WEB 버전 )
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

class Campaign extends CI_Controller {    
    
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
        if ( isset($_POST['user_status']) ) {
            $user_status = $this->input->post('user_status',TRUE);
        }
        
        if ( $type == 'create' ) {
            $this->form_validation->set_rules('campaign_name','캠페인 이름','trim|required');            
        }

        /*
        if ( $user_status == 2 || $user_status == 3 || $user_status == 4 ) {
            $this->form_validation->set_rules('user_name','이름','trim|required|min_length[1]|max_length[20]');
            $this->form_validation->set_rules('user_affiliation','소속','trim|required|min_length[1]|max_length[20]');            
            $this->form_validation->set_rules('user_location','지역','trim|required|min_length[1]|max_length[20]');
            $this->form_validation->set_rules('user_introduction','소개','trim|required');            
            $this->form_validation->set_rules('user_license_front_picture','딜러증_앞','trim|required');
            $this->form_validation->set_rules('user_license_back_picture','딜러증_뒤','trim|required');            
            $this->form_validation->set_rules('user_picture','회원 프로필 사진','trim|required');            
            if ( isset( $_POST['user_name'] ) ) {
                $user_name = $this->input->post('user_name',TRUE);
            }
            if ( isset( $_POST['user_affiliation'] ) ) {
                $user_affiliation = $this->input->post('user_affiliation',TRUE);
            }
            if ( isset( $_POST['user_location'] ) ) {
                $user_location = $this->input->post('user_location',TRUE);
            }
            if ( isset( $_POST['user_introduction'] ) ) {
                $user_introduction = $this->input->post('user_introduction',TRUE);
            }
            if ( isset( $_POST['user_license_front_picture'] ) ) {
                $user_license_front_picture = $this->input->post('user_license_front_picture',TRUE);
            }
            if ( isset( $_POST['user_license_back_picture'] ) ) {
                $user_license_back_picture = $this->input->post('user_license_back_picture',TRUE);
            }            
            if ( isset( $_POST['user_picture'] ) ) {
                $user_license_back_picture = $this->input->post('user_picture',TRUE);
            }            
        }
        
        $user_picture = "";
        $user_country = "KR";
        $user_app_ver = 1;
        $user_phone_name = "";
        $user_gcm_id = "";
        $user_apns_id = "";
        
        if ( isset( $_POST['user_picture'] ) ) {
            $user_picture = $this->input->post('user_picture',TRUE);
        }
        if ( isset( $_POST['user_country'] ) ) {
            $user_country = $this->input->post('user_country',TRUE);
        }
        if ( isset( $_POST['user_app_ver'] ) ) {
            $user_app_ver = (int)$this->input->post('user_app_ver',TRUE);
        }
        if ( isset( $_POST['user_phone_name'] ) ) {
            $user_phone_name = $this->input->post('user_phone_name',TRUE);
        }
        if ( isset( $_POST['user_gcm_id'] ) ) {
            $user_gcm_id = $this->input->post('user_gcm_id',TRUE);
        }
        if ( isset( $_POST['user_apns_id'] ) ) {
            $user_apns_id = $this->input->post('user_apns_id',TRUE);
        }
        if ( isset( $_POST['user_pass'] ) ) {
            $user_pass = $this->input->post('user_pass',TRUE);
        } elseif ( isset( $_POST['user_usim_number']) ) {
            $user_pass = $this->input->post('user_usim_number',TRUE);
        } else {
            $user_pass = 'password';            
        }
        */
        
        /*******************
        data query
        *******************/     
        if ($this->form_validation->run() == TRUE || $type == 'update') {
            $this->load->model('campaign_model');        
            
            $campaign_id = 0;
            $campaign_state = 0;
            $campaign_name = '';
            $category_id = 0;
            $campaign_description = '';
            $campaign_picture = '';
            $campaign_link = '';
            $campaign_show_second = 0;
            $campaign_start_date = '0000-00-00 00:00:00';
            $campaign_stop_date = '0000-00-00 00:00:00';
            
            $update_data = array();
            if ( isset( $_POST['campaign_id'] ) ) {
                $campaign_id = (int)$this->input->post('campaign_id',TRUE);
            };            
            if ( isset( $_POST['campaign_state'] ) ) {
                $campaign_state = $this->input->post('campaign_state',TRUE);
                $update_data['campaign_state'] = array (
                    'key' => 'campaign_state',
                    'type' => 'int',
                    'value' => $campaign_state
                );                
            };
            if ( isset( $_POST['campaign_name'] ) ) {
                $campaign_name = $this->input->post('campaign_name',TRUE);
                $update_data['campaign_name'] = array (
                    'key' => 'campaign_name',
                    'type' => 'string',
                    'value' => $campaign_name
                );                
            };
            if ( isset( $_POST['category_id'] ) ) {
                $category_id = (int)$this->input->post('category_id',TRUE);
                //$this->form_validation->set_rules('user_status','상태','trim|required');
                $update_data['category_id'] = array (
                    'key' => 'category_id',
                    'type' => 'int',
                    'value' => $category_id
                );
            };
            if ( isset( $_POST['campaign_description'] ) ) {
                $campaign_description = $this->input->post('campaign_description',TRUE);
                $update_data['campaign_description'] = array (
                    'key' => 'campaign_description',
                    'type' => 'string',
                    'value' => $campaign_description
                );                
            };
            if ( isset( $_POST['campaign_picture'] ) ) {
                $campaign_picture = $this->input->post('campaign_picture',TRUE);
                $update_data['campaign_picture'] = array (
                    'key' => 'campaign_picture',
                    'type' => 'string',
                    'value' => $campaign_picture
                );                
            };
            if ( isset( $_POST['campaign_link'] ) ) {
                $campaign_link = $this->input->post('campaign_link',TRUE);
                $update_data['campaign_link'] = array (
                    'key' => 'campaign_link',
                    'type' => 'string',
                    'value' => $campaign_link
                );                
            };
            if ( isset( $_POST['campaign_show_second'] ) ) {
                $campaign_show_second = (int)$this->input->post('campaign_show_second',TRUE);
                $update_data['campaign_show_second'] = array (
                    'key' => 'campaign_show_second',
                    'type' => 'int',
                    'value' => $campaign_show_second
                );                
            };
            if ( isset( $_POST['campaign_start_date'] ) ) {
                $campaign_start_date = $this->input->post('campaign_start_date',TRUE);
                $update_data['campaign_start_date'] = array (
                    'key' => 'campaign_start_date',
                    'type' => 'string',
                    'value' => $campaign_start_date
                );                
            };
            if ( isset( $_POST['campaign_stop_date'] ) ) {
                $campaign_stop_date = $this->input->post('campaign_stop_date',TRUE);
                $update_data['campaign_stop_date'] = array (
                    'key' => 'campaign_stop_date',
                    'type' => 'string',
                    'value' => $campaign_stop_date
                );                
            };            
            
            $row = $this->campaign_model->out('id',array(
                'campaign_id' => $campaign_id
            ));
            
            if ( $row ) {
                // 이미 등록된 캠페인
                $update_data['campaign_id'] = $row[0]['campaign_id'];
                $this->campaign_model->update('update',$update_data);
            } else {
                // 캠페인 등록 필요
                $campaign_id = mt_rand();
                $row = $this->campaign_model->update('create',array(
                    'campaign_id' => $campaign_id,
                    'campaign_name' => $campaign_name,
                    'category_id' => $category_id,
                    'campaign_description' => $campaign_description,
                    'campaign_picture' => $campaign_picture,
                    'campaign_link' => $campaign_link,
                    'campaign_show_second' => $campaign_show_second,
                    'campaign_start_date' => $campaign_start_date,
                    'campaign_stop_date' => $campaign_stop_date,
                    'campaign_status' => 1,
                    'campaign_state' => $campaign_state
                ));
            }
            
            
            
            /*
            $row = $this->user_model->update('create',array(
                'user_id' => mt_rand(),
                'user_email' => '',                           
                'user_name' => $user_name,     
                'user_picture' => $user_picture,
                'user_loginid' => $this->input->post('user_tel',TRUE),           
                'user_pass' => $user_pass,
                'user_tel' => $this->input->post('user_tel',TRUE),                            
                'user_usim_number' => $this->input->post('user_usim_number',TRUE),
                'user_affiliation' => $user_affiliation,                                           
                'user_location' => $user_location,           
                'user_introduction' => $user_introduction,                           
                'user_license_front_picture' => $user_license_front_picture,                           
                'user_license_back_picture' => $user_license_back_picture,                                           
                'user_country' => $user_country,         
                'user_status' => $user_status,                                           
                'user_app_ver' => $user_app_ver,                                           
                'user_phone_name' => $user_phone_name,                                           
                'user_gcm_id' => $user_gcm_id,
                'user_apns_id' => $user_apns_id             
            ));
            */
            $outrow = array();
            
            if ( $row ) {
                $row = $this->campaign_model->out('id',array(
                    'campaign_id' => $campaign_id
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
            if ( isset($_POST['campaign_name']) ) {
                if ( 0 < strlen(strip_tags(form_error('campaign_name'))) ) {
                    //$validation['user_google_id'] = strip_tags(form_error('user_google_id'));
                    $validation['campaign_name'] = 102; //전달된 파라미터가 없음                    
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
		$this->load->model('campaign_model'); 
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
        if ( isset($_GET['campaign_id']) ) {
            $params_data['campaign_id'] = (int)$_GET['campaign_id'];            
        } else {
            $params_data['campaign_id'] = 0;
        };
        if ( isset($_GET['category_id']) ) {
            $params_data['category_id'] = (int)$_GET['category_id'];            
        } else {
            $params_data['category_id'] = 0;
        };
        
        $row = $this->campaign_model->out($type,$params_data);        
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