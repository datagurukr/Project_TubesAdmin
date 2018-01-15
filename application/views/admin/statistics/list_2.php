<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">홈</a></li>
    <li class="breadcrumb-item"><a href="#">통계 정보</a></li>
    <li class="breadcrumb-item">사용자 통계</li>
</ol>
<div class="container-fluid">
    <h1 class="bd-title">사용자 통계</h1>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
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
                            <!--
                            <div class="col text-right">
                                <select class="custom-select form-control">
                                    <option selected>전체</option>
                                    <option value="1">광고주</option>
                                    <option value="3">광고주</option>
                                    <option value="3">광고주</option>
                                    <option value="2">광고주</option>
                                </select>
                            </div>
                            <div class="col text-right">
                                <select class="custom-select form-control">
                                    <option selected>전체</option>
                                    <option value="1">뱃지광고</option>
                                    <option value="3">상단알림</option>
                                </select>
                            </div>
                            -->
                            
                            <?
                            $count = 0;
                            if ( $response['status'] == 200 ) {
                                if ( 0 < $response['data']['count'] ) {
                                    $temp = ((($p * 2) * 10) - 20 ); 
                                    foreach ( $response['data']['out'] as $row ) {
                                        $count = $count + $row['s_count'];                
                                    };
                                };
                            };
                            ?>
                            
                            
                            <div class="col-3 text-right">
                                <h2><i class="icon-chart"></i> <? echo $count; ?> 건</h2> </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header"> 서비스 사용자 숫자 </div>
                                    <div class="card-body">
                                        <canvas id="line-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="row">
                            <div class="col">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>날짜</th>
                                            <td>2017-05-05</td>
                                            <td>2017-12-05</td>
                                            <td>2017-11-09</td>
                                            <td>2017-05-24</td>
                                            <td>2017-02-22</td>
                                        </tr>
                                        <tr>
                                            <th>조회수</th>
                                            <td>1290002</td>
                                            <td>1103234</td>
                                            <td>932344</td>
                                            <td>923213</td>
                                            <td>893231</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        -->
                        <nav>
                            <!--
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true">&laquo;</span> <span class="sr-only">Previous</span> </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true">&raquo;</span> <span class="sr-only">Next</span> </a>
                                </li>
                            </ul>
                            -->
                        </nav>
                    </form>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
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
<!-- /.conainer-fluid -->

<?
$labels = '';
$counts = '';
if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $temp = ((($p * 2) * 10) - 20 ); 
        foreach ( $response['data']['out'] as $row ) {
            if ( strlen($labels) ) {
                $labels = $labels.',"'.$row['s_date'].'"';                
            } else {
                $labels = $labels.'"'.$row['s_date'].'"';                
            };
            if ( strlen($counts) ) {
                $counts = $counts.','.$row['s_count'].'';                
            } else {
                $counts = $counts.''.$row['s_count'].'';                
            };            
        };
    };
};
?>

<script type="text/javascript">
$(document).ready(function () {
    //chart		
    var ctx1 = document.getElementById('line-chart').getContext('2d');
    var chart1 = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: [<? echo $labels; ?>],
            datasets: [{
                            label: '사용자수',
                data: [<? echo $counts; ?>],
                            backgroundColor:["rgb(255, 99, 132)"]
            }]
        },

        // Configuration options go here
        options: {

        }
    });
});    
</script>
