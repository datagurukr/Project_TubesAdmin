<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">홈</a></li>
    <li class="breadcrumb-item"><a href="#">이벤트 관리</a></li>
    <li class="breadcrumb-item">공지</li>
</ol>
<div class="container-fluid">
    <h1 class="bd-title">불만사항</h1>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" enctype="application/x-www-form-urlencoded" class="validation-forme validation-post2">
                            
                            <?
                            $row = FALSE;
                            $post_id = 0;                            
                            if ( $response['status'] == 200 ) {
                                if ( 0 < $response['data']['count'] ) {
                                    $temp = ((($p * 2) * 10) - 20 ); 
                                    $num = $response['data']['out_cnt'] - $temp; 
                                    $row = $response['data']['out'][0];
                                };
                                $post_id = $row['post_id'];                                
                            };
                            ?>                            
                            <input type="hidden" class="form-control" name="post_id" value="<? echo $post_id; ?>">
                            <input type="hidden" class="form-control" name="post_status" value="2">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>작성자</label>
                                    <input type="text" class="form-control" placeholder="작성자" name="post_name" value="<? echo $row['post_name']; ?>"> </div>
                                <div class="form-group col-6">
                                    <label>조치여부</label>
                                    <select name="post_action" class="form-control">
                                        <option value="0" <? if ( $row['post_action'] == 0 ) { echo 'selected'; }; ?>>미조치</option>
                                        <option value="1" <? if ( $row['post_action'] == 1 ) { echo 'selected'; }; ?>>조치</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>제목</label>
                                    <input type="text" class="form-control" placeholder="제목" name="post_title" value="<? echo $row['post_title']; ?>"> </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>내용</label>
                                    <textarea class="form-control" id="editor1" name="post_article" placeholder="내용"><? echo $row['post_article']; ?></textarea>
                                    <script>
                                        CKEDITOR.replace( 'editor1', {
                                            filebrowserUploadUrl: '/api/upload/ckupload',
                                            mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML',
                                            height: 300
                                        } );

                                        if ( CKEDITOR.env.ie && CKEDITOR.env.version == 8 ) {
                                            document.getElementById( 'ie8-warning' ).className = 'tip alert';
                                        }
                                    </script>                                                                
                                </div>
                            </div>
                            <!--
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>첨부파일.1</label>
                                    <input type="file" class="form-control"> 
                                </div>
                                <div class="form-group col-12">
                                    <label>첨부파일.2</label>
                                    <input type="file" class="form-control"> 
                                </div>
                                <div class="form-group col-12">
                                    <label>첨부파일.3</label>
                                    <input type="file" class="form-control"> 
                                </div>                                
                            </div>
                            -->
                            <div class="text-right">
                                <button type="button" class="btn btn-primary" onclick="validationPost2(false,'confirm')">저장</button>
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