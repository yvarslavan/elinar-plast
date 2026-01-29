/**
 * Production Slider JavaScript
 * Modern slider functionality with touch support and accessibility
 */

class ProductionSlider {
    constructor() {
        this.currentSlide = 0;
        this.totalSlides = 0;
        this.isAnimating = false;
        this.autoplayInterval = null;
        this.autoplayDelay = 5000; // 5 seconds

        this.init();
    }

    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        console.log('[Production Slider] Setup starting...');

        // Get DOM elements
        this.slider = document.getElementById('productionSliderTrack');
        console.log('[Production Slider] Slider element:', this.slider);

        this.prevBtn = document.getElementById('productionSliderPrev');
        this.nextBtn = document.getElementById('productionSliderNext');
        console.log('[Production Slider] Buttons found - Prev:', !!this.prevBtn, 'Next:', !!this.nextBtn);

        // Scope slides to slider track to avoid conflicts with other sliders
        this.slides = this.slider ? this.slider.querySelectorAll('.slider-slide') : [];
        console.log('[Production Slider] Slides found:', this.slides.length);

        // Progress bar element
        this.progressBar = document.getElementById('sliderProgress');

        // Counter elements
        this.currentSlideEl = document.getElementById('current-slide');
        this.totalSlidesEl = document.getElementById('total-slides');
        console.log('[Production Slider] Counter elements - Current:', !!this.currentSlideEl, 'Total:', !!this.totalSlidesEl);

        // Check if slider exists
        if (!this.slider || !this.slides.length) {
            console.warn('[Production Slider] Setup failed - slider or slides not found');
            return; // Fail silently if element not found
        }

        this.totalSlides = this.slides.length;

        // Initialize counter total
        if (this.totalSlidesEl) {
            this.totalSlidesEl.textContent = this.totalSlides;
        }

        // Set initial position
        if (this.slider) {
            this.slider.style.transform = 'translateX(0%)';
        }

        console.log('[Production Slider] Binding events...');
        // Bind events
        this.bindEvents();

        console.log('[Production Slider] Starting autoplay...');
        // Start autoplay
        this.startAutoplay();

        // Initialize accessibility
        this.initAccessibility();

        // Initial counter update
        this.updateCounter();

        // Preload next slides immediately for smooth start
        this.preloadNextSlides();

