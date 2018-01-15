<?php
/***********************************
타임:          Class
이름:          Video
용도:          Video 템플렛 클래스 ( WEB 버전 )
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

class Video extends CI_Controller {    
    
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
        
        if ( $type == 'create' ) {
            $this->form_validation->set_rules('category_id','카테고리 식별자','trim|required|numeric');
        } else if ( $type == 'delete' ) {
            $this->form_validation->set_rules('relation_id','관계 식별자','trim|required|numeric');
        }
        
        /*******************
        data query
        *******************/     
        if ($this->form_validation->run() == TRUE || $type == 'update') {
            $this->load->model('video_model');        
            
            $relation_id = 0;
            $campaign_id = 0;
            $relation_video = '';
            
            $update_data = array();
            if ( isset( $_POST['relation_id'] ) ) {
                $relation_id = (int)$this->input->post('relation_id',TRUE);
            };        
            
            $video_id = "";
            $video_title= "";              
            $video_thumbnail_url= "";                
            $video_description= "";          
            $video_channel_id= "";           
            $video_channel_title= "";  
            $view_count = 0;
            $like_count = 0;
            $dislike_count = 0;
            $favorite_count = 0;
            $comment_count = 0;
            $duration = 0;
            
            if ( isset($_POST['video_id']) ) {
                $video_id = $this->input->post('video_id',TRUE);
            };
            if ( isset($_POST['video_title']) ) {
                $video_title = $this->input->post('video_title',TRUE);                
            };
            if ( isset($_POST['video_thumbnail_url']) ) {
                $video_thumbnail_url = $this->input->post('video_thumbnail_url',TRUE);                
            };
            if ( isset($_POST['video_description']) ) {
                $video_description = $this->input->post('video_description',TRUE);                
            };
            if ( isset($_POST['video_channel_id']) ) {
                $video_channel_id = $this->input->post('video_channel_id',TRUE);                
            };
            if ( isset($_POST['video_channel_title']) ) {
                $video_channel_title = $this->input->post('video_channel_title',TRUE);                
            };      
            if ( isset($_POST['video_channel_thumbnail_url']) ) {
                $video_channel_thumbnail_url = $this->input->post('video_channel_thumbnail_url',TRUE);                
            };      
            if ( isset($_POST['view_count']) ) {
                $view_count = $this->input->post('view_count',TRUE);                
            };      
            if ( isset($_POST['like_count']) ) {
                $like_count = $this->input->post('like_count',TRUE);                
            };      
            if ( isset($_POST['dislike_count']) ) {
                $dislike_count = $this->input->post('dislike_count',TRUE);                
            };      
            if ( isset($_POST['favorite_count']) ) {
                $favorite_count = $this->input->post('favorite_count',TRUE);                
            };      
            if ( isset($_POST['comment_count']) ) {
                $comment_count = $this->input->post('comment_count',TRUE);                
            };      
            if ( isset($_POST['duration']) ) {
                $duration = $this->input->post('duration',TRUE);                
            };      
            
            $relation_video = array(
                'video_id' => $video_id,
                'video_title' => $video_title,
                'video_thumbnail_url' => $video_thumbnail_url,
                'video_description' => $video_description,
                'video_channel_id' => $video_channel_id,
                'video_channel_title' => $video_channel_title,
                'video_channel_thumbnail_url' > $video_channel_thumbnail_url,
                'view_count' => $view_count,
                'like_count' => $like_count,
                'dislike_count' => $dislike_count,
                'favorite_count' => $favorite_count,
                'comment_count' => $comment_count,
                'duration' => $duration               
            ); 
        
            $update_data['relation_video'] = array (
                'key' => 'relation_video',
                'type' => 'string',
                'value' => ''
            );             

            if ( isset( $_POST['category_id'] ) ) {
                $category_id = (int)$this->input->post('category_id',TRUE);
                //$this->form_validation->set_rules('user_status','상태','trim|required');
                $update_data['category_id'] = array (
                    'key' => 'category_id',
                    'type' => 'int',
                    'value' => $category_id
                );
            };            
            
            $row = $this->video_model->out('id',array(
                'relation_id' => $relation_id
            ));
            
            if ( $row ) {
                // 이미 등록된 캠페인
                if ( $type == 'update' ) {                
                    $update_data['relation_id'] = $row[0]['relation_id'];
                    $this->video_model->update('update',$update_data);
                } else {
                    $update_data['relation_id'] = $row[0]['relation_id'];
                    $this->video_model->update('delete',$update_data);
                }
            } else {
                // 캠페인 등록 필요
                if ( $type == 'create' ) {
                    $relation_id = mt_rand();
                    $row = $this->video_model->update('create',array(
                        'relation_id' => $relation_id,
                        'category_id' => $category_id,
                        'relation_video' => $relation_video
                    ));
                }
            }
            
            $outrow = array();
            
            if ( $row ) {
                $row = $this->video_model->out('id',array(
                    'relation_id' => $relation_id
                ));
                array_push($outrow,$row[0]);                
            } else {
            }
            
            /*******************
            Log write
            *******************/
            if ( $type == 'delete' ) {
                $response['status'] = 200;
            } else {
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
            }
            
        } else {
            /*******************
            validation
            *******************/
            $validation = array();
            if ( isset($_POST['campaign_id']) ) {
                if ( 0 < strlen(strip_tags(form_error('campaign_id'))) ) {
                    //$validation['user_google_id'] = strip_tags(form_error('user_google_id'));
                    $validation['campaign_id'] = 102; //전달된 파라미터가 없음                    
                };
            };            
            
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
		$this->load->model('video_model'); 
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
        if ( isset($_GET['relation_id']) ) {
            $params_data['relation_id'] = (int)$_GET['relation_id'];            
        } else {
            $params_data['relation_id'] = 0;
        };
        if ( isset($_GET['category_id']) ) {
            $params_data['category_id'] = (int)$_GET['category_id'];            
        } else {
            $params_data['category_id'] = 0;
        };
        
        $row = $this->video_model->out($type,$params_data);        
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