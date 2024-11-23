var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    loop:true,
    spaceBetween: 30,
    freeMode: true,
    autoplay: {
      delay: 2000,
      disableOnInteraction: false,
    },
    breakpoints: {
  0: {
      slidesPerView: 1,
  },
  768: {
      slidesPerView: 5,
  },
  1000: {
    slidesPerView: 5,
  },
  1024: {
      slidesPerView: 5,
  }
  },
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },

  });