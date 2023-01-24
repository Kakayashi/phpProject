<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/1e8fd6d397.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <link rel="stylesheet" type="text/css" href="style/login.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand " href="index.php">BlogApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="kategoria.php?category=sport">Sport</a></li>
                            <li><a class="dropdown-item" href="kategoria.php?category=news">News</a></li>
                            <li><a class="dropdown-item" href="kategoria.php?category=technology">Technology</a></li>
                            <li><a class="dropdown-item" href="kategoria.php?category=other">Other</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav my-2 my-lg-0">
                    <li class="nav-item d-flex">
                        <a class="nav-link" aria-current="page" href="login.html">Zaloguj</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div id="loginWrapper">
        <h4>Register:</h4>
        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="nameInput">Name</label>
                <input name="name" type="text" class="form-control" id="nameInput" aria-describedby="loginHelp"
                    placeholder="Enter name">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="surnameInput">surname</label>
                <input name="surname" type="text" class="form-control" id="surnameInput" aria-describedby="loginHelp"
                    placeholder="Enter surname">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="loginInput">Login</label>
                <input name="login" type="text" class="form-control" id="loginInput" aria-describedby="loginHelp"
                    placeholder="Enter login">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="emailInput">Email</label>
                <input name="email" type="email" class="form-control" id="emailInput" aria-describedby="loginHelp"
                    placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
            </br>
            <a href="login.php">Sing in</a>
            <div id="formSubmitWrapper">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    require("dbconnection.php");
                    $filters = array(
                    "name" => array("filter"=>FILTER_SANITIZE_STRING),
                    "surname" => array("filter"=>FILTER_SANITIZE_STRING),
                    "login" => array("filter"=>FILTER_VALIDATE_REGEXP, "options"=> ['regexp' =>'/^[a-zA-Z0-9_]{3,16}$/']),
                    "password" => array("filter"=>FILTER_SANITIZE_STRING, "options"=> ['regexp' =>'/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*]).{8,}$/']),
                    "email" => array("filter"=>FILTER_VALIDATE_EMAIL)
                    );

                    $input = filter_input_array(INPUT_POST, $filters);
                    $errors = "";

                    foreach ($input as $key => $val) {
                    if ($val === false or $val === NULL) {
                    $errors .= $key . " ";
                    }
                    }

                    if ($errors === "") {
                        $user_name = $input["name"];
                        $user_surname = $input["surname"];
                        $user_login = $input["login"];
                        $user_email = $input["email"];
                        $user_password = $input["password"];
                        $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);


                        if (mysqli_query($db_conn, "INSERT INTO `users` (`user_name`, `user_surname`, `user_login`, `user_email`, `user_passwordhash`) VALUES ('$user_name', '$user_surname', '$user_login', '$user_email', '$user_password_hash')")){
                            echo "Rejestracja przebiegła poprawnie";
                        } else{
                            echo "Nieoczekiwany błąd - użytkownik już istnieje lub błąd serwera MySQL.";
                        }
                    }
                    else echo "niepoprawne dane";
                }
?>


    </div>


    <footer class="bg-dark text-center text-white fixed-bottom">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            Karol Krawczynski
            <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/Kakayashi" role="button"><i
                    class="fab fa-github"></i></a>
        </div>
    </footer>
</body>

</html>