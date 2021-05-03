$('.team-carousel').slick({
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2000,
    mobileFirst: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 767,
            settings: { slidesToShow: 2 }
        },
        {
            breakpoint: 992,
            settings: { slidesToShow: 3 }   
        },
        {
            breakpoint: 1200,
            settings: { 
                slidesToShow: 4,
                autoplay: false,
                draggable: false
            }
        }
    ]
  });