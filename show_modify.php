<?php
    $num = $_GET["num"];                // 수정할 게시글의 번호를 GET으로 가져옴
    $page = $_GET["page"];              // 현재 페이지 번호를 GET으로 가져옴

    $subject = $_POST["subject"];       // 수정된 제목을 POST로 가져옴
    $content = $_POST["content"];       // 수정된 내용을 POST로 가져옴
          
    $con = mysqli_connect("localhost", "user1", "12345", "music");  // 데이터베이스에 연결
    $sql = "update `show` set subject='$subject', content='$content' ";  // 게시글 수정 쿼리 생성
    $sql .= " where num=$num";          // 수정할 게시글의 번호에 해당하는 행을 지정
    mysqli_query($con, $sql);           // 쿼리 실행하여 데이터베이스 업데이트

    mysqli_close($con);         // 데이터베이스 연결 해제

    // 수정이 완료되면 목록 페이지로 리다이렉트
    echo "
        <script>
            location.href = 'show_list.php?page=$page';  // 수정된 페이지로 이동
        </script>
    ";
?>
