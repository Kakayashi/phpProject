<?php include('view/components/headerDashboard.php') ?>
<?php include('view/components/sidebarDashboard.php') ?>

 <div id="content">
            <div class="contentContener">
                <div class="contentContenerHeader"> Dane: </div>
                <div class="contentContenerData">

                <?= $info?> 

                    
                </div>
            </div>

            <div class="contentContener">
                <div class="contentContenerHeader"> Statystyki: 
                    <?= $stat?> 
                </div>
            </div>
    </div>
    <?php include('view/components/footerDashboard.php') ?>