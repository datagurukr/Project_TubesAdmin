<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">홈</a></li>
    <li class="breadcrumb-item"><a href="#">회원관리</a></li>
    <li class="breadcrumb-item">광고주 관리</li>
</ol>
<div class="container-fluid">
    <h1 class="bd-title">광고주 등록</h1>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" enctype="application/x-www-form-urlencoded" class="validation-forme validation-aduser">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>광고주</label>
                                    <input type="text" class="form-control" placeholder="광고주" name="user_ad_name"> </div>
                                <div class="form-group col-6">
                                    <label>대표</label>
                                    <input type="text" class="form-control" placeholder="대표" name="user_name"> </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>주소</label>
                                    <input type="text" class="form-control" placeholder="주소" name="user_address"> </div>
                                <div class="form-group col-6">
                                    <label>사업자 번호</label>
                                    <input type="text" class="form-control" placeholder="000-00-00000" name="user_licensee_num"> </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label>담당자</label>
                                    <input type="text" class="form-control" placeholder="담당자" name="user_licensee_charge_name"> </div>
                                <div class="form-group col-4">
                                    <label>부서</label>
                                    <input type="text" class="form-control" placeholder="부서" name="user_licensee_charge_group"> </div>
                                <div class="form-group col-4">
                                    <label>직책</label>
                                    <input type="text" class="form-control" placeholder="직책" name="user_licensee_charge_status"> </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label>Mobile</label>
                                    <input type="text" class="form-control" placeholder="Mobile" name="user_licensee_charge_mobile"> </div>
                                <div class="form-group col-4">
                                    <label>Email</label>
                                    <input type="text" class="form-control" placeholder="Email" name="user_licensee_charge_email"> </div>
                                <div class="form-group col-4">
                                    <label>Tel</label>
                                    <input type="text" class="form-control" placeholder="Tel" name="user_licensee_charge_tel"> </div>
                            </div>
                            <div class="form-row">
                                <label class="col-12">서비스 기간</label>
                                <div class="form-group col" id="sandbox-container">
                                    <a href="#" style="display:  block;">
                                        <input type="text" class="form-control input-dp" readonly="" name="user_ad_open_date"> 
                                    </a>
                                </div>
                                <div class="form-group col" id="sandbox-container">
                                    <a href="#" style="display:  block;">
                                        <input type="text" class="form-control input-dp" readonly="" name="user_ad_close_date"> 
                                    </a>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary" onclick="validationServer(false,'confirm')">저장</button>
                                <!--<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#save-success">저장완료sample</button>-->
                            </div>
                            
                            <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<!-- /.conainer-fluid -->