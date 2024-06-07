<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { // POST 요청을 확인합니다.
    // "dib_id" 키가 POST로 전달되었는지 확인합니다.
    if(isset($_POST["dib_id"])) {
        $dib_id = $_POST["dib_id"]; // POST로 전달된 dib_id를 가져옵니다.

        $con = mysqli_connect("localhost", "user1", "12345", "music"); // 데이터베이스에 연결

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error()); // 연결에 실패하면 오류 메시지를 출력하고 스크립트를 중단
        }

        $sql = "DELETE FROM dibs WHERE id='$dib_id'"; // dibs 테이블에서 해당 dib_id를 가진 항목을 삭제하는 SQL 쿼리를 생성

        if (mysqli_query($con, $sql)) { // SQL 쿼리를 실행하고 성공 여부를 확인
            echo "삭제되었습니다."; // 삭제가 성공했을 경우 성공 메시지를 출력
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con); // 삭제에 실패한 경우 오류 메시지를 출력
        }

        mysqli_close($con); // 데이터베이스 연결을 닫기
    } else {
        echo "삭제되었습니다."; 
        echo "<script>window.history.back();</script>";
    }
} else {
    echo "유효하지 않은 요청입니다."; // POST 요청이 아닌 경우에는 유효하지 않은 요청
}
?>
