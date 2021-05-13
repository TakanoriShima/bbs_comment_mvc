<?php
    // コントローラ
    
    // セッション開始
    session_start();
    
    // POST通信ならば（= 新規投稿ボタンが押された時）
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        // 外部ファイルの読み込み
        require_once 'models/Message.php';

        // フォームからの入力値を取得
        $name = $_POST['name'];
        $title = $_POST['title'];
        $body = $_POST['body'];
        $password = $_POST['password'];
        
        // 画像ファイルの物理的アップロード処理
        $image = Message::upload();
        
        // 新しいメッセージインスタンスを生成
        $message = new Message($name, $title, $body, $image, $password);

        // 入力チェック
        $errors = $message->validate();

        // 入力エラーが一件もなければ
        if(count($errors) === 0){
            
            // データベースにデータを1件保存
            $message->save();
            
            // セッションにフラッシュメッセージを保存        
            $_SESSION['flash_message'] = "投稿が成功しました。";
            
            // リダイレクト
            header('Location: index.php');
            exit;
            
        }else{ // 1つでも入力漏れがあれば
            //  セッションにエラーメッセージを保存     
            $_SESSION['errors'] = $errors;
            // リダイレクト
            header('Location: create.php');
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
?>