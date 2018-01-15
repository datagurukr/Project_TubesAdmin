<?php
/***********************************
타임:          Class
이름:          All_model
용도:          메인 데이터베이스 클래스
작성자:        전병훈
생성일자:      2014.10.13 23:36:13
업데이트일자:   

함수명명규칙
-> 앞에 클래스 명을 붙이지 않는다. (함수명)
************************************/
class User_model extends CI_Model{
	
	function __construct() {
        parent::__construct();
    }
    
    function update ($type, $data) {
        
        $sql = FALSE;

        if ( !array_key_exists('user_ip_address',$data) ) {
            $data['user_ip_address'] = $_SERVER['REMOTE_ADDR'];
        };
        
        if ( !array_key_exists('user_ad_picture',$data) ) {
            $data['user_ad_picture'] = '';
        };
        if ( !array_key_exists('user_ad_name',$data) ) {
            $data['user_ad_name'] = '';
        };
        if ( !array_key_exists('user_ad_open_date',$data) ) {
            $data['user_ad_open_date'] = '';
        };
        if ( !array_key_exists('user_ad_close_date',$data) ) {
            $data['user_ad_close_date'] = '';
        };
        if ( !array_key_exists('user_ad_serial_num',$data) ) {
            $data['user_ad_serial_num'] = '';
        };
        if ( !array_key_exists('user_ad_renewal',$data) ) {
            $data['user_ad_renewal'] = 1;
        };        
        if ( !array_key_exists('user_address',$data) ) {
            $data['user_address'] = '';
        };        
        if ( !array_key_exists('user_licensee_num',$data) ) {
            $data['user_licensee_num'] = '';
        };        
        if ( !array_key_exists('user_licensee_charge_name',$data) ) {
            $data['user_licensee_charge_name'] = '';
        };        
        if ( !array_key_exists('user_licensee_charge_group',$data) ) {
            $data['user_licensee_charge_group'] = '';
        };        
        if ( !array_key_exists('user_licensee_charge_status',$data) ) {
            $data['user_licensee_charge_status'] = '';
        };        
        if ( !array_key_exists('user_licensee_charge_mobile',$data) ) {
            $data['user_licensee_charge_mobile'] = '';
        };        
        if ( !array_key_exists('user_licensee_charge_email',$data) ) {
            $data['user_licensee_charge_email'] = '';
        };        
        if ( !array_key_exists('user_licensee_charge_tel',$data) ) {
            $data['user_licensee_charge_tel'] = '';
        };                
        if ( !array_key_exists('user_email',$data) ) {
            $data['user_email'] = '';
        };                
        if ( !array_key_exists('user_password',$data) ) {
            $data['user_password'] = '';
        };                
        
        if ( $type == 'create' ) {
            $sql = "
                INSERT INTO  user (
                    user_id,
                    user_email,
                    user_password,
                    user_google_id,
                    user_name,
                    user_picture,
                    user_ad_picture,
                    user_ad_name,
                    user_ad_open_date,
                    user_ad_close_date,
                    user_ad_serial_num,
                    user_ad_renewal,
                    user_address,
                    user_licensee_num,
                    user_licensee_charge_name,
                    user_licensee_charge_group,
                    user_licensee_charge_status,
                    user_licensee_charge_mobile,
                    user_licensee_charge_email,
                    user_licensee_charge_tel,
                    user_country,
                    user_app_version_code,
                    user_app_version_name,
                    user_state,
                    user_status,
                    user_device_os,
                    user_device_name,
                    user_device_version,
                    user_gcm_id,
                    user_apns_id,
                    user_ip_address,
                    user_register_date,
                    user_update_date                    
                )
                VALUES (
                    ".$data['user_id'].",
                    '".$data['user_email']."',
                    '".sha1($data['user_password'])."',                    
                    '".$data['user_google_id']."',
                    '".$data['user_name']."',
                    '".$data['user_picture']."',
                    '".$data['user_ad_picture']."',
                    '".$data['user_ad_name']."',
                    '".$data['user_ad_open_date']."',
                    '".$data['user_ad_close_date']."',
                    '".$data['user_ad_serial_num']."',                    
                    '".$data['user_ad_renewal']."',   
                    '".$data['user_licensee_num']."',   
                    '".$data['user_licensee_charge_name']."',   
                    '".$data['user_licensee_charge_group']."',   
                    '".$data['user_licensee_charge_status']."',   
                    '".$data['user_licensee_charge_mobile']."',   
                    '".$data['user_licensee_charge_email']."',   
                    '".$data['user_licensee_charge_tel']."',   
                    '".$data['user_address']."',                         
                    '".$data['user_country']."',                    
                    ".$data['user_app_version_code'].",
                    '".$data['user_app_version_name']."',
                    ".$data['user_state'].",
                    ".$data['user_status'].",
                    '".$data['user_device_os']."',
                    '".$data['user_device_name']."',
                    '".$data['user_device_version']."',
                    '".$data['user_gcm_id']."',
                    '".$data['user_apns_id']."',
                    '".$data['user_ip_address']."',
                    now(),
                    now()
                );            
            ";
        } elseif ( $type == 'update' ) {
            $add = FALSE;
            foreach ( $data as $row ) {
                if ( is_array($row) ) {
                    if ( $row['type'] == 'int' ) {
                        $query_string = $row['key']."=".$row['value'];
                    } elseif ( $row['type'] == 'string' ) {
                        if ( $row['key'] == 'user_password' ) {
                            $query_string = $row['key']."='".sha1($row['value'])."'";
                        } else {
                            $query_string = $row['key']."='".$row['value']."'";
                        };
                    };
                    $add = $add.$query_string.',';
                };
            };
            if ( $add ) {
                $sql = "
                update user
                set
                    ".$add."
                    user_update_date = now()
                where
                    user_id = ".$data['user_id']."
                ";
            };
        };
        
        if ( $sql ) {
            $this->db->trans_begin();
            $this->db->query($sql);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return TRUE;
            };
        } else {
            return FALSE;
        };
    }
    
    function out ($type, $data) {
        
        $sql = FALSE;
        
        if ( !array_key_exists('limit',$data) ) {
            $data['limit'] = 20;
        };
        if ( !array_key_exists('p',$data) ) {
            $data['p'] = 0;
        };
        if ( !array_key_exists('count',$data) ) {
            $data['count'] = FALSE;
        };
        if ( !array_key_exists('order',$data) ) {
            $data['order'] = 'desc';
        };
        
        if ( !$data['count'] ) {
            $limit = "limit ".$data['p']." , ".$data['limit']."";
        } else {
            $limit = "";
        };        
        
        if ( $data['count'] ) {
            $select = "
            count(*) as cnt
            ";
        } else {
            $select = "            
            user.user_id,
            user.user_name,
            user.user_picture
            ";
        };        
        
        if ( $type == 'global' ) {
            $sql = "
            select
                ".$select."
            FROM
                user AS user
            order by user.user_register_date ".$data['order']."
            ".$limit."
            ";   
        } else if ( $type == 'all' ) {
            $sql = "
            select
                ".$select."
            FROM
                user AS user
            order by user.user_register_date ".$data['order']."
            ".$limit."
            ";   
        } else if ( $type == 'id' ) {      
            $sql = "
            select
                ".$select."
            FROM
                user AS user
            where
                user.user_id = ".$data['user_id']."
            order by user.user_register_date ".$data['order']."
            ".$limit."
            ";                           
        } else if ( $type == 'login' ) {
            $sql = "
            select
                ".$select."
            FROM
                user AS user
            where
                user.user_google_id = '".$data['user_google_id']."'
            order by user.user_register_date ".$data['order']."
            ".$limit."
            ";               
        }
        
        if ( $sql ) {
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                if ( $data['count'] ) {
                    $post_data = $query->result_array();
                    $temp_data = $post_data;
                } else {                                
                    $i = 0;
                    $user_data = $query->result_array();
                    $temp_data = array();                    
                    foreach ( $user_data as $row ) {
                        array_push($temp_data,$user_data[$i]);
                        $i++;                        
                    };
                };
                return $temp_data;
            } else {
                return FALSE;
            };
        } else {
			return FALSE;
        };                            
    }
};
?>