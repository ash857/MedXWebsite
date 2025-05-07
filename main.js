function toggleMobileMenu(menu) {
    menu.classList.toggle('open');
}


const track = document.querySelector('.carousel-content');
const slides = document.querySelectorAll('.carousel-slide');
const nextButton = document.querySelector('.carousel-btn.next');
const prevButton = document.querySelector('.carousel-btn.prev');
const dots = document.querySelectorAll('.carousel-dots .dot');
let currentIndex = 0;
let slideInterval = setInterval(nextSlide, 5000);  // Change slide every 3 seconds

function updateSlidePosition() {
    const slideWidth = slides[0].clientWidth;
    track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlidePosition();
    setActiveIndicator();
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    updateSlidePosition();
    setActiveIndicator();
}

function setSlide(Index){
    currentIndex = Index;
    updateSlidePosition();
    setActiveIndicator();
}

function setActiveIndicator() {
    dots.forEach((dot, index) => {
        dot.classList.remove('active');
    });
    if (dots[currentIndex]) {
        dots[currentIndex].classList.add('active');
    }
}


nextButton.addEventListener('click', () => {
    nextSlide();
    resetInterval();
});
  
prevButton.addEventListener('click', () => {
    prevSlide();
    resetInterval();
});
  
function resetInterval() {
    clearInterval(slideInterval);
}
  
window.addEventListener('resize', updateSlidePosition); // Adjust on resize

let navbar = document.getElementById('top-nav-container');

const navbarInitialPosition = navbar.offsetTop + 100; // Adjust this value to your needs

window.addEventListener('scroll', function() {
    if (window.scrollY >= navbarInitialPosition) {
        navbar.classList.add('sticky-nav');
    } else {
        navbar.classList.remove('sticky-nav');
    }
});

function navBarHover() {
    if (window.scrollY > navbarInitialPosition && window.mouseY < 60) {
        navbar.style.top = '0';
    } else {
        navbar.style.top = '-25%'; 
    }
}

window.addEventListener('mousemove', (e) => {
    window.mouseY = e.clientY;
    navBarHover();
});