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

<body class="app flex-row align-items-center">
    <? echo $container; ?>
    <script>
        //	tooltip
        $(document).ready(function () {
            $('.validation-forme').on('submit', function () {
                if ( $(this).hasClass('validation-login') ) {
                    
                    if ( $(this).find('input[name=user_email]').val().length == 0 ) {
                        alert('이메일주소를 입력해 주세요.');
                        return false;
                    };
                    
                    if ( $(this).find('input[name=user_password]').val().length == 0 ) {
                        alert('비밀번호를 입력해 주세요.');
                        return false;
                    };
                    
                    return true;                    
                };
            });
        });
    </script>
</body>
</html>