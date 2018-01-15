<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.2
 * @link http://coreui.io
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
    <link rel="shortcut icon" href="/assets/img/favicon.png">
    <title>TubeS_Admin</title>
    <!-- Icons -->
    <link href="/assets/vendors/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/vendors/css/simple-line-icons.min.css" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/customizing.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-datepicker.css" rel="stylesheet">
    <!-- Styles required by this views -->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o), m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-9510961-27', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- Bootstrap and necessary plugins -->
    <script src="/assets/vendors/js/jquery.min.js"></script>
    <script src="/assets/vendors/js/popper.min.js"></script>
    <script src="/assets/vendors/js/bootstrap.min.js"></script>
    <script src="/assets/vendors/js/pace.min.js"></script>
    <script src="/assets/vendors/js/bootstrap-datepicker.js"></script>
    <script src="/assets/vendors/js/bootstrap-datepicker.ko.js"></script>
    <!-- Plugins and scripts required by all views -->
    <script src="/assets/vendors/js/Chart.min.js"></script>
    <script src="http://cdn.ckeditor.com/4.7.1/full-all/ckeditor.js"></script>    
</head>
<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'					- Fixed Header

// Brand options
1. '.brand-minimized'       - Minimized brand (Only symbol)

// Sidebar options
1. '.sidebar-fixed'					- Fixed Sidebar
2. '.sidebar-hidden'				- Hidden Sidebar
3. '.sidebar-off-canvas'		- Off Canvas Sidebar
4. '.sidebar-minimized'			- Minimized Sidebar (Only icons)
5. '.sidebar-compact'			  - Compact Sidebar

// Aside options
1. '.aside-menu-fixed'			- Fixed Aside Menu
2. '.aside-menu-hidden'			- Hidden Aside Menu
3. '.aside-menu-off-canvas'	- Off Canvas Aside Menu

// Breadcrumb options
1. '.breadcrumb-fixed'			- Fixed Breadcrumb

// Footer options
1. '.footer-fixed'					- Fixed footer

