<?php

function moai_acc_course_content()
{

     global $wpdb;

     $results = $wpdb->get_results("select post_title from wp_posts where post_type= 'moaiacademy' AND post_title !='Auto Draft'");
?>


     <?php


     foreach ($results as $result) {


          $arr[] = $result->post_title;
     }

     $uniqval = array_unique($arr);


     foreach ($uniqval as $result) {
     ?>

          <div class="formgroup">
               <input class='courseval' type=text value="<?php echo $result ?>" readonly>
          </div>

     <?php


     }
}




add_shortcode('course_interested', 'moai_acc_course_content');







function moai_acc_course_session()
{

     if (isset($_GET['course'])) {

     ?>
          <div class="arrowback">

               <a href="http://localhost/testtheme/which-course-you-interested-in/" ><img src="<?php echo plugins_url('/moaiacademy/images/arrow-back.png'); ?>"></a>

          </div>
      <?php





          $course =  $_GET['course'];
          global $wpdb;


          $results = $wpdb->get_results("select ID from wp_posts where post_title='$course'");

          foreach ($results as $result) {

               $post_id = $result->ID;


               $courses = get_post_meta($post_id, 'corsesession');
               $seats = get_post_meta($post_id, 'seats');
               $address = get_post_meta($post_id, 'address');

               $address = implode('', $address);

          ?>

               <div class="card">

                    <div class="card-body">
                         <?php
                         foreach ($courses as $ind => $course) {
                         ?>
                              <h5 class="card-title"><?php echo $course; ?></h5>

                              <p class="card-text"><?php echo $seats[$ind]; ?> spots left</p>
                         <?php
                         }
                         ?>

                         <p class="card-text"><?php echo $address; ?></p>

                         <a href="http://localhost/testtheme/order-submit/?id=<?php echo $post_id; ?> &&course=<?php echo $_GET['course'];?> " class="btn btn-primary">Enroll now</a>
                    </div>
               </div>


     <?php





          }
     } else {


          echo '<p  class="notselectcor">Kindly Select a Course First</p>';
     }


     ?>



     <?php
}

add_shortcode('session-select', 'moai_acc_course_session');




function moai_acc_course_enrolled()
{

     if (isset($_GET['id'])) {

     ?>
          <div class="arrowback">

          
               <a href="http://localhost/testtheme/select-a-session/?course=<?php echo $_GET['course'];?>"><img src="<?php echo plugins_url('/moaiacademy/images/arrow-back.png'); ?>"></a>

          </div>
      
     <?php




          $post_id = $_GET['id'];

          $courses = get_post_meta($post_id, 'corsesession');
          $courses = implode('', $courses);

          $seats   = get_post_meta($post_id, 'seats');

          $seats = implode('', $seats);


          $address = get_post_meta($post_id, 'address');

          $address = implode('', $address);
     ?>



          <form id="confirm-enroll" action='http://localhost/testtheme/enrollment/' method="post" enctype="multipart/form-data">


               <div class="card">

                    <div class="card-body">

                         <h5 class="card-title"><?php echo $courses; ?></h5>

                         <input type=hidden name='course' value="<?php echo $courses; ?>">

                         <input type=hidden name=seats value="<?php echo $seats; ?>">

                         <p class="card-text"><?php echo $address; ?></p>

                         <input type=hidden name=address value="<?php echo $address; ?>">
                    </div>
               </div>

               <div class="imagedeposit">

                    <div class="image">
                         <div id="image-preview"><img src="<?php echo plugins_url('/moaiacademy/images/deposit.png') ?>"></div>

                         <input id="imgInp" type="file" name="singleimage" accept="image/*">

                    </div>
               </div>


               <div>
                    <input id="policycheck" type="checkbox" name='check-policy'>
                    <label class=labelpolicy for=privacypol>I have read and accepted the <a href="http://localhost/testtheme/privacy-policy/">booking policy.</a> </label>
               </div>
               <div class="btn-confirmenroll">
                    <button class="confirmenrolled" name="subenrolled" type="submit">Confirm enrollment</button>
               </div>
          </form>
<?php







     }
}

add_shortcode('enrollment', 'moai_acc_course_enrolled');





function moai_acc_course_submit()

{

if(isset($_POST['subenrolled'])){

   
     $file = $_FILES['singleimage'];

          $filename = $file['name'];
          
          $course = sanitize_text_field($_POST['course']);
          $seats =  sanitize_text_field($_POST['seats']);
          $address =sanitize_text_field($_POST['address']);
         
     
          $prefix = 'ORD-'; // Prefix for the order number
          $random_digits = mt_rand(1000, 9999); // Generate a random 4-digit number
         
          $custom_order_number = $prefix . $random_digits; // Concatenate the components
          
         // echo "Custom Order Number: " . $custom_order_number;

          // Get the destination path for the uploaded file
     
          $upload_dir = plugin_dir_path(__FILE__) . 'images/';
     
     $file_path = $upload_dir . basename($filename);

     
     // Move the uploaded file to the destination folder
    
     move_uploaded_file($file['tmp_name'], $file_path);
     
      
     

?>

     <div class="thanksnote">

     <b><p>Thanks for enrollment</p></b>
     
     </div>




<?php

}





}

add_shortcode('course_submit','moai_acc_course_submit');