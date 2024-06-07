<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>음악 공연 홍보 및 예약</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
<script>
  function check_input() {
      if (!document.musician_form.subject.value) {    // 제목이 비어 있는지 확인
          alert("제목을 입력하세요!");
          document.musician_form.subject.focus();
          return false;    // 제목이 비어있으면 false 반환
      }
      if (!document.musician_form.content.value) {    // 내용이 비어 있는지 확인
          alert("내용을 입력하세요!");    
          document.musician_form.content.focus();
          return false;    // 내용이 비어있으면 false 반환
      }
      return true;    // 모든 조건을 통과하면 true 반환
   }
</script>
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
    <div id="main_img_bar">
        <img src="./data/JJanggu.jpg" width="500px" height="180px">
    </div>
    <div id="board_box">
        <h3 id="board_title">
                게시판 > 글 쓰기
        </h3>
<?php
    // GET 방식으로 전달된 게시글 번호와 페이지 번호를 변수에 저장
    $num  = $_GET["num"];                   
    $page = $_GET["page"];                  

    // 데이터베이스에 접속하여 수정할 게시글의 정보를 가져옴
    $con = mysqli_connect("localhost", "user1", "12345", "music");             
    $sql = "select * from musician where num=$num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    // 가져온 게시글의 정보를 변수에 저장
    $name       = $row["name"];           // 작성자 이름
    $subject    = $row["subject"];        // 제목
    $content    = $row["content"];        // 내용
    $file_name  = $row["file_name"];      // 첨부 파일명

    ?>

    <!-- 수정할 게시글 정보를 입력하는 폼 시작 -->
    <form name="musician_form" method="post" action="musician_modify.php?num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data">               
        <ul id="show_form">
            <!-- 작성자 이름 표시 -->
            <li>
                <span class="col1">이름 : </span>
                <span class="col2"><?=$name?></span>
            </li>        
            <!-- 제목 입력란 -->
            <li>
                <span class="col1">제목 : </span>
                <span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span>
            </li>            
            <!-- 내용 입력란 -->
            <li id="text_area">    
                <span class="col1">내용 : </span>
                <span class="col2">
                    <textarea name="content"><?=$content?></textarea>
                </span>
            </li>
            <!-- 첨부 파일 표시 -->
            <li>
                <span class="col1"> 첨부 파일 : </span>
                <span class="col2"><?=$file_name?></span>
            </li>
        </ul>
        <!-- 수정 및 취소 버튼 -->
        <ul class="buttons">
            <li><button type="submit" onclick="return check_input()">수정하기</button></li>
            <li><button type="button" onclick="location.href='musician_list.php'">목록</button></li>
        </ul>
    </form>
<!-- 폼 종료 -->
</div> <!-- board_box -->

</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
