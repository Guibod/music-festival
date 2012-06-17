$(function() {
  //the loading image
  var $loader		= $('#st_loading');
  //the ul element
  var $list		= $('#st_nav');
  //the current image being shown
  var $currImage 	= $('#st_main').children('img:first');

  //let's load the current image
  //and just then display the navigation menu
/*  $('<img>').load(function(){
          $loader.hide();
          $currImage.fadeIn(3000);
          //slide out the menu*/
          setTimeout(function(){
                  $list.animate({'left':'0px'},500);
          },
          1000);
//  }).attr('src',$currImage.attr('src'));

  //calculates the width of the div element
  //where the thumbs are going to be displayed
  buildThumbs();

  function buildThumbs(){
          $list.children('li.album').each(function(){
                  var $elem 			= $(this);
                  var $thumbs_wrapper = $elem.find('.st_thumbs_wrapper');
                  var $thumbs 		= $thumbs_wrapper.children(':first');
                  //each thumb has 180px and we add 3 of margin
                  var finalW 			= $thumbs.find('img').length * 283;
                  $thumbs.css('width',finalW + 'px');
                  //make this element scrollable
                  makeScrollable($thumbs_wrapper,$thumbs);
          });
  }

  //clicking on the menu items (up and down arrow)
  //makes the thumbs div appear, and hides the current
  //opened menu (if any)
  $list.find('.st_arrow_down').live('click',function(){
          var $this = $(this);
          hideThumbs();
          $this.addClass('st_arrow_up').removeClass('st_arrow_down');
          var $elem = $this.closest('li');
          $elem.addClass('current').animate({'height':'377px'},500);
          var $thumbs_wrapper = $this.parent().next();
          $thumbs_wrapper.show(300);
  });
  $list.find('.st_arrow_up').live('click',function(){
          var $this = $(this);
          $this.addClass('st_arrow_down').removeClass('st_arrow_up');
          hideThumbs();
  });

  //clicking on a thumb, replaces the large image
  $list.find('.st_thumbs img').bind('click',function(){
          var $this = $(this);
          $loader.show();
          $('<img class="st_preview"/>').load(function(){
                  var $this = $(this);
                  var $currImage = $('#st_main').children('img:first');
                  $this.insertBefore($currImage);
                  $loader.hide();
                  $currImage.fadeOut(2000,function(){
                          $(this).remove();
                  });
          }).attr('src',$this.attr('alt'));
  }).bind('mouseenter',function(){
          $(this).stop().animate({'opacity':'1'});
  }).bind('mouseleave',function(){
          $(this).stop().animate({'opacity':'0.7'});
  });

  //function to hide the current opened menu
  function hideThumbs(){
          $list.find('li.current')
          .animate({'height':'50px'},400,function(){
                  $(this).removeClass('current');
          })
          .find('.st_thumbs_wrapper')
          .hide(300)
          .andSelf()
          .find('.st_link span')
          .addClass('st_arrow_down')
          .removeClass('st_arrow_up');
  }

  //makes the thumbs div scrollable
  //on mouse move the div scrolls automatically
  function makeScrollable($outer, $inner){
          var extra 			= 800;
          //Get menu width
          var divWidth = $outer.width();
          //Remove scrollbars
          $outer.css({
                  overflow: 'hidden'
          });
          //Find last image in container
          var lastElem = $inner.find('img:last');
          $outer.scrollLeft(0);
          //When user move mouse over menu
          $outer.unbind('mousemove').bind('mousemove',function(e){
                  var containerWidth = lastElem[0].offsetLeft + lastElem.outerWidth() + 2*extra;
                  var left = (e.pageX - $outer.offset().left) * (containerWidth-divWidth) / divWidth - extra;
                  $outer.scrollLeft(left);
          });
  }
  $('#relatedPosts').toggle(
          function(){
                  $('#rp_list').animate({'bottom':'10px'},500);
          },
          function(){
                  $('#rp_list').animate({'bottom':'-50px'},500);
          }
  );
  $('#rp_list a').tipsy({gravity: 's'});
});
