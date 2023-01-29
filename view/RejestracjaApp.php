<?php include('view/components/headerApp.php') ?>
<?php include('view/components/navApp.php') ?>

<section>
    
<div id="loginWrapper">
        <h4>Register:</h4>
        <form method="POST" action="index2.php?action=zajerestruj">
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
        <?= $text?>  
</section>



<?php include('view/components/footerApp.php') ?>