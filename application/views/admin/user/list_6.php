<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">홈</a></li>
    <li class="breadcrumb-item"><a href="#">회원관리</a></li>
    <li class="breadcrumb-item">광고주 관리</li>
</ol>
<div class="container-fluid">
    <h1 class="bd-title">광고주 상세</h1>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link" href="/admin/user/list/5?user_id=<? echo $user_id; ?>">정보</a> </li>
                    <li class="nav-item"> <a class="nav-link active" href="/admin/user/list/6?user_id=<? echo $user_id; ?>">뱃지 이미지</a> </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="t2" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <?
                                    $row = FALSE;
                                    if ( $response['status'] == 200 ) {
                                        if ( 0 < $response['data']['count'] ) {
                                            $temp = ((($p * 2) * 10) - 20 ); 
                                            $num = $response['data']['out_cnt'] - $temp; 
                                            $row = $response['data']['out'][0];
                                        };
                                    };
                                    ?>                                    
                                    <input type="hidden" name="user_id" value="<? echo $row['user_id'];?>">
                                    <input type="hidden" name="campaign_id" value="<? echo $row['campaign_id'];?>">                                    
                                    
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>광고주</label>
                                            <input type="text" class="form-control" placeholder="<? echo $row['user_ad_name']; ?>" readonly> </div>
                                        <div class="form-group col-6">
                                            <label>시리얼 번호</label>
                                            <input type="text" class="form-control" placeholder="<? echo $row['user_id']; ?>" readonly> </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>대표자</label>
                                            <input type="text" class="form-control" placeholder="<? echo $row['user_name']; ?>" readonly> </div>
                                        <div class="form-group col-6">
                                            <label>사업자 번호</label>
                                            <input type="text" class="form-control" placeholder="<? echo $row['user_licensee_num']; ?>" readonly> </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>주소지</label>
                                            <input type="text" class="form-control" placeholder="<? echo $row['user_address']; ?>" readonly> </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>서비스 기간</label>
                                            <input type="text " class="form-control" placeholder="<? echo $row['user_ad_open_date']; ?> ~ <? echo $row['user_ad_close_date']; ?>" readonly> </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>뱃지 이미지 업로드</label>
                                            <input type="file" class="form-control" name="user_campaign_picture"> </div>
                                    </div>
                                    <div class=""> <a href="#!" class="btn btn-light" data-toggle="modal" data-target="#adver-img">미리보기</a> <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#confirm">저장</a></div>
                                    <div class="text-right">
                                        <a href="/admin/statistics/list/4?user_id=<? echo $row['user_id']; ?>" class="btn btn-link">뱃지광고 노출통계로 이동</a>
                                    </div>
                                    
                                    
                                    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-primary modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Confirm</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
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
<!-- /.conainer-fluid -->
<div class="modal fade" id="adver-img" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img class="img-thumbnail rounded" src="/upload/photo/<? echo $row['campaign_picture']; ?>">
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">확인</button>
            </div>
        </div>
    </div>
</div>
