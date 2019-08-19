$('.check').on('change',function(e) {
    e.preventDefault();
    var el = $(this);
    var cbid = $(this).attr('id');
       if(this.checked){
            $.ajax({
                type: "POST",
                url: 'ajax/taskdone.php',
                data: {cbid: cbid},
                dataType:"json"
            })
            .done(function( result ){
                if( result.status == "success" ){
                    el.closest('tr').css("background-color","green");
                    var par = el.closest('tbody');
                    var comment = el.closest('tr').next('tr');
                    par.append(el.closest('tr'));
                    par.append(comment);
                }
            });

            }
      });