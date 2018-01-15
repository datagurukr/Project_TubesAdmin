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

class User extends CI_Controller {    
    
    function __construct() {
		parent::__construct();
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
        $config['next_link'] = '<i class="material-icons">Right</i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        /*이전*/
        
        $config['prev_link'] = '<i class="material-icons">Left</i>';
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
        $data['key'] = 'user';
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
            show_404();
        };
        $data['session_id'] = $session_id;
        
        /*******************
        data update query
        *******************/
        $set_data = array ();
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
        
        if ( 
            isset($_POST['user_ad_name']) &&
            isset($_POST['user_name']) &&
            isset($_POST['user_address']) &&
            isset($_POST['user_licensee_num']) &&
            isset($_POST['user_licensee_charge_name']) &&
            isset($_POST['user_licensee_charge_group']) &&
            isset($_POST['user_licensee_charge_status']) &&
            isset($_POST['user_licensee_charge_mobile']) &&
            isset($_POST['user_licensee_charge_email']) &&
            isset($_POST['user_licensee_charge_tel']) &&
            isset($_POST['user_ad_open_date']) &&
            isset($_POST['user_ad_close_date']) 
        ) {
            
            $user_google_id = '';
            $user_name = '';
            $user_picture = '';
            $user_country = '';
            $user_app_version_code = 0;
            $user_app_version_name = '';
            $user_device_os = '';
            $user_device_name = '';
            $user_device_version = '';
            $user_gcm_id = '';
            $user_apns_id = '';
            
            $user_ad_name = $this->input->post('user_ad_name',TRUE);
            $user_name = $this->input->post('user_name',TRUE);
            $user_address = $this->input->post('user_address',TRUE);
            $user_licensee_num = $this->input->post('user_licensee_num',TRUE);
            $user_licensee_charge_name = $this->input->post('user_licensee_charge_name',TRUE);
            $user_licensee_charge_group = $this->input->post('user_licensee_charge_group',TRUE);
            $user_licensee_charge_status = $this->input->post('user_licensee_charge_status',TRUE);
            $user_licensee_charge_mobile = $this->input->post('user_licensee_charge_mobile',TRUE);
            $user_licensee_charge_email = $this->input->post('user_licensee_charge_email',TRUE);
            $user_licensee_charge_tel = $this->input->post('user_licensee_charge_tel',TRUE);
            $user_ad_open_date = $this->input->post('user_ad_open_date',TRUE);
            $user_ad_close_date = $this->input->post('user_ad_close_date',TRUE);
            $user_id = mt_rand();
            
		    $this->load->model('user_model');   
            $this->load->model('campaign_model');                                        
            // 회원가입 필요
            $row = $this->user_model->update('create',array(
                'user_id' => $user_id,
                'user_google_id' => $user_google_id,
                'user_name' => $user_name,
                'user_picture' => $user_picture,
                'user_country' => $user_country,
                'user_ad_name' => $user_ad_name,
                'user_address' => $user_address,
                'user_licensee_num' => $user_licensee_num,
                'user_licensee_charge_name' => $user_licensee_charge_name,
                'user_licensee_charge_group' => $user_licensee_charge_group,
                'user_licensee_charge_status' => $user_licensee_charge_status,
                'user_licensee_charge_mobile' => $user_licensee_charge_mobile,
                'user_licensee_charge_email' => $user_licensee_charge_email,
                'user_licensee_charge_tel' => $user_licensee_charge_tel,
                'user_ad_open_date' => $user_ad_open_date,
                'user_ad_close_date' => $user_ad_close_date,              
                'user_app_version_code' => $user_app_version_code,
                'user_app_version_name' => $user_app_version_name,
                'user_device_os' => $user_device_os,
                'user_device_name' => $user_device_name,
                'user_device_version' => $user_device_version,
                'user_gcm_id' => $user_gcm_id,
                'user_apns_id' => $user_apns_id,
                'user_status' => 3,
                'user_state' => 1
            ));      
            
            if ( $row ) {
                
                // 캠페인 등록 필요
                $campaign_id = mt_rand();
                $row = $this->campaign_model->update('create',array(
                    'campaign_id' => $campaign_id,
                    'user_id' => $user_id,
                    'campaign_name' => $user_ad_name,
                    'category_id' => 0,
                    'campaign_description' => '',
                    'campaign_picture' => '',
                    'campaign_link' => '',
                    'campaign_show_second' => 0,
                    'campaign_start_date' => $user_ad_open_date,
                    'campaign_stop_date' => $user_ad_close_date,
                    'campaign_status' => 1,
                    'campaign_state' => 1
                ));                
                
            }
            
        };
        
