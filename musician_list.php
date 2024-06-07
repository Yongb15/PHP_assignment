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
	    <h3>
	    	게시판 > 목록보기
		</h3>
	    <ul id="board_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col4">첨부</span>
					<span class="col5">등록일</span>
				</li>
<?php
	// 현재 페이지 번호를 가져옴
	if (isset($_GET["page"])) {
		$page = $_GET["page"];
	} else {    
		$page = 1;  
	}

	// 데이터베이스에 연결
	$con = mysqli_connect("localhost", "user1", "12345", "music");

	// 게시글을 최신순으로 가져오는 SQL 쿼리를 실행
	$sql = "select * from musician order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 10; // 한 페이지에 표시할 글의 개수

	// 전체 페이지 수를 계산
	if ($total_record % $scale == 0) {   
		$total_page = floor($total_record/$scale);
	} else {
		$total_page = floor($total_record/$scale) + 1; 
	}

	// 현재 페이지에 따라 시작 위치를 계산
	$start = ($page - 1) * $scale;      
	$number = $total_record - $start;

	// 가져올 게시글을 반복문을 통해 출력
	for ($i=$start; $i<$start+$scale && $i < $total_record; $i++) {
		mysqli_data_seek($result, $i); // 데이터 포인터를 이동
		$row = mysqli_fetch_array($result); // 레코드를 배열로 가져옴
		$num         = $row["num"];
		$id          = $row["id"];
		$name        = $row["name"];
		$subject     = $row["subject"];
		$regist_day  = $row["regist_day"];
		if ($row["file_name"]) { // 첨부 파일이 있는 경우
			$file_image = "<img src='./img/file.gif'>"; // 이미지로 표시
		} else {
			$file_image = " "; // 첨부 파일이 없는 경우 공백으로 처리
		}
?>
				<!-- 게시글 목록을 출력합니다. -->
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col2"><a href="musician_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
					<span class="col3"><?=$name?></span>
					<span class="col4"><?=$file_image?></span>
					<span class="col5"><?=$regist_day?></span>
				</li>	
<?php
   	   $number--; // 번호를 감소
   }
   mysqli_close($con); // 데이터베이스 연결을 닫음
?>
	    	</ul>
			<ul id="page_num"> 	
<?php
	if ($total_page>=2 && $page >= 2)	{ // 이전 페이지로 이동할 수 있는 링크를 출력
		$new_page = $page-1;
		echo "<li><a href='musician_list.php?page=$new_page'>◀ 이전</a> </li>";
	} else {
		echo "<li>&nbsp;</li>";
	}

   	// 페이지 번호를 출력합니다.
   	for ($i=1; $i<=$total_page; $i++) {
		if ($page == $i) { // 현재 페이지는 링크 X
			echo "<li><b> $i </b></li>";
		} else {
			echo "<li><a href='musician_list.php?page=$i'> $i </a><li>";
		}
   	}

   	if ($total_page>=2 && $page != $total_page) { // 다음 페이지로 이동할 수 있는 링크를 출력
		$new_page = $page+1;	
		echo "<li> <a href='musician_list.php?page=$new_page'>다음 ▶</a> </li>";
	} else {
		echo "<li>&nbsp;</li>";
	}
?>
			</ul> <!-- page_num -->
			<ul class="buttons">
				<li><button onclick="location.href='musician_list.php'">목록</button></li>
			</ul>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
