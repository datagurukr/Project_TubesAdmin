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
class Video_model extends CI_Model{
	
	function __construct() {
        parent::__construct();
    }
    
    function update ($type, $data) {
        
        $sql = FALSE;

        if ( !array_key_exists('relation_ip_address',$data) ) {
            $data['relation_ip_address'] = $_SERVER['REMOTE_ADDR'];
        };
        
        if ( $type == 'create' ) {
            $sql = "
                INSERT INTO category_video_relation (
                    relation_id, 
                    category_id, 
                    relation_video, 
                    relation_ip_address, 
                    relation_register_date, 
                    relation_update_date
                )
                VALUES (
                    ".$data['relation_id'].",
                    ".$data['category_id'].",                    
                    '".$this->db->escape_str(serialize($data['relation_video']))."',
                    '".$data['relation_ip_address']."',
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
            };
        } elseif ( $type == 'delete' ) {
            $sql = "delete from category_video_relation where relation_id = ".$data['relation_id']."";            
        }
        
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
            category_video_relation.relation_id,
            category_video_relation.relation_video
            ";
        };        
        
        if ( $type == 'global' ) {
            $sql = "
            select
                ".$select."
            FROM
                category_video_relation AS category_video_relation
            order by category_video_relation.relation_register_date ".$data['order']."
            ".$limit."
            ";   
        } else if ( $type == 'all' ) {
            $sql = "
            select
                ".$select."
            FROM
                category_video_relation AS category_video_relation
            order by category_video_relation.relation_register_date ".$data['order']."
            ".$limit."
            ";   
        } else if ( $type == 'category' ) {                  
            $sql = "
            select
                ".$select."
            FROM
                category_video_relation AS category_video_relation
            where
                category_video_relation.category_id = ".$data['category_id']."
            order by category_video_relation.relation_register_date ".$data['order']."
            ".$limit."
            ";                                       
        } else if ( $type == 'id' ) {      
            $sql = "
            select
                ".$select."
            FROM
                category_video_relation AS category_video_relation
            where
                category_video_relation.relation_id = ".$data['relation_id']."
            order by category_video_relation.relation_register_date ".$data['order']."
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
                        $relation_video = $user_data[$i]['relation_video'];
                        $relation_video = @unserialize($relation_video);   
                        if ( !array_key_exists('video_channel_thumbnail_url',$relation_video) ) {
                            $relation_video['video_channel_thumbnail_url'] = '';
                        };
                        if ( !array_key_exists('view_count',$relation_video) ) {
                            $relation_video['view_count'] = 0;
                        };
                        if ( !array_key_exists('like_count',$relation_video) ) {
                            $relation_video['like_count'] = 0;
                        };
                        if ( !array_key_exists('dislike_count',$relation_video) ) {
                            $relation_video['dislike_count'] = 0;
                        };
                        if ( !array_key_exists('favorite_count',$relation_video) ) {
                            $relation_video['favorite_count'] = 0;
                        };
                        if ( !array_key_exists('comment_count',$relation_video) ) {
                            $relation_video['comment_count'] = 0;
                        };
                        if ( !array_key_exists('duration',$relation_video) ) {
                            $relation_video['duration'] = 0;
                        };
                        if ( !array_key_exists('duration',$relation_video) ) {
                            $relation_video['duration1'] = 0;
                        };                        
                        $user_data[$i]['relation_video'] = $relation_video;
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