<meta charset='utf-8'>

<?php

	$num = $_GET["num"]; // num 값을 가져옴

	$mode = $_GET["mode"]; // mode 값을 가져옴 

	// MySQL 데이터베이스에 연결
	$con = mysqli_connect("localhost", "user1", "12345", "music");

	// 삭제할 메시지의 num 값에 해당하는 데이터를 삭제하는 SQL 쿼리
	$sql = "delete from message where num=$num";

	// SQL 쿼리 실행
	mysqli_query($con, $sql);

	// MySQL 연결 종료
	mysqli_close($con);

	// 삭제 후 이동할 페이지 URL 설정
	if($mode == "send")
		$url = "message_box.php?mode=send";
	else
		$url = "message_box.php?mode=rv";

	// JavaScript를 이용하여 페이지 이동
	echo "
	<script>
		location.href = '$url';
	</script>
	";

?>

