<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/1e8fd6d397.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1e8fd6d397.js" crossorigin="anonymous"></script>
    <link href="style/dashboard.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="style/dashboardList.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="style/dashboardCreate.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />


</head>

<body>
<?php
    if (isset($_SESSION["current_user"])){
        /* Użytkownik jest zalogowany */
       
     } else {
        /* Użytkownik nie jest zalogowany */
        header( "Location: index2.php" );
     }
?> 
<div id="wrapper">
    