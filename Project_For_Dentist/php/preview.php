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
<!-- Extracting all values from dentist_biodata table-->
<?php
/**Connectivity with database */
include 'db.php';

/**id value fetched from url */
$a=isset($_GET['id']) ? (int)$_GET['id']:null;
$sql="SELECT dentist_id,Name,Email_ID, qualification, phone_no, mob_no, address, cli_name, cli_description,
      user_image_name, clinic_image_name FROM dentist_biodata";
      
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        if($a==$row[0]){
          $UserName = $row[1];
          $UserEmail = $row[2];
          $qualifiaction = $row[3];
          $phone=$row[4];
          $mobile=$row[5];
          $address=$row[6];
          $cliname=$row[7];
          $description=$row[8];
          $UserImage=$row[9];
          $clinicImage=$row[10];
          break;
        }
      }
}   
?>

    <div class="header" id="topheader" >
        <nav class="navbar navbar-expand-lg">
            <div class="container text-uppercase p-2">											
                                                                            <!--Clinic Name-->
                <a class="navbar-brand font-weight-bold text-white" href="#"><?php echo "$cliname";?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">								<!-- (mr-auto to display right & ml-auto for left)-->
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">ABOUT</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.html">CONTACTS</a>
                    </li>
                    
                    </ul>   
                </div>
            </div>
        </nav>
        <div>
            <!--Clinic Image-->
            <?php
                echo "
                <img src='../images/$clinicImage' width='100%' height='400'>";
            ?>
        </div>

    </div>
    <hr>
    <!-- About US Card-->
    <div class='container'>
                    <div class='card' style="width: 100%; background-color:#FFFDD0;">
                        <div class='row row-content align-items-center'>
                            <div  class='col col-sm order-sm-first col-md'>
                                <div class='media'>
                                <!--Dentist Image-->
                                <?php
                                    echo "
                                    <img class='d-flex mr-3 img-thumbnail align-self-center' src='../images/5ff28b345302a6.80277806.jpg' alt='clinic image' width='200' height='150'>";
                                ?>    
                                    <div class='media-body' style='text-align: center;'>
                                    <!--Dentist Name-->
                                    <?php
                                        echo "<h2 style='font-family: Cambria, Cochin, Georgia, Times, serif'>Dr.$UserName(<span style='color: blue;'>$qualifiaction</span>)</h2>";
                                    ?>
                                    <hr>
                                    <!--Clinic Description-->
                                    <?php echo "<p style='font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
	                                        color: cornflowerblue;'>$description</p>";?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
    <hr>

    <div class="container">
        <h4 style="float=left;
                    font-size: 40px;
                    border-bottom: 6px solid #4caf50;
                    margin-bottom: 50px;
                    padding: 13px 0;
                    font-family: Cambria, Cochin, Georgia, Times, serif">Contact Us</h4>
            <div class="row text-center">
                <div class="col-md-4 col-sm-4 box1 pt-4" style="background: rgb(76, 175, 80, 0.6);">
                    <!--Phone Number-->
                    <?php
                        echo "
                        <a href='tel:$phone'><i class='fa fa-phone fa-3x'></i>
                        <h3>Phone</h3>
                        <p>$phone</p>";
                    ?>
                        </a>
                </div>
                <div class="col-md-4 col-sm-4 box2 pt-4" style="background: rgb(192, 192, 200, 0.6);">
                    <a href=""><i class="fa fa-home fa-3x"></i>
                    <h3>Address</h3>
                    <!--Address-->
                    <?php
                    echo "
                    <p> $address</p>";
                    ?>
                    </a>
                </div>
                <div class="col-md-4 col-sm-4 box3 pt-4" style="background: rgb(255, 0, 0, 0.6);">
                <!--UserEmail-->
                <?php
                    echo "
                    <a href='$UserEmail'><i class='fa fa-envelope fa-3x'></i>
                    <h3>E-mail</h3>
                    <p>$UserEmail</p>";
                ?>
                    </a>
                </div>
            </div>
            <hr>
          </div>

    <div class="container">
        <div class="row row-content" style="
                                            margin: 0px auto;
                                            padding: 50px 0px 50px 0px;
                                            border-bottom: 1px ridge;
                                            min-height: 400px;
                                        ">
            <div class="col-12">
                <h3 style="font-family: Cambria, Cochin, Georgia, Times, serif">Send us your Feedback</h3>
            </div>
                <div class="col-12 col-md-11">
                    <form>
                        <div class="form-group row">
                            <label for="firstname" class="col-md-2 col-form-label">First name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-md-2 col-form-label">last name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="telnum" class="col-12 col-md-2 col-form-label">Contact Tel.</label>
                            <div class="col-5 col-md-3">
                                <input type="tel" class="form-control" id="areacode" name="areacode" placeholder="Area code">
                            </div>
                            <div class="col-7 col-md-7">
                                <input type="tel" class="form-control" id="telnum" name="telnum" placeholder="Tel. number">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="emailid" class="col-md-2 col-form-label">Email</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Email">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="approve" id="approve" value="">
                                    <label class="form-check-label" for="approve">
                                        <strong>May we contact you?</strong>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-md-3 offset-md-1">
                                <select class="form-control">
                                    <option>Tel.</option>
                                    <option>Email</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="feedback" class="col-md-2 col-form-label">Your<br> Feed back</label>
                            <div class="col-md-10">
                                <textarea type="form-control" class="form-control" id="feedback" name="feedback" rows="12"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="offset-md-2 col-md-10">
                                <button type="submit" class="btn btn-primary">
                                    Send Feedback
                                </button>
                            </div>
                        
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md">
                </div>
        </div>

    </div>

    <hr>
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
                        <p>?? Copyright 2020 XYZ</p>
                    </div>
               </div>
            </div>
        </footer>

</body>
</html>