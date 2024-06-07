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
				<!-- 게시판 목록 헤더 -->
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col4">첨부</span>
					<span class="col5">등록일</span>
					<span class="col6">조회</span>
				</li>
<?php
	// 페이지 번호 처리
	if (isset($_GET["page"]))                           // 현재 있는 board의 페이지를 가져옴
		$page = $_GET["page"];                      // 가져온 페이지 수 대로
	else    
		$page = 1;                              // 없으면 1페이지

	// 데이터베이스 연결
	$con = mysqli_connect("localhost", "user1", "12345", "music");             // DB 접속
	// 쿼리 실행
	$sql = "select * from board order by num desc";                             // 계시글의 순서대로 정렬
	$result = mysqli_query($con, $sql);
	// 전체 레코드 수
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 10;                                    // 한 페이지당 전체 글의 개수는 10개

	// 전체 페이지 수 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;

   // 게시글 목록 출력
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);
      // 레코드 가져오기
      $row = mysqli_fetch_array($result);
	  // 데이터 추출
	  $num         = $row["num"];
	  $id          = $row["id"];
	  $name        = $row["name"];
	  $subject     = $row["subject"];
      $regist_day  = $row["regist_day"];
      // 파일 첨부 여부 확인
      if ($row["file_name"])                                // 첨부파일이 있을 경우
      	$file_image = "<img src='./img/file.gif'>";         // 이미지로 표시
      else
      	$file_image = " ";
?>
				<!-- 게시글 하나 -->
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col2"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
					<span class="col3"><?=$name?></span>
					<span class="col4"><?=$file_image?></span>
					<span class="col5"><?=$regist_day?></span>
				</li>	
<?php
   	   $number--;
   }
   // 데이터베이스 연결 해제
   mysqli_close($con);                  // DB 접속 해제 

?>
	    	</ul>
			<!-- 페이지 번호 -->
			<ul id="page_num"> 	
<?php
	// 이전 페이지 링크
	if ($total_page>=2 && $page >= 2)	
	{
		$new_page = $page-1;
		echo "<li><a href='board_list.php?page=$new_page'>◀ 이전</a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

   	// 페이지 번호 출력
   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='board_list.php?page=$i'> $i </a><li>";
		}
   	}
   	// 다음 페이지 링크
   	if ($total_page>=2 && $page != $total_page)		
   	{
		$new_page = $page+1;	
		echo "<li> <a href='board_list.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->	    	
			<!-- 버튼 -->
			<ul class="buttons">
				<li><button onclick="location.href='board_list.php'">목록</button></li>
				<li>
<?php 
    // 로그인 여부에 따라 글쓰기 버튼 표시
    if($userid) {
?>
					<button onclick="location.href='board_form.php'">글쓰기</button>
<?php
	} else {
?>
					<a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
<?php
	}
?>
				</li>
			</ul>
	</div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
