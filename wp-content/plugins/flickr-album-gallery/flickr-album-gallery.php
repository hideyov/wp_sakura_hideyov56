<?php
/*
 * Plugin Name: Flickr Album Gallery
 * Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
 * Description: Flickr Album Gallery is on JS API plugin to display all public Flickr albums on your WordPress website.
 * Version:     2.1.0
 * Author:      FARAZFRANK
 * Author URI:  https://wpfrank.com/
 * Text Domain: flickr-album-gallery
 * Domain Path: /languages
 * License:     GPL2

Flickr Album Gallery is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Flickr Album Gallery is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Flickr Album Gallery. If not, see http://www.gnu.org/licenses/gpl-2.0.html.
*/

/**
 * Constant Variable
 */
define("FAG_TEXT_DOMAIN", "flickr-album-gallery");
define("FAG_PLUGIN_URL", plugin_dir_url(__FILE__));

//load js script
function wpfrank_fag_load_scripts() {
	wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'wpfrank_fag_load_scripts' );

/**
 * Flickr album gallery Plugin Class
 */
 class FlickrAlbumGallery {

	public function __construct() {
		if (is_admin()) {
			add_action('plugins_loaded', array(&$this, 'FAG_Translate'), 1);
			add_action('init', array(&$this, 'FlickrAlbumGallery_CPT'), 1);
			add_action('add_meta_boxes', array(&$this, 'Add_all_fag_meta_boxes'));
            add_action('admin_init', array(&$this, 'Add_all_fag_meta_boxes'), 1);
			add_action('save_post', array(&$this, 'Save_fag_meta_box_save'), 9, 1);
		}
	}

	/**
	 * Translate Plugin
	 */
	public function FAG_Translate() {
		load_plugin_textdomain('flickr-album-gallery', FALSE, dirname( plugin_basename(__FILE__)).'/languages/' );
	}

	// 2 - Register Flickr Album Custom Post Type
	public function FlickrAlbumGallery_CPT() {
		$labels = array(
			'name' => __( 'Flickr Album Gallery', FAG_TEXT_DOMAIN ),
			'singular_name' => __( 'Flickr Album Gallery', FAG_TEXT_DOMAIN ),
			'add_new' => __( 'Add New Album', FAG_TEXT_DOMAIN ),
			'add_new_item' => __( 'Add New Album', FAG_TEXT_DOMAIN ),
			'edit_item' => __( 'Edit Flickr Album', FAG_TEXT_DOMAIN ),
			'new_item' => __( 'New Flickr Album', FAG_TEXT_DOMAIN ),
			'view_item' => __( 'View Album Gallery', FAG_TEXT_DOMAIN ),
			'search_items' => __( 'Search Album Galleries', FAG_TEXT_DOMAIN ),
			'not_found' => __( 'No Album Galleries Found', FAG_TEXT_DOMAIN ),
			'not_found_in_trash' => __( 'No Album Galleries Found in Trash', FAG_TEXT_DOMAIN ),
			'parent_item_colon' => __( 'Parent Album Gallery:', FAG_TEXT_DOMAIN ),
			'all_items' => __( 'All Album Galleries', FAG_TEXT_DOMAIN ),
			'menu_name' => __( 'Flickr Album Gallery', FAG_TEXT_DOMAIN ),
		);

		$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title', ),
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 10,
			'menu_icon' => 'dashicons-format-gallery',
			'show_in_nav_menus' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => false,
			'capability_type' => 'post'
		);

        register_post_type( 'fa_gallery', $args );
        add_filter( 'manage_edit-fa_gallery', array(&$this, 'fa_gallery_columns' )) ;
        add_action( 'manage_fa_gallery_posts_custom_column', array(&$this, 'fa_gallery_manage_columns' ), 10, 2 );
	}

	function fa_gallery_columns( $columns ){
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'Gallery' ),
            'shortcode' => __( 'Album Gallery Shortcode' ),
            'date' => __( 'Date' )
        );
        return $columns;
    }

    function fa_gallery_manage_columns( $column, $post_id ){
        global $post;
        switch( $column ) {
          case 'shortcode' :
            echo '<input type="text" value="[FAG id='.$post_id.']" readonly="readonly" />';
            break;
          default :
            break;
        }
    }

	// 3 - Meta Box Creator
	public function Add_all_fag_meta_boxes() {
		add_meta_box( __('Configure Settings', FAG_TEXT_DOMAIN), __('Configure Settings', FAG_TEXT_DOMAIN), array(&$this, 'fag_meta_box_form_function'), 'fa_gallery', 'normal', 'low' );
		add_meta_box('Upgrade To Pro Plugin' , 'Upgrade To Pro Plugin', array($this, 'Upgrade_to_meta_box_function'), 'fa_gallery', 'normal', 'low');
		add_meta_box ( __('Flickr Album Gallery Shortcode', FAG_TEXT_DOMAIN), __('Flickr Album Gallery Shortcode', FAG_TEXT_DOMAIN), array(&$this, 'fag_shortcode_meta_box_form_function'), 'fa_gallery', 'side', 'low');
		add_meta_box('Rate Us' , 'Rate Us', array($this, 'Rate_us_meta_box_function'), 'fa_gallery', 'side', 'low');
		//add_meta_box('Pro Features', 'Pro Features', array($this, 'Pro_freatures_meta_box_function'), 'fa_gallery', 'side', 'low');
    }

	/**
	 * Rate Us Meta Box
	 */
	public function Rate_us_meta_box_function() { ?>
		<style>
		.fag-rate-us span.dashicons{
			width: 30px;
			height: 30px;
		}
		.fag-rate-us span.dashicons-star-filled:before {
			content: "\f155";
			font-size: 30px;
		}
		.custnote{
		    background-color: rgba(23, 31, 22, 0.64);
		    color: #fff;
		    width: 348px;
		    border-radius: 5px;
		    padding-right: 5px;
		    padding-left: 5px;
		    padding-top: 2px;
		    padding-bottom: 2px;
		}
		</style>
		<div align="center">
			<p>Please Review & Rate Us On WordPress</p>
			<a class="upgrade-to-pro-demo .fag-rate-us" style=" text-decoration: none; height: 40px; width: 40px;" href="http://wordpress.org/support/view/plugin-reviews/flickr-album-gallery" target="_blank">
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
			</a>
		</div>
		<div class="upgrade-to-pro-demo" style="text-align:center;margin-bottom:10px;margin-top:10px;">
			<a href="http://wordpress.org/support/view/plugin-reviews/flickr-album-gallery" target="_blank" class="button button-primary button-hero">RATE US</a>
		</div>
		<?php
	}

	/**
	 * Shortcode Meta Box
	 */
	public function fag_shortcode_meta_box_form_function() { ?>
		<p><?php _e("Use below shortcode in any Page/Post to publish your Flickr Album Gallery", FAG_TEXT_DOMAIN);?></p>
		<input readonly="readonly" type="text" value="<?php echo "[FAG id=".get_the_ID()."]"; ?>"> <?php
	}

	/**
	 * Upgrade To Meta Box
	 */
	public function Upgrade_to_meta_box_function() { ?>
		<style>
		#wpfrank-action-metabox h3 {
				font-size: 1rem;
		    line-height: 1.4;
		    margin-bottom: 5px;
		}
		#wpfrank-action-metabox a {
		    display: inline-block !important;
		    margin-bottom: 5px !important;
		}
		</style>
		<div class="welcome-panel-column" id="wpfrank-action-metabox">
			<h3>Unlock More Features in Flickr Album Gallery Pro</h3>
			<p>Like - 8 Light Box, Multiple Column Layouts, 8 Mouse Hover Effects, Various Thumbnail Settings</p>
			<a class="button button-primary button-hero load-customize hide-if-no-customize" target="_blank" href="http://wpfrank.com/demo/flickr-album-gallery-pro/">Check Pro Plugin Demo</a>
			<a class="button button-primary button-hero load-customize hide-if-no-customize" target="_blank" href="http://wpfrank.com/account/signup/flickr-album-gallery-pro">Buy Pro Plugin $15</a>
		</div>
		<?php
	}

	/**
	 * Pro Features Meta Box
	 */
	public function Pro_freatures_meta_box_function() { ?>
		<ul>
			<li class="plan-feature">Responsive Design</li>
			<li class="plan-feature">Gallery Layout</li>
			<li class="plan-feature">Unlimited Hover Color</li>
			<li class="plan-feature">10 Types of Hover Color Opacity</li>
			<li class="plan-feature">All Gallery Shortcode</li>
			<li class="plan-feature">Each Gallery Unique Shortcode</li>
			<li class="plan-feature">8 Hover Animation</li>
			<li class="plan-feature">6 Gallery Design Layout</li>
			<li class="plan-feature">8 Light Box Slider</li>
			<li class="plan-feature">Shortcode Button For Post & Page</li>
			<li class="plan-feature">Unique Settings For Each Gallery</li>
			<li class="plan-feature">Hide/Show Gallery Title</li>
		</ul>
		<?php
	}

	/**
	 * Gallery API Key & Album ID Form
	 */
	public function fag_meta_box_form_function($post) {
		// code-mirror css & js for custom css section
		wp_enqueue_style('wpfrank-fag_codemirror-css', FAG_PLUGIN_URL.'css/codemirror/codemirror.css');
		wp_enqueue_style('wpfrank-fag_blackboard', FAG_PLUGIN_URL.'css/codemirror/blackboard.css');
		wp_enqueue_style('wpfrank-fag_show-hint-css', FAG_PLUGIN_URL.'css/codemirror/show-hint.css');

		wp_enqueue_script('wpfrank-fag_codemirror-js',FAG_PLUGIN_URL.'css/codemirror/codemirror.js',array('jquery'));
		wp_enqueue_script('wpfrank-fag_css-js',FAG_PLUGIN_URL.'css/codemirror/fag-css.js',array('jquery'));
		wp_enqueue_script('wpfrank-fag_css-hint-js',FAG_PLUGIN_URL.'css/codemirror/css-hint.js',array('jquery'));

		$FAG_Settings = unserialize(get_post_meta( $post->ID, 'fag_settings', true));
		if(isset($FAG_Settings[0]['fag_api_key']) && $FAG_Settings[0]['fag_album_id']) {
			$FAG_API_KEY = $FAG_Settings[0]['fag_api_key'];
			$FAG_Album_ID = $FAG_Settings[0]['fag_album_id'];
			$FAG_Show_Title = isset( $FAG_Settings[0]['fag_show_title'] ) ? $FAG_Settings[0]['fag_show_title'] : '';
			$FAG_Col_Layout = isset( $FAG_Settings[0]['fag_col_layout'] ) ? $FAG_Settings[0]['fag_col_layout'] : '';
			$FAG_Custom_CSS = isset( $FAG_Settings[0]['fag_custom_css'] ) ? $FAG_Settings[0]['fag_custom_css'] : '';
		}

		/**
		 * Default Settings
		 */
		if(!isset($FAG_API_KEY)) {
			$FAG_API_KEY = "037c012784565c3b5691cc5a0aa912b7";
		}

		if(!isset($FAG_Album_ID)) {
			$FAG_Album_ID = "72157698333322752";
		}

		if(!isset($FAG_Show_Title)) {
			$FAG_Show_Title = "yes";
		}

		if(!isset($FAG_Col_Layout)) {
			$FAG_Col_Layout = "col-md-3";
		}
		?>
		<p><?php _e("Enter Flickr API Key", FAG_TEXT_DOMAIN ); ?></p>
		<input required type="text" style="width:50%;" name="flickr-api-key" id="flickr-api-key" value="<?php echo $FAG_API_KEY; ?>"> <a title="Get your flickr account API Key"href="https://wpfrank.com/how-to-get-flickr-api-key/" target="_blank"><?php _e("Get Your API Key", FAG_TEXT_DOMAIN ); ?></a>

		<p><?php _e("Enter Flickr Album ID", FAG_TEXT_DOMAIN ); ?></p>
		<input required type="text" style="width:50%;" name="flickr-album-id" id="flickr-album-id" value="<?php echo $FAG_Album_ID; ?>"> <a title="Get your flickr photo Album ID" href="https://wpfrank.com/how-to-get-flickr-album-id/" target="_blank"><?php _e("Get Your Album ID", FAG_TEXT_DOMAIN ); ?></a>
		<br><br>

		<p><?php _e("Show Gallery Title", FAG_TEXT_DOMAIN ); ?>&nbsp;&nbsp;
		<input type="radio" name="fag-show-title" id="fag-show-title" value="yes" <?php if($FAG_Show_Title == 'yes' ) echo "checked"; ?>>  <i class="fa fa-check fa-2x"></i> <?php _e("Yes", FAG_TEXT_DOMAIN ); ?>
		<input type="radio" name="fag-show-title" id="fag-show-title" value="no" <?php if($FAG_Show_Title == 'no' ) echo "checked"; ?>>  <i class="fa fa-times fa-2x"></i> <?php _e("No", FAG_TEXT_DOMAIN ); ?>
		</p>
		<br>

		<p><?php _e("Gallery Column Layout", FAG_TEXT_DOMAIN ); ?>&nbsp;&nbsp;
			<select name="fag-col-layout" id="fag-col-layout" class="fag_layout">
	            <optgroup label="<?php _e( "Select Column Layout", FAG_TEXT_DOMAIN ); ?>">
	                <option value="col-md-4" <?php if ( $FAG_Col_Layout == 'col-md-4' ) {
						echo "selected=selected";
					} ?>><?php _e( "Three Column", FAG_TEXT_DOMAIN ); ?></option>
	                <option value="col-md-3" <?php if ( $FAG_Col_Layout == 'col-md-3' ) {
						echo "selected=selected";
					} ?>><?php _e( "Four Column", FAG_TEXT_DOMAIN ); ?></option>
	            </optgroup>
	    	</select>
    	</p>
        <br>

		<p><?php _e("Custom CSS", FAG_TEXT_DOMAIN ); ?></p>
		<?php if(!isset($FAG_Custom_CSS)) $FAG_Custom_CSS = ""; ?>
		<textarea name="fag-custom-css" id="fag-custom-css" rows="5" cols="97"><?php echo $FAG_Custom_CSS; ?></textarea>
		<p class="description">
			<?php _e('Enter any custom CSS you want to apply.', FAG_TEXT_DOMAIN); ?>.<br>
		</p>
		<p class="custnote"><?php _e('Note:', FAG_TEXT_DOMAIN); ?> <?php _e("Please don't use STYLE tag in custom CSS code", FAG_TEXT_DOMAIN); ?></p>
		<hr>
		<script type="text/javascript">
		jQuery(document).ready(function(){
			var editor = CodeMirror.fromTextArea(document.getElementById("fag-custom-css"), {
			lineWrapping: true,
			lineNumbers: true,
			styleActiveLine: true,
			matchBrackets: true,
			hint:true,
			theme : 'blackboard',
			extraKeys: {"Ctrl-Space": "autocomplete"},
			});
		});
		</script>
		<?php
	}

	/**
	 * FAG Save
	 */
	public function Save_fag_meta_box_save($PostID) {
		if(isset($_POST['flickr-api-key']) && isset($_POST['flickr-album-id'])) {
			$FAG_API_KEY = $_POST['flickr-api-key'];
			$FAG_Album_ID = $_POST['flickr-album-id'];
			$FAG_Show_Title = $_POST['fag-show-title'];
			$FAG_Col_Layout = $_POST['fag-col-layout'];
			$FAG_Custom_CSS = $_POST['fag-custom-css'];
			$FAGArray[] = array(
				'fag_api_key' => $FAG_API_KEY,
				'fag_album_id' => $FAG_Album_ID,
				'fag_show_title' => $FAG_Show_Title,
				'fag_col_layout' => $FAG_Col_Layout,
				'fag_custom_css' => $FAG_Custom_CSS
			);
			update_post_meta($PostID, 'fag_settings', serialize($FAGArray));
		}
	}
}// end of class

global $FlickrAlbumGallery;
$FlickrAlbumGallery = new FlickrAlbumGallery();

/**
 * Flickr Album gallery Short Code [FAG]
 */
require_once("shortcode.php");

global $FlickrAlbumGallery;
$FlickrAlbumGallery = new FlickrAlbumGallery();
require_once("widget.php");

add_action( "admin_notices", "fag_admin_pro_banner" );
function fag_admin_pro_banner() {
	global $pagenow;
	$fag_screen = get_current_screen();
	if ( $pagenow == 'edit.php' && $fag_screen->post_type == "fa_gallery" && ! isset( $_GET['page'] ) ) {
		require_once ( 'banner.php' );
	}
}
function fag_try_pro_links( $links ) {
	$ism_pro_link = '<a href="https://wpfrank.com/demo/flickr-album-gallery-pro/" target="_blank">Try Pro</a>';
	array_unshift( $links, $ism_pro_link );
	return $links;
}
$ism_plugin_name = plugin_basename(__FILE__);
add_filter("plugin_action_links_$ism_plugin_name", 'fag_try_pro_links' );
require_once('products.php');
?>