<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>음악 공연 홍보 및 예약</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
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
	    <h3 class="title">
			게시판 > 내용보기
		</h3>
<?php
	// URL에서 전달된 num과 page 값을 가져옴
	$num  = $_GET["num"];                           
	$page  = $_GET["page"];                         
	
	// DB에 접속
	$con = mysqli_connect("localhost", "user1", "12345", "music");             
	// num에 해당하는 레코드 가져오는 SQL 쿼리
	$sql = "select * from musician where num=$num";                                
	$result = mysqli_query($con, $sql);

	// 가져온 레코드의 배열
	$row = mysqli_fetch_array($result);                                         
	$id      = $row["id"];
	$name      = $row["name"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
	$content    = $row["content"];
	$file_name    = $row["file_name"];
	$file_type    = $row["file_type"];
	$file_copied  = $row["file_copied"];

	// 공백 및 줄 바꿈 처리
	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);
  
	// SQL 쿼리 실행
	mysqli_query($con, $sql);
?>		
	    <ul id="view_content">
			<li>
				<!-- 제목과 작성자, 작성일 표시 -->
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?></span>
			</li>
			<li>
				<?php
					// 첨부 파일이 있을 경우
					if($file_name) {                    
						$real_name = $file_copied;              // 복사된 파일 이름 저장
						$file_path = "./data/".$real_name;
						$file_size = filesize($file_path);

						// 첨부 파일 정보 출력 및 다운로드 링크 생성
						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='musician_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
			        }
				?>
				<!-- 내용 표시 -->
				<?=$content?>
			</li>		
	    </ul>
	    <!-- 버튼 영역 -->
	    <ul class="buttons">
				<!-- 목록으로 돌아가기 -->
				<li><button onclick="location.href='musician_list.php?page=<?=$page?>'">목록</button></li>
				<!-- 수정하기 -->
				<li><button onclick="location.href='musician_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li>
				<!-- 삭제하기 -->
				<li><button onclick="location.href='musician_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
				<!-- 글쓰기 페이지로 이동 -->
				<li><button onclick="location.href='musician_form.php'">글쓰기</button></li>
		</ul>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
