$(document).ready(function(){
 
    $('.addbtn').on('click', function(e){
     e.preventDefault();
     var user = e.target.id;
     
        $.ajax({
          url:"ajax/addadmin.php",
          method:"POST",
          data:{ user: user},
          dataType:"json"
        })
        .done(function( result ) {
            if( result.status == "success" ){
                location.reload();
            }
        })
        });

    $('.rembtn').on('click', function(e){
        e.preventDefault();
        var user = e.target.id;  
            $.ajax({
                 url:"ajax/remadmin.php",
                 method:"POST",
                 data:{ user: user},
                 dataType:"json"
            })
            .done(function( result ) {
                if( result.status == "success" ){
                    location.reload();
                }
            })
    });
    
    
});