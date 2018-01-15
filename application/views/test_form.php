<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h2 {
        color: #444;
        background-color: transparent;
        font-size: 19px;
        font-weight: bold;
        margin: 0 0 7px 0;
        padding: 0px;
	}        
        
	h3 {
        color: #444;
        background-color: transparent;
        font-size: 16px;
        font-weight: bold;
        margin: 0 0 7px 0;
        padding: 0px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
        
    form .optional {
        background-color: #eee;
        padding: 10px;
        margin-bottom: 10px;
    }
        
    form .optional h5 {
        color: #444;
        background-color: transparent;
        font-size: 13px;
        font-weight: bold;
        margin: 0 0 7px 0;
        padding: 0px;
    }
        
    form label { 
        display: block;
        font-size: 12px;
        margin-bottom: 5px;
    }
        
    form label:last-child {
        margin-bottom: 0px;
    }   
        
    .section {
        border-bottom: solid 1px #ccc;
        padding: 10px 0px 10px 0px;
        margin: 0px 0px 10px 50px;
    }    
        
    .article .section {

    }
        
	</style>
</head>
<body>
    <div class="article">
        <h2>1.인증</h2>
        <div class="section">
            <h3>1_1.로그인</h3>
            <form method="post" action="/api/auth/login" enctype="application/x-www-form-urlencoded">
                <label>
                    구글 아이디(user_google_id)
                    <input type="text" name="user_google_id" placeholder="user_google_id">
                </label>
                <div class="optional">
                    <h5>Optional</h5>
                    <label>
                        회원이름(user_name)
                        <input type="text" name="user_name" placeholder="user_name">
                    </label>            
                    <label>
                        회원사진(user_picture)
                        <input type="text" name="user_picture" placeholder="user_picture">
                    </label>                        
                    <label>
                        국가코드(user_country)
                        <input type="text" name="user_country" placeholder="user_country">
                    </label>
                    <label>
                        소프트웨어 버전 코드(user_app_version_code)
                        <input type="text" name="user_app_version_code" placeholder="user_app_version_code">
                    </label>            
                    <label>
                        소프트웨어 버전 이름(user_app_version_name)
                        <input type="text" name="user_app_version_name" placeholder="user_app_version_name">
                    </label>
                    <label>
                        단말기 OS(user_device_os)
                        <input type="text" name="user_device_os" placeholder="user_device_os">
                    </label>            
                    <label>
                        단말기 이름(user_device_name)
                        <input type="text" name="user_device_name" placeholder="user_device_name">
                    </label>            
                    <label>
                        단말기 버전(user_device_version)
                        <input type="text" name="user_device_version" placeholder="user_device_version">
                    </label>                        
                    <label>
                        Google GCM(user_gcm_id)
                        <input type="text" name="user_gcm_id" placeholder="user_gcm_id">
                    </label>
                    <label>
                        Apple APNS(user_apns_id)
                        <input type="text" name="user_apns_id" placeholder="user_apns_id">
                    </label>
                </div>
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>    
        <div class="section">
            <h3>1_2.디바이스 인증</h3>
            <form method="post" action="/api/auth/device" enctype="application/x-www-form-urlencoded">
                <label>
                    소프트웨어 버전 코드 (user_app_version_code)
                    <input type="text" name="user_app_version_code" placeholder="user_app_version_code">
                </label>
                <label>
                    디바이스 아이디 (user_app_device_id)
                    <input type="text" name="user_app_device_id" placeholder="user_app_device_id">
                </label>                
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>            
        
    </div>
    <div class="article">
        <h2>2.회원</h2>    
        <div class="section">
            <h3>2_1.회원 조회_식별자</h3>
            <form method="get" action="/api/user/out/id" enctype="application/x-www-form-urlencoded">
                <label>
                    회원 식별자(user_id)
                    <input type="text" name="user_id" placeholder="user_id">
                </label>
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>    
    
        <div class="section">
            <h3>2_2.회원 조회_전체</h3>
            <form method="get" action="/api/user/out/all" enctype="application/x-www-form-urlencoded">
                <div class="optional">
                    <h5>Optional</h5>
                    <label>
                        페이지(p)
                        <input type="text" name="p" placeholder="p">
                    </label>                                            
                    <label>
                        순서(order)
                        <select name="order">
                            <option value="desc">desc</option>
                            <option value="asc">asc</option>                        
                        </select>
                    </label>                            
                    <label>
                        개수(limit)
                        <input type="text" name="limit" placeholder="limit">
                    </label>                                            
                </div>    
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div> 
        
        <div class="section">
            <h3>2_3.회원정보 수정</h3>
            <form method="post" action="/api/user/update" enctype="application/x-www-form-urlencoded">
                <label>
                    회원 식별자(user_id)
                    <input type="text" name="user_id" placeholder="user_id">
                </label>
                <div class="optional">
                    <h5>Optional</h5>
                    <label>
                        회원상태(user_state)
                        <select name="user_state">
                            <option value="0">탈퇴</option>
                            <option value="1">회원</option>
                        </select>
                    </label>
                    <label>
                        회원이름(user_name)
                        <input type="text" name="user_name" placeholder="user_name">
                    </label>            
                    <label>
                        회원사진(user_picture)
                        <input type="text" name="user_picture" placeholder="user_picture">
                    </label>                        
                    <label>
                        국가코드(user_country)
                        <input type="text" name="user_country" placeholder="user_country">
                    </label>                    
                </div>    
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>    
    </div>    
    <div class="article">
        <h2>3.광고</h2>    
        <div class="section">
            <h3>3_1.광고 등록</h3>
            <form method="post" action="/api/campaign/create" enctype="application/x-www-form-urlencoded">
                <label>
                    광고 이름(campaign_name)
                    <input type="text" name="campaign_name" placeholder="campaign_name">
                </label>
                <div class="optional">
                    <h5>Optional</h5>            
                    <label>
                        광고 카테고리(category_id)
                        <input type="text" name="category_id" placeholder="category_id">
                    </label>
                    <label>
                        광고 설명(campaign_description)
                        <input type="text" name="campaign_description" placeholder="campaign_description">
                    </label>                        
                    <label>
                        광고 이미지(campaign_picture)
                        <input type="text" name="campaign_picture" placeholder="campaign_picture">
                    </label>                                    
                    <label>
                        광고 링크(campaign_link)
                        <input type="text" name="campaign_link" placeholder="campaign_link">
                    </label>                                                

                    <label>
                        광고 노출 시간(campaign_show_second)
                        <input type="text" name="campaign_show_second" placeholder="campaign_show_second">
                    </label>                        

                    <label>
                        광고 시작 날짜(campaign_start_date)
                        <input type="text" name="campaign_start_date" placeholder="campaign_start_date">
                    </label>            

                    <label>
                        광고 종료 날짜(campaign_stop_date)
                        <input type="text" name="campaign_stop_date" placeholder="campaign_stop_date">
                    </label>                        
                </div>
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>        

        <div class="section">
            <h3>3_2.광고 수정</h3>
            <form method="post" action="/api/campaign/update" enctype="application/x-www-form-urlencoded">
                <label>
                    광고 식별자(campaign_id)
                    <input type="text" name="campaign_id" placeholder="campaign_id">
                </label>            
                <div class="optional">
                    <h5>Optional</h5>            
                    <label>
                        광고 상태(campaign_state)
                        <select name="campaign_state">
                            <option value="0">삭제</option>
                            <option value="1">정상</option>
                            <option value="2">중지</option>                            
                        </select>
                    </label>                    
                    <label>
                        광고 이름(campaign_name)
                        <input type="text" name="campaign_name" placeholder="campaign_name">
                    </label>                
                    <label>
                        광고 카테고리(category_id)
                        <input type="text" name="category_id" placeholder="category_id">
                    </label>
                    <label>
                        광고 설명(campaign_description)
                        <input type="text" name="campaign_description" placeholder="campaign_description">
                    </label>                        
                    <label>
                        광고 이미지(campaign_picture)
                        <input type="text" name="campaign_picture" placeholder="campaign_picture">
                    </label>                                    
                    <label>
                        광고 링크(campaign_link)
                        <input type="text" name="campaign_link" placeholder="campaign_link">
                    </label>                                                

                    <label>
                        광고 노출 시간(campaign_show_second)
                        <input type="text" name="campaign_show_second" placeholder="campaign_show_second">
                    </label>                        

                    <label>
                        광고 시작 기간(campaign_start_date)
                        <input type="text" name="campaign_start_date" placeholder="campaign_start_date">
                    </label>            

                    <label>
                        광고 종료 기간(campaign_stop_date)
                        <input type="text" name="campaign_stop_date" placeholder="campaign_stop_date">
                    </label>                        
                </div>
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>      

        <div class="section">
            <h3>3_3.광고 조회_식별자</h3>
            <form method="get" action="/api/campaign/out/id" enctype="application/x-www-form-urlencoded">
                <label>
                    광고 식별자(campaign_id)
                    <input type="text" name="campaign_id" placeholder="campaign_id">
                </label>            
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>     

        <div class="section">
            <h3>3_4.광고 조회_전체</h3>
            <form method="get" action="/api/campaign/out/all" enctype="application/x-www-form-urlencoded">
                <div class="optional">
                    <h5>Optional</h5>
                    <label>
                        페이지(p)
                        <input type="text" name="p" placeholder="p">
                    </label>                                            
                    <label>
                        순서(order)
                        <select name="order">
                            <option value="desc">desc</option>
                            <option value="asc">asc</option>                        
                        </select>
                    </label>                            
                    <label>
                        개수(limit)
                        <input type="text" name="limit" placeholder="limit">
                    </label>                                            
                </div>    
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>   

        <div class="section">
            <h3>3_5.광고 조회_카테고리</h3>
            <form method="get" action="/api/campaign/out/category" enctype="application/x-www-form-urlencoded">
                <label>
                    카테고리 식별자(category_id)
                    <input type="text" name="category_id" placeholder="category_id">
                </label>                        
                <div class="optional">
                    <h5>Optional</h5>
                    <label>
                        페이지(p)
                        <input type="text" name="p" placeholder="p">
                    </label>                                            
                    <label>
                        순서(order)
                        <select name="order">
                            <option value="desc">desc</option>
                            <option value="asc">asc</option>                        
                        </select>
                    </label>                            
                    <label>
                        개수(limit)
                        <input type="text" name="limit" placeholder="limit">
                    </label>                                            
                </div>    
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>  
        
    </div>    

    <div class="article">
        <h2>4.카테고리</h2>    
        <div class="section">
            <h3>4_1.카테고리 등록</h3>
            <form method="post" action="/api/category/create" enctype="application/x-www-form-urlencoded">
                <label>
                    카테고리 이름(category_name)
                    <input type="text" name="category_name" placeholder="category_name">
                </label>
                <div class="optional">
                    <h5>Optional</h5>            
                    <label>
                        회원 식별자(user_id)
                        <input type="text" name="user_id" placeholder="user_id">
                    </label>
                    <label>
                        카테고리 설명(category_description)
                        <input type="text" name="campaign_description" placeholder="category_description">
                    </label>                        
                    <label>
                        카테고리 이미지(category_picture)
                        <input type="text" name="campaign_picture" placeholder="category_picture">
                    </label>
                </div>
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>        

        <div class="section">
            <h3>4_2.카테고리 수정</h3>
            <form method="post" action="/api/category/update" enctype="application/x-www-form-urlencoded">
                <label>
                    카테고리 식별자(category_id)
                    <input type="text" name="category_id" placeholder="category_id">
                </label>            
                <div class="optional">
                    <h5>Optional</h5>            
                    <label>
                        카테고리 상태(category_state)
                        <select name="category_state">
                            <option value="0">삭제</option>
                            <option value="1">활성화</option>
                        </select>
                    </label>                                        
                    <label>
                        카테고리 이름(category_name)
                        <input type="text" name="category_name" placeholder="category_name">
                    </label>
                    <label>
                        카테고리 설명(category_description)
                        <input type="text" name="campaign_description" placeholder="category_description">
                    </label>                        
                    <label>
                        카테고리 이미지(category_picture)
                        <input type="text" name="campaign_picture" placeholder="category_picture">
                    </label>
                </div>
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>      

        <div class="section">
            <h3>4_3.카테고리 조회_식별자</h3>
            <form method="get" action="/api/category/out/id" enctype="application/x-www-form-urlencoded">
                <label>
                    카테고리 식별자(category_id)
                    <input type="text" name="category_id" placeholder="category_id">
                </label>            
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>     

        <div class="section">
            <h3>4_4.카테고리 조회_전체</h3>
            <form method="get" action="/api/category/out/all" enctype="application/x-www-form-urlencoded">
                <div class="optional">
                    <h5>Optional</h5>
                    <label>
                        페이지(p)
                        <input type="text" name="p" placeholder="p">
                    </label>                                            
                    <label>
                        순서(order)
                        <select name="order">
                            <option value="desc">desc</option>
                            <option value="asc">asc</option>                        
                        </select>
                    </label>                            
                    <label>
                        개수(limit)
                        <input type="text" name="limit" placeholder="limit">
                    </label>                                            
                </div>    
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>   

        <div class="section">
            <h3>4_5.카테고리 조회_회원</h3>
            <form method="get" action="/api/category/out/user" enctype="application/x-www-form-urlencoded">
                <label>
                    회원 식별자(user_id)
                    <input type="text" name="user_id" placeholder="user_id">
                </label>                        
                <div class="optional">
                    <h5>Optional</h5>
                    <label>
                        페이지(p)
                        <input type="text" name="p" placeholder="p">
                    </label>                                            
                    <label>
                        순서(order)
                        <select name="order">
                            <option value="desc">desc</option>
                            <option value="asc">asc</option>                        
                        </select>
                    </label>                            
                    <label>
                        개수(limit)
                        <input type="text" name="limit" placeholder="limit">
                    </label>                                            
                </div>    
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>     
    </div>        
    <div class="article">
        <h2>5.카테고리 동영상</h2>    
        <div class="section">
            <h3>5_1.동영상 등록</h3>
            <form method="post" action="/api/category/video/create" enctype="application/x-www-form-urlencoded">
                <label>
                    카테고리 식별자(category_id)
                    <input type="text" name="category_id" placeholder="category_id">
                </label>
                <div class="optional">
                    <h5>Optional</h5>            
                    <label>
                        비디오 아이디(video_id)
                        <input type="text" name="video_id" placeholder="video_id">
                    </label>
                    <label>
                        비디오 타이틀(video_title)
                        <input type="text" name="video_title" placeholder="video_title">
                    </label>                        
                    <label>
                        비디오 썸네일(video_thumbnail_url)
                        <input type="text" name="video_thumbnail_url" placeholder="video_thumbnail_url">
                    </label>                                                            
                    <label>
                        비디오 등록일(video_description)
                        <input type="text" name="video_description" placeholder="video_description">
                    </label>
                    <label>
                        비디오 채널 아이디(video_channel_id)
                        <input type="text" name="video_channel_id" placeholder="video_channel_id">
                    </label>                    
                    <label>
                        비디오 채널 타이틀(video_channel_title)
                        <input type="text" name="video_channel_title" placeholder="video_channel_title">
                    </label>                                        
                </div>
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>        

        <div class="section">
            <h3>5_2.동영상 삭제</h3>
            <form method="post" action="/api/category/video/delete" enctype="application/x-www-form-urlencoded">
                <label>
                    관계 식별자(relation_id)
                    <input type="text" name="relation_id" placeholder="relation_id">
                </label>            
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>      

        <div class="section">
            <h3>5_3.동영상 조회_식별자</h3>
            <form method="get" action="/api/category/video/out/id" enctype="application/x-www-form-urlencoded">
                <label>
                    카테고리 식별자(relation_id)
                    <input type="text" name="relation_id" placeholder="relation_id">
                </label>            
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>     
        
        <div class="section">
            <h3>5_4.동영상 조회_카테고리</h3>
            <form method="get" action="/api/category/video/out/category" enctype="application/x-www-form-urlencoded">
                <label>
                    카테고리 식별자(relation_id)
                    <input type="text" name="category_id" placeholder="category_id">
                </label>            
                <button type="submit">전송</button>
                <button type="reset">취소</button>            
            </form>        
        </div>             
    </div>
</body>
</html>