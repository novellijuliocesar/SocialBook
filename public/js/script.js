"use strict";

var url = 'http://proyectofinallaravel.com/';
window.addEventListener("load", function(){

    $('.icons-like .like').css('cursor', 'pointer');
    $('.icons-like .dislike').css('cursor', 'pointer');

    likes()

    //Realiza el registro de un like y dislike mediante una petición Ajax
    function likes(){

        $('.icons-like').off().on('click', function(){
        
            var likeExist = $(this).children().hasClass('like')  
    
            if(likeExist){
                $(this).children().removeClass('fas like').addClass('far dislike')
                console.log('dislike')     

                $.ajax({
                    url: url + 'dislike/' + $(this).data('id'),
                    type: 'GET',
                    success: function(response){
                        $('.countLikes').text(response.count + ' Me gustas');
                        console.log(response.count);
                    }
                });    

            }else{
                $(this).children().removeClass('far dislike').addClass('fas like')
                console.log('like')

                $.ajax({
                    url: url + 'like/' + $(this).data('id'),
                    type: 'GET',
                    success: function(response){
                        $('.countLikes').text(response.count + ' Me gustas');
                        console.log(response.count);
                    }
                });  
            }
    
            likes()
        });
    }

    //Buscador de usuarios
    $('#search-users').on('submit', function(){
        $(this).attr('action', url + 'user/showUsers/' + $('#search').val());
    });
});