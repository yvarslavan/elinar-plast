document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    // === 1. COUNTER ANIMATION ===
    const statsSection = document.querySelector('.section-team-redesigned');
    const statsNumbers = document.querySelectorAll('.stat-number');
    let started = false;

    function animateValue(obj, start, end, duration, prefix = '', suffix = '') {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);

            // Easing function (easeOutQuart)
            const easeProgress = 1 - Math.pow(1 - progress, 4);

            const currentVal = Math.floor(easeProgress * (end - start) + start);
            obj.innerHTML = prefix + currentVal + suffix;

            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                obj.innerHTML = prefix + end + suffix; // Ensure final value is exact
            }
        };
        window.requestAnimationFrame(step);
    }

    if (statsSection && statsNumbers.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !started) {
                    started = true;
                    statsNumbers.forEach(stat => {
                        const targetRaw = stat.getAttribute('data-target');
                        if (!targetRaw) return;

                        // Parse prefix/suffix (e.g. ">20" or "100%")
                        let prefix = '';
                        let suffix = '';
                        let targetVal = targetRaw;

                        if (targetRaw.includes('>')) {
                            prefix = '> ';
                            targetVal = targetRaw.replace('>', '');
                        }
                        if (targetRaw.includes('%')) {
                            suffix = '%';
                            targetVal = targetRaw.replace('%', '');
                        }

                        const endValue = parseInt(targetVal, 10);

                        // Special handling for years (e.g. 2001) - animate from 1990
                        const startValue = endValue > 1000 ? 1990 : 0;
                        const duration = 2000;

                        animateValue(stat, startValue, endValue, duration, prefix, suffix);
                    });
                }
            });
        }, { threshold: 0.3 });

        observer.observe(statsSection);
    }

    // === 2. IMAGE PARALLAX / SLOW ZOOM ===
    const teamImgWrapper = document.querySelector('.team-photo-wrapper');
    const teamImg = teamImgWrapper ? teamImgWrapper.querySelector('img') : null;

    if (teamImgWrapper && teamImg) {
        let isTicking = false;

        const updateParallax = () => {
            isTicking = false;
            const rect = teamImgWrapper.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            // Calculate visibility (0 to 1)
            if (rect.top < windowHeight && rect.bottom > 0) {
                const scrollPercent = (windowHeight - rect.top) / (windowHeight + rect.height);
                // Scale from 1.0 to 1.15 based on scroll
                const scale = 1.0 + (scrollPercent * 0.15);
                teamImg.style.transform = `scale(${scale})`;
            }
        };

        const onScroll = () => {
            if (isTicking) return;
            isTicking = true;
            requestAnimationFrame(updateParallax);
        };

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll);
        updateParallax();
    }
});
