document.addEventListener('DOMContentLoaded', () => {

    function onYouTubeIframeAPIReady() {
        const player = new YT.Player('youtube-player', {
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady(event) {
        event.target.playVideo(); // Auto-play the video
    }

    function onPlayerStateChange(event) {
        if (event.data === YT.PlayerState.ENDED) {
            event.target.seekTo(0); // Seek to the beginning of the video
            event.target.playVideo(); // Play the video again
        }
    }

    // Load the YouTube IFrame Player API asynchronously
    const tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    const firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    let menu = document.querySelector('#menu-bars');
    let navbar = document.querySelector('.navbar');
    let searchIcon = document.querySelector('#search-icon');
    let searchForm = document.querySelector('#search-form');
    let closeIcon = document.querySelector('#close');

    menu.onclick = () => {
        menu.classList.toggle('fa-times');
        navbar.classList.toggle('active');
    };

    window.onscroll = () => {
        menu.classList.remove('fa-times');
        navbar.classList.remove('active');
    };

    searchIcon.onclick = () => {
        searchForm.classList.toggle('active');
    };

    closeIcon.onclick = () => {
        searchForm.classList.remove('active');
    };

    // Scroll to section when a link in the "Quick Links" section is clicked
    const quickLinks = document.querySelectorAll('.footer .box:nth-child(2) a');
    quickLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default behavior of anchor tags
            const targetId = link.getAttribute('href').substring(1); // Get target section id
            const targetSection = document.getElementById(targetId); // Get target section

            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' }); // Scroll to the target section smoothly
            }
        });
    });

    // Swiper for the review slider
    var reviewSwiper = new Swiper(".review-slider", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        loop: true,
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });

    var homeSwiper = new Swiper(".home-slider", {
        spaceBetween: 20,
        centeredSlides: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        allowTouchMove: true,
    });

});