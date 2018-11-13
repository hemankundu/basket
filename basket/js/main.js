(function($){
    $('.add-btn').on('click',function(){
        var table=$('tbody');
        var change='<tr class="row100 body">';
        var id=["name","qty","rate","detail"];
        for(i=0;i<id.length;i++){
            change+=('<td class="column100 col'+(i+1) +' "id="'+ id[i] +'"><input class="input100"></td>');
        }
        change+='<td class="column100 col5" id="subtot"><label class="input100"></label></td></tr>';
        table.append(change);
        console.log("New row added!");
    })

    $(document).on('click', '.save-btn', function(event){
        console.log('save click');
        $(document).find('.row100.body').each(function(){
            var rowid=$(this).attr('id');
            /*Update*/
            if(rowid){
                $.ajax({
                    url: 'update_db.php',
                    type: 'post',
                    data: {'action': 'update', 'rowid': rowid,
                    'name': $(this).find('#name').children().last().val(),
                    'qty': $(this).find('#qty').children().last().val(),
                    'rate': $(this).find('#rate').children().last().val(),
                    'detail': $(this).find('#detail').children().last().val()
                    }
                });
                $(this).ajaxStop(function(){
                    window.location.reload();
                });
            }
            /*insert*/
             else{
                $.ajax({
                    url: 'update_db.php',
                    type: 'post',
                    data: {'action': 'insert',
                        'name': $(this).find('#name').children().last().val(),
                        'qty': $(this).find('#qty').children().last().val(),
                        'rate': $(this).find('#rate').children().last().val(),
                        'detail': $(this).find('#detail').children().last().val()
                        }
                });
                $(this).ajaxStop(function(){
                    window.location.reload();
                });
            }
        })
        event.target.classList.add("hidden");
        /*window.location.reload();*/
    })

    $(document).on('click', '.del-btn', function(event){
        var rowid=$(event.target).parent().parent().attr('id');
        if(rowid){
            $.ajax({
                url: 'update_db.php',
                type: 'post',
                data: {'action': 'delete', 'rowid': rowid}
            });
            /*window.location.reload();*/
            $(event.target).ajaxStop(function(){
                window.location.reload();
            });
        }
    })


    $(document).on('change','input', function(event){
        var b=$('.save-btn');
        b[0].classList.remove("hidden");
        var rowid=$(event.target).parent().parent().attr('id');
        if(rowid){
            $.ajax({
                url: 'update_db.php',
                type: 'post',
                data: {'action': 'needupdate', 'rowid': rowid}
            });
        }
        var tdid=$(event.target).parent().attr('id');
        console.log("tdid: "+tdid);
        if (tdid=="qty" || tdid=="rate"){
            /*Update subTotal */
            var qty=$(event.target).parent().parent().find('#qty').children().last().val();
            var rate=$(event.target).parent().parent().find('#rate').children().last().val();
            console.log("qty: "+qty+" rate: "+rate);
            $(event.target).parent().parent().find('#subtot').children().last().text(qty*rate);
            /* Update Total and total qty */
            var tot_qty = 0.0, tot = 0.0;
            $(document).find('td').each(function(){
                if($(this).attr('id')=='qty'){
                    var inputCol=$(this).find('input');
                    var val=inputCol.val();
                    if(val)
                        tot_qty+=parseFloat(val);
                }else if($(this).attr('id')=='subtot'){
                    var inputLabel=$(this).find('label');
                    var val=inputLabel.text();
                    if(val)
                        tot+=parseFloat(val);
                }
            })
            $(document).find('#tot_qty_label').text(tot_qty);
            $(document).find('#tot_label').text(tot);
        }
    })


})(jQuery);