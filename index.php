<?php
include_once('./_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_PATH.'/head.php');
?>
 
<!--<h2 class="sound_only">최신글</h2>-->
<!-- 최신글 시작 { -->
<?php
//  최신글
//$sql = " select bo_table
//            from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
//            where a.bo_device <> 'mobile' ";
//if(!$is_admin)
//    $sql .= " and a.bo_use_cert = '' ";
//$sql .= " order by b.gr_order, a.bo_order ";
//$result = sql_query($sql);
//for ($i=0; $row=sql_fetch_array($result); $i++) {
//    if ($i%2==1) $lt_style = "margin-left:20px";
//    else $lt_style = "";
?>
<!--
    <div style="float:left;<?php echo $lt_style ?>">
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest("basic", $row['bo_table'], 5, 25);
        ?>
    </div>
-->
<?php
//}
?>
<!-- } 최신글 끝 -->
<link rel="stylesheet" href="/css/index.css"/>

<content>
    <div class="contentLeft">
        <div class="noticeBlock contentArea">
            <div class="titleBar">
                <div class="title">
                    공지사항
                </div>
                
                <div class="tabBar">
                    <a href="#" class="nowTab">전체</a> |
                    <a href="#">제주대</a> |
                    <a href="#">한라대</a> |
                    <a href="#">관광대</a>
                </div>
                
                <a href="#" class="btn_more">+</a>
            </div>
            
            <ul class="noticeList">
                <li>
                    <a href="3">2016년 해외단기 연수(일본)</a>
                </li>
                
                <li>
                    <a href="3">2016년 해외단기 연수(일본)</a>
                </li>
                
                <li>
                    <a href="3">2016년 해외단기 연수(일본)</a>
                </li>
                
                <li>
                    <a href="3">2016년 해외단기 연수(일본)</a>
                </li>
                
                <li>
                    <a href="3">2016년 해외단기 연수(일본)</a>
                </li>
                
                <li>
                    <a href="3">2016년 해외단기 연수(일본)</a>
                </li>
                
                <li>
                    <a href="3">2016년 해외단기 연수(일본)</a>
                </li>
            </ul>
        </div>
        
        <div class="calendarBlock contentArea">
            <div class="titleBar">
                <div class="title">
                    프로그램 일정
                </div>
                
                <a href="#" class="btn_more">+</a>
            </div>
            
            <ul>
                <li>
                    <span class="calendar_dateBlock">
                        <p class="calendar_month">11</p>
                        <p class="calendar_day">10</p>
                    </span>
                    
                    <span class="calendar_subject">
                        <a href="3">2016년 해외단기 연수(일본)</a>
                    </span>
                    
                    <span class="calendar_more">
                        +9개
                    </span>
                </li>
                
                <li>
                    <span class="calendar_dateBlock">
                        <p class="calendar_month">11</p>
                        <p class="calendar_day">10</p>
                    </span>
                    
                    <span class="calendar_subject">
                        <a href="3">2016년 해외단기 연수(일본)</a>
                    </span>
                    
                    <span class="calendar_more">
                        +9개
                    </span>
                </li>
                
                <li>
                    <span class="calendar_dateBlock">
                        <p class="calendar_month">11</p>
                        <p class="calendar_day">10</p>
                    </span>
                    
                    <span class="calendar_subject">
                        <a href="3">2016년 해외단기 연수(일본)</a>
                    </span>
                    
                    <span class="calendar_more">
                        +9개
                    </span>
                </li>
                
                <li>
                    <span class="calendar_dateBlock">
                        <p class="calendar_month">11</p>
                        <p class="calendar_day">10</p>
                    </span>
                    
                    <span class="calendar_subject">
                        <a href="3">2016년 해외단기 연수(일본)</a>
                    </span>
                    
                    <span class="calendar_more">
                        +9개
                    </span>
                </li>
                
                <li>
                    <span class="calendar_dateBlock">
                        <p class="calendar_month">11</p>
                        <p class="calendar_day">10</p>
                    </span>
                    
                    <span class="calendar_subject">
                        <a href="3">2016년 해외단기 연수(일본)</a>
                    </span>
                    
                    <span class="calendar_more">
                        +9개
                    </span>
                </li>
                
                <li>
                    <span class="calendar_dateBlock">
                        <p class="calendar_month">11</p>
                        <p class="calendar_day">10</p>
                    </span>
                    
                    <span class="calendar_subject">
                        <a href="3">2016년 해외단기 연수(일본)</a>
                    </span>
                    
                    <span class="calendar_more">
                        +9개
                    </span>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="contentRight">
        <div class="contentRightTop">
            <div class="leftDivision">
                <div class="applyBlock contentArea">
                    <div class="titleBar">
                        <div class="title">
                            프로그램 참여 신청
                        </div>
                        
                        <a href="#" class="btn_more">+</a>
                    </div>
                    
                    <ul>
                        <li>
                            2016년 해외단기 연수(일본)
                            <a href="#" class="btn_apply">신청하기</a>
                        </li>
                        
                        <li>
                            2016년 해외단기 연수(일본)
                            <a href="#" class="btn_apply">신청하기</a>
                        </li>
                        
                        <li>
                            2016년 해외단기 연수(일본)
                            <a href="#" class="btn_apply_none">신청마감</a>
                        </li>
                        
                        <li>
                            2016년 해외단기 연수(일본)
                            <a href="#" class="btn_apply_none">신청마감</a>
                        </li>
                        
                        <li>
                            2016년 해외단기 연수(일본)
                            <a href="#" class="btn_apply_none">신청마감</a>
                        </li>
                        
                        <li>
                            2016년 해외단기 연수(일본)
                            <a href="#" class="btn_apply_none">신청마감</a>
                        </li>
                        
                        <li>
                            2016년 해외단기 연수(일본)
                            <a href="#" class="btn_apply_none">신청마감</a>
                        </li>
                    </ul>
                </div>
                
                <div class="eLearningBlock contentArea">
                    <a href="#" class="eLearning_how">
                        이러닝 강의 수강 방법 ▶︎
                    </a>
                    
                    <a href="#" class="eLearning_link">
                        이러닝 바로가기 ▶︎
                    </a>
                </div>
                
                <div class="qnaBlock contentArea">
                    <a href="#">
                        <img src="/images/qna_img.png" alt="Q&A"/>
                    </a>
                </div>
            </div>
            
            <div class="rightDivision">
                <div class="loginBlock contentArea">
                    <div class="titleBar">
                        <div class="title">
                            LOGIN
                        </div>
                    </div>
                    
                    <?php echo outlogin('basic'); // 외부 로그인, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
                    <?php echo poll('basic'); // 설문조사, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
                </div>
                
                <div class="databoardBlock contentArea">
                    <div class="titleBar">
                        <div class="title">
                            자료실
                        </div>
                        
                        <div class="tabBar">
                            <a href="#" class="nowTab">각종서식</a>|
                            <a href="#">강의자료</a>
                        </div>
                    </div>
                    
                    <ul>
                        <li>
                            <a href="#">2016년 해외단기 연수(일본)</a>
                        </li>
                        
                        <li>
                            <a href="#">2016년 해외단기 연수(일본)</a>
                        </li>
                        
                        <li>
                            <a href="#">2016년 해외단기 연수(일본)</a>
                        </li>
                        
                        <li>
                            <a href="#">2016년 해외단기 연수(일본)</a>
                        </li>
                        
                        <li>
                            <a href="#">2016년 해외단기 연수(일본)</a>
                        </li>
                        
                        <li>
                            <a href="#">2016년 해외단기 연수(일본)</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="galleryBlock contentArea">
            <div class="titleBar">
                <div class="title">
                    GALLERY
                </div>
                
                <a href="#" class="btn_more">+</a>
            </div>
            
            <ul>
                <li>
                    <span class="gallerty_photo">
                    </span>
                    
                    <span class="gallery_subject">
                    </span>
                </li>
            </ul>
        </div>
    </div>
</content>

<div id="linkZone">
</div>


<?php
include_once(G5_PATH.'/tail.php');
?>
