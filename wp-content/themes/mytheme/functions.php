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