<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <title>음악 공연 홍보 및 예약</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <script type="text/javascript" src="./js/login.js"></script>
</head>
<body> 
    <header>
        <?php include "header.php";?> <!-- 헤더를 포함하여 페이지 상단에 추가 -->
    </header>
    <section>
        <div id="main_img_bar">
            <img src="./data/JJanggu.jpg" width="500px" height="180px">
        </div>
        <div id="main_content">
            <div id="login_box">
                <div id="login_title">
                    <span>로그인</span>
                </div>
                <div id="login_form">
                    <form  name="login_form" method="post" action="login.php"> <!-- 로그인 폼, login.php로 데이터 전송 -->
                        <ul>
                            <li><input type="text" name="id" placeholder="아이디" ></li> <!-- 아이디 입력 필드 -->
                            <li><input type="password" id="pass" name="pass" placeholder="비밀번호" ></li> <!-- 비밀번호 입력 필드 -->
                        </ul>
                        <div id="login_btn">
                            <a href="#"><img src="./img/login.png" onclick="check_input()"></a> <!-- 로그인 버튼 -->
                        </div>		          	
                    </form>
                </div> <!-- login_form -->
            </div> <!-- login_box -->
        </div> <!-- main_content -->
    </section> 
    <footer>
        <?php include "footer.php";?> <!-- 푸터를 포함하여 페이지 하단에 추가 -->
    </footer>
</body>
</html>
