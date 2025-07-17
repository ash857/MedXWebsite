function toggleMobileMenu(menu) {
    menu.classList.toggle('open');
}


function initCarousel(carousel) {
  const track = carousel.querySelector('.carousel-content');
  const slides = Array.from(carousel.querySelectorAll('.carousel-slide'));
  const nextButton = carousel.querySelector('.carousel-btn.next');
  const prevButton = carousel.querySelector('.carousel-btn.prev');
  const dotsContainer = carousel.querySelector('.carousel-dots');

  let currentPage = 0;
  let slidesPerPage = 1;
  let offset = 0;

  function calculateSlidesPerPage() {
    const path = window.location.pathname;
    const isHome = path === "/" || path.includes("index") || path.includes("about");
    const isTracking = path.includes("order-tracking");
    const isSpecialCarousel = carousel.classList.contains('special-carousel');
    

    const containerWidth = carousel.clientWidth;
    const minWidth = isHome ? 9999 : isTracking ? 150 : isSpecialCarousel ? 400 : 350;

    slidesPerPage = Math.max(1, Math.floor(containerWidth / minWidth));
    slides.forEach(slide => {
      slide.style.width = `${100 / slidesPerPage}%`;
    });

    updateCarousel();
    if (isHome) {
      createDots();
      setActiveDot();
    }
  }

  function updateCarousel() {
    const slideWidth = slides[0].getBoundingClientRect().width;
    const totalSlides = slides.length;
    const maxOffset = (totalSlides - slidesPerPage) * slideWidth;
    offset = Math.min(currentPage * slidesPerPage * slideWidth, maxOffset);
    track.style.transform = `translateX(-${offset}px)`;
  }

  function nextSlide() {
    const maxPage = Math.ceil(slides.length / slidesPerPage) - 1;
    currentPage = currentPage >= maxPage ? 0 : currentPage + 1;
    updateCarousel();
    setActiveDot();
  }

  function prevSlide() {
    const maxPage = Math.ceil(slides.length / slidesPerPage) - 1;
    currentPage = currentPage <= 0 ? maxPage : currentPage - 1;
    updateCarousel();
    setActiveDot();
  }

  function createDots() {
    dotsContainer.innerHTML = "";
    const pageCount = Math.ceil(slides.length / slidesPerPage);
    for (let i = 0; i < pageCount; i++) {
      const dot = document.createElement("span");
      dot.classList.add("dot");
      if (i === currentPage) dot.classList.add("active");
      dot.addEventListener("click", () => {
        currentPage = i;
        updateCarousel();
        setActiveDot();
      });
      dotsContainer.appendChild(dot);
    }
  }

  function setActiveDot() {
    dotsContainer.querySelectorAll(".dot").forEach((dot, index) => {
      dot.classList.toggle("active", index === currentPage);
    });
  }

  nextButton?.addEventListener("click", nextSlide);
  prevButton?.addEventListener("click", prevSlide);
  window.addEventListener("resize", calculateSlidesPerPage);

  calculateSlidesPerPage();
}

// Initialize all carousels
document.querySelectorAll('.carousel-container').forEach(initCarousel);




let navbar = document.getElementById('top-nav-container');

const navbarInitialPosition = navbar.offsetTop + 100; // Adjust this value to your needs

window.addEventListener('scroll', function() {
    if (window.scrollY >= navbarInitialPosition) {
        navbar.classList.add('sticky-nav');
    } else {
        navbar.classList.remove('sticky-nav');
    }
});

let isHoveringSidebarToggle = false;
const sidebarToggle = document.querySelector('.category-sidebar-toggle');
sidebarToggle.addEventListener('mouseenter', function() {
    isHoveringSidebarToggle = true;
});

sidebarToggle.addEventListener('mouseleave', function() {
    isHoveringSidebarToggle = false;
});

function navBarHover() {
  let sidebar = document.querySelector('.category-sidebar');
  let sidebarToggle = sidebar.getBoundingClientRect();
  let sidebarWidth = sidebarToggle.left + sidebarToggle.width;

  if (window.scrollY > navbarInitialPosition && window.mouseY < 60 && window.mouseX > sidebarWidth && !isHoveringSidebarToggle) {
      navbar.style.top = '0';
      moveSidebarToggle(toggle = true);
  } else {
      navbar.style.top = '-25%'; 
      moveSidebarToggle(toggle = false);
  }
  if (window.scrollY < navbarInitialPosition) {
      moveSidebarToggle(toggle = true);
  }
}

window.addEventListener('mousemove', (e) => {
    window.mouseY = e.clientY;
    window.mouseX = e.clientX;
    navBarHover();
});


function toggleSideBar(){
  let sidebar = document.querySelector('.category-sidebar');
  let body = document.querySelector('.body');

  sidebar.classList.toggle('open');
  body.classList.toggle('shifted');
  calculateSlidesPerPage();
}

function toggleTrackingSidebar(){
  let sidebar = document.querySelector('.tracking-sidebar');
  let body = document.querySelector('.tracking-body');

  sidebar.classList.toggle('open');
  body.classList.toggle('shifted');
}

function goToMenu(){
  let menuContent = document.querySelector('.store-content');
  let categoryContent = document.querySelector('.category-content');

  menuContent.classList.add('fade-out');
  categoryContent.classList.add('fade-out');

  setTimeout(() => {
    menuContent.style.display = 'none';
    menuContent.classList.remove('fade-out');
    categoryContent.style.display = 'none';
    categoryContent.classList.remove('fade-out');

    menuContent.style.display = 'flex';
    menuContent.classList.add('fade-in');

    setTimeout(() => {
      menuContent.classList.remove('fade-in');
    }, 200);

    calculateSlidesPerPage();
  }, 200);

  let buttons = document.querySelectorAll('.category-button');

  buttons.forEach(button => {
    button.classList.remove('active');
    button.addEventListener('click', function() {
      button.classList.add('active');
    });
  });
}

function goToCategory(categoryName){
  let menuContent = document.querySelector('.store-content');
  let categoryContent = document.querySelector('.category-content');
  let categoryHeader = document.querySelector('.category-content h2');

  menuContent.classList.add('fade-out');
  categoryContent.classList.add('fade-out');

  setTimeout(() => {
    menuContent.style.display = 'none';
    menuContent.classList.remove('fade-out');
    categoryContent.style.display = 'none';
    categoryContent.classList.remove('fade-out');

    categoryHeader.innerText = categoryName;
    categoryContent.style.display = 'flex';
    categoryContent.classList.add('fade-in');

    setTimeout(() => {
      categoryContent.classList.remove('fade-in');
    }, 200);

    calculateSlidesPerPage();
  }, 200);

  let buttons = document.querySelectorAll('.category-button');

  buttons.forEach(button => {
    button.classList.remove('active');
    button.addEventListener('click', function() {
      button.classList.add('active');
    });
  });

}

function moveSidebarToggle(toggle) {
  const nav = document.getElementById('top-nav-container');
  const sidebarToggle = document.querySelector('.category-sidebar-toggle');
  if (window.scrollY < 100 || toggle == true) {
    sidebarToggle.style.top = `${nav.offsetHeight}px`;
  } else {
    sidebarToggle.style.top = `0.1rem`;
  }
}

function loginPressed(){
  const loginBtn = document.querySelector('.login-btn');
  const signupBtn = document.querySelector('.signup-btn');
  const loginContainer = document.querySelector('.login-container');
  const signupContainer = document.querySelector('.signup-container');
  loginBtn.classList.add('active');
  signupBtn.classList.remove('active');
  loginContainer.style.display = `flex`;
  signupContainer.style.display = `none`;
}

function signupPressed(){
  const loginBtn = document.querySelector('.login-btn');
  const signupBtn = document.querySelector('.signup-btn');
  const loginContainer = document.querySelector('.login-container');
  const signupContainer = document.querySelector('.signup-container');
  loginBtn.classList.remove('active');
  signupBtn.classList.add('active');
  loginContainer.style.display = `none`;
  signupContainer.style.display = `flex`;
}

document.querySelector('.account-details-form-2').addEventListener('submit', function(e) {
  e.preventDefault();
});

function toggleCart(){
  const cart = document.querySelector('.cart-container');
  const body2 = document.querySelector('.checkout-body');
  cart.classList.toggle('open');
  body2.classList.toggle('cart-shifted');
}


function trackingButtonPressed(){
  let menuContent = document.querySelector('.order-container');
  let categoryContent = document.querySelector('.order-container');

  menuContent.classList.add('fade-out');
  categoryContent.classList.add('fade-out');

  setTimeout(() => {
    menuContent.style.display = 'none';
    menuContent.classList.remove('fade-out');
    categoryContent.style.display = 'none';
    categoryContent.classList.remove('fade-out');

    categoryContent.style.display = 'flex';
    categoryContent.classList.add('fade-in');

    setTimeout(() => {
      categoryContent.classList.remove('fade-in');
    }, 200);

    calculateSlidesPerPage();
  }, 200);

  let buttons = document.querySelectorAll('.order-tracking-button');

  buttons.forEach(button => {
    button.classList.remove('active');
    button.addEventListener('click', function() {
      button.classList.add('active');
    });
  });
}

function copyOrderText(el) {
  const text = el.querySelector(".text-to-copy").textContent;
  navigator.clipboard.writeText(text);
  const tooltip = el.querySelector(".tooltip-text");
  const tooltipText = el.querySelector(".tooltip-text").textContent;
  tooltip.textContent = "Copied!";
  setTimeout(() => tooltip.textContent = tooltipText, 2000);
}

function toggleTimeline() {
  const el = document.querySelector(".timeline");
  el.classList.toggle("show");
}


