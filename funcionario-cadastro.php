 <?php
	include_once("principal.php");
?>
<?php
				if(isset($_SESSION['mensagem'])){
					echo $_SESSION['mensagem'];
					unset($_SESSION['mensagem']);
				}
			?>
			
<div class="container-fluid">
<div class="row-fluid">
<div class="col col-lg-H col-md-H col-sm-H haggy">
	
    <div class="panel panel-default panel-table">
        <div class="panel-heading" >
			   
			<p>	              	
	            <div class="divH"><label>Formulario de Cadastro do Funcionario</label></div>  
	        </p> 
		</div>
		<div class="panel-body">
          <form class="form-horizontal" name="cadastrarfuncionario" method="POST" >
          <div class="form-group">
				<div class="col-sm-9">
				</div>
			  </div>
		  		
			<div class="col-sm-12">
			  <div class="form-group">
				
				<div class="col-sm-4">
				Nome:
				  <input type="text" class="input-sm form-control" name="nomeCandidato" maxlength="40" placeholder="Nome Completo" required="" >
				</div>
				<div class="col-sm-4">
				Apelido:
				  <input type="text" class="input-sm form-control" name="apelidoCandidato" maxlength="40" placeholder="Apelido" required="" >
				</div>
				<div class="col-sm-4">
				Número de BI:
				  <input type="text" class="input-sm form-control" name="biCandidato" maxlength="13" placeholder="Número de BI" required="">
				</div>
			  </div>
			</div>
         
          <div class="col-sm-12">
			  <div class="form-group">
			  <div class="col-sm-4">
				E-mail:
				  <input type="email" class="input-sm form-control" name="emailCandidato" maxlength="50" placeholder="E-mail" required="">
				</div>
			  <div class="col-sm-4">
				Contacto:
				  <input type="text" class="input-sm form-control"  name="contactoCandidato" maxlength="9" placeholder="Contacto" required="">
				</div>
				<div class="col-sm-4">
				Data de Nascimento:
				<?php   
					$anominimo=Date("Y")-70;
					$anomax=Date('Y')-18;
				?>
				  <input type="Date" class="input-sm form-control" name="dataCandidato" placeholder="Ex: <?php echo Date("Y-m-d");?> " Min="$anominimo-01-01" Max="$anomax-01-01" required="">
				</div>
				
			  </div>
			</div>
         
          <div class="col-sm-12">
			  <div class="form-group">
			  
			  <div class="col-sm-4">
				Sexo:
				  <select class="input sm form-control" name="sexoCandidato" required="">
				  	<option value="">Selecione aqui</option>
					  <option value="Masculino">Masculino</option>
					  <option value="Femenino">Femenino</option>
					  
					</select>
				</div>
				<div class="col-sm-4">
				Estado civil:
				  <select class="input sm form-control" name="estadocivilCandidato" required="">
				  	<option value="">Selecione aqui</option>
					  <option value="Casado/a">Casado/a</option>
					  <option value="Solteiro/a">Solteiro/a</option>
					  
					</select>
				</div>
				<div class="col-sm-4">
				País:
				  
				  <select class="input sm form-control" name="paisCandidato" required="">
				  	<option value="">Selecione aqui</option>
					  <option value="Casado/a">Moçambique</option>
					  <option value="Solteiro/a">Zimbabwe</option>
					  <option value="Solteiro/a">Africa do sul</option>
					</select>
				</div>
				
			  </div>
			</div>
          
          <div class="col-sm-12">
			  <div class="form-group">
			  
			 
			  <div class="col-sm-4">
				Naturalidade:
				  <input type="text" class="input-sm form-control" name="naturalidadeCandidato" maxlength="30" placeholder="Naturalidade" required="">
				</div>
			  
			  <div class="col-sm-4">
				Local de Residencia:
				  <input type="text" class="input-sm form-control" name="localCandidato" maxlength="30" placeholder="Bairro" required="">
				</div>
				
			  </div>
			</div>
          
          
				<div class="col-sm-6 col col-xs-6 text-left">
				  <button type='button' onclick="Voltar()" class='btn  btn-info'><span class="glyphicon glyphicon-remove"></span>Cancelar</button>
				</div>
				<div class="col-sm-6 col col-xs-6 text-right"> 
				  <button type="submit" name="cadastrarfuncionario" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Gravar</button>
				</div>
				</form>
</div>
</div>
</div>
</div>
</div>
    
    <?php 

if(isset ($_POST['cadastrarfuncionario'])){
    
    
    $nome = $_POST['nomeCandidato'];
    $apelido = $_POST['apelidoCandidato'];
    $email = $_POST['emailCandidato'];
    $contacto = $_POST['contactoCandidato'];
    $dob = $_POST['dataCandidato'];
    $bi = $_POST['biCandidato'];
    $sexo = $_POST['sexoCandidato'];
    $estado = $_POST['estadocivilCandidato'];
    $pais = $_POST['paisCandidato'];
    $naturalidade = $_POST['naturalidadeCandidato'];
    $Bairro = $_POST['localCandidato'];
   
    
    //Verificando os usuários já existentes na Base de Dados
	//Para evitar a duplicação dos dados 
	$verifica_nome = "SELECT * FROM funcionario WHERE (nome = '$nome_resultado')";
	$verifica_funcionario = "SELECT * FROM funcionario WHERE (BI = '$bi')";
	$verifica_funcionario1 = "SELECT * FROM funcionario WHERE (numeroCandidato = '$numerocandidato')";
	$nome_resultado = mysqli_query($conectar,$verifica_nome);
	$funcionario_resultado = mysqli_query($conectar,$verifica_funcionario);
	$funcionario_resultado1 = mysqli_query($conectar,$verifica_funcionario1);
	if(mysqli_num_rows($funcionario_resultado) > 0){

			$_SESSION['mensagem'] = "
													<p></p>
													<div class='divH'>
														<div class='alert alert-danger' role='alert'> 
															Funcionario já existente no Sistema!
														</div>
												   	</div>
											   	";
		
			//Manda o usuario para a tela de cadastro
			header("Location: funcionario-cadastro.php");
            }
	if(mysqli_num_rows($funcionario_resultado1) > 0){

			$_SESSION['mensagem'] = "
													<p></p>
													<div class='divH'>
														<div class='alert alert-danger' role='alert'> 
															Funcionario já existente no Sistema!
														</div>
												   	</div>
											   	";
		
			//Manda o usuario para a tela de cadastro
			header("Location: funcionario-cadastro.php");
            }
	if(mysqli_num_rows($nome_resultado) > 0){
		
			$_SESSION['mensagem'] = "	<div class='form-group'>
																<p></p>
													<div class='divH'>
														<div class='alert alert-danger' role='alert'> 
															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> 
															Funcionario já existente no Sistema!
														</div>
												   	</div>
											   	</div>";
		
			//Manda o usuario para a tela de cadastro
			header("Location: funcionario-cadastro.php");
	}
	else{
		$verifica_email = "SELECT * FROM tabela_usuarios WHERE (email = '$emailcandidato')";
		$email_resultado = mysql_query($verifica_email);
		if(mysqli_num_rows($email_resultado) > 0){

			$_SESSION['mensagem'] = "
													<p></p>
													<div class='divH'>
														<div class='alert alert-danger' role='alert'> 
															E-mail já existente no Sistema. Por favor queira introduzir outro e-mail!
														</div>
												   	</div>
											   	";
		
			//Manda o usuario para a tela de cadastro
			header("Location: funcionario-cadastro.php");
            }
			if(mysqli_num_rows($funcionario_resultado) > 0){

			$_SESSION['mensagem'] = "
													<p></p>
													<div class='divH'>
														<div class='alert alert-danger' role='alert'> 
															Funcionario já existente no Sistema!
														</div>
												   	</div>
											   	";
		
			//Manda o usuario para a tela de cadastro
			header("Location: funcionario-cadastro.php");
            }else{

			if($senha === $confirmacao){

				$senha = md5($_POST["senha"]);

				//Inserindo os dados do formulario usercadastrar na tabela usuarios
				$slqinserir ="INSERT INTO funcionario (idUsuario,nome, apelido, email, contacto, dob, BI, sexo, estado, pais, naturalidade, Bairro, dataCadastro) VALUES ('$email','$nome','$apelido', '$email','$contacto', '$dob', '$bi', '$sexo', '$estado', '$pais', '$naturalidade', '$Bairro', NOW())"; 
				$inserir = mysqli_query($conectar,$slqinserir);
				
				
				//Select na tabela funcionario para buscar o ID
				
                  
				$sqlins1 ="INSERT INTO tabela_usuarios (idUsuario, nome,senha, estado, idNivelAcesso , dataCadastro) VALUES ('$email', '$nome $apelido', MD5('1234'), 'Activo', '2', NOW())";
                $inserir1 = mysqli_query($conectar, $sqlins1);
                
				$confirmacao = mysqli_query($conectar, $query);
				if ($inserir && $inserir1){
					$_SESSION['mensagem'] = "
													<p></p>
													<div class='divH'>
														<div class='alert alert-success' role='alert'>
															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> 
															Funcionario <strong>$nome $apelido</strong> cadastrado com sucesso!
														</div>
												   	</div>";
				}else{
					$_SESSION['mensagem'] = "
													<p></p>
													<div class='divH'>
														<div class='alert alert-danger' role='alert'>
															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> 
															Funcionario não cadastrado ! ".mysql_error()."
														</div>
												   	</div>";
				}
				
		
				//Manda o usuario para a tela de login
				header("Location: funcionario-listar.php");
				
			}
		
		}
	}
    
    

    
    
}



?>
    
<?php
	include_once("rodape.php");
?>