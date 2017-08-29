<?php include_once('views/header.php'); ?>

<?php $viewcat = Flight::get('affichecat'); ?>
<h2>Toutes les Annonces par Catégorie <?= $viewcat->getCategoryName(); ?></h2>

<div class="container">

<?php $viewannoncebycat = Flight::get('afficheannoncebycat'); ?>
<?php if(!empty($viewannoncebycat)): ?>
<?php foreach($viewannoncebycat as $acat):?>


    <div >
        <h3><?= $acat->getTitle();?></h3>
        <h4><?= $acat->getPosterId();?></h4>
        <h5><?= $acat->getDatePost();?></h5>
        <p><?= $acat->getDescription(); ?></p>
    </div>

<?php endforeach;?> 
<?php else: ?>
            <div id="">
            <div>
                pas d'annonce dans cette catégorie
            </div>
            </div>
        <?php endif; ?>

</div>

</div>

   
<?php include_once('views/footer.php'); ?>

