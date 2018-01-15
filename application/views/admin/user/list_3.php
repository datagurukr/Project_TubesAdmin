<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">홈</a></li>
    <li class="breadcrumb-item"><a href="#">회원관리</a></li>
    <li class="breadcrumb-item">광고주 관리</li>
</ol>
<div class="container-fluid">
    <h1 class="bd-title">광고주 관리</h1>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
                <div class="tab-content">
                    <form class="tab-pane active" id="profile" role="tabpanel" enctype="application/x-www-form-urlencoded">
                        <div class="row">
                            <div class="col">
                                <table class="table table-sm table-bordered text-center user-2">
                                    <thead>
                                        <tr>
                                            <th class="ck">
                                                <input id="all-checked" type="checkbox" value=""> </th>
                                            <th>#</th>
                                            <th>뱃지 이미지</th>
                                            <th>광고주</th>
                                            <th>담당자</th>
                                            <th>서비스 기간</th>
                                            <th>시리얼 번호</th>
                                            <th>연장여부</th>
                                            <th>가입일</th>
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
                                            <th><input class="all-checked" type="checkbox" name="user_del_id[]" value="<? echo $row['user_id'];?>"></th>
                                            <td scope="row"><? echo $num; ?></td>                                            
                                            <td>
                                                <a href="#!" data-toggle="modal" data-target="#adver-img-<? echo $num; ?>"><i class="font-5xl icon-picture"></i></a>
                                            </td>
                                            
                                            <div class="modal fade" id="adver-img-<? echo $num; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center">
                                                            <img class="img-thumbnail rounded" src="/upload/photo/<? echo $row['user_ad_picture']; ?>">
                                                        </div>
                                                        <div class="modal-footer text-center">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">확인</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                            
                                            <td>
                                                <a href="/admin/user/list/5?user_id=<? echo $row['user_id'];?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<? echo $row['user_ad_name']; ?>">
                                                <? 
                                                // mb_substr("안녕하세요.", 0, 2)
                                                
                                                if ( 6 < mb_strlen($row['user_ad_name']) ) {
                                                    echo mb_substr($row['user_ad_name'], 0, 6).'..';
                                                } else {
                                                    echo $row['user_ad_name'];                                                     
                                                };
                                                ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#!" data-toggle="modal" data-target="#charge-info-<? echo $num; ?>">
                                                    <? echo $row['user_licensee_charge_name']; ?>
                                                </a>
                                            </td>   
                                            
                                            
                                            <div class="modal fade" id="charge-info-<? echo $num; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <b>회사 : </b>
                                                            <? echo $row['user_ad_name']; ?>
                                                            <br>
                                                            <b>이름 : </b>
                                                            <? echo $row['user_licensee_charge_name']; ?>
                                                            <br>
                                                            <b>연락처(Mobile) : </b>
                                                            <? echo $row['user_licensee_charge_mobile']; ?>
                                                            <br>
                                                            <b>연락처(Tel) : </b>
                                                            <? echo $row['user_licensee_charge_tel']; ?>
                                                            <br>                                                            
                                                            <b>서비스 기간 : </b>
                                                            <? echo $row['user_ad_open_date']; ?>~<? echo $row['user_ad_close_date']; ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">확인</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                            
                                            
                                            
                                            <td><? echo $row['user_ad_open_date']; ?>~<? echo $row['user_ad_close_date']; ?></td>    
                                            <td><? echo $row['user_id']; ?></td>    
                                            <td><? if ( $row['user_ad_renewal'] == 2 ) { echo 'Y'; } else { echo 'N'; }; ?></td>    
                                            <td><? echo date("Y.m.d", strtotime($row['user_register_date'])); ?></td>
                                        </tr>                                        
                                                <?
                                                $num--;
                                            };
                                        };
                                    };
                                    ?>
                                        <!--
                                        <tr>
                                            <td>
                                                <input class="" type="checkbox" value=""> </td>
                                            <th scope="row">1</th>
                                            <td>
                                                <a href="#!" class="fa fa-photo fa-lg" data-toggle="modal" data-target="#adver-img"></a>
                                            </td>
                                            <td> <a href="/admin/user/list/5">제네시스</a> </td>
                                            <td><a href="#!" data-toggle="modal" data-target="#info-charger">김철수</a></td>
                                            <td>2017-01-01 ~ 2018-01-01</td>
                                            <td>2017100100001</td>
                                            <td>Y</td>
                                            <td>2017-10-01</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="" type="checkbox" value=""> </td>
                                            <th scope="row">1</th>
                                            <td>
                                                <a href="#!" class="fa fa-photo fa-lg"></a>
                                            </td>
                                            <td> <a href="#!">제네시스</a> </td>
                                            <td><a href="#!" data-toggle="modal" data-target="#review-detail">김철수</a></td>
                                            <td>2017-01-01 ~ 2018-01-01</td>
                                            <td>2017100100001</td>
                                            <td>Y</td>
                                            <td>2017-10-01</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="" type="checkbox" value=""> </td>
                                            <th scope="row">1</th>
                                            <td>
                                                <a href="#!" class="fa fa-photo fa-lg"></a>
                                            </td>
                                            <td> <a href="#!">제네시스</a> </td>
                                            <td><a href="#!" data-toggle="modal" data-target="#review-detail">김철수</a></td>
                                            <td>2017-01-01 ~ 2018-01-01</td>
                                            <td>2017100100001</td>
                                            <td>Y</td>
                                            <td>2017-10-01</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input class="" type="checkbox" value=""> </td>
                                            <th scope="row">1</th>
                                            <td>
                                                <a href="#!" class="fa fa-photo fa-lg"></a>
                                            </td>
                                            <td> <a href="#!">제네시스</a> </td>
                                            <td><a href="#!" data-toggle="modal" data-target="#review-detail">김철수</a></td>
                                            <td>2017-01-01 ~ 2018-01-01</td>
                                            <td>2017100100001</td>
                                            <td>Y</td>
                                            <td>2017-10-01</td>
                                        </tr>
                                        -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-right"> <a href="/admin/user/list/4" class="btn btn-primary">등록</a> <a href="#!" class="btn btn-danger" data-toggle="modal" data-target="#confirm-del">삭제</a> </div>
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
                        <div class="form-row">
                            <div class="col-2 offset-3">
                                <select class="custom-select form-control" name="renewal">
                                    <option selected value="">연장여부</option>
                                    <option value="2" <? if ( $renewal == 2 ) { echo 'selected'; }; ?>>Y</option>
                                    <option value="1" <? if ( $renewal == 1 ) { echo 'selected'; }; ?>>N</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" placeholder="검색어" name="ad_name" value="<? echo $ad_name; ?>"> </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary">검색</button>
                            </div>
                        </div>
                        <div class="modal fade" id="confirm-del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-danger modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Confirm</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                    </div>
                                    <div class="modal-body">
                                        <p> 정말 삭제하시겠습니까?
                                            <br> (다시 복구할 수 없습니다.) </p>
                                    </div>
                                    <div class="modal-footer text-center">
                                        <button type="submit" class="btn btn-danger">예</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">아니오</button>
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