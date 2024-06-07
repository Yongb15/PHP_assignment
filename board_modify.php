<?php
    $num = $_GET["num"];                // num을 가져옴
    $page = $_GET["page"];              // page를 가져옴

    $subject = $_POST["subject"];
    $content = $_POST["content"];
          
    $con = mysqli_connect("localhost", "user1", "12345", "music");                 // DB접속
    $sql = "update board set subject='$subject', content='$content' ";              // 수정한 내용을 DB에 저장
    $sql .= " where num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);         // DB 연결 해제

    echo "
	      <script>
	          location.href = 'board_list.php?page=$page';
	      </script>
	  ";
?>

   
