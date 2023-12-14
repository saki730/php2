<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="post" action="insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>フリーアンケート</legend>
                <label>名前：<input type="text" name="name"></label><br>
                <label>日時：<input type="datetime" name="date"></label><br>
                <label>業界：<input type="text" name="industry"></label><br>
                <label>年次：<input type="text" name="annual"></label><br>
                <label>働きやすさ：<input type="text" name="comfort"></label><br>
                <label>年収：<input type="text" name="income"></label><br>
                <label><textArea name="content" rows="4" cols="40"></textArea></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>
