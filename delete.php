<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if($_SESSION['user_number'] != null)
{
        echo "<form name=\"form\" method=\"post\" action=\"delete_finish.php\">";
        echo "要刪除的帳號：<input type=\"text\" name=\"id\" /> <br>";
        echo "<input type=\"submit\" name=\"button\" value=\"刪除\" />";
        echo "</form>";
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.html>';
}
?>