$(document).ready(function(){





$(".dropdown_a").click(function(e) {
	e.preventDefault();
	var this_s = $(this);
	this_s.next().slideToggle();
	this_s.toggleClass('change-erso');

});












// $(".srv_msdf").click(function(e) {
//$(".m_tdys, .wrapper, .m_tdysn, .dropdown-menu li").click(function(e) {
$(".m_tdys, .wrapper, .m_tdysn").click(function(e) {
	e.preventDefault();
	$('#lodaing_srv').show();
	var srv_id = $(this).data('srvid');
		$.ajax({
	    url: base_url+"home/server",
	    async: false,
	    type: "POST",
	    data: "srv_id=" + srv_id,
	    dataType: "json",
	    success:function(rep)
	    {
			$('#lodaing_srv').hide();
			var rip = '<div id="player_a" style="width:100%;height:100%;" class="projekktor" data-srvlnk="'+rep["link"]+'"></div>';
	      	$('#banner-slide').html(rip);
	      var bcg = 'background:url('+base_url2+'img/'+rep["img"]+') no-repeat center center fixed ;-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover;background-size: cover;';
	      $('body').attr('style', bcg);

	      	var srvlnk = $('#player_a').data('srvlnk');

			if(!(window.mozInnerScreenX == null) && rep["type"] == "rtmp") {
			    // is firefox 
			    alert("If Channel doesn't work , please install vlc and try again or move to google chrome !!");
			    var the_vi = "<object type='application/x-vlc-plugin data='"+ srvlnk +"' width='100%' height='90%' id=''>"+
			    " <param name='movie' value='"+ srvlnk +"'/>"+
			    " <embed type='application/x-vlc-plugin' name='video1'"+
			    " autoplay='yes' loop='no' width='100%' height='100%'"+
			    " target='"+ srvlnk +"' />"+
				"</object>";
				$('#player_a').html(the_vi);

			} else { 
			    // not firefox 
			      jwplayer("player_a").setup({
						  file: srvlnk,
						  image: "/assets/myVideo.jpg",
						  autostart: true,
						  height: '100%',
						  width: '100%'
				});
			}
	      
		}
	});
}); 



$("#c_lst_d_cat .srv_msdf").click(function(e) {
	e.preventDefault();
	$('#lodaing_srv').show();
	var cat_id = $(this).attr('data-catid');

	$.ajax({
        url: base_url+"home/channel",
        async: false,
      // indexValue: cmnt_start,
        type: "POST",
        data: "cat_id=" + cat_id,
        dataType: "html",
        success:function(rep)
        {
			$('#lodaing_srv').hide();
          	$('#srvr_nmz').html(rep);
			
			$("#c_lst_d li a").click(function(e) {
				e.preventDefault();
				$('#lodaing_srv').show();
				var srv_id = $(this).attr('data-srvid');
					$.ajax({
				    url: base_url+"home/server",
				    async: false,
				    type: "POST",
				    data: "srv_id=" + srv_id,
				    dataType: "json",
				    success:function(rep)
				    {
						$('#lodaing_srv').hide();
			var rip = '<div id="player_a" style="width:100%;height:100%;" class="projekktor" data-srvlnk="'+rep["link"]+'"></div>';
	      	$('#banner-slide').html(rip);
	      var bcg = 'background:url('+base_url2+'img/'+rep["img"]+') no-repeat center center fixed ;-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover;background-size: cover;';
	      $('body').attr('style', bcg);
	      	var srvlnk = $('#player_a').data('srvlnk');
			if(!(window.mozInnerScreenX == null) && rep["type"] == "rtmp") {
			    // is firefox 
			    alert("If Channel doesn't work , please install vlc and try again or move to google chrome !!");
			    var the_vi = "<object type='application/x-vlc-plugin data='"+ srvlnk +"' width='100%' height='90%' id=''>"+
			    " <param name='movie' value='"+ srvlnk +"'/>"+
			    " <embed type='application/x-vlc-plugin' name='video1'"+
			    " autoplay='yes' loop='no' width='100%' height='100%'"+
			    " target='"+ srvlnk +"' />"+
				"</object>";
				$('#player_a').html(the_vi);

			} else { 
			    // not firefox 
			      jwplayer("player_a").setup({
						  file: srvlnk,
						  image: "/assets/myVideo.jpg",
						  autostart: true,
						  height: '100%',
						  width: '100%'
				});
			}				      
				    }
				});
			}); 
        }
	}); 
});




$("#likebox_1").hover(function()
	{ 
		$(this).stop(true,false).animate({right:  0}, 500);
	 },function()
	 { 
	 	$("#likebox_1").stop(true,false).animate({right: -223}, 500); 
	 });



$('#banner-slide').bjqs({
            animtype      : 'slide',
            height        : 450,
            width         : 1000,
            responsive    : true,
            randomstart   : true
          });
					
	$('.wrapper, .wrapper2').hover(
		function(){
			$(this).find('img').animate({opacity: ".6"}, 300);		
			$(this).find('.caption').animate({top:"-56px"}, 300);			
		}, 
		function(){
			$(this).find('img').animate({opacity: "1.0"}, 300);					
			$(this).find('.caption').animate({top:"56px"}, 100);
		}		
		);























});