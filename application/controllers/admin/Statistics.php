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

class Statistics extends CI_Controller {    
    
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
        $data['key'] = 'statistics';
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
        $data['last_date'] = date("Y-m-d");        
        $last_date =date("Y-m-d",strtotime("-3 day"));
        $data['range'] = '';
        $data['country'] = 'ALL';
        $data['ad_name'] = '';
        $data['category_id'] = 0;        
        if ( isset($_GET['range']) ) {
            $data['range'] = $_GET['range'];
        } else {
            $data['range'] = 'day';
        };        
        if ( isset($_GET['date']) ) {
            $data['date'] = $_GET['date'];
        };        
        if ( isset($_GET['category_id']) ) {
            $data['category_id'] = $_GET['category_id'];
        };                
        if ( isset($_GET['country']) ) {
            $data['country'] = $_GET['country'];
        };        
        if ( isset($_GET['ad_name']) ) {
            $data['ad_name'] = $_GET['ad_name'];
        };        
        
        if ( $data['range'] == 'day' ) {
            $data['last_date'] = date("Y-m-d",strtotime("-14 day",strtotime($data['date'])));                    
        } elseif ( $data['range'] == 'week' ) {
            $data['last_date'] = date("Y-m-d",strtotime("-98 day",strtotime($data['date'])));                                
        } else {            
            $data['last_date'] = date("Y-m-d",strtotime("-365 day",strtotime($data['date'])));                                            
        };
        
        $result = $this->admin_model->out($data['sub_key'],array(
            'date' => $data['date'],
            'last_date' => $data['last_date'],            
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
            'last_date' => $data['last_date'],                        
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
        
        $pagination_count = 0;
        if ( $result_count ) {
            $pagination_count = $result_count[0]['cnt'];            
        };
        $this->global_pagination($pagination_count,'/admin/statistics/list/'.$item_status.'?',$pagination_url);                        
        
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
                $data['container'] = $this->load->view('/admin/statistics/list_1', $data, TRUE);
            } elseif ( $item_status == 2 ) {
                $data['container'] = $this->load->view('/admin/statistics/list_2', $data, TRUE);
            } elseif ( $item_status == 3 ) {
                $data['container'] = $this->load->view('/admin/statistics/list_3', $data, TRUE);
            } elseif ( $item_status == 4 ) {
                $data['container'] = $this->load->view('/admin/statistics/list_4', $data, TRUE);
            } else {
                show_404();                
            };
            $this->load->view('/admin/body', $data, FALSE);            
        };
    }    
    
}
?>