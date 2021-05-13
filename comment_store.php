<?php
    // コントローラ
    
    // 外部ファイルの読みこみ
    require_once 'models/Comment.php';
    // セッション開始
    session_start();
    
    // POST通信ならば（= コメント投稿ボタンが押された時）
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        // 入力値を取得
        $id = $_POST['id'];
        $name = $_POST['name'];
        $content = $_POST['content'];
        
        // 新規コメントインスタンス生成
        $comment = new Comment($id, $name, $content);
        
        // 入力チェック
        $errors = $comment->validate();
        
        // 入力エラーが1つもなければ
        if(count($errors) === 0){
            // データベースにコメントを保存
            $comment->save();
            // セッションにflash_messageを保存
            $_SESSION['flash_message'] = 'コメントを投稿しました';
        }else{
            // セッションにerrorsを保存
            $_SESSION['errors'] = $errors;
        }
        
        // リダイレクト
        header('Location: show.php?id=' . $id);
        exit;
    
    }else{
        // GET通信による不正アクセス
        $errors = array();
        $errors[] = '不正アクセスです';
        // セッションにエラーメッセージを保存
        $_SESSION['errors'] = $errors;
        // リダイレクト
        header('Location: index.php');
        exit;
    }
    