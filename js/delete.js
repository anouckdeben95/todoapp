$(document).ready(function(){
 
    $('.imgbtn').on('click', function(e){
    var taskid = e.target.id;
    console.log(taskid);
        $.ajax({
          url:"ajax/deleteimg.php",
          method:"POST",
          data:{ taskid: taskid},
          dataType:"json"
        })
        .done(function( result ) {
            if( result.status == "success" ){
                location.reload();
            }
        })
        });
    
    
});