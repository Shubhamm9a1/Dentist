<?php
include 'db.php';

/**Login and Sign Up Backend is done here  */
/**Dentist Sign Up Code*/
	if (isset($_POST['drsignup'])){
		$name=$_POST['drname'] ;
		$email=$_POST['dremail'];
		$pass=$_POST['drpass'];
		$sql = "INSERT INTO dentist_login(Name, Email_ID, Password) VALUES ('$name', '$email', '$pass')";
		if (mysqli_query($conn, $sql)) {				
			echo "<script type=\"text/javascript\">
                    window.alert('New record inserted succesfully');
                    window.location.href = '/Project_For_Dentist/index.php';
				  </script>";
					
        } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
						  
	}

    /**Dentist Login Code*/
    if (isset($_POST['dlsignin'])){
        $email=$_POST['dlemail'];
        $pass=$_POST['dlpass'];
        $valid=0;
        $sql = 'SELECT id,Email_ID, Password FROM dentist_login';
        if ($result = mysqli_query($conn, $sql)) {
            while ($row = mysqli_fetch_row($result)) {
            
                if(($email===$row[1]) && ($pass===$row[2])){
                    $valid=1;
                echo "<script type=\"text/javascript\">
                    window.alert('You succesfully Logged IN');
                    window.location.href = '/Project_For_Dentist/php/dentist_main_page.php?id=".$row[0]."';</script>";
                }
                
            }
                if($valid==0){
                    
                    echo "<script type=\"text/javascript\">
                    window.alert('You MailId/password is wrong or else you did not registered');
                    window.location.href = '/Project_For_Dentist/index.php';</script>";
                }
               
                mysqli_free_result($result);
        }
        
    }

    /**manufacturer Sign Up Code*/
    if (isset($_POST['mrsignup'])){
		$name=$_POST['mrname'] ;
		$email=$_POST['mremail'];
		$pass=$_POST['mrpass'];

        $sql = "INSERT INTO manufacturer_login(Name, Email_ID, Password) VALUES ('$name', '$email', '$pass')";
        
		if (mysqli_query($conn, $sql)) {				
			echo "<script type=\"text/javascript\">
                    window.alert('New record inserted succesfully');
                    window.location.href = '/Project_For_Dentist/index.php';
				  </script>";
					
        } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
						  
    }
    
    /**Manufacturer login Code*/
    if (isset($_POST['mlsignin'])){
        $email=$_POST['mlname'];
        $pass=$_POST['mlpass'];
        $valid=0;
        $sql = 'SELECT id,Email_ID, Password FROM manufacturer_login';
        if ($result = mysqli_query($conn, $sql)) {
            while ($row = mysqli_fetch_row($result)) {
            
                if(($email===$row[1]) && ($pass===$row[2])){
                    $valid=1;
                echo "<script type=\"text/javascript\">
                    window.alert('You succesfully Logged IN');
                    window.location.href = '/Project_For_Dentist/php/manufacture_edit_profile.php?id=".$row[0]."';</script>";
                }
                
            }
                if($valid==0){
                    
                    echo "<script type=\"text/javascript\">
                    window.alert('You MailId/password is wrong or else you did not registered');
                    window.location.href = /Project_For_Dentist/index.php';</script>";
                }
               
                mysqli_free_result($result);
        }
        
    }

?>
