<meta charset='utf-8'>
<?php
    $send_id = $_GET["send_id"];  // 송신자 아이디

    $rv_id = $_POST['rv_id'];      // 수신자 아이디
    $subject = $_POST['subject'];  // 제목
    $content = $_POST['content'];  // 내용
	$subject = htmlspecialchars($subject, ENT_QUOTES);  // HTML 특수 문자 변환
	$content = htmlspecialchars($content, ENT_QUOTES);  // HTML 특수 문자 변환
	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	// 송신자가 로그인되어 있는지 확인
	if(!$send_id) {
		echo("
			<script>
			alert('로그인 후 이용해 주세요! ');
			history.go(-1)
			</script>
			");
		exit;
	}

	$con = mysqli_connect("localhost", "user1", "12345", "music");     // DB 연결
	$sql = "select * from members where id='$rv_id'";           // 수신자 아이디가 존재하는지 확인하는 쿼리
	$result = mysqli_query($con, $sql);
	$num_record = mysqli_num_rows($result);

	if($num_record)
	{
		// 메시지를 데이터베이스에 저장하는 쿼리
		$sql = "insert into message (send_id, rv_id, subject, content,  regist_day) ";
		$sql .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
		mysqli_query($con, $sql);  // 쿼리 실행
	} else {
		// 수신자 아이디가 존재하지 않는 경우 경고 메시지 출력
		echo("
			<script>
			alert('수신 아이디가 잘못 되었습니다!');
			history.go(-1)
			</script>
			");
		exit;
	}

	mysqli_close($con);                // DB 연결 종료

	echo "
	   <script>
	    location.href = 'message_box.php?mode=send';            // 송신 쪽지함으로 이동
	   </script>
	";
?>
