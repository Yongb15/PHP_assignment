<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>음악 공연 홍보 및 예약</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
<script>
  function check_input() {                          // 입력 확인 함수
      if (!document.show_form.subject.value)       // 제목이 비어 있는지 확인
      {
          alert("제목을 입력하세요!");
          document.show_form.subject.focus();
          return;
      }
      if (!document.show_form.content.value)       // 내용이 비어 있는지 확인
      {
          alert("내용을 입력하세요!");    
          document.show_form.content.focus();
          return;
      }
      document.show_form.submit();                 // 제목과 내용이 모두 입력되었을 경우 폼 제출
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
   	<div id="board_box">
	    <h3 id="board_title">
	    		게시판 > 글 수정
		</h3>
<?php
	$num  = $_GET["num"];                   // 수정할 게시글의 번호를 GET으로 가져옴
	$page = $_GET["page"];                  // 현재 페이지 번호를 GET으로 가져옴
	
	$con = mysqli_connect("localhost", "user1", "12345", "music");             // 데이터베이스 연결
	$sql = "select * from `show` where num=$num";                             // 수정할 게시글 정보를 가져오는 쿼리
	$result = mysqli_query($con, $sql);                                       // 쿼리 실행
	$row = mysqli_fetch_array($result);                                       // 결과를 배열로 가져옴
	$name       = $row["name"];                                               // 작성자 이름
	$subject    = $row["subject"];                                            // 제목
	$content    = $row["content"];                                            // 내용
	$file_name  = $row["file_name"];                                          // 첨부 파일 이름
?>
	    <form  name="show_form" method="post" action="show_modify.php?num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data"> <!-- 수정한 내용을 처리하는 페이지로 이동 -->
	    	 <ul id="show_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$name?></span>                            <!-- 작성자 이름 출력 -->
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span> <!-- 제목 입력 -->
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?=$content?></textarea>           <!-- 내용 입력 -->
	    			</span>
	    		</li>
	    		<li>
			        <span class="col1"> 첨부 파일 : </span>
			        <span class="col2"><?=$file_name?></span>                     <!-- 첨부 파일 출력 -->
			    </li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">수정하기</button></li>    <!-- 입력 확인 함수 호출하여 수정하기 -->
				<li><button type="button" onclick="location.href='show_list.php'">목록</button></li> <!-- 목록 페이지로 이동 -->
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
