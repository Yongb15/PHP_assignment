<?php
    $num = $_GET["num"];                // 수정할 게시글의 번호를 가져옴
    $page = $_GET["page"];              // 현재 페이지 번호를 가져옴

    $subject = $_POST["subject"];       // 수정된 제목을 가져옴
    $content = $_POST["content"];       // 수정된 내용을 가져옴
          
    $con = mysqli_connect("localhost", "user1", "12345", "music");   // 데이터베이스에 연결
    $sql = "update musician set subject='$subject', content='$content' ";   // 수정된 내용을 데이터베이스에 업데이트
    $sql .= " where num=$num";          // 해당하는 게시글의 번호로 업데이트
    mysqli_query($con, $sql);           // 쿼리 실행

    mysqli_close($con);         // 데이터베이스 연결 종료

    echo "
	      <script>
	          location.href = 'musician_list.php?page=$page';   // 수정된 내용이 반영된 목록 페이지로 이동
	      </script>
	  ";
?>
