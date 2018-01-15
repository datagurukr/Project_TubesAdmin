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
                    <li class="nav-item"> <a class="nav-link" href="/admin/manager/list/5">스토리지 사용현황</a> </li>
                    <li class="nav-item"> <a class="nav-link active" href="/admin/manager/list/6">현황 정보관리</a> </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="statuses" role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#storage-info" role="tab" aria-controls="home">스토리지 사용 현황 정보관리</a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#server-info" role="tab" aria-controls="profile">서버 제공사 정보관리</a> </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="storage-info" role="tabpanel">
                                <div class="row">                                   
                                    <form class="col-6 validation-forme validation-traffic" method="post" enctype="application/x-www-form-urlencoded">
                                        <?
                                        $traffic_space = 0;
                                        $traffic_space_use = 0;
                                        $traffic_register_date = '0000-00-00 00:00:00';
                                        $traffic_space_percent = 0;
                                        if ( $result_traffic ) {
                                            $traffic_space = $result_traffic[0]['traffic_space'];
                                            $traffic_space_use = $result_traffic[0]['traffic_space_use'];
                                            $traffic_register_date = $result_traffic[0]['traffic_register_date'];
                                            $traffic_space_percent = round(100 * ($traffic_space_use/$traffic_space));
                                        };
                                        ?>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header <? if ( 90 <= $traffic_space_percent ) { echo 'alert-danger'; }; ?>"> 서버 트래픽 정보(<? echo $traffic_space_percent; ?>%) </div>
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label>총량</label>
                                                            <input type="text" class="form-control" placeholder="<? echo $traffic_space; ?>" name="traffic_space"> </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label>사용량</label>
                                                            <input type="text" class="form-control" placeholder="<? echo $traffic_space_use; ?>" name="traffic_space_use"> </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label>최근 업데이트</label>
                                                            
                                                            <?
                                                            if ( $result_traffic ) {
                                                                ?>
                                                                <input type="text" class="form-control" placeholder="<? echo $result_traffic[0]['traffic_register_date']; ?>" disabled>
                                                        <?
                                                            } else {
                                                                ?>
                                                                <input type="text" class="form-control" placeholder="최근 업데이트한 기록이 없습니다." disabled>                                      
                                                                <?
                                                            };
                                                            ?>                                                            

                                                        </div>
                                                    </div>
                                                    <div class="text-right"> <a href="#!" class="btn btn-primary" onclick="validationTraffic(false,'confirm2')">저장</a> </div>
                                                </div>
                                            </div>
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
                                    <form class="col-6 validation-forme validation-storage" method="post" enctype="application/x-www-form-urlencoded">
                                        <?
                                        $storage_space = 0;
                                        $storage_space_use = 0;
                                        $storage_register_date = '0000-00-00 00:00:00';
                                        $storage_space_percent = 0;
                                        if ( $result_storage ) {
                                            $storage_space = $result_storage[0]['storage_space'];
                                            $storage_space_use = $result_storage[0]['storage_space_use'];
                                            $storage_register_date = $result_storage[0]['storage_register_date'];
                                            $storage_space_percent = round(100 * ($storage_space_use/$storage_space));
                                        };
                                        

                                        
                                        ?>
                                        <div class="col-12">
                                            <div class="card">
                                                <!--														90%가 넘어가면 .alert-danger 추가-->
                                                <div class="card-header <? if ( 90 <= $storage_space_percent ) { echo 'alert-danger'; }; ?>"> 서버 스토리지 정보(<? echo $storage_space_percent; ?>%) </div>
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label>총량</label>
                                                            <input type="text" class="form-control" placeholder="<? echo $storage_space; ?>" name="storage_space"> </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label>사용량</label>
                                                            <input type="text" class="form-control" placeholder="<? echo $storage_space_use; ?>" name="storage_space_use"> </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label>최근 업데이트</label>
                                                            <?
                                                            if ( $result_storage ) {
                                                                ?>
                                                                <input type="text" class="form-control" placeholder="<? echo $result_storage[0]['storage_register_date']; ?>" disabled>
                                                        <?
                                                            } else {
                                                                ?>
                                                                <input type="text" class="form-control" placeholder="최근 업데이트한 기록이 없습니다." disabled>                                      
                                                                <?
                                                            };
                                                            ?>                                                            
                                                        </div>
                                                    </div>
                                                    <div class="text-right"> <a href="#!" class="btn btn-primary" onclick="validationStorage(false,'confirm1')">저장</a> </div>
                                                </div>
                                            </div>
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
                            </div>
                            <div class="tab-pane" id="server-info" role="tabpanel">
                                <form method="post" enctype="application/x-www-form-urlencoded" class="validation-forme validation-server">
                                    
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
                                            <input type="text" class="form-control" placeholder="<? echo $server_name; ?>" name="server_name"> </div>
                                        <div class="form-group col-6">
                                            <label>서비스 명</label>
                                            <input type="text" class="form-control" placeholder="<? echo $server_service_name; ?>" name="server_service_name"> </div>
                                    </div>
                                    <div class="form-row">
                                        <label class="col-12">서비스 기간</label>
                                        <div class="form-group col">
                                            <input type="date" class="form-control" value="<? echo $server_open; ?>" name="server_open"> </div>
                                        <div class="form-group col">
                                            <input type="date" class="form-control" value="<? echo $server_close; ?>" name="server_close"> </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>서버 관리자 연락처</label>
                                            <input type="tel" class="form-control" placeholder="<? echo $server_tel; ?>" name="server_tel"> </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>최근 업데이트</label>
                                            
                                            <?
                                            if ( $result_server ) {
                                                ?>
                                                <input type="text" class="form-control" placeholder="<? echo $result_server[0]['server_register_date']; ?>" disabled>
                                        <?
                                            } else {
                                                ?>
                                                <input type="text" class="form-control" placeholder="최근 업데이트한 기록이 없습니다." disabled>                                      
                                                <?
                                            };
                                            ?>                                            

                                        </div>
                                    </div>
                                    <div class="text-right"> <a href="#!" class="btn btn-primary" onclick="validationServer(false,'confirm3')">저장</a> </div>
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
