<div id="main_img_bar">
    <img src="./data/JJanggu.jpg" width="500px" height="180px">
</div>
<br><br><br><br><br><br><br>
<div id="main_content">
    <div id="latest">
        <h4>자유게시판</h4>
        <ul>
            <!-- 최근 자유게시판 글 DB에서 불러오기 -->
            <?php
                // 데이터베이스 연결
                $con = mysqli_connect("localhost", "user1", "12345", "music");
                
                // 자유게시판에서 최신 5개의 게시글 가져오기
                $sql = "select * from board order by num desc limit 5";
                $result = mysqli_query($con, $sql);

                // 게시글이 없는 경우
                if (!$result)
                    echo "아직 게시글이 없습니다!";
                else {
                    while( $row = mysqli_fetch_array($result) ) {
                        $regist_day = substr($row["regist_day"], 0, 10);
            ?>
            <li>
                <span><?=$row["subject"]?></span>
                <span><?=$row["name"]?></span>
                <span><?=$regist_day?></span>
            </li>
            <?php
                    }
                }
                // 데이터베이스 연결 종료
                mysqli_close($con);
            ?>
        </ul>
    </div>
    <div id="point_rank">
        <h4>공연공지 게시판</h4>
        <ul>
            <!-- 공연 공지 게시판 -->
            <?php
                // 데이터베이스 다시 연결
                $con = mysqli_connect("localhost", "user1", "12345", "music");

                // 공연 공지 게시판에서 최신 5개의 게시글 가져오기
                $sql = "select * from `show` order by num desc limit 5";
                $result = mysqli_query($con, $sql);

                // 게시글이 없는 경우
                if (!$result)
                    echo "아직 게시글이 없습니다!";
                else {
                    while( $row = mysqli_fetch_array($result) ) {
                        $regist_day = substr($row["regist_day"], 0, 10);
            ?>
            <li>
                <span><?=$row["name"]?></span>
                <span><?=$row["subject"]?></span>
                <span><?=$regist_day?></span>
            </li>
            <?php
                    }
                }
                // 데이터베이스 연결 종료
                mysqli_close($con);
            ?>
        </ul>
    </div>
</div>
