// Dropdown Menu Toggle
var hidden = true;
$(".c-dropdown").on('click',function(e){

        if(hidden){
          $(".c-dropdown-menu").fadeIn(300);

          $(".c-dropdown-menu>li").each(function(){
              $(this).fadeIn(1000);
          });
        }

        if(!hidden){
          $(".c-dropdown-menu>li").css('display','none');
        }

        console.log(hidden);
        if(hidden){
          hidden = false;
        }else{
          hidden = true;
        }
});



  var postContent = document.getElementsByClassName('post');

  for (var i = 0; i < postContent.length; i++) {

    if(postContent[i].textContent.length > 102){
      postContent[i].textContent = postContent[i].textContent.slice(0, 102) + '...';

      $('.read-more').eq(i).css('display', 'block');
    }
  }
