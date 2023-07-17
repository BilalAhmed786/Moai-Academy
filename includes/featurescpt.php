<?php



//course title placeholder

add_filter('enter_title_here', 'moaiaca_place_holder', 20, 2);
function moaiaca_place_holder($title, $post)
{

  if ($post->post_type == 'moaiacademy') {
    $my_title = "Add Course Name(course name should be similar for multiple session )";
    return $my_title;
  }

  return $title;
}



//pagination for custom post type

add_filter('edit_posts_per_page', 'wpwhale_posts_per_page', 20, 2);
function wpwhale_posts_per_page( $posts_per_page, $post_type )
{
    if ( 'moaiacademy' == $post_type )
        return 7;
    return $posts_per_page;
}



//add meta boxes to my custom field

add_action('add_meta_boxes',  function () {  //add meta box for product short desc 

add_meta_box('myid_moai_section', 'Session Details', 'course_other_details', "moaiacademy", "side", "low");


});


//add custom fields in to custom post type with tabs features


function course_other_details($post)
{
?>

  <div class="tab">
    <button class="tablinks" onclick="openCity(event, 'Coursesession')" id="defaultOpen">Course Duration</button>
    <button class="tablinks" onclick="openCity(event, 'totalseats')">Total Seats</button>
    <button class="tablinks" onclick="openCity(event, 'acaaddress')">Address</button>
    

  </div>

  <div id="Coursesession" class="tabcontent">
    <label>
      <p><b>Course Duration</b></p>
      </lable>
      <input style=width:60% type="text" name="corsesession" value="<?php echo get_post_meta($post->ID,'corsesession',true);?>"  placeholder="Course Session">
  </div>

  <div id="totalseats" class="tabcontent">
    <label>
      <p><b>Total Seats</b></p>
      </lable>
      <input style=width:60% type="text" name="seats" value="<?php echo get_post_meta($post->ID,'seats',true);?>" placeholder="Seats Available">
  </div>

  <div id="acaaddress" class="tabcontent">
    <label>
      <p><b>Address</b></p>
      </lable>
      <textarea style=width:100%;height:60% name="address"><?php echo get_post_meta($post->ID,'address',true);?></textarea>
  </div>
 
  <?php

}



//custom fields data store in the post_meta


function update_moaifields_aca($post_id, $post)
{ // data store in wp_postmeta table data save 

  if (isset($_POST['corsesession'])) {
    update_post_meta($post_id,'corsesession', sanitize_text_field($_POST['corsesession']));
    update_post_meta($post_id, 'seats', sanitize_text_field($_POST['seats']));
    update_post_meta($post_id, 'address', sanitize_text_field($_POST['address']));
   
  }
}
add_action('save_post', 'update_moaifields_aca', 10, 2);


//add custom columns to wp-list table for custom post type


function moai__beauty_acca_custom($columns)
{ //add custom columns to custom post type

  $columns = array(
    //assign label to custom columns
    "cb" => '<input type=checkboxes/>',
    "title" => 'Courses',
    "courseduration" => 'Course Duration',
    "totalseats" => 'Total Seats',
    "address" => 'Address',
    "date" => 'Date'

  );

  return $columns;
}

add_action("manage_moaiacademy_posts_columns","moai__beauty_acca_custom");



//get metabox value in custom columns

function moai_beauty_accad_columns_values($column, $post_id)
{

  switch ($column) {

    case 'courseduration':
    
      $courseduration = get_post_meta($post_id, 'corsesession', true);
       echo $courseduration;
     break;

    case 'totalseats':
      $totalseats = get_post_meta($post_id, "seats", true);
      echo $totalseats;
      break;

    case 'address':
      $address = get_post_meta($post_id, "address", true);
      echo $address;
    break;
  }
  }


add_action("manage_moaiacademy_posts_custom_column", "moai_beauty_accad_columns_values", 10,2);



function moai_beauty_accad_columns_sort($columns)
{  //columns sort asc/des order

  $columns['courseduration'] = 'Course Duration';
  $columns['totalseats'] = 'Total Seats';
  $columns['address'] = 'Address';

  return $columns;
}

add_action("manage_edit-moaiacademy_sortable_columns", "moai_beauty_accad_columns_sort");

