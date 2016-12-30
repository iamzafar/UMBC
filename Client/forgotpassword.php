
<!-- Register --> 
<?php
  session_start();
  require '../Functions/phpfunctions.php';
  require '../Config/connect_db.php';

  $submit = (isset( $_POST['submit'])) ? 1 : 0;

  if($submit) {
    $email = $_POST['email'];
    if($email == "") {
      echo "invalid input";
    } else {

        // encrypt the email
        $emailBegin = emailBegin($email);
        $emailEnd = emailEnd($email);

        // set the salt of the encrypion to begin email md5;

        // encrypt email to send via url;
        $emailEncrypt = encrypt($emailBegin, $_SESSION['salt']);
        for($i = 0; $i < strlen($emailEncrypt); $i++) {
          if($emailEncrypt[$i] == '+') {
            $emailEncrypt[$i] = '*';
          }
        }

        $emailEncrypt .= $emailEnd;
  

      // check if user exist
      if(emailExists($db, $connect, $emailEncrypt)) {

        // send email to user -- email( $to, $subject, $message, $Header );
        $subject = 'Password reset';

$linktopwd =<<<EOF
<h1>Dear user,\n\nYou recently required password reset, so use this link below:</h1><a href="
EOF;

$linktopwd .=<<<EOF
  http://localhost/UMBC/Client/passwordReset.php?email=
EOF;

$linktopwd .= $emailEncrypt . "></a>";

$linktopwd .=<<<EOF
  \n\nBarking Bizaar
EOF;

        $headers .= 'To: drakegaopro@gmail.com' . "\r\n";
        $headers .= 'From: Proximo' . "\r\n";
        echo $email;
        mail($email, $subject, $linktopwd, $headers);
        header('Location: passwordresetinform.php');
        die();

      } else {
        echo "user account is not found";
      }
    }
  }
?>

<div class="container">           
    <div class="jumbotron" id="background_color">              
        <h1 class="sign">Barking Bazaar</h1>
        <br> <br>              
        <h2 align="center">Enter you email</h2>            
        <form class="form-horizontal" id="form1" method="post" action="#">
            <div class="form-group">
                <!-- <label for="inputEmail3" class="col-sm-offset-2 col-sm-2 control-label">Email</label> -->
                <div class="col-sm-offset-3 col-sm-6">
                    <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
                </div>
            </div>                
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-10">
                    <button type="submit" class="btn btn-success" name="submit">Send password</button>
                </div>
            </div>
        </form>            
    </div>
    
    
    <footer class="container-fluid">  
        &copy;ZAADN LLC. All rights are reserved.
    </footer>
</div>    