        console.log('[Production Slider] ✓ Initialized successfully with', this.totalSlides, 'slides');
    }

    bindEvents() {
        // Navigation buttons
        if (this.prevBtn) {
            this.prevBtn.addEventListener('click', () => this.prevSlide());
        }

        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', () => this.nextSlide());
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => this.handleKeyboard(e));

        // Touch/swipe support
        this.initTouchEvents();

        // Pause autoplay on hover
        const sliderContainer = document.querySelector('.slider-container-modern');
        if (sliderContainer) {
            sliderContainer.addEventListener('mouseenter', () => this.pauseAutoplay());
            sliderContainer.addEventListener('mouseleave', () => this.startAutoplay());
        }

        // Pause autoplay when page is not visible
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.pauseAutoplay();
            } else {
                this.startAutoplay();
            }
        });
    }

    initTouchEvents() {
        let startX = 0;
        let startY = 0;
        let endX = 0;
        let endY = 0;
        const minSwipeDistance = 50;

        const sliderContainer = document.querySelector('.slider-container-modern');
        if (!sliderContainer) return;

        // Touch start
        sliderContainer.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            this.pauseAutoplay();
        }, { passive: true });

        // Touch end
        sliderContainer.addEventListener('touchend', (e) => {
            endX = e.changedTouches[0].clientX;
            endY = e.changedTouches[0].clientY;

            const deltaX = endX - startX;
            const deltaY = endY - startY;

            // Check if horizontal swipe is dominant
            if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > minSwipeDistance) {
                if (deltaX > 0) {
                    this.prevSlide();
                } else {
                    this.nextSlide();
                }
            }

            this.startAutoplay();
        }, { passive: true });
    }

    handleKeyboard(e) {
        // Only handle keyboard events when slider is in focus
        const sliderContainer = document.querySelector('.slider-container-modern');
        if (!sliderContainer || !sliderContainer.contains(document.activeElement)) {
            return;
        }

        switch (e.key) {
            case 'ArrowLeft':
                e.preventDefault();
                this.prevSlide();
                break;
            case 'ArrowRight':
                e.preventDefault();
                this.nextSlide();
                break;
            case 'Home':
                e.preventDefault();
                this.goToSlide(0);
                break;
            case 'End':
                e.preventDefault();
                this.goToSlide(this.totalSlides - 1);
                break;
        }
    }

    nextSlide() {
        console.log('[Production Slider] nextSlide called, isAnimating:', this.isAnimating, 'currentSlide:', this.currentSlide);
        if (this.isAnimating) {
            console.log('[Production Slider] nextSlide blocked - animation in progress');
            return;
        }

        const nextIndex = (this.currentSlide + 1) % this.totalSlides;
        console.log('[Production Slider] Going to slide:', nextIndex);
        this.goToSlide(nextIndex);
    }

    prevSlide() {
        if (this.isAnimating) return;

        const prevIndex = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        this.goToSlide(prevIndex);
    }

    goToSlide(index) {
        if (this.isAnimating || index === this.currentSlide || index < 0 || index >= this.totalSlides) {
            return;
        }

        this.isAnimating = true;
        this.currentSlide = index;

        // Update slider position
        const translateX = -index * 100;
        if (this.slider) {
            this.slider.style.transform = `translateX(${translateX}%)`;
            this.slider.style.willChange = 'transform';
        }

        // Update slide states and counter
        this.updateSlideStates();
        this.updateCounter();

        // Preload next slides for smooth autoplay
        this.preloadNextSlides();

        // Reset animation flag after transition
        setTimeout(() => {
            this.isAnimating = false;
        }, 500);

        // Announce slide change for screen readers
        this.announceSlideChange();
    }

    preloadNextSlides() {
        // Preload next 2 slides to prevent blank images during autoplay
        const slidesToPreload = 2;

        for (let i = 1; i <= slidesToPreload; i++) {
            const nextIndex = (this.currentSlide + i) % this.totalSlides;
            const nextSlide = this.slides[nextIndex];

            if (nextSlide) {
                const img = nextSlide.querySelector('img');
                if (img && img.loading === 'lazy') {
                    // Force load the image by setting loading to eager
                    img.loading = 'eager';

                    // If image hasn't started loading, trigger it
                    if (!img.complete) {
                        const tempImg = new Image();
                        tempImg.src = img.src;
                    }
                }
            }
        }
    }

    updateCounter() {
        if (this.currentSlideEl) {
            this.currentSlideEl.textContent = this.currentSlide + 1;
        }

        // Update progress bar (new Tailwind version)
        if (this.progressBar) {
            const progress = ((this.currentSlide + 1) / this.totalSlides) * 100;
            this.progressBar.style.width = progress + '%';
        }
    }

    updateSlideStates() {
        this.slides.forEach((slide, index) => {
            slide.classList.toggle('active', index === this.currentSlide);
            slide.setAttribute('aria-hidden', index === this.currentSlide ? 'false' : 'true');
        });
    }

    refreshLightbox() {
        // GLightbox is already initialized globally in main.js
        if (window.globalLightbox && typeof window.globalLightbox.reload === 'function') {
            window.globalLightbox.reload();
        }
    }

    startAutoplay() {
        this.pauseAutoplay(); // Clear any existing interval

        console.log('[Production Slider] startAutoplay called, delay:', this.autoplayDelay);

        this.autoplayInterval = setInterval(() => {
            console.log('[Production Slider] Autoplay tick - calling nextSlide');
            this.nextSlide();
        }, this.autoplayDelay);

        console.log('[Production Slider] Autoplay interval ID:', this.autoplayInterval);
    }

    pauseAutoplay() {
        if (this.autoplayInterval) {
            clearInterval(this.autoplayInterval);
            this.autoplayInterval = null;
        }
    }

    initAccessibility() {
        // Add ARIA labels and roles
        const sliderContainer = document.querySelector('.slider-container-modern');
        if (sliderContainer) {
            sliderContainer.setAttribute('role', 'region');
            sliderContainer.setAttribute('aria-label', 'Слайдер производства');
            sliderContainer.setAttribute('tabindex', '0');
        }

        // Set initial slide states
        this.updateSlideStates();

        // Add live region for announcements
        if (!document.getElementById('slider-announcer')) {
            const announcer = document.createElement('div');
            announcer.id = 'slider-announcer';
            announcer.setAttribute('aria-live', 'polite');
            announcer.setAttribute('aria-atomic', 'true');
            announcer.style.position = 'absolute';
            announcer.style.left = '-10000px';
            announcer.style.width = '1px';
            announcer.style.height = '1px';
            announcer.style.overflow = 'hidden';
            document.body.appendChild(announcer);
        }
    }

    announceSlideChange() {
        const announcer = document.getElementById('slider-announcer');
        if (announcer) {
            const slideTitle = this.slides[this.currentSlide]?.querySelector('.slide-title')?.textContent || '';
            announcer.textContent = `Слайд ${this.currentSlide + 1} из ${this.totalSlides}: ${slideTitle}`;
        }
    }

    // Public methods for external control
    destroy() {
        this.pauseAutoplay();

        // Remove event listeners
        if (this.prevBtn) {
            this.prevBtn.removeEventListener('click', () => this.prevSlide());
        }
        if (this.nextBtn) {
            this.nextBtn.removeEventListener('click', () => this.nextSlide());
        }

        document.removeEventListener('keydown', (e) => this.handleKeyboard(e));
        document.removeEventListener('visibilitychange', () => { });
    }

    getCurrentSlide() {
        return this.currentSlide;
    }

    getTotalSlides() {
        return this.totalSlides;
    }
}

