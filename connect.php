<?php
    $conn = new mysqli('localhost', 'root', 'root1234', '2024siss');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
//mysql 서버와 연결하는 코드
//원래는 데이터베이스를 쓰는 모든 php에 적어야 하는 구문이지만 connect.php를 따로 빼고 파일 마다 inlcude connect.php를 해줌으로써 모듈화를 시켰다.

// '로컬호스트에서', 'root 최고사용자의 권한으로 접근한다', '데이터베이스 비밀번호 (스스로의 것을 입력하면 됨)','데이터베이스이름'
//본인 로컬로 pull 했을 때 본인 비번으로 고치면 작동함!

//if문은 연결 실패했을 때 오류 구문
?>
