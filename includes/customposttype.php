<?php

function moai_beauty_cpt_academy()
{
  $labels = array(   // custom post type lables set
    'name' => __('Moai Academy'),
    'singular_name' => __('Moai Academy'),
    'add_new' => __('Add Course'),
    'add_new_item' => __("Add New Course"),
    'edit_item' => __("Edit Course Post"),
    'new_item' => __("New Course Post"),
    'view_item' => __("View Course Posts"),
    'search_items' => __("Search in Courses Posts"),
    'not_found' =>  __('No Course posts found'),
    'not_found_in_trash' => __('No Course posts found in Trash'),

  );

  $options = array(
    'labels' => $labels,
    'menu_icon' => 'dashicons-book',
    'public' => true,
    'has_archive' => true,
    'show_in_rest' => false,  // true show exact default post
    'supports' => ['title'],
    
  );

  register_post_type('moaiacademy', $options);
}


add_action('init', 'moai_beauty_cpt_academy');



include("featurescpt.php");
