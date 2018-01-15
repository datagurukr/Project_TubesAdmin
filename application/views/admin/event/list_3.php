<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">홈</a></li>
    <li class="breadcrumb-item"><a href="#">이벤트 관리</a></li>
    <li class="breadcrumb-item">로딩 광고 관리</li>
</ol>
<div class="container-fluid">
    <h1 class="bd-title">로딩 광고 관리</h1>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" href="/admin/event/list/3">광고 설정</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="/admin/event/list/4">이벤트성 광고 설정</a> </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="t1" role="tabpanel" enctype="application/x-www-form-urlencoded">
                        <div class="row">
                            <div class="col">
                                <table class="table table-sm table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>광고주</th>
                                            <th> 등급 </th>
                                            <th> 광고 이미지 </th>
                                            <th> 설정된 카테고리 </th>
                                            <th> 설정된 시간대 </th>
                                            <th> 수정 </th>
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
                                            <form>
                                            <input type="hidden" class="form-control" placeholder="광고주" name="ad_name" value="<? echo $ad_name; ?>">
                                            <input type="hidden" class="form-control" placeholder="광고주" name="user_id" value="<? echo $row['user_id']; ?>">                                                
                                            <th scope="row"><? echo $num; ?></th>
                                            <td>
                                                <? 
                                                // mb_substr("안녕하세요.", 0, 2)
                                                
                                                if ( 6 < mb_strlen($row['user_ad_name']) ) {
                                                    echo mb_substr($row['user_ad_name'], 0, 6).'..';
                                                } else {
                                                    echo $row['user_ad_name'];                                                     
                                                };
                                                ?>                                                
                                            </td>
                                            <th>
                                                <select class="custom-select" name="user_ad_premium">
                                                    <option value="">등급</option>
                                                    <option value="1" <? if ( $row['user_ad_premium'] == 1 ) { echo 'selected'; }; ?>>일반</option>
                                                    <option value="2" <? if ( $row['user_ad_premium'] == 2 ) { echo 'selected'; }; ?>>프리미엄</option>
                                                </select>
                                            </th>
                                            <td>
                                                <a href="<? echo $row['campaign_picture']; ?>" target="_blank" class="fa fa-photo fa-lg" data-toggle="modal" data-target="#adver-img-<? echo $num; ?>"></a>
                                            </td>
                                            <td><a href="#!" target="_blank" class="btn" data-toggle="modal" data-target="#category-set-<? echo $num; ?>">카테고리</a></td>
                                            <td><a href="#!" target="_blank" class="btn" data-toggle="modal" data-target="#time-set-<? echo $num; ?>">시간</a></td>
                                            <td> <button type="submit" class="btn">수정</button> </td>
                                            </form>    
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
                        <!--
                        <div class="text-right"> <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#noty-email">Email 발송</a> <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#noty-sms">SMS 발송</a> </div>
                        -->
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
                        <form class="form-row">
                            <div class="col-3">
                                <input type="text" class="form-control" placeholder="광고주" name="ad_name" value="<? echo $ad_name; ?>"> </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary">검색</button>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
</div>
<!-- /.conainer-fluid -->
<?

$category = array(
    array('category_id' => 1,'category_name' => '영화/애니메이션'),
    array('category_id' => 2,'category_name' => '자동차'),
    array('category_id' => 3,'category_name' => '음악'),
    array('category_id' => 4,'category_name' => '동물'),
    array('category_id' => 5,'category_name' => '스포츠'),
    array('category_id' => 6,'category_name' => '여행/이벤트'),
    array('category_id' => 7,'category_name' => '게임'),
    array('category_id' => 8,'category_name' => '코미디'),
    array('category_id' => 9,'category_name' => '엔터테인먼트'),
    array('category_id' => 10,'category_name' => '노하우/스타일'),    
    array('category_id' => 11,'category_name' => '과학기술')    
);

if ( $response['status'] == 200 ) {
    if ( 0 < $response['data']['count'] ) {
        $temp = ((($p * 2) * 10) - 20 ); 
        $num = $response['data']['out_cnt'] - $temp; 
        foreach ( $response['data']['out'] as $row ) {
            ?>
    <div class="modal fade" id="adver-img-<? echo $num; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img class="img-thumbnail rounded" src="/upload/photo/<? echo $row['user_ad_picture']; ?>">
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">확인</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">아니오</button>
                </div>
            </div>
        </div>
    </div>  
    <form class="modal fade" id="category-set-<? echo $num; ?>" tabindex="-1" method="post" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" enctype="application/x-www-form-urlencoded">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="<? echo $row['user_id'];?>">
                    <?
                    $user_ad_category = @unserialize($row['user_ad_category']);
                    foreach ( $category as $category_row ) {
                        $selected = FALSE;
                        if ( $user_ad_category ) {
                            foreach ( $user_ad_category as $user_ad_category_row ) {
                                if ( $user_ad_category_row == $category_row['category_id'] ) {
                                    $selected = TRUE;
                                    break;
                                }
                            }
                        }
                        
                        ?>
                    <div>
                        <input type="checkbox" <? if ( $selected ) { echo 'checked'; }; ?> name="category_id[]" value="<? echo $category_row['category_id']; ?>">
                        <? echo $category_row['category_name']; ?>
                    </div>
                        <?
                    }
                    ?>
                </div>
                <div class="modal-footer text-center">
                    <button type="submit" class="btn btn-primary">확인</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">아니오</button>                    
                </div>
            </div>
        </div>
    </form> 

    <form class="modal fade" id="time-set-<? echo $num; ?>" tabindex="-1" method="post" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" enctype="application/x-www-form-urlencoded">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <input type="hidden" name="campaign_id" value="<? echo $row['campaign_id'];?>">
                    시작시간 : <input type="time" name="campaign_open_tiem" value="<? echo $row['campaign_open_tiem'];?>">
                    ~
                    종료시간 : <input type="time" name="campaign_close_time" value="<? echo $row['campaign_close_time'];?>">                    
                </div>
                <div class="modal-footer text-center">
                    <button type="submit" class="btn btn-primary">확인</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">아니오</button>
                </div>
            </div>
        </div>
    </form> 
            <?
            $num--;
        };
    };
};
?> 
