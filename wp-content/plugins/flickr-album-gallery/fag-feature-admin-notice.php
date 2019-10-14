<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_style( 'fag-feature-notice-css', FAG_PLUGIN_URL . 'css/fag-feature-notice.css', array(), '1.2', 'all' );
wp_enqueue_style('fag-bootstrap-css', FAG_PLUGIN_URL.'css/bootstrap.css');
?>
<div class="row col-md-12 wpfrank_banner">
    <div class="col-md-6 col-sm-12 wpfrank_banner_img">
        <a href="http://wpfrank.com/account/signup/flickr-album-gallery-pro" target="_blank"><img class="img-fluid" src="<?php echo FAG_PLUGIN_URL . "img/products/Flickr-Album-Gallery-Pro.jpg"; ?>"></a>
    </div>
    <div class="col-md-6 col-sm-12 wpfrank_banner_features">
        <h3><span class="border-white border-bottom pb-1"><?php _e('Flickr Album Gallery Pro Features', FAG_TEXT_DOMAIN ); ?></span></h3>
        <ul>
            <li><?php _e('8 Light Box', FAG_TEXT_DOMAIN ); ?></li>
            <li><?php _e('Multiple Column Layouts', FAG_TEXT_DOMAIN ); ?></li>
            <li><?php _e('8 Mouse Hover Effect', FAG_TEXT_DOMAIN ); ?></li>
            <li><?php _e('Various Thumbnail Settings', FAG_TEXT_DOMAIN ); ?></li>
            <li><?php _e('Lightbox Image Preview', FAG_TEXT_DOMAIN ); ?></li>
            <li><?php _e('Album Gallery Widget', FAG_TEXT_DOMAIN ); ?></li>
        </ul>
        <div class="col-md-12 wpfrank_banner_actions">
            <a class="button-primary button-hero" href="http://wpfrank.com/demo/flickr-album-gallery-pro/" target="_blank"><?php _e('View Demo', FAG_TEXT_DOMAIN ); ?></a>
            <a class="button-primary button-hero" href="http://wpfrank.com/account/signup/flickr-album-gallery-pro" target="_blank"><?php _e('Buy Now', FAG_TEXT_DOMAIN ); ?> $15</a>
        </div>
        <div class="plugin_version">
            <span><b>7.1</b><?php _e('Version', FAG_TEXT_DOMAIN ); ?></span>
        </div>
    </div>
</div>
