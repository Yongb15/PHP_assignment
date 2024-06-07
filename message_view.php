<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>음악 공연 홍보 및 예약</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/message.css">
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
    <div id="main_img_bar">
        <img src="./data/JJanggu.jpg" width="500px" height="180px">
    </div>
    <div id="message_box">
        <h3 class="title">
        <?php
            $mode = $_GET["mode"];              // 송신/수신 쪽지함 모드를 가져옴
            $num  = $_GET["num"];               // 메시지 번호를 가져옴

            $con = mysqli_connect("localhost", "user1", "12345", "music"); // 데이터베이스에 연결
            $sql = "select * from message where num=$num"; // 해당 메시지 번호의 데이터를 가져오는 쿼리
            $result = mysqli_query($con, $sql); // 쿼리 실행

            $row = mysqli_fetch_array($result); // 쿼리 결과에서 한 행을 가져옴
            $send_id    = $row["send_id"]; // 발신자 아이디
            $rv_id      = $row["rv_id"]; // 수신자 아이디
            $regist_day = $row["regist_day"]; // 등록일자
            $subject    = $row["subject"]; // 제목
            $content    = $row["content"]; // 내용

            $content = str_replace(" ", "&nbsp;", $content); // 공백 문자를 HTML 공백 문자로 변환
            $content = str_replace("\n", "<br>", $content); // 개행 문자를 HTML 줄 바꿈 태그로 변환

            if ($mode=="send") // 송신 쪽지함 모드인 경우
                $result2 = mysqli_query($con, "select name from members where id='$rv_id'"); // 수신자 이름을 가져옴
            else
                $result2 = mysqli_query($con, "select name from members where id='$send_id'"); // 발신자 이름을 가져옴

            $record = mysqli_fetch_array($result2); // 결과에서 한 행을 가져옴
            $msg_name = $record["name"]; // 메시지 발신자 또는 수신자 이름

            if ($mode=="send")          
                echo "송신 쪽지함 > 내용보기"; // 송신 쪽지함 모드인 경우 타이틀 표시
            else
                echo "수신 쪽지함 > 내용보기"; // 수신 쪽지함 모드인 경우 타이틀 표시
        ?>
        </h3>
        <ul id="view_content">
            <li>
                <span class="col1"><b>제목 :</b> <?=$subject?></span> <!-- 제목 표시 -->
                <span class="col2"><?=$msg_name?> | <?=$regist_day?></span> <!-- 발신자(또는 수신자) 이름과 등록일자 표시 -->
            </li>
            <li>
                <?=$content?> <!-- 메시지 내용 표시 -->
            </li>       
        </ul>
        <ul class="buttons">
                <li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li> <!-- 수신 쪽지함으로 이동하는 버튼 -->
                <li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li> <!-- 송신 쪽지함으로 이동하는 버튼 -->
                <li><button onclick="location.href='message_response_form.php?num=<?=$num?>'">답변 쪽지</button></li> <!-- 메시지에 답장하는 버튼 -->
                <li><button onclick="location.href='message_delete.php?num=<?=$num?>&mode=<?=$mode?>'">삭제</button></li> <!-- 메시지 삭제하는 버튼 -->
        </ul>
    </div> 
</section> 
<footer>
    <?php include "footer.php";?> 
</footer>
</body>
</html>
