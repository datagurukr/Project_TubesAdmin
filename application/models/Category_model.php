<?php
/***********************************
타임:          Class
이름:          Category_model
용도:          메인 데이터베이스 클래스
작성자:        전병훈
생성일자:      2014.10.13 23:36:13
업데이트일자:   

함수명명규칙
-> 앞에 클래스 명을 붙이지 않는다. (함수명)
************************************/
class Category_model extends CI_Model{
	
	function __construct() {
        parent::__construct();
    }
    
    function update ($type, $data) {
        
        $sql = FALSE;

        if ( !array_key_exists('category_ip_address',$data) ) {
            $data['category_ip_address'] = $_SERVER['REMOTE_ADDR'];
        };
        
        if ( $type == 'create' ) {
            $sql = "
                INSERT INTO category (
                    category_id, 
                    user_id, 
                    category_status, 
                    category_state, 
                    category_name, 
                    category_description, 
                    category_picture, 
                    category_ip_address, 
                    category_register_date, 
                    category_update_date
                )
                VALUES (
                    ".$data['category_id'].",
                    ".$data['user_id'].",                    
                    ".$data['category_status'].",                    
                    ".$data['category_state'].",                                        
                    '".$data['category_name']."',
                    '".$data['category_description']."',
                    '".$data['category_picture']."',
                    '".$data['category_ip_address']."',
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
                update category
                set
                    ".$add."
                    category_update_date = now()
                where
                    category_id = ".$data['category_id']."
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
            category.category_id,
            category.category_name,
            category.category_description, 
            category.category_picture           
            ";
        };        
        
        if ( $type == 'global' ) {
            $sql = "
            select
                ".$select."
            FROM
                category AS category
            WHERE
                category.category_state = 1                
            order by category.category_register_date ".$data['order']."
            ".$limit."
            ";   
        } else if ( $type == 'all' ) {
            $sql = "
            select
                ".$select."
            FROM
                category AS category
            WHERE
                category.category_state = 1
            order by category.category_register_date ".$data['order']."
            ".$limit."
            ";   
        } else if ( $type == 'user' ) {                  
            $sql = "
            select
                ".$select."
            FROM
                category AS category
            where
                category.user_id = ".$data['user_id']."
                and
                category.category_state = 1                
            order by category.category_register_date ".$data['order']."
            ".$limit."
            ";                                       
        } else if ( $type == 'id' ) {      
            $sql = "
            select
                ".$select."
            FROM
                category AS category
            where
                category.category_id = ".$data['category_id']."
            order by category.category_register_date ".$data['order']."
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