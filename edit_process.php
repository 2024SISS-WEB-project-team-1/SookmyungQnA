<?php
include 'connect.php';
include 'inc_head.php';

$title = $_POST['qtitle'];
$content = $_POST['qcontent'];
$post_id = $_GET['post_id'];
$hashtag = $_POST['hashtag'];

// 글 업데이트 쿼리
$update_query = "UPDATE question SET title = '$title', content = '$content', hashtag = '$hashtag' WHERE id = $post_id";

if ($conn->query($update_query) === TRUE) {
    echo "<script>
        alert('글 수정이 완료되었습니다.');
        window.location.href = 'index.php';
    </script>";
} else {
    echo "오류: " . $conn->error;
}

$conn->close();


?>
