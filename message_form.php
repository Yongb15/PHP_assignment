<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>음악 공연 홍보 및 예약</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/message.css">
<script>
  // 입력 값 확인 함수
  function check_input() {
      // 수신 아이디 입력 확인
      if (!document.message_form.rv_id.value) {
          alert("수신 아이디를 입력하세요!");
          document.message_form.rv_id.focus();
          return;
      }
      // 제목 입력 확인
      if (!document.message_form.subject.value) {
          alert("제목을 입력하세요!");
          document.message_form.subject.focus();
          return;
      }
      // 내용 입력 확인
      if (!document.message_form.content.value) {
          alert("내용을 입력하세요!");    
          document.message_form.content.focus();
          return;
      }
      // 폼 전송
      document.message_form.submit();
   }
</script>

</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<?php
	if (!$userid )
	{
		echo("<script>
				alert('로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
		exit;
	}
?>
<section>
	<div id="main_img_bar">
        <img src="./data/JJanggu.jpg" width="500px" height="180px">
    </div>
   	<div id="message_box">
	    <h3 id="write_title">
	    		쪽지 보내기
		</h3>
		
	    <form  name="message_form" method="post" action="message_insert.php?send_id=<?=$userid?>">              <!-- 이름은 message_form이고 post방식으로 하고 message_insert.php로 전송  -->
	    	<div id="write_msg">
	    	    <ul>
				<li>
					<span class="col1">보내는 사람 : </span>
					<span class="col2"><?=$userid?></span>
				</li>	
				<li>
					<span class="col1">수신 아이디 : </span>
					<span class="col2"><input name="rv_id" type="text"></span>
				</li>	
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text"></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea>
	    			</span>
	    		</li>
	    	    </ul>
                    <ul class="top_buttons">
				<li><span><a href="message_box.php?mode=rv">수신 쪽지함 </a></span></li>
				<li><span><a href="message_box.php?mode=send">송신 쪽지함</a></span></li>
                                <button type="button" onclick="check_input()">보내기</button>                               
                    </ul> 
	    	</div>	    	
	    </form>
	</div> <!-- message_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
