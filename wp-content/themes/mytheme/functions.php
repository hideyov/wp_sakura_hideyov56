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

// 編集画面の設定（h1を選択できなくする）
function editor_setting($init) {
	$init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre';
	
	return $init;
}
add_filter('tiny_mce_before_init', 'editor_setting');