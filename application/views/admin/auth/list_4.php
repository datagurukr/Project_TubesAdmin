<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">홈</a></li>
    <li class="breadcrumb-item"><a href="#">서비스운영</a></li>
    <li class="breadcrumb-item">기본정보</li>
</ol>
<div class="container-fluid">
    <h1 class="bd-title">관리자 정보 변경</h1>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
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
                                <label class="col-md-3 form-control-label" for="email-input">주소</label>
                                <div class="col-md-9"> 서울시 용산구 한강대로40길 39-9 b동b1 </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="password-input">사업자 번호</label>
                                <div class="col-md-9"> 000-00-00000 </div>
                            </div>
                        </div>
                        <form method="post" enctype="application/x-www-form-urlencoded">

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
                                            <button type="submit" class="btn btn-primary">저장</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">취소</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>                            
                            
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

                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label>관리자</label>
                                    <input type="text" class="form-control" name="user_licensee_charge_name" placeholder="길현배" value="<? echo $row['user_licensee_charge_name']; ?>"> </div>
                                <div class="form-group col-4">
                                    <label>Mobile</label>
                                    <input type="text" class="form-control" name="user_licensee_charge_mobile" value="<? echo $row['user_licensee_charge_mobile']; ?>"> </div>
                                <div class="form-group col-4">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="user_licensee_charge_email" value="<? echo $row['user_licensee_charge_email']; ?>"> </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label>부서</label>
                                    <input type="text" class="form-control" name="user_licensee_charge_group" value="<? echo $row['user_licensee_charge_group']; ?>"> </div>
                                <div class="form-group col-4">
                                    <label>직책</label>
                                    <input type="text" class="form-control" name="user_licensee_charge_status" value="<? echo $row['user_licensee_charge_status']; ?>"> </div>
                                <div class="form-group col-4">
                                    <label>tel</label>
                                    <input type="text" class="form-control" name="user_licensee_charge_tel" value="<? echo $row['user_licensee_charge_tel']; ?>"> </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>ID(Email)</label>
                                    <input type="text" class="form-control" placeholder="<? echo $row['user_email']; ?>" readonly> </div>
                                <div class="form-group col-6">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="user_password"> </div>
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#register">비밀번호 변경</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirm">저장</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.conainer-fluid -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" enctype="application/x-www-form-urlencoded" id="passwrodresetform">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">비밀번호 변경</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col">
                                <input type="password" class="form-control" name="user_password" placeholder="새 비밀번호">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <input type="password" class="form-control" name="user_re_password" placeholder="새 비밀번호 확인">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-center">
                    <button type="submit" class="btn btn-primary">예</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">아니오</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        
    </form>
</div>