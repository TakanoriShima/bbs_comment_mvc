<?php
// モデル

// 外部ファイルの読みこみ
require_once 'models/Model.php';
require_once 'models/Comment.php';

// Messageモデル
class Message extends Model{
    
    // プロパティ
    public $id;
    public $name;
    public $title;
    public $body;
    public $image;
    public $password;
    public $created_at;
    
    // コンストラクタ
    public function __construct($name="", $title="", $body="", $image="", $password=""){
        $this->name = $name;
        $this->title = $title;
        $this->body = $body;
        $this->image = $image;
        $this->password = $password;
    }
    
    // 全投稿情報を取得するメソッド
    public static function all(){
        try{
            $pdo = self::get_connection();
            $stmt = $pdo->query('SELECT * FROM messages ORDER BY id DESC');
            // フェッチの結果を、messageクラスのインスタンスにマッピングする
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Message');
            $messages = $stmt->fetchAll();
            self::close_connection($pdo, $stmp);
            // メッセージクラスのインスタンスの配列を返す
            return $messages;
        }catch(PDOException $e){
            return array();
        }
    }
    
    // ファイルをアップロードするメソッド
    public static function upload(){
        // ファイルを選択していれば
        if (!empty($_FILES['image']['name'])) {
            
            // ファイル名をユニーク化
            $image = uniqid(mt_rand(), true); 
            // アップロードされたファイルの拡張子を取得
            $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
            $file = IMAGE_DIR . $image;
        
            // uploadディレクトリにファイル保存
            move_uploaded_file($_FILES['image']['tmp_name'], $file);
            
            return $image;
        }else{
            return "";
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
        // タイトルが入力されていなければ
        if($this->title === ''){
            $errors[] = 'タイトルを入力してください';
        }
        // 内容が入力されていなければ
        if($this->body === ''){
            $errors[] = '内容を入力してください';
        }
        // 画像が選択されていなければ
        if($this->image === ''){
            $errors[] = '画像を選択してください';
        }
        // パスワードが入力されていなければ
        if($this->password === ''){
            $errors[] = 'パスワードを入力してください';
        }
        
        return $errors;
    }
    
    // データを1件登録するメソッド
    public function save(){
        try{
            $pdo = self::get_connection();
            $stmt = $pdo -> prepare("INSERT INTO messages (name, title, body, image, password) VALUES (:name, :title, :body, :image, :password)");
            // バインド処理
            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindParam(':body', $this->body, PDO::PARAM_STR);
            $stmt->bindParam(':image', $this->image, PDO::PARAM_STR);
            $stmt->bindParam(':password', $this->password, PDO::PARAM_STR);
            $stmt->execute();
            self::close_connection($pdo, $stmp);
        }catch(PDOException $e){
            return null;
        }
    }
    
    // id値からデータを抜き出すメソッド
    public static function find($id){
        try{
            $pdo = self::get_connection();
            $stmt = $pdo->prepare('SELECT * FROM messages WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Message');
            $message = $stmt->fetch();
            self::close_connection($pdo, $stmp);
            // メッセージクラスのインスタンスを返す
            return $message;
        }catch(PDOException $e){
            return null;
        }
    }
    
    // データを更新するメソッド
    public function update(){
        try{
            
            // unlink(IMAGE_DIR . $this->image);
            
            $pdo = self::get_connection();
            // $image = self::get_image_name_by_id($this->id);
            $stmt = $pdo->prepare('UPDATE messages SET name=:name, title=:title, body=:body, image=:image WHERE id = :id');
                            
            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindParam(':body', $this->body, PDO::PARAM_STR);
            $stmt->bindParam(':image', $this->image, PDO::PARAM_STR);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            
            $stmt->execute();
            self::close_connection($pdo, $stmp);

        }catch(PDOException $e){
            return null;
        }
    }
    
    // データを削除するメソッド
    public static function destroy($id){
        try{
            
            $image = self::get_image_name_by_id($id);
            
            $pdo = self::get_connection();
            
            $stmt = $pdo->prepare('DELETE FROM messages WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            $stmt->execute();
            self::close_connection($pdo, $stmp);
            
            unlink(IMAGE_DIR . $image);
            
        }catch(PDOException $e){
            return null;
        }

    }
    
    
    // // 画像ファイル名を取得するメソッド（uploadフォルダ内のファイルを物理削除するため）
    public static function get_image_name_by_id($id){
        try{
            $pdo = self::get_connection();
            $stmt = $pdo->prepare('SELECT * FROM messages WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Message');
            $message = $stmt->fetch();
    
            self::close_connection($pdo, $stmp);
            
            return $message->image;

        }catch(PDOException $e){
            return "";
        }
    }
    
    // その投稿に紐づいたコメント一覧を取得
    public function comments(){
        try{
            $pdo = self::get_connection();
            // SELECT文実行準備
            $stmt = $pdo->prepare('SELECT * FROM comments WHERE message_id=:message_id ORDER BY id DESC');
            // バインド処理
            $stmt->bindParam(':message_id', $this->id, PDO::PARAM_INT);
            // SELECT文本番実行
            $stmt->execute();
            // フェッチの結果を、Commentクラスのインスタンス配列にマッピングする
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Comment');
            $comments = $stmt->fetchAll();
            self::close_connection($pdo, $stmp);
            // Commentsクラスのインスタンスの配列を返す
            return $comments;
            
        }catch(PDOException $e){
            return array();
        }
    }
    
}
