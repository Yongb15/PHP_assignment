abwl<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>음악 공연 홍보 및 예약</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/member.css">
<script type="text/javascript">
// 찜한 목록을 삭제하는 함수
function deleteDib(dib_id) {
    // 사용자에게 삭제 여부를 확인하는 다이얼로그를 표시
    if (confirm("정말로 삭제하시겠습니까?")) {
        // XMLHttpRequest 객체를 생성합니다.
        var xhr = new XMLHttpRequest();
        // POST 방식으로 delete_dib.php 파일에 요청을 보냄
        xhr.open("POST", "delete_dib.php", true);
        // 요청 헤더를 설정합니다.
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        // 요청 상태가 변경되었을 때의 처리를 정의
        xhr.onreadystatechange = function () {
            // 요청이 완료되고 응답이 정상적으로 도착했을 때
            if (xhr.readyState === 4 && xhr.status === 200) {
                // 서버로부터의 응답을 알림창으로 표시
                alert(xhr.responseText);
                // 페이지를 새로고침합니다.
                location.reload();
            }
        };
        // 삭제할 항목의 ID를 요청 본문에 포함하여 전송
        xhr.send("dib_id=" + dib_id);
    }
}
</script>
</head>
<body> 
    <header>
        <?php include "header.php";?>
    </header>
<?php    
    // MySQL에 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");
    
    // 회원 정보 조회 쿼리 실행
    $sql = "SELECT * FROM members WHERE id='$userid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    // 회원 정보 변수에 할당
    $pass = $row["pass"];                                                                   
    $name = $row["name"];                                                                   
    $age = $row["age"];
    $p_num = $row["p_num"];
    $gender = $row["gender"];
    $address = $row["address"];
    $hobby = $row["hobby"];
    $mq = $row["mq"];
    $image = $row["image"];
    $musician = $row["musician"];
?>
    <section>
        <div id="main_img_bar">
            <img src="./data/JJanggu.jpg" width="500px" height="180px">
        </div>
        <div id="main_content">
            <div id="join_box">
            <form  name="member_form" method="post" action="member_modify.php?id=<?=$userid?>"> 
                <h2>회원 정보</h2>
                    <div class="form id">
                        <div class="col1">아이디</div>
                        <div class="col2">
                            <?=$userid?>
                        </div>                 
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">이름</div>
                        <div class="col2">
                            <?=$name?>
                        </div>                 
                    </div>
                    <div class="clear"></div> 
                    <div class="form">
                        <div class="col1">나이</div>
                        <div class="col2">
                            <?=$age?>
                        </div>                 
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">비밀번호</div>
                        <div class="col2">
                            <?=$pass?>
                        </div>                 
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">휴대폰 번호</div>
                        <div class="col2">
                            <?=$p_num?>
                        </div>                 
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">성별</div>
                        <div class="col2">
                            <?=$gender?>
                        </div>                 
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">주소</div>
                        <div class="col2">
                            <?=$address?>
                        </div>                 
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">취미</div>
                        <div class="col2">
                            <?=$hobby?>
                        </div>                 
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">가입 인사 <br>및 자기 소개</div>
                        <div class="col2">
                            <?=$mq?>
                        </div>                 
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">대표 이미지</div>
                        <div class="col2">
                            <img src="./img/<?=$image?>" width="50" height="50"> 
                        </div>                 
                    </div>
                    <br><br>
                    <div class="clear"></div>
                    <br><br><br><br>
                    <div class="buttons">
                        <a href="index.php">
                            <img id="reset_button" style="cursor:pointer" src="./img/button_reset.gif">
                        </a>
                    </div>
            </form>
            </div> 
        </div>
            <div id="main_content">
                <div id="join_box">
                    <form  name="member_form" method="post" action="delete_dib.php?id=<?=$userid?>">                              
                        <!-- Dibs -->
                        <div id="dibs_box">
                            <div class="col1">찜한 목록</div>
                            <div class="col2">
                                <ul id="dibs_list">
                                <?php
                                    // 찜한 목록 조회 쿼리
                                    $dibs_sql = "SELECT dibs.id AS dib_id, `show`.num, `show`.subject
                                                 FROM dibs 
                                                 JOIN `show` ON dibs.item_num = `show`.num 
                                                 WHERE dibs.userid='$userid'";

                                    // 찜한 목록 쿼리를 실행하고 결과를 저장
                                    $dibs_result = mysqli_query($con, $dibs_sql);

                                    // 만약 찜한 목록이 존재한다면
                                    if (mysqli_num_rows($dibs_result) > 0) {
                                        // 결과를 반복하여 출력
                                        while ($dibs_row = mysqli_fetch_assoc($dibs_result)) {
                                            echo "<li>
                                                    <span class='col1'>
                                                    {$dibs_row['subject']}</span>
                                                    <span class='col3'>
                                                        <button onclick='deleteDib({$dibs_row['dib_id']})'>삭제</button>
                                                    </span>
                                                  </li><br><Br><br>";
                                        }
                                    } else {
                                        // 찜한 목록이 없을 경우 메시지를 출력
                                        echo "<li>찜한 목록이 없습니다.</li>";
                                    }

                                    // MySQL 연결을 종료
                                    mysqli_close($con);
                                ?>
                                </ul>
                            </div>
                        </div>
                   </div>
            </form>
            </div> 
    </section> 
</body>
</html>
