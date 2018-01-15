<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">홈</a></li>
    <li class="breadcrumb-item"><a href="#">이벤트 관리</a></li>
    <li class="breadcrumb-item">알림</li>
</ol>
<div class="container-fluid">
    <h1 class="bd-title">알림</h1>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link" href="/admin/event/list/1">사용자 알림</a> </li>
                    <li class="nav-item"> <a class="nav-link active" href="/admin/event/list/2">광고주 알림</a> </li>
                </ul>
                <div class="tab-content">
                    <form class="tab-pane active" id="t1" role="tabpanel" enctype="application/x-www-form-urlencoded">
                        <div class="row">
                            <div class="col">
                                <table class="table table-sm table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>
                                                <select class="custom-select event-select" name="type">
                                                    <option value="">선택</option>                                                    
                                                    <option value="sms" <? if ( $type == 'sms' ) { echo 'selected'; }; ?>>SMS</option>
                                                    <option value="email" <? if ( $type == 'email' ) { echo 'selected'; }; ?>>Email</option>                                                    
                                                </select>
                                            </th>
                                            <th>
                                                <select class="custom-select event-select" name="premium">
                                                    <option value="">선택</option>                                                    
                                                    <option value="0" <? if ( $premium == 0 ) { echo 'selected'; }; ?>>전체</option>
                                                    <option value="1" <? if ( $premium == 1 ) { echo 'selected'; }; ?>>일반</option>
                                                    <option value="2" <? if ( $premium == 2 ) { echo 'selected'; }; ?>>프리미엄</option>
                                                </select>
                                            </th>
                                            <th>
                                                <select class="custom-select event-select" name="country">
                                                    <option value="">선택</option>
                                                    <option value="KR" <? if ( $country == 'KR' ) { echo 'selected'; }; ?>>대한민국</option>
                                                    <option value="US" <? if ( $country == 'US' ) { echo 'selected'; }; ?>>미국</option>
                                                    <option value="JP" <? if ( $country == 'JP' ) { echo 'selected'; }; ?>>일본</option>
                                                    <option value="VN" <? if ( $country == 'VN' ) { echo 'selected'; }; ?>>베트남</option>
                                                    <option value="GL" <? if ( $country == 'GL' ) { echo 'selected'; }; ?>>그린랜드</option>
                                                </select>
                                            </th>
                                            <th>
                                                <select class="custom-select event-select" name="os">
                                                    <option value="">선택</option>                                                    
                                                    <option value="android" <? if ( $os == 'android' ) { echo 'selected'; }; ?>>Android</option>
                                                    <option value="ios" <? if ( $os == 'ios' ) { echo 'selected'; }; ?>>IOS</option>
                                                </select>
                                            </th>
                                            <th>미리보기</th>
                                            <th>발송건수</th>
                                            <th>발송일자</th>
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
                                                <td><? if ( $row['notice_type'] ==  1 ) { echo 'Email'; } elseif ( $row['notice_type'] ==  2 ) { echo 'SMS'; }; ?></td>
                                                <td>
                                                    <? 
                                                    if ( $row['notice_premium'] ==  0 ) { 
                                                        echo '전체'; 
                                                    } elseif ( $row['notice_premium'] ==  1 ) { 
                                                        echo '일반'; 
                                                    } elseif ( $row['notice_premium'] ==  2 ) { 
                                                        echo '프리미엄'; 
                                                    }; 
                                                    ?>
                                                </td>
                                                <td><? if ( $row['notice_country'] == 'KR' ) { echo '대한민국'; } elseif ( $row['notice_country'] == 'JP' ) { echo '일본'; } elseif ( $row['notice_country'] == 'US' ) { echo '미국'; } elseif ( $row['notice_country'] ==  'ALL' ) { echo '전체'; }; ?></td>
                                                <td>
                                                    <? 
                                                    if ( $row['notice_os'] == 'ios' ) { 
                                                        echo 'IOS'; 
                                                    } elseif ( $row['notice_os'] == 'android' ) { 
                                                        echo 'Android'; 
                                                    } elseif ( $row['notice_os'] == 'all' ) { 
                                                        echo 'All'; 
                                                    }; 
                                                    ?>
                                                </td>
                                                <td><a href="#!" data-toggle="modal" data-target="#preview-noty"><i class="fa fa-search"></i></a></td>
                                                
                                                
                                                <div class="modal fade" id="preview-noty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><? if ( $row['notice_type'] ==  1 ) { echo 'Email'; } elseif ( $row['notice_type'] ==  2 ) { echo 'SMS'; }; ?></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-row">
                                                                    <div class="form-group col-4">
                                                                        <label>대상</label>
                                                                        <input type="text" class="form-control" placeholder="<? 
                                                    if ( $row['notice_premium'] ==  0 ) { 
                                                        echo '전체'; 
                                                    } elseif ( $row['notice_premium'] ==  1 ) { 
                                                        echo '일반'; 
                                                    } elseif ( $row['notice_premium'] ==  2 ) { 
                                                        echo '프리미엄'; 
                                                    }; 
                                                    ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group col-4">
                                                                        <label>국가</label>
                                                                        <input type="text" class="form-control" placeholder="<? if ( $row['notice_country'] == 'KR' ) { echo '대한민국'; } elseif ( $row['notice_country'] == 'JP' ) { echo '일본'; } elseif ( $row['notice_country'] == 'US' ) { echo '미국'; } elseif ( $row['notice_country'] ==  'ALL' ) { echo '전체'; }; ?>" readonly>
                                                                    </div>
                                                                    <div class="form-group col-4">
                                                                        <label>OS</label>
                                                                        <input type="text" class="form-control" placeholder="<? 
                                                    if ( $row['notice_os'] == 'ios' ) { 
                                                        echo 'IOS'; 
                                                    } elseif ( $row['notice_os'] == 'android' ) { 
                                                        echo 'Android'; 
                                                    } elseif ( $row['notice_os'] == 'all' ) { 
                                                        echo 'All'; 
                                                    }; 
                                                    ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <? echo $row['notice_content']; ?>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer text-center">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">확인</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>                                                
                                                
                                                
                                                <td><? echo $row['notice_count']; ?> 건</td>
                                                <td><? echo date("Y-m-d", strtotime($row['notice_register_date'])); ?></td>
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
                        <div class="text-right"> <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#noty-email">Email 발송</a> <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#noty-sms">SMS 발송</a> </div>
                        <nav>
                            <? echo $this->pagination->create_links(); ?>
                            <!--
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true">«</span> <span class="sr-only">Previous</span> </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true">»</span> <span class="sr-only">Next</span> </a>
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
<div class="modal fade" id="noty-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" enctype="application/x-www-form-urlencoded">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Email</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
                <input type="hidden" name="notice_status" value="2">            
                <input type="hidden" name="notice_type" value="1">                            
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>대상</label>
                            <select class="custom-select" name="notice_free">
                                <option value="2">프리미엄</option>
                                <option value="1">일반</option>
                                <option value="0">전체</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>국가</label>
                            <select class="custom-select" name="notice_country">
                                <option value="KR">대한민국</option>
                                <option value="JP">일본</option>
                                <option value="US">미국</option>
                                <option value="ALL">전체</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>OS</label>
                            <select class="custom-select" name="notice_os">
                                <option value="ios">iOS</option>
                                <option value="android">Android</option>
                                <option value="all">전체</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <textarea class="form-control" rows="3" name="notice_content" placeholder="내용을 입력해주세요."></textarea>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="submit" class="btn btn-primary">보내기</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->        
    </form>
</div>
<div class="modal fade" id="noty-sms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" enctype="application/x-www-form-urlencoded">    
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">SMS</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
                <input type="hidden" name="notice_status" value="2">
                <input type="hidden" name="notice_type" value="2">                
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>대상</label>
                            <select class="custom-select" name="notice_free">
                                <option value="2">프리미엄</option>
                                <option value="1">일반</option>
                                <option value="0">전체</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>국가</label>
                            <select class="custom-select" name="notice_country">
                                <option value="KR">대한민국</option>
                                <option value="JP">일본</option>
                                <option value="US">미국</option>
                                <option value="ALL">전체</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>OS</label>
                            <select class="custom-select" name="notice_os">
                                <option value="ios">iOS</option>
                                <option value="android">Android</option>
                                <option value="all">전체</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <textarea class="form-control" rows="3" name="notice_content" placeholder="내용을 입력해주세요."></textarea>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="submit" class="btn btn-primary">보내기</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>    
</div>