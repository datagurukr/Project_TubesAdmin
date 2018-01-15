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
                    <li class="nav-item"> <a class="nav-link" href="/admin/manager/list/2">사용자 현황</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/admin/manager/list/3">광고주 현황</a> </li>
                    <li class="nav-item"> <a class="nav-link active" href="/admin/manager/list/4">현황정보 관리</a> </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="statuses" role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#ios-info" role="tab" aria-controls="home">iOS 버전정보</a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#android-info" role="tab" aria-controls="profile">android 버전정보</a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#down-info" role="tab" aria-controls="messages">다운로드 정보</a> </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="ios-info" role="tabpanel">
                                <form method="post" enctype="application/x-www-form-urlencoded" class="validation-forme validation-applog-ios">
                                    <?
                                    $ios_applog_version = '';
                                    $ios_applog_description = '';
                                    $ios_applog_date = '';
                                    $ios_applog_dev = '';
                                    $ios_applog_write = '';
                                    if ( $result_applog_ios ) {
                                        $ios_applog_version = $result_applog_ios[0]['applog_version'];
                                        $ios_applog_description = $result_applog_ios[0]['applog_description'];
                                        $ios_applog_date = $result_applog_ios[0]['applog_date'];                                        
                                        $ios_applog_dev = $result_applog_ios[0]['applog_dev'];
                                        $ios_applog_write = $result_applog_ios[0]['applog_writer'];                                        
                                    };
                                    ?>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>버전</label>
                                            <input type="text" class="form-control" placeholder="<? echo $ios_applog_version; ?>" name="ios_applog_version"> </div>
                                        <div class="form-group col-6">
                                            <label>날짜</label>
                                            <input type="date" class="form-control" name="ios_applog_date" value="<? echo $ios_applog_date; ?>"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label>내용</label>
                                        <input type="text" class="form-control" placeholder="<? echo $ios_applog_description; ?>" name="ios_applog_description"> </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>개발자</label>
                                            <input type="text" class="form-control" placeholder="<? echo $ios_applog_dev; ?>" name="ios_applog_dev"> </div>
                                        <div class="form-group col-6">
                                            <label>작성자</label>
                                            <input type="text " class="form-control" placeholder="<? echo $ios_applog_write; ?>" name="ios_applog_writer"> </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>최근 업데이트</label>
                                            <?
                                            if ( $result_applog_ios ) {
                                                ?>
                                                <input type="text" class="form-control" placeholder="<? echo $result_applog_ios[0]['applog_register_date']; ?>" disabled>
                                        <?
                                            } else {
                                                ?>
                                                <input type="text" class="form-control" placeholder="최근 업데이트한 기록이 없습니다." disabled>                                       
                                                <?
                                            };
                                            ?>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary" onclick="validationApplogIos(false,'confirm1')">저장</button>
                                    </div>
                                    <div class="modal fade" id="confirm1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-primary modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Confirm</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>저장하시겠습니까?</p>
                                                </div>
                                                <div class="modal-footer text-center">
                                                    <button type="submit" class="btn btn-primary">예</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">아니오</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="android-info" role="tabpanel">
                                <form method="post" enctype="application/x-www-form-urlencoded" class="validation-forme validation-applog-android">
                                    <?
                                    $android_applog_version = '';
                                    $android_applog_description = '';
                                    $android_applog_date = '';
                                    $android_applog_dev = '';
                                    $android_applog_write = '';
                                    if ( $result_applog_android ) {
                                        $android_applog_version = $result_applog_android[0]['applog_version'];
                                        $android_applog_description = $result_applog_android[0]['applog_description'];
                                        $android_applog_date = $result_applog_android[0]['applog_date'];
                                        $android_applog_dev = $result_applog_android[0]['applog_dev'];
                                        $android_applog_write = $result_applog_android[0]['applog_writer'];                                        
                                    };
                                    ?>                                    
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>버전</label>
                                            <input type="text" class="form-control" placeholder="<? echo $android_applog_version; ?>" name="android_applog_version"> </div>
                                        <div class="form-group col-6">
                                            <label>날짜</label>
                                            <input type="date" class="form-control" name="android_applog_date" value="<? echo $ios_applog_date; ?>"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label>내용</label>
                                        <input type="text" class="form-control" placeholder="<? echo $android_applog_description; ?>" name="android_applog_description"> </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>개발자</label>
                                            <input type="text" class="form-control" placeholder="<? echo $android_applog_dev; ?>" name="android_applog_dev"> </div>
                                        <div class="form-group col-6">
                                            <label>작성자</label>
                                            <input type="text " class="form-control" placeholder="<? echo $android_applog_write; ?>" name="android_applog_writer"> </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>최근 업데이트</label>
                                            <?
                                            if ( $result_applog_android ) {
                                                ?>
                                                <input type="text" class="form-control" placeholder="<? echo $result_applog_android[0]['applog_register_date']; ?>" disabled>
                                        <?
                                            } else {
                                                ?>
                                                <input type="text" class="form-control" placeholder="최근 업데이트한 기록이 없습니다." disabled>                                        
                                                <?
                                            };
                                            ?>                                            
                                            </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary" onclick="validationApplogAndroid(false,'confirm2')">저장</button>
                                    </div>
                                    <div class="modal fade" id="confirm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-primary modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Confirm</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>저장하시겠습니까?</p>
                                                </div>
                                                <div class="modal-footer text-center">
                                                    <button type="submit" class="btn btn-primary">예</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">아니오</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="down-info" role="tabpanel">
                                <form method="post" enctype="application/x-www-form-urlencoded" class="validation-forme validation-appdownload">
                                    
                                    <?
                                    $appdownload_ios = 0;
                                    $appdownload_android = 0;
                                    if ( $result_appdownload ) {
                                        $appdownload_ios = $result_appdownload[0]['appdownload_ios'];
                                        $appdownload_android = $result_appdownload[0]['appdownload_android'];
                                    };
                                    ?>                                            
                                    
                                    
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>총 다운로드 수</label>
                                            <input type="text" class="form-control" placeholder="<? echo $appdownload_ios+$appdownload_android; ?>" disabled> </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>iOS</label>
                                            <input type="number" class="form-control" name="appdownload_ios" placeholder="<? echo $appdownload_ios; ?>"> </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>Android</label>
                                            <input type="number" class="form-control" name="appdownload_android" placeholder="<? echo $appdownload_android; ?>"> </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>최근 업데이트</label>
                                            <?
                                            if ( $result_appdownload ) {
                                                ?>
                                                <input type="text" class="form-control" placeholder="<? echo $result_appdownload[0]['appdownload_register_date']; ?>" disabled>
                                        <?
                                            } else {
                                                ?>
                                                <input type="text" class="form-control" placeholder="최근 업데이트한 기록이 없습니다." disabled>                                      
                                                <?
                                            };
                                            ?>
                                        </div>    
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary" onclick="validationAppdownload(false,'confirm3')">저장</button>
                                    </div>
                                    <div class="modal fade" id="confirm3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-primary modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Confirm</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>저장하시겠습니까?</p>
                                                </div>
                                                <div class="modal-footer text-center">
                                                    <button type="submit" class="btn btn-primary">예</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">아니오</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </form>
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