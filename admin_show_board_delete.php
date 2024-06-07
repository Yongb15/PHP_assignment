<?php
    session_start(); // 세션 시작
    if (isset($_SESSION["level"])) $userlevel = $_SESSION["level"]; // 세션에 저장된 사용자 레벨을 가져옴
    else $userlevel = ""; // 세션에 사용자 레벨이 없으면 빈 문자열 할당

    // 사용자 레벨이 3 (관리자)이 아닐 경우
    if ($userlevel != 3) {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!'); // 경고창 출력
            history.go(-1); // 이전 페이지로 이동
            </script>
        ");
        exit; // 스크립트 실행 중단
    }

    // POST 요청에서 삭제할 게시글을 선택했는지 확인
    if (isset($_POST["item"])) {
        $num_item = count($_POST["item"]); // 선택된 게시글 수
    } else {
        echo("
            <script>
            alert('삭제할 게시글을 선택해주세요!'); // 경고창 출력
            history.go(-1); // 이전 페이지로 이동
            </script>
        ");
        exit; // 스크립트 실행 중단 (exit가 없어서 오류 발생 가능성 제거)
    }

    // MySQL 데이터베이스 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // 선택된 각 게시글을 삭제
    for ($i = 0; $i < count($_POST["item"]); $i++) { // 선택된 게시글 배열
        $num = $_POST["item"][$i]; // 게시글 번호 가져오기

        // 게시글 정보 가져오기
        $sql = "select * from `show` where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $copied_name = $row["file_copied"]; // 게시글에 첨부된 파일명 가져오기

        // 첨부된 파일이 있을 경우 파일 삭제
        if ($copied_name) {
            $file_path = "./data/" . $copied_name; // 파일 경로 설정
            unlink($file_path); // 파일 삭제
        }

        // 게시글 삭제
        $sql = "delete from `show` where num = $num";
        mysqli_query($con, $sql);
        
        // dibs 테이블에서 해당 게시글에 대한 데이터 삭제
        $sql_dibs = "DELETE FROM dibs WHERE item_num='$num'";
        mysqli_query($con, $sql_dibs);
    }

    // 데이터베이스 연결 종료
    mysqli_close($con);

    // 관리자 페이지로 이동
    echo "
        <script>
            location.href = 'admin.php'; // admin.php로 이동
        </script>
    ";
?>
