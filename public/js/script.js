window.addEventListener("load", function(){

    $('.icons-like .like').css('cursor', 'pointer');
    $('.icons-like .dislike').css('cursor', 'pointer');

    likes()

    function likes(){

        $('.icons-like').off().on('click', function(){
        
            var likeExist = $(this).children().hasClass('like')
    
            if(likeExist){
                $(this).children().removeClass('fas like').addClass('far dislike')
                console.log('dislike')            
            }else{
                $(this).children().removeClass('far dislike').addClass('fas like')
                console.log('like')
            }
    
            likes()
        });
    }

    
});