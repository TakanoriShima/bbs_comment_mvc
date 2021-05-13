<?php
    // コントローラ
    
    // 外部ファイルの読み込み
    require_once 'models/Message.php';
    
    // セッション開始
    session_start();
    
    // セッションからflash_messageを取得しセッション情報を破棄
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    
    // セッションからerrorsを取得しセッション情報を破棄
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;

    // ビューの表示
    include_once 'views/create_view.php';
    
    
