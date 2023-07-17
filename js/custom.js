


//form validation requiredd
$(document).ready(function(){

    $("#confirm-enroll").validate({

    rules:{

            'check-policy':{
            required:true,

        },
            
            'singleimage':{
            required:true,
        }
   },
   errorPlacement: function(error, element) {//error placement below field
    if (element.is(":checkbox") || element.is(":radio")) {
        error.insertAfter(element.closest('div'));
    } else {
      error.insertAfter(element);
    }
  }

});
});


//for redirect to some

$(document).on('click','.courseval', function() {
      
    var course = $(this).val();

    window.location="http://localhost/testtheme/select-a-session/?course="+course
});






//for display depositslip

function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
        
            $('#image-preview').html('<img class="imagprev" src="' + e.target.result + '">');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

jQuery(document).ready(function($) {
    $('#imgInp').change(function() {
        previewImage(this);
    });
});




