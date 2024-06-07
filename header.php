<?php
    // 세션이 없는 경우 세션을 시작
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // 세션에서 userid와 username을 가져옴
    if (isset($_SESSION["userid"])) {
        $userid = $_SESSION["userid"];
    } else {
        $userid = "";
    }

    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
    } else {
        $username = "";
    }

    // 초기화
    $userlevel = "";
    $upfile = "";
    $musician = "";

    // 로그인 상태인 경우 사용자 정보를 가져옴
    if ($userid) {
        $con = mysqli_connect("localhost", "user1", "12345", "music");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM members WHERE id='$userid'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $row = mysqli_fetch_array($result);

            if ($row) {
                $userlevel = $row["level"];
                $upfile = $row["image"];
                $musician = $row["musician"];
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

        mysqli_close($con);
    }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>음악 공연 홍보 및 예약</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <script type="text/javascript">
        // 공연 공지게시판 또는 뮤지션 게시판으로 리다이렉션?
        function redirectToShow() {
            var userLevel = <?= json_encode($userlevel) ?>;
            if (userLevel == 3) {
                window.location.href = "show_form.php";
            } else {
                window.location.href = "show_list.php";
            }
        }

        // 뮤지션 게시판으로 리다이렉션?
        function redirectToMusicsion() {
            var isMusician = <?= json_encode($musician) ?>;
            if (isMusician === 'true') {
                window.location.href = "musician_form.php";
            } else {
                alert("뮤지션 게시판에 접근할 권한이 없습니다.");
            }
        }
    </script>
</head>
<body>
    <!-- 상단 메뉴 및 로그인 정보 -->
    <div id="top">
        <h3>
            <a href="index.php">음악 공연 홍보 및 예약</a>
        </h3>
        <ul id="top_menu">  
<?php
    // 로그인 상태에 따라 메뉴 표시를 다르게 함
    if (!$userid) {
?>                
            <li><a href="member_form.php">회원 가입</a> </li>
            <li> | </li>
            <li><a href="login_form.php">로그인</a></li>
<?php
    } else {
        $logged = $username . "(" . $userid . ")님[Level:" . $userlevel . "]";
?>              
        <li><a href="member_my_page.php"><?=$logged?></a></li>
        <li><img src="./img/<?=$upfile?>" width="40" height="40"></li> 
        <li> | </li>
        <li><a href="logout.php">로그아웃</a> </li>
        <li> | </li>
        <li><a href="member_modify_form.php">정보 수정</a></li>
<?php
    }
    // 관리자인 경우 관리자 모드 메뉴 표시
    if ($userlevel == 3) {
?>
        <li> | </li>
        <li><a href="admin.php">관리자 모드</a></li>
<?php
    }
?>
        </ul>
    </div>

    <!-- 하단 메뉴 -->
    <div id="menu_bar">
        <ul>  
            <li><a href="message_form.php">쪽지 만들기</a></li>                                
            <li><a href="javascript:void(0);" onclick="redirectToShow()">공연 공지게시판</a></li>
            <li><a href="javascript:void(0);" onclick="redirectToMusicsion()">뮤지션 게시판</a></li>
            <li><a href="board_form.php">자유게시판</a></li>
        </ul>
    </div>
</body>
</html>
