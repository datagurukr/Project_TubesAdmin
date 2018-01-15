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
class Admin_model extends CI_Model{
	
	function __construct()
    {
        parent::__construct();
    }
    
    function out ($type, $data) {
        $sql = FALSE;
        
        $sql = FALSE;
        
        if ( !array_key_exists('user_id',$data) ) {
            $data['user_id'] = 0;
        };
        if ( !array_key_exists('session_id',$data) ) {
            $data['session_id'] = 0;
        };
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
        if ( !array_key_exists('q',$data) ) {
            $data['q'] = '';
        };        
        if ( !array_key_exists('target',$data) ) {
            $data['target'] = '';
        };                
        if ( !array_key_exists('user_status',$data) ) {
            $data['user_status'] = 0;
        };
        
        if ( !$data['count'] ) {
            $limit = "limit ".$data['p']." , ".$data['limit']."";
        } else {
            $limit = "";
        };      
        
        if ( $type == 'global' ) {
            $sql = "
            ";  
        } elseif ( $type == 'user_1' ) {
            $where = "";
            if ( isset($data['target']) ) {
                if ( strlen($data['q']) != 0 ) {
                    if ( $data['target'] == 'tel' ) {
                        $where = "and user.user_tel like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'location' ) {
                        $where = "and (user.user_location like '%".$data['q']."%' or car.car_location like '%".$data['q']."%')";
                    } elseif ( $data['target'] == 'name' ) {
                        $where = "and user.user_name like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'number' ) {
                        $where = "and car.car_number like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'car' ) {
                        $where = "and ( select model_name from model where model_id = car.model_id ) like '%".$data['q']."%'";
                    }
                }
            } 
            
            
            if ( strlen($data['os']) ) {
                $where = "and upper(user.user_device_os) = upper('".$data['os']."')";
            }
            
            if ( strlen($data['sale']) ) {
                if ( $data['sale'] == 'free' ) {
                    $where = "and user.user_status = 1";
                } else {
                    $where = "and user.user_status = 2";
                }
            }
            
            if ( strlen($data['country']) ) {
                $where = "and upper(user.user_country) = upper('".$data['country']."')";
            }
            
            if ( $data['count'] ) {
                $sql = "
                SELECT 
                    count(DISTINCT user.user_id) as cnt
                FROM
                    user as user
                WHERE
                    user.user_status = 1
                    ".$where."
                ";
            } else {
                $sql = "
                SELECT 
                    user.user_id,
                    user.user_google_id,
                    user.user_name,
                    user.user_picture,
                    user.user_country,
                    user.user_app_version_code,
                    user.user_app_version_name,
                    user.user_state,
                    user.user_status,
                    user.user_device_os,
                    user.user_device_name,
                    user.user_device_version,
                    user.user_gcm_id,
                    user.user_apns_id,
                    user.user_ip_address,
                    user.user_register_date,
                    user.user_update_date                  
                FROM
                    user as user
                WHERE
                    user.user_status = 1
                    ".$where."
                group by user.user_id                    
                order by user.user_register_date ".$data['order']."
                ".$limit."                
                ";
            };        
        } elseif ( $type == 'user_3' ) { 
            $where = "";
            if ( isset($data['target']) ) {
                if ( strlen($data['q']) != 0 ) {
                    if ( $data['target'] == 'tel' ) {
                        $where = "and user.user_tel like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'location' ) {
                        $where = "and (user.user_location like '%".$data['q']."%' or car.car_location like '%".$data['q']."%')";
                    } elseif ( $data['target'] == 'name' ) {
                        $where = "and user.user_name like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'number' ) {
                        $where = "and car.car_number like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'car' ) {
                        $where = "and ( select model_name from model where model_id = car.model_id ) like '%".$data['q']."%'";
                    }
                }
            } 

            if ( strlen($data['renewal']) ) {
                $where = $where." and user.user_ad_renewal = ".$data['renewal']."";
            }

            if ( strlen($data['ad_name']) ) {
                $where = $where." and user.user_ad_name like '%".$data['ad_name']."%'";
            }            
            
            if ( $data['count'] ) {
                $sql = "
                SELECT 
                    count(DISTINCT user.user_id) as cnt
                FROM
                    user as user
                WHERE
                    user.user_status = 3
                    ".$where."
                ";
            } else {
                $sql = "
                SELECT 
                    user.user_id,
                    user.user_google_id,
                    user.user_name,
                    user.user_picture,
                    user.user_ad_picture,
                    user.user_ad_name,
                    user.user_ad_open_date,
                    user.user_ad_close_date,
                    user.user_ad_serial_num,
                    user.user_ad_renewal,  
                    user.user_address,
                    user.user_licensee_num,
                    user.user_licensee_charge_name,
                    user.user_licensee_charge_group,
                    user.user_licensee_charge_status,
                    user.user_licensee_charge_mobile,
                    user.user_licensee_charge_email,
                    user.user_licensee_charge_tel,
                    user.user_country,
                    user.user_app_version_code,
                    user.user_app_version_name,
                    user.user_state,
                    user.user_status,
                    user.user_device_os,
                    user.user_device_name,
                    user.user_device_version,
                    user.user_gcm_id,
                    user.user_apns_id,
                    user.user_ip_address,
                    user.user_register_date,
                    user.user_update_date                  
                FROM
                    user as user
                WHERE
                    user.user_state = 1
                    and
                    user.user_status = 3
                    ".$where."
                group by user.user_id                    
                order by user.user_register_date ".$data['order']."
                ".$limit."                
                ";
            };
        } elseif ( $type == 'user_5' || $type == 'user_6' ) { 
            $where = "";
            if ( isset($data['target']) ) {
                if ( strlen($data['q']) != 0 ) {
                    if ( $data['target'] == 'tel' ) {
                        $where = "and user.user_tel like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'location' ) {
                        $where = "and (user.user_location like '%".$data['q']."%' or car.car_location like '%".$data['q']."%')";
                    } elseif ( $data['target'] == 'name' ) {
                        $where = "and user.user_name like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'number' ) {
                        $where = "and car.car_number like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'car' ) {
                        $where = "and ( select model_name from model where model_id = car.model_id ) like '%".$data['q']."%'";
                    }
                }
            } 
            if ( $data['count'] ) {
                $sql = "
                SELECT 
                    count(DISTINCT user.user_id) as cnt
                FROM
                    user as user
                WHERE
                    user.user_id = ".$data['user_id']."
                    ".$where."
                ";
            } else {
                $sql = "
                SELECT 
                    campaign.campaign_id,
                    campaign.campaign_picture,
                    user.user_id,
                    user.user_google_id,
                    user.user_name,
                    user.user_picture,
                    user.user_ad_picture,
                    user.user_ad_name,
                    user.user_ad_open_date,
                    user.user_ad_close_date,
                    user.user_ad_serial_num,
                    user.user_ad_renewal,  
                    user.user_address,
                    user.user_licensee_num,
                    user.user_licensee_charge_name,
                    user.user_licensee_charge_group,
                    user.user_licensee_charge_status,
                    user.user_licensee_charge_mobile,
                    user.user_licensee_charge_email,
                    user.user_licensee_charge_tel,
                    user.user_country,
                    user.user_app_version_code,
                    user.user_app_version_name,
                    user.user_state,
                    user.user_status,
                    user.user_device_os,
                    user.user_device_name,
                    user.user_device_version,
                    user.user_gcm_id,
                    user.user_apns_id,
                    user.user_ip_address,
                    user.user_register_date,
                    user.user_update_date                  
                FROM
                    user as user
                    left outer join campaign as campaign
                    on
                    (user.user_id = campaign.user_id)
                WHERE
                    user.user_state = 1
                    and
                    user.user_id = ".$data['user_id']."
                    ".$where."
                group by user.user_id                    
                order by user.user_register_date ".$data['order']."
                ".$limit."                
                ";
            };            
        } elseif ( $type == 'event_3' ) {   
            
            
            $where = "";
            if ( isset($data['target']) ) {
                if ( strlen($data['q']) != 0 ) {
                    if ( $data['target'] == 'tel' ) {
                        $where = "and user.user_tel like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'location' ) {
                        $where = "and (user.user_location like '%".$data['q']."%' or car.car_location like '%".$data['q']."%')";
                    } elseif ( $data['target'] == 'name' ) {
                        $where = "and user.user_name like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'number' ) {
                        $where = "and car.car_number like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'car' ) {
                        $where = "and ( select model_name from model where model_id = car.model_id ) like '%".$data['q']."%'";
                    }
                }
            } 
            
            if ( strlen($data['ad_name']) ) {
                $where = $where." and user.user_ad_name like '%".$data['ad_name']."%'";
            }                        
            
            if ( $data['count'] ) {
                $sql = "
                SELECT 
                    count(DISTINCT campaign.campaign_id) as cnt
                FROM
                    campaign as campaign
                    left outer join user as user
                    on
                    (campaign.user_id = user.user_id)
                WHERE
                    0 <= campaign.campaign_status
                    ".$where."
                ";
            } else {
                $sql = "
                SELECT 
                    user.user_ad_picture as user_ad_picture,
                    user.user_ad_name as user_ad_name,
                    user.user_ad_premium as user_ad_premium,
                    user.user_ad_category as user_ad_category,                    
                    user.user_id as user_id,                    
                    campaign.campaign_id, 
                    campaign.category_id, 
                    campaign.campaign_status, 
                    campaign.campaign_state, 
                    campaign.campaign_name, 
                    campaign.campaign_description, 
                    campaign.campaign_picture, 
                    campaign.campaign_link, 
                    campaign.campaign_show_second, 
                    campaign.campaign_start_date, 
                    campaign.campaign_stop_date, 
                    campaign.campaign_open_tiem, 
                    campaign.campaign_close_time, 
                    campaign.campaign_ip_address, 
                    campaign.campaign_register_date, 
                    campaign.campaign_update_date                 
                FROM
                    campaign as campaign
                    left outer join user as user
                    on
                    (campaign.user_id = user.user_id)
                WHERE
                    0 <= campaign.campaign_status
                    ".$where."
                group by campaign.campaign_id                    
                order by campaign.campaign_register_date ".$data['order']."
                ".$limit."                
                ";
            };            
        } elseif ( $type == 'event_6' ) {   
            $where = "";
            if ( isset($data['target']) ) {
                if ( strlen($data['q']) != 0 ) {
                    if ( $data['target'] == 'tel' ) {
                        $where = "and user.user_tel like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'location' ) {
                        $where = "and (user.user_location like '%".$data['q']."%' or car.car_location like '%".$data['q']."%')";
                    } elseif ( $data['target'] == 'name' ) {
                        $where = "and user.user_name like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'number' ) {
                        $where = "and car.car_number like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'car' ) {
                        $where = "and ( select model_name from model where model_id = car.model_id ) like '%".$data['q']."%'";
                    }
                }
            } 
            if ( $data['count'] ) {
                $sql = "
                SELECT 
                    count(DISTINCT post.post_id) as cnt
                FROM
                    post as post
                WHERE
                    post.post_status = 1
                    ".$where."
                ";
            } else {
                $sql = "
                SELECT 
                    post.post_id as post_id,
                    post.user_id as user_id,
                    post.post_action as post_action,
                    post.post_name as post_name,
                    post.post_title as post_title,
                    post.post_article as post_article,
                    post.post_file as post_file,
                    post.post_target as post_target,
                    post.post_register_date as post_register_date,
                    post.post_update_date as post_update_date
                FROM
                    post as post
                WHERE
                    post.post_status = 1
                    ".$where."
                group by post.post_id                    
                order by post.post_register_date ".$data['order']."
                ".$limit."                
                ";
            };       
        } elseif ( $type == 'event_1' ) {   
            $where = "";
            if ( isset($data['target']) ) {
                if ( strlen($data['q']) != 0 ) {
                    if ( $data['target'] == 'tel' ) {
                        $where = "and user.user_tel like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'location' ) {
                        $where = "and (user.user_location like '%".$data['q']."%' or car.car_location like '%".$data['q']."%')";
                    } elseif ( $data['target'] == 'name' ) {
                        $where = "and user.user_name like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'number' ) {
                        $where = "and car.car_number like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'car' ) {
                        $where = "and ( select model_name from model where model_id = car.model_id ) like '%".$data['q']."%'";
                    }
                }
            } 
            
            if ( strlen($data['type']) ) {
                if ( $data['type'] == 'email' ) {
                    $where = $where." and notice.notice_free = 1";                    
                } else {
                    $where = $where." and notice.notice_free = 2";                    
                }
            }                        
            
            if ( strlen($data['os']) ) {
                $where = $where." and upper(notice.notice_os) = upper('".$data['os']."')";
            }
            
            if ( strlen($data['sale']) ) {
                if ( $data['sale'] == 'free' ) {
                    $where = $where." and notice.notice_free = 2";
                } elseif ( $data['sale'] == 'charge' ) {
                    $where = $where." and notice.notice_free = 3";
                } else {
                    $where = $where." and notice.notice_free = 1";                    
                }
            }
            
            if ( strlen($data['country']) ) {
                $where = $where." and upper(notice.notice_country) = upper('".$data['country']."')";
            }            
            
            
            if ( $data['count'] ) {
                $sql = "
                SELECT 
                    count(DISTINCT notice.notice_id) as cnt
                FROM
                    notice as notice
                WHERE
                    notice.notice_status = 1
                    ".$where."
                ";
            } else {
                $sql = "
                SELECT 
                    notice.notice_id,
                    notice.user_id,
                    notice.notice_status,
                    notice.notice_type,
                    notice.notice_free,
                    notice.notice_country,
                    notice.notice_os,
                    notice.notice_count,
                    notice.notice_content,
                    notice.notice_register_date,
                    notice.notice_update_date
                FROM
                    notice as notice
                WHERE
                    notice.notice_status = 1
                    ".$where."
                group by notice.notice_id                    
                order by notice.notice_register_date ".$data['order']."
                ".$limit."                
                ";
            };    
        } elseif ( $type == 'event_2' ) {   
            $where = "";
            if ( isset($data['target']) ) {
                if ( strlen($data['q']) != 0 ) {
                    if ( $data['target'] == 'tel' ) {
                        $where = "and user.user_tel like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'location' ) {
                        $where = "and (user.user_location like '%".$data['q']."%' or car.car_location like '%".$data['q']."%')";
                    } elseif ( $data['target'] == 'name' ) {
                        $where = "and user.user_name like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'number' ) {
                        $where = "and car.car_number like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'car' ) {
                        $where = "and ( select model_name from model where model_id = car.model_id ) like '%".$data['q']."%'";
                    }
                }
            } 
            
            if ( strlen($data['type']) ) {
                if ( $data['type'] == 'email' ) {
                    $where = $where." and notice.notice_free = 1";                    
                } else {
                    $where = $where." and notice.notice_free = 2";                    
                }
            }                        
            
            if ( strlen($data['os']) ) {
                $where = $where." and upper(notice.notice_os) = upper('".$data['os']."')";
            }
            
            if ( strlen($data['premium']) ) {
                $where = $where." and notice.notice_premium = ".$data['premium']."";
            }
            
            if ( strlen($data['country']) ) {
                $where = $where." and upper(notice.notice_country) = upper('".$data['country']."')";
            }  
            
            if ( $data['count'] ) {
                $sql = "
                SELECT 
                    count(DISTINCT notice.notice_id) as cnt
                FROM
                    notice as notice
                WHERE
                    notice.notice_status = 2
                    ".$where."
                ";
            } else {
                $sql = "
                SELECT 
                    notice.notice_id,
                    notice.user_id,
                    notice.notice_status,
                    notice.notice_type,
                    notice.notice_premium,
                    notice.notice_free,
                    notice.notice_country,
                    notice.notice_os,
                    notice.notice_count,
                    notice.notice_content,
                    notice.notice_register_date,
                    notice.notice_update_date
                FROM
                    notice as notice
                WHERE
                    notice.notice_status = 2
                    ".$where."
                group by notice.notice_id                    
                order by notice.notice_register_date ".$data['order']."
                ".$limit."                
                ";
            };  
        } elseif ( $type == 'event_7' ) {   
            $where = "";
            if ( isset($data['target']) ) {
                if ( strlen($data['q']) != 0 ) {
                    if ( $data['target'] == 'tel' ) {
                        $where = "and user.user_tel like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'location' ) {
                        $where = "and (user.user_location like '%".$data['q']."%' or car.car_location like '%".$data['q']."%')";
                    } elseif ( $data['target'] == 'name' ) {
                        $where = "and user.user_name like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'number' ) {
                        $where = "and car.car_number like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'car' ) {
                        $where = "and ( select model_name from model where model_id = car.model_id ) like '%".$data['q']."%'";
                    }
                }
            } 
            if ( $data['count'] ) {
                $sql = "
                SELECT 
                    count(DISTINCT post.post_id) as cnt
                FROM
                    post as post
                WHERE
                    post.post_status = 2
                    ".$where."
                ";
            } else {
                $sql = "
                SELECT 
                    post.post_id as post_id,
                    post.user_id as user_id,
                    post.post_action as post_action,
                    post.post_name as post_name,
                    post.post_title as post_title,
                    post.post_article as post_article,
                    post.post_file as post_file,
                    post.post_target as post_target,
                    post.post_register_date as post_register_date,
                    post.post_update_date as post_update_date
                FROM
                    post as post
                WHERE
                    post.post_status = 2
                    ".$where."
                group by post.post_id                    
                order by post.post_register_date ".$data['order']."
                ".$limit."                
                ";
            };    
        } elseif ( $type == 'event_8' || $type == 'event_9' ) {               
            $where = "";
            if ( isset($data['target']) ) {
                if ( strlen($data['q']) != 0 ) {
                    if ( $data['target'] == 'tel' ) {
                        $where = "and user.user_tel like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'location' ) {
                        $where = "and (user.user_location like '%".$data['q']."%' or car.car_location like '%".$data['q']."%')";
                    } elseif ( $data['target'] == 'name' ) {
                        $where = "and user.user_name like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'number' ) {
                        $where = "and car.car_number like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'car' ) {
                        $where = "and ( select model_name from model where model_id = car.model_id ) like '%".$data['q']."%'";
                    }
                }
            }             
            if ( $data['count'] ) {
                $sql = "
                SELECT 
                    count(DISTINCT post.user_id) as cnt
                FROM
                    post as post
                WHERE
                    post.post_id = ".$data['post_id']."
                    ".$where."
                ";
            } else {
                $sql = "
                SELECT 
                    post.post_id as post_id,
                    post.user_id as user_id,
                    post.post_action as post_action,
                    post.post_name as post_name,
                    post.post_title as post_title,
                    post.post_article as post_article,
                    post.post_file as post_file,
                    post.post_target as post_target,
                    post.post_register_date as post_register_date,
                    post.post_update_date as post_update_date
                FROM
                    post as post
                WHERE
                    post.post_id = ".$data['post_id']."
                    ".$where."
                group by post.post_id                    
                order by post.post_register_date ".$data['order']."
                ".$limit."                
                ";
            };    
            
        } elseif ( $type == 'auth_4' ) {               
            $where = "";
            if ( isset($data['target']) ) {
                if ( strlen($data['q']) != 0 ) {
                    if ( $data['target'] == 'tel' ) {
                        $where = "and user.user_tel like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'location' ) {
                        $where = "and (user.user_location like '%".$data['q']."%' or car.car_location like '%".$data['q']."%')";
                    } elseif ( $data['target'] == 'name' ) {
                        $where = "and user.user_name like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'number' ) {
                        $where = "and car.car_number like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'car' ) {
                        $where = "and ( select model_name from model where model_id = car.model_id ) like '%".$data['q']."%'";
                    }
                }
            } 
            if ( $data['count'] ) {
                $sql = "
                SELECT 
                    count(DISTINCT user.user_id) as cnt
                FROM
                    user as user
                WHERE
                    user.user_id = ".$data['user_id']."
                    ".$where."
                ";
            } else {
                $sql = "
                SELECT 
                    campaign.campaign_id,
                    campaign.campaign_picture,
                    user.user_id,
                    user.user_google_id,
                    user.user_name,
                    user.user_email,
                    user.user_picture,
                    user.user_ad_picture,
                    user.user_ad_name,
                    user.user_ad_open_date,
                    user.user_ad_close_date,
                    user.user_ad_serial_num,
                    user.user_ad_renewal,  
                    user.user_address,
                    user.user_licensee_num,
                    user.user_licensee_charge_name,
                    user.user_licensee_charge_group,
                    user.user_licensee_charge_status,
                    user.user_licensee_charge_mobile,
                    user.user_licensee_charge_email,
                    user.user_licensee_charge_tel,
                    user.user_country,
                    user.user_app_version_code,
                    user.user_app_version_name,
                    user.user_state,
                    user.user_status,
                    user.user_device_os,
                    user.user_device_name,
                    user.user_device_version,
                    user.user_gcm_id,
                    user.user_apns_id,
                    user.user_ip_address,
                    user.user_register_date,
                    user.user_update_date                  
                FROM
                    user as user
                    left outer join campaign as campaign
                    on
                    (user.user_id = campaign.user_id)
                WHERE
                    user.user_id = ".$data['user_id']."
                    ".$where."
                group by user.user_id                    
                order by user.user_register_date ".$data['order']."
                ".$limit."                
                ";
            };             
        } elseif ( $type == 'statistics_2' ) {            
            $where = "";
            if ( isset($data['target']) ) {
                if ( strlen($data['q']) != 0 ) {
                    if ( $data['target'] == 'tel' ) {
                        $where = "and user.user_tel like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'location' ) {
                        $where = "and (user.user_location like '%".$data['q']."%' or car.car_location like '%".$data['q']."%')";
                    } elseif ( $data['target'] == 'name' ) {
                        $where = "and user.user_name like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'number' ) {
                        $where = "and car.car_number like '%".$data['q']."%'";
                    } elseif ( $data['target'] == 'car' ) {
                        $where = "and ( select model_name from model where model_id = car.model_id ) like '%".$data['q']."%'";
                    }
                }
            } 
            
            
            $groupby = "";
            $select = "*";            
            if ( $data['range'] == 'day' ) {
                $select = "DATE_FORMAT(user.user_update_date,'%m-%d') as s_date, count(*) as s_count";
                $groupby = "group by DATE_FORMAT(user.user_update_date,'%Y-%m-%d')";
            } elseif ( $data['range'] == 'week' ) {
                $select = "DATE_FORMAT(user.user_update_date,'%m-%d') as s_date, count(*) as s_count";
                $groupby = "group by DATE_FORMAT(user.user_update_date,'%Y-%m')";                
            } else {            
                $select = "DATE_FORMAT(user.user_update_date,'%m-%d') as s_date, count(*) as s_count";
                $groupby = "group by DATE_FORMAT(user.user_update_date,'%Y-%m')";                
            }            
            
            if ( $data['count'] ) {
                $sql = "
                SELECT 
                    count(DISTINCT user.user_id) as cnt
                FROM
                    user as user
                WHERE
                    user.user_status = 1
                    ".$where."
                ";
            } else {
                $sql = "
                SELECT 
                    ".$select."             
                FROM
                    user as user
                WHERE
                    user.user_status = 1
                    and
                    '".$data['last_date']."' <= DATE_FORMAT(user.user_update_date,'%Y-%m-%d') and DATE_FORMAT(user.user_update_date,'%Y-%m-%d') <= '".$data['date']."'
                    ".$where."
                ".$groupby."                   
                order by user.user_register_date asc
                ".$limit."                
                ";
            };              
        } elseif ( $type == 'statistics' ) {
            $sql = "
            select
                ".$select."
            ";
        }
        
        /*
            if ( $data['count'] ) {
                $sql = "
                SELECT 
                    count(DISTINCT user.user_id) as cnt
                FROM
                    user as user
                WHERE
                    user.user_status = 1
                    ".$where."
                ";
            } else {
                $sql = "
                SELECT 
                    ".$select."             
                FROM
                
                    (SELECT 
                        selected_date
                    FROM
                        (SELECT 
                            ADDDATE('".$data['last_date']."', t4 * 10000 + t3 * 1000 + t2 * 100 + t1 * 10 + t0) selected_date
                        FROM
                            (SELECT 0 t0 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t0, (SELECT 0 t1 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1, (SELECT 0 t2 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2, (SELECT 0 t3 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3, (SELECT 0 t4 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4) v
                    WHERE
                        selected_date BETWEEN '".$data['last_date']."' AND '".$data['date']."'
                    ORDER BY selected_date DESC) as left_date
                    left join user as user
                    on
                    left_date.selected_date = DATE_FORMAT(user.user_register_date,'%Y-%m-%d')
                    
                WHERE
                    user.user_status = 1
                    ".$where."
                ".$groupby."                   
                ".$limit."                
                ";
            };          
        */

        if ( $sql ) {
            $query = $this->db->query($sql);
            if( 0 < $query->num_rows() ){
                if ( $data['count'] ) {
                    $post_data = $query->result_array();
                    $temp_data = $post_data;
                } else {          
                    $i = 0;
                    $post_data = $query->result_array();
                    $temp_data = array();                    
                    foreach ( $post_data as $row ) {
                        
                        if ( isset($row['car_model_name']) ) {
                            $temp = explode(' ', $row['car_model_name']);
                            $post_data[$i]['car_model_name'] = $temp[0];
                        }
                        if ( isset($row['user_tel']) ) {
                            $temp = str_replace('+82', '', $row['user_tel']); 
                            $post_data[$i]['user_tel'] = $this->add_hyphen($temp);
                        }
                        if ( isset($row['car_reentrance_count']) ) {
                            if ( $row['car_reentrance_count'] < 0 ) {
                                $post_data[$i]['car_reentrance_count'] = 0;
                            }
                        }
                        
                        array_push($temp_data,$post_data[$i]);
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
    
    function add_hyphen($tel) {
        $tel = preg_replace("/[^0-9]/", "", $tel);    // 숫자 이외 제거
        if (substr($tel,0,2)=='02')
            return preg_replace("/([0-9]{2})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $tel);
        else if (strlen($tel)=='8' && (substr($tel,0,2)=='15' || substr($tel,0,2)=='16' || substr($tel,0,2)=='18'))
            // 지능망 번호이면
            return preg_replace("/([0-9]{4})([0-9]{4})$/", "\\1-\\2", $tel);
        else
            return preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $tel);
    }    
    
}