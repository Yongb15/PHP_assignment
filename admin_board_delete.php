<?php
    session_start();  // 세션 시작

    // 세션에 저장된 'level' 값이 존재하면 $userlevel에 저장, 그렇지 않으면 빈 문자열 할당
    if (isset($_SESSION["level"])) $userlevel = $_SESSION["level"];
    else $userlevel = "";

    // 사용자가 관리자인지 확인
    if ($userlevel != 3) {
        // 관리자가 아닌 경우 경고 메시지 출력하고 이전 페이지로 이동
        echo("
            <script>
            alert('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!');  // 경고창 출력
            history.go(-1)  // 이전 페이지로 돌아가기
            </script>
        ");
        exit;  // 스크립트 실행 중단
    }

    // 삭제할 게시글이 선택되었는지 확인
    if (isset($_POST["item"]))
        $num_item = count($_POST["item"]);  // 선택된 게시글의 수
    else {
        // 선택된 게시글이 없을 경우 경고 메시지 출력하고 이전 페이지로 이동
        echo("
            <script>
            alert('삭제할 게시글을 선택해주세요!');
            history.go(-1)  // 이전 페이지로 돌아가기
            </script>
        ");
    }

    // MySQL 데이터베이스 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // 선택된 각 게시글에 대해 반복
    for ($i = 0; $i < count($_POST["item"]); $i++) {
        $num = $_POST["item"][$i];  // 게시글 번호 가져오기

        // 해당 게시글의 정보를 가져옴
        $sql = "select * from board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        // 게시글에 첨부된 파일이 있는지 확인
        $copied_name = $row["file_copied"];
        if ($copied_name) {
            // 파일이 있을 경우, 서버에서 파일 삭제
            $file_path = "./data/" . $copied_name;
            unlink($file_path);
        }

        // 게시글을 데이터베이스에서 삭제
        $sql = "delete from board where num = $num";
        mysqli_query($con, $sql);
    }

    // 데이터베이스 연결 종료
    mysqli_close($con);

    // 관리 페이지로 리디렉션
    echo "
         <script>
             location.href = 'admin.php';  // admin.php로 이동
         </script>
       ";
?>
