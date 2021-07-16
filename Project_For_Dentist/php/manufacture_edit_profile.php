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
  <link rel="stylesheet" href="../css/edit_profile.css">


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
<?php
/**Database connectivity */
include 'db.php';

/**id value fetched from url */
$a=isset($_GET['id']) ? (int)$_GET['id']:null;

/**if not logged in You can't open this page */
if($a===null)
{
    // not logged in
    header('Location: ../index.php');
    exit();
}

/**Fetching value from manufacturer biodata */
$sql="SELECT manufacturer_id,Name,Email_ID,shop_name, shop_image_name FROM manufacturer_biodata";
$valid=0;
$UserName = null;
$UserEmail = null;
$ShopName = null;
if ($result = mysqli_query($conn, $sql)) {
  while ($row = mysqli_fetch_row($result)) {
      if($a==$row[0]){
        $UserName = $row[1];
        $UserEmail = $row[2];
        $ShopName = $row[3];
        $ShopImage = $row[4];
        $valid=1;
        break;
      }
    }
    
  if($valid===0){
    $ShopImage = null;
    $sql1="INSERT INTO manufacturer_biodata(manufacturer_id) VALUES ($a)";
    mysqli_query($conn, $sql1);
    
  }
}
/* Function For Uploading Shop Image*/
function UploadFile(array $file, string $Name, int $cnt,$con){ 
  /**All values stored in array are stored in variables for better view to programmer*/                      
  $image = $file['name'];
  $fileType = $file['type'];
  $fileTmpName = $file['tmp_name'];
  $fileError = $file['error'];
  $fileSize = $file['size'];

  /**Here file extension is taken */                                            
  $fileExt = explode('.', $image);
  $fileActualExt = strtolower(end($fileExt));

  /**limitation to extension */                                       
  $allowed = array('jpg', 'jpeg', 'png', 'jfif');
  if(in_array($fileActualExt, $allowed)){
      if($fileError === 0){
          if($fileSize < 1000000){
              $fileNameNew = uniqid('', true).".".$fileActualExt;
              $fileDestination = '../images/'.$fileNameNew;
              if(move_uploaded_file($fileTmpName, $fileDestination)){
                  $sql = "UPDATE manufacturer_biodata SET $Name='$fileNameNew' WHERE manufacturer_id=$cnt";
                  if(mysqli_query($con, $sql)){
                    echo "<script type=\"text/javascript\">
                    window.location.href = '/Project_For_Dentist/php/manufacture_edit_profile.php?id=".$cnt."';
                    </script>";
                  }                   
              }else{
                  echo "<script type=\"text/javascript\">
                              window.alert('Something Went wrong while transferring file ');
                      </script>";
              }
          } else{
              echo "<script type=\"text/javascript\">
                              window.alert('File size is large ');
                      </script>";                             
          }
      }  else{
          echo "<script type=\"text/javascript\">
                      window.alert('There was an error uploading file');
              </script>"; 
      }
  } else{
      echo "<script type=\"text/javascript\">
                      window.alert('Upload image of type .jpg, .jpeg, .png, .jfif');
              </script>";
  }

}

