<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">홈</a></li>
    <li class="breadcrumb-item"><a href="#">회원관리</a></li>
    <li class="breadcrumb-item">사용자 관리</li>
</ol>
<div class="container-fluid">
    <h1 class="bd-title">사용자 관리</h1>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
                <div class="tab-content">
                    <form class="tab-pane active" id="profile" role="tabpanel">
                        <div class="row">
                            <div class="form-group offset-8 col-2 text-right">
                                <select class="custom-select form-control" name="sort" id="target-select">
                                    <option selected>전체</option>
                                    <option value="country" <? if ( $sort == 'country' ) { echo 'selected'; }; ?>>국적</option>
                                    <option value="os" <? if ( $sort == 'os' ) { echo 'selected'; }; ?>>OS</option>
                                    <option value="sale" <? if ( $sort == 'sale' ) { echo 'selected'; }; ?>>유료/무료</option>
                                </select>
                            </div>
                            <div class="form-group col-2 text-right">
                                
                                <?
                                $name = '';
                                if ( $sort == 'country' ) {
                                    $name = 'country';
                                } elseif ( $sort == 'os' ) {
                                    $name = 'os';                                    
                                } elseif ( $sort == 'sale' ) {                                    
                                    $name = 'sale';                                    
                                };
                                ?>
                                <select class="custom-select form-control" id="target-select2" name="<? echo $name; ?>">
                                    <option selected>선택</option>
                                    <?
                                    if ( $sort == 'country' ) {
                                        ?>
                                    <option value="KR" <? if ( $country == 'KR' ) { echo 'selected'; }; ?>>대한민국</option>
                                    <option value="US" <? if ( $country == 'US' ) { echo 'selected'; }; ?>>미국</option>
                                    <option value="JP" <? if ( $country == 'JP' ) { echo 'selected'; }; ?>>일본</option>
                                    <option value="VN" <? if ( $country == 'VN' ) { echo 'selected'; }; ?>>베트남</option>
                                    <option value="GL" <? if ( $country == 'GL' ) { echo 'selected'; }; ?>>그린랜드</option>
                                        <?
                                    } elseif ( $sort == 'os' ) {
                                        ?>
                                    <option value="android" <? if ( $os == 'android' ) { echo 'selected'; }; ?>>Android</option>
                                    <option value="ios" <? if ( $os == 'ios' ) { echo 'selected'; }; ?>>IOS</option>
                                        <?                                        
                                    } elseif ( $sort == 'sale' ) {                                    
                                        ?>
                                    <option value="free" <? if ( $sale == 'free' ) { echo 'selected'; }; ?>>무료</option>
                                    <option value="charge" <? if ( $sale == 'charge' ) { echo 'selected'; }; ?>>유료</option>
                                        <?                                        
                                    };
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>국적</th>
                                            <th>OS</th>
                                            <th>유료/무료</th>
                                            <th>다운로드 일자</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?
                                    if ( $response['status'] == 200 ) {
                                        if ( 0 < $response['data']['count'] ) {
                                            $temp = ((($p * 2) * 10) - 20 ); 
                                            $num = $response['data']['out_cnt'] - $temp; 
                                            foreach ( $response['data']['out'] as $row ) {
                                                ?>
                                        <tr>
                                            <th scope="row"><? echo $num; ?></th>
                                            <td><? if ( strlen($row['user_country']) != 0 ) { echo $row['user_country']; } else { echo 'ok'; }; ?></td>
                                            <td><? if ( $row['user_device_os'] == 'Android' ) { echo 'Android'; } else { echo 'IOS'; }; ?></td>
                                            <td><? if ( $row['user_status'] == 1 ) { echo '무료'; } else { echo '유료'; } ?></td>
                                            <td><? echo date("Y-m-d", strtotime($row['user_register_date'])); ?></td>
                                        </tr>                                        
                                                <?
                                                $num--;
                                            };
                                        };
                                    };
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <nav>
                            <? echo $this->pagination->create_links(); ?>                            
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
<!-- /.conainer-fluid -->
<script type="text/javascript">
$(document).ready(function () {    
    var ctx = document.getElementById('ios-user').getContext('2d');
    var chart = new Chart(ctx1, {
    type: 'doughnut'
    , data: {
        labels: ["사용자", "다운로드"]
        , datasets: [{
            data: [30, 90]
            , backgroundColor: ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)"]
    }]
    }, // Configuration options go here
    options: {}
    });        
});
</script>