<?php
  include 'inc_head.php';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
    <link href="css\login.css" rel="stylesheet" />
</head>
<body>
    <!--이미 로그인 한 상태라면 뒤로 돌아가도록 설정-->
    <?php
      if ( $jb_login ) {
      echo '<script> alert("이미 로그인하셨습니다."); history.back(); </script>';
      } else {
    ?>
    <h2>숙명지식IN</h2>
    <div class="container" id="container">
      <div class="form-container sign-up-container">

        <form method = "post" action="regist_process.php">
          <h1>계정 생성하기</h1>

          <span> 머라구 적지 </span>
          <input type="text" placeholder="아이디" name= "userID" />
          <input type="password" placeholder="비밀번호" name = "password" />
          <input type="text" placeholder="이름" name = "name" />
          <input type="text" placeholder="전공" name = "major">
          <button>회원가입</button>

        </form>

      </div>
      <div class="form-container sign-in-container">
        <form method = "post" action="login_process.php">
          <h1>로그인 하기</h1>
          <br>
          <input type="text" placeholder="아이디" name="loginID"/>
          <input type="password" placeholder="비밀번호" name="loginPW"/>
          <a href="#">비밀번호를 잊으셨다면? #이거 구현 미정</a>
          <button> 로그인 </button>
        </form>
      </div>
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1>가입을 환영합니다!</h1>
            <p>본인의 학과 정보를 입력하고, 나에게 맞는 정보만을 찾아보세요<br><br> 계정이 이미 있다면?</p>
            <button class="ghost" id="signIn">로그인 하기</button>
          </div>
          <div class="overlay-panel overlay-right">
            <h1>새송이를 환영합니다!</h1>
            <p> 동기 선배들과 함께 새로운 대학생활을 시작해봐요. <br><br> 아직 계정이 없다면?</p>
            <button class="ghost" id="signUp">회원가입 하기</button>
          </div>
        </div>
      </div>
    </div>

    <script src = "js/login.js"></script>
    <!-- js를 바디 끝에다 삽입해야 함 안그러면 적용이 안됨...(이 js는 html이 전부 로드 된 다음 실행 가능하므로 head에 작성할 경우 null 오류가 발생) -->
    <?php
      }
    ?>
  </body>
</html>
