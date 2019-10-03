<?php

// excerption -- 概要（抜粋）の文字数
function my_length($length) {
	return 50;
}
add_filter('excerpt_mblength', 'my_length');

// excerption -- 概要（抜粋）の省略記号
function my_more($more) {
	return '...';
}
add_filter('excerpt_more', 'my_more');

// 外部コンテンツの最大幅
if (!isset($content_width)) {
	$content_width = 522;
}

// YouTubeのビデオを<div>でマークアップ
function ytwrapper($return, $data, $url) {
	if($data->provider_name == 'YouTube') {
		return '<div class="ytvideo">'.$return.'</div>';
	} else {
		return $return;
	}
}
add_filter('oembed_dataparse', 'ytwrapper', 10, 3);

// YouTubeのビデオ：キャッシュをクリア
function clear_ytwrapper($post_id) {
	global $wp_embed;
	$wp_embed->delete_oembed_caches($post_id);
}
add_action('pre_post_update', 'clear_ytwrapper');

// アイキャッチ画像
add_theme_support('post-thumbnails');
