<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>Database</title>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

<?php $tables = array_merge($wpdb->tables, $wpdb->global_tables); ?>

<script>
function SwitchTable(table) {
	<?php foreach( $tables as $table ): ?>
	document.getElementById('<?php echo $table; ?>').style.display = 'none';
	document.getElementById('menu-<?php echo $table; ?>').className = 'hide';
	<?php endforeach; ?>

	document.getElementById(table).style.display = 'block';
	document.getElementById('menu-'+table).className = 'current';
}
</script>


<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> onload="SwitchTable('posts');">


<h1>DATABASE</h1>

<ul id="menu">
<?php foreach( $tables as $table ): ?>

<li><a href="#<?php echo $table; ?>" id="menu-<?php echo $table; ?>" onclick="SwitchTable('<?php echo $table; ?>'); return false"><?php echo $table; ?></a></li>
<?php endforeach; ?>
</ul>



<?php foreach( $tables as $table ): ?>

<?php
$fields = array();
$dbtable = $wpdb->$table;
$fields = $wpdb->get_results( "SELECT * FROM $dbtable" ); 
?>

<div id="<?php echo $table; ?>" class="table">
<h2><?php echo $table; ?>テーブル</h2>


<?php if($fields): ?>

<table>

<tr class="header">
	<?php foreach( $fields[0] as $key => $value ): ?>

	<th><?php echo $key; ?></th>

	<?php endforeach; ?>
</tr>


<?php
if ($table == 'posts') {
	function cmp($a, $b){
		return $a->ID - $b->ID;
	}
	usort($fields, 'cmp');
}

if ($table == 'postmeta') {
	function cmp2($a, $b){
		return $a->meta_id - $b->meta_id;
	}
	usort($fields, 'cmp2');
}

if ($table == 'term_relationships') {
	function cmp3($a, $b){
		return $a->object_id - $b->object_id;
	}
	usort($fields, 'cmp3');
}
?>


<?php foreach($fields as $field): ?>

<?php
$rowclass = 'data-other';

if ($table == 'posts') {

	if ( $field->post_status == 'publish' && $field->post_type == 'post') {
		$rowclass = 'data-post';
	} elseif ( $field->post_status == 'publish' && $field->post_type == 'page') {
		$rowclass = 'data-page';
	} elseif ( $field->post_status == 'inherit' && $field->post_type == 'attachment') {
		$rowclass = 'data-media';
	} elseif ( $field->post_status == 'publish' && $field->post_type == 'flower') {
		$rowclass = 'data-flower';
	}

}

?>


<tr class="<?php echo $rowclass; ?>">

	<?php foreach( $field as $key => $value ): ?>
	<td><textarea><?php echo $value; ?></textarea></td>
	<?php endforeach; ?>

</tr>

<?php endforeach; ?>

</table>


<?php else: ?>

<p>管理しているデータがありません。</p>

<?php endif; ?>

</div>

<?php endforeach; ?>




<?php wp_footer(); ?>

</body>
</html>
