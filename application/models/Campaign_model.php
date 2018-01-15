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
class Campaign_model extends CI_Model{
	
	function __construct() {
        parent::__construct();
    }
    
    function update ($type, $data) {
        
        $sql = FALSE;

        if ( !array_key_exists('campaign_ip_address',$data) ) {
            $data['campaign_ip_address'] = $_SERVER['REMOTE_ADDR'];
        };
        if ( !array_key_exists('user_id',$data) ) {
            $data['user_id'] = 0;
        };
        
        if ( $type == 'create' ) {
            $sql = "
                INSERT INTO  campaign (
                    campaign_id, 
                    category_id, 
                    user_id,
                    campaign_status, 
                    campaign_state, 
                    campaign_name, 
                    campaign_description, 
                    campaign_picture, 
                    campaign_link, 
                    campaign_show_second, 
                    campaign_start_date, 
                    campaign_stop_date, 
                    campaign_ip_address, 
                    campaign_register_date, 
                    campaign_update_date
                )
                VALUES (
                    ".$data['campaign_id'].",
                    ".$data['category_id'].",                    
                    ".$data['user_id'].",                                        
                    ".$data['campaign_status'].",                    
                    ".$data['campaign_state'].",                                        
                    '".$data['campaign_name']."',
                    '".$data['campaign_description']."',
                    '".$data['campaign_picture']."',
                    '".$data['campaign_link']."',                    
                    ".$data['campaign_show_second'].",
                    '".$data['campaign_start_date']."',
                    '".$data['campaign_stop_date']."',
                    '".$data['campaign_ip_address']."',
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
                        if ( $row['key'] == 'user_pass' ) {
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
                update campaign
                set
                    ".$add."
                    campaign_update_date = now()
                where
                    campaign_id = ".$data['campaign_id']."
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
            campaign.campaign_id,
            campaign.campaign_name,
            campaign.campaign_description, 
            campaign.campaign_picture, 
            campaign.campaign_link, 
            campaign.campaign_show_second, 
            campaign.campaign_start_date, 
            campaign.campaign_stop_date
            ";
        };        
        
        if ( $type == 'global' ) {
            $sql = "
            select
                ".$select."
            FROM
                campaign AS campaign
            order by campaign.campaign_register_date ".$data['order']."
            ".$limit."
            ";   
        } else if ( $type == 'all' ) {
            $sql = "
            select
                ".$select."
            FROM
                campaign AS campaign
            order by campaign.campaign_register_date ".$data['order']."
            ".$limit."
            ";   
        } else if ( $type == 'category' ) {                  
            $sql = "
            select
                ".$select."
            FROM
                campaign AS campaign
            where
                campaign.category_id = ".$data['category_id']."
            order by campaign.campaign_show_second ".$data['order']."
            ".$limit."
            ";
        } else if ( $type == 'id' ) {      
            $sql = "
            select
                ".$select."
            FROM
                campaign AS campaign
            where
                campaign.campaign_id = ".$data['campaign_id']."
            order by campaign.campaign_register_date ".$data['order']."
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