<?php
// 세션 시작
session_start();

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

// 사용자 정보 초기화
$userlevel = "";
$upfile = "";

// 사용자가 로그인한 경우
if ($userid) {
    // 데이터베이스에 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // 연결 확인
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // 회원 정보 조회
    $sql = "SELECT * FROM members WHERE id='$userid'";
    $result = mysqli_query($con, $sql);

    // 조회 결과가 있는 경우
    if ($result) {
        $row = mysqli_fetch_array($result);

        // 사용자 정보 설정
        if ($row) {
            $userlevel = $row["level"];
            $upfile = $row["image"];
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // 데이터베이스 연결 종료
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>음악 공연 홍보 및 예약</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/admin.css">
</head>
<body>
<header>
    <!-- 헤더 파일 포함 -->
    <?php include "header.php";?>
</header>  
<section>
    <div id="admin_box">
        <h3 id="member_title">
            관리자 모드 > 회원 관리
        </h3>
        <ul id="member_list">
            <li>
                <span class="col1">번호</span>
                <span class="col2">아이디</span>
                <span class="col3">이름</span>
                <span class="col4">레벨</span>
                <span class="col5">뮤지션</span>
                <span class="col6">회원정보수정</span>
                <span class="col7">수정</span>
                <span class="col8">삭제</span>
            </li>
<?php
// 데이터베이스 연결
$con = mysqli_connect("localhost", "user1", "12345", "music");

// 모든 회원 정보 조회
$sql = "select * from members";
$result = mysqli_query($con, $sql);
$total_record = mysqli_num_rows($result); // 전체 회원 수

$number = $total_record;

// 각 회원 정보 출력
while ($row = mysqli_fetch_array($result)) {
    $id = $row["id"];
    $name = $row["name"];
    $level = $row["level"];
    $musician = $row["musician"];
?>
            
            <li>
            <form method="post" action="admin_member_update.php?id=<?=$id?>"> <!-- 수정할 경우 -->
                <span class="col1"><?=$number?></span>
                <span class="col2"><?=$id?></a></span>
                <span class="col3"><?=$name?></span>
                <span class="col4"><input type="text" name="level" value="<?=$level?>"></span>
                <span class="col5"><input type="checkbox" name="musician" value="true" <?=($musician == 'true') ? 'checked' : ''?>></span>
                <span class="col6"><button type="button" onclick="location.href='admin_member_modify_form.php?id=<?=$id?>'">수정</button></span>
                <span class="col7"><button type="submit">수정</button></span>
                <span class="col8"><button type="button" onclick="location.href='admin_member_delete.php?id=<?=$id?>'">삭제</button></span>
            </form>
            </li>    
<?php
    $number--;
}
?>
        </ul>
        <h3 id="member_title">
            관리자 모드 > 자유 게시판 관리
        </h3>
        <ul id="board_list">
            <li class="title">
                <span class="col1">선택</span>
                <span class="col2">번호</span>
                <span class="col3">이름</span>
                <span class="col4">제목</span>
                <span class="col5">첨부파일명</span>
                <span class="col6">작성일</span>
            </li>
            <form method="post" action="admin_board_delete.php"> <!-- 삭제할 경우-->
<?php
// 자유 게시판 글 목록 조회
$sql = "select * from board order by num desc";                         
$result = mysqli_query($con, $sql);
$total_record = mysqli_num_rows($result); // 전체 글의 수

$number = $total_record;

// 각 게시글 정보 출력
while ($row = mysqli_fetch_array($result)) {
    $num = $row["num"];
    $name = $row["name"];
    $subject = $row["subject"];
    $file_name = $row["file_name"];
    $regist_day = $row["regist_day"];
    $regist_day = substr($regist_day, 0, 10);
?>
            <li>
                <span class="col1"><input type="checkbox" name="item[]" value="<?=$num?>"></span> <!-- 체크 박스 사용 / item이라는 배열 사용 -->
                <span class="col2"><?=$number?></span>
                <span class="col3"><?=$name?></span>
                <span class="col4"><?=$subject?></span>
                <span class="col5"><?=$file_name?></span>
                <span class="col6"><?=$regist_day?></span>
            </li>    
<?php
    $number--;
}
?>
                <button type="submit">선택된 글 삭제</button>
            </form>
        </ul>
        
        <h3 id="member_title">
            관리자 모드 > 뮤지션 게시판 관리
        </h3>
        <ul id="board_list">
            <li class="title">
                <span class="col1">선택</span>
                <span class="col2">번호</span>
                <span class="col3">이름</span>
                <span class="col4">제목</span>
                <span class="col5">첨부파일명</span>
                <span class="col6">작성일</span>
            </li>
            <form method="post" action="admin_musicsion_board_delete.php"> <!-- 삭제할 경우-->
<?php
// 뮤지션 게시판 글 목록 조회
$sql = "select * from musician order by num desc";                         
$result = mysqli_query($con, $sql);
$total_record = mysqli_num_rows($result); // 전체 글의 수

$number = $total_record;

// 각 게시글 정보 출력
while ($row = mysqli_fetch_array($result)) {
    $num = $row["num"];
    $name = $row["name"];
    $subject = $row["subject"];
    $file_name = $row["file_name"];
    $regist_day = $row["regist_day"];
    $regist_day = substr($regist_day, 0, 10);
?>
            <li>
                <span class="col1"><input type="checkbox" name="item[]" value="<?=$num?>"></span> <!-- 체크 박스 사용 / item이라는 배열 사용 -->
                <span class="col2"><?=$number?></span>
                <span class="col3"><?=$name?></span>
                <span class="col4"><?=$subject?></span>
                <span class="col5"><?=$file_name?></span>
                <span class="col6"><?=$regist_day?></span>
            </li>    
<?php
    $number--;
}
?>
                <button type="submit">선택된 글 삭제</button>
            </form>
        </ul>

        <h3 id="member_title">
            <a href="show_form.php">관리자 모드 > 관리자 게시판 관리</a>
        </h3>
        <ul id="board_list">
            <li class="title">
                <span class="col1">선택</span>
                <span class="col2">번호</span>
                <span class="col3">이름</span>
                <span class="col4">제목</span>
                <span class="col5">첨부파일명</span>
                <span class="col6">작성일</span>
            </li>
            <form method="post" action="admin_show_board_delete.php"> <!-- 삭제할 경우-->
<?php
// 관리자 게시판 글 목록 조회 (show 테이블은 예약어이므로 `` 사용)
$sql = "select * from `show` order by num desc";                         
$result = mysqli_query($con, $sql);
$total_record = mysqli_num_rows($result); // 전체 글의 수

$number = $total_record;

// 각 게시글 정보 출력
while ($row = mysqli_fetch_array($result)) {
    $num = $row["num"];
    $name = $row["name"];
    $subject = $row["subject"];
    $file_name = $row["file_name"];
    $regist_day = $row["regist_day"];
    $regist_day = substr($regist_day, 0, 10);
?>
            <li>
                <span class="col1"><input type="checkbox" name="item[]" value="<?=$num?>"></span> <!-- 체크 박스 사용 / item이라는 배열 사용 -->
                <span class="col2"><?=$number?></span>
                <span class="col3"><?=$name?></span>
                <span class="col4"><?=$subject?></span>
                <span class="col5"><?=$file_name?></span>
                <span class="col6"><?=$regist_day?></span>
            </li>    
<?php
    $number--;
}
mysqli_close($con);
?>
                <button type="submit">선택된 글 삭제</button>
            </form>
        </ul>
    </div> <!-- admin_box -->
</section> 
</body>
</html>
