// Dropdown Menu Toggle

$(".c-dropdown").on('mouseenter touchstart',function(e){

    $(".c-dropdown-menu").fadeIn(300);

    $(".c-dropdown-menu>li").each(function(index){
        $(this).delay(70*index).fadeIn(2000);
    });

});

$(".c-dropdown").on('mouseleave touchend',function(){

    $(".c-dropdown-menu").fadeOut();


    $(".c-dropdown-menu>li").css('display','none');

});



//showing collapsed search field on mouseover

    var deviceWidth = $(window).width();

    var searchBarWidth = $(".header").width() - 45;

    if(deviceWidth < 480){

            $("i#search-icon.glyphicon.glyphicon-search").css({'background-color':'#2b2b2b', 'color':'white'});

            $("input#search-bar.form-control").css({'width': searchBarWidth + "px" , 'padding-left': '1em', 'border': '1px solid #2b2b2b'});

    }

    $("i#search-icon.glyphicon.glyphicon-search").on('mouseover',function(){

        if(deviceWidth > 480){
                $(this).css({'background-color':'#479ce4', 'color':'white'});

                $("input#search-bar.form-control").animate({width: '200px', paddingLeft: '1em'},600);

        }
    });

    $("input#search-bar.form-control").on('blur', function(){

        if(deviceWidth > 480){
            	$("i#search-icon.glyphicon.glyphicon-search").css({'background-color':'#2a333e', 'color':'#A9ADB1'});

		    	$(this).animate({width: '0px', paddingLeft: '0em'},600);

        }

    });



  var postContent = document.getElementsByClassName('post');

  for (var i = 0; i < postContent.length; i++) {

    if(postContent[i].textContent.length > 102){
      postContent[i].textContent = postContent[i].textContent.slice(0, 102) + '...';

      $('.read-more').eq(i).css('display', 'block');
    }
  }
