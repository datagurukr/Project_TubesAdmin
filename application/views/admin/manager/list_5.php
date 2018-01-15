<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">홈</a></li>
    <li class="breadcrumb-item"><a href="#">서비스운영</a></li>
    <li class="breadcrumb-item">트래픽 정보</li>
</ol>
<div class="container-fluid">
    <h1 class="bd-title">트래픽 정보</h1>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" href="/admin/manager/list/5">스토리지 사용현황</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/admin/manager/list/6">현황 정보관리</a> </li>
                </ul>
                <div class="tab-content">
                    <form class="tab-pane active" id="storage" role="tabpanel" enctype="application/x-www-form-urlencoded">
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
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header"> 스토리지 사용량 </div>
                                    <div class="card-body">
                                        <canvas id="doughnutchart1"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header"> 네트워크 사용량 </div>
                                    <div class="card-body">
                                        <canvas id="doughnutchart2"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header"> 서버정보 </div>
                                    <div class="card-body">
                                        <form>
                                            
                                            <?
                                            $server_name = "";
                                            $server_service_name = "";
                                            $server_open = "";
                                            $server_close = "";
                                            $server_tel = "";                                                                          
                                            if ( $result_server ) {
                                                $server_name = $result_server[0]['server_name'];
                                                $server_service_name = $result_server[0]['server_service_name'];
                                                $server_open = $result_server[0]['server_open'];
                                                $server_close = $result_server[0]['server_close'];
                                                $server_tel = $result_server[0]['server_tel'];                                        
                                            };
                                            ?>
                                            
                                            
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <label>서버 제공사</label>
                                                    <input type="text" class="form-control" placeholder="<? echo $server_name; ?>" readonly> </div>
                                                <div class="form-group col-6">
                                                    <label>서비스 명</label>
                                                    <input type="text" class="form-control" placeholder="<? echo $server_service_name; ?>" readonly> </div>
                                            </div>
                                            <div class="form-row">
                                                <label class="col-12">서비스 기간</label>
                                                <div class="form-group col">
                                                    <input type="text" class="form-control" value="<? echo $server_open; ?>" readonly> </div>
                                                <div class="form-group col">
                                                    <input type="text" class="form-control" value="<? echo $server_close; ?>" readonly> </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <label>서버 관리자 연락처</label>
                                                    <input type="tel" class="form-control" placeholder="<? echo $server_tel; ?>" readonly> </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
</div>
<!-- /.conainer-fluid -->

<?
// $result_storage
// $result_traffic
$storage_space = 0;
$storage_space_use = 0;
if ( $result_storage ) {
    $storage_space = $result_storage[0]['storage_space'];
    $storage_space_use = $result_storage[0]['storage_space_use'];    
};
$traffic_space = 0;
$traffic_space_use = 0;
if ( $result_traffic ) {
    $traffic_space = $result_traffic[0]['traffic_space'];
    $traffic_space_use = $result_traffic[0]['traffic_space_use'];    
};
?>

<script type="text/javascript">
$(document).ready(function () {    
    var ctx = document.getElementById('doughnutchart1').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'doughnut'
    , data: {
        labels: ["사용량", "잔여량"]
        , datasets: [{
            data: [<? echo $storage_space_use; ?>, <? echo $storage_space-$storage_space_use; ?>]
            , backgroundColor: ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)"]
    }]
    }, // Configuration options go here
    options: {}
    }); 
    
    var ctx = document.getElementById('doughnutchart2').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'doughnut'
    , data: {
        labels: ["사용량", "잔여량"]
        , datasets: [{
            data: [<? echo $traffic_space_use; ?>, <? echo $traffic_space-$traffic_space_use; ?>]
            , backgroundColor: ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)"]
    }]
    }, // Configuration options go here
    options: {}
    });     
});
</script>