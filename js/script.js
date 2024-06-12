document.addEventListener('DOMContentLoaded', () => {
    // Your JavaScript code here
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
            delay: 1000,
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

    // Swiper for the home slider
    var homeSwiper = new Swiper(".home-slider", {
        spaceBetween: 20,
        centeredSlides: true,
        autoplay: {
            delay: 500,
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