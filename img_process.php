<?php
    $file=$_FILES['img'];
    var_dump($file);
    // 파일 업로드시 임시저장위치
    echo $file['tmp_name'];
    // 실제 저장하고 싶은 위치 C:Apache24/htdocs/php/
    // 업로드된 파일을 내가 지정한 위치에 지정한 파일명으로 파일을 이동
    // move_uploaded_file(현재위치, 이동할위치)
    $result = move_uploaded_file($file['tmp_name'],'imges/'.$file['name']);
    if($result) {
    echo "<script>window.location.href=index.php;</script>"; 
    }

?>


<!--
https://7ingout.tistory.com/132
출처 
 -->