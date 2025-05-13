function toggleMobileMenu(menu) {
    menu.classList.toggle('open');
}


const carousel = document.querySelector('.carousel-container');
const track = carousel.querySelector('.carousel-content');
const slides = Array.from(carousel.querySelectorAll('.carousel-slide'));
const nextButton = carousel.querySelector('.carousel-btn.next');
const prevButton = carousel.querySelector('.carousel-btn.prev');
const dotsContainer = carousel.querySelector('.carousel-dots');
let offset;
let currentPage = 0;
let slidesPerPage = 1;

const totalSlides = slides.length;
const remainingSlides = totalSlides % slidesPerPage;

function calculateSlidesPerPage() {
  const isHomePage = window.location.pathname === "/" || window.location.pathname.includes("index");
  if (isHomePage) {
    slidesPerPage = 1;
  } else {
    const containerWidth = carousel.clientWidth;
    const slideMinWidth = 350;
    slidesPerPage = Math.max(1, Math.floor(containerWidth / slideMinWidth));
  }

  slides.forEach(slide => {
    slide.style.width = `${100 / slidesPerPage}%`;
  });

  updateCarousel();
  createDots();
  setActiveDot();
} 

function updateCarousel() {
  const slideWidth = slides[0].getBoundingClientRect().width;
  let slidesLeft = totalSlides - currentPage * slidesPerPage;
  if (slidesLeft < slidesPerPage) {
    const maxOffset = (totalSlides - slidesPerPage) * slideWidth;
    offset = Math.max(0, maxOffset); 
  } else {
    offset = currentPage * slideWidth * slidesPerPage;
  }
  track.style.transform = `translateX(-${offset}px)`;
}

function nextSlide() {
  const maxPage = Math.ceil(slides.length / slidesPerPage) - 1;
  currentPage = (currentPage + 1) > maxPage ? 0 : currentPage + 1;
  updateCarousel();
  setActiveDot();
}

function prevSlide() {
  const maxPage = Math.ceil(slides.length / slidesPerPage) - 1;
  currentPage = (currentPage - 1) < 0 ? maxPage : currentPage - 1;
  updateCarousel();
  setActiveDot();
}

function createDots() {
  dotsContainer.innerHTML = "";
  const pageCount = Math.ceil(slides.length / slidesPerPage);
  for (let i = 0; i < pageCount; i++) {
    const dot = document.createElement("span");
    dot.classList.add("dot");
    dot.addEventListener("click", () => {
      currentPage = i;
      updateCarousel();
      setActiveDot();
    });
    dotsContainer.appendChild(dot);
  }
}

function setActiveDot() {
  const dots = dotsContainer.querySelectorAll(".dot");
  dots.forEach(dot => dot.classList.remove("active"));
  if (dots[currentPage]) {
    dots[currentPage].classList.add("active");
  }
}

nextButton.addEventListener("click", nextSlide);
prevButton.addEventListener("click", prevSlide);
window.addEventListener("resize", calculateSlidesPerPage);

calculateSlidesPerPage();


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