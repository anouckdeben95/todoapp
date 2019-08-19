$(document).ready(function(){
 
    $('#submit').on('click', function(e){
     e.preventDefault();
     var text = $("#comment").val();

        $.ajax({
          url:"ajax/addcomment.php",
          method:"POST",
          data:{ text: text},
          dataType:"json"
        })
        .done(function( result ) {
            if( result.status == "success" ){
                console.log("done");
            // = "<li>" + text + "</li>"
                var li = "<li>" + text + "</li>";
                $("#listupdates").append(li);
                $("#comment").val("").focus();
                //animatie
                $("#listupdates li").last().slideDown();
            }
        })
        });
    
    
});