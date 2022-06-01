<html>
    <head>
		<meta charset="utf-8">
		<title>Login</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/estilo.css"/>	
    </head>

    <body>	

		<div class="container mt-5">

			<img class='fotoLogo' src='logo.jpg'>

			<form id="formLogin" action="loginAutenciar.php" method="post">
				<div class="container">
					<div class="row form-group">
						<div class="col-md-12">
							<label for="email">E-mail</label>  
							<input class="form-control" name="email" id="email" type="text">
						</div>			
					</div>
					<div class="row form-group">
						<div class="col-md-12">
							<label for="senha">Senha</label>
							<input class="form-control" id="senha" name="senha" type="password">
						</div>			
					</div>	
					<div class="row form-group">		
						<div class="col-md-6"> 
							<a class="btn btn-outline-info float-left" href="loginEsqueceuSenha.php">Esqueci a senha</a>
						</div>												
						<div class="col-md-6"> 
							<button type="submit" class="btn btn-info float-right">Logar</button>	
						</div>											
					</div>	
				</div>
			</form >
		</div>	
	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript" src="js/login.js"></script>
    </body>
</html>