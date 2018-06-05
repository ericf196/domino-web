$(document).ready(function() {
      var toggleAffix = function(affixElement, scrollElement, wrapper) {
        var height = affixElement.outerHeight(),
            top = wrapper.offset().top;
        if (scrollElement.scrollTop() > top){
            wrapper.height(height);
            affixElement.addClass("affix");
            $('.primary-image').attr('src', urlLogo + '/logo-ligas-domino2.png');
        }
        else {
            affixElement.removeClass("affix");
            wrapper.height('auto');
            $('.primary-image').attr('src', urlLogo + '/logo-ligas-domino.png');
        }   
      };
      
      $('[data-toggle="affix"]').each(function() {
        var ele = $(this),
            wrapper = $('<div></div>'); 
        ele.before(wrapper);
        $(window).on('scroll resize', function() {
            toggleAffix(ele, $(this), wrapper);
        });
        toggleAffix(ele, $(window), wrapper);
      });

    });