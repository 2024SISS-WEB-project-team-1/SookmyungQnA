<?php
include 'connect.php';

$loginID = $_POST['loginID'];
$loginPW = $_POST['loginPW'];
//POST로 받아온 아이다와 비밀번호가 비었다면 알림창을 띄우고 전 페이지로 돌아갑니다.
if($loginID == "" || $loginPW == ""){
		echo '<script> alert("아이디나 패스워드 입력하세요"); history.back(); </script>';
	}
else{ //아이디와 패스워드 전부 입력되었을 경우
  // 입력받은 아이디로 사용자 정보 조회
  $query = "SELECT * FROM user WHERE userID = '$loginID'";
  $result = $conn->query($query);
  $user = $result->fetch_assoc();
  // 쿼리문으로 뽑아낸 데이터를 fetch_assoc 배열로 저장하여 user 변수로 지정
  if ($_POST['loginPW'] === $user['password']) {
    //입력받은 비밀번호 === 데이터베이스 상의 비밀번호일 경우
            // 로그인 성공
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['major'] = $user['major'];
            echo "<script>alert('로그인되었습니다.'); location.href='index.php';</script>";
            exit();
	}else{ // 비밀번호가 같지 않다면 알림창을 띄우고 전 페이지로 돌아갑니다
		echo "<script>alert('아이디 혹은 비밀번호를 확인하세요.'); history.back();</script>";
	}
}
?>
