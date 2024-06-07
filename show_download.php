<?php
    $real_name = $_GET["real_name"];     // 다운로드할 파일의 실제 이름을 가져옴
    $file_name = $_GET["file_name"];     // 다운로드할 파일의 표시 이름을 가져옴
    $file_type = $_GET["file_type"];     // 다운로드할 파일의 유형을 가져옴
    $file_path = "./data/".$real_name;   // 다운로드할 파일의 경로를 설정함

    $ie = preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) ||               // 클라이언트 브라우저가 IE인지 확인
        (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0') !== false && 
            strpos($_SERVER['HTTP_USER_AGENT'], 'rv:11.0') !== false);

    // 만약 클라이언트 브라우저가 IE라면 한글 파일명이 깨지지 않도록 변환
    if( $ie ){
         $file_name = iconv('utf-8', 'euc-kr', $file_name);
    }

    if( file_exists($file_path) ) {                  // 다운로드할 파일이 존재하는지 확인
        $fp = fopen($file_path,"rb");                // 파일을 바이너리 모드로 열기
        Header("Content-type: application/x-msdownload");  // 다운로드할 파일의 MIME 유형 설정
        Header("Content-Length: ".filesize($file_path));   // 다운로드할 파일의 크기 설정
        Header("Content-Disposition: attachment; filename=".$file_name);   // 파일 다운로드를 위한 헤더 설정
        Header("Content-Transfer-Encoding: binary");   // 전송 인코딩을 바이너리로 설정
        Header("Content-Description: File Transfer");   // 파일 전송에 대한 설명 설정
        Header("Expires: 0");                           // 캐시 제어를 위해 만료일 설정
    } 
	
    if(!fpassthru($fp)) // 파일을 출력 버퍼에 작성하는 것
	fclose($fp);          
?>
