<?php include_once('views/header.php'); ?>
<h2>Toutes les Annonces</h2>
<div class="container">
   

<?php $viewannonce = Flight::get('afficheannonce'); ?>

<?php foreach($viewannonce as $a):?>
    <div >
        <h3><?= $a->getTitle();?></h3>
        <h4><?= $a->getPosterId();?></h4>
        <h5><?= $a->getDatePost();?></h5>
        <p><?= $a->getDescription(); ?></p>
    </div>

<?php endforeach;?> 

</div>

</div>

   
<?php include_once('views/footer.php'); ?>

