<?php
    // コントローラ
    
    // 外部ファイルの読み込み
    require_once 'models/Message.php';
    
    // セッション開始
    session_start();
    
    // id値を取得
    $id = $_GET['id'];
      
    // セッションからflash_messageを取得しセッション情報を破棄
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    
    // セッションからerrorsを取得しセッション情報を破棄
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;
    
    // モデルを使ってテーブルから1件のデータを取得
    $message = Message::find($id);
    
    // その番号の投稿が存在しなければ
    if($message === false){
        $errors = array();
        $errors[] = 'その番号の投稿はありません';
        // エラーメッセージをセッションに保存
        $_SESSION['errors'] = $errors;
        // リダイレクト
        header('Location: index.php');
        exit;
    }

    // ビューの表示
    include_once 'views/edit_view.php';
        
