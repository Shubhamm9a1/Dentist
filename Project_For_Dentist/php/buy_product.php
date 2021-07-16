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
<link rel="stylesheet" href="../css/buy_product.css">


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

<style type="text/css">
       

    .table > tbody > tr > .no-line {
        border-top: none;
    }

    .table > thead > tr > .no-line {
        border-bottom: none;
    }

    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
    #buttonplace{
        float: left;
    }
    #shop-name{
        font-family: sans-serif;
        margin-top: 0px;
    }
    #order-summary{
        font-family: sans-serif;
        color: #97395E;
    }
    #table-div{
        margin-top: 10px;
    }
    #table-font{
        color: black;
        opacity: 0.7;
        font-weight: bold;
        width: 60%;
    }
    h1{
        color: #97395E;
        font-weight: bold;
    }
    
    #header-position{
        height: 200px;
        opacity: 0.8;
    }
    #print-btn-place{
        float: right;

    }
    .center{
        margin-left: auto;
        margin-right: auto;
    }
</style>
</head>
<body>
<?php
include 'db.php';
/**manufacturer_id value fetched from url */
$a=isset($_GET['id']) ? (int)$_GET['id']:null;

/**dentist_id value fetched from url */
$b=isset($_GET['id']) ? (int)$_GET['id2']:null;

/**if not logged in You can't open this page */
if($b===null)
{
    // not logged in
    header('Location: ../index.php');
    exit();
}

$sql = "SELECT manufacturer_id, shop_name, shop_image_name FROM manufacturer_biodata";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        if($a==$row[0]){
            $ShopName=$row[1];
            $ShopImageName=$row[2];
        }
    }
}
?>
        <nav class="navbar navbar-expand-lg bg-primary fixed-top">
            <div class="container text-uppercase p-2">											
                                                                                        <!--Shop Name-->
                <a class="navbar-brand font-weight-bold text-white" href="#">Welcome TO <?php echo $ShopName;?> Shop</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a data-toggle="modal" data-target="#AddToCart"><span style='font-size:30px;' id='cart-img'>&#128722;</span></a>";
            
            </div>
        </nav>
        <div>
        <!--Shop Image-->
            <?php
                echo "
                <img src='../images/$ShopImageName' width='100%' height='400'>";
            ?>
        </div>
        <div class="container">
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><?php echo "<a href='shop_list.php?id=".$b."'>Back</a>";?></li>
                <li class="breadcrumb-item active" aria-current="page">Product's List</li>
                </ol>
            </nav>
        </div>
        <hr>
        <div class="container">
        <div class="row">
        <?php
        /**Here all data is taken from product_selling which was uploaded by manufacturer in his profile */
        $sql = "SELECT manufacturer_id, id, product_name, price, description, product_image_name FROM product_selling";
        if ($result = mysqli_query($conn, $sql)) {
            while ($row = mysqli_fetch_row($result)) {
                if($a==$row[0]){
        ?>
        <div class="col-md-3">
            <div class="card"  style="width: 18rem;">
                <img class="card-img-top" src="../images/<?php echo $row[5];?>" alt="Card image cap" width="150" height="150">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $row[2];?><span class="badge badge-danger">Rs.<?php echo $row[3];?></span></h5>
                    <p class="card-text"><?php echo $row[4];?></p>
                    <form method="POST">
                        <input type="text" placeholder="Quantity" name="quan"><br><br>
                        <button class="btn btn-primary" name="<?php echo $row[1];?>">Add To Cart</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        /**Add to cart Operation is done here*/
        if (isset($_POST[$row[1]])){
            $price = number_format($row[3]);
            $quantity = $_POST['quan'];
            $quantity = number_format($quantity);
            $query = "INSERT INTO bill_management(dentist_id, Name, price, quantity) VALUES($b, '$row[2]', $price, $quantity)";
            if ($result = mysqli_query($conn, $query)) {
                echo "<script type=\"text/javascript\">
                    window.alert('Item Added to the cart');
                    window.location.href = '/Project_For_Dentist/php/buy_product.php?id=".$a."&id2=".$b."';
                    </script>";
            }
        }
                }
            }
        }
        ?>
        </div>
        </div>
        <hr>
        <div id="AddToCart" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg" role="content">
                <div class="modal-content">

                
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-12 col-sm-12" class="heading">
                    
                    <h3>Your Order Summary</h3>
                </div>
                
            </div>
            <hr>
        </div>


                <div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                
                <div class="panel-body">
                    <div class="table-responsive" id="table-div">
                        <table class="table table-bordered table-striped center" style="background-color: #AEE1F4" id="table-font">
                            <thead>
                                <tr>
                                    <td><strong>Item</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <?php
                                $SubTotal = 0;
                                $Shipping = 40;
                                $Total = 0;
                                /**Data fetched From bill Management table which was uploaded above */
                                $sql="SELECT dentist_id, Name, price, quantity FROM bill_management";
                                if ($result = mysqli_query($conn, $sql)) {
                                    while ($row = mysqli_fetch_row($result)) {
                                        $total = $row[2] * $row[3];
                                        echo "<tr>
                                            <td>$row[1]</td>
                                            <td class='text-center'>Rs $row[2]</td>
                                            <td class='text-center'>$row[3]</td>

                                            <td class='text-right'>Rs.$total</td>
                                            
                                        </tr>";
                                        $SubTotal = $SubTotal + $total;
                                    }
                                }
                                
                                ?>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                    <td class="thick-line text-right">Rs<?php echo $SubTotal; 
                                                                            $Total=$Shipping + $SubTotal?></td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Shipping</strong></td>
                                    <td class="no-line text-right">Rs.40.00</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total</strong></td>
                                    <td class="no-line text-right">Rs.<?php echo $Total;?></td>
                                </tr>
                            </tbody> 
                        </table>
                        <div>
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-5 col-sm-6 col-lg-6">
                                    <button type="button" class="btn btn-success" id="print-btn-place" onclick="window.print()">Print</button>
                                </div>
                                <form method="POST">
                                    <div class="col-xs-7 col-sm-6 col-lg-6">
                                        <button class="btn btn-success" id="buttonplace" name="pay">PayNow</button>
                                    </div>
                                    <hr>
                                </form>
                                <?php
                                /**Here Truncate operation is done after payment*/
                                    if (isset($_POST['pay'])){
                                       $sql4 = "TRUNCATE TABLE bill_management";
                                        if (mysqli_query($conn, $sql4)) {
                                        echo "<script type=\"text/javascript\">
                                                window.alert('Payment succesfull');
                                                window.location.href = '/Project_For_Dentist/php/buy_product.php?id=".$a."&id2=".$b."';
                                            </script>";
                                        }
                                        else {
                                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                        }
                                    }
                                ?>
                            </div>
                         </div>   
                    </div>
                    <div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
</body>
</html>