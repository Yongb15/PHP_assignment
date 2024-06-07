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
    <?php include "header.php";?> <!-- 헤더 파일 포함 -->
</header>  
<section>
	<div id="main_img_bar">
        <img src="./data/JJanggu.jpg" width="500px" height="180px">
    </div>
   	<div id="board_box">
	    <h3 class="title">
			게시판 > 내용보기 <!-- 제목 출력 -->
		</h3>
<?php
	$num  = $_GET["num"];                           // 수정할 num
	$page  = $_GET["page"];                         // 현재 페이지 번호

	$con = mysqli_connect("localhost", "user1", "12345", "music");             // DB 접속
	$sql = "select * from `show` where num=$num";                                // num에 해당하는 레코드 가져오는 쿼리
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);                                         // 결과를 배열로 저장
	$id      = $row["id"];                                                      // 작성자 아이디
	$name      = $row["name"];                                                  // 작성자 이름
	$regist_day = $row["regist_day"];                                           // 작성일
	$subject    = $row["subject"];                                               // 제목
	$content    = $row["content"];                                               // 내용
	$file_name    = $row["file_name"];                                           // 첨부 파일 이름
	$file_type    = $row["file_type"];                                           // 첨부 파일 유형
	$file_copied  = $row["file_copied"];                                         // 복사된 파일 이름

	$content = str_replace(" ", "&nbsp;", $content);                             // 공백을 &nbsp;로 대체
	$content = str_replace("\n", "<br>", $content);                              // 줄 바꿈을 <br>로 대체
  
	mysqli_query($con, $sql);                                                     // 쿼리 실행
?>		
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>                <!-- 제목 출력 -->
				<span class="col2"><?=$name?> | <?=$regist_day?></span>                <!-- 작성자 이름과 작성일 출력 -->
			</li>
			<li>
				<?php
					if($file_name) {                                                   // 파일이 첨부되어 있는 경우
						$real_name = $file_copied;                                     
						$file_path = "./data/".$real_name;
						$file_size = filesize($file_path);

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='show_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>"; // 파일 다운로드 링크 출력
			       	}
				?>
				<?=$content?>                                                        <!-- 내용 출력 -->
			</li>		
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='show_list.php?page=<?=$page?>'">목록</button></li>               <!-- 목록 페이지로 이동하는 버튼 -->
				<li><button onclick="location.href='show_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li> <!-- 수정 페이지로 이동하는 버튼 -->
				<li><button onclick="location.href='show_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li> <!-- 삭제 페이지로 이동하는 버튼 -->
				<li><button onclick="location.href='show_form.php'">글쓰기</button></li>                           <!-- 글쓰기 페이지로 이동하는 버튼 -->
		</ul>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?> <!-- 푸터 파일 포함 -->
</footer>
</body>
</html>
