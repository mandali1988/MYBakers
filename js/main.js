
window.onscroll = function () {
    const btn = document.getElementById("goTopBtn");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        btn.style.display = "block";
    } else {
        btn.style.display = "none";
    }
};

// Scroll to top on click
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

$(document).ready(function () {
    $('.your-slider').slick({
        dots: false,
        infinite: true,        
        speed: 300,
        prevArrow: $('.custom-prev'),
        nextArrow: $('.custom-next'),
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1, 
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    
    $('.ourproduct-sld').slick({
        dots: false,
        infinite: true, // Set this to true in default 
        speed: 300,
        prevArrow: $('.custom-prev-1'),
        nextArrow: $('.custom-next-1'),
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1 
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

});