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
if(isset($_POST['submit'])){
    // print_r($_POST);
    $i_id = $man->make_invitation($_POST['msg']);
    // print_r($i_id);
    if($i_id != -1){
        if($_POST['ids']==''){
            $sql = "SELECT id FROM users WHERE type=1;";
            $res = mysqli_query($conn,$sql);
            $arr = mysqli_fetch_all($res,MYSQLI_NUM)[0];
            // print_r($arr);
        }else{
            $arr = explode(',',$_POST['ids']);
        }
        $man->send_invitation($arr,$i_id);
    }else{
        header("Location: send_inv.php?error");
    }
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
            <form action="index.php" method="get" >
                <input type="submit" value="Home" id="button1">
            </form>
        </div>
        <div class="forma">
            <table>
                <tr>
                    <th>id</th>
                    <th>fname</th>
                    <th>lname</th>
                </tr>
                <?php
                $sql = "SELECT id,fname,lname FROM users WHERE type=1;";
                $res = mysqli_query($conn,$sql);
                if(!empty($res) && $res->num_rows > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<tr> <td>".$row['id']."</td><td>".$row['fname']."</td><td>".$row['lname']."</td></tr>";
                    }
                }else{
                    echo "<tr><td>No Parents</td></tr>";
                }
                ?>
            </table>
            <h1>Schedule meeting</h1>
            <br>
            <form action="" method="post">
                Invitation's Message<input type="text" name="msg" required><br>
                Parent's IDs (comma seperated) <input type="text" name="ids"><br>
                <p>leave empty to select all parents</p>
                <input type="submit" name="submit" id="button">
            </form>
        </div>
    </body>
</html>