<?php
    include "connect.php"; 
    include "inc_head.php";

    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id']; 
    }
    
    $loginID = $_SESSION['userID'];

    // 각 post_id별 질문 내용을 question으로부터 가져옴
    $sql = "SELECT * FROM question WHERE id='$post_id'";
    $result = $conn->query($sql);
    if (!$result) {
        // 쿼리 수행 중 오류가 발생한 경우
        die("Query failed: " . $conn->error);
        //에러문 확인 가능 (에러 나서 필요했다)
    }
    $question = $result->fetch_assoc();

    // 답변자 userID 가져오기
    $u_sql = "SELECT * FROM user WHERE userID='$loginID'";
    $u_result = $conn->query($u_sql);
    if (!$u_result) {
        // 쿼리 수행 중 오류가 발생한 경우
        die("Query failed: " . $conn->error);
        //에러문 확인 가능
    }
    $user = $u_result->fetch_assoc();

    // 답변글 가져오기
    $sql2 = "SELECT * FROM answers WHERE post_id='$post_id'";
    $a_result = $conn->query($sql2);
    if (!$a_result) {
        // 쿼리 수행 중 오류가 발생한 경우
        die("Query failed: " . $conn->error);
        //에러문 확인 가능 
    }
    $answers = $a_result->fetch_all(MYSQLI_ASSOC); //답변글은 갈은 post_id를 가진 모든 답변을 가져와야 하므로 (fetch_assoc은 하나의 행만 가져옴)

?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>숙명 지식IN</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/noonsong.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
        <link href="css\post.css" rel="stylesheet" />

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
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">숙명 지식IN </h1>
                    <p class="lead mb-0">새송이들을 구원할 숙명여대 백과사전</p>
                </div>
            </div>
        </header>
        <!-- Page content-->

            <div class="row">
                <!-- 질문글 (좌측)-->
                <div class="col-lg-8">
                    <div class="row">
                        <!--목록으로 수정한 곳-->
                        <div class="question_post">
                            <h1> Q. <?php echo $question['title']; ?></h1>
                            <hr>
                            <div class="question_content"> 
                                <?php echo $question['content']; ?>
                            </div> <!-- 크기 설정합시다  -->
                            <div class="question_footer">
                                <!-- 그외 정보 footer -->
                                <div><?php echo $question['author']; ?> </div>
                                <div> <?php echo $question['date']; ?> </div>
                                <div> # <?php echo $question['hashtag']; ?></div>
                            </div>
                            <div class="question_edit"> 
                                <button> <a href="edit.php?post_id=<?php echo $id ?>"> 수정 </a> </button>
                                <button> <a href="delete.php?post_id=<?php echo $id ?>">삭제</a></button>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- 답변글 (우측)-->
                <div class="col-lg-4">
                    <h1>A. </h1>
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header"><?=$user['name']?>님, 답변해주세요!</div>
                        <!-- 답변 작성 폼 -->
                        <form action="answer_ok.php?post_id=<?php echo $post_id; ?>" method="post">
                            <div class="card-body">
                                <div id="answer_content">
                                    <textarea id="target" name= "acontent" placeholder="답변 작성" required></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="answer_footer">  
                                <!-- 그외 정보 footer -->
                                <div>
                                    작성자:  
                                    <input type="radio" name="author" value="익명"> 익명
                                    <input type="radio" name="author" value="<?=$user['name']?>"> <?=$user['name']?>
                                </div>
                                <div> 
                                    <br>작성일자:
                                    <input type="datetime-local" name='currentDatetime' id='currentDatetime'/>
                                </div>
                            </div>
                            <div class="answer_edit"> 
                                <button type="submit"> 등록 </button>
                                <!-- 작성자와 name이 다르다면 버튼 숨기기 -->
                                <button> <a href="edit.php?post_id=<?php echo $id ?>"> 수정 </a> </button>
                                <button> <a href="delete.php?post_id=<?php echo $id ?>"> 삭제 </a> </button>
                            </div>
                        </form>
                    </div>
                    <!-- Side widget (혹시 몰라서 남겨둠)
                    <div class="card mb-4">
                        <div class="card-header">Side Widget</div>
                        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                    </div>
                    -->
                </div>
                <div class="question_post">
                    <br><h2> A. 답변글 목록</h2>
                    <hr>
                    <?php
                        //answers 테이블에서 현재 보고 있는 질문의 post_id를 보유한 답변을 모두 출력하기 (오류 수정됨)
                        foreach($answers as $answer)
                        {
                            $author = $answer['author'];
                            $content = $answer['content'];
                            $date = $answer['date'];
                    ?>
                    <div class="question_content"> 
                        <?php echo $content; ?>
                    </div> 
                    <div class="question_footer">
                        <div><?php echo $author; ?> </div>
                        <div><?php echo $date; ?> </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; SOOKMYUNG SISS: Jisoo Kim & Hyejin Kim</p></div>
        </footer>
        <!--작성일자를 현재로 설정하는 코드-->
        <script>
            // 현재 시간을 가져와서 포맷에 맞게 조정
            var now = new Date();
            var formattedDate = now.getFullYear() + '-' + ('0' + (now.getMonth() + 1)).slice(-2) + '-' + ('0' + now.getDate()).slice(-2);
            var formattedTime = ('0' + now.getHours()).slice(-2) + ':' + ('0' + now.getMinutes()).slice(-2);

            // 입력 필드에 값을 설정
            document.getElementById('currentDatetime').value = formattedDate + 'T' + formattedTime;
        </script>

        <!--답변글 textarea 크기 자동 조절-->
        <script>
            const rowCount = value.split(/\r\n|\r|\n/).length; // 줄 수 세기
            const targetTextarea = document.querySelector(`#target`);

            if(rowCount < 4)
                targetTextarea.style.height="52px"; //특정 줄 수 보다 작아지면 height가 이것보다 작아지지 않았으면 한다
            else
                targetTextarea.style.height= (rowCount * 18) + "px"; // 줄 수에 따라서 높이 조절
        </script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
