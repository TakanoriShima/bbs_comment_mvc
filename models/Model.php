<?php
// 外部ファイルの読み込み
require_once 'config/const.php';

// モデルのスーパークラス
class Model{
    
    // データベースと接続を行うメソッド
    public static function get_connection(){
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // 失敗したら例外を投げる
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,   //デフォルトのフェッチモードはクラス
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',   //MySQL サーバーへの接続時に実行するコマンド
        );
        try{
            $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $options);
            return $pdo;
        }catch(PDOException $e){
            return null;
        }
    }
    
    // データベースとの切断を行うメソッド
    public static function close_connection($pdo, $stmp){
        try{
            $pdo = null;
            $stmp = null;
        }catch(PDOException $e){
            return null;
        }    
    }
    
}
