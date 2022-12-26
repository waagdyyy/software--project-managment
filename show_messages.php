<?php
require_once("../classes/conn.php");
require_once("../classes/manager.php");
session_start();
if(!isset($_SESSION['user'])){
    header('Location: ../index.php');
}else if($_SESSION['type']!='0'){
    header('Location: ../index.php');
}
$man = unserialize($_SESSION['user']);
$man->conn = $conn;
?>
<html>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DynaPuff&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Index.css">
    <body>
        <div class="hzh">
            <h1 data-text="PUZZLE">PUZZLE</h1>
            <form action="index.php" method="get" >
                <input type="submit" value="Home" id="button1">
            </form>
        </div>
        <div class="forma">
            <table border="2px">
                <tr>
                    <th>ID</th>
                    <th>fname</th>
                    <th>lname</th>
                    <th>email</th>
                    <th>type</th>
                </tr>
                <?php
                $sql = "SELECT * FROM users;";
                $res = mysqli_query($conn,$sql);
                if(!empty($res) && $res->num_rows > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<tr><td>".$row['id'],"</td><td>".$row['fname']."</td><td>".$row['lname']."</td><td>".$row['email']."</td><td>";
                        if($row['type']=='0'){
                            echo "Manager";
                        }else if($row['type']=='1'){
                            echo "Parent";
                        }else{
                            echo "Teacher";
                        }
                        echo "</td></tr>";
                    }
                }else{
                    echo "<tr><td>No Users</td></tr>";
                }
                ?>
            </table>
            <table border="2px">
                <tr>
                    <th>Message ID</th>
                    <th>from_id</th>
                    <th>to_id</th>
                    <th>text</th>
                    <th>time</th>
                </tr>
                <?php
                if($_GET['from'] != '' && $_GET['to'] == ''){
                    $res = $man->show_messages_from($_GET['from']);
                }else if($_GET['from'] == '' && $_GET['to'] != ''){
                    $res = $man->show_messages_to($_GET['to']);
                }else if($_GET['from'] != '' && $_GET['to'] != ''){
                    $res = $man->show_messages($_GET['from'],$_GET['to']);
                }else{
                    $sql = "SELECT * FROM messages ORDER BY time;";
                    $res = mysqli_query($conn,$sql);
                }
                if(!empty($res) && $res->num_rows > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<tr><td>".$row['id']."</td><td>".$row['from_user']."</td><td>".$row['to_user']."</td><td>".$row['text']."</td><td>".$row['time']."</td></tr>";
                    }
                }else{
                    echo "<tr><td>no Messages</td></tr>";
                }
                ?>
            </table>
            <h1>Show users Messages</h1>
            <br>
            <form action="" method="GET">
                From ID<input type="text" name="from"><br>
                to ID<input type="text" name="to"><br>
                <input type="submit" name="submit" id="button">
            </form>
        </div>
    </body>
</html>