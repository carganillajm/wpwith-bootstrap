<?php
    $con = mysqli_connect("localhost","root","");
    if(!$con){
        die('could not connect'.mysqli_error());
    }
    mysqli_select_db($con,"db_wpwith_bs");

    $sql = $con->query('SELECT * FROM  tblinfo');

    $status = '';
    $msg = '';

    if(isset($_GET['status'])){
        $status = $_GET['status'];
    }

    if($status == "add"){
        $firstname = $_POST['fname'];
        $middlename = $_POST['mname'];
        $lastname = $_POST['lname'];

        $add = $con->query("INSERT INTO tblinfo values (null,'$firstname','$middlename','$lastname')");
        if(!$add){
            die('error'. mysqli_error());
        }else{
            header("location:index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">JM Carganilla</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="about.php">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
        </ul>
    </div>
</nav>
  
<div class="container">
    <h3>Add Information</h3>

    <form method="POST" action="index.php?status=add">
        <table class="table table-bordered">
            <tr>
                <td>
                    <label for="fname">
                        Firstname
                    </label> 
                </td>
                <td>
                    <input type="text" name="fname">  
                </td>
            </tr>
            <tr>
                <td>
                    <label for="mname">
                        Middlename
                    </label>
                </td>
                <td> 
                    <input type="text" name="mname">  
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lname">
                        Lastname
                    </label>
                </td>
                <td>
                    <input type="text" name="lname">   
                </td>
            </tr>
        </table>
        <input type="submit" class="btn  btn-success" value="Submit" name="btn_add">    
    </form>
    <hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Firstname</th>
                <th>Middlename</th>
                <th>Lastname</th>
                <th>Status</th>
            </tr>    
        </thead>
        <tbody>
            <?php foreach ($sql as $row) { ?>
            <tr class="info ">
                <td><?php echo $row['fname'] ?></td>
                <td><?php echo $row['mname'] ?></td>
                <td><?php echo $row['lname'] ?></td>
                <td><a href="index.php?status=edit" role="button" class="btn btn-info">Edit</a>
                <a href="index.php?status=delete" role="button" class="btn btn-danger">Delete</a></td>
            </tr> 
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
