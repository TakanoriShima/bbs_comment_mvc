<?php
// データベース接続情報
// 必要に応じて書き換えてください
define("DB_HOST", "localhost"); // データベースサーバ名
define("DB_NAME", "bbs"); // データベース名
define("DSN", "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME); // ここは書き換えないでください
define("DB_USERNAME", "root"); // ユーザー名
define("DB_PASSWORD", ""); // パスワード
define("IMAGE_DIR", "upload/"); // 画像アップロード用フォルダ名
