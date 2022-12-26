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
    if($man->approve_grades($_POST['id'])){
        header('Location: approve_grades.php?success');
    }else{
        header('Location: approve_grades.php?error');
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
                    <th>student_id</th>
                    <th>course_name</th>
                    <th>grade</th>
                    <th>approved</th>
                </tr>
                <?php
                $sql = "SELECT * FROM grades;";
                $res = mysqli_query($conn,$sql);
                if(!empty($res) && $res->num_rows > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<tr> <td>".$row['id']."</td><td>".$row['c_id']."</td><td>".$row['course_name']."</td><td>".$row['grade']."</td><td>";
                        if($row['approved']=='0'){
                            echo "no";
                        }else{
                            echo "yes";
                        }
                        echo "</td></tr>";
                    }
                }else{
                    echo "<tr><td>No Grades</td></tr>";
                }
                ?>
            </table>
            <h1>Approve Student Grade</h1>
            <br>
            <form action="" method="post">
                grade ID<input type="text" name="id" required><br>
                <input type="submit" name="submit" id="button">
            </form>
        </div>
    </body>
</html>