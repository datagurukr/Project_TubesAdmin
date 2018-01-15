<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth
$route['api/auth/login'] = "api/auth/login";
$route['api/auth/code'] = "api/auth/code";

// User
$route['api/user/id'] = "api/user/id";
$route['api/user/all'] = "api/user/all";
$route['api/user/update'] = "api/user/edit/update";

// campaign
$route['api/campaign/create'] = "api/campaign/edit/create";
$route['api/campaign/update'] = "api/campaign/edit/update";
$route['api/campaign/out/id'] = "api/campaign/out/id";
$route['api/campaign/out/all'] = "api/campaign/out/all";
$route['api/campaign/out/category'] = "api/campaign/out/category";

// category
$route['api/category/create'] = "api/category/edit/create";
$route['api/category/update'] = "api/category/edit/update";
$route['api/category/out/id'] = "api/category/out/id";
$route['api/category/out/all'] = "api/category/out/all";
$route['api/category/out/user'] = "api/category/out/user";

// category / video
$route['api/category/video/create'] = "api/video/edit/create";
$route['api/category/video/delete'] = "api/video/edit/delete";
$route['api/category/video/out/id'] = "api/video/out/id";
$route['api/category/video/out/category'] = "api/video/out/category";

$route['api/upload'] = "api/upload/ckupload";

// 테스트 폼
$route['api/testform'] = "api/testform";
// admin : 관리자 메인
$route['admin'] = "admin/manager/index/1"; // 기본정보 / 관리자현황
// admin / auth/login : 로그인
$route['admin/auth/login'] = "admin/auth/index/1"; // 인증 / 로그인
$route['admin/auth/register'] = "admin/auth/index/2"; // 인증 / 회원가입
$route['admin/auth/logout'] = "admin/auth/index/3"; // 인증 / 로그아웃
$route['admin/setting'] = "admin/auth/index/4"; // 인증 / 정보수정
// admin / manager : 서비스 운영
$route['admin/manager'] = "admin/manager/index/1"; // 기본정보 / 관리자현황
$route['admin/manager/list/1'] = "admin/manager/index/1"; // 기본정보 / 관리자현황
$route['admin/manager/list/2'] = "admin/manager/index/2"; // 기본정보 / 사용자 현황
$route['admin/manager/list/3'] = "admin/manager/index/3"; // 기본정보 / 광고주 관리
$route['admin/manager/list/4'] = "admin/manager/index/4"; // 기본정보 / 현황정보 관리
$route['admin/manager/list/5'] = "admin/manager/index/5"; // 트래픽정보 / 스토리지 사용현환
$route['admin/manager/list/6'] = "admin/manager/index/6"; // 트래픽정보 / 현황 정보관리
// admin / user : 회원관리
$route['admin/user/list/1'] = "admin/user/index/1"; // 회원관리 / 사용자 관리
$route['admin/user/list/2'] = "admin/user/index/2"; // 회원관리 / 후기관리
$route['admin/user/list/3'] = "admin/user/index/3"; // 회원관리 / 광고주 관리
$route['admin/user/list/4'] = "admin/user/index/4"; // 회원관리 / 광고주 등록
$route['admin/user/list/5'] = "admin/user/index/5"; // 회원관리 / 광고주 상세 / 정보
$route['admin/user/list/6'] = "admin/user/index/6"; // 회원관리 / 광고주 상세 / 뱃지 이미지
// admin / event : 이벤트관리
$route['admin/event/list/1'] = "admin/event/index/1"; // 알람 / 사용자 알림
$route['admin/event/list/2'] = "admin/event/index/2"; // 알람 / 광고주 알림
$route['admin/event/list/3'] = "admin/event/index/3"; // 로딩 광고 관리 / 광고 설정
$route['admin/event/list/4'] = "admin/event/index/4"; // 로딩 광고 관리 / 이벤트성 광고 설정
$route['admin/event/list/5'] = "admin/event/index/5"; // 로딩 광고 관리 / 광고 생성/수정
$route['admin/event/list/6'] = "admin/event/index/6"; // 공지 / 공지사항
$route['admin/event/list/7'] = "admin/event/index/7"; // 공지 / 불만사항
$route['admin/event/list/8'] = "admin/event/index/8"; // 공지 / 공지사항 / 에디터
$route['admin/event/list/9'] = "admin/event/index/9"; // 공지 / 불만사항 / 에디터
// admin / statistics : 서비스 통계
$route['admin/statistics/list/1'] = "admin/statistics/index/1"; // 동영상 소비 통계
$route['admin/statistics/list/2'] = "admin/statistics/index/2"; // 사용자 통계
$route['admin/statistics/list/3'] = "admin/statistics/index/3"; // 카테고리별 소비량
$route['admin/statistics/list/4'] = "admin/statistics/index/4"; // 뱃지 광고 노출 통계