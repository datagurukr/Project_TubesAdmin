<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">홈</a></li>
    <li class="breadcrumb-item"><a href="#">서비스운영</a></li>
    <li class="breadcrumb-item">기본정보</li>
</ol>
<div class="container-fluid">
    <h1 class="bd-title">기본정보</h1>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link" href="/admin/manager/list/1">관리자현황</a> </li>
                    <li class="nav-item"> <a class="nav-link active" href="/admin/manager/list/2">사용자 현황</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/admin/manager/list/3">광고주 현황</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/admin/manager/list/4">현황정보 관리</a> </li>
                </ul>
                <div class="tab-content">
                    <form class="tab-pane active" id="profile" role="tabpanel" enctype="application/x-www-form-urlencoded">
                        <div class="row">
                            <input type="hidden" id="range" name="range" value="<? echo $range; ?>">
                            <div class="col-3">
                                <nav>
                                    <ul class="pagination">
                                        <li id="sandbox-container-submit">
                                            <a href="#">
                                                <input type="text" name="date" class="input-dp" value="<? echo $date; ?>" readonly> </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                            <div class="col-3">
                                <div class="btn-group"> 
                                    <a href="#!" data-value="day" class="btn btn-range btn-outline-primary<? if ( $range == 'day' ) { echo ' active'; }; ?>">일간</a> 
                                    <a href="#!" data-value="week" class="btn btn-range btn-outline-primary<? if ( $range == 'week' ) { echo ' active'; }; ?>">주간</a> 
                                    <a href="#!" data-value="month" class="btn btn-range btn-outline-primary<? if ( $range == 'month' ) { echo ' active'; }; ?>">월간</a> 
                                </div> 
                                <a href="#!" class="btn btn-outline-primary" data-toggle="modal" data-target="#download">
                                    <span class="fa fa-download" aria-hidden="true"></span>
                                </a> 
                            </div>
                            <div class="modal fade" id="download" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-info modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Download</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col text-center"> <a href="#!" class="btn btn-link" data-dismiss="modal">Excel 다운로드</a> </div>
                                            <div class="col text-center"> <a href="#!" class="btn btn-link" data-dismiss="modal">Image 다운로드</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <div class="offset-3 col-3 text-right">
                                <select class="custom-select" name="country" id="country">
                                    <option selected value="ALL" <? if ( $country == 'ALL' ) { echo 'selected'; };?>>전체</option>
                                    <option value="KR" <? if ( $country == 'KR' ) { echo 'selected'; };?>>대한민국</option>
                                    <option value="US" <? if ( $country == 'US' ) { echo 'selected'; };?>>미국</option>
                                    <option value="JP" <? if ( $country == 'JP' ) { echo 'selected'; };?>>일본</option>
                                    <option value="VN" <? if ( $country == 'VN' ) { echo 'selected'; };?>>베트남</option>
                                    <option value="GL" <? if ( $country == 'GL' ) { echo 'selected'; };?>>그린랜드</option>   
                                </select>
                            </div>
                            <!--
                            <div class="modal fade" id="noresult" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-danger modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Alert</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>검색 결과 없음</p>
                                        </div>
                                        <div class="modal-footer text-center">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">확인</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
--></div>
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header"> iOS </div>
                                    <div class="card-body">
                                        <canvas id="doughnutchart1"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header"> Android </div>
                                    <div class="card-body">
                                        <canvas id="doughnutchart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
</div>
<!-- /.conainer-fluid -->

<?
$appdownload_all = 0;
$appdownload_user_ios = $result_appdownload_ios[0]['cnt'];
$appdownload_user_android = $result_appdownload_android[0]['cnt'];
if ( $result_appdownload ) {
    $appdownload_ios = $result_appdownload[0]['appdownload_ios'];
    $appdownload_android = $result_appdownload[0]['appdownload_android'];
    $appdownload_all = $appdownload_ios + $appdownload_android;
} else {
    $appdownload_ios = $appdownload_user_ios;
    $appdownload_android = $appdownload_user_android;    
};
?>

<script type="text/javascript">
$(document).ready(function () {    
    var ctx = document.getElementById('doughnutchart1').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'doughnut'
    , data: {
        labels: ["사용자", "다운로드"]
        , datasets: [{
            data: [<? echo $appdownload_user_ios; ?>, <? echo $appdownload_ios; ?>]
            , backgroundColor: ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)"]
    }]
    }, // Configuration options go here
    options: {}
    }); 
    
    var ctx = document.getElementById('doughnutchart2').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'doughnut'
    , data: {
        labels: ["사용자", "다운로드"]
        , datasets: [{
            data: [<? echo $appdownload_user_android; ?>, <? echo $appdownload_android; ?>]
            , backgroundColor: ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)"]
    }]
    }, // Configuration options go here
    options: {}
    });     
});
</script>