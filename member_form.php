<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>음악 공연 홍보 및 예약</title>
<script>
   // 사용자가 입력한 정보 유효성을 검사하는 함수
   function check_input() {
      // 아이디가 비어있는지 확인
      if (!document.member_form.id.value) {
          alert("아이디를 입력하세요!");    
          document.member_form.id.focus();
          return;
      }

      // 이름이 비어있는지 확인
      if (!document.member_form.name.value) {
          alert("이름을 입력하세요!");    
          document.member_form.name.focus();
          return;
      }
      
      // 나이가 비어있는지 확인
      if (!document.member_form.age.value) {
          alert("나이를 입력하세요!");    
          document.member_form.age.focus();
          return;
      }
      
      // 비밀번호가 비어있는지 확인
      if (!document.member_form.pass.value) {
          alert("비밀번호를 입력하세요!");    
          document.member_form.pass.focus();
          return;
      }

      // 비밀번호 확인란이 비어있는지 확인
      if (!document.member_form.pass_confirm.value) {
          alert("비밀번호 확인을 입력하세요!");    
          document.member_form.pass_confirm.focus();
          return;
      }
      
      // 휴대폰 번호가 비어있는지 확인
      if (!document.member_form.p_num.value) {
          alert("휴대폰 번호를 입력하세요!");    
          document.member_form.p_num.focus();
          return;
      }

      // 비밀번호와 비밀번호 확인이 일치하는지 확인
      if (document.member_form.pass.value != document.member_form.pass_confirm.value) {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }

      // 모든 유효성 검사를 통과하면 폼을 제출
      document.member_form.submit();
   }

   // 폼 초기화 함수
   function reset_form() {
      // 폼의 각 입력 필드 초기화
      document.member_form.id.value = "";  
      document.member_form.pass.value = "";
      document.member_form.pass_confirm.value = "";
      document.member_form.name.value = "";
      document.member_form.email1.value = "";
      document.member_form.email2.value = "";
      document.member_form.id.focus();
      return;
   }

   // 아이디 중복 확인 함수
   function check_id() {
     // 새로운 창에서 아이디 중복 확인 페이지 열기
     window.open("member_check_id.php?id=" + document.member_form.id.value,
         "IDcheck",
          "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
   }
</script>
<style>
    /* 스타일 시트 */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 600px;
        margin: 50px auto;
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
    }

    input[type="text"], input[type="password"], input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<div class="container">
    <h2>회원가입</h2>
    <!-- 회원가입 폼 -->
    <form  name="member_form" method="post" action="member_insert.php" enctype="multipart/form-data">
        <!-- 아이디 입력 -->
        <label for="id">아이디:</label>
        <!-- 아이디 중복 확인 버튼 -->
        <a href="#"><img src="./img/check_id.gif" onclick="check_id()"></a>
        <input type="text" id="id" name="id" required>
        <!-- 이름 입력 -->
        <label for="name">이름:</label>
        <input type="text" id="name" name="name" required>
        <!-- 나이 입력 -->
        <label for="age">나이:</label>
        <input type="number" id="age" name="age" required>
        <!-- 비밀번호 입력 -->
        <label for="pass">비밀번호:</label>
        <input type="password" id="pass" name="pass" required>
        <!-- 비밀번호 확인 입력 -->
        <label for="pass">비밀번호 확인:</label>
        <input type="password" name="pass_confirm" required>
        <!-- 휴대폰 번호 입력 -->
        <label for="p_num">핸드폰 번호:</label>
        <input type="text" id="p_num" name="p_num" required>
        <!-- 성별 선택 -->
        <label>성별:</label>
        <input type="radio" id="male" name="gender" value="남자" required>
        <label for="male">남성</label>
        <input type="radio" id="female" name="gender" value="여자">
        <label for="female">여성</label>
        <br><br>
        <!-- 주소 입력 -->
        <label for="address">주소:</label>
        <br>
        <input type="text" id="address" name="address" required>
        <!-- 장르 선택 -->
        <label>장르:</label>
        <input type="checkbox" id="hobby1" name="hobby[]" value="재즈">
        <label for="hobby1">재즈</label>
        <input type="checkbox" id="hobby2" name="hobby[]" value="클래식">
        <label for="hobby2">클래식</label>
        <input type="checkbox" id="hobby3" name="hobby[]" value="POP">
        <label for="hobby3">POP</label>
        <input type="checkbox" id="hobby4" name="hobby[]" value="EDM">
        <label for="hobby4">EDM</label>
        <input type="checkbox" id="hobby5" name="hobby[]" value="아이돌">
        <label for="hobby5">아이돌</label>
        <input type="checkbox" id="hobby6" name="hobby[]" value="JPOP">
        <label for="hobby6">JPOP</label>
        <input type="checkbox" id="hobby7" name="hobby[]" value="발라드">
        <label for="hobby7">발라드</label>
        <br><br>
        <!-- 가입 인사 입력 -->
        <label for="mq">가입 인사:</label>
        <input type="text" id="mq" name="mq" required>
        <!-- 대표 이미지 업로드 -->
        <label for="image">대표 이미지:</label>
        <input type="file" id="image" name="image" required>
        <br><br>
        <!-- 뮤지션 여부 선택 -->
        <label for="musician">뮤지션 여부:</label>
        <input type="radio" id="musician" name="musician" value="true" required><label for="musician">O</label>
        <input type="radio" id="musician" name="musician" value="false"><label for="musician">X</label>
        <br><br>
        <!-- 회원가입 버튼 -->
	    <img style="cursor:pointer" src="./img/button_save.gif" onclick="check_input()">&nbsp;
        <!-- 폼 초기화 버튼 -->
        <img id="reset_button" style="cursor:pointer" src="./img/button_reset.gif" onclick="reset_form()">
	</form>
</div>
</body>
</html>
