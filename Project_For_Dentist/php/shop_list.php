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
    <link rel="stylesheet" href="../css/preview.css">


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
<body>
<!-- Taking Name and Email from Database -->
<?php
include 'db.php';
/**db.php used for connectivity */
$a=isset($_GET['id']) ? (int)$_GET['id']:null;

/**if not logged in You can't open this page */
if($a===null)
{
    // not logged in
    header('Location: ../index.php');
    exit();
}

$sql = 'SELECT id, Name, Email_ID FROM dentist_login';
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        if($a==$row[0]){
            $DName = $row[1];
            $DEmail = $row[2];
        }
    }
}
?>

<div class="header" id="topheader" >
    <nav class="navbar navbar-expand-lg bg-primary fixed-top">
                <div class="container text-uppercase p-2">											
                                                                                <!--DName fetched from Dentist Login-->
                    <a class="navbar-brand font-weight-bold text-white" href="#">Hello <?php echo $DName;?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">								
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                            <!--DEmail fetched from Dentist Login-->
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
    <div>
        <img src='../images/dentist.jpg' width='100%' height='400'>";
    </div>
    <div class="container">
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><?php echo "<a href='dentist_main_page.php?id=".$a."'>Home</a>";?></li>
              <li class="breadcrumb-item active" aria-current="page">Shop's List</li>
            </ol>
        </nav>
    </div>
    <?php
    $sql1 = "SELECT manufacturer_id, phone_no, address, shop_name, shop_image_name FROM manufacturer_biodata";
    ?>
    <div class='container'>
    <!-- Display Shop List-->
    <?php
    if ($result = mysqli_query($conn, $sql1)) {
        while ($row = mysqli_fetch_row($result)) {
            echo "
                    <hr>
                    <div class='card' style='width: 100%; background-color:#FFFDD0;'>
                        <div class='row row-content align-items-center'>
                            <div class='col-12 col-sm-4 order-sm-last col-md-3'>
                                <div class='pt-4 text-center'>
                                    <a href='tel:$row[1]'><i class='fa fa-phone fa-3x'></i>
                                    <h3>Phone</h3>
                                    <p>$row[1]</p>
                                    </a>
                                </div>  
                            </div>
                            <div  class='col col-sm order-sm-first col-md'>

                                <div class='media'>
                                    <img class='d-flex mr-3 img-thumbnail align-self-center' src='../images/$row[4]' alt='clinic image' width='200' height='150'>
                                   
                                    <div class='media-body' style='text-align: center;'>
                                        <h2>$row[3]</h2>
                                    <hr>
                                    <p class=' d-none d-sm-block'>$row[2]</p>
                                    <a href='buy_product.php?id=".$row[0]."&id2=".$a."'
                                        <button type='submit' style=' background-color: green;
                                                                    color: white;
                                                                    padding: 5px 15px;
                                                                    margin: 12px 0;'>Give Your Order</button>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
        }
    }
    ?>
    </div>
</div>
<hr>
    <!-- Footer Section-->
    <footer class="footer" style="
                                background-color: #9575CD;
                                margin: 0px auto;
                                padding: 20px 0px 20px 0px;
                                ">
            <div class="container">
                <div class="row">             
                    <div class="col-4 offset-1 col-sm-2">
                        <h5>Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" style="color: black;">Home</a></li>
                            <li><a href="aboutus.html" style="color: black;">About</a></li>
                            <li><a href="#" style="color: black;">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-7 col-sm-5">
                        <h5>Our Address</h5>
                        <address style="
                                        font-size: 100%;
                                        margin: 0px;
                                        color: #0f0f0f;
                                    ">
                          121, PCCOE<br>
                          Pimpri-Chinchwad, Pune<br>
                          Maharashtra<br>
                          <i class="fa fa-phone fa-lg"></i> +852 1234 5678<br>
                          <i class="fa fa-fax fa-lg"></i>+852 8765 4321<br>
                          <i class="fa fa-envelope fa-lg"></i><a href="mailto:pccoe@college.net">pccoe@college.net</a>
                       </address>
                    </div>
                    <div class="col-12 col-sm-4 align-self-center">
                        
                        <div class="text-center">
                             <a class="btn btn-social-icon btn-google" href="http://google.com/+"><i class="fa fa-google-plus"></i></a>
                            <a class="btn btn-social-icon btn-facebook" href="http://www.facebook.com/profile.php?id="><i class="fa fa-facebook"></i></a>
                            <a class="btn btn-social-icon btn-linkedin" href="http://www.linkedin.com/in/"><i class="fa fa-linkedin"></i></a>
                            <a class="btn btn-social-icon btn-twitter" href="http://twitter.com/"><i class="fa fa-twitter"></i></a>
                            <a class="btn btn-social-icon btn-google" href="http://youtube.com/"><i class="fa fa-youtube"></i></a>
                            <a class="btn btn-social-icon" href="mailto:"><i class="fa fa-envelope-o"></i></a>
                        </div>
                    </div>
               </div>
               <div class="row justify-content-center">             
                    <div class="col-auto">
                        <p>© Copyright 2020 XYZ</p>
                    </div>
               </div>
            </div>
        </footer>
</body>
</html>