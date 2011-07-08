 $(document).ready(function(){

	$.getJSON('http://www.unicate.ch/sn/?id='+noteId+'&cachetime=120&output=jsonp&callback=?', function(data) {

	  $("#content").html(unescape(data.result));

	  $("#content h2").each(function(e){
      if(!($(this).next().is("#content h2"))){
          $(this).addClass("clicker").append('<span>+</span>');
          $(this).nextUntil("#content h2").hide();
      }
    });

    $("#content h1").each(function(e){
        $(this).nextUntil("#content h2").show();
        $("#content h1").show();
    });

    $("#content h1").first().addClass("title");

    $("#content h2.clicker").toggle(
      function(){
        $(this).nextUntil("#content h2, #content h1").slideDown('fast');
        $(this).find('span').html('-');
        },
      function(){
        $(this).nextUntil("#content h2, #content h1").slideUp('fast');
        $(this).find('span').html('+');
    })

	});

	// Set width for iPhone
  if (navigator.platform.indexOf("iPhone") > -1){
    $('#content').css('width', '92%');
    $('#content').css('background-image', 'none');
    $('#content').css('margin-left', '2em');
  }

});




