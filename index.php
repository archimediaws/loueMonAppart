<?php 
	header('Content-Type: text/html;Charset=UTF8');
	
	//Inclusion flight + autoloader = Inclusion controler + des "model"
	require 'flight/Flight.php';
	require 'autoloader.php';

	session_start();

	// hors flight route = affiche les categories dans le header + poster annonce 
	$bdd = new bddManager();
	$repoCategories = $bdd->getCategoriesRepository();
	$affichecategorie = $repoCategories->getAllCategories();
	Flight::set('affichecategorie', $affichecategorie);

	

	Flight::route('/', function(){
		Flight::render('accueil');
	});



	Flight::route('/accueil', function(){
		unset($_SESSION['erreur']);
		$bdd = new bddManager();
		$repoAnnonce = $bdd->getAnnonceRepository();
		$afficheuserannonces = $repoAnnonce->getAllAnnonceByUserId();
		Flight::set('afficheuserannonces', $afficheuserannonces);

		Flight::render('accueil');
	});


	Flight::route('/login', function(){
		Flight::render('login');
	});

	Flight::route('POST /LoginService', function(){
		unset($_SESSION['erreur']);
		$service = new loginService();
		$service->setParams(Flight::request()->data->getData());
		$service->launchControls();
		if($service->getError()){
			$_SESSION['erreur']=$service->getError();
			Flight::redirect('/login');
		}
		Flight::redirect('/accueil');
	});

	Flight::route('/signup', function(){
		Flight::render('signup');	
	});

	Flight::route('POST /RegisterService', function(){
		unset($_SESSION['erreur']);
		$service = new RegisterService();
		$service->setParams(Flight::request()->data->getData());
		$service->launchControls();
		if($service->getError()){
			$_SESSION['erreur']=$service->getError();
			Flight::redirect('/');
		}
		else
			Flight::redirect('/accueil');
	});


	Flight::route('/newPost', function(){
		$bdd = new bddManager();
		$repoCategories = $bdd->getCategoriesRepository();
		$affichecategorie = $repoCategories->getAllCategories();
		Flight::set('affichecategorie', $affichecategorie);
		Flight::render('newPost');
	
	});

	Flight::route('POST /NewPostService', function(){
		unset($_SESSION['erreur']);
		$service = new NewPostService();
		$service->setParams(Flight::request()->data->getData());
		$service->launchControls();
		if($service->getError()){
			$_SESSION['erreur']=$service->getError();
			Flight::redirect('/newPost');
		}
		else
			Flight::redirect('/accueil');
	});



	Flight::route('/viewPost', function(){
		
		$bdd = new bddManager();
		$repoAnnonce = $bdd->getAnnonceRepository();
		$afficheannonce = $repoAnnonce->getAllAnnonce();
		Flight::set('afficheannonce', $afficheannonce);
		
		Flight::render('viewPost');	
	});



	Flight::route('/viewPostByCat/@id', function($id){
		
		$bdd = new bddManager();
		
				$repoCategories = $bdd->getCategoriesRepository();
				$affichecat = $repoCategories->getCategoryById($id);
				Flight::set('affichecat', $affichecat);

		$bdd = new bddManager();
		
				$repoAnnonce = $bdd->getAnnonceRepository();
				$afficheannoncebycat = $repoAnnonce->getAllAnnonceByCategoryId($id);
				Flight::set('afficheannoncebycat', $afficheannoncebycat);

	
				Flight::render('viewPostByCat');
	});




	Flight::route('/deconnexion', function(){
		unset( $_SESSION['user'] );
		session_destroy();
		Flight::render('accueil');
		Flight::redirect('/');
	});

	Flight::start();

