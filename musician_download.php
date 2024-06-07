<?php
    $real_name = $_GET["real_name"];                // 실제 파일 이름 가져오기
    $file_name = $_GET["file_name"];                // 다운로드될 파일 이름 가져오기
    $file_type = $_GET["file_type"];                // 파일 유형 가져오기
    $file_path = "./data/".$real_name;               // 파일 경로 설정

    $ie = preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) ||   // 사용자 에이전트에서 인터넷 익스플로러를 사용하는지 확인
        (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0') !== false && 
            strpos($_SERVER['HTTP_USER_AGENT'], 'rv:11.0') !== false);

    // IE 브라우저에서 한글 파일명이 깨지는 문제 해결을 위한 코드
    if( $ie ){
         $file_name = iconv('utf-8', 'euc-kr', $file_name);
    }

    if( file_exists($file_path) )                   // 파일이 존재하는지 확인
    { 
	$fp = fopen($file_path,"rb");                  // 파일 열기
	Header("Content-type: application/x-msdownload");    // 다운로드할 파일의 MIME 유형 설정
        Header("Content-Length: ".filesize($file_path));    // 다운로드할 파일의 크기 설정    
        Header("Content-Disposition: attachment; filename=".$file_name);    // 파일 다운로드 설정
        Header("Content-Transfer-Encoding: binary");     // 전송 인코딩 설정
	Header("Content-Description: File Transfer");      // 파일 전송 설명 설정
        Header("Expires: 0");                              // 캐시 만료 설정
    } 
	
    if(!fpassthru($fp))    // 파일을 출력하여 다운로드
	fclose($fp);            // 파일 닫기
?>