        if ( isset($_FILES["user_campaign_picture"]) ) {
            ini_set('memory_limit','-1');        
            ini_set("post_max_size", "300M");
            ini_set("upload_max_filesize", "300M");    
            
            $ext = pathinfo($_FILES["user_campaign_picture"]["name"],PATHINFO_EXTENSION);
            $allowed_images =  array('jpg','png','jpeg','JPG','JPEG');
            $folder_name = FALSE;
            if ( in_array($ext,$allowed_images) ) {
                $folder_name = 'photo';
            };
            if ( $folder_name ) {
                if( !is_dir('./upload/'.$folder_name.'/') ) {
                    mkdir('./upload/'.$folder_name, 0777);
                };
                /*******************
                library
                *******************/
                $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|mp4';
                // 허용되는 확장자
                $config['upload_path'] = './upload/'.$folder_name.'/';			
                // 허용되는 파일의 최대 사이즈
                $config['max_size'] = '20000';
                // 이미지인 경우 허용되는 최대 폭
                $config['max_width']  = '0';
                // 이미지인 경우 허용되는 최대 높이sssss
                $config['max_height']  = '0';
                // 파일이름 암호화
                $config['encrypt_name']  = TRUE;
                $field_name = "user_campaign_picture";
                $this->load->library('upload', $config);
                if ( $this->upload->do_upload($field_name) ) {
                    $file_info = $this->upload->data();            
                    $file_info_name = $file_info['file_name'];
                    $file_custom_info = array (
                        'file_name' => $file_info['file_name'],
                        'file_path' => '/upload/'.$folder_name.'/'.$file_info['file_name']
                    );
                    
                    $user_id = $_POST['user_id'];
                    $campaign_id = $_POST['campaign_id'];
                    
                    $sql = "update user set user_ad_picture = '".$file_custom_info['file_name']."' where user_id = ".$user_id."";
                    $this->db->trans_begin();
                    $this->db->query($sql);
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                    } else {
                        $this->db->trans_commit();
                    };                                    
                    $sql = "update campaign set campaign_picture = '".$file_custom_info['file_name']."' where campaign_id = ".$campaign_id."";
                    $this->db->trans_begin();
                    $this->db->query($sql);
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                    } else {
                        $this->db->trans_commit();
                    };                                    
                    
                } else {
                };                
            }
        };         
        
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
        
        $user_id = 0;
        if ( isset($_GET['user_id']) ) {
            $user_id = (int)$_GET['user_id'];
            $data['user_id'] = $user_id;
        }
        
        
        $data['sort'] = '';
        $data['os'] = '';
        $data['sale'] = '';
        $data['country'] = '';
        $data['renewal'] = '';
        $data['ad_name'] = '';        
        if ( isset($_GET['sort']) ) {
            $data['sort'] = $_GET['sort'];
            $pagination_url = $pagination_url.'&sort='.$data['sort'];            
        }
        if ( isset($_GET['os']) ) {
            $data['os'] = $_GET['os'];
            $pagination_url = $pagination_url.'&os='.$data['os'];                        
        }
        if ( isset($_GET['sale']) ) {
            $data['sale'] = $_GET['sale'];
            $pagination_url = $pagination_url.'&sale='.$data['sale'];                        
        }
        if ( isset($_GET['country']) ) {
            $data['country'] = $_GET['country'];
            $pagination_url = $pagination_url.'&country='.$data['country'];                        
        }        
        if ( isset($_GET['renewal']) ) {
            $data['renewal'] = $_GET['renewal'];
            $pagination_url = $pagination_url.'&renewal='.$data['renewal'];                        
        }        
        if ( isset($_GET['ad_name']) ) {
            $data['ad_name'] = $_GET['ad_name'];
            $pagination_url = $pagination_url.'&ad_name='.$data['ad_name'];                        
        }        
        
        if ( isset($_GET['user_del_id']) ) {
            foreach ( $_GET['user_del_id'] as $user_del_id_row ) {
                $sql = "update user set user_state = 0 where user_id = ".$user_del_id_row."";
                $this->db->query($sql);                
            }
        }
        
        $result = FALSE;
        $result_count = 0;
        $result = $this->admin_model->out($data['sub_key'],array(
            'renewal' => $data['renewal'],
            'ad_name' => $data['ad_name'],
            'sort' => $data['sort'],
            'os' => $data['os'],
            'sale' => $data['sale'],
            'country' => $data['country'],
            'session_id' => $session_id,            
            'user_id' => $user_id,
            'p' => $p,
            'q' => $q,
            'order' => $order,
            'target' => $target,
            'order_target' =>$order_target
        ));
        $result_count = $this->admin_model->out($data['sub_key'],array(
            'renewal' => $data['renewal'],
            'ad_name' => $data['ad_name'],
            'sort' => $data['sort'],
            'os' => $data['os'],
            'sale' => $data['sale'],
            'country' => $data['country'],            
            'session_id' => $session_id,
            'user_id' => $user_id,            
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
        $this->global_pagination($pagination_count,'/admin/user/list/'.$item_status.'?',$pagination_url);                        
        
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
                $data['container'] = $this->load->view('/admin/user/list_1', $data, TRUE);
            } elseif ( $item_status == 2 ) {
                $data['container'] = $this->load->view('/admin/user/list_2', $data, TRUE);
            } elseif ( $item_status == 3 ) {
                $data['container'] = $this->load->view('/admin/user/list_3', $data, TRUE);
            } elseif ( $item_status == 4 ) {
                $data['container'] = $this->load->view('/admin/user/list_4', $data, TRUE);
            } elseif ( $item_status == 5 ) {
                $data['container'] = $this->load->view('/admin/user/list_5', $data, TRUE);
            } elseif ( $item_status == 6 ) {
                $data['container'] = $this->load->view('/admin/user/list_6', $data, TRUE);                
            } else {
                show_404();                
            };
            $this->load->view('/admin/body', $data, FALSE);            
        };
    }    
    
}
?>