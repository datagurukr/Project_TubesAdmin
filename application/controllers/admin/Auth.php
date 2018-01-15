<?php
/***********************************
타임:          Class
이름:          Manager
용도:          Manager 템플렛 클래스 ( WEB 버전 )
작성자:         전병훈
생성일자:       2017.05.10 21:40:35
업데이트일자:   
Var 1.0

status 200 : 정상
status 400 : 서버가 요청의 구문을 인식하지 못했다. ( 파라미터가 유효하지 않은 경우 )
status 401 : 이 요청은 인증이 필요하다. 서버는 로그인이 필요한 페이지에 대해 이 요청을 제공할 수 있다.
status 500 : 서버에 오류가 발생하여 요청을 수행할 수 없다.

************************************/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define("GOOGLE_API_KEY","AAAAr2hAraA:APA91bHgxcrudChuaOEgvEj7GmETl-27-Dn3FD2lFIVl1wr1cFObbi9afHS3WFGDJxfJmfr8XqPr3_nNnJegnZpTBovT1kHWv13v7jAMBsL70DGdbmUp9crKGlndNA_EwKnSkJtY7jxA");

class Auth extends CI_Controller {    
    
    function __construct() {
		parent::__construct();
	}
    
    function loggedin ( $user_id = 0, $user_status = 0 ) {
        if ( 0 < $user_id ) {
            // 로그인 세션 처리 시작
            if ( $user_status == 9 ) {
                // 관리자
                $session_data = array(
                    'users_id'  => $user_id,
                    'logged_in' => TRUE,
                    'admin'  => TRUE
                );
            } else {
                // 일반회원
                $session_data = array(
                    'users_id'  => $user_id,
                    'logged_in' => TRUE
                );                
            };
            $this->session->set_userdata($session_data);   
        } else {
            $this->session->sess_destroy();            
        }
        
        /*******************
        HTTP_REFERER
        *******************/
        $http_referer = @$_SERVER['HTTP_REFERER'];
        
        /*******************
        library load
        *******************/
		$this->load->helper('url');
        if ( strpos( $http_referer, 'logout' ) !== false ) {  
            redirect('/admin', 'refresh');
        } else {
            if ( strpos( $http_referer, 'login' ) ) {
                redirect('/admin', 'refresh');
            } else {
                redirect('/admin', 'refresh');                
                //redirect($http_referer, 'refresh');                
            }
        };  
    }    
    
    function global_pagination ($count,$url,$query_url = false, $details = false) {
        /*******************
        library load
        *******************/
        $this->load->library('pagination');
        $config['base_url'] = $url.$query_url;
        $config['total_rows'] = $count;
        if ( $details ) {
            $config['uri_segment'] = 5;
        } elseif ( $query_url ) {
            $config['uri_segment'] = 6;
        } else {
            $config['uri_segment'] = 4;
        };
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE; /*페이지개수 x 인덱스로 지정*/ 
        $config['page_query_string'] = TRUE; /*페이지개수 x 인덱스로 지정*/         
        $config['query_string_segment'] = 'p';
        /*pagination Customizing*/
        /*pagination ul tag*/
        $config['full_tag_open'] = '<ul class="pagination center">';
        $config['full_tag_close'] = '</ul>';
        /*처음으로
        $config['first_tag_open'] = '<li class="disabled">';
        $config['first_tag_close'] = '</li>';
        */
        /*끝으로
        $config['last_tag_open'] = '<li class="nation-list last">';
        $config['last_tag_close'] = '</li>';
        */
        /*다음*/
        $config['next_link'] = '<i class="material-icons">chevron_right</i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        /*이전*/
        
        $config['prev_link'] = '<i class="material-icons">chevron_left</i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';		
        /*현제페이지*/
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';		
        /*다음링크번호*/
        $config['num_tag_open'] = '<li class="waves-effect">';
        $config['num_tag_close'] = '</li>';    
        $this->pagination->initialize($config);
    }      
    
