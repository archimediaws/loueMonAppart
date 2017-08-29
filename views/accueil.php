<?php include_once('views/header.php'); ?>
<?php if (!empty($success)): ?>
    <div class="alert alert-success">
        <strong><?= $success ?></strong>
    </div>
<?php endif; ?>

    <?php if(empty($_SESSION['user']) == false):?>


    <h2>Bienvenue  <?php echo $_SESSION['user']->getUsername(); ?>, vos annonces :</h2>

        <?php $viewuserannonces = Flight::get('afficheuserannonces');?>
        <?php if(!empty($viewuserannonces)): ?>
            <?php foreach($viewuserannonces as $ua): ?>
            <div id="">
                <div>
                    <div class="user-post-header">
                        <a href="<?= $ua->getId();?>"><h2><?= $ua->getTitle();?></h2></a> 
                
                        <div class="user-post-header__label">
                            <a href="#">par <?= $_SESSION['user']->getUsername(); ?>  <?= $ua->getPosterId();?> le <?= $ua->getDatePost();?></a>
                        </div>

                    </div>
                    <div>
                        <blockquote>
                            <?= $ua->getDescription();?>...
                        </blockquote>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div id="">
            <div>
                vous n'avez pas encore créé d'annonce
            </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
            <div id="">
            <div>
                vous devez vous connecter ou vous enregistrer pour consulter les annonces
            </div>
            </div>
    <?php endif; ?>   
<?php include_once('views/footer.php'); ?>