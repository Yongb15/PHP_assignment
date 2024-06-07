<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>음악 공연 홍보 및 예약</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
<script>
function addToDibs(num, userid) {
    // 찜하기 버튼 클릭 시 해당 함수를 호출하여 데이터를 서버에 전송하여 처리
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "add_to_dibs.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText); // 서버에서 반환한 응답 메시지를 알림창으로 표시
        }
    };
    xhr.send("num=" + num + "&userid=" + userid); // num과 userid를 서버로 전송
}
</script>
</head>
<body> 
<header>
    <?php include "header.php";?> <!-- header.php 파일을 포함하여 페이지에 헤더 추가 -->
</header>  
<section>
    <div id="main_img_bar">
        <img src="./data/JJanggu.jpg" width="500px" height="180px">
    </div>
    <div id="board_box">
        <h3>
            게시판 > 목록보기
        </h3>
        <ul id="board_list">
            <li>
                <span class="col1">번호</span>
                <span class="col2">제목</span>
                <span class="col3">글쓴이</span>
                <span class="col4">첨부</span>
                <span class="col5">등록일</span>
                <span class="col6">찜</span>
            </li>
            <?php
                if (isset($_GET["page"]))                           // 현재 있는 board의 페이지를 가져옴
                    $page = $_GET["page"];                      // 가져온 페이지 수 대로
                else    
                    $page = 1;                              // 없으면 1페이지

                $con = mysqli_connect("localhost", "user1", "12345", "music");             // DB 접속
                $sql = "select * from `show` order by num desc";                             // 계시글의 순서대로 정렬
                $result = mysqli_query($con, $sql);
                $total_record = mysqli_num_rows($result); // 전체 글 수

                $scale = 10;                                    // 한 페이지당 전체 글의 개수는 10개

                // 전체 페이지 수($total_page) 계산 
                if ($total_record % $scale == 0)     
                    $total_page = floor($total_record/$scale);      
                else
                    $total_page = floor($total_record/$scale) + 1; 

                // 표시할 페이지($page)에 따라 $start 계산  
                $start = ($page - 1) * $scale;      

                $number = $total_record - $start;

                for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
                {
                    mysqli_data_seek($result, $i);
                    // 가져올 레코드로 위치(포인터) 이동
                    $row = mysqli_fetch_array($result);
                    // 하나의 레코드 가져오기
                    $num         = $row["num"];
                    $id          = $row["id"];
                    $name        = $row["name"];
                    $subject     = $row["subject"];
                    $regist_day  = $row["regist_day"];
                    if ($row["file_name"])                                // 첨부파일이 있을 경우
                        $file_image = "<img src='./img/file.gif'>";         // 이미지로 표시
                    else
                        $file_image = " ";
            ?>
            <li>
                <span class="col1"><?=$number?></span>
                <span class="col2"><a href="show_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
                <span class="col3"><?=$name?></span>
                <span class="col4"><?=$file_image?></span>
                <span class="col5"><?=$regist_day?></span>
                <span class="col6"><button onclick="addToDibs(<?=$num?>, '<?=$userid?>')">찜하기</button></span>
            </li>   
            <?php
                   $number--;
               }
               mysqli_close($con);                  // DB 접속 해제 
            ?>
        </ul>
        <ul id="page_num">   
            <?php
                if ($total_page>=2 && $page >= 2)    
                {
                    $new_page = $page-1;
                    echo "<li><a href='show_list.php?page=$new_page'>◀ 이전</a> </li>";
                }       
                else 
                    echo "<li>&nbsp;</li>";

                // 게시판 목록 하단에 페이지 링크 번호 출력
                for ($i=1; $i<=$total_page; $i++)
                {
                    if ($page == $i)     // 현재 페이지 번호 링크 안함
                    {
                        echo "<li><b> $i </b></li>";
                    }
                    else
                    {
                        echo "<li><a href='show_list.php?page=$i'> $i </a><li>";
                    }
                }
                if ($total_page>=2 && $page != $total_page)        
                {
                    $new_page = $page+1;    
                    echo "<li> <a href='show_list.php?page=$new_page'>다음 ▶</a> </li>";
                }
                else 
                    echo "<li>&nbsp;</li>";
            ?>
        </ul> <!-- page -->         
        <ul class="buttons">
            <li><button onclick="location.href='show_list.php'">목록</button></li>
        </ul>
    </div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
