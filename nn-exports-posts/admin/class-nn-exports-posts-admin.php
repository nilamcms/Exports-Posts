<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       NN Exports Posts
 * @since      1.0.0
 *
 * @package    Nn_Exports_Posts
 * @subpackage Nn_Exports_Posts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nn_Exports_Posts
 * @subpackage Nn_Exports_Posts/admin
 * @author     cmsMinds  <nilam@cmsminds.com>
 */
class Nn_Exports_Posts_Admin {

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

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Nn_Exports_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nn_Exports_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nn-exports-posts-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Nn_Exports_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nn_Exports_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nn-exports-posts-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register exports button for the post admin area.
	 *
	 * @since    1.0.0
	 */
	public function nn_admin_post_list_add_export_button( $which ) {

		    global $typenow;

		    if ( 'post' === $typenow && 'top' === $which ) {
		        ?>
		        <input type="submit" name="export_all_posts" class="button button-primary" value="<?php _e('Export All Posts'); ?>" />
		        <?php
		    }
	}

	/**
	 * Register the post exports function for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function nn_func_export_all_posts( $which ) {

	 if(isset($_GET['export_all_posts'])) {
        
	        $arg = array(
	            'post_type' => 'post',
	            'post_status' => 'publish',
	            'posts_per_page' => -1,
	        );
	 
	        global $post;

	        // Get the Posts Data
	        $arr_post = get_posts($arg);

	      	if ($arr_post) {
	            

	           header('Content-type: text/csv');
	           header('Content-Disposition: attachment; filename="nn-wp-posts.csv"');
	           header('Pragma: no-cache');
	           header('Expires: 0');
	 
	            $file = fopen('php://output', 'w');
	 
	 			// Put the titles in csv file 
	            fputcsv($file, array('Post Title', 'URL','Post Image URL','Categories', 'Tags','Post Dates','Post Content','Author','Status'));


	 			// Get Cateogries 
	            foreach ($arr_post as $post) {

	                 setup_postdata($post);
	                
	                $categories = get_the_category();
	                $cats = array();
	                if (!empty($categories)) {
	                    foreach ( $categories as $category ) {
	                        $cats[] = $category->name;
	                    }
	                }

	 			  // Get Tags 
	                $post_tags = get_the_tags();
	                $tags = array();
	                if (!empty($post_tags)) {
	                    foreach ($post_tags as $tag) {
	                        $tags[] = $tag->name;
	                    }
	                }

	 			// Write data in File
	               fputcsv($file, array(get_the_title(), get_the_permalink(), get_the_post_thumbnail_url(get_the_ID()),implode(",", $cats), 
	                   implode(",", $tags),get_the_date(), get_the_content(),get_the_author_meta('display_name'),get_post_status()));

	            } // End foreach
	 
	            exit();

	        } //Endif

    	} //Endif

	} //End Function

} //End Class
