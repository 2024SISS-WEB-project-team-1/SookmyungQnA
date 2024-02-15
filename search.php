<?php
include "connect.php"; 
include 'inc_head.php';

//각 변수에 index.php로부터 input name값들을 저장
$catagory = $_GET['catgo'];
$keyword = $_GET['keyword'];

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
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <h1><?php echo $catagory; ?> 에서 '<?php echo $keyword; ?>' 검색결과</h1>
                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">
                        <!--목록으로 수정한 곳-->
                        <div class="board_list_wrap">
                            <table> 
                                <thead>
                                    <tr class="table_row">
                                        <th class="num">번호</th>
                                        <th class="title">제목</th>
                                        <th class="hashtag">해시태그</th>
                                        <th class="date">작성일</th>
                                        <th class="author">작성자</th>
                                    </tr>
                                </thead>
                                <?php
                                    // question 테이블에서 id를 기준으로 10개까지 표시
                                      $sql = "SELECT * FROM question WHERE $catagory like '%$keyword%' order by id desc"; 
                                      $result = $conn->query($sql);
                                      
                                        while($question = $result->fetch_array())
                                        {
                                          //title변수에 DB에서 가져온 title을 선택
                                          $title=$question["title"]; 
                                          if(strlen($title)>30)
                                          { 
                                            //title이 30을 넘어서면 ...표시
                                            $title=str_replace($question["title"],mb_substr($question["title"],                         0,30,"utf-8")."...",$question["title"]);
                                          }
                                    ?>

                                <tbody>
                                    <td width="70"><?php echo $question['id']; ?></td>
                                    <td width="500"><a href="post.php?post_id=<?php echo $question['id']; ?>"><?php echo $title;?></a></td> <!-- 게시글의 id를 post_id로 넘겨줌-->
                                    <td width="120"><?php echo $question['hashtag']?></td>
                                    <td width="100"><?php echo $question['date']?></td>
                                    <td width="100"><?php echo $question['author']; ?></td>
                                </tbody>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                    <!-- Pagination-->
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true"><<</a></li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <!--
                                <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                                <li class="page-item"><a class="page-link" href="#!">10</a></li>
                             -->
                            
                            <li class="page-item"><a class="page-link" href="#!">>></a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">검색</div>
                        <div class="card-body">
                            <form action="search.php" method="get" class="input-group">
                                <select name="catgo">
                                    <option value="title">제목</option>
                                    <option value="name">글쓴이</option>
                                    <option value="content">내용</option>
                                </select>
                                <input class="form-control" name="keyword" type="text" placeholder="검색어를 입력하세요.." aria-label="검색어를 입력하세요.." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button> 
                            </form>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">카테고리</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">#교내생활</a></li>
                                        <li><a href="#!">#전공</a></li>
                                        <li><a href="#!">#진로</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">#학식</a></li>
                                        <li><a href="#!">#학사/행정</a></li>
                                        <li><a href="#!">#수업</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Side widget (혹시 몰라서 남겨둠)
                    <div class="card mb-4">
                        <div class="card-header">Side Widget</div>
                        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                    </div>
                    -->
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; SOOKMYUNG SISS: Jisoo Kim & Hyejin Kim</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
