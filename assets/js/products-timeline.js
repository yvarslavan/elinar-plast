/**
 * Products Timeline Animation Script
 * Handles the interactive vertical timeline on the products page.
 * Supports GSAP via elinarGsapReady wrapper for defer loading efficiency.
 */

document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    const timelineSection = document.querySelector('.process-timeline-section');
    const timelineContainer = document.querySelector('.process-timeline');
    const progressBar = document.querySelector('.timeline-progress-bar');
    const items = document.querySelectorAll('.timeline-item');

    if (!timelineSection || !progressBar || !items.length) return;

    // Функция инициализации через GSAP
    function initGsapTimeline(gsap) {
        if (typeof ScrollTrigger === 'undefined') {
            console.warn('ScrollTrigger not loaded, falling back to IntersectionObserver');
            initFallbackTimeline();
            return;
        }

        gsap.registerPlugin(ScrollTrigger);
        console.log('GSAP Timeline Initialized');

        // 1. Animate Progress Bar
        gsap.to(progressBar, {
            height: '100%',
            ease: 'none',
            scrollTrigger: {
                trigger: timelineContainer,
                start: 'top center',
                end: 'bottom center',
                scrub: 0.1
            }
        });

        // 2. Animate Items
        items.forEach((item, i) => {
            ScrollTrigger.create({
                trigger: item,
                start: 'top center',
                end: 'bottom center',
                onEnter: () => item.classList.add('active'),
                onLeaveBack: () => item.classList.remove('active')
            });

            gsap.fromTo(item,
                { opacity: 0, y: 50 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: item,
                        start: 'top 85%',
                        toggleActions: 'play none none reverse'
                    }
                }
            );
        });
    }

    // Функция Fallback (IntersectionObserver)
    function initFallbackTimeline() {
        console.log('Using IntersectionObserver fallback for timeline');

        const itemObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    entry.target.classList.add('active');
                }
            });
        }, {
            threshold: 0.2,
            rootMargin: "0px 0px -10% 0px"
        });

        items.forEach(item => {
            item.classList.add('fade-init');
            itemObserver.observe(item);
        });

        let isTicking = false;

        const updateOnScroll = () => {
            isTicking = false;
            const rect = timelineContainer.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            const viewCenter = windowHeight / 2;

            // Progress Bar Logic
            const totalHeight = rect.height || 1;
            const dist = viewCenter - rect.top;
            let progress = 0;

            if (dist > 0) {
                progress = (dist / totalHeight) * 100;
            }
            progress = Math.max(0, Math.min(100, progress));
            progressBar.style.height = `${progress}%`;

            // Active Class Logic
            items.forEach(item => {
                const itemRect = item.getBoundingClientRect();
                if (itemRect.top < viewCenter) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        };

        const onScroll = () => {
            if (isTicking) return;
            isTicking = true;
            requestAnimationFrame(updateOnScroll);
        };

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll);
        updateOnScroll();
    }

    // Попытка инициализации через GSAP Wrapper
    if (typeof window.elinarGsapReady === 'function') {
        window.elinarGsapReady(function (gsap) {
            initGsapTimeline(gsap);
        });
    } else {
        // Если обертки нет (старый хедер?), проверяем глобальный gsap или фоллбэк
        if (typeof gsap !== 'undefined') {
            initGsapTimeline(gsap);
        } else {
            initFallbackTimeline();
        }
    }
});