?>
          <nav class="navbar navbar-expand-lg bg-primary fixed-top">
            <div class="container text-uppercase p-2">											
            
                <a class="navbar-brand font-weight-bold text-white" href="#">Hello <?php echo $UserName;?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">								<!-- (mr-auto to display right & ml-auto for left)-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                            <?php echo $UserEmail;?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../index.php"><span style="color: black;">Log Out</span></a>       
                            </div>
                      </li>
                    </ul>   
                </div>
            </div>
          </nav>
        <div class="container">
          <div class="main-body">
          <div><hr><hr></div>
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="main-breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                  </ol>
                </nav>
                <!-- /Breadcrumb -->
                <hr>
                <div class="row gutters-sm">
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                        <?php
                              /**if image is not uploaded then by default image is shown */ 
                              if($ShopImage == null){
                                echo "<img src='../images/HospitalLogo.jpg' alt='Admin' width='150'>";  
                              } 
                              else{
                                echo "<img src='../images/$ShopImage' alt='Admin'  width='150'>";
                              }
                          
                          ?>
                          <div class="mt-3">
                          <?php
                            /**if data is not filled then by default shop name is kept */
                            if($ShopName == null){ echo " <h4>Shop Name</h4>";}
                            else{echo "<h4 style='font-family: Cambria, Cochin, Georgia, Times, serif'>$ShopName</h4>";}
                            ?>
                            <h6>Upload a clinic photo...</h6>
                            <form method="POST" enctype="multipart/form-data"><!--enctype: encodes the data -->
                            <input type="file" class="text-center center-block file-upload" name="file1">
                            <button type="submit" name="upload2" style=" background-color: green;
                                                                          color: white;
                                                                          padding: 5px 15px;
                                                                          margin: 12px 0;">POST</button> 
                            </form>
                            <!--Uploading Image function is called and parameters are
                            1: array which contains data of the image(image: name,type, temperory name, error information, size)
                            2: manufacturer_biodata column name
                            3: id of the manufacturer
                            4: connectivity variable with database
                            -->
                            <?php 
                              if(isset($_POST['upload2'])){
                                  UploadFile($_FILES['file1'],'shop_image_name',$a, $conn);
                              }
                            ?> 
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="col-md-8">
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0" style="font-family: Cambria, Cochin, Georgia, Times, serif">Full Name</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            <form method="POST">
                            <input type="text" placeholder="Full Name" id="t1" name="name">
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0" style="font-family: Cambria, Cochin, Georgia, Times, serif">Email</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                          <input type="email" placeholder="Email ID" id="t1" name="email">
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0" style="font-family: Cambria, Cochin, Georgia, Times, serif">Phone</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                          <input type="text" placeholder="Phone Number" id="t1" name="phone">
                          </div>
                        </div>
                        
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0" style="font-family: Cambria, Cochin, Georgia, Times, serif">Address</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                          <input type="text" placeholder="Address" id="t1" name="add">
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0" style="font-family: Cambria, Cochin, Georgia, Times, serif">Shop Name</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                          <input type="text" placeholder="Shop Name" id="t1" name="cli">
                          </div>
                        </div>
                        <hr>   
                        <div class="group text-center"> <input type='submit' class='button' value='Submit' name='setup'> </div>
                        </form>
                        <?php
                          if (isset($_POST['setup'])){
                            $name=$_POST['name'] ;
                            $email=$_POST['email'];
                            $phone=$_POST['phone'];
                            $address=$_POST['add'];
                            $cliname=$_POST['cli'];
                                      
                            $sql = "UPDATE manufacturer_biodata SET Name='$name',
                                                                    Email_ID='$email', 
                                                                    phone_no='$phone',
                                                                    address='$address',
                                                                    shop_name='$cliname'
                                                                WHERE manufacturer_id=$a";
                            if (mysqli_query($conn, $sql)) {
                              echo "<script type=\"text/javascript\">
                                      window.alert('Information Successfully inserted');
                                      window.location.href = '/Project_For_Dentist/php/manufacture_edit_profile.php?id=".$a."';
                                    </script>";                                        
                            } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
        </div>
    </div>
    <div class="container">
      <span style="font-family: Cambria, Cochin, Georgia, Times, serif">Enter Product Details</span>
      <div class="card">
        <div class="card-body"> 
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0" style="font-family: Cambria, Cochin, Georgia, Times, serif">Product Name</h6>
              </div>
              <div class="col-sm-9 text-secondary">
              <form method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="Product Name" id="t1" name="pname">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0" style="font-family: Cambria, Cochin, Georgia, Times, serif">Price</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input type="text" placeholder="Price" id="t1" name="price">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0" style="font-family: Cambria, Cochin, Georgia, Times, serif">Description</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input type="text" placeholder="Description" id="t1" name="des">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0" style="font-family: Cambria, Cochin, Georgia, Times, serif">Upload image</h6>
              </div>
              <div class="col-sm-9 text-secondary">
              <input type="file" class="text-center center-block file-upload" name="productI">
              </div>
            </div>
            <hr>   
              <div class="group"> <input type='submit' class='button' value='Submit' name='submi'> </div> 
              </form>
              <!-- Information about product is stored-->
              <?php
                   if (isset($_POST['submi'])){
                     
                    $pname=$_POST['pname'] ;
                    $price=$_POST['price'];
                    $des=$_POST['des'];
                    
                      $image = $_FILES['productI']['name'];
                      $fileType = $_FILES['productI']['type'];
                      $fileTmpName = $_FILES['productI']['tmp_name'];
                      $fileError = $_FILES['productI']['error'];
                      $fileSize = $_FILES['productI']['size'];
                                                                  
                      $fileExt = explode('.', $image);
                      $fileActualExt = strtolower(end($fileExt));
                                                              
                      $allowed = array('jpg', 'jpeg', 'png', 'jfif');
                      if(in_array($fileActualExt, $allowed)){
                        
                          if($fileError === 0){
                              if($fileSize < 1000000){
                                  $fileNameNew = uniqid('', true).".".$fileActualExt;
                                  $fileDestination = '../images/'.$fileNameNew;
                                  if(move_uploaded_file($fileTmpName, $fileDestination)){
                                      
                                      $sql="INSERT INTO product_selling(manufacturer_id, product_name, price, description, product_image_name)
                                       VALUES($a, '$pname', '$price', '$des', '$fileNameNew')";
                                      if(mysqli_query($conn, $sql)){
                                        echo "<script type=\"text/javascript\">
                                        window.alert('Product Uploaded');
                                        </script>";
                                        
                                      }                    
                                  }else{
                                      echo "<script type=\"text/javascript\">
                                                  window.alert('Something Went wrong while transferring file ');
                                          </script>";
                                  }
                              } else{
                                  echo "<script type=\"text/javascript\">
                                                  window.alert('File size is large ');
                                          </script>";                             
                              }
                          }  else{
                              echo "<script type=\"text/javascript\">
                                          window.alert('There was an error uploading file');
                                  </script>"; 
                          }
                      } else{
                          echo "<script type=\"text/javascript\">
                                          window.alert('Upload image of type .jpg, .jpeg, .png, .jfif');
                                  </script>";
                      }
                  }
              ?>   
          </div>
      </div>
    </div>
    <hr>
</body>
</html>