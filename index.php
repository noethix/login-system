<?php
	session_start();
	session_destroy();// don't need 'logout.php' nomore this will erase the previous session, just need to add a logout button and link it back to index
	?>

<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width= , initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
		integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<title>Log in</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="index.css">
	</head>


	<body>
		
<form action="identification.php" method="POST"> <!--Fait appel au fichier de vérification de la connexion--> 
	<?php if(isset($_SESSION['success'])){ //si création d'un nouveau compte, alors il ecrit le message de confirmation de crétion dans la database .
		echo $_SESSION['success'];
		unset ($_SESSION['success']);
	} 
				if(isset($_SESSION['Error_Message'])) {
					echo $_SESSION['Error_Message'];
				}
					?>
			<div class="form-group">
				<h1>Type in your credentials</h1>
				<label for="exampleInputEmail1">Username</label>
				<input type="text" class="form-control" id="login" aria-describedby="" placeholder="Username">
				<small id="" class="form-text text-muted"></small>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			<small id="" class="form-text text-muted"></small>
			</div>
  
  		<button type="submit" class="btn btn-primary">Submit</button>
  		<p><a href="newuser.php">If you haven't registered yet you can do it here</a></p>
</form>

	</body>
	
</html>

