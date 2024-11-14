<!DOCTYPE html>
<html lang="es">
<head>
	<title>libros entradas y salidas</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./css/main.css">
</head>
<body>
	<!-- SideBar -->
	<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				SEP <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>

			<?php
			session_start(); // Inicia la sesión
			// Incluir el archivo de conexión
			include('conexion.php');
			// Verificar si el usuario ha iniciado sesión
			if (!isset($_SESSION['id'])) {
				// Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
				header("Location: login.php");
				exit();
			}
			// Suponiendo que tienes el ID de usuario guardado en $_SESSION['id']
			$id = $_SESSION['id'];

			// Consulta para obtener los datos del usuario
			$sql = "SELECT nombre, usuario FROM usuarios WHERE id = $id";
			$resultado = $conexion->query($sql);

			if ($resultado->num_rows > 0) {
				// Obtener los datos del usuario y guardarlos en variables
				$fila = $resultado->fetch_assoc();
				$nombre = $fila["nombre"];
				$usuario = $fila["usuario"];
			} else {
				echo "No se encontraron resultados para el usuario con ID $idUsuario";
			}

			// Cerrar la conexión a la base de datos (opcional, dependiendo de la configuración del servidor)
			$conexion->close();
			?>		

			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="./assets/img/icon.jpg" alt="UserIcon">
					<figcaption class="text-center text-titles">
						<?php echo $nombre; ?>
					</figcaption>
					<figcaption class="text-center text-titles">
						<?php echo "Usuario: " . $usuario; ?>
					</figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="#!">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
						<a href="#!" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="home.php">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Inicio
					</a>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administracion <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="period.php"><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Visitas supervisor</a>
						</li>
						<li>
							<a href="subject.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Visitas de director </a>
						</li>
						<li>
							<a href="section.php"><i class="zmdi zmdi-graduation-cap zmdi-hc-fw"></i> Visitas ATP</a>
						</li>
						<li>
							<a href="salon.php"><i class="zmdi zmdi-font zmdi-hc-fw"></i> Libro entradas</a>
						</li>
						<li>
							<a href="validacion.php"><i class="zmdi zmdi-receipt"></i> Validacion y planificaion</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#!" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Ususarios <i class="zmdi zmdi-caret-down pull-right"></i>
					</a>
					<ul class="list-unstyled full-box">
						<li>
							<a href="admin.php"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Administrador</a>
						</li>
						<li>
							<a href="teacher.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Supervisor</a>
						</li>
						<li>
							<a href="student.php"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Directivo</a>
						</li>
						<li>
							<a href="representative.php"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Docente</a>
						</li>
					</ul>
				</li>
					</ul>
				</li>
			</ul>
		</div>
	</section>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
				<li>
					<a href="#!" class="btn-Notifications-area">
						<i class="zmdi zmdi-notifications-none"></i>
						<span class="badge">7</span>
					</a>
				</li>
				<li>
					<a href="#!" class="btn-search">
						<i class="zmdi zmdi-search"></i>
					</a>
				</li>
				<li>
					<a href="#!" class="btn-modal-help">
						<i class="zmdi zmdi-help-outline"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-font zmdi-hc-fw"></i>libros entradas y salidas<small> Registro</small></h1>
			</div>
			<p class="lead">Aquí podrás registrar los libros entradas y salidas. Completa la información requerida y asegúrate de proporcionar detalles precisos. ¡Gracias por tu colaboración!</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#new" data-toggle="tab">Nuevo registro</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="new">
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-md-10 col-md-offset-1">
									    <form method="POST">
											<?php
											include 'conexion.php'; // Incluye el archivo con la conexión a la base de datos
											// Verifica si se enviaron datos por el formulario
											if ($_SERVER["REQUEST_METHOD"] == "POST") {
												// Obtén los datos del formulario
												$ct = $_POST['nombre'];
												$circular_068 = $_POST['circular_068'];
												$aplica_068 = $_POST['aplica_068'];
												$observaciones = $_POST['observaciones'];

												// Prepara la consulta SQL para insertar datos en la base de datos
												$sql = "INSERT INTO libro_entrada_salida (nombre, cuenta_circular, aplica_circular, Observaciones) 
														VALUES ('$ct', '$circular_068', '$aplica_068', '$observaciones')";

												if ($conexion->query($sql) === TRUE) {
													echo "Datos guardados correctamente.";
												} else {
													echo "Error al guardar los datos: " . $conexion->error;
												}
											}
											// Cierra la conexión
											$conexion->close();
											?>

											<?php
											// Verifica el inicio de sesión
											if ($usuario) {
											$_SESSION['nombre'] = $nombre; // Guarda el CT en la sesión
											// Redirige a la página principal o a donde sea necesario
											}
											?>

										<div class="form-group label-floating">
											<label class="control-label">Nombre:</label>
											<input class="form-control" type="text" name="nombre" value="<?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''; ?>" readonly>
										</div>
										<div class="form-group">
											<label class="control-label">Cuenta con la circular 068:</label>
											<select class="form-control" name="circular_068">
											<option value="Si">Si</option>
											<option value="No">No</option>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Aplica con la circular 068:</label>
											<select class="form-control" name="aplica_068">
											<option value="Si">Si</option>
											<option value="No">No</option>
											</select>
										</div>
										<div class="form-group label-floating">
											<label class="control-label">Observaciones</label>
											<input class="form-control" type="text" name="observaciones">
										</div>
										<p class="text-center">
											<button type="submit" class="btn btn-info btn-raised btn-sm">
											<i class="zmdi zmdi-floppy"></i> Guardar
											</button>
										</p>
									    </form>
									</div>
								</div>
							</div>
						</div>
					  	<div class="tab-pane fade" id="list">
							<div class="table-responsive">
								<table class="table table-hover text-center">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">CT</th>
											<th class="text-center">Cuenta con la circular 068</th>
											<th class="text-center">Aplica con la circular 068</th>
											<th class="text-center">Observaciones</th>
											<th class="text-center">Modificar</th>
											<th class="text-center">Eliminar</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>21030214</td>
											<td>si</td>
											<td>si</td>
											<td>ninguna</td>
											<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
											<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
										</tr>
									</tbody>
								</table>
								<ul class="pagination pagination-sm">
								  	<li class="disabled"><a href="#!">«</a></li>
								  	<li class="active"><a href="#!">1</a></li>
								  	<li><a href="#!">2</a></li>
								  	<li><a href="#!">3</a></li>
								  	<li><a href="#!">4</a></li>
								  	<li><a href="#!">5</a></li>
								  	<li><a href="#!">»</a></li>
								</ul>
							</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Notifications area -->
	<section class="full-box Notifications-area">
		<div class="full-box Notifications-bg btn-Notifications-area"></div>
		<div class="full-box Notifications-body">
			<div class="Notifications-body-title text-titles text-center">
				Notificaciones <i class="zmdi zmdi-close btn-Notifications-area"></i>
			</div>
			<div class="list-group">
			  	<div class="list-group-item">
				    <div class="row-action-primary">
				      	<i class="zmdi zmdi-alert-triangle"></i>
				    </div>
				    <div class="row-content">
				      	<div class="least-content">17m</div>
				      	<h4 class="list-group-item-heading">Visita ATP</h4>
				      	<p class="list-group-item-text">No ah realizado la visita </p>
				    </div>
			  	</div>
			</div>

		</div>
	</section>

	<!-- Dialog help -->
	<div class="modal fade" tabindex="-1" role="dialog" id="Dialog-Help">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			  <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <h4 class="modal-title">Ayuda</h4>
			  </div>
			  <div class="modal-body">
				  <p>
					  ¿Necesitas ayuda? ¡Estamos aquí para ayudarte! No dudes en contactarnos si tienes alguna pregunta o problema. Estamos comprometidos a brindarte la mejor asistencia posible.
				  </p>
			  </div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> Ok</button>
				</div>
		  </div>
		</div>
  </div>
	<!--====== Scripts -->
	<script src="./js/jquery-3.1.1.min.js"></script>
	<script src="./js/sweetalert2.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/material.min.js"></script>
	<script src="./js/ripples.min.js"></script>
	<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		$.material.init();
	</script>
</body>
</html>