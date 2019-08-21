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
                    el.closest('tr').css("background-color","rgb(80,200,120)");
                    var par = el.closest('tbody');
                    var pic = el.closest('tr').next('tr');
                    pic.closest('tr').css("background-color","rgb(80,200,120)");
                    var comment = pic.next('tr');
                    par.append(el.closest('tr'));
                    par.append(pic);
                    par.append(comment);
                }
            });

        } else {
            $.ajax({
                type: "POST",
                url: 'ajax/tasktodo.php',
                data: {cbid: cbid},
                dataType:"json"
            })
            .done(function( result ){
                if( result.status == "success" ){
                    el.closest('tr').css("background-color","transparent");
                    var par = el.closest('tbody');
                    var pic = el.closest('tr').next('tr');
                    pic.closest('tr').css("background-color","transparent");
                    var comment = pic.next('tr');
                    par.prepend(comment);
                    par.prepend(pic);
                    par.prepend(el.closest('tr'));
                    
                }
            });
        }
      });