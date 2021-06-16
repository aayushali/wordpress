/* jQuery(document).ready( function() {

   jQuery(".user_vote").click( function(e) {
      e.preventDefault(); 
      post_id = jQuery(this).attr("data-post_id")
      nonce = jQuery(this).attr("data-nonce")

      jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "my_user_vote", post_id : post_id, nonce: nonce},
         success: function(response) {
            if(response.type == "success") {
               jQuery("#vote_counter").html(response.vote_count)
            }
            else {
               alert("Your vote could not be added")
            }
         }
      })   

   })

})
*/

jQuery(document).ready(function($) {

   // We'll pass this variable to the PHP function example_ajax_request
   var fruit = 'Banana';

   // This does the ajax request
   $.ajax({
      url: example_ajax_obj.ajaxurl,
      data: {
         'action': 'example_ajax_request',
         'fruit' : fruit,
         'nonce' : example_ajax_obj.nonce
      },
      success:function(data) {
         // This outputs the result of the ajax request
         console.log(data);
      },
      error: function(errorThrown){
         console.log(errorThrown);
      }
   });

});