<?php
include 'connect.php';
include 'inc_head.php';

$loginID = $_SESSION['userID'];
$post_id = $_GET['post_id']; 


// 각 post_id별 질문 내용을 question으로부터 가져옴
$sql = "SELECT * FROM question WHERE id='$post_id'";
$result = $conn->query($sql);
if (!$result) {
    // 쿼리 수행 중 오류가 발생한 경우
    die("Query failed: " . $conn->error);
    //에러문 확인 가능 (에러 나서 필요했다)
}
$question = $result->fetch_assoc();

$author = $question['author'];
$date = $question['date']; 
$hashtag = $question['hashtag'];
$title = $question['title'];
$content = $question['content'];

// 답변자 userID 가져오기
$u_sql = "SELECT * FROM user WHERE userID='$loginID'";
$u_result = $conn->query($u_sql);
if (!$u_result) {
    // 쿼리 수행 중 오류가 발생한 경우
    die("Query failed: " . $conn->error);
    //에러문 확인 가능
}
$user = $u_result->fetch_assoc();

$sql = "SELECT * FROM question WHERE id='$post_id'";
$result = $conn->query($sql);
if (!$result) {
    // 쿼리 수행 중 오류가 발생한 경우
    die("Query failed: " . $conn->error);
    //에러문 확인 가능
}
$question = $result->fetch_assoc();

?>

<!doctype html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/noonsong.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    <title>질문글 수정</title>
    <link href="css/write.css" rel="stylesheet" />
</head>

<body>
    <!--로그인 하지 않았다면 뒤로 돌아가도록 설정-->
    <?php
      if ( !$jb_login ) {
      echo '<script> alert("로그인 후 이용해주세요"); history.back(); </script>';
      } else {
    ?>
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
                    <?php 
                        if($jb_login) {
                    ?>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="logout.php">로그아웃</a></li>
                    <?php 
                        } else {
                    ?>
                        <li class="nav-item"><a class="nav-link active" 
                    aria-current="page" href="login-regist.php">로그인</a></li>
                    <?php 
                        }
                    ?> 
                </ul>
            </div>
        </div>
    </nav>


    <div id="question_write">
        <br><h1>질문글 수정</h1>
            <div id="write_area">
                <form action="edit_process.php?post_id=<?php echo $post_id ?>" method="post">
                    <div id="q_title">
                        <textarea name="qtitle" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required ><?php echo $title ?></textarea>
                    </div>

                    <div class="wi_line"></div>

                    <div id="q_content">
                        <textarea name="qcontent" id="ucontent" placeholder="내용" required><?php echo $content ?></textarea>
                    </div>

                    <div class="q_hashtag" align="left">
                        <h5>카테고리를 선택해주세요!</h5>
                        <!--여러 개 선택 가능하도록 체크박스-->
                        <input type="checkbox" name="hashtag" value="학교생활" checked> 학교생활 
 
                        <input type="checkbox" name="hashtag" value="학식"> 학식 

                        <input type="checkbox" name="hashtag" value="전공"> 전공 

                        <input type="checkbox" name="hashtag" value="학사/행정"> 학사/행정

                        <input type="checkbox" name="hashtag" value="진로"> 진로

                        <input type="checkbox" name="hashtag" value="수업"> 수업

                        <input type="checkbox" name="hashtag" value="기타"> 기타 <br>
                    </div>

                    <div class="q_date">
                        <br><h5>작성일자</h5>
                        <input type="datetime-local" name='currentDatetime' id='currentDatetime'/>
                    </div>

                    <div class="q_author">
                        <br><h5>작성자</h5>
                        <!--익명 or 실명 중 하나만 선택하도록 radio 속성-->
                        <input type="radio" name="author" value="익명"> 익명
                        <input type="radio" name="author" value="name"> <?=$user['name']?>
                    </div>

                    <div class="q_bt">
                        <button type="submit">등록</button>
                    </div>
                </form>
            </div>
    </div>
    <?php
      }
    ?>
    <!--작성일자를 현재로 설정하는 코드-->
    <script>
        // 현재 시간을 가져와서 포맷에 맞게 조정
        var now = new Date();
        var formattedDate = now.getFullYear() + '-' + ('0' + (now.getMonth() + 1)).slice(-2) + '-' + ('0' + now.getDate()).slice(-2);
        var formattedTime = ('0' + now.getHours()).slice(-2) + ':' + ('0' + now.getMinutes()).slice(-2);

        // 입력 필드에 값을 설정
        document.getElementById('currentDatetime').value = formattedDate + 'T' + formattedTime;
    </script>
</body>

</html>