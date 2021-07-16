<!DOCTYPE html>
<html>
<head>
<title>Dentist Workshop</title>

<!-- viewport-->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- this makes our web page responsive (viewport)-->
<meta http-equiv="x-ua-compatible" content="ie=edge">

<!-- bootstrap-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="../css/dentist_main_page.css">


<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:900|Ubuntu&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

<!-- font awesome -->
<script src="https://kit.fontawesome.com/382a0f27c6.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body style="background-image: url(../images/DentistM.jpg);">
<?php
/**id value fetched from url */
$a=isset($_GET['id']) ? (int)$_GET['id']:null;

/**if not logged in You can't open this page */
if($a===null)
{
    // not logged in
    header('Location: ../index.php');
    exit();
}

include 'db.php';

    $sql = 'SELECT id,Name, Email_ID FROM dentist_login';
        if ($result = mysqli_query($conn, $sql)) {
            while ($row = mysqli_fetch_row($result)) {
                if($row[0]==$a){
                    $name = $row[1];
                    $DEmail = $row[2];
                }
            }
        }

?>
<nav class="navbar navbar-expand-lg bg-primary fixed-top" style="">
            <div class="container text-uppercase p-2">											
            
                <a class="navbar-brand font-weight-bold text-white" href="#">Hello <?php echo $name;?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">								<!-- (mr-auto to display right & ml-auto for left)-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        <?php echo $DEmail;?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../index.php"><span style="color: black;">Log Out</span></a>
                        </div>
                   </li>
                    </ul>   
                </div>
            </div>
</nav>
    <div id="login">
        <h4 style="font-family: Cambria, Cochin, Georgia, Times, serif">Hello <?php echo "$name"; ?></h4>
           

            <?php
            echo "
            <a href='edit_profile.php?id=".$a."'>
            <div class='group'> <input type='submit' class='button' value='Edit Profile' name='mrsignup'> </div></a><br>
            <hr><br>
            <a href='shop_list.php?id=".$a."'>
            <div class='group'> <input type='submit' class='button' value='Buy Product' name='mrsignup'> </div></a>
            ";
            ?>
    </div>
</body>
</html>