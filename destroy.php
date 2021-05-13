<?php
    // コントローラ
    
    // 外部ファイルの読みこみ
    require_once 'models/Message.php';
    // セッション開始
    session_start();
    
    // POST通信ならば（= 削除ボタンが押された時）
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        // 削除する投稿番号を取得
        $id = $_POST['id'];
        
        // id値からmessageインスタンス取得
        $message = Message::find($id); 
        
        // パスワードを取得
        $password = $_POST['password'];
        
        // パスワードがあっていれば
        if($password === $message->password){
            // モデルを使ってid番目の投稿を削除
            Message::destroy($id);
        
            // セッションにflash_messageをセット            
            $_SESSION['flash_message'] = "投稿が削除されました。";
            
            // リダイレクト
            header('Location: index.php');
            exit;
        }else{ // パスワードが間違っていれば
            $errors = array();
            $errors[] = 'パスワードが間違っています';
            // エラーメッセエージをセッションにセット
            $_SESSION['errors'] = $errors;
            // リダイレクト
            header('Location: show.php?id=' . $id);
            exit;
        }
        
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
    
