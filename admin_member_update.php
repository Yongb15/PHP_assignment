<?php
    session_start(); // 세션 시작
    if (isset($_SESSION["level"])) $userlevel = $_SESSION["level"]; // 세션에 저장된 사용자 레벨을 가져옴
    else $userlevel = ""; // 세션에 사용자 레벨이 없으면 빈 문자열 할당
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"]; // 세션에 저장된 사용자 ID를 가져옴
    else $userid = ""; // 세션에 사용자 ID가 없으면 빈 문자열 할당

    // 사용자 레벨이 3이 아닐 경우 (관리자가 아닐 경우)
    if ($userlevel != 3) {
        echo("
            <script>
                alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!'); // 경고창 출력
                history.go(-1); // 이전 페이지로 이동
            </script>
        ");
        exit; // 스크립트 실행 중단
    }
    
    // POST 요청에서 새로운 사용자 레벨과 뮤지션 여부, GET 요청에서 수정할 사용자 ID 가져오기
    $level = isset($_POST["level"]) ? $_POST["level"] : ""; // POST 요청에서 새로운 사용자 레벨 가져오기
    $musician = isset($_POST["musician"]) ? $_POST["musician"] : "false"; // POST 요청에서 뮤지션 여부 가져오기, 기본값은 "false"
    $id = isset($_GET["id"]) ? $_GET["id"] : ""; // GET 요청에서 수정할 사용자 ID 가져오기
    
    // MySQL 데이터베이스 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // members 테이블에서 id가 $id인 레코드의 level과 musician 필드를 업데이트
    $sql = "update members set level='$level', musician='$musician' where id='$id'";
    mysqli_query($con, $sql);

    // 데이터베이스 연결 종료
    mysqli_close($con);

    // admin.php 페이지로 이동
    echo "
        <script>
            location.href = 'admin.php';
        </script>
    ";
?>
