<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>LOUE MON APPART</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
		<div id="body-wrapper">
			<div class="page-header">
			<?php if(empty($_SESSION['user']) == false):?>
				<h2><a href="http://localhost/EcoleDuNum/LOUEMONAPPART/loueMonAppart/accueil">LOUE MON APPART</a></h2>
				
				<div class="btn-group" role="group" aria-label="...">
					<a href="http://localhost/EcoleDuNum/LOUEMONAPPART/loueMonAppart/viewPost"><button type="button" class="btn btn-info">Liste des Annonces</button></a>
					<a href="http://localhost/EcoleDuNum/LOUEMONAPPART/loueMonAppart/accueil"><button type="button" class="btn btn-primary">Mes Annonces</button></a>
					<a href="http://localhost/EcoleDuNum/LOUEMONAPPART/loueMonAppart/newPost"><button type="button" class="btn btn-success">Poster une Annonce</button></a>
					<a href="http://localhost/EcoleDuNum/LOUEMONAPPART/loueMonAppart/deconnexion"><button type="button" class="btn btn-warning">Deconnexion</button></a>
				</div>
                    <br/><br/>

				
                <div class="form-group" role="group">


					<?php $viewcategories = Flight::get('affichecategorie');?>
					<select name="value" class="form-control" style="width: 300px;" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                            <option value="">Catégories</option>
                    <?php foreach ($viewcategories as $c): ?>
							<option value="http://localhost/EcoleDuNum/LOUEMONAPPART/loueMonAppart/viewPostByCat/<?= $c->getId();?>" <?= !empty($categorySelected) ? ($categorySelected == $c->getId() ? "selected":""):"" ?>><?= $c->getCategoryName();?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
				
			<?php else: ?>

			<h2><a href="http://localhost/EcoleDuNum/LOUEMONAPPART/loueMonAppart">LOUE MON APPART</a></h2>
				<div class="btn-group" role="group" aria-label="...">
					<a href="login"><button type="button" class="btn btn-success">Connexion</button></a>
					<a href="signup"><button type="button" class="btn btn-default">Inscription</button></a>
				</div>
				<?php endif; ?>
			</div>
			
			<div id="content">
			
			
		 