<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">홈</a></li>
    <li class="breadcrumb-item"><a href="#">서비스운영</a></li>
    <li class="breadcrumb-item">이벤트 관리</li>
</ol>
<div class="container-fluid">
    <h1 class="bd-title">공지</h1>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link" href="/admin/event/list/6">공지사항</a> </li>
                    <li class="nav-item"> <a class="nav-link active" href="/admin/event/list/7">불만사항</a> </li>
                </ul>
                <div class="tab-content">
                    <form class="tab-pane active" id="t1" role="tabpanel">
                        <div class="row">
                            <div class="col">
                                <table class="table table-sm table-bordered text-center user-2">
                                    <thead>
                                        <tr>
                                            <th class="ck">
                                                <input id="all-checked" type="checkbox" value=""> </th>
                                            <th>#</th>
                                            <th>제목</th>
                                            <th>작성자</th>
                                            <th>작성일</th>
                                            <th>조치여부</th>
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
                                                <td><input class="all-checked" type="checkbox" name="post_del_id[]" value="<? echo $row['post_id'];?>"></td>
                                                <td scope="row"><? echo $num; ?></td>
                                                <td>
                                                    <a href="/admin/event/list/9?post_id=<? echo $row['post_id']; ?>">
                                                        <? echo $row['post_title']; ?>
                                                    </a>                                                        
                                                </td>
                                                <td><? echo $row['post_name']; ?></td>
                                                <td><? echo date("Y-m-d", strtotime($row['post_register_date'])); ?></td>
                                                <td>
                                                    <input type="hidden" name="post_id" value="<? echo $row['post_id']; ?>">
                                                    <select name="post_action" class="form-control event-select custom-get">
                                                        <option value="0" <? if ( $row['post_action'] == 0 ) { echo 'selected'; }; ?>>미조치</option>
                                                        <option value="1" <? if ( $row['post_action'] == 1 ) { echo 'selected'; }; ?>>조치</option>
                                                    </select>                                                    
                                                </td>
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
                        <div class="text-right"> <a href="#!" class="btn btn-danger" data-toggle="modal" data-target="#confirm-del">선택삭제</a> <a href="/admin/event/list/9" class="btn btn-primary">등록</a> </div>
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
                    <div class="tab-pane" id="t2" role="tabpanel"> </div>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
</div>
<form id="out-form" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="post_id" value="">
    <input type="hidden" name="post_action" value="">    
</form>