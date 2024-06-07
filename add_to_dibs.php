<?php
// 사용자가 POST 요청을 했는지 확인
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // POST 요청으로부터 num과 userid 값을 가져옴
    $num = $_POST["num"];
    $userid = $_POST["userid"];

    // 데이터베이스에 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // 데이터베이스 연결 확인
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // members 테이블에서 주어진 userid가 존재하는지 확인
    $user_check_query = "SELECT id FROM members WHERE id='$userid'";
    $user_check_result = mysqli_query($con, $user_check_query);

    // userid가 members 테이블에 존재하는 경우
    if (mysqli_num_rows($user_check_result) > 0) {
        // 이미 찜 목록에 해당 item_num이 추가되어 있는지 확인
        $dibs_check_query = "SELECT * FROM dibs WHERE userid='$userid' AND item_num='$num'";
        $dibs_check_result = mysqli_query($con, $dibs_check_query);

        // 찜 목록에 해당 항목이 없을 경우
        if (mysqli_num_rows($dibs_check_result) == 0) {
            // dibs 테이블에 새로운 항목을 추가
            $sql = "INSERT INTO dibs (userid, item_num) VALUES ('$userid', '$num')";

            // 항목 추가 성공 시
            if (mysqli_query($con, $sql)) {
                echo "찜 목록에 추가되었습니다.";
            } else {
                // 항목 추가 실패 시
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        } else {
            // 이미 찜 목록에 추가된 항목일 경우
            echo "이미 찜 목록에 추가된 항목입니다.";
        }
    } else {
        // userid가 members 테이블에 존재하지 않을 경우
        echo "유효하지 않은 사용자 ID입니다.";
    }

    // 데이터베이스 연결 종료
    mysqli_close($con);
} else {
    // POST 요청이 아닐 경우
    echo "유효하지 않은 요청입니다.";
}
?>
