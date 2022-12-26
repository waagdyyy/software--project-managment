<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: ../index.php');
}else if($_SESSION['type']!='0'){
    header('Location: ../index.php');
}
?>
<html>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DynaPuff&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Index.css">
    <body>
        <div class="hzh">
            <h1 data-text="PUZZLE">PUZZLE</h1>
            <form action="../logout.php" method="get" >
                <input type="submit" value="Logout" id="button1">
            </form>
            <form action="show_messages.php" method="get" >
                <input type="text" name="from" value="" hidden>
                <input type="text" name="to" value="" hidden>
                <input type="submit" value="Show-Messages" id="button1">
            </form>
            <form action="send_inv.php" method="get" >
                <input type="submit" value="Send-Invitations" id="button1">
            </form>
            <form action="approve_grades.php" method="get" >
                <input type="submit" value="Approve-Grades" id="button1">
            </form>
        </div>
    </body>
</html>