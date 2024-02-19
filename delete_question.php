<?php 

include "connect.php"; 
include "inc_head.php";

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    $query = "SELECT * FROM question WHERE id = $post_id";
    $result = $conn->query($query);

    if (!$result) {
        // 쿼리 수행 중 오류가 발생한 경우
        die("Query failed: " . $conn->error);
        //에러문 확인 가능 (에러 나서 필요했다)
    }

    $question = $result->fetch_assoc();

    $author = $question['author'];
    // 본인 글이 아닐 경우

    $delete_query = "DELETE FROM question WHERE id = $post_id";

    if ($conn->query($delete_query) === TRUE) {
        echo "<script>
            alert('글 삭제가 완료되었습니다.');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "오류: " . $conn->error;
    }

    $conn->close();
}
else {
    exit(); 
}


?>



<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글 삭제하기</title>

    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />

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

</body>
</html>