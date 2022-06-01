
	<?php
		session_start();

		if(isset($_SESSION['USUARIO'])){
			echo "<script>location.href='principal.php';</script>"; 	
		}else{
			echo "<script>location.href='login.php';</script>"; 	
		}
	?>