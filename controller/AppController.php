<?php
require './model/Actividad.php';
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
			if (isset($_POST['login'])) { 
				self::verifyLogin($_POST['username'], $_POST['password']);
			}
	
			if (isset($_POST['crearActividad'])) {
				self::crearActividad();
			}
			// No hay user y estamos en index.
			if (!isset($_COOKIE['user']) && strpos($_SERVER['REQUEST_URI'], "index.php") == true ) {
				echo "true";
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
			global $error;
			$error = false;
            if ($username == 'ifp' && $password == 2021) {
               setcookie('user', 'ifp', time()+60*30);
			   $_COOKIE['user'] = 'ifp';
                return true;
            } else {
				$error = true;
                return false;
            }
        }

		public static function crearActividad() {
			if (!isset($_SESSION['actividades'])) $_SESSION['actividades'] = [];
			$titulo = $_POST['titulo'];
			$tipoDeActividad = $_POST['tipoDeActividad'];
			$fecha = $_POST['fecha'];
			$ciudad = $_POST['ciudad'];
			$precio = $_POST['precio'];
			$actividad = new Actividad($titulo, $tipoDeActividad, $fecha, $ciudad, $precio);
			$_SESSION['actividades'][] = $actividad;
		}	

	}

	AppController::instance();

endif;

