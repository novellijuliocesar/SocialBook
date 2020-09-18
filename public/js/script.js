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
                    url: url + '/dislike/' + $(this).data('id'),
                    type: 'GET',
                    success: function(response){
                        console.log(response);
                    }
                });     

            }else{
                $(this).children().removeClass('far dislike').addClass('fas like')
                console.log('like')

                $.ajax({
                    url: url + '/like/' + $(this).data('id'),
                    type: 'GET',
                    success: function(response){
                        console.log(response);
                    }
                });     
            }
    
            likes()
        });
    }

    
});