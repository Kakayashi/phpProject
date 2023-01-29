<?php include('view/components/headerApp.php') ?>
<?php include('view/components/navApp.php') ?>

<section>
    <div id="articleBigWrapper">
         <?= $article?>
         <div id="commentsWrapper">
         <?= $comments?>   
         </div>
    </div>
</section>



<?php include('view/components/footerApp.php') ?>