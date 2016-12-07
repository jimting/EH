<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
echo '<a href="logout.php">登出</a>  <br><br>';

//此判斷為判定觀看此頁有沒有權限
//說不定是路人或不相關的使用者
//因此要給予排除
if($_SESSION['user_number'] != null)
{
        echo '<a href="register.html">新增</a>    ';
        echo '<a href="update.php">修改</a>    ';
        echo '<a href="delete.php">刪除</a>  <br><br>';
    
        //將資料庫裡的所有會員資料顯示在畫面上
        $sql = "SELECT * FROM user";
        $result = mysql_query($sql);
        while($row = mysql_fetch_row($result))
        {
                 echo "$row[0] : 學號：$row[1], " . 
                 "暱稱：$row[3], Email：$row[4], 連絡電話 : $row[5],所屬單位：$row[6], 等級：$row[7]<br>";
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
}
?>