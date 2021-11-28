

<?php
if( ! class_exists( 'DataBaseConnection' ) ) :

	/**
	 * DataBaseConnection
	 *
	 * @since 1.0.0
	 */
	class DataBaseConnection {
        
        const SERVER_NAME = "127.0.0.1";
		const USER_NAME = "root";
		const PASSWORD = "";
		const DATABASE_NAME = "ifpdb";

		public static $connection;
		private static $instance;

	
		public static function instance(){
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		public function __construct() {
			// Create connection
			self::$connection = mysqli_connect(self::SERVER_NAME, self::USER_NAME, self::PASSWORD);

			// Check connection
			if (!self::$connection) {
			die("Connection failed: " . mysqli_connect_error());
			}
			echo "Connected successfully";
		}
	}

	DataBaseConnection::instance();

endif;

