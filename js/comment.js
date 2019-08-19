$(document).ready(function(){
 
    $('#submit').on('click', function(e){
     e.preventDefault();
     console.log("begin ajax")
     var text = $("#comment").val();
     console.log(text);
        $.ajax({
          url:"ajax/addcomment.php",
          method:"POST",
          data:{ text: text},
          dataType:"json"
        })
        .done(function( result ) {
            console.log(result.status);
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
    
    /**load_comment();

    function load_comment(){
        $.ajax({
            url:"fetch_comment.php",
            method:"POST",
            success:function(data)
            {
                $('#display_comment').html(data);
            }
        })
    }**/

    
});