-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button"> <span class="navbar-toggler-icon"></span> </button>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button"> <span class="navbar-toggler-icon"></span> </button>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <!--          <img src="/assets/img/avatars/6.jpg" class="/assets/img-avatar" alt="admin@bootstrapmaster.com">--><span class="d-md-down-none">admin</span> </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="/admin/setting"><i class="fa fa-wrench"></i> Settings</a> 
                    <a class="dropdown-item" href="/admin/auth/logout"><i class="fa fa-lock"></i> Logout</a> 
                </div>
            </li>
        </ul>
    </header>
    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item"> <a class="nav-link" href="/admin"><i class="icon-speedometer"></i> Home </a> </li>
                    <li class="nav-title"> Tube S Admin </li>
                    <li class="nav-item nav-dropdown <? if ( $key == 'manager' ) { echo 'open'; }; ?>"> <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-info"></i>서비스 운영</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item"> <a class="nav-link <? if ( $sub_key == 'manager_1' || $sub_key == 'manager_2' || $sub_key == 'manager_3' || $sub_key == 'manager_4' ) { echo 'active'; }; ?>" href="/admin/manager/list/1"><i class="icon-info"></i> 기본 정보</a> </li>
                            <li class="nav-item"> <a class="nav-link <? if ( $sub_key == 'manager_5' || $sub_key == 'manager_6' ) { echo 'active'; }; ?>" href="/admin/manager/list/5"><i class="icon-info"></i>트래픽 정보</a> </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown <? if ( $key == 'user' ) { echo 'open'; }; ?>"> <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i>회원관리</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item"> <a class="nav-link <? if ( $sub_key == 'user_1' || $sub_key == 'user_2' ) { echo 'active'; }; ?>" href="/admin/user/list/1"><i class="icon-people"></i>사용자 관리</a> </li>
                            <li class="nav-item"> <a class="nav-link <? if ( $sub_key == 'user_3' || $sub_key == 'user_4' || $sub_key == 'user_5' || $sub_key == 'user_6' ) { echo 'active'; }; ?>" href="/admin/user/list/3"><i class="icon-people"></i>광고주 관리</a> </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown <? if ( $key == 'event' ) { echo 'open'; }; ?>"> <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i>이벤트 관리</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item"> <a class="nav-link <? if ( $sub_key == 'event_1' || $sub_key == 'event_2' ) { echo 'active'; }; ?>" href="/admin/event/list/1"><i class="icon-star"></i>알림</a> </li>
                            <li class="nav-item"> <a class="nav-link <? if ( $sub_key == 'event_3' || $sub_key == 'event_4' ) { echo 'active'; }; ?>" href="/admin/event/list/3"><i class="icon-star"></i>로딩 광고 관리</a> </li>
                            <li class="nav-item"> <a class="nav-link <? if ( $sub_key == 'event_6' || $sub_key == 'event_7' ) { echo 'active'; }; ?>" href="/admin/event/list/6"><i class="icon-star"></i>공지</a> </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown <? if ( $key == 'statistics' ) { echo 'open'; }; ?>"> <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i>통계 정보</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item"> <a class="nav-link <? if ( $sub_key == 'statistics_1' ) { echo 'active'; }; ?>" href="/admin/statistics/list/1"><i class="icon-pie-chart"></i>동영상 소비 통계</a> </li>
                            <li class="nav-item"> <a class="nav-link <? if ( $sub_key == 'statistics_2' ) { echo 'active'; }; ?>" href="/admin/statistics/list/2"><i class="icon-pie-chart"></i>사용자 통계</a> </li>
                            <li class="nav-item"> <a class="nav-link <? if ( $sub_key == 'statistics_3' ) { echo 'active'; }; ?>" href="/admin/statistics/list/3"><i class="icon-pie-chart"></i>카테고리별 소비량</a> </li>
                            <li class="nav-item"> <a class="nav-link <? if ( $sub_key == 'statistics_4' ) { echo 'active'; }; ?>" href="/admin/statistics/list/4"><i class="icon-pie-chart"></i>뱃지 광고 노출 통계</a> </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
        <!-- Main content -->
        <main class="main">
            <? echo $container; ?>
        </main>
    </div>
    <footer class="app-footer"> <span><a href="/admin">TubeS</a> © 2017 TubeS.</span> <span class="ml-auto">Powered by <a href="http://coreui.io">TubeS</a></span> </footer>
    <script>
        /*
        new Chart(document.getElementById("chartjs-4"), {
            "type": "doughnut"
            , "data": {
                "labels": ["Red", "Blue", "Yellow"]
                , "datasets": [{
                    "label": "My First Dataset"
                    , "data": [300, 50, 100]
                    , "backgroundColor": ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)"]
                }]
            }
        });
        */
    </script>
    <script>
        //	tooltip
        
        function validationApplogIos(form,id) {
            if ( !form ) {
                form = $('#'+id).parents('form');
            }
            
            if ( $(form).find('input[name=ios_applog_version]').val().length == 0 ) {
                alert('버전명을 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=ios_applog_date]').val().length == 0 ) {
                alert('작성날짜를 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=ios_applog_description]').val().length == 0 ) {
                alert('설명을 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=ios_applog_dev]').val().length == 0 ) {
                alert('개발자를 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=ios_applog_writer]').val().length == 0 ) {
                alert('작성자를 입력해 주세요.');
                return false;
            };
            
            if ( id.length ) {
                $('#'+id).modal();
            } else {
                return true;
            };
            
        }
        
        function validationApplogAndroid (form,id) {
            if ( !form ) {
                form = $('#'+id).parents('form');
            }            
            
            if ( $(form).find('input[name=android_applog_version]').val().length == 0 ) {
                alert('버전명을 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=android_applog_date]').val().length == 0 ) {
                alert('작성날짜를 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=android_applog_description]').val().length == 0 ) {
                alert('설명을 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=android_applog_dev]').val().length == 0 ) {
                alert('개발자를 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=android_applog_writer]').val().length == 0 ) {
                alert('작성자를 입력해 주세요.');
                return false;
            };      
            
            if ( id.length ) {
                $('#'+id).modal();
            } else {
                return true;
            };
        }
        
        function validationAppdownload (form,id) {
            if ( !form ) {
                form = $('#'+id).parents('form');
            }    
            
            if ( $(form).find('input[name=appdownload_ios]').val().length == 0 ) {
                alert('IOS 다운로드수를 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=appdownload_android]').val().length == 0 ) {
                alert('Android 다운로드수를 입력해 주세요.');
                return false;
            };     
            
            if ( id.length ) {
                $('#'+id).modal();
            } else {
                return true;
            };
        }     
        
        function validationTraffic (form,id) {
            if ( !form ) {
                form = $('#'+id).parents('form');
            }    
            
            if ( $(form).find('input[name=traffic_space]').val().length == 0 ) {
                alert('총량을 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=traffic_space_use]').val().length == 0 ) {
                alert('사용량을 입력해 주세요.');
                return false;
            };    
            
            if ( id.length ) {
                $('#'+id).modal();
            } else {
                return true;
            };
        } 
        
        function validationStorage (form,id) {
            if ( !form ) {
                form = $('#'+id).parents('form');
            }    
            
            if ( $(form).find('input[name=storage_space]').val().length == 0 ) {
                alert('총량을 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=storage_space_use]').val().length == 0 ) {
                alert('사용량을 입력해 주세요.');
                return false;
            };   
            
            if ( id.length ) {
                $('#'+id).modal();
            } else {
                return true;
            };
        }   
        
        function validationServer (form,id) {
            if ( !form ) {
                form = $('#'+id).parents('form');
            }    
            
            if ( $(form).find('input[name=server_name]').val().length == 0 ) {
                alert('서버 제공사를 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=server_service_name]').val().length == 0 ) {
                alert('서비스 명을 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=server_open]').val().length == 0 ) {
                alert('서비스 시작 기간을 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=server_close]').val().length == 0 ) {
                alert('서비스 종료 기간을 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=server_tel]').val().length == 0 ) {
                alert('서버 관리자 연락처를 입력해 주세요.');
                return false;
            }; 
            
            if ( id.length ) {
                $('#'+id).modal();
            } else {
                return true;
            };
        }  
        
        function validationAduser (form,id) {
            if ( !form ) {
                form = $('#'+id).parents('form');
            }    
            
            if ( $(form).find('input[name=user_ad_name]').val().length == 0 ) {
                alert('광고주를 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=user_name]').val().length == 0 ) {
                alert('대표이름을 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=user_address]').val().length == 0 ) {
                alert('주소를 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=user_licensee_num]').val().length == 0 ) {
                alert('사업자 번호를 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=user_licensee_charge_name]').val().length == 0 ) {
                alert('담당자를 입력해 주세요.');
                return false;
            }; 
            if ( $(form).find('input[name=user_licensee_charge_group]').val().length == 0 ) {
                alert('부서를 입력해 주세요.');
                return false;
            }; 
            if ( $(form).find('input[name=user_licensee_charge_status]').val().length == 0 ) {
                alert('직책을 입력해 주세요.');
                return false;
            }; 
            if ( $(form).find('input[name=user_licensee_charge_mobile]').val().length == 0 ) {
                alert('Mobile을 입력해 주세요.');
                return false;
            }; 
            if ( $(form).find('input[name=user_licensee_charge_email]').val().length == 0 ) {
                alert('Email을 입력해 주세요.');
                return false;
            }; 
            if ( $(form).find('input[name=user_licensee_charge_tel]').val().length == 0 ) {
                alert('Tel을 입력해 주세요.');
                return false;
            }; 
            if ( $(form).find('input[name=user_ad_open_date]').val().length == 0 ) {
                alert('서비스 시작 기간을 입력해 주세요.');
                return false;
            }; 
            if ( $(form).find('input[name=user_ad_close_date]').val().length == 0 ) {
                alert('서비스 종료 기간을 입력해 주세요.');
                return false;
            };             
            
            if ( id.length ) {
                $('#'+id).modal();
            } else {
                return true;
            };
        }        
        
        function validationPost1 (form,id) {
            if ( !form ) {
                form = $('#'+id).parents('form');
            }    
            
            if ( $(form).find('input[name=post_name]').val().length == 0 ) {
                alert('작성자를 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=post_target]').val().length == 0 ) {
                alert('발송대상을 입력해 주세요.');
                return false;
            };   
            if ( $(form).find('input[name=post_title]').val().length == 0 ) {
                alert('제목을 입력해 주세요.');
                return false;
            };   
            /*
            if ( $(form).find('textarea[name=post_article]').val().length == 0 ) {
                alert('내용을 입력해 주세요.');
                return false;
            };    
            */
            
            if ( id.length ) {
                $('#'+id).modal();
            } else {
                return true;
            };
        }  
        
        function validationPost2 (form,id) {
            if ( !form ) {
                form = $('#'+id).parents('form');
            }    
            
            if ( $(form).find('input[name=post_name]').val().length == 0 ) {
                alert('작성자를 입력해 주세요.');
                return false;
            };
            if ( $(form).find('input[name=post_title]').val().length == 0 ) {
                alert('제목을 입력해 주세요.');
                return false;
            };   
            /*
            if ( $(form).find('textarea[name=post_article]').val().length == 0 ) {
                alert('내용을 입력해 주세요.');
                return false;
            };   
            */
            
            if ( id.length ) {
                $('#'+id).modal();
            } else {
                return true;
            };
        }          
        
        $(document).ready(function () {
            
            $('#all-checked').on('change', function () {
                if ( $(this).is(":checked") ) {
                    $('.all-checked').prop('checked', true) ;
                } else {
                    $('.all-checked').prop('checked', false) ;                    
                }
            });
            
            $('.validation-forme').on('submit', function () {
                /*
                if ( $(this).hasClass('validation-search1') ) {
                    
                    if ( $(this).find('input[name=ad_name]').val().length == 0 ) {
                        alert('광고주를 입력해 주세요.');
                        return false;
                    };
                    
                    return true;                    
                };
                $('#all-checked').on('change', function () {
                    alert('s');
                });
                */
                
                if ( $(this).hasClass('validation-post1') ) {
                    if ( validationPost1(this,'') ) {
                        return true;
                    } else {
                        return false;
                    }
                };       
                
                if ( $(this).hasClass('validation-post2') ) {
                    if ( validationPost2(this,'') ) {
                        return true;
                    } else {
                        return false;
                    }
                };                       
                
                if ( $(this).hasClass('validation-applog-ios') ) {
                    if ( validationApplogIos(this,'') ) {
                        return true;
                    } else {
                        return false;
                    }
                };       
                
                if ( $(this).hasClass('validation-applog-android') ) {
                    if ( validationApplogAndroid(this,'') ) {
                        return true;
                    } else {
                        return false;
                    }                  
                };   
                
                if ( $(this).hasClass('validation-appdownload') ) {
                    if ( validationAppdownload(this,'') ) {
                        return true;
                    } else {
                        return false;
                    }                    
                };
                
                if ( $(this).hasClass('validation-traffic') ) {
                    if ( validationTraffic(this,'') ) {
                        return true;
                    } else {
                        return false;
                    }   
                };                
                
                if ( $(this).hasClass('validation-storage') ) {
                    if ( validationStorage(this,'') ) {
                        return true;
                    } else {
                        return false;
                    }   
                };    
                
                if ( $(this).hasClass('validation-server') ) {
                    if ( validationServer(this,'') ) {
                        return true;
                    } else {
                        return false;
                    }                                                          
                };    
                
                if ( $(this).hasClass('validation-aduser') ) {
                    if ( validationAduser(this,'') ) {
                        return true;
                    } else {
                        return false;
                    }                                                          
                };                 
            });            
            
            $('.event-select').on('change', function () {
                
                if ( $(this).hasClass('custom-get') ) {
                    $('#out-form').find('input[name=post_id]').val($(this).parents('td').find('input[name=post_id]').val());
                    $('#out-form').find('input[name=post_action]').val($(this).parents('td').find('select').val());                    
                    $('#out-form').submit();
                } else {
                    $(this).parents('form').submit();                    
                }

            });
            
            $('#passwrodresetform').on('submit', function () {
                if ( $('#passwrodresetform input[name=user_password]').val() ) {
                    if ( $('#passwrodresetform input[name=user_password]').val() == $('#passwrodresetform input[name=user_re_password]').val() ) {
                        $(this).submit();
                    } else {
                        alert('비밀번호가 일치하지 않습니다. 다시 확인하시고 입력해 주세요');
                    };
                    
                } else {
                    alert('비밀번호를 입력해주세요.');
                }
                return false;
            });
            
            $('[data-toggle="tooltip"]').tooltip();
            $('#sandbox-container-submit a').datepicker({
                language: "kr"
                , format: "yyyy-mm-dd"
                , orientation: "bottom auto"
            }).change(function() {
                $(this).parents('form').submit();
            });
            
            $('#sandbox-container a').datepicker({
                language: "kr"
                , format: "yyyy-mm-dd"
                , orientation: "bottom auto"
            });            
            
            $('#category').on('change', function () {
                $(this).parents('form').submit();
            });            
            
            $('#country').on('change', function () {
                $(this).parents('form').submit();
            });
            
            $('.btn-range').on('click', function () {
                $('#range').val($(this).attr('data-value')); 
                $(this).parents('form').submit();                            
            });
            $('#target-select').on('change', function () {
                
                // target-select2
                $('#target-select2').attr('name','');                                                        
                $('#target-select2 option').remove();
                if ( $(this).val() == 'country' ) {
                    /*
                    <option value="KR">대한민국</option>
                    <option value="US">미국</option>
                    <option value="JP">일본</option>
                    <option value="VN">베트남</option>
                    <option value="GL">그린랜드</option>                       
                    */
                    var markup = [
                        '<option value="">선택</option>',                        
                        '<option value="KR">대한민국</option>',
                        '<option value="US">미국</option>',
                        '<option value="JP">일본</option>',
                        '<option value="VN">베트남</option>',
                        '<option value="GL">그린랜드</option>'                       
                    ].join('.');
                    $('#target-select2').append(markup);
                    $('#target-select2').attr('name','country');
                } else if ( $(this).val() == 'sale' ) {
                    var markup = [
                        '<option value="">선택</option>',                                                
                        '<option value="free">무료</option>',
                        '<option value="charge">유료</option>'
                    ].join('.');
                    $('#target-select2').append(markup);
                    $('#target-select2').attr('name','sale');                    
                } else if ( $(this).val() == 'os' ) {                    
                    var markup = [
                        '<option value="">선택</option>',                                                
                        '<option value="android">Android</option>',
                        '<option value="ios">IOS</option>'
                    ].join('.');
                    $('#target-select2').attr('name','os');                                        
                    $('#target-select2').append(markup);
                } else {
                    var markup = [
                        '<option value="">전체</option>'
                    ].join('.');
                    $('#target-select2').append(markup);
                }
            });
            
            $('#target-select2').on('change', function () {
                $(this).parents('form').submit();
            })
        });

    </script>
</body>
<!-- GenesisUI main scripts -->
<script src="/assets/js/app.js"></script>    
</html>