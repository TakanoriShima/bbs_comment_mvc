<?php
// モデル

// 外部ファイルの読みこみ
require_once 'models/Model.php';

class Comment extends Model{
    
    public $id;
    public $message_id;
    public $name;
    public $content;
    public $created_at;
    
    public function __construct($message_id="", $name="", $content=""){
        $this->message_id = $message_id;
        $this->name = $name;
        $this->content = $content;
    }

    // コメントデータを1件登録するメソッド
    public function save(){
        try{
            $pdo = self::get_connection();
            $stmt = $pdo -> prepare("INSERT INTO comments (message_id, name, content) VALUES (:message_id, :name, :content)");
            // バインド処理
            $stmt->bindParam(':message_id', $this->message_id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindParam(':content', $this->content, PDO::PARAM_STR);
            $stmt->execute();
            self::close_connection($pdo, $stmp);
        }catch(PDOException $e){
            return null;
        }
    }
    
    // 入力チェック
    public function validate(){
        // 空のエラー配列作成
        $errors = array();
        
        // 名前が入力されていなければ
        if($this->name === ''){
            $errors[] = '名前を入力してください';
        }
        // 内容が入力されていなければ
        if($this->content === ''){
            $errors[] = '内容を入力してください';
        }
        
        return $errors;
    }
}
