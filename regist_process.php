<?php
include "connect.php";

//form의 input 태그로 받은 값들 (POST 방식으로 받아옴)
$userID = $_POST['userID'];
$userPW = $_POST['password'];
$username = $_POST['name'];
$usermajor = $_POST['major'];

//mysql 데베에 정보들을 넣을 쿼리문
$query = "INSERT INTO user (userID, password, name, major) VALUES ('$userID', '$userPW', '$username', '$usermajor')";

if ($conn->query($query) === TRUE) {
    echo '<script> alert("회원가입이 완료되었습니다."); </script>';
    header('Location: index.php'); // 성공시 index.html로 이동

} else {
    echo '<script> alert("오류 발생", $conn->error ); </script>';
    header('Location: login-regist.php'); // 실패시 다시 복귀
}

$conn->close();
//데베 연결 close
?>
