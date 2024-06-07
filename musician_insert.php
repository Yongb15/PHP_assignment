<?php
    // 세션 시작
    session_start();

    // 세션에서 사용자 ID와 이름 가져오기
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";

    // 로그인 여부 확인
    if (!$userid) {
        // 로그인하지 않은 경우 경고 메시지 출력 후 이전 페이지로 이동
        echo("
            <script>
            alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
            history.go(-1);
            </script>
        ");
        exit;
    }

    // 게시글 제목과 내용 가져오기
    $subject = $_POST["subject"];
    $content = $_POST["content"];

    // 게시글 제목과 내용에 대한 HTML 특수 문자 처리
    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    // 현재 날짜와 시간 저장
    $regist_day = date("Y-m-d (H:i)");

    // 첨부 파일이 저장될 디렉토리 경로
    $upload_dir = './data/';

    // 업로드된 파일 정보 가져오기
    $upfile_name     = $_FILES["upfile"]["name"];      // 업로드 파일명
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];  // 임시 저장 파일명
    $upfile_type     = $_FILES["upfile"]["type"];      // 파일 타입
    $upfile_size     = $_FILES["upfile"]["size"];      // 파일 크기
    $upfile_error    = $_FILES["upfile"]["error"];     // 업로드 오류

    // 업로드된 파일이 존재하고 오류가 없는 경우
    if ($upfile_name && !$upfile_error) {
        // 파일명과 확장자 분리
        $file = explode(".", $upfile_name);
        $file_name = $file[0];          // 파일명
        $file_ext  = $file[1];          // 확장자

        // 새로운 파일명 생성 (년_월_일_시_분_초)
        $new_file_name = date("Y_m_d_H_i_s");
        $new_file_name = $new_file_name;
        $copied_file_name = $new_file_name . "." . $file_ext;  // 저장될 파일명

        // 파일을 업로드할 경로 및 파일명 설정
        $uploaded_file = $upload_dir . $copied_file_name;

        // 업로드된 파일의 크기가 1MB 이상인 경우
        if ($upfile_size > 1000000) {
            echo("
                <script>
                alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                history.go(-1);
                </script>
            ");
            exit;
        }

        // 임시 저장된 파일을 지정된 디렉토리로 이동하여 복사
        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
            echo("
                <script>
                alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                history.go(-1);
                </script>
            ");
            exit;
        }
    } else {
        // 업로드된 파일이 없거나 오류가 발생한 경우 빈 값으로 초기화
        $upfile_name      = "";
        $upfile_type      = "";
        $copied_file_name = "";
    }

    // 데이터베이스 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // 게시글 정보를 데이터베이스에 삽입
    $sql = "INSERT INTO musician (id, name, subject, content, regist_day, file_name, file_type, file_copied) "; 
    $sql .= "VALUES ('$userid', '$username', '$subject', '$content', '$regist_day', ";
    $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
    mysqli_query($con, $sql);  // 쿼리 실행

    // 데이터베이스 연결 종료
    mysqli_close($con);

    // 목록 페이지로 이동
    echo "
       <script>
        location.href = 'musician_list.php';
       </script>
    ";
?>
