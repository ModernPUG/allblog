## PHP 블로거 글 모음 웹사이트 

매주 일요일 오전 10시 홍대인근 카페에 모여 라라벨을 학습할 목적으로 만들고 개선하고 있습니다.

버그 제보나 개선 제안은 이슈에 등록해주세요.

## 로컬 환경 설정

### 다운로드 & 설치

```bash
# allblog 프로젝트 다운로드
git clone https://github.com/ModernPUG/allblog.git 
cd allblog
composer install
```

### DB 만들기

#### DB 생성

MySQL에 db생성권한이 있는 계정으로 접근하여 다음 명령 실행 필요

```sql
CREATE DATABASE allblog CHARACTER SET utf8 COLLATE utf8_bin;
  
CREATE USER 'allblog'@'localhost' IDENTIFIED BY 'password' PASSWORD EXPIRE NEVER;

GRANT ALL PRIVILEGES ON allblog.* TO 'allblog'@'localhost';
 
flush privileges;
```

#### .env 에 DB 관련 설정 변경

`.env.example` 파일을 복사해서 `.env` 파일을 만듦

`.env` 파일에서 DB 관련 설정을 아래와 같이 변경

````
DB_DATABASE=allblog
DB_USERNAME=allblog
DB_PASSWORD=password
````

#### 패키지에 존재하는 리소스들 복사

```bash
php artisan vendor:publish 
```


#### 마이그레이션

```bash
$ php artisan migrate

$ php artisan migrate --path=packages/ModernPUG/FeedReader/migrations
```

### storage 폴더 권한 조정

```bash
$ chmod -R 755 storage
```

### 오토로드 갱신

클래스를 찾을 수 없다는 에러 메시지 발생시 프로젝트 루트 폴더에서 `composer dump` 를 실행하여 오토로드를 갱신
