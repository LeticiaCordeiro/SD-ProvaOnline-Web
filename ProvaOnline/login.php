<?php
//head

include("head.php");

session_start();

  
  if(isset($_POST['Login']))
  {
    $login = $_POST['Login'];
		$senha = $_POST['Senha'];
	
    include("conexao.php");
	
		$SQL = "select usu_id, usu_email, usu_senha, usu_perfil, usu_ativo  from  usuario
				where usu_email='$login'";
		
		$resultado = mysqli_query($conexao, $SQL);
		
		if(mysqli_num_rows($resultado) == 0)
		{
			echo"<script>alert ('Login ou senha incorreto(a)!');
					window.location.href='login.php';</script>";
		} 
		else
		{
			/*Se chegou nesse ponto do codigo ,indica q o login esta correto, devemos verificar se a senha esta correta
			*/
			
			$linha=mysqli_fetch_object($resultado);
			$usu_id = $linha->usu_id;
			$usu_email = $linha->usu_email;
			$usu_senha = $linha->usu_senha;
			$usu_perfil = $linha->usu_perfil;
			$usu_ativo = $linha->usu_ativo;
			
			if($senha == $usu_senha)
			{
				$_SESSION['Logado'] = 'S';
				$_SESSION['email'] = $usu_senha;
				$_SESSION['id'] = $usu_id;
				$_SESSION['perfil'] = $usu_perfil;
			
				if($usu_ativo == 'S')
				{
					//redirecionar o usuario para a pagina restrita 

					header("Location:painel.php");
				}
				else
				{	
					echo"<script  charset='utf-8'>alert ('ATENÇÃO: Você ainda não tem permissão para acessar esta página.');
					window.location.href='login.php';</script>";
				}
				}
			else
			{
				
				echo"<script>alert('Login ou senha incorreto(a)!');
					window.location.href='login.php';</script>";
			}	  
		}
	}	
	else
	{

	?>

	
	</head>
	
	<body class="login-fundo">
		<div class="w3-container w3-margin-top">		
			<div class="w3-card-4 login-center login-card w3-white">
				<div class="w3-container w3-teal">
					<h2>Login</h2>
				</div>

				<form class="w3-container" method="POST" action="login.php"  >
					<p>
					<label>E-mail</label></p>
					<input class="w3-input" type="text" name="Login" id="email">
					<p>    
					<label>Senha</label></p> 
					<input class="w3-input" type="password" name="Senha" id="pwd">
					<p><button type="submit" class="w3-btn w3-block w3-teal">Enviar</button></p>
				</form>
			</div>
		</div>
	</body>
</html>
<?php
}
?>