    function index ( $item_status = 0, $item_id = 0 ) {   

        /*******************
        data
        *******************/
        $data = array();         
        
        /*******************
        page key
        *******************/
        $data['key'] = 'auth';
        $data['sub_key'] = $data['key'].'_'.$item_status;
        
        /*******************
        response
        *******************/
        $response = array();        
        
        /*******************
        ajax 통신 체크
        *******************/
        $ajax = FALSE;
        if ((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            ||
            (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['REQUEST_METHOD'] == 'GET')) {
            $ajax = TRUE;
        };
        
        /*******************
        session
        *******************/
        $data['session'] = $this->session->all_userdata();  
        $data['session_id'] = 0;
        $session_id = 0;
        if ( isset($data['session']['logged_in']) && isset($data['session']['admin']) ) {
            if ( $data['session']['admin'] ) {
                if ( isset($data['session']['admin']) ) {
                    $session_id = $data['session']['users_id'];
                };
            } else {
                $session_id = 0;
            };
        } else {
            $session_id = 0;
        };
        if ( $session_id == 0 ) {
            //show_404();
        };
        if ( $item_status == 4 && $session_id == 0 ) {
            show_404();            
        }
        $data['session_id'] = $session_id;
        
        /*******************
        data update query
        *******************/
        $set_data = array ();
        $set_data['user_id'] = $session_id;
        if ( isset($_POST['user_licensee_charge_name']) ) {
		    $this->load->model('user_model');            
            $set_data['user_licensee_charge_name'] = array (
                'key' => 'user_licensee_charge_name',
                'type' => 'string',
                'value' => $this->input->post('user_licensee_charge_name',TRUE)
            );
            if ( $this->user_model->update('update',$set_data) ) {
                $response['update'] = TRUE;
            } else {
                $response['update'] = FALSE;
            };        
        };
        
        if ( isset($_POST['user_licensee_charge_mobile']) ) {
		    $this->load->model('user_model');            
            $set_data['user_licensee_charge_mobile'] = array (
                'key' => 'user_licensee_charge_mobile',
                'type' => 'string',
                'value' => $this->input->post('user_licensee_charge_mobile',TRUE)
            );
            if ( $this->user_model->update('update',$set_data) ) {
                $response['update'] = TRUE;
            } else {
                $response['update'] = FALSE;
            };        
        };
        
        if ( isset($_POST['user_licensee_charge_email']) ) {
		    $this->load->model('user_model');            
            $set_data['user_licensee_charge_email'] = array (
                'key' => 'user_licensee_charge_email',
                'type' => 'string',
                'value' => $this->input->post('user_licensee_charge_email',TRUE)
            );
            if ( $this->user_model->update('update',$set_data) ) {
                $response['update'] = TRUE;
            } else {
                $response['update'] = FALSE;
            };        
        };
        
        if ( isset($_POST['user_licensee_charge_group']) ) {
		    $this->load->model('user_model');            
            $set_data['user_licensee_charge_group'] = array (
                'key' => 'user_licensee_charge_group',
                'type' => 'string',
                'value' => $this->input->post('user_licensee_charge_group',TRUE)
            );
            if ( $this->user_model->update('update',$set_data) ) {
                $response['update'] = TRUE;
            } else {
                $response['update'] = FALSE;
            };        
        };
        
        if ( isset($_POST['user_licensee_charge_status']) ) {
		    $this->load->model('user_model');            
            $set_data['user_licensee_charge_status'] = array (
                'key' => 'user_licensee_charge_status',
                'type' => 'string',
                'value' => $this->input->post('user_licensee_charge_status',TRUE)
            );
            if ( $this->user_model->update('update',$set_data) ) {
                $response['update'] = TRUE;
            } else {
                $response['update'] = FALSE;
            };        
        };
        
        if ( isset($_POST['user_licensee_charge_tel']) ) {
		    $this->load->model('user_model');            
            $set_data['user_licensee_charge_tel'] = array (
                'key' => 'user_licensee_charge_tel',
                'type' => 'string',
                'value' => $this->input->post('user_licensee_charge_tel',TRUE)
            );
            if ( $this->user_model->update('update',$set_data) ) {
                $response['update'] = TRUE;
            } else {
                $response['update'] = FALSE;
            };        
        };
        
        if ( isset($_POST['user_password']) && isset($_POST['user_re_password']) ) {
		    $this->load->model('user_model');            
            $set_data['user_password'] = array (
                'key' => 'user_password',
                'type' => 'string',
                'value' => $this->input->post('user_password',TRUE)
            );
            if ( $this->user_model->update('update',$set_data) ) {
                $response['update'] = TRUE;
            } else {
                $response['update'] = FALSE;
            };        
        };
        
        
        /*
        if ( isset($_POST['user_id']) && isset($_POST['user_state']) ) {
		    $this->load->model('user_model');            
            $set_data['user_id'] = (int)$this->input->post('user_id',TRUE);
            $set_data['user_state'] = array (
                'key' => 'user_state',
                'type' => 'int',
                'value' => $this->input->post('user_state',TRUE)
            );
            if ( $this->user_model->update('update',$set_data) ) {
                $response['update'] = TRUE;
            } else {
                $response['update'] = FALSE;
            };        
        }
        */
        
        if ( $item_status == 3 ) {
            $this->loggedin(0);                                    
        }
        
        if ( 
            isset($_POST['user_email']) &&
            isset($_POST['user_password']) &&
            isset($_POST['auth'])
        ) {
            if ( 0 < strlen($_POST['user_email']) ) {  

                $user_email = $this->input->post('user_email',TRUE);
                $user_password = $this->input->post('user_password',TRUE);
                
                if ( $_POST['auth'] == 1 ) {
                    $sql = "select * from user where user_email = '".$user_email."' and user_password = '".sha1($user_password)."' and user_state = 1 and user_status = 9";
                    $query = $this->db->query($sql);
                    if( 0 < $query->num_rows() ){
                        $result_data = $query->result_array();
                        
                        $sql = "
                        insert into loginlog 
                        (loginlog_id,loginlog_user_id,loginlog_ip_address,loginlog_register_date,loginlog_update_date)
                        values
                        (".mt_rand().",".$result_data[0]['user_id'].",'".$_SERVER['REMOTE_ADDR']."',now(),now())
                        ";
                        
                        $this->db->trans_begin();
                        $this->db->query($sql);
                        if ($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback();
                        } else {
                            $this->db->trans_commit();
                        };                                        
                        
                        $this->loggedin($result_data[0]['user_id'],$result_data[0]['user_status']);
                    };
                } else {
                    
                    $this->load->model('user_model');
                    
                    $user_id = mt_rand();
                    $user_google_id = 's';
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
                    
                    // 회원가입 필요
                    $row = $this->user_model->update('create',array(
                        'user_id' => $user_id,
                        'user_email' => $user_email,
                        'user_password' => $user_password,
                        'user_google_id' => $user_google_id,
                        'user_name' => $user_name,
                        'user_picture' => $user_picture,
                        'user_country' => $user_country,
                        'user_app_version_code' => 0,
                        'user_app_version_name' => $user_app_version_name,
                        'user_device_os' => $user_device_os,
                        'user_device_name' => 0,
                        'user_device_version' => 0,
                        'user_gcm_id' => $user_gcm_id,
                        'user_apns_id' => $user_apns_id,
                        'user_status' => 1,
                        'user_state' => 0
                    ));                    
                    
                };
                
                
                
                
                /*
                $post_action = 0;
                $post_status = 0;                
                if ( isset($_POST['post_action']) ) {
                    $post_action = $this->input->post('post_action',TRUE);
                }
                if ( isset($_POST['post_status']) ) {
                    $post_status = $this->input->post('post_status',TRUE);
                }
                
                $post_file = array();
                $post_file = serialize($post_file);
                $sql = "
                insert into post 
                (post_id,user_id,post_action,post_status,post_name,post_title,post_article,post_file,post_target,post_register_date,post_update_date)
                values
                (
                    ".mt_rand().",
                    ".$session_id.",
                    ".$post_action.",
                    ".$post_status.",                    
                    '".$this->input->post('post_name',TRUE)."',                    
                    '".$this->input->post('post_title',TRUE)."',
                    '".$this->input->post('post_article',TRUE)."',
                    '".$post_file."',
                    '".$this->input->post('post_target',TRUE)."',                    
                    now(),
                    now()
                )
                ";
                $this->db->trans_begin();
                $this->db->query($sql);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }; 
                */
            }            
            
        }
        
        /*******************
        data query
        *******************/
		$this->load->model('admin_model');
        
        if ( isset($_GET['p']) ) {
            $p = (int)$_GET['p'];
            if ( $p <= 0 ) {
                $p = 1;
            };
        } else {
            $p = 1;
        };
        $data['p'] = $p;        
        $p = (($p * 2) * 10) - 20;  
        $pagination_url = '';        
        if ( isset($_GET['q']) ) {
            $q = $_GET['q'];
            $pagination_url = $pagination_url.'&q='.$q;
        } else {
            $q = '';
        };        
        $data['q'] = $q;
        
        if ( isset($_GET['target']) ) {
            $target = $_GET['target'];
            $pagination_url = $pagination_url.'&target='.$target;            
        } else {
            $target = '';
        };        
        $data['target'] = $target;
        
        if ( isset($_GET['yearmonth']) ) {
            $yearmonth = $_GET['yearmonth'];
            $pagination_url = $pagination_url.'&yearmonth='.$yearmonth;            
        } else {
            $yearmonth = '';
        };
        $data['yearmonth'] = $yearmonth;  
        
        if ( isset($_GET['order']) ) {
            if ( $_GET['order'] == 'desc' || $_GET['order'] == 'asc' ) {
                $order = $_GET['order'];
            } else {
                $order = 'desc';
            };
            $pagination_url = $pagination_url.'&order='.$order;
        } else {
            $order = 'desc';
        };
        $data['order'] = $order;
        
        if ( isset($_GET['order_target']) ) {
            $order_target = $_GET['order_target'];
            $pagination_url = $pagination_url.'&order_target='.$order_target;
        } else {
            $order_target = '';
        };        
        $data['order_target'] = $order_target;        
        
        $result = FALSE;
        $result_count = 0;
        $result = $this->admin_model->out($data['sub_key'],array(
            'user_id' => $session_id,
            'p' => $p,
            'q' => $q,
            'order' => $order,
            'target' => $target,
            'order_target' =>$order_target
        ));
        $result_count = $this->admin_model->out($data['sub_key'],array(
            'user_id' => $session_id,
            'p' => $p,
            'q' => $q,
            'order' => $order,            
            'target' => $target,
            'order_target' =>$order_target,
            'count' => TRUE
        ));  
        
        $pagination_count = 0;
        if ( $result_count ) {
            $pagination_count = $result_count[0]['cnt'];            
        };
        $this->global_pagination($pagination_count,'/admin/auth/list/'.$item_status.'?',$pagination_url);                        
        
        if ( $result ) {
            $response['status'] = 200;                    
            $response['data'] = array(
                'out' => $result,
                'out_cnt' => $pagination_count,               
                'count' => count($result)
            );        
        } else {
            $response['status'] = 401;
        };                 
        
        $data['response'] = $response;      
        
        if ( $ajax ) {
        } else {
            if ( $item_status == 1 ) {
                $data['container'] = $this->load->view('/admin/auth/list_1', $data, TRUE);
            } elseif ( $item_status == 2 ) {
                $data['container'] = $this->load->view('/admin/auth/list_2', $data, TRUE);
            } elseif ( $item_status == 4 ) {
                $data['container'] = $this->load->view('/admin/auth/list_4', $data, TRUE);                
            } else {
                show_404();                
            };

            if ( $item_status == 1 ) {
                $this->load->view('/admin/auth_body', $data, FALSE);            
            } else {
                $data['container'] = $this->load->view('/admin/auth/list_4', $data, TRUE);                
            };
        };
    }    
    
}
?>