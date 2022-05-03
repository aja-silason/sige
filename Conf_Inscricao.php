<?php

	include_once("principal.php");
	//session_start();
	include_once("seguranca.php");
	include_once("conexao.php");

	$BI=$_POST['numeroBI'];
	$Recibo=$_POST['numeroRecibo'];
	$Turma=$_POST['turmaCandidato'];

	$sql = "SELECT * FROM `inscricao` WHERE numeroBI='$BI'";
	$resql = mysqli_query($conectar,$sql);
	$Resultado=mysqli_fetch_assoc($resql);
	$nome=$Resultado['nome'];
	$apelido=$Resultado['apelido'];
	$email=$Resultado['email'];
	$contacto=$Resultado['contacto'];
	$dataNascimento=$Resultado['dataNascimento'];
	$numeroBI=$Resultado['numeroBI'];
	$sexo=$Resultado['sexo'];
	$estadoCivil=$Resultado['estadoCivil'];
	$pais=$Resultado['pais'];
	$naturalidade=$Resultado['naturalidade'];
	$localResidencia=$Resultado['localResidencia'];
	$idNivelAcesso='4';
	$pai=$Resultado['pai'];
	$mae=$Resultado['mae'];
	$contactoEncarregado=$Resultado['contactoEncarregado'];
	$Classe=$Resultado['classe'];
	$Escola_Saida=$Resultado['Escola_Saida'];
	$Ano_Saida=$Resultado['Ano_Saida'];
	$Classe_frequentada=$Resultado['Classe_frequentada'];
	$Turma_frequentada=$Resultado['Turma_frequentada'];
	//Verificar se o recibo ja foi usado
	$sqlver = "SELECT * FROM `conf_inscricao` WHERE `Recibo` = '$Recibo'";
	$VerificarRecibo = mysqli_query($conectar,$sqlver); 
	
	$sqlverbi = "SELECT * FROM `conf_inscricao` WHERE `BI` = '$BI'";
	$VerificarBI = mysqli_query($conectar,$sqlverbi);

	if(!mysqli_num_rows($VerificarRecibo) > 0){
	
	$biresult = "SELECT * FROM tabela_Estudante WHERE (numeroBI = '$BI')";
	$BiResultado = mysqli_query($conectar,$biresult);
	
	if(mysqli_num_rows($BiResultado) > 0){

			$_SESSION['mensagem'] = "
													<p></p>
													<div class='divH'>
														<div class='alert alert-danger' role='alert'> 
															Estudante já existente no Sistema!
														</div>
												   	</div>
											   	";
		
			//Manda o usuario para a tela de cadastro
			header("Location: listar_inscricoes.php");
            }
	
	
		$verifica_email = "SELECT * FROM tabela_usuarios WHERE (email = '$email')";
		$email_resultado = mysqli_query($conectar,$verifica_email);
		if($email_resultado > 0){

			$_SESSION['mensagem'] = "
													<p></p>
													<div class='divH'>
														<div class='alert alert-danger' role='alert'> 
															E-mail já existente no Sistema. Por favor queira introduzir outro e-mail!
														</div>
												   	</div>
											   	";
		
			//Manda o usuario para a tela de cadastro
			header("Location: listar_inscricoes.php");
            }
			if($Estudante_resultado > 0){

			$_SESSION['mensagem'] = "
													<p></p>
													<div class='divH'>
														<div class='alert alert-danger' role='alert'> 
															Estudante já existente no Sistema!
														</div>
												   	</div>
											   	";
		
			//Manda o usuario para a tela de cadastro
			header("Location: listar_inscricoes.php");
            }else{

				//Inserindo os dados do formulario usercadastrar na tabela usuarios
				$sqlinse = "INSERT INTO tabela_usuarios (idUsuario, nome,senha, estado, idNivelAcesso , dataCadastro) VALUES ('$email', '$nome $apelido', MD5('1234'), 'Activo', 4, NOW())";
				$inserir = mysqli_query($conectar,$sqlinse);

				$sqlinse1 = "INSERT INTO tabela_estudante (idUsuario,idTurma, nome, apelido, email, contacto, dataNascimento, numeroBI, sexo, estadoCivil, pais, naturalidade, localResidencia,idNivelAcesso ,pai,mae,contactoEncarregado, dataCadastro) VALUES ('$email','$Turma','$nome','$apelido', '$email','$contacto', '$dataNascimento', '$BI', '$sexo', '$estadoCivil', '$pais', '$naturalidade', '$localResidencia', 4,'$pai','$mae','$contactoEncarregado', NOW())";
				$inserir1 = mysqli_query($conectar, $sqlinse1);
    
                
				$Id_Funcionario=$_SESSION['usuarioId'];
				$sqlinse2 = "INSERT INTO `conf_inscricao`(`BI`, `Recibo`, `Classe`, `Escola_Saida`, `Ano_Saida`, `Classe_frequentada`, `Turma_frequentada`,`Id_Funcionario`, `Data_Confirmacao`) VALUES ('$BI','$Recibo','$Classe','$Escola_Saida', '$Ano_Saida', '$Classe_frequentada', '$Turma_frequentada','$Id_Funcionario',NOW())";
                $inserir2 = mysqli_query($conectar,$sqlinse2);
                
				
				if($inserir&&$inserir1&&$inserir2){
					$sqlsql ="DELETE FROM `inscricao` WHERE numeroBI='$numeroBI'";
					$sql=mysqli_query($conectar,$sqlsql);
				$_SESSION['mensagem'] = "
													<p></p>
													<div class='divH'>
														<div class='alert alert-success' role='alert'>
															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> 
															Estudante <strong>$nome</strong> cadastrado com sucesso!
														</div>
												   	</div>";
				}else{
					$_SESSION['mensagem'] = "
													<p></p>
													<div class='divH'>
														<div class='alert alert-danger' role='alert'>
															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> 
															Estudante não cadastrado  ! ".mysql_error()."
														</div>
												   	</div>";
				}
				//Manda o usuario para a tela de login
				header("Location: listar_inscricoes.php");
				
			

		
		}
	}else{
   	$_SESSION['mensagem'] = "
													<p></p>
													<div class='divH'>
														<div class='alert alert-danger' role='alert'> 
															O recibo ja foi usado para fazer a inscricao!
														</div>
												   	</div>
											   	";
   }
?>
