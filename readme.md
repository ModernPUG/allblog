## PHP 블로거 글 모음 웹사이트 

매주 일요일 오전 10시 홍대인근 카페에 모여 라라벨을 학습할 목적으로 만들고 개선하고 있습니다.

버그 제보나 개선 제안은 이슈에 등록해주세요.

## 로컬 환경 설정

### 다운로드
````
//allblog 프로젝트 다운로드
git clone https://github.com/ModernPUG/allblog.git

/*
 * FeedReader 패키지 다운로드 
 * (FeedReader 패키지를 독립적인 패키지로 분리하여 관리할 계획이나, 
 * 개발의 편의를 위해 FeedReader 패키지를 packages/ModernPUG 폴더에 다운 받습니다. 
 * FeedReader 패키지 내의 파일을 수정한 경우 allblog 가 아닌 FeedReader 패키지에 커밋 & 푸시 해주셔야 합니다.)
 */ 
cd allblog
mkdir -p packages/ModernPUG
cd packages/ModernPUG
git clone https://github.com/ModernPUG/FeedReader.git
````

### 의존 패키지 설치

프로젝트 루트 폴더에서 `composer install` 을 실행

packages/ModernPUG/FeedReader 폴더에서 `composer install`을 실행

### DB 만들기

#### 로컬 서버용 DB 생성

MySQL에 db생성권한이 있는 계정으로 접근하여 다음 명령 실행 필요

````
mysql> CREATE DATABASE allblog;

mysql> CREATE USER 'allblog'@'localhost' IDENTIFIED BY 'password';

mysql> GRANT ALL PRIVILEGES ON allblog.* TO 'allblog'@'localhost';

mysql> FLUSH PRIVILEGES;
````

#### 테스트용 DB 생성

MySQL에 db생성권한이 있는 계정으로 접근하여 다음 명령 실행 필요

````
mysql> CREATE DATABASE allblog_test;

mysql> CREATE USER 'allblog_test'@'localhost' IDENTIFIED BY 'password';

mysql> GRANT ALL PRIVILEGES ON allblog_test.* TO 'allblog_test'@'localhost';

mysql> FLUSH PRIVILEGES;
````

#### .env 에 DB 관련 설정 변경

`.env.example` 파일을 복사해서 `.env` 파일을 만듦

`.env` 파일에서 DB 관련 설정을 아래와 같이 변경

````
DB_DATABASE=allblog
DB_USERNAME=allblog
DB_PASSWORD=password
````

#### 패키지에 존재하는 리소스들 복사해옴
````
php artisan vendor:publish 
````


#### 마이그레이션

````
$ php artisan migrate

$ php artisan migrate --path=packages/ModernPUG/FeedReader/migrations
````

### storage 폴더 권한 조정

`chmod -R 755 storage`

### 오토로드 갱신

클래스를 찾을 수 없다는 에러 메시지 발생시 프로젝트 루트 폴더에서 `composer dump` 를 실행하여 오토로드를 갱신
