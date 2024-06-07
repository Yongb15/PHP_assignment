<?php
    $num   = $_GET["num"];                              // URL 매개변수에서 num 가져오기
    $page   = $_GET["page"];                            // URL 매개변수에서 page 가져오기

    $con = mysqli_connect("localhost", "user1", "12345", "music");   // 데이터베이스에 연결
    $sql = "select * from musician where num = $num";     // 해당 num에 대한 뮤지션 데이터 가져오기
    $result = mysqli_query($con, $sql);                   // 쿼리 실행
    $row = mysqli_fetch_array($result);                   // 결과 행 가져오기

    $copied_name = $row["file_copied"];                  // 첨부파일의 이름 가져오기

	if ($copied_name) {                                   // 첨부 파일이 있는 경우
		$file_path = "./data/".$copied_name;              // 파일 경로 설정
		unlink($file_path);                               // 파일 삭제
    }

    $sql = "delete from musician where num = $num";       // 해당 num에 대한 뮤지션 데이터 삭제 쿼리
    mysqli_query($con, $sql);                             // 쿼리 실행
    mysqli_close($con);                                   // 데이터베이스 연결 종료

    echo "
	     <script>
	         location.href = 'musician_list.php?page=$page';   // 삭제 후 뮤지션 목록 페이지로 이동
	     </script>
	   ";
?>
