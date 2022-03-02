// Create a WaveSurfer instance
var wavesurfer;
var activeElement;

$(document).ready(function() {
    wavesurfer = WaveSurfer.create({
        container: document.querySelector('#waveform'),
        // barWidth: 2,
        // barHeight: 1,
        // barGap: null,
        backgroundColor: "rgba(0, 0, 0, 0.1)",
        cursorColor: "purple",
        cursorWidth: "2",
        height: 45,
        pixelRatio: 1,
        progressColor: "rgba(255, 255, 255, 0.7)",
        responsive: false,
        waveColor: "rgba(0, 0, 0, 0.5)",
        // html5: true,
        // preload: true,
        // partialRender: true,
        backend: 'MediaElement'
    });

    wavesurfer.on('ready', function() {
        wavesurfer.play();
    });

    var links = $('[data-action="play"]');
    var currentTrack = 0;
    var is_playing = false;

    var setCurrentSong = function(index) {
        currentTrack = index;
        wavesurfer.load($(links[currentTrack]).attr('href'));
    };

    $(links).each(function(index, link) {
        $(link).on('click', function(e) {
            e.preventDefault();
            var track_currency = $(this).data('currency');
            var track_title = $(this).data('title');
            var track_price = track_currency + $(this).data('price');
            var track_category = $(this).data('category');
            var track_thumbnail = $(this).data('thumbnail');
            var track_url = $(this).data('url');

            var track_wrapper_parent = $(this).closest('.card-body');

            $('.track-player').addClass('player-show');

            activeElement = $(this);
            if(currentTrack == index) {
                is_playing != is_playing;
                $(track_wrapper_parent).find('.audio-triangle').toggleClass('is-playing').trigger('play_status_changed');
                // $(this).find("span").toggleClass("ti-control-pause ti-control-play");
                wavesurfer.playPause();
                return;
            } else {
                is_playing = true;

                $('body').find('.audio-triangle').removeClass('is-playing').trigger('play_status_changed');
                $(track_wrapper_parent).find('.audio-triangle').toggleClass('is-playing').trigger('play_status_changed');
            };

            setCurrentSong(index);
            $('.player-wrapper').find('.track-title').html(track_title);
            $('.player-wrapper').find('.price').html(track_price);
            $('.player-wrapper').find('.track-category').html(track_category);
            $('.player-wrapper').find('.track-cover-image').attr('src', track_thumbnail);
            $('.player-wrapper').find('.cart-button').attr('href', track_url);

        });
    });

    $(".player-wrapper .track-controls").on("click", function() {
        wavesurfer.playPause();

        is_playing != is_playing;
        $(this).find("span").toggleClass("ti-control-pause ti-control-play").trigger('play_status_changed');

    });

    wavesurfer.on('loading', function(e) {
        console.log('loading');
        
        $('body').find('.track-waveform .loader').removeClass('done');
        $('body').find('.track-waveform .loader').addClass('loading');
    });

    wavesurfer.on('waveform-ready', function(e) {
        console.log('ready');
        
        $('body').find('.track-waveform .loader').removeClass('loading');
        $('body').find('.track-waveform .loader').addClass('done');
    });

    wavesurfer.on('finish', function(e) {
        console.log("stopped");
    });

    wavesurfer.on('error', function(e) {
        console.warn(e);
    });
});

// Bootstrap upload file label display
$('input[type="file"]').change(function(e) {
	var fileName = e
		.target
		.files[0]
		.name;
	$('.custom-file-label').html(fileName);
});

// Woocommerce-specific JS
//
// Add to cart AJAX
$( document.body ).on( 'added_to_cart', function(a, b, c, d){
    $('.notification .message').html('Product added to cart');
    $('.notification').addClass('show').delay(2000).queue(function(next){
         $(this).removeClass('show');
         next();
    });

    $('.post-' + d.data('product_id')).find('.add_to_cart_button').replaceWith(function() {
        return $('<a href="http://localhost/sound-boutiques/cart/" class="added-to-cart" title="View cart"><span class="ti-check-box"></span></a>');
    });
});


// From main page footer
// Home and Templates page slider
$('.slider-slick-image').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    dots: true,
    // asNavFor: '.slider-nav-thumbnails',
    autoplay: true
});

// Product carousel
var carousel_arr = ['.owl-carousel-featured', '.owl-carousel-hot-deals', '.owl-carousel-best-sellers', '.owl-carousel-newest', '.owl-carousel-presets', '.owl-carousel-templates'];

$.each(carousel_arr, function(index, value) {
    $(value).owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        navContainer: value.replace('carousel', 'navs'),
        responsive:{
            0: {
                items: 1
            }
        }
    });
});

// Templates carousel for mobile
$(".templates-banner-mobile").owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    // navContainer: value.replace('carousel', 'navs'),
    responsive: {
        0: {
            items: 1
        }
    }
});

// Templates page video
var stopVideo = function() {
    var element = document.querySelector('.modal-content');
    var iframe = element.querySelector('iframe');
    var video = element.querySelector('video');
    if (iframe) {
        var iframeSrc = iframe.src;
        iframe.src = iframeSrc;
    }
    if (video) {
        video.pause();
    }
};
$('.launch-modal').on('click', function(e){
    e.preventDefault();
    $( '#' + $(this).data('modal-id') ).modal();
});

// Login menu handler
$('.login-nav .login-nav-link').on('click mouseover', function(e) {
    $('.login-form-wrapper').toggleClass('show');
    e.stopPropagation();
});

$('.login-form-wrapper').on('click mouseover', function(e) {
    e.stopPropagation();
});

$(document).on('click mouseover', function(){
    $('.login-form-wrapper').removeClass('show');
});

// Mega-menu JS
$('#menu-item-47, .sb-mega-menu').on("mouseover", function () {
    var value = $(this).data("");
    $("body").find(".sb-mega-menu").css({"opacity": "1", "z-index": "999999", "height": "auto", "display": "block"});
});

$('#menu-item-47, .sb-mega-menu').on("mouseout", function () {
    var value = $(this).data("");
    $("body").find(".sb-mega-menu").css({"opacity": "0", "z-index": "-1", "height": "0", "display": "none"});
});