<?php
function pred($str) {
	echo '<pre>';
	print_r($str);
	echo '</pre>';
	die;
}

function renderCategories($categories, $prefix = '') {
	foreach ($categories as $category) {
		echo '<option value="' . $category->id . '">' . $prefix . $category->name . '</option>';
		if ($category->children->isNotEmpty()) {
			renderCategories($category->children, $prefix . '-- ');
		}
	}
}