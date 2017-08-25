<?php include_once('views/header.php'); ?>
<h2>Incription Utilisateur</h2>
<p>
    Inscrivez-vous
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
<form action="RegisterService" method="post">
    <div class="form-groups">
        <label>Username</label>
        <input class="form-control" type="text" name="username" value="" />
    </div>
    <div class="form-groups">
        <label>password</label>
        <input class="form-control" type="text" name="password" value="" />
    </div>
    <div class="form-groups">
        <label>email</label>
        <input class="form-control" type="text" name="email" value="" />
    </div>
    <button class="btn btn-primary" type="submit">S'enregistrer</button>
</form>
<?php include('views/footer.php');