$(document).ready(function(){
 
    $('.update_task').on('click', function(e){
    console.log("clicked");
     e.preventDefault();
     //var el = $(this);
     var taskid = e.target.id;
     var date = $(this).closest('.up').find('input').first().val();
     
     //var taskid = $(".submit").attr('id');
     console.log(taskid);
     console.log(date);
        $.ajax({
          url:"ajax/update.php",
          method:"POST",
          data:{ date: date, taskid: taskid},
          dataType:"json"
        })
        .done(function( result ) {
            if( result.status == "success" ){
                console.log("succes");
                location.reload();
            
            }
        })
        });
    
    
});