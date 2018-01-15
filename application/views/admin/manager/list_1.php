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
                    <li class="nav-item"> <a class="nav-link active" href="/admin/manager/list/1">관리자현황</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/admin/manager/list/2">사용자 현황</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/admin/manager/list/3">광고주 현황</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/admin/manager/list/4">현황정보 관리</a> </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">회사명</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">(주)트리니티랩</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">대표</label>
                                        <div class="col-md-9"> 길현배 </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">관리자 명</label>
                                        <div class="col-md-9"> <? if (isset($result_admin[0]['user_licensee_charge_name'])) { echo $result_admin[0]['user_licensee_charge_name']; }; ?> </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="password-input">관리자 ID</label>
                                        <div class="col-md-9"> <? if (isset($result_admin[0]['user_email'])) { echo $result_admin[0]['user_email']; }; ?> </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="disabled-input">관리자 ID 현황</label>
                                        <div class="col-md-9"> 1 개 </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="textarea-input">총 다운로드 숫자</label>
                                        
                                        <?
                                        $appdownload_ios = 0;
                                        $appdownload_android = 0;
                                        if ( $result_appdownload ) {
                                            $appdownload_ios = $result_appdownload[0]['appdownload_ios'];
                                            $appdownload_android = $result_appdownload[0]['appdownload_android'];
                                        };
                                        ?> 
                                        
                                        
                                        <div class="col-md-9"> <? echo $appdownload_ios + $appdownload_android; ?> 회 </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="textarea-input">광고주(누적)</label>
                                        <div class="col-md-9"> 0 명 </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="textarea-input">광고주(현재)</label>
                                        <div class="col-md-9"> 0 명 </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="textarea-input">서버관리사</label>
                                        <div class="col-md-9"> 카페24 </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="textarea-input">iOS 업데이트(최근)</label>
                                        <div class="col-md-9"> <? if ( $result_applog_ios ) { echo $result_applog_ios[0]['applog_register_date']; }; ?>
                                            <div class="float-right">
                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target=".ios-modal-lg"><i class="fa fa-lightbulb-o"></i>&nbsp; 버전정보보기</button>
                                                <div class="modal fade ios-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">iOS 버전 정보</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-sm table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>버전</th>
                                                                            <th>내용</th>
                                                                            <th>개발자</th>
                                                                            <th>작성자</th>
                                                                            <th>날짜</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
                                                                        if ( $result_applog_ios ) {
                                                                            $cnt = count($result_applog_ios);
                                                                            foreach ( $result_applog_ios as $row ) {
                                                                                ?>
                                                                        <tr>
                                                                            <th scope="row"><? echo $cnt; ?></th>
                                                                            <td><? echo $row['applog_version']; ?></td>
                                                                            <td><a href="#!" data-toggle="tooltip" data-placement="bottom" title="<? echo $row['applog_description']; ?>"><? echo $row['applog_description']; ?></a></td>
                                                                            <td><? echo $row['applog_dev']; ?></td>
                                                                            <td><? echo $row['applog_writer']; ?></td>
                                                                            <td><? echo $row['applog_date']; ?></td>
                                                                        </tr>
                                                                                <?
                                                                                $cnt--;
                                                                            };
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">확인</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="textarea-input">Android 업데이트(최근)</label>
                                        <div class="col-md-9"> <? if ( $result_applog_android ) { echo $result_applog_android[0]['applog_register_date']; }; ?>
                                            <div class="float-right">
                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target=".android-modal-lg"><i class="fa fa-lightbulb-o"></i>&nbsp; 버전정보보기</button>
                                                <div class="modal fade android-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Android 버전 정보</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-sm table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>버전</th>
                                                                            <th>내용</th>
                                                                            <th>개발자</th>
                                                                            <th>작성자</th>
                                                                            <th>날짜</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
                                                                        if ( $result_applog_android ) {
                                                                            $cnt = count($result_applog_android);
                                                                            foreach ( $result_applog_android as $row ) {
                                                                                ?>
                                                                        <tr>
                                                                            <th scope="row"><? echo $cnt; ?></th>
                                                                            <td><? echo $row['applog_version']; ?></td>
                                                                            <td><a href="#!" data-toggle="tooltip" data-placement="bottom" title="<? echo $row['applog_description']; ?>"><? echo $row['applog_description']; ?></a></td>
                                                                            <td><? echo $row['applog_dev']; ?></td>
                                                                            <td><? echo $row['applog_writer']; ?></td>
                                                                            <td><? echo $row['applog_date']; ?></td>
                                                                        </tr>
                                                                                <?
                                                                                $cnt--;
                                                                            };
                                                                        }
                                                                        ?>                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">확인</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <label class="col-md-3 form-control-label" for="textarea-input">ceo 접속일시(최근)</label>
                                    <div class="col-md-9"> 
                                        <?
                                        if ( $result_log ) {
                                            echo $result_log[0]['loginlog_register_date'].' / '.$result_log[0]['loginlog_ip_address'];
                                        }
                                        ?>
                                        <div class="float-right">
                                            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target=".history-modal-lg"><i class="fa fa-lightbulb-o"></i>&nbsp; 자세히보기</button>
                                            <div class="modal fade history-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">최근접속</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-sm table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>IP</th>
                                                                        <th>날짜</th>
                                                                        <th>시간</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?
                                                                    if ( $result_log ) {
                                                                        $cnt = count($result_log);
                                                                        foreach ( $result_log as $log_row ) {
                                                                            ?>
                                                                    <tr>
                                                                        <th scope="row"><? echo $cnt; ?></th>
                                                                        <td><? echo $log_row['loginlog_ip_address']; ?></td>
                                                                        <td><? echo date("Y-m-d", strtotime($log_row['loginlog_register_date'])); ?></td>
                                                                        <td><? echo date("H:i:s", strtotime($log_row['loginlog_register_date'])); ?></td>
                                                                    </tr>                                                                    
                                                                            <?
                                                                            $cnt--;
                                                                        };
                                                                    };
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">확인</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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