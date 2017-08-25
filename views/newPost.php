<?php include_once('views/header.php'); ?>
    <h2>Poster une Annonce</h2>
    <p>
        Écrivez votre annonce
    </p>
<?php if(!empty($error)): ?>
    <div class="alert alert-danger">
        <strong>Erreur!</strong> <?=$error?>
    </div>
<?php endif; ?>
<?php if(!empty($success)): ?>
    <div class="alert alert-success">
        <strong>Vous avez bien été enregistré!</strong> <?=$success?>
    </div>
<?php endif; ?>
    <div class="container">
        <div class="row">
        <form action="NewPostService" method="post" >
            <input type="hidden" name="poster" value="" />
            <div class="form-group">
                <label>Titre:</label>
                <input class="form-control" type="text" name="title" value="" />
            </div>
            <div class="form-group">
                <label>Description:</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            
            <div class="form-group">
            <label>Categorie:</label>
                <select name="categorie" class="form-control">
                    <?php //foreach ($categories as $c): ?>
                        
                        <option value="1">studio</option>
                        <option value="2">T1</option>
                        

                    <?php //endforeach; ?>
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Poster</button>
        </form>
        </div>
    </div>
<?php include('footer.php');