

<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//1. POSTデータ取得
$name = $_POST['name'];
//$email = $_POST['email'];
//$content = $_POST['content'];
$name = $_POST['name'];
$name = $_POST['date'];
$name = $_POST['industry'];
$name = $_POST['annual'];
$name = $_POST['comfort'];
$name = $_POST['income'];


//2. DB接続
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db; charset=utf8; host=localhost', 'root', '');
} catch (PDOException $e) {

    exit('DBConnectError:' . $e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO gs_an_table(id, name, date, industry, annual, comfort, income)
                        VALUES(NULL, :name, date, :industry, :annual, :comfort, income, sysdate())');

//Integer（数値の場合 PDO::PARAM_INT)
//String（文字列の場合 PDO::PARAM_STR)
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
//$stmt->bindValue(':email', $email, PDO::PARAM_STR);
//$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':industry', $industry, PDO::PARAM_STR);
$stmt->bindValue(':annual', $annual, PDO::PARAM_STR);
$stmt->bindValue(':comfort', $comfort, PDO::PARAM_STR);
$stmt->bindValue(':income', $income, PDO::PARAM_STR);

$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('ErrorMessage:' . print_r($error, true));
} else {
  //成功した場合
  //echo 'test'
    header('Location: index.php');
}

/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！
 */

//1. POSTデータ取得
// $name = $_POST['name'];
// $email = $_POST['email'];
// $content = $_POST['content'];

//2. DB接続します
// try {
//   //ID:'root', Password: xamppは 空白 ''
//   $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
// } catch (PDOException $e) {
//   exit('DBConnectError:'.$e->getMessage());
// }

//３．データ登録SQL作成

// 1. SQL文を用意
// $stmt = $pdo->prepare("
//       INSERT INTO
//           gs_an_table(id, name, email, content, date)
//       VALUES
//       (NULL, :name, :email, :content, sysdate();)  ");

// //  2. バインド変数を用意
// // Integer 数値の場合 PDO::PARAM_INT
// // String文字列の場合 PDO::PARAM_STR

// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
// $stmt->bindValue(':email', $email, PDO::PARAM_STR);
// $stmt->bindValue(':content', $content, PDO::PARAM_STR);

// //  3. 実行
// $status = $stmt->execute();

//４．データ登録処理後
// if($status === false){
//   //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
//   $error = $stmt->errorInfo();
//   exit('ErrorMessage:'.$error[2]);
// }else{
  //５．index.phpへリダイレクト
    //成功した場合
    

// }
?>

Context | Editor contextselect.phpinsert.php
Phind
あなたのコードを見ると、いくつかの問題が見つかりました。

POSTデータの取得部分で、すべての変数が$nameに代入されています。これは間違いで、各変数はそれぞれのPOSTデータに対応するべきです。以下のように修正する必要があります。
$name = $_POST['name'];
$date = $_POST['date'];
$industry = $_POST['industry'];
$annual = $_POST['annual'];
$comfort = $_POST['comfort'];
$income = $_POST['income'];
SQLクエリの部分で、VALUESの部分に直接値を書いていますが、これはバインド変数を使用するべきです。以下のように修正する必要があります。
$stmt = $pdo->prepare('INSERT INTO gs_an_table(id, name, date, industry, annual, comfort, income)
                        VALUES(NULL, :name, :date, :industry, :annual, :comfort, :income, sysdate())');
これらの修正を行うことで、insert.phpが正常に動作するはずです。修正後のコードは以下のようになります。

<?php

//1. POSTデータ取得
$name = $_POST['name'];
$date = $_POST['date'];
$industry = $_POST['industry'];
$annual = $_POST['annual'];
$comfort = $_POST['comfort'];
$income = $_POST['income'];

//2. DB接続
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db; charset=utf8; host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO gs_an_table(id, name, date, industry, annual, comfort, income)
                        VALUES(NULL, :name, :date, :industry, :annual, :comfort, :income, sysdate())');

//Integer（数値の場合 PDO::PARAM_INT)
//String（文字列の場合 PDO::PARAM_STR)
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':industry', $industry, PDO::PARAM_STR);
$stmt->bindValue(':annual', $annual, PDO::PARAM_STR);
$stmt->bindValue(':comfort', $comfort, PDO::PARAM_STR);
$stmt->bindValue(':income', $income, PDO::PARAM_STR);

$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('ErrorMessage:' . print_r($error, true));
} else {
  //成功した場合
    header('Location: index.php');
}

?>

/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！
 */

//1. POSTデータ取得
// $name = $_POST['name'];
// $email = $_POST['email'];
// $content = $_POST['content'];

//2. DB接続します
// try {
//   //ID:'root', Password: xamppは 空白 ''
//   $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
// } catch (PDOException $e) {
//   exit('DBConnectError:'.$e->getMessage());
// }

//３．データ登録SQL作成

// 1. SQL文を用意
// $stmt = $pdo->prepare("
//       INSERT INTO
//           gs_an_table(id, name, email, content, date)
//       VALUES
//       (NULL, :name, :email, :content, sysdate();)  ");

// //  2. バインド変数を用意
// // Integer 数値の場合 PDO::PARAM_INT
// // String文字列の場合 PDO::PARAM_STR

// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
// $stmt->bindValue(':email', $email, PDO::PARAM_STR);
// $stmt->bindValue(':content', $content, PDO::PARAM_STR);

// //  3. 実行
// $status = $stmt->execute();

//４．データ登録処理後
// if($status === false){
//   //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
//   $error = $stmt->errorInfo();
//   exit('ErrorMessage:'.$error[2]);
// }else{
  //５．index.phpへリダイレクト
    //成功した場合
    

// }
?>
