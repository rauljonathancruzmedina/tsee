<?php

class ControladorSoporte{

	/*=============================================
					NUEVO TICKET
	=============================================*/
	
	public function ctrCrearTicket(){

		if(isset($_POST["msj"])){

			//$url = ControladorGeneral::ctrRuta();

			if(preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["asunto"]) &&
				preg_match('/^[\/\=\\&\\;\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["msj"])){

				$adjuntosMsj = array();

				if($_POST["adjuntos"] != ""){

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LOS ARCHIVOS DEL TICKET
					=============================================*/

					$directorio = "vistas/img/msj/".$_POST["remitente"];
					
					/*=============================================
					PREGUNTAMOS PRIMERO SI NO EXISTE EL DIRECTORIO PARA CREARLO
					=============================================*/

					if(!file_exists($directorio)){	

						mkdir($directorio, 0755);

					}


					$adjuntos = json_decode($_POST["adjuntos"], true);
					
					foreach ($adjuntos as $key => $value) {
						
						$separarAdjunto = explode(";", $value);
						
						$separarBase64 = explode(",", $separarAdjunto[1]);					
						if($separarAdjunto[0] == "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $separarAdjunto[0] == "data:application/vnd.ms-excel"){						
							$aleatorio = mt_rand(1,999);

							$ruta = $directorio."/".$aleatorio.".xlsx";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosMsj, $ruta);

						}

						else if($separarAdjunto[0] == "data:application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $separarAdjunto[0] == "data:application/msword"){
							
							$aleatorio = mt_rand(1,999);

							$ruta = $directorio."/".$aleatorio.".docx";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosMsj, $ruta);
							
						}

						else if($separarAdjunto[0] == "data:application/pdf"){

							$aleatorio = mt_rand(1,999);

							$ruta = $directorio."/".$aleatorio.".pdf";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosMsj, $ruta);
							
						}

						else if($separarAdjunto[0] == "data:image/jpeg"){

							$aleatorio = mt_rand(1,999);

							$ruta = $directorio."/".$aleatorio.".jpg";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosMsj, $ruta);
						
						}

						else if($separarAdjunto[0] == "data:image/png"){

							$aleatorio = mt_rand(1,999);

							$ruta = $directorio."/".$aleatorio.".png";

							$archivo = base64_decode($separarBase64[1]);

							file_put_contents($ruta, $archivo);

							array_push($adjuntosMsj, $ruta);
					
						}

						else{

							echo'<script>

								Swal.fire({
										type:"error",
										icon: "error",
									  	title: "Oops...!",
									  	text: "¡No se permiten formatos diferentes a JPG, PNG, EXCEL, WORD o PDF!",
									  	showConfirmButton: true,
										confirmButtonText: "Cerrar"
									  
								}).then(function(result){

										if(result.value){   
										    window.location = "soporte";
										  } 
								});

							</script>';

						}
						
					}//Finaliza el foreach de archivos adjuntos

				}//Finaliza condición cuando no hay adjuntos

				/*=============================================
				 Enviamos info del ticket al modelo
				=============================================*/

				$tabla = "soporte";

				if(is_array($_POST["receptor"])){

					/*=============================================
					Enviar ticket a todos los usuarios por parte del administrador
					=============================================*/

					if ($_POST["receptor"][0] == 0) {
						
						$listaUsuarios = ControladorUsuarios::ctrMostrarUsuarios(null,null);

						foreach ($listaUsuarios as $key => $value) {
							
							if($key != 0){

									$datos = array("remitente"=>$_POST["remitente"], 
												   "receptor"=>$value["id"],
												   "asunto"=>$_POST["asunto"],
												   "mensaje"=>$_POST["msj"],
												   "adjuntos"=>json_encode($adjuntosMsj),
												   "tipo"=>"enviado");

									$respuesta = ModeloSoporte::mdlCrearMsj($tabla, $datos);

							}

						}

					}else{

						/*=============================================
						Enviar ticket a algunos usuarios por parte del administrador
						=============================================*/

						foreach ($_POST["receptor"] as $key => $value) {

							$datos = array("remitente"=>$_POST["remitente"], 
										   "receptor"=>$_POST["receptor"][$key],
										   "asunto"=>$_POST["asunto"],
										   "mensaje"=>$_POST["msj"],
										   "adjuntos"=>json_encode($adjuntosMsj),
										   "tipo"=>"enviado");

							$respuesta = ModeloSoporte::mdlCrearMsj($tabla, $datos);
					
						}

					}


				}else{

					/*=============================================
					Enviar ticket de usuario a administrador
					=============================================*/

					$datos = array("remitente"=>$_POST["remitente"], 
								   "receptor"=>$_POST["receptor"],
								   "asunto"=>$_POST["asunto"],
								   "mensaje"=>$_POST["msj"],
								   "adjuntos"=>json_encode($adjuntosMsj),
								   "tipo"=>"enviado");

					$respuesta = ModeloSoporte::mdlCrearMsj($tabla, $datos);

				}

				if($respuesta == "ok"){

					//notificaciones = "tipo:soporte", "id_user_not:is_array($_POST["receptor"]"

					echo'<script>

						Swal.fire({
								type:"success",
								icon: "success",
							  	title: "¡SU MENSAJE HA SIDO CORRECTAMENTE ENVIADO!",
							  	text: "¡Muy pronto nos comunicaremos con usted!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    window.location = "soporte";
								  } 
						});

					</script>';

				}				

			}else{

				echo'<script>

					Swal.fire({
							type:"error",
							icon: "error",
						  	title: "Oops...!",
						  	text: "¡No se permiten caracteres especiales en ninguno de los campos.!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
					}).then(function(result){

							if(result.value){   
							    window.location = "soporte";
							  } 
					});

				</script>';

			}

		}

	}

	/*=============================================
	Mostrar ticket
	=============================================*/

	public function ctrMostrarTickets($item, $valor){

		$tabla = "soporte";

		$respuesta = ModeloSoporte::mdlMostrarTickets($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Actualizar ticket
	=============================================*/

	static public function ctrActualizarTicket($id, $item, $valor){

		$tabla = "soporte";

		$respuesta = ModeloSoporte::mdlActualizarTicket($tabla, $id, $item, $valor);

		return $respuesta;
		
	}


}


