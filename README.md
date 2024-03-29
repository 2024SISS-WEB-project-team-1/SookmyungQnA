# 2024-SISS-WEB-project

2024 SISS 겨울방학 웹프로젝트 1팀 
<br> 24기 김지수
<br >24기 김혜진 

----
## 숙명 지식인 프로젝트 

### 3주차
- 개발 환경 구축 (github 레포 설정, mysql 연동)
- 메인페이지 만들기 
      <br> 부트스트랩 프리소스 템플릿 참고 (출처: https://startbootstrap.com/template/blog-home )
    <br> 기획안에 맞춰 디자인 및 구성 수정 - 사이드 메뉴 탭과 글 목록 기능 추가
  
![main 페이지](https://github.com/kimhyejin0123/2024-SISS-WEB-project/assets/134305960/0996685b-138e-4f0e-b7b8-783efbc7f809)

- 회원가입 및 로그인 기능 구현
      <br> 코드펜 디자인 템플릿 사용 (출처: https://codepen.io/Rh2o/pen/yLgxJoG) 
### 1. 로그인 기능
<img src="https://github.com/kimhyejin0123/2024-SISS-WEB-project/assets/134305960/468a9c77-5ad4-4dc4-9d33-3ed78454d9fe"  width="800" height="600"/>

### 2. 회원가입 기능
<img src="https://github.com/kimhyejin0123/2024-SISS-WEB-project/assets/134305960/5cf992b0-86c7-4309-8941-19b1d0cf6f1d"  width="800" height="600"/>

### 3. 회원가입 시연
<img src="https://github.com/kimhyejin0123/2024-SISS-WEB-project/assets/134305960/452ab247-6def-4068-8084-3cbb613d160a"  width="500" height="350"/>

추가 코멘트 
 <br> // 로그인이 되고 나면 로그인 버튼은 감추고 로그아웃 버튼이 나타나게 해야 함
  <br>       -> 로그아웃 기능 구현 필요
 <br> // css: login-register 블럭 색깔 파란색으로 바꾸기 (시간 나면)


### ４주차 
ｓｉｓｓ 카페에 게시한 보고서 확인 
추가 코멘트 
- （０１２８） users 테이블을 user로 변경해서 작업함 (xampp 오류를 수정하다가 데베를 잘못 건드렸는데．．． 과정이 복잡하여 새로 만들어서 작업했다）
- 프로필이미지를 받는 form 기능 작성 아직 미구현 
- 로그인/로그아웃 버튼 감추기 기능 구현해야？ 

### 5주차 - 질문글 작성 구현
** 실수로 커밋 메시지를 "4주차 질문글 작성"으로 해버렸는데 5주차입니다...나머지 작업할 때 5주차로 커밋바람..

1. 질문글 저장용 테이블 생성
<br>MariaDB [2024SISS]> CREATE TABLE question(
<br>-> id INT NOT NULL AUTO_INCREMENT,
<br>-> author VARCHAR(100) NOT NULL,
<br>-> title VARCHAR(100) NOT NULL,
<br>-> content VARCHAR(500) NOT NULL,
<br>-> hashtag VARCHAR(100) NOT NULL,
<br>-> date DATETIME NOT NULL,
<br>-> PRIMARY KEY(id)
);

2. inc_head.php 생성
   <br>이를 모든 php 파일에 삽입하여 로그인 상태를 유지할 수 있는 코드
   <br>로그인 페이지, 마이페이지, 질문글 페이지 모두 이를 활용한 조건문을 삽입하여 로그인하지 않았다면 접근이 불가하며 로그인하도록 경고창 띄우도록 구현
   
3. write.php 와 write_check.php 생성
   <br>질문글 작성 페이지로서 제목, 내용, 카테고리(다중 선택 가능), 작성자(익명/본명 선택 가능), 작성일자(현재 날짜 자동 입력)를 삽입하여 전송하도록 구현
   ![질문글_시연](https://github.com/kimhyejin0123/2024-SISS-WEB-project/assets/134305960/9b197531-03d9-4936-a35b-064ac000d4dc)
<br>본인 이름대신 '실명'으로 들어가는 오류, date 미반영 등의 오류를 해결하여 맨 마지막줄에 제대로 테이블에 삽입된 것을 확인할 수 있음.

5. 기타
   숙명 지식IN 전용 귀여운 눈송이 favicon을 생성하였음..ㅎ
   <br>asset 파일에 넣어놓았으니 기존 favicon 대신 이를 모든 파일에 삽입하도록 ㅎㅎ^^

### 6주차 - 질문글 리스트 구현, 게시글 수정 및 삭제, 답변글 작성 및 보기
1. 로그인/로그아웃 버튼 로그인시 보이게/보이지않게 수정
   nav 를 자꾸 복붙하고 수정하니까 따로 빼서 include 할까 고민 중...
2. 수정/삭제 버튼 작성자가 아니면 숨기
3. 질문글과 답변글을 보는 post.php 작성
   틀은 만들어뒀으니 답변글 내용 표시 + 질문글과 매칭하기 구현하면 됨
4. index.php의 리스트에서 각각의 글과 연동해 post.php로 가도록 작성
5. 게시글 수정/삭제 edit.php + delete.php 
6. 마이페이지 프사는 담주에 마이페이지 꾸미면서 ㄱㄱ 
7. post.php 내에 답변글 작성란 (우측) / 등록된 답변글 보기 (하단) 추가함
8. 답변글 등록은 answer_ok.php로 처리
9. 답변글 테이블 생성
MariaDB [2024SISS]> <br>CREATE TABLE answers(
<br>-> id INT NOT NULL AUTO_INCREMENT,
<br>-> post_id INT(11) NOT NULL,
<br>-> author VARCHAR(100) NOT NULL,
<br>-> content VARCHAR(500) NOT NULL,
<br>-> date DATETIME NOT NULL,
<br>-> PRIMARY KEY(id) );

6주차-1) 
로그아웃시 오류 발생하길래 inc_head랑 index 좀 고쳐서 급하게 푸쉬함 

### 7주차 - 답변글 등록 오류 수정, 검색 기능, 수정 및 삭제, 마이페이지 프로필 사진 등록
1. 답변글 등록 후 답변글을 확인하는 과정에서 계속 오류가 났는데, 쿼리와 반복문 수정 후 오류 해결
<시연>
<img src="https://github.com/2024SISS-WEB-project-team-1/SookmyungQnA/assets/134305960/a336ac59-3837-4596-811e-df191252a2e6"  width="900" height="500"/>
<img src="https://github.com/2024SISS-WEB-project-team-1/SookmyungQnA/assets/134305960/ff6471aa-f66d-441d-9c27-c8efbe2eb0d1"  width="500" height="450"/>

3. 검색 기능 구현 => 하나는 input으로 검색어를 직접 입력해서 제목/내용/작성자 중에 옵션을 선택해서 검색할 수 있는 기능, 또 하나는 아래 있는 카테고리를 클릭했을 때 각각에 해당하는 카테고리를 지닌 글의 목록을 화면에 출력해주는 기능


