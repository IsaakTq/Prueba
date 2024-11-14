<!DOCTYPE html>
<html lang="es">
<head>
	<title>Visitas del supervisor de zona</title>
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
				SEP<i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>

			<?php
			session_start(); // Inicia la sesión
			// Incluir el archivo de conexión
			include('conexion.php');
			// Verificar si el usuario ha iniciado sesión
			if (!isset($_SESSION['id'])) {
				// Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
				header("Location: index.php");
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
			  <h1 class="text-titles"><i class="zmdi zmdi-timer zmdi-hc-fw"></i> Visitas del supervisor de zona  <small>Registro</small></h1>
			</div>
			<p class="lead">Aquí podrás registrar las visitas del supervisor de zona. Completa la información requerida y asegúrate de proporcionar detalles precisos. ¡Gracias por tu colaboración!</p>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li><a href="#list" data-toggle="tab">Lista de registro</a></li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<?php
						// Incluir el archivo de conexión
						include 'conexion.php';
						// Consulta SQL
						$sql = "SELECT id, nombre, Proposito, Fecha, Horario, HorarioSalida, Evidencia FROM visitas_supervisor";
						$result = $conexion->query($sql);
						?>
						<div class="tab-pane fade" id="list">
							<div class="table-responsive">
								<table class="table table-hover text-center">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">CT</th>
											<th class="text-center">Proposito</th>
											<th class="text-center">Fecha</th>
											<th class="text-center">Horario de entrada</th>
											<th class="text-center">Horario de salida</th>
											<th class="text-center">Evidencia:</th>
											<th class="text-center">Modificar</th>
											<th class="text-center">Eliminar</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if ($result->num_rows > 0) {
											// Salida de datos de cada fila
											while($row = $result->fetch_assoc()) {
												echo "<tr>";
												echo "<td>" . $row["id"] . "</td>";
												echo "<td>" . $row["nombre"] . "</td>";
												echo "<td>" . $row["Proposito"] . "</td>";
												echo "<td>" . $row["Fecha"] . "</td>";
												echo "<td>" . $row["Horario"] . "</td>";
												echo "<td>" . $row["HorarioSalida"] . "</td>";
												echo "<td>" . $row["Evidencia"] . "</td>";
												echo '<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>';
												echo '<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>';
												echo "</tr>";
											}
										} else {
											echo "<tr><td colspan='9'>No hay datos disponibles</td></tr>";
										}
										?>
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
						<?php
						$conexion->close();
						?>
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