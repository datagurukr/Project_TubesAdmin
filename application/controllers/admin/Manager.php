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

class Manager extends CI_Controller {    
    
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
        $data['key'] = 'manager';
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
        
        
        // ios_applog_version / ios_applog_date / ios_applog_description / ios_applog_dev / ios_applog_write
        if ( 
            isset ( $_POST['ios_applog_version'] ) &&
            isset ( $_POST['ios_applog_date'] ) &&
            isset ( $_POST['ios_applog_description'] ) &&
            isset ( $_POST['ios_applog_dev'] ) &&
            isset ( $_POST['ios_applog_writer'] )            
        ) {
            if ( 0 < strlen($_POST['ios_applog_version']) ) {
                $sql = "
                insert into applog 
                (applog_id,applog_os,applog_version,applog_date,applog_description,applog_writer,applog_dev,applog_register_date,applog_update_date)
                values
                (
                    ".mt_rand().",
                    1,
                    '".$this->input->post('ios_applog_version',TRUE)."',
                    '".$this->input->post('ios_applog_date',TRUE)."',
                    '".$this->input->post('ios_applog_description',TRUE)."',                    
                    '".$this->input->post('ios_applog_writer',TRUE)."',                    
                    '".$this->input->post('ios_applog_dev',TRUE)."',
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
            };
        };
        
        if ( 
            isset ( $_POST['android_applog_version'] ) &&
            isset ( $_POST['android_applog_date'] ) &&
            isset ( $_POST['android_applog_description'] ) &&
            isset ( $_POST['android_applog_dev'] ) &&
            isset ( $_POST['android_applog_writer'] )            
        ) {
            if ( 0 < strlen($_POST['android_applog_version']) ) {
                $sql = "
                insert into applog 
                (applog_id,applog_os,applog_version,applog_date,applog_description,applog_writer,applog_dev,applog_register_date,applog_update_date)
                values
                (
                    ".mt_rand().",
                    2,
                    '".$this->input->post('android_applog_version',TRUE)."',
                    '".$this->input->post('android_applog_date',TRUE)."',
                    '".$this->input->post('android_applog_description',TRUE)."',                    
                    '".$this->input->post('android_applog_writer',TRUE)."',                    
                    '".$this->input->post('android_applog_dev',TRUE)."',
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
            };
        };
        
        if ( 
            isset ( $_POST['appdownload_ios'] ) &&
            isset ( $_POST['appdownload_android'] )           
        ) {
            if ( 0 < strlen($_POST['appdownload_ios']) ) {
                $sql = "
                insert into appdownload 
                (appdownload_id,appdownload_ios,appdownload_android,appdownload_register_date,appdownload_update_date)
                values
                (
                    ".mt_rand().",
                    '".(int)$this->input->post('appdownload_ios',TRUE)."',
                    '".(int)$this->input->post('appdownload_android',TRUE)."',
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
            };           
        };
        
        if (
            isset( $_POST['storage_space'] ) &&
            isset( $_POST['storage_space_use'] )            
        ) {
            if ( 0 < strlen($_POST['storage_space']) ) {     
                $sql = "
                insert into storage 
                (storage_id,storage_space,storage_space_use,storage_register_date,storage_update_date)
                values
                (
                    ".mt_rand().",
                    '".(int)$this->input->post('storage_space',TRUE)."',
                    '".(int)$this->input->post('storage_space_use',TRUE)."',
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
            }
        };
        
        if (
            isset( $_POST['traffic_space'] ) &&
            isset( $_POST['traffic_space_use'] )            
        ) {
            if ( 0 < strlen($_POST['traffic_space']) ) {     
                $sql = "
                insert into traffic 
                (traffic_id,traffic_space,traffic_space_use,traffic_register_date,traffic_update_date)
                values
                (
                    ".mt_rand().",
                    '".(int)$this->input->post('traffic_space',TRUE)."',
                    '".(int)$this->input->post('traffic_space_use',TRUE)."',
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
            }
        };       
        
        if (
            isset( $_POST['server_name'] ) &&
            isset( $_POST['server_service_name'] ) &&
            isset( $_POST['server_open'] ) &&
            isset( $_POST['server_close'] ) &&
            isset( $_POST['server_tel'] )            
        ) {
            if ( 0 < strlen($_POST['server_name']) ) {     
                $sql = "
                insert into server 
                (server_id,server_name,server_service_name,server_open,server_close,server_tel,server_register_date,server_update_date)
                values
                (
                    ".mt_rand().",
                    '".$this->input->post('server_name',TRUE)."',
                    '".$this->input->post('server_service_name',TRUE)."',
                    '".$this->input->post('server_open',TRUE)."',
                    '".$this->input->post('server_close',TRUE)."',                    
                    '".$this->input->post('server_tel',TRUE)."',                                        
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
            }
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
        
        
        $data['date'] = date("Y-m-d");
        $data['range'] = '';
        $data['country'] = 'ALL';
        $data['ad_name'] = '';
        if ( isset($_GET['range']) ) {
            $data['range'] = $_GET['range'];
        } else {
            $data['range'] = 'day';
        };        
        if ( isset($_GET['date']) ) {
            $data['date'] = $_GET['date'];
        };        
        if ( isset($_GET['country']) ) {
            $data['country'] = $_GET['country'];
        };        
        if ( isset($_GET['ad_name']) ) {
            $data['ad_name'] = $_GET['ad_name'];
        };        
        
        $result = $this->admin_model->out($data['sub_key'],array(
            'date' => $data['date'],
            'range' => $data['range'],
            'country' => $data['country'],
            'user_id' => $session_id,
            'p' => $p,
            'q' => $q,
            'order' => $order,
            'target' => $target,
            'order_target' =>$order_target
        ));
        $result_count = $this->admin_model->out($data['sub_key'],array(
            'date' => $data['date'],
            'range' => $data['range'],
            'country' => $data['country'],
            'user_id' => $session_id,
            'p' => $p,
            'q' => $q,
            'order' => $order,            
            'target' => $target,
            'order_target' =>$order_target,
            'count' => TRUE
        ));    
        
        if ( $item_status == 1 ) {
            $data['result'] = FALSE;
            $filename = './assets/file/manager_'.$item_status.'.json';
            if ( isset($_POST['content']) ) {
                $content = $this->input->post('content',TRUE);
                $file = fopen($filename, "w") or die("Unable to open file!");
                fwrite($file, $content);
                fclose($file);
            }

            if (file_exists($filename)) {
                $file = fopen($filename,"r"); 
                $result = fread($file, filesize($filename)); fclose($file);
            }  
            $data['result'] = $result;
            
            $sql = "select * from loginlog order by loginlog_register_date desc limit 10000";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_log'] = $query->result_array();
            } else {
                $data['result_log'] = FALSE;
            };                    
            
            $sql = "select * from user where user_status = 9 and user_state = 1 limit 1";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_admin'] = $query->result_array();
            } else {
                $data['result_admin'] = FALSE;
            };        
            
            $sql = "select * from applog where applog_os = 1 order by applog_register_date desc limit 10000";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_applog_ios'] = $query->result_array();
            } else {
                $data['result_applog_ios'] = FALSE;
            };            
            $sql = "select * from applog where applog_os = 2 order by applog_register_date desc limit 10000";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_applog_android'] = $query->result_array();
            } else {
                $data['result_applog_android'] = FALSE;
            };            
            
            $sql = "select * from appdownload order by appdownload_register_date desc limit 10000";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_appdownload'] = $query->result_array();
            } else {
                $data['result_appdownload'] = FALSE;
            };               
        } elseif ( $item_status == 2 ) {   
            
            if ( $data['range'] == 'day' ) {
                $where = "
                and
                ( date_format('".$data['date']."','%Y%m%d') = date_format(user_register_date,'%Y%m%d') )
                ";
            } elseif ( $data['range'] == 'week' ) {
                $where = "
                and
                ( floor(date_format('".$data['date']."','%d') / 7 ) +1 = floor(date_format(user_register_date,'%d') / 7 ) +1 )
                and
                ( date_format('".$data['date']."','%Y%m') = date_format(user_register_date,'%Y%m') )
                ";
            } else {
                $where = "
                and
                ( date_format('".$data['date']."','%Y%m') = date_format(user_register_date,'%Y%m') )
                ";
            }            
            
            if ( $data['country'] == 'all' || $data['country'] == 'ALL' ) {
            } else {
                $where = $where."and upper(user_country) = upper('".$data['country']."')";
            };
            
            //user_country
            $data['result_appdownload'] = FALSE;
            
            $sql = "
            select count(*) as cnt from user 
            where
            upper(user_device_os) = upper('android')
            ".$where."
            ";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_appdownload_android'] = $query->result_array();
            } else {
                $data['result_appdownload_android'] = FALSE;
            };        
            
            $sql = "
            select count(*) as cnt from user 
            where
            upper(user_device_os) = upper('ios')
            ".$where."
            ";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_appdownload_ios'] = $query->result_array();
            } else {
                $data['result_appdownload_ios'] = FALSE;
            };                    
            
            
            if ( $data['range'] == 'day' ) {
                $where = "
                and
                ( date_format('".$data['date']."','%Y%m%d') = date_format(applog_register_date,'%Y%m%d') )
                ";
            } elseif ( $data['range'] == 'week' ) {
                $where = "
                and
                ( floor(date_format('".$data['date']."','%d') / 7 ) +1 = floor(date_format(applog_register_date,'%d') / 7 ) +1 )
                and
                ( date_format('".$data['date']."','%Y%m') = date_format(applog_register_date,'%Y%m') )
                ";
            } else {
                $where = "
                and
                ( date_format('".$data['date']."','%Y%m') = date_format(applog_register_date,'%Y%m') )
                ";
            }
            $sql = "select * 
                    from applog where 
                    applog_os = 1
                    ".$where."
                    order by applog_register_date desc limit 1";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_applog_ios'] = $query->result_array();
            } else {
                $data['result_applog_ios'] = FALSE;
            };        
            if ( $data['range'] == 'day' ) {
                $where = "
                and
                ( date_format('".$data['date']."','%Y%m%d') = date_format(applog_register_date,'%Y%m%d') )
                ";
            } elseif ( $data['range'] == 'week' ) {
                $where = "
                and
                ( floor(date_format('".$data['date']."','%d') / 7 ) +1 = floor(date_format(applog_register_date,'%d') / 7 ) +1 )
                and
                ( date_format('".$data['date']."','%Y%m') = date_format(applog_register_date,'%Y%m') )
                ";
            } else {
                $where = "
                and
                ( date_format('".$data['date']."','%Y%m') = date_format(applog_register_date,'%Y%m') )
                ";
            }
            $sql = "select * from applog where applog_os = 2 ".$where." order by applog_register_date desc limit 1";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_applog_android'] = $query->result_array();
            } else {
                $data['result_applog_android'] = FALSE;
            };    
            if ( $data['range'] == 'day' ) {
                $where = "
                where
                ( date_format('".$data['date']."','%Y%m%d') = date_format(appdownload_register_date,'%Y%m%d') )
                ";
            } elseif ( $data['range'] == 'week' ) {
                $where = "
                where
                ( floor(date_format('".$data['date']."','%d') / 7 ) +1 = floor(date_format(appdownload_register_date,'%d') / 7 ) +1 )
                and
                ( date_format('".$data['date']."','%Y%m') = date_format(appdownload_register_date,'%Y%m') )
                ";
            } else {
                $where = "
                where
                ( date_format('".$data['date']."','%Y%m') = date_format(appdownload_register_date,'%Y%m') )
                ";
            }            
            
            if ( $data['country'] == 'all' || $data['country'] == 'ALL' ) {
            } else {
                $where = $where.'';
            }
            
            
            $sql = "select * from appdownload ".$where." order by appdownload_register_date desc limit 1";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_appdownload'] = $query->result_array();
            } else {
                $data['result_appdownload'] = FALSE;
            };            
        } elseif ( $item_status == 3 ) {  
            
            if ( $data['range'] == 'day' ) {
                $where = "
                and
                ( date_format('".$data['date']."','%Y%m%d') = date_format(user_register_date,'%Y%m%d') )
                ";
            } elseif ( $data['range'] == 'week' ) {
                $where = "
                and
                ( floor(date_format('".$data['date']."','%d') / 7 ) +1 = floor(date_format(user_register_date,'%d') / 7 ) +1 )
                and
                ( date_format('".$data['date']."','%Y%m') = date_format(user_register_date,'%Y%m') )
                ";
            } else {
                $where = "
                and
                ( date_format('".$data['date']."','%Y%m') = date_format(user_register_date,'%Y%m') )
                ";
            }            
            
            if ( $data['country'] == 'all' || $data['country'] == 'ALL' ) {
            } else {
                $where = $where."and upper(user_country) = upper('".$data['country']."')";
            };
            
            if ( strlen($data['ad_name']) ) {
                $where = $where."and user.user_ad_name like '%".$data['ad_name']."%'";                
            } else {
            };            
            
            
            $sql = "
            select count(*) as cnt from user 
            where
            user.user_status = 3      
            ".$where."
            ";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_add_user'] = $query->result_array();
            } else {
                $data['result_add_user'] = FALSE;
            };        
            
            $sql = "
            select count(*) as cnt from user 
            where
            user.user_status = 3
            ".$where."
            ";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_add'] = $query->result_array();
            } else {
                $data['result_add'] = FALSE;
            };                    
            
        } elseif ( $item_status == 4 ) {
            $sql = "select * from applog where applog_os = 1 order by applog_register_date desc limit 1";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_applog_ios'] = $query->result_array();
            } else {
                $data['result_applog_ios'] = FALSE;
            };            
            $sql = "select * from applog where applog_os = 2 order by applog_register_date desc limit 1";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_applog_android'] = $query->result_array();
            } else {
                $data['result_applog_android'] = FALSE;
            };            
            $sql = "select * from appdownload order by appdownload_register_date desc limit 1";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_appdownload'] = $query->result_array();
            } else {
                $data['result_appdownload'] = FALSE;
            };
        } elseif ( $item_status == 5 ) {       
            
            if ( $data['range'] == 'day' ) {
                $where = "
                where
                ( date_format('".$data['date']."','%Y%m%d') = date_format(storage_register_date,'%Y%m%d') )
                ";
            } elseif ( $data['range'] == 'week' ) {
                $where = "
                where
                ( floor(date_format('".$data['date']."','%d') / 7 ) +1 = floor(date_format(storage_register_date,'%d') / 7 ) +1 )
                and
                ( date_format('".$data['date']."','%Y%m') = date_format(storage_register_date,'%Y%m') )
                ";
            } else {
                $where = "
                where
                ( date_format('".$data['date']."','%Y%m') = date_format(storage_register_date,'%Y%m') )
                ";
            }            
            $sql = "select
            
            sum(storage_space) as storage_space,
            sum(storage_space_use) as storage_space_use
            
            from storage ".$where." order by storage_register_date desc";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_storage'] = $query->result_array();
            } else {
                $data['result_storage'] = FALSE;
            };    
            
            if ( $data['range'] == 'day' ) {
                $where = "
                where
                ( date_format('".$data['date']."','%Y%m%d') = date_format(traffic_register_date,'%Y%m%d') )
                ";
            } elseif ( $data['range'] == 'week' ) {
                $where = "
                where
                ( floor(date_format('".$data['date']."','%d') / 7 ) +1 = floor(date_format(traffic_register_date,'%d') / 7 ) +1 )
                and
                ( date_format('".$data['date']."','%Y%m') = date_format(traffic_register_date,'%Y%m') )
                ";
            } else {
                $where = "
                where
                ( date_format('".$data['date']."','%Y%m') = date_format(traffic_register_date,'%Y%m') )
                ";
            }              
            $sql = "select 
            
            sum(traffic_space) as traffic_space,
            sum(traffic_space_use) as traffic_space_use            
            
            from traffic ".$where." order by traffic_register_date desc limit 1";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_traffic'] = $query->result_array();
            } else {
                $data['result_traffic'] = FALSE;
            }; 
            $sql = "select * from server order by server_register_date desc limit 1";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_server'] = $query->result_array();
            } else {
                $data['result_server'] = FALSE;
            }; 
        } elseif ( $item_status == 6 ) {            
            $sql = "select * from storage order by storage_register_date desc limit 1";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_storage'] = $query->result_array();
            } else {
                $data['result_storage'] = FALSE;
            };                        
            $sql = "select * from traffic order by traffic_register_date desc limit 1";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_traffic'] = $query->result_array();
            } else {
                $data['result_traffic'] = FALSE;
            }; 
            $sql = "select * from server order by server_register_date desc limit 1";
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                $data['result_server'] = $query->result_array();
            } else {
                $data['result_server'] = FALSE;
            }; 
        }
        

        
        $pagination_count = 0;
        if ( $result_count ) {
            $pagination_count = $result_count[0]['cnt'];            
        };
        $this->global_pagination($pagination_count,'/admin/manager/list/'.$item_status.'?',$pagination_url);                        
        
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
                $data['container'] = $this->load->view('/admin/manager/list_1', $data, TRUE);
            } elseif ( $item_status == 2 ) {
                $data['container'] = $this->load->view('/admin/manager/list_2', $data, TRUE);
            } elseif ( $item_status == 3 ) {
                $data['container'] = $this->load->view('/admin/manager/list_3', $data, TRUE);
            } elseif ( $item_status == 4 ) {
                $data['container'] = $this->load->view('/admin/manager/list_4', $data, TRUE);                
            } elseif ( $item_status == 5 ) {
                $data['container'] = $this->load->view('/admin/manager/list_5', $data, TRUE);                
            } elseif ( $item_status == 6 ) {
                $data['container'] = $this->load->view('/admin/manager/list_6', $data, TRUE);                                
            } else {
                show_404();                
            };
            $this->load->view('/admin/body', $data, FALSE);            
        };
    }    
    
}
?>