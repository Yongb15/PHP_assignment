<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        h3 {
            padding-left: 5px;
            border-left: solid 5px #edbf07;
        }
        #close {
            margin: 20px 0 0 80px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h3>아이디 중복체크</h3>
    <p>
        <?php
            $id = $_GET["id"];                                              // 아이디를 가져옴

            if(!$id) {
                echo("<li>아이디를 입력해 주세요!</li>");
            } else {
                $con = mysqli_connect("localhost", "user1", "12345", "music"); // MySQL에 접속

                $sql = "select * from members where id='$id'"; // id 검색
                $result = mysqli_query($con, $sql);

                $num_record = mysqli_num_rows($result);

                if ($num_record) {                                          // 동일한 id가 존재할 경우
                    echo "<li>".$id." 아이디는 중복됩니다.</li>";
                    echo "<li>다른 아이디를 사용해 주세요!</li>";
                } else {                                                    // id가 존재하지 않을 경우
                    echo "<li>".$id." 아이디는 사용 가능합니다.</li>";
                }

                mysqli_close($con);
            }
        ?>
    </p>
    <div id="close">
        <img src="./img/close.png" onclick="javascript:self.close()">
    </div>
</body>
</html>
