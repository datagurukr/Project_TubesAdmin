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

class Upload extends CI_Controller {    
    
    function __construct()
	{
		parent::__construct();
	}
    
	public function ckupload () {
		ini_set('memory_limit','-1');        
		ini_set("post_max_size", "300M");
		ini_set("upload_max_filesize", "300M");          
        
		/*******************************************
		타입:          funciton
		이름:          ckupload
		용도:          포스트 이미지 업로드
		작성자:        전병훈
		생성일자:      2013.08.15 02:01:10
		업데이트일자:   
		
		********************************************/

		// 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
		$config['upload_path'] = './upload';
		// git,jpg,png 파일만 업로드를 허용한다.
		$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG';
		// 허용되는 파일의 최대 사이즈
		$config['max_size'] = '20000';
		// 이미지인 경우 허용되는 최대 폭
		$config['max_width']  = '0';
		// 이미지인 경우 허용되는 최대 높이
		$config['max_height']  = '0';
		// 파일이름 암호화
		$config['encrypt_name']  = TRUE;
		
		$field_name = "upload";
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload($field_name))
        {
            echo "<script>alert('업로드에 실패 했습니다. ".$this->upload->display_errors('','')."')</script>";
        }   
        else
        {
            $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');

            $data = $this->upload->data();            
            $filename = $data['file_name'];
            
            $url = '/upload/'.$filename;

            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', '".$url."', '전송에 성공 했습니다')</script>";
			         
        }
	}    
    
    public function load ( $resize ) {
		ini_set('memory_limit','-1');
        
        if ( isset($_GET['file_name']) ) {            
            $filename = $_GET['file_name'];
            $ext = substr(strrchr($filename,"."),1);
            $ext = strtolower($ext);
            $allowed_images =  array('jpg','png','jpeg','JPG','JPEG');
            $allowed_video =  array('mp4');
            if ( in_array($ext,$allowed_images) ) {
                $folder_name = 'photo';
            } elseif ( in_array($ext,$allowed_video) ) {
                $folder_name = 'video';
            } else {
                $folder_name = FALSE;
            };
            if ( $folder_name ) {
                $path = './upload/'.$folder_name.'/720/'.$filename;
                if (!file_exists($path)) {
                    $folder_new_name = 'photo/720';

                    if ( $filename ) {
                        $config_resize['image_library'] = 'gd2';
                        $config_resize['source_image']	= './upload/'.$folder_name.'/'.$filename;
                        $config_resize['create_thumb'] = FALSE;
                        $config_resize['new_image'] = './upload/'.$folder_new_name.'/'.$filename;
                        if( !is_dir('./upload/'.$folder_new_name.'/') ) {
                            mkdir('./upload/'.$folder_new_name, 0777);
                        };
                        // 가로, 세로의 최대 크기
                        $max_x = $resize;
                        
                        list($width, $height, $type, $attr) = getimagesize('./upload/'.$folder_name.'/'.$filename);
                        $max_y = $height;
                        // 가로, 세로 원본 사이즈
                        $img_width = $width;
                        $img_height = $height;                        
                        if(($img_width/$max_x) == ($img_height/$max_y)) {
                           //원본과 썸네일의 가로세로비율이 같은경우
                           $image_x=$max_x;
                           $image_y=$max_y;
                        } elseif(($img_width/$max_x) < ($img_height/$max_y)) {
                           //세로에 기준을 둔경우
                           $image_x=$max_y*($img_width/$img_height);
                           $image_y=$max_y;
                        } else {
                           //가로에 기준을 둔경우
                           $image_x=$max_x;
                           $image_y=$max_x*($img_height/$img_width);
                        };
                        $config_resize['width'] = $image_x;
                        $config_resize['height'] = $image_y;  
                        $config_resize['quality'] = '100%';                          
                        
                        $this->load->library('image_lib', $config_resize); 
                        $this->image_lib->resize();
                    };                    
                };
                $ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $filename);
                if ( in_array($ext,array('jpg','jpeg','JPG','JPEG')) ) {
                    header('Content-Type: image/jpeg');
                } elseif ( in_array($ext,array('png','PNG')) ) {
                    header('Content-Type: image/png');
                } elseif ( in_array($ext,array('gif','GIF')) ) {
                    header('Content-Type: image/gif');
                };
                readfile($path);                
            };            
        }
    }
    
    public function index () {
		/*******************************************
		타입:          funciton
		이름:          upload
		용도:           업로드
		작성자:        전병훈
		생성일자:      2013.09.11 18:10:36
		업데이트일자:   		
		********************************************/
		ini_set('memory_limit','-1');        
		ini_set("post_max_size", "300M");
		ini_set("upload_max_filesize", "300M");        
        
        /*******************
        data
        *******************/
        $data = array();    
        
        /*******************
        session
        *******************/
        $session = $this->session->all_userdata();          
        if ( isset( $_POST['session_id'] ) ) {
            $session_id = (int)$_POST['session_id'];
        } elseif( isset( $session['logged_in'] ) ) {
            $session_id = $session['users_id'];
        } else {
            $session_id = 0;
        };
        
        /*******************
        response
        *******************/
        $response = array();
        $response['status'] = 200;
        
        try {
            if ( isset($_FILES["upload_file"]) ) {
                $ext = pathinfo($_FILES["upload_file"]["name"],PATHINFO_EXTENSION);
                $allowed_images =  array('gif','jpg','png','jpeg','JPG','JPEG');
                /* video
                $allowed_video =  array('mp4');
                */
                $folder_name = FALSE;
                if ( in_array($ext,$allowed_images) ) {
                    $folder_name = 'photo';
                };
                /* video
                elseif ( in_array($ext,$allowed_video) ) {
                    $folder_name = 'video';
                };
                */
                if ( $folder_name ) {
                    if( !is_dir('./upload/'.$folder_name.'/') ) {
                        mkdir('./upload/'.$folder_name, 0777);
                    };
                    
                    /*******************
                    library
                    *******************/
                    //$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|mp4';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG';
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
                    $field_name = "upload_file";
                    $this->load->library('upload', $config);
                    if ( $this->upload->do_upload($field_name) ) {
                        $file_info = $this->upload->data();            
                        $file_info_name = $file_info['file_name'];
                        $file_custom_info = array (
                            'file_name' => $file_info['file_name'],
                            'file_path' => '/upload/'.$folder_name.'/'.$file_info['file_name']
                        );
                        
                        // 이미지 복사
                        $full_path = '.'.$file_custom_info['file_path'];
                        $output = './upload/'.$folder_name.'/origin/'.$file_info['file_name'];
                        file_put_contents($output, file_get_contents($full_path));

                        
                        // 이미지 회전
                        $this->load->library('image_autorotate', array('filepath' => $full_path));                        
                        
                        $response['status'] = 200;
                        $file_custom_info = array (
                            'file_name' => $file_info['file_name'],
                            'file_path' => '/upload/'.$folder_name.'/'.$file_info['file_name']
                        );                        
                        $response['data'] = array (
                            'out' => $file_custom_info
                        );      
                        
                        /*
                         // 이미지 회전
                        $exif = @exif_read_data($full_path);
		                if (empty($exif['Orientation'])) return FALSE;                        
                        
                        $config['image_library'] = 'gd2';
                        $config['source_image']	= $full_path;

                        $oris = array();

                        switch($exif['Orientation'])
                        {
                                case 1: // no need to perform any changes
                                break;

                                case 2: // horizontal flip
                                $oris[] = 'hor';
                                break;

                                case 3: // 180 rotate left
                                    $oris[] = '180';
                                break;

                                case 4: // vertical flip
                                    $oris[] = 'ver';
                                break;

                                case 5: // vertical flip + 90 rotate right
                                    $oris[] = 'ver';
                                $oris[] = '270';
                                break;

                                case 6: // 90 rotate right
                                    $oris[] = '270';
                                break;

                                case 7: // horizontal flip + 90 rotate right
                                    $oris[] = 'hor';
                                $oris[] = '270';
                                break;

                                case 8: // 90 rotate left
                                    $oris[] = '90';
                                break;

                            default: break;
                        }                        
                        
                        $this->load->library('image_lib', $config);                                                     
                        foreach ($oris as $ori) {
                            echo 'ok';
                            $config['rotation_angle'] = $ori;
                            $this->image_lib->initialize($config); 
                            $this->image_lib->rotate();
                        }                        
                        */
                            
                        /*
                        $resize = 720;
                        $file_new_name = $file_custom_info['file_name'];
                        $folder_new_name = 'photo/720';
                        
                        if ( $file_new_name ) {
                            $config_resize['image_library'] = 'gd2';
                            $config_resize['source_image']	= './upload/'.$folder_name.'/'.$file_info_name;
                            $config_resize['create_thumb'] = FALSE;
                            $config_resize['new_image'] = './upload/'.$folder_new_name.'/'.$file_new_name;
                            if( !is_dir('./upload/'.$folder_new_name.'/') ) {
                                mkdir('./upload/'.$folder_new_name, 0777);
                            };
                            // 가로, 세로의 최대 크기
                            $max_x = $resize;
                            $max_y = $file_info['image_height'];
                            // 가로, 세로 원본 사이즈
                            $img_width = $file_info['image_width'];
                            $img_height = $file_info['image_height'];
                            if(($img_width/$max_x) == ($img_height/$max_y)) {
                               //원본과 썸네일의 가로세로비율이 같은경우
                               $image_x=$max_x;
                               $image_y=$max_y;
                            } elseif(($img_width/$max_x) < ($img_height/$max_y)) {
                               //세로에 기준을 둔경우
                               $image_x=$max_y*($img_width/$img_height);
                               $image_y=$max_y;
                            } else {
                               //가로에 기준을 둔경우
                               $image_x=$max_x;
                               $image_y=$max_x*($img_height/$img_width);
                            };
                            $config_resize['width'] = $image_x;
                            $config_resize['height'] = $image_y;                            
                            $this->load->library('image_lib', $config_resize); 
                            if ( $this->image_lib->resize() ){
                                $response['status'] = 200;
                                $file_custom_info = array (
                                    'file_name' => $file_new_name,
                                    'file_path' => '/upload/'.$folder_new_name.'/'.$file_new_name
                                );
                            } else {
                                $response['message'] = $this->image_lib->display_errors('<p>', '</p>');
                            };
                        } else {
                            $response['status'] = 200;
                        };
                        
                        if ( $response['status'] == 200 ) {
                            $response['data'] = array (
                                'out' => $file_custom_info
                            );
                        }; 
                        */
                    } else {
                        $response['status'] = 500;
                        $validation['file_error'] = $this->upload->display_errors();
                        $response['error'] = array (
                            'validation' => $validation,
                            'message' => '재시도 해주세요.'
                        );
                    };
                } else {
                    $response['status'] = 500;                    
                    $validation['file_error'] = '확장자 오류';
                    $response['error'] = array (
                        'validation' => $validation,
                        'message' => '재시도 해주세요.'
                    );
                };
            } else {
                $response['status'] = 500;                    
                $validation['file_error'] = '전송된 file이 없습니다.';
                $response['error'] = array (
                    'validation' => $validation,
                    'message' => '재시도 해주세요.'                    
                );
            };
        } catch (Exception $e) {
        };
        
		$this->output
			 ->set_content_type('application/json')
			 ->set_output( json_encode($response) );        
	}      
}
