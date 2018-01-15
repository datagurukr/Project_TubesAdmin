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
                    <li class="nav-item"> <a class="nav-link" href="/admin/event/list/3">광고 설정</a> </li>
                    <li class="nav-item"> <a class="nav-link active" href="/admin/event/list/4">이벤트성 광고 설정</a> </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="t1" role="tabpanel" style="display:none">
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
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>제네시스</td>
                                            <th>
                                                <select class="custom-select">
                                                    <option selected>등급</option>
                                                    <option value="1">Email</option>
                                                </select>
                                            </th>
                                            <td>
                                                <a href="#!" class="fa fa-photo fa-lg" data-toggle="modal" data-target="#adver-img"></a>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td> <a href="#!" class="btn">수정</a> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-right"> <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#noty-email">Email 발송</a> <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#noty-sms">SMS 발송</a> </div>
                        <nav>
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
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
</div>
<!-- /.conainer-fluid -->