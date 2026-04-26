// Open / Close the mobile menu
const toggle = document.querySelector(".estatein-toggle");
const mobileMenu = document.querySelector(".estatein-mobile-menu");

    toggle.addEventListener("click", () => {
    mobileMenu.classList.toggle("active");
});


// Keep the topbar clossed 
const topbar = document.querySelector('.estatein-topbar');
const closeBtn = document.querySelector('.estatein-close');

  // verifică dacă a fost închis înainte
  if (localStorage.getItem('topbarClosed') === 'true') {
    topbar.style.display = 'none';
  }

  closeBtn.addEventListener('click', function () {
    topbar.style.display = 'none';
    localStorage.setItem('topbarClosed', 'true');
  });




// Swipers present in the homepage, they use the same code since they are similar
const allSwipers = document.querySelectorAll(
  ".propertySwiper, .testimonialSwiper, .faqSwiper"
);

allSwipers.forEach((swiperEl) => {
  const container = swiperEl.closest(".container");

  const isProperty = swiperEl.classList.contains("propertySwiper");
  const isTestimonial = swiperEl.classList.contains("testimonialSwiper");
  const isFaq = swiperEl.classList.contains("faqSwiper");

  const swiper = new Swiper(swiperEl, {
    loop: true,
    spaceBetween: 30,
  

    // Custom settings for Property Swiper
    ...(isProperty && {

      breakpoints: {
        768: { slidesPerView: 2 },
        1100: { slidesPerView: 3, spaceBetween: 20 },
        1441: { slidesPerView: 3, spaceBetween: 30 }
      }
    }),

    // Custom settings for Testimonial Swiper
    ...(isTestimonial && {
      
      breakpoints: {
        768: { slidesPerView: 2 },
        1100: { slidesPerView: 3, spaceBetween: 20 },
        1441: { slidesPerView: 3, spaceBetween: 30 }
      },
     
    }),

    // Custom settings for FAQ Swiper
    ...(isFaq && {
      
      breakpoints: {
        768: { slidesPerView: 2 },
        1100: { slidesPerView: 3, spaceBetween: 20 },
        1441: { slidesPerView: 3, spaceBetween: 30 }
      }
    }),

    // Navigation
    navigation: {
      nextEl: container.querySelector(".next-btn"),
      prevEl: container.querySelector(".prev-btn"),
    },

    // Update to count nr of slides
    on: {
      init() {
        updateCounter(this);
      },
      slideChange() {
        updateCounter(this);
      }
    }
  });
});

// Function that counts the nr of slides and shows it at the bottom of swiper
function updateCounter(swiper) {
  const container = swiper.el.closest(".container");

  const currents = container.querySelectorAll(".currentSlide");
  const totals = container.querySelectorAll(".totalSlides");

  const realSlides = swiper.wrapperEl.querySelectorAll(
    ".swiper-slide:not(.swiper-slide-duplicate)"
  );

  const totalSlides = realSlides.length;
  const currentIndex = swiper.realIndex + 1;

  const currentText = String(currentIndex).padStart(2, "0");
  const totalText = String(totalSlides).padStart(2, "0");

  currents.forEach(el => el.textContent = currentText);
  totals.forEach(el => el.textContent = totalText);
}