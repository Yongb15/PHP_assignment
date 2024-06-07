<?php
    session_start();  // 세션 시작

    // 세션에 저장된 'userid' 값이 존재하면 $userid에 저장, 그렇지 않으면 빈 문자열 할당
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";

    // 세션에 저장된 'username' 값이 존재하면 $username에 저장, 그렇지 않으면 빈 문자열 할당
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";

    // GET 요청으로 받은 'id' 값이 존재하면 $id에 저장, 그렇지 않으면 빈 문자열 할당
    $id = isset($_GET["id"]) ? $_GET["id"] : "";
?>
<?php
    // MySQL 데이터베이스 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // members 테이블에서 id가 $id인 레코드 조회
    $sql = "select * from members where id='$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    // 해당 레코드의 num 필드 값을 $num에 저장
    $num = $row["num"];

    // 데이터베이스 연결 종료
    mysqli_close($con);
    $userlevel = "";
?>
<?php
    // MySQL 데이터베이스 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // members 테이블에서 id가 $id인 레코드 삭제
    $sql = "delete from members where id='$id'";
    mysqli_query($con, $sql);

    // 데이터베이스 연결 종료
    mysqli_close($con);

    // admin.php로 리디렉션
    echo "
         <script>
             location.href = 'admin.php';
         </script>
       ";
?>
