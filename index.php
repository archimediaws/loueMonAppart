<?php 
	header('Content-Type: text/html;Charset=UTF8');
	
	//Inclusion flight + autoloader = Inclusion controler + des "model"
	require 'flight/Flight.php';
	require 'autoloader.php';

	session_start();


	$bdd = new bddManager();
	$repoCategories = $bdd->getCategoriesRepository();
	$affichecategorie = $repoCategories->getAllCategories();
	Flight::set('affichecategorie', $affichecategorie);

	

	Flight::route('/', function(){
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
			Flight::redirect('/');
		}
		Flight::redirect('/');
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
			Flight::redirect('/');
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
			Flight::redirect('/');
	});



	Flight::route('/viewPost', function(){
		
		$bdd = new bddManager();

		$repoAnnonce = $bdd->getAnnonceRepository();
		$afficheannonce = $repoAnnonce->getAllAnnonce();
		Flight::set('afficheannonce', $afficheannonce);
		
		Flight::render('viewPost');
		
	});


	Flight::route('ViewPostService/@id', function($id){
		unset($_SESSION['erreur']);
		$service = new ViewPostService();
		
	});


	Flight::route('/deconnexion', function(){
		session_destroy();
		Flight::redirect('/');
	});

	Flight::start();



	// Inclusion des "model" -> fichiers backend
	// include_once('model/operations.php');
	// include_once('model/sessionManager.php');
	// include_once('model/helpers.php');
	// include_once('model/requestManager.php');

	/**
	 * On prend le parametre dans l'url qui va déterminer quelle page on regarde
	 * J'ai créer un nouveau fichier le request Manager
	 */
	// $page = getPageName();

	// switch( $page ) {
	// 	case 'login':
	// 		sessionControlOffline();
	// 		$error = getErrorsForm();
	// 		include_once('templates/login.php');
	// 		break;
	// 	case 'signup':
	// 		sessionControlOffline();
	// 		$error = getErrorsForm();
	// 		$success = getSuccessFromGETRequest();
	// 		include_once('templates/signup.php');
	// 		break;
	// 	case 'acceuil':
	// 		sessionControlOnline();
	// 		$success = getSuccessForm();//en provenance du service serviceNewPost
    //         $categories = getCategories();
    //         $categorySelected = getCategorySelected();
    //         if(!empty($categorySelected)){
    //             $posts = getPostByCateg($categorySelected);
    //         }else{
	// 		    $posts = getAllPosts();
    //         }
	// 		include_once('templates/accueil.php');
	// 		break;
	// 	case 'newPost':
	// 		sessionControlOnline();
	// 		$error = getErrorsForm();
	// 		$myid = getMyId();
	// 		$categories = getCategories();
	// 		include_once('templates/newPost.php');
	// 		break;
	// 	case 'viewPost':
	// 		sessionControlOnline();
	// 		$error = getErrorsForm();
	// 		$success = getSuccessForm();
	// 		$myid = getMyId();
	// 		$postid = getPostIdFromGETRequest();
	// 		$post = getPostById($postid);

	// 		$comments = getAllCommentsByPostId($postid);
	// 		include_once('templates/viewPost.php');
	// 		break;
	// 	case 'deconnexion':
	// 		sessionDestroy();
	// 		break;
		
	// }
