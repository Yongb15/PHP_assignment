<?php
    $id   = $_POST["id"];           // 사용자가 제출한 아이디를 가져옴
    $pass = $_POST["pass"];         // 사용자가 제출한 비밀번호를 가져옴

    $con = mysqli_connect("localhost", "user1", "12345", "music");      // 데이터베이스에 연결 
    $sql = "select * from members where id='$id'";                       // 제출된 아이디와 일치하는 레코드 검색
    $result = mysqli_query($con, $sql);                                  // SQL 쿼리 실행                            

    $num_match = mysqli_num_rows($result);                               // 검색 결과 레코드 수를 확인                   

    if(!$num_match)                                                      // 일치하는 레코드가 없을 경우
    {
        echo("
            <script>
                window.alert('등록되지 않은 아이디입니다!')                     
                history.go(-1)
            </script>
        ");
    }
    else                                                                // 일치하는 레코드가 존재할 경우
    {
        $row = mysqli_fetch_array($result);                             // 결과 레코드 가져오기
        $db_pass = $row["pass"];                                        // 데이터베이스에서 저장된 비밀번호 가져오기

        mysqli_close($con);                                              // 데이터베이스 연결 종료    

        if($pass != $db_pass)                                           // 제출된 비밀번호와 저장된 비밀번호가 일치하지 않을 경우
        {
            echo("
                <script>
                    window.alert('비밀번호가 틀립니다!')
                    history.go(-1)
                </script>
            ");
            exit;                                                        // 스크립트 실행 중단
        }
        else                                                             // 비밀번호가 일치할 경우
        {
            session_start();                                             // 세션 시작
            $_SESSION["userid"] = $row["id"];                           // 사용자 아이디를 세션에 저장
            $_SESSION["username"] = $row["name"];                       // 사용자 이름을 세션에 저장                  
            $_SESSION["level"] = $row["level"];                         // 사용자 레벨을 세션에 저장

            echo("
                <script>
                    location.href = 'index.php';                         // index.php 페이지로 이동
                </script>
            ");
        }
     }
 ?>
