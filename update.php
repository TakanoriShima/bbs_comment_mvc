<?php
    // コントローラ
    
    // 外部ファイルの読み込み
    require_once 'models/Message.php';
    require_once 'models/Comment.php';
    
    // セッション開始
    session_start();
    
    // POST通信ならば（=更新ボタンが押された時）
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
        // id値を取得
        $id = $_POST['id'];
        // id値からインスタンス生成
        $message = Message::find($id);
        
        // 入力されたパスワード取得
        $password = $_POST['password'];
        
        // フラッシュメッセージをセッションから取得し、セッション情報を削除
        $flash_message = $_SESSION['flash_message'];
        $_SESSION['flash_message'] = null;
    
        // パスワードが正しいのならば
        if($password === $message->password){
            
            // 入力された値を取得
            $name = $_POST['name'];
            $title = $_POST['title'];
            $body = $_POST['body'];
            
            // 画像をアップロードし、リネームした画像ファイル名を取得
            // アプロードに失敗したら空文字を取得
            $image = Message::upload();
    
            // 画像が選択されていないならば、画像ファイル名には現在の名前をセット
            if($image === ''){
                $image = $message->image;
            }
        
            // インスタンス情報を更新
            $message->name = $name;
            $message->title = $title;
            $message->body = $body;
            $message->image = $image;
            $message->password = $password;
            
            // 入力チェック
            $errors = $message->validate();
            
            // 入力エラーが一件もなければ
            if(count($errors) === 0){
                
                //データベース更新処理
                $message->update();
                
                // セッションにflash_messageをセット 
                $_SESSION['flash_message'] = $message->id . "番目の投稿が更新されました。";
                
                // リダイレクト
                header('Location: show.php?id=' . $id);
                exit;
                
            }else{
                // セッションにerrorsを保存
                $_SESSION['errors'] = $errors;
                
                // リダイレクト
                header('Location: edit.php?id=' . $id);
                exit;
            }
                    
      
        }else{
    
            // セッションにerrorsを保存
            $errors = array();
            $errors[] = 'パスワードが間違えています。';
            $_SESSION['errors'] = $errors;
            
            // リダイレクト
            header('Location: edit.php?id=' . $id);
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

