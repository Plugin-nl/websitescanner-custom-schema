<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://timvaniersel.com/en/
 * @since      1.0.0
 *
 * @package    Websitescanner_Custom_Schema
 * @subpackage Websitescanner_Custom_Schema/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Websitescanner_Custom_Schema
 * @subpackage Websitescanner_Custom_Schema/admin
 * @author     Tim van Iersel <tim@websitescanner.io>
 */
class Websitescanner_Custom_Schema_Post_Editor {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/websitescanner-custom-schema-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/websitescanner-custom-schema-admin.js', array( 'jquery' ), $this->version, true );

	}

	public function add_metabox(){
		$screens = array( 'post', 'page' );
		foreach ( $screens as $screen ) {
				add_meta_box(
						'websitescanner-custom-schema',
						'Websitescanner Custom Schema',
						array($this, 'display_post_editor_settings'),
						$screen,
						'advanced'
				);
		}
	}

	public function display_post_editor_settings() {
				wp_nonce_field( plugin_basename( __FILE__ ), 'websitescanner_custom_schema_nonce' );
				include_once( 'partials/websitescanner-custom-schema-post-editor-display.php' );
	}

	public function options_update() {
			if (isset($_POST[$this->plugin_name])){
				$data = $this->validate($_POST[$this->plugin_name]);
				//var_dump($data);
				if ($data) {
					update_post_meta( get_the_ID(), 'websitescanner_custom_schema_post_data', $data );
				}
			}

	 }
	public function validate($input) {
		//var_dump($input);
			// check if this isnt an auto save
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
					return;
			// security check
			if ( isset($_POST['websitescanner_custom_schema_nonce']) && !wp_verify_nonce( $_POST['websitescanner_custom_schema_nonce'], plugin_basename( __FILE__ ) ) )
					return;

	    $valid = array();
	    //Cleanup
			//does it exist?
			if(isset($input['custom_schema_0'])){
				//is it not empty  and is it truly JSON?
				if (!empty($input['custom_schema_0'])) {
					$valid['custom_schema_0'] = wp_slash(json_encode($input['custom_schema_0']));
				}else{
					$valid['custom_schema_0'] = "";
				}
			}
			if(isset($input['custom_schema_1'])){
				if (!empty($input['custom_schema_1'])) {
					$valid['custom_schema_1'] = wp_slash(json_encode($input['custom_schema_1']));
				}else{
					$valid['custom_schema_1'] = "";
				}
			}
			if(isset($input['custom_schema_2'])){
				if (!empty($input['custom_schema_2'])) {
					$valid['custom_schema_2'] = wp_slash(json_encode($input['custom_schema_2']));
				}else{
					$valid['custom_schema_2'] = "";
				}
			}

	    return $valid;
	 }

	 public function is_json_decode($string) {
		 json_decode($string);
		 return (json_last_error() == JSON_ERROR_NONE);
		}

		public function is_json_encode($string) {
			json_decode($string);
			return (json_last_error() == JSON_ERROR_UTF8);
			}
}