/**
 * Team Slider Class (extends ProductionSlider)
 * Handles team photo slider on About page
 */
class TeamSlider extends ProductionSlider {
    setup() {
        // Get DOM elements for team slider
        this.slider = document.getElementById('teamSliderTrack');
        this.prevBtn = document.getElementById('teamSliderPrev');
        this.nextBtn = document.getElementById('teamSliderNext');
        this.slides = document.querySelectorAll('#teamSliderTrack .slider-slide');

        // Counter elements
        this.currentSlideEl = document.getElementById('current-slide-team');
        this.totalSlidesEl = document.getElementById('total-slides-team');

        // Check if slider exists
        if (!this.slider || !this.slides.length) {
            return; // Fail silently if element not found
        }

        this.totalSlides = this.slides.length;

        // Initialize counter total
        if (this.totalSlidesEl) {
            this.totalSlidesEl.textContent = this.totalSlides;
        }

        // Bind events
        this.bindEvents();

        // Start autoplay
        this.startAutoplay();

        // Initialize accessibility
        this.initAccessibility();

        // Initial counter update
        this.updateCounter();

        console.log('Team slider initialized with', this.totalSlides, 'slides');
    }

    initAccessibility() {
        // Add ARIA labels and roles
        const sliderContainer = document.querySelector('.slider-container-modern');
        if (sliderContainer) {
            sliderContainer.setAttribute('role', 'region');
            sliderContainer.setAttribute('aria-label', 'Слайдер команды');
            sliderContainer.setAttribute('tabindex', '0');
        }

        // Set initial slide states
        this.updateSlideStates();

        // Add live region for announcements
        if (!document.getElementById('team-slider-announcer')) {
            const announcer = document.createElement('div');
            announcer.id = 'team-slider-announcer';
            announcer.setAttribute('aria-live', 'polite');
            announcer.setAttribute('aria-atomic', 'true');
            announcer.style.position = 'absolute';
            announcer.style.left = '-10000px';
            announcer.style.width = '1px';
            announcer.style.height = '1px';
            announcer.style.overflow = 'hidden';
            document.body.appendChild(announcer);
        }
    }

    announceSlideChange() {
        const announcer = document.getElementById('team-slider-announcer');
        if (announcer) {
            const slideTitle = this.slides[this.currentSlide]?.querySelector('img')?.getAttribute('alt') || '';
            announcer.textContent = `Слайд ${this.currentSlide + 1} из ${this.totalSlides}: ${slideTitle}`;
        }
    }
}

// Initialize sliders when DOM is ready
let productionSlider;
let teamSlider;

function initializeSliders() {
    console.log('[Production Slider] Initializing sliders...');
    console.log('[Production Slider] DOM readyState:', document.readyState);

    // Initialize production slider (for homepage)
    const productionTrack = document.getElementById('productionSliderTrack');
    console.log('[Production Slider] Production track found:', !!productionTrack);

    if (productionTrack) {
        console.log('[Production Slider] Creating ProductionSlider instance...');
        productionSlider = new ProductionSlider();
    } else {
        console.log('[Production Slider] No production slider track found on this page');
    }

    // Initialize team slider (for about page)
    const teamTrack = document.getElementById('teamSliderTrack');
    if (teamTrack) {
        console.log('[Team Slider] Creating TeamSlider instance...');
        teamSlider = new TeamSlider();
    }

    // Initialize Stats Animation
    initStatsAnimation();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeSliders);
} else {
    // DOM already loaded, initialize immediately
    initializeSliders();
}

/**
 * Stats Animation for Modern Production Section
 */
function initStatsAnimation() {
    const statsSection = document.querySelector('.production-stats-area');
    if (!statsSection) return;

    const options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.2
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateNumbers();
                observer.unobserve(entry.target);
            }
        });
    }, options);

    observer.observe(statsSection);
}

function animateNumbers() {
    const stats = document.querySelectorAll('.stat-value[data-target]');

    stats.forEach(stat => {
        const target = +stat.getAttribute('data-target');
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps

        let current = 0;

        const updateCount = () => {
            current += increment;

            if (current < target) {
                stat.textContent = Math.ceil(current);
                requestAnimationFrame(updateCount);
            } else {
                stat.textContent = target;
            }
        };

        updateCount();
    });
}

// Export for potential external use
window.ProductionSlider = ProductionSlider;
window.TeamSlider = TeamSlider;
window.productionSlider = productionSlider;
window.teamSlider = teamSlider;
