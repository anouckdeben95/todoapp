$(document).ready(function(){
 
    $('.submit').on('click', function(e){
     e.preventDefault();
     var el = $(this);
     var taskid = e.target.id;
     var text = $(this).closest('.comment').find('textarea').val();
     
     //var taskid = $(".submit").attr('id');
     console.log(taskid);
        $.ajax({
          url:"ajax/addcomment.php",
          method:"POST",
          data:{ text: text, taskid: taskid},
          dataType:"json"
        })
        .done(function( result ) {
            console.log(result.status);
            if( result.status == "success" ){
                // = "<li>" + text + "</li>"
                var li = "<li>" + text + "</li>";
                console.log(li);
                // to insert specified content as the last child
                el.closest('td').find('#listupdates').append(li);
                el.closest('td').find('#comment').val("");
            
            }
        })
        });
    
    
});