<?php include('view/components/headerApp.php') ?>
<?php include('view/components/navApp.php') ?>

<section>
    
    <div id="loginWrapper">
        <h4>Login:</h4>
        <form method="POST" action="index2.php?action=logowanie">
            <div class="form-group">
                <label for="loginInput">Login</label>
                <input name="login" type="text" class="form-control" id="loginInput" aria-describedby="loginHelp"
                    placeholder="Enter login">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="inputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="inputPassword1" placeholder="Password">
            </div>
            </br>
            <a href="index2.php?action=rejestracja">Sing up</a>
            <div id="formSubmitWrapper">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
           
        </form>
        <?= $text?>  
</section>



<?php include('view/components/footerApp.php') ?>