<?php
    session_start();            // 세션 시작
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];                      // 세션을 실행시키면서 계속 유지
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];                // 세션을 실행시키면서 계속 유지
    else $username = "";

    if ( !$userid )         // 만약에 로그인이 안한 경우
    {
        echo("
                    <script>
                    alert('게시판 글쓰기는 로그인 후 이용해 주세요!');              // 출력
                    history.go(-1)
                    </script>
        ");
                exit;
    }

    $subject = $_POST["subject"];               // board_form에서 가져옴
    $content = $_POST["content"];               // board_form에서 가져옴

    // 특수 문자를 HTML 엔터티로 변환하여 보안성 강화
    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    $upload_dir = './data/';            // data라는 파일에다가 첨부 파일 저장

    $upfile_name     = $_FILES["upfile"]["name"];               // 업로드 파일명의 정보를 배열로 저장
    $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];           // 업로드 서버의 저장될 파일명의 정보를 배열로 저장
    $upfile_type     = $_FILES["upfile"]["type"];               // 업로드 파일 타입의 정보를 배열로 저장
    $upfile_size     = $_FILES["upfile"]["size"];               // 업로드 파일 크기의 정보를 배열로 저장
    $upfile_error    = $_FILES["upfile"]["error"];              // 업로드 파일 오류의 정보를 배열로 저장

    if ($upfile_name && !$upfile_error)
    {
        $file = explode(".", $upfile_name);
        $file_name = $file[0];                              // 따로 저장
        $file_ext  = $file[1];                              // 따로 저장

        $new_file_name = date("Y_m_d_H_i_s");               // 새로운 파일의 이름은 년_월_일_시_분_초
        $new_file_name = $new_file_name;
        $copied_file_name = $new_file_name.".".$file_ext;      
        $uploaded_file = $upload_dir.$copied_file_name;         // 저장될 새로운 파일의 이름 만들기

        if( $upfile_size  > 1000000 ) {                     // 업로드 파일 크기가 1MB이상의 파일을 첨부할 경우
            echo("
                <script>
                alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                history.go(-1)
                </script>
            ");
            exit;
        }

        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )             // 앞에서 지정해준 디렉터리로 파일을 복사가 안될 시 동작        
        {
            echo("
                <script>
                alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                history.go(-1)
                </script>
            ");
            exit;
        }
    }
    else 
    {
        $upfile_name      = "";
        $upfile_type      = "";
        $copied_file_name = "";
    }
            
    $con = mysqli_connect("localhost", "user1", "12345", "music");                         // 데이터베이스 연동

    $sql = "insert into `show` (id, name, subject, content, regist_day, file_name, file_type, file_copied) ";            // insert하기  
    $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', ";
    $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
    mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

    mysqli_close($con);                // DB 연결 끊기

    echo "
       <script>
        location.href = 'show_list.php';
       </script>
    ";
?>
