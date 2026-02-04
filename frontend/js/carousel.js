// Carousel functionality
class HomepageCarousel {
  constructor() {
    this.slides = document.querySelectorAll('.carousel-slide');
    this.indicators = document.querySelectorAll('.indicator');
    this.currentSlide = 0;
    this.slideInterval = null;
    this.init();
  }

  init() {
    // Navigation buttons
    document.querySelector('.carousel-prev').addEventListener('click', () => this.prev());
    document.querySelector('.carousel-next').addEventListener('click', () => this.next());

    // Indicators
    this.indicators.forEach((indicator, index) => {
      indicator.addEventListener('click', () => this.goToSlide(index));
    });

    // Auto-play
    this.autoPlay();

    // Pause on hover
    const carousel = document.querySelector('.hero-carousel');
    carousel.addEventListener('mouseenter', () => this.stopAutoPlay());
    carousel.addEventListener('mouseleave', () => this.autoPlay());
  }

  showSlide(index) {
    // Remove active class from all slides and indicators
    this.slides.forEach(slide => slide.classList.remove('active'));
    this.indicators.forEach(indicator => indicator.classList.remove('active'));

    // Add active class to current slide and indicator
    this.slides[index].classList.add('active');
    this.indicators[index].classList.add('active');
  }

  next() {
    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
    this.showSlide(this.currentSlide);
    this.resetAutoPlay();
  }

  prev() {
    this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
    this.showSlide(this.currentSlide);
    this.resetAutoPlay();
  }

  goToSlide(index) {
    this.currentSlide = index;
    this.showSlide(this.currentSlide);
    this.resetAutoPlay();
  }

  autoPlay() {
    this.slideInterval = setInterval(() => {
      this.next();
    }, 6000);
  }

  stopAutoPlay() {
    clearInterval(this.slideInterval);
  }

  resetAutoPlay() {
    this.stopAutoPlay();
    this.autoPlay();
  }
}

// Initialize carousel when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  new HomepageCarousel();

  // Newsletter form
  const newsletterForm = document.getElementById('newsletterForm');
  if (newsletterForm) {
    newsletterForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const email = newsletterForm.querySelector('input[type="email"]').value;
      console.log('Newsletter signup:', email);
      // TODO: Implementar envio real
      alert('Obrigado por se inscrever!');
      newsletterForm.reset();
    });
  }
});

// Smooth scroll navigation
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    if (href !== '#' && document.querySelector(href)) {
      e.preventDefault();
      document.querySelector(href).scrollIntoView({
        behavior: 'smooth'
      });
    }
  });
});
