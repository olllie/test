<?php
$subjectPrefix = ' Ollie-Allen.co.uk - Add to mailing list';
$emailTo = 'ollie@ollie-allen.co.uk,olliebopsa@hotmail.com,';
$senderName = 'Ollie Allen Website';
$senderEmail = 'donotreply@ollie-allen.co.uk';


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email   = stripslashes(trim($_POST['form-email']));
    $pattern  = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';

    if (preg_match($pattern, $email)) {
        die("Header injection detected");
    }

    $emailIsValid = preg_match('/^[^0-9][A-z0-9._%+-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/', $email);

    if($email){
        //$subject = "$subjectPrefix $name '-' $subject";
        $subject = "$subjectPrefix $name";
        $body = "<strong>$message</strong><br /> <br /> <strong>Name:</strong><br /> $name <br /><br /> <strong>Email:</strong><br /> $email <br /><br /> <strong>Telephone:</strong><br /> $telephone <br /><br />";

        $headers  = 'MIME-Version: 1.1' . PHP_EOL;
        $headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;
        $headers .= "From: $senderEmail" . PHP_EOL;
        $headers .= "Return-Path: $emailTo" . PHP_EOL;
        $headers .= "Reply-To: $email" . PHP_EOL;
        $headers .= "X-Mailer: PHP/". phpversion() . PHP_EOL;

        mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
        //echo "<script type='text/javascript'>alert('SENT to $emailTo with this crap... $subject $body');</script>";
    } else {
        $hasError = true;
        //echo "<script type='text/javascript'>alert('NOT SENT');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <title>Ollie Allen  |  Digital Designer</title>
    <meta name="description" content="Ollie Allen is a multidisciplinary digital designer based in Hampshire, UK">
    <meta name="keywords" content="ollie, allen, graphic, design, designer, hampshire, UI, digital, web, creative, ">
    <meta name="author" content="Ollie Allen">
    <link rel="stylesheet" href="css/app.css" />
    <script src="bower_components/modernizr/modernizr.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,900,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  </head>
  <body>

    <div id="leftHalf"></div>
    <div id="rightHalf"></div>

    <div class="row fullWidth fullHeight">
      <div class="inner fullHeight">
        <div class="medium-4 large-4 columns pink fullHeight vert-container">
          <div class="vert-mid"><img class="right skull" src="img/skull.jpg" alt=""></div>
        </div>
        <div class="medium-8 large-8 columns fullHeight vert-container">
          <div class="vert-mid myDetails">

            <img class="oa-logo"src="img/oa-logo.jpg" alt="Logo">
            <h3 class="pink-text"><b>Ollie Allen</b> is a digital designer based in Hampshire, UK </h3>
            <p>Welcome. Please check back soon for updates.<p/>
            <div class="line-2-grey"></div>


            <?php if(!empty($emailSent)): ?>
                  <div class="">
                      <div class="alert alert-success">Thank you for your interest. </div>
                  </div>
              <?php else: ?>
              <?php if(!empty($hasError)): ?>
              <div class="">
                  <div class="alert alert-danger">There was an error submiting the form. Please ensure you have completed all required fields.</div>
              </div>
            <?php endif; ?>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" class="myForm" method="post">
              <p>Sign up for my newsletter</p>
              <div id="submit_wrapper">
                <input type="text" id="submit_field" name="Email" value="Email" />
                <a href="">
                  <div id="submit_button"><i class="fa fa-angle-right fa-lg"> </i></div>
                </a>
              </div>
            </form>
            <?php endif; ?>

            <a href="https://dribbble.com/OllieAllen"><i class="fa fa-dribbble "></i></a>
            <a href="https://www.pinterest.com/ollieallen/"><i class="fa fa-pinterest-p"></i></a>
            <a href="https://instagram.com/ollliealllen/"><i class="fa fa-instagram"></i></a>
            <a href="https://uk.linkedin.com/pub/ollie-allen/a5/455/637"><i class="fa fa-linkedin"></i></a>
            <a href="https://www.flickr.com/photos/olliebopsa"><i class="fa fa-flickr"></i></a>


            <div class="line-2-grey line-accent"></div>

          </div>
        </div>
      </div>
    </div>


    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/foundation/js/foundation.min.js"></script>
    <script src="bower_components/foundation/js/foundation/foundation.equalizer.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
