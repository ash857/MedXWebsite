function toggleMobileMenu(menu) {
    menu.classList.toggle('open');
}


const track = document.querySelector('.carousel-content');
const slides = document.querySelectorAll('.carousel-slide');
const nextButton = document.querySelector('.carousel-btn.next');
const prevButton = document.querySelector('.carousel-btn.prev');
let currentIndex = 0;
let slideInterval = setInterval(nextSlide, 3000);  // Change slide every 3 seconds

function updateSlidePosition() {
    const slideWidth = slides[0].clientWidth;
    track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlidePosition();
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    updateSlidePosition();
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
    slideInterval = setInterval(moveToNextSlide, 4000);
}
  
window.addEventListener('resize', updateSlidePosition); // Adjust on resize