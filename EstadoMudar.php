<?php
include_once("seguranca.php");
include_once("principal.php");
include_once("conexao.php");
	$idUsuario = $_GET['idUsuario'];
	$Estado = $_GET['Estado'];
	
	
	if($Estado==='Activo'){
		$query = "UPDATE tabela_usuarios SET estado = 'Desativado' WHERE tabela_usuarios.idUsuario = '$idUsuario'";
		$sql = mysqli_query($conectar,$query);
	}else{
		$query = "UPDATE tabela_usuarios SET estado = 'Avtivo' WHERE tabela_usuarios.idUsuario = '$idUsuario'";
		$sql = mysqli_query($conectar,$query);
	}
	if (mysqli_affected_rows() > 0 ){
		$_SESSION['mensagem'] ="
													<div class='col-md-9 col-md-offset-0'>
														<div class='alert alert-success' role='alert'>
															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
															Usuario foi activado com sucesso!
														</div>
												   	</div>
											   	";
			header("Location: listarUsuarios.php");
            
	}else{
		$_SESSION['mensagem'] ="
													<div class='col-md-9 col-md-offset-0'>
														<div class='alert alert-danger' role='alert'>
															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
															Operaҫão não efectuada!
														</div>
												   	</div>
											   	";
			header("Location: listarUsuarios.php");
	}
?>