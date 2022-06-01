<html>
    <head>
		<meta charset="utf-8">
		<title>Login</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/estilo.css"/>	
    </head>

    <body>	

		<div class="container mt-5">
			<h5 >Recuperação de senha</h5>
			<form id="formLogin" class="mt-5" action="loginRecuperar.php" method="post">
				<div class="container">
					<div class="row form-group">
						<div class="col-md-12">
							<label for="email">E-mail</label>  
							<input class="form-control" name="email" id="email" type="text">
						</div>			
					</div>
					<div class="row form-group">
						<div class="col-md-12">
							<label for="CPF">CPF</label>
							<input class="form-control" id="CPF" name="CPF" type="text">
						</div>			
					</div>	
					<div class="row form-group">												
						<div class="col-md-12"> 
							<button type="submit" class="btn btn-success float-right">Recuperar senha</button>	
						</div>											
					</div>	
				</div>
			</form >
		</div>	
	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery.mask.js"></script>			
		<script type="text/javascript" src="js/loginEsqueceuSenha.js"></script>
    </body>
</html>