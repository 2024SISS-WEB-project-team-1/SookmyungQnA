<?php
    include "connect.php"; 
    include "inc_head.php";
    // 회원이 아닐 경우 이전으로 돌아가도록 설정
    if(!$jb_login){
         echo "<script>alert('회원이 아닙니다.'); location.href='index.php';</script>";
         exit();
    }
    
    $loginID = $_SESSION['userID'];
    $sql = "SELECT * FROM user WHERE userID='$loginID'";
    $result = $conn->query($sql);
    if (!$result) {
        // 쿼리 수행 중 오류가 발생한 경우
        die("Query failed: " . $conn->error);
        //에러문 확인 가능 (에러 나서 필요했다)
    }
    $user = $result->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href = "css\mypage.css" rel="stylesheet"/> 
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/noonsong.ico" />
    <!-- <link href = "css\nav.css" rel="stylesheet"/> -->
    <!-- index.html과 동일한 css의 nav 디자인 적용해야 함 -->
    <title>마이페이지</title>
</head>
<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">숙명 지식IN</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="write.php">질문하기</a></li>
                        <li class="nav-item"><a class="nav-link" href="mypage.php">마이페이지</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="login-regist.php">로그인</a></li>
                    </ul>
                </div>
            </div>
        </nav>

    <div class="wrap">
      <div class="greenContainer">

         

        <div>
          <!-- 프로필 이미지 선택 form  --> 
        <form action="img_process.php" method="post" enctype="multipart/form-data"> 
            <input type="file" name="img" accept="image/jpeg,image/jpg,image/png">
            <button type="submit">확인</button>
        </form>
        <img src="../images/<?=$file['name']?>">
          <div class="major"><?=$user['major']?></div>
          <div class="name"><?=$user['name']?></div>
        </div>    
        <div class="modify">i</div>    
      </div>
      <div class="summaryContainer">
          <div class="item">
            <div class="number">0</div>
            <div>질문/답변 작성 수</div>
          </div>
          <div class="item">
            <div class="number">0</div>
            <div>채택된 답변 수</div>
          </div>
          <div class="item">
            <div class="number">0</div>
            <div>내공</div>
          </div>
      </div>  
      <div class="shippingStatusContainer">
        <div class="title">
          나의 활동
        </div>
        <div class="status">

          <div class="item">
            <div>
              <div class="green number">0</div>
              <div class="text">질문글</div>
            </div>
            <div class="icon"> > </div>
          </div>     
          <div class="item">
            <div>
              <div class="number">0</div>
              <div class="text">답변글</div>
            </div>
            <div class="icon"> > </div>
          </div>     
          <div class="item">
            <div>
              <div class="green number">0</div>
              <div class="text">질문을 기다리고 있는 글</div>
            </div>
            <div class="icon"> > </div>
          </div>     
          </div>     

        </div>

      </div>  
      <div class="listContainer">
        <a href="#" class="item">
            <div class="icon">ii</div>
            <div class="text">1번- 질문글 보기<span class="circle"></span></div>
            <div class="right"> > </div>
        </a>
        <a href="#" class="item">
            <div class="icon">ii</div>
            <div class="text">2번 - 답변글 보기</div>
            <div class="right"> > </div>
        </a>
        <a href="#" class="item">
            <div class="icon">ii</div>
            <div class="text">미정</div>
            <div class="right"> > </div>
        </a>
      </div>
      <div class="listContainer">
        <a href="#" class="item">
            <div class="icon">ii</div>
            <div class="text">
              <span>내지갑</span>
              <span class="smallLight">
                <span>|</span>
                <span>보유 내공</span>
              </span>          
            </div>                
            <div class="right">
              <span class="blct">100 내공</span>
              > </div>
        </a>
        <a href="#" class="item">
            <div class="icon">ii</div>
            <div class="text">알림</div>
            <div class="right"> > </div>
        </a>
        <a href="#" class="item">
            <div class="icon">ii</div>
            <div class="text">설정</div>
            <div class="right"> > </div>
        </a>   
      </div>
      <div class="infoContainer">
        <a href="#" class="item">
          <div>icon</div>
          <div>공지사항</div>
        </a>    
        <a href="#" class="item">
          <div>icos</div>
          <div>이용안내</div>
        </a>    
        <a href="#" class="item">
          <div>icon</div>
          <div>고객센터</div>
        </a>
      </div>
    </div>
</body>
</html>