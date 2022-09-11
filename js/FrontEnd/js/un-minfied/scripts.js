/* --------------------------------------------------------
Style Sheet for Dinamani.com

Author: Vidyut Info Solution, Chennai
Author Email: info@vidyutinfo.com
Author Website: http://vidyutinfo.com
----------------------------------------------------------*/
$(document).ready(function() {
    $('.sub-sec-subvideo').slick( {
        dots: false, infinite: true, speed: 500, slidesToShow: 3, slidesToScroll: 1, autoplay: true, autoplaySpeed: 2000, arrow:true,
		responsive: [ {
            breakpoint: 768, 
			settings: {
                slidesToShow: 1
            }
        }, 
		]
    }
    );
    $('.photo-single2').slick( {
        dots: true, infinite: true, speed: 500, slidesToShow: 4, slidesToScroll: 1, autoplay: false, autoplaySpeed: 2000
    }
    );
    $('.photo-single-mob2').slick( {
        dots: true, infinite: true, speed: 500, slidesToShow: 2, slidesToScroll: 1, autoplay: false, autoplaySpeed: 2000
    }
    ); 
	$('.GalleryDetailSlide').slick( {
        dots: true, infinite: true, speed: 500, autoplayspeed: 500, prevArrow: '<button type="button" data-role="none" class="slick-prev" title="முந்தைய  புகைப்படம்">Previous</button>', nextArrow: '<button type="button" data-role="none" class="slick-next" title="அடுத்த புகைப்படம்">Next</button>', lazyLoad: 'ondemand', slidesToShow: 1, slidesToScroll: 1, adaptiveHeight: true
    }
    );
	 $('.single-item').slick( {
        dots: true, infinite: false, speed: 500, slidesToShow: 1, slidesToScroll: 1
    });
	 $('.Week-Autoplay').slick( {
        dots: true, infinite: true, speed: 500, slidesToShow: 1, slidesToScroll: 1, autoplay:true
    });
	$('.autoplay').slick( {
        dots:true, infinite:true, speed:500, slidesToShow:2, slidesToScroll:2, autoplay:true, autoplaySpeed:2000, infinite:true, 
		responsive: [ {
            breakpoint: 768, 
			settings: {
                slidesToShow: 1,
				slidesToScroll:1,
				autoplay:true
            }
        }, 
		]
    }
    );
});