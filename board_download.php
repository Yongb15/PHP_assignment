<?php
    // GET 요청에서 파일 관련 정보를 가져옴
    $real_name = $_GET["real_name"]; // 서버에 저장된 실제 파일 이름
    $file_name = $_GET["file_name"]; // 다운로드 시 사용자에게 보여줄 파일 이름
    $file_type = $_GET["file_type"]; // 파일 타입 (미사용)
    $file_path = "./data/" . $real_name; // 실제 파일 경로

    // 사용자의 브라우저가 IE인지 확인
    $ie = preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) ||
        (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0') !== false && 
            strpos($_SERVER['HTTP_USER_AGENT'], 'rv:11.0') !== false);

    // IE인 경우 한글 파일명이 깨지는 것을 방지하기 위한 처리
    if ($ie) {
        $file_name = iconv('utf-8', 'euc-kr', $file_name);
    }

    // 파일이 존재하는지 확인
    if (file_exists($file_path)) {
        // 파일을 바이너리 모드로 열기
        $fp = fopen($file_path, "rb"); 

        // 파일 다운로드를 위한 HTTP 헤더 설정
        Header("Content-type: application/x-msdownload"); 
        Header("Content-Length: " . filesize($file_path));     
        Header("Content-Disposition: attachment; filename=" . $file_name);   
        Header("Content-Transfer-Encoding: binary"); 
        Header("Content-Description: File Transfer"); 
        Header("Expires: 0"); 

        // 파일을 출력하여 다운로드를 시작하고, 파일 포인터를 닫음
        if (!fpassthru($fp)) {
            fclose($fp); 
        }
    }
?>
