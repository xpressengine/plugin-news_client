
<p align="center"> 
  <img src="https://raw.githubusercontent.com/xpressengine/plugin-news_client/master/icon.png">
 </p>

# XE3 News Plugin
이 플러그인은 Xpressengine3(이하 XE3)의 플러그인입니다.

이 플러그인을 사용하여, 메인 페이지 또는 서브 페이지에 XE3의 새로운 소식을 나열할 수 있습니다.

<p align="center"> 
  <img src="https://raw.githubusercontent.com/xpressengine/plugin-news_client/develop/news_preview.PNG">
 </p>
 




## What can I do?

본 플러그인을 통하여, XE3의 새로운 소식을 누구보다 빠르게 지켜볼 수 있습니다.


## Installation specification
* Minimum installation environment
   XE3, PHP 7.0 or later
* Recommended installation environment
   XE3, PHP 7.1 or later

## Caution
본인 홈페이지의 새로운 글이 아닌, XE3의 공식 홈페이지 게시글 입니다.


# Installation
### Console
```
$ php artisan plugin:install news_client
```

### Web install
- 관리자 > 플러그인 & 업데이트 > 플러그인 목록 내에 새 플러그인 설치 버튼 클릭
- `news_client` 검색 후 설치하기

### Ftp upload
- 다음의 페이지에서 다운로드
    * https://store.xpressengine.io/plugins/news_client
    * https://github.com/xpressengine/plugin-news_client/releases
- 프로젝트의 `plugins` 디렉토리 아래 `news_client` 디렉토리명으로 압축해제
- `news_client` 디렉토리 이동 후 `composer dump` 명령 실행

# Usage
Widget 페이지에 새소식 위젯을 추가해서 사용합니다.

## License
이 플러그인은 LGPL

