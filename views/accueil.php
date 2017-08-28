<?php include_once('views/header.php'); ?>
<?php //if (!empty($success)): ?>
    <div class="alert alert-success">
        <strong><?//= $success ?></strong>
    </div>
<?php //endif; ?>
<?php $viewuserannonces = Flight::get('afficheuserannonces');?>
<?php if(!empty($viewuserannonces)): ?>
    <?php foreach($viewuserannonces as $ua): ?>
    <div id="">
        <div>
            <div class="user-post-header">
                <a href="#"><?= $ua->getPosterId();?><?= $ua->getTitle();?></a> 
               
                <div class="user-post-header__label">
                
                    <a href="<?= $ua->getId();?>"><?= $ua->getDatePost();?></a>
                </div>

                <!-- <div class="user-post-header__label">
                    <a href="index.php?p=viewPost&postid=<?//=$ua['id']?>"><?//=$ua['title']?></a>
                </div> -->

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
<?php include_once('views/footer.php'); ?>