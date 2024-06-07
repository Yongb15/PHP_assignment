<?php
    // GET 요청에서 num과 page 파라미터를 가져옴
    $num = $_GET["num"];
    $page = $_GET["page"];

    // MySQL 데이터베이스 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // 해당 게시글 정보를 가져오는 SQL 쿼리
    $sql = "select * from board where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    // 첨부 파일의 이름을 가져옴
    $copied_name = $row["file_copied"];

    // 첨부 파일이 있을 경우 파일 삭제
    if ($copied_name) {
        $file_path = "./data/" . $copied_name; // 파일 경로 설정
        unlink($file_path); // 파일 삭제
    }

    // 게시글 삭제하는 SQL 쿼리
    $sql = "delete from board where num = $num";
    mysqli_query($con, $sql);

    // 데이터베이스 연결 종료
    mysqli_close($con);

    // 게시글 목록 페이지로 이동
    echo "
        <script>
            location.href = 'board_list.php?page=$page'; // board_list.php로 이동
        </script>
    ";
?>
