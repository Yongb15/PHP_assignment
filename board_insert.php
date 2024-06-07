<meta charset="utf-8">
<?php
    session_start();  // 세션 시작
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];  // 세션 변수에서 사용자 아이디 확인
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];  // 세션 변수에서 사용자 이름 확인
    else $username = "";

    // 로그인이 안된 경우 경고 메시지를 출력하고 이전 페이지로 돌아감
    if (!$userid) {
        echo("
            <script>
            alert('게시판 글쓰기는 로그인 후 이용해 주세요!');  // 경고 메시지 출력
            history.go(-1)  // 이전 페이지로 돌아감
            </script>
        ");
        exit;  // 스크립트 종료
    }

    // 폼으로부터 제목과 내용을 받아옴
    $subject = $_POST["subject"];  // board_form에서 전송된 제목
    $content = $_POST["content"];  // board_form에서 전송된 내용

    // HTML 특수 문자를 변환하여 XSS 방지
    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일 시:분'을 저장

    $upload_dir = './data/';  // 첨부 파일이 저장될 디렉토리

    // 파일 업로드 관련 정보들을 배열에서 가져옴
    $upfile_name    = $_FILES["upfile"]["name"];
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
    $upfile_type    = $_FILES["upfile"]["type"];
    $upfile_size    = $_FILES["upfile"]["size"];
    $upfile_error   = $_FILES["upfile"]["error"];

    // 파일이 업로드되고 오류가 없는 경우 처리
    if ($upfile_name && !$upfile_error) {
        $file = explode(".", $upfile_name);  // 파일명을 '.'을 기준으로 분리
        $file_name = $file[0];  // 파일명
        $file_ext  = $file[1];  // 확장자

        $new_file_name = date("Y_m_d_H_i_s");  // 새로운 파일 이름을 현재 시간으로 설정
        $copied_file_name = $new_file_name.".".$file_ext;  // 새로운 파일명.확장자
        $uploaded_file = $upload_dir.$copied_file_name;  // 저장될 파일 경로

        // 파일 크기가 1MB를 초과하는 경우 경고 메시지 출력
        if ($upfile_size > 1000000) {
            echo("
            <script>
            alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요!');
            history.go(-1)  // 이전 페이지로 돌아감
            </script>
            ");
            exit;  // 스크립트 종료
        }

        // 파일을 지정된 디렉토리에 복사하지 못한 경우 경고 메시지 출력
        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
            echo("
                <script>
                alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                history.go(-1)  // 이전 페이지로 돌아감
                </script>
            ");
            exit;  // 스크립트 종료
        }
    } else {
        // 파일 업로드 정보 초기화
        $upfile_name      = "";
        $upfile_type      = "";
        $copied_file_name = "";
    }
    
    // 데이터베이스 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // 게시글을 데이터베이스에 삽입하는 SQL 쿼리 작성
    $sql = "insert into board (id, name, subject, content, regist_day, file_name, file_type, file_copied) ";  
    $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', ";
    $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
    mysqli_query($con, $sql);  // SQL 쿼리 실행

    mysqli_close($con);  // 데이터베이스 연결 종료

    // 게시판 목록 페이지로 이동
    echo "
       <script>
        location.href = 'board_list.php';
       </script>
    ";
?>
