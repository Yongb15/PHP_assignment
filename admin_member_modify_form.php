<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>음악 공연 홍보 및 예약</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/member.css">
<script type="text/javascript" src="./js/member_modify.js"></script>
</head>
<body> 
	<header>
    	<?php include "header.php"; ?> <!-- 헤더 파일 포함 -->
    </header>
<?php    
    // GET 요청으로 받은 'id' 값이 존재하면 $id에 저장, 그렇지 않으면 빈 문자열 할당
    $id = isset($_GET["id"]) ? $_GET["id"] : "";

    // MySQL 데이터베이스 연결
    $con = mysqli_connect("localhost", "user1", "12345", "music");

    // members 테이블에서 id가 $id인 레코드 조회
    $sql = "select * from members where id='$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    // 조회된 레코드의 각 필드 값을 변수에 저장
    $pass = $row["pass"];                                                                   
    $name = $row["name"];                                                                   
    $age = $row["age"];
    $p_num = $row["p_num"];
    $address = $row["address"];
    $hobbies = isset($row["hobby"]) ? explode(", ", $row["hobby"]) : []; // 취미를 배열로 변환하고, 없으면 빈 배열로 설정
    $mq = $row["mq"];
    $upfile = $row["image"];
    
    // 데이터베이스 연결 종료
    mysqli_close($con);
?>
	<section>
		<div id="main_img_bar">
            <img src="./img/main_img.png"> <!-- 메인 이미지 표시 -->
        </div>
        <div id="main_content">
      		<div id="join_box">
          	<form name="member_form" method="post" action="member_modify.php?id=<?=$id?>"> 
			    <h2>회원 정보수정</h2>
    		    	<div class="form id">
				        <div class="col1">아이디</div>
				        <div class="col2">
							<?=$id?> <!-- 사용자 아이디 표시 -->
				        </div>                 
			       	</div>
			       	<div class="clear"></div>

			       	<div class="form">
				        <div class="col1">비밀번호</div>
				        <div class="col2">
							<input type="password" name="pass" value="<?=$pass?>"> <!-- 비밀번호 입력 필드 -->
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">비밀번호 확인</div>
				        <div class="col2">
							<input type="password" name="pass_confirm" value="<?=$pass?>"> <!-- 비밀번호 확인 입력 필드 -->
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">이름</div>
				        <div class="col2">
							<input type="text" name="name" value="<?=$name?>"> <!-- 이름 입력 필드 -->
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
                    <div class="form">
				        <div class="col1">나이</div>
				        <div class="col2">
                            <input type="number" id="age" name="age" value="<?=$age?>"> <!-- 나이 입력 필드 -->
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
                    <div class="form">
				        <div class="col1">핸드폰 번호</div>
				        <div class="col2">
                            <input type="text" id="p_num" name="p_num" value="<?=$p_num?>"> <!-- 핸드폰 번호 입력 필드 -->
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
                    <div class="form">
				        <div class="col1">주소</div>
				        <div class="col2">
                            <input type="text" id="address" name="address" value="<?=$address?>"> <!-- 주소 입력 필드 -->
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
                    <div class="form">
				<div class="col1">장르</div>
				<div class="col2">
                                    <!-- 취미 체크박스 목록 -->
                                    <input type="checkbox" id="hobby1" name="hobby[]" value="재즈" <?= in_array("재즈", $hobbies) ? "checked" : "" ?>>
                                    <label for="hobby1">재즈</label>
                                    <input type="checkbox" id="hobby2" name="hobby[]" value="클래식" <?= in_array("클래식", $hobbies) ? "checked" : "" ?>>
                                    <label for="hobby2">클래식</label>
                                    <input type="checkbox" id="hobby3" name="hobby[]" value="POP" <?= in_array("POP", $hobbies) ? "checked" : "" ?>>
                                    <label for="hobby3">POP</label>
                                    <input type="checkbox" id="hobby4" name="hobby[]" value="EDM" <?= in_array("EDM", $hobbies) ? "checked" : "" ?>>
                                    <label for="hobby4">EDM</label>
                                    <input type="checkbox" id="hobby5" name="hobby[]" value="아이돌" <?= in_array("아이돌", $hobbies) ? "checked" : "" ?>>
                                    <label for="hobby5">아이돌</label>
                                    <input type="checkbox" id="hobby6" name="hobby[]" value="JPOP" <?= in_array("JPOP", $hobbies) ? "checked" : "" ?>>
                                    <label for="hobby6">JPOP</label>
                                    <input type="checkbox" id="hobby7" name="hobby[]" value="발라드" <?= in_array("발라드", $hobbies) ? "checked" : "" ?>>
                                    <label for="hobby7">발라드</label>
				    </div>                 
			       	</div>
			       	<div class="clear"></div>
                    <div class="form">
				        <div class="col1">가입인사</div>
				        <div class="col2">
                            <input type="text" id="mq" name="mq" value="<?=$mq?>"> <!-- 가입인사 입력 필드 -->
				        </div>                 
			       	</div>
			       	<div class="clear"></div>

			       	<div class="buttons">
                                <input type="hidden" name="old_image" value="<?=$upfile?>"> <!-- 기존 이미지 파일명 전달 -->    
	                	<img style="cursor:pointer" src="./img/button_save.gif" onclick="check_input()">&nbsp; <!-- 저장 버튼 -->
                  		<img id="reset_button" style="cursor:pointer" src="./img/button_reset.gif" onclick="reset_form()"> <!-- 리셋 버튼 -->
	           		</div>
           	</form>
        	</div> <!-- join_box -->
        </div> <!-- main_content -->
	</section> 
</body>
</html>
