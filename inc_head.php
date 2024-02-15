<?php
  session_start();
  if( isset( $_SESSION[ 'userID' ] ) ) {
    $jb_login = TRUE;
  }
  else{
    $jb_login = FALSE; 
  }
?>

<!--이 php 파일을 모든 파일에 include 하여 로그인 상태 유지하도록 할 것!-->