<?php

    $num   = $_GET["num"];  // URL에서 num 값을 가져옴
    $page   = $_GET["page"]; // URL에서 page 값을 가져옴

    $con = mysqli_connect("localhost", "user1", "12345", "music");  // 데이터베이스에 연결
    $sql = "select * from `show` where num = $num"; // num에 해당하는 레코드를 가져오는 SQL 쿼리
    $result = mysqli_query($con, $sql); // SQL 쿼리 실행
    $row = mysqli_fetch_array($result); // 결과 레코드를 배열로 가져옴

    $copied_name = $row["file_copied"]; // 첨부 파일의 복사된 이름을 가져옴

	if ($copied_name) { // 첨부 파일이 있을 경우
		$file_path = "./data/".$copied_name; // 첨부 파일의 경로를 설정
		unlink($file_path); // 첨부 파일 삭제 (unlink 함수를 통해)
    }

    $sql = "delete from `show` where num = $num"; // num에 해당하는 레코드를 삭제하는 SQL 쿼리
    mysqli_query($con, $sql); // SQL 쿼리 실행
    mysqli_close($con); // 데이터베이스 연결 종료 (해제)

    // 삭제 후 다시 목록 페이지로 이동하는 JavaScript 코드
    echo "
	     <script>
	         location.href = 'show_list.php?page=$page';
	     </script>
	   ";
?>

