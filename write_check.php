<?php
include "connect.php"; 
include 'inc_head.php';

//각 변수에 write.php로부터 input name값들을 저장
$author = $_POST['author'];
$title = $_POST['qtitle'];
$content = $_POST['qcontent'];
$hashtag = $_POST['hashtag'];
// 날짜 및 시간 값을 적절한 형식으로 변환
$date = date('Y-m-d H:i:s', strtotime($_POST['currentDatetime']));

$query = "INSERT INTO question (author, title, content, hashtag, date) VALUES ('$author', '$title', '$content', '$hashtag', '$date')";


if($conn->query($query) === TRUE){
    echo "<script> alert('질문 등록 완료!'); location.href='index.php';</script>";
    // index.php는 등록한 질문글 볼 수 있는 페이지로 이동하도록 수정할 것
} else {
    echo "<script> alert('남은 항목을 기입해주세요.'); history.back();</script>"; // 실패시 다시 복귀
}

$conn->close();

?>
