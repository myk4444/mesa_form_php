<?php

if($_SERVER["REQUEST_METHOD"] == "POST") { // make sure this page is being access from the form!

    // initialize variables
    $msg = '';
    $photo_okay = false;

    $name = $_POST['name']; 
    $email = $_POST['email'];

    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) { // file upload and that there are no errors!

        // store in variables
        $file_name     = $_FILES["photo"]["name"];
        $file_type     = $_FILES["photo"]["type"];
        $file_size     = $_FILES["photo"]["size"];
        $file_tmp_name = $_FILES["photo"]["tmp_name"];
        $file_error    = $_FILES["photo"]["error"];

        // test
        // print $file_name     . "<br>";
        // print $file_type     . "<br>";
        // print $file_size     . "<br>";
        // print $file_tmp_name . "<br>";
        // print $file_error    . "<br>";

        //test
        print "<pre>";
        print_r($_FILES);
        print "</pre>";

        if($file_type != 'image/jpeg' && $file_type != 'image/png') { // make sure we have either a jpeg or png file
            $msg = "<span class=red>You must upload a jpg, jpeg, or png file</span>";
        }

        else {
            // upload the file_exists
            move_uploaded_file($file_tmp_name, "uploads/" . $file_name); // this will move the temporary folder into the uploads folder

            // flag
            $photo_okay = true;
            $msg = "Thank you $name for entering our photo contest. You have submitted the below photo:";
        }

    } // end if

} // end if request method

else {
     exit('You do not have permission to view this page!'); 
    // exit function does two things. 
    // 1. gives user a message. or it will execute whatever code is inside. 
    // 2. Stops any code from executing at this point, including the HTML web page.

    // or use header function
    // header ('Location: contest.html');
    // exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Contest Feedback - Miyuki Boulware</title>
    
    <style>
        body {
            font-family: arial, sans-serif;
            font-size: 100%;
        }
        h1 {
            font-size: 1.8em;
        }
        .red {
            color: red;
        }
    </style>
</head>

<body>
     <header>
         <h1>Photo Contest</h1>
    </header>    

    <p> <?php print $msg; ?> </p>
    
    <?php 
        if ($photo_okay) { // use $photo_okay to determine when to execute this print statement
            print "<img src=uploads/" . $file_name . " alt=photo>" ;
        }
    ?>

</body>
</html>