"use strict";
//Define la url del proyecto
var url = 'http://proyectofinallaravel.com/';

window.addEventListener("load", function(){

    //indica que, al pasar el cursor sobre los iconos, se muestre un puntero.    
    $('.icons-like .like').css('cursor', 'pointer');
    $('.icons-like .dislike').css('cursor', 'pointer');
    
    //Llama a la función.
    likes()

    //Realiza el registro de un like y dislike mediante una petición Ajax
    function likes(){

        $('.icons-like').off().on('click', function(){
            //Comprueba que el icono tenga la clase like
            var likeExist = $(this).children().hasClass('like')  
            //Cambia el nombre de la clase y elimina el registro de like de la base de datos.
            if(likeExist){
                $(this).children().removeClass('fas like').addClass('far dislike')
                console.log('dislike')     
                $.ajax({
                    url: url + 'dislike/' + $(this).data('id'),
                    type: 'GET',
                    success: function(response){
                        //Actualiza el conteo de likes.
                        $('.countLikes').text(response.count + ' Me gustas');
                        console.log(response.count);
                    }
                });   
            //Cambia el nombre de la clase y realiza el registro de like en la base de datos.     
            }else{
                $(this).children().removeClass('far dislike').addClass('fas like')
                console.log('like')
                $.ajax({
                    url: url + 'like/' + $(this).data('id'),
                    type: 'GET',
                    success: function(response){
                        //Actualiza el conteo de likes.
                        $('.countLikes').text(response.count + ' Me gustas');
                        console.log(response.count);
                    }
                });  
            }    
            //Llama a la función.
            likes()
        });
    }

    //Buscador de usuarios
    $('#search-users').on('submit', function(){
        $(this).attr('action', url + 'user/showUsers/' + $('#search').val());
    });

    //Control de Follows
    $('.icons-follow .follow').css('cursor', 'pointer');
    $('.icons-follow .unfollow').css('cursor', 'pointer');    
    //Llama a la función
    follow();

    //Realiza el registro de seguir o dejar de seguir a un usuario
    function follow(){

        $('.icons-follow').off().on('click', function(){
            //Comprueba que el icono tenga la clase follow
            var followExist = $(this).children().hasClass('follow') 
            //Cambia el nombre de la clase y elimina el registro de seguidor de la base de datos.
            if(followExist){
                $(this).children().removeClass('fa-user-minus follow').addClass('fa-user-plus unfollow')               
                console.log('unfollow')                  
                $.ajax({
                    url: url + 'unfollow/' + $(this).data('id'),
                    type: 'GET',
                    success: function(response){
                    }
                });    
            //Cambia el nombre de la clase y realiza el registro de seguidor en la base de datos.                    
            }else{
                $(this).children().removeClass('fa-user-plus unfollow').addClass('fa-user-minus follow')
                console.log('follow')                
                $.ajax({
                    url: url + 'follow/' + $(this).data('id'),
                    type: 'GET',
                    success: function(response){
                    }
                });                  
            }
            //Llama a la función
            follow();
        });
    }
});