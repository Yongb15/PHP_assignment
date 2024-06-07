<?php
    // GET으로 전송된 데이터 받아오기
    $id = $_GET["id"];      // 이미 id는 입력되있으므로 GET으로 가져옴

    // POST로 전송된 데이터 받아오기
    $pass = $_POST["pass"];             // 수정할 비밀번호
    $name = $_POST["name"];             // 수정할 이름
    $p_num = $_POST["p_num"];           // 수정할 휴대폰 번호
    $hobby = isset($_POST["hobby"]) && is_array($_POST["hobby"]) ? implode(", ", $_POST["hobby"]) : ""; // 수정할 취미
    $address = $_POST["address"];       // 수정할 주소
    $mq = $_POST["mq"];                 // 수정할 가입 인사
    
    // 파일 업로드 관련 정보
    $upfile_name = $_FILES["image"]["name"];    // 업로드된 파일 이름
    $upfile_tmp_name = $_FILES["image"]["tmp_name"]; // 임시 파일명
    $upfile_size = $_FILES["image"]["size"];    // 파일 크기
    $upfile_error = $_FILES["image"]["error"];  // 업로드 오류
    $upload_dir = './img/';                     // 파일 업로드 디렉토리

    // 파일 업로드 처리
    $new_file_name = ""; // 초기화

    if ($upfile_name) { // 파일이 업로드된 경우
        if (!$upfile_error) { // 오류가 없는 경우
            $file = explode(".", $upfile_name);
            $file_name = $file[0];
            $file_ext = $file[1];

            // 파일명 중복을 피하기 위해 현재 시간을 이용하여 새로운 파일명 생성
            $new_file_name = date("Y_m_d_H_i_s");
            $new_file_name = $new_file_name . "_" . $file_name . "." . $file_ext;
            $uploaded_file = $upload_dir . $new_file_name;

            // 파일 크기 제한 (1MB)
            if ($upfile_size > 1000000) {
                echo("
                    <script>
                    alert('파일 크기가 1MB를 초과합니다!');
                    history.go(-1);
                    </script>
                ");
                exit;
            }

            // 파일 이동 (업로드)
            if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
                echo("
                    <script>
                    alert('파일을 지정한 디렉터리에 복사하는데 실패했습니다.');
                    history.go(-1);
                    </script>
                ");
                exit;
            }
        } else { // 업로드 오류가 있는 경우
            echo("
                    <script>
                    alert('파일을 업로드하는데 오류가 발생했습니다.');
                    history.go(-1);
                    </script>
                ");
            exit;
        }
    } else { // 파일이 업로드되지 않은 경우 기존 파일 유지
        $new_file_name = $_POST["old_image"]; // 기존 이미지 파일명을 사용
    }

    // MySQL 데이터베이스에 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // 회원 정보를 수정하는 SQL 쿼리
    $sql = "UPDATE members SET pass='$pass', name='$name', p_num='$p_num', hobby='$hobby', address='$address', mq='$mq', image='$new_file_name'";    // UPDATE를 이용하여 갱신해줌
    $sql .= " WHERE id='$id'";          // WHERE 조건문
    mysqli_query($con, $sql);

    // MySQL 연결 종료
    mysqli_close($con);     

    // 회원 정보 수정 후 메인 페이지로 리다이렉트
    echo "
        <script>
            location.href = 'index.php';
        </script>
    ";
?>
