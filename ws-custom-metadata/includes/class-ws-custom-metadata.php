<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       wordsaladcoop@gmail.com
 * @since      1.0.0
 *
 * @package    Ws_Custom_Metadata
 * @subpackage Ws_Custom_Metadata/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ws_Custom_Metadata
 * @subpackage Ws_Custom_Metadata/includes
 * @author     Word Salad <wordsaladcoop@gmail.com>
 */
class Ws_Custom_Metadata {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ws_Custom_Metadata_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		if ( defined( 'WS_CUSTOM_METADATA_VERSION' ) ) {
			$this->version = WS_CUSTOM_METADATA_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'ws-custom-metadata';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		add_action( 'admin_menu', array( $this, 'ws_add_admin_pages' ) );
		add_action( 'show_user_profile', array( $this, 'salad_add_custom_user_profile_fields' ) );
		add_action( 'edit_user_profile', array( $this, 'salad_add_custom_user_profile_fields' ) );
		add_action( 'personal_options_update', array( $this, 'salad_save_custom_user_profile_fields' ) );
		add_action( 'edit_user_profile_update', array( $this, 'salad_save_custom_user_profile_fields' ) );

	}

	/**
	 * add custom meta feilds to profile page per user
	 */
	public function salad_add_custom_user_profile_fields( $user ) {
	
		$all_meta = get_user_meta($user->ID, '', false);
	?>
		<h3><?php _e('Extra Profile Information', 'your_textdomain'); ?></h3>
	
		<table class="form-table">
		<?php foreach ($all_meta as $key => $value) { 
			if (strpos($key, 'salad_') !== false) {
				$key = str_replace('salad_', '', $key);
		?>
				<tr>
					<th><label for="<?php echo $key ?>"><?php _e("$key", 'your_textdomain'); ?></label></th>
					<td>
						<input type="text" name="<?php echo $key ?>" id="<?php echo $key ?>" value="<?php echo $value[0] ?>" class="regular-text" /><br />
						<span class="description"><?php _e("Update $key", 'your_textdomain'); ?></span>
					</td>
				</tr>
			<?php 
			} ?>
		<?php 
		} ?>
		</table>
	<?php 
	}

	/**
	 * save custom meta fields on user profile "save"
	 */
	function salad_save_custom_user_profile_fields( $user_id ) {
		
		if ( !current_user_can( 'edit_user', $user_id ) ) {
			return FALSE;
		} else {
			$all_meta = get_user_meta($user_id, '', false);
		
			foreach ($all_meta as $key => $value) { 
				if (strpos($key, 'salad_') !== false) {
					$key = str_replace('salad_', '', $key);
					update_usermeta( $user_id, 'salad_' . "$key", $_POST["$key"] );
				}
			}
		}
	}

	/**
	 * Render admin page.
	 */
	public function ws_add_admin_pages() {
		add_menu_page( 'WS Custom Metadata', 'WS Custom Metadata', 'manage_options', 'ws_custom_metadata', array( $this, 'ws_admin_index' ), '', null);
	}

	/**
	 * Provide admin page template to the function above
	 */
	public function ws_admin_index() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/templates/index.php';
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ws_Custom_Metadata_Loader. Orchestrates the hooks of the plugin.
	 * - Ws_Custom_Metadata_i18n. Defines internationalization functionality.
	 * - Ws_Custom_Metadata_Admin. Defines all hooks for the admin area.
	 * - Ws_Custom_Metadata_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ws-custom-metadata-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ws-custom-metadata-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ws-custom-metadata-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ws-custom-metadata-public.php';

		$this->loader = new Ws_Custom_Metadata_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ws_Custom_Metadata_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Ws_Custom_Metadata_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Ws_Custom_Metadata_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Ws_Custom_Metadata_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Ws_Custom_Metadata_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
