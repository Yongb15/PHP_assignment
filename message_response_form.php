<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>음악 공연 홍보 및 예약</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/message.css">
<script>
  function check_input() {
      // 제목 입력 확인
      if (!document.message_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.message_form.subject.focus();
          return;
      }
      // 내용 입력 확인
      if (!document.message_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.message_form.content.focus();
          return;
      }
      // 폼 제출
      document.message_form.submit();
   }
</script>
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
	    <h3 id="write_title">
	    		답변 쪽지 보내기
		</h3>
<?php
	$num  = $_GET["num"];               // GET 방식으로 전달된 num을 가져옴

	$con = mysqli_connect("localhost", "user1", "12345", "music");                 // 데이터베이스 연결
	$sql = "select * from message where num=$num";                                  // num에 해당하는 메시지 정보를 가져오는 쿼리
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);                                             
	$send_id      = $row["send_id"];             // 송신자 아이디
	$rv_id      = $row["rv_id"];                 // 수신자 아이디
	$subject    = $row["subject"];               // 제목
	$content    = $row["content"];               // 내용

	$subject = "RE: ".$subject;                   // 제목에 "RE: "을 붙임

	$content = "> ".$content;                     // 내용에 ">"를 붙임
	$content = str_replace("\n", "\n>", $content); // 개행 문자를 "> 개행문자"로 변환
	$content = "\n\n\n-----------------------------------------------\n".$content;

	$result2 = mysqli_query($con, "select name from members where id='$send_id'"); // 송신자 이름을 가져오는 쿼리
	$record = mysqli_fetch_array($result2);
	$send_name    = $record["name"];            // 송신자 이름
?>		
	    <form  name="message_form" method="post" action="message_insert.php?send_id=<?=$userid?>">
	    	<input type="hidden" name="rv_id" value="<?=$send_id?>"> <!-- 수신자 아이디를 hidden으로 전달 -->
	    	<div id="write_msg">
	    	    <ul>
				<li>
					<span class="col1">보내는 사람 : </span>
					<span class="col2"><?=$userid?></span> <!-- 현재 로그인한 사용자 아이디 -->
				</li>	
				<li>
					<span class="col1">수신 아이디 : </span>
					<span class="col2"><?=$send_name?>(<?=$send_id?>)</span> <!-- 송신자 이름과 아이디 -->
				</li>	
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span> 
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">글 내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?=$content?></textarea> 
	    			</span>
	    		</li>
	    	    </ul>
	    	    <button type="button" onclick="check_input()">보내기</button> 
	    	</div>
	    </form>
	</div> <!-- message_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
