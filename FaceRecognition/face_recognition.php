<?php
include("../db/auth.php"); //include auth.php file on all secure pages 
require('../db/db.php');
require('../db/errorFuncts.php');

$photo_taken = false;

if(isset($_POST['imgData'])) {
  $photo_taken = true;
  $imgData = $_POST['imgData'];
  //echo "post value " . $imgData . " end"; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script defer src="scripts/face-api.min.js"></script>
  <script defer src="scripts/script.js"></script>
  <title>Face Recognition</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      width: 100vw;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column
    }

    canvas {
      position: absolute;
      top: 0;
      left: 0;
    }

    body { font-family: Helvetica, sans-serif; }
    h2, h3 { margin-top: 0; }
    form { margin-top: 15px; }
    form > input { margin-right: 15px; }

    input[type=button],
    button[type=submit] {
      font-family: Helvetica, sans-serif; 
      background-color: #F0F0F0;
      font-size:1.1em;
      letter-spacing: 1.5px;
      color: black;
      border: 1px solid black;
      padding: 14px 20px;
      margin: 8px 0;
      transition-duration: 0.4s;
      border-radius: 4px;
      cursor: pointer;
      margin:5px;
    }

    input[type=button]:hover {
      opacity:0.8;
      background-color: #555555;
      border: 1px solid #555555;
      color: white;
    }

    button[type=submit]:hover {
      opacity:0.8;
      background-color: green;
      border: 1px solid green;
      color: white;
    }

    #imageUpload {
        display: none;
    }
    
    @media only screen and (max-width: 600px) {
      body {
        margin-left: 0px;
      }
      h1, h2, h3, form, form>input {
        margin-left: 10px;
      }
    }

    @media only screen and (min-width: 600px) and (max-width: 1250px) {
      body {
        position: relative;
        width: 100%;
        display: block;
      }

      body>* {
        margin-left: auto;
        margin-right: auto;
        width: 570px;
        display: block;
      }

      body>script {
        display: none
      }
    }

  </style>
</head>
<body>
  <h1>Your privacy matters to us!<i class="fa fa-picture-o" aria-hidden="true"></i></h1>
  <h3><span style="color:#e44d3a;">Press a face to blur</span> and then &amp; submit the photo</h3>
  <form name="foo" method="post" action="../post.php" enctype="multipart/form-data">
    <input type="hidden" name="imgData" id="imgData" value= "" />
    <?php echo '<input type="file" id="imageUpload" value= "'.$imgData.'" />'; ?>
 <!--  <input type="file" id="imageUpload" value= <?php echo"\"".$imgData."\""?> > -->

   <button type="submit" onClick="save_photo()">Submit photo &#187;</button>
  </form>
</body>
<script>
    function save_photo() {
      // actually snap photo (from preview freeze) and display it
      Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('results').innerHTML = 
          '<h2>Your Previous Photo:</h2>' + 
          '<img src="'+data_uri+'"/>';
        // store the data uri of the photo to our hidden field
        document.getElementById("imgData").value = data_uri;
      } );
    }
  </script>
</body>
</html>