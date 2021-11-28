<?php
require './model/Actividad.php';
require './controller/DataBaseConnection.php';
if( ! class_exists( 'AppController' ) ) :

	/**
	 * AppController
	 *
	 * @since 1.0.0
	 */
	class AppController {
	
		private static $instance;

	
		public static function instance(){
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		public function __construct() {
        
		}

		public static function init() {
			if (!isset($_SESSION)) session_start();
			if (isset($_POST['login']) && !isset($_COOKIE['user'])) { 
				$user = self::verifyLogin($_POST['username'], $_POST['password']);
				if (!$user) {
					header("Location: ./login.php");
					exit();
				}
				else {
					header("Location: ./index.php");
					exit();
				}
			}

			if (isset($_POST['register']) && !isset($_COOKIE['user'])) { 
				$user = self::register($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password']);
				if ($user) {
					header("Location: ./login.php");
					exit();
				}
				else {
					header("Location: ./sign-up.php");
					exit();
				}
			}
	
			if (isset($_POST['crearActividad'])) {
				self::crearActividad();
			}

			
			// No hay user y estamos en index.
			if (!isset($_COOKIE['user']) && strpos($_SERVER['REQUEST_URI'], "index.php") == true ) {
				header("Location: ./login.php");
				exit();
			}
			// No hay user y no estamos en login, para evitar un redirect infinito.
			if (isset($_COOKIE['user']) && strpos($_SERVER['REQUEST_URI'], "login.php") !== false) {
				
				header("Location: ./index.php");
				exit();
			}
			
			
		}

        public static function verifyLogin($username, $password) {
			$conn = DataBaseConnection::$connection;
			$sql = "SELECT * FROM ifpdb.usuarios WHERE id=? AND contraseña=?";
				$stmt = $conn->prepare($sql); 
				$stmt->bind_param("ss", $username, $password);
				$stmt->execute();
				$results = $stmt->get_result();
		
				if ($results->num_rows != 0 ) {
					$_SESSION['success-message'] = "You have logged in successfully";
					setcookie('user', $username, time()+60*30);
					$_COOKIE['user'] = $username;
					return true;
				}
				else {
					$_SESSION['error-message'] = "Usuario o Contraseña incorrecta";
					return false;
				}
        }

		public static function crearActividad() {
			$titulo = $_POST['titulo'];
			$fecha = $_POST['fecha'];
			$tipoDeActividad = $_POST['tipoDeActividad'];
			$ciudad = $_POST['ciudad'];
			$precio = $_POST['precio'];
			$fecha = date("Y-m-d",strtotime($fecha));

			$conn = DataBaseConnection::$connection;
			$sql = "INSERT INTO ifpdb.actividades (titulo, ciudad, fecha, precio, tipoDeActividad, usuario) VALUES (?, ?, ?, ?, ?, ?)";
			$stmt = $conn->prepare($sql); 
			$stmt->bind_param("ssssss", $titulo, $ciudad, $fecha, $precio, $tipoDeActividad, $_COOKIE['user']);
			$actividad = $stmt->execute();
			if ($actividad) {
				$_SESSION['success-message'] = "Actividad creada correctamente";
				return true;
			}
			else {
				$_SESSION['error-message'] = $stmt->error;
				return false;
			}
		}	

		public static function register($name, $email, $username, $password) {
				$conn = DataBaseConnection::$connection;
				$sql = "INSERT INTO ifpdb.usuarios (id, nombre, correo, contraseña) VALUES (?,?,?,?)";
				$stmt = $conn->prepare($sql); 
				$stmt->bind_param("ssss", $username, $name, $email, $password);
				$user = $stmt->execute();
				if ($user) {
					$_SESSION['success-message'] = "User created correctly. You can log in now.";
					return true;
				}
				else {
					$_SESSION['error-message'] = $stmt->error;
					return false;
				}
		}

		public static function getListaDeActividades() {
			$actividades = [];
			$conn = DataBaseConnection::$connection;
			$sql = "SELECT * FROM ifpdb.actividades WHERE usuario=?";
				$stmt = $conn->prepare($sql); 
				$stmt->bind_param("s", $_COOKIE['user']);
				$stmt->execute();
				$results = $stmt->get_result();
				if( $results->num_rows === 0 ) {
					return;
				}
				else {
					while($row = $results->fetch_assoc()) {
						$actividades[] = new Actividad($row['titulo'], $row['tipoDeActividad'], $row['fecha'], $row['ciudad'], $row['precio']);
				}
				return $actividades;
			}
		}

		public static function getNombreDeUsuarioById() {
			$conn = DataBaseConnection::$connection;
			$username = "";
			$sql = "SELECT nombre FROM ifpdb.usuarios WHERE id=?";
				$stmt = $conn->prepare($sql); 
				$stmt->bind_param("s", $_COOKIE['user']);
				$stmt->execute();
				$results = $stmt->get_result();
				if( $results->num_rows === 0 ) {
					return;
				}
				else {
					while($row = $results->fetch_assoc()) {
						$username = $row['nombre'];
				}
				return $username;
			}
		}
	}

	AppController::instance();

endif;