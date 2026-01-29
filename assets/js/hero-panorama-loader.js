/**
 * Hero Panorama Interactive Loader
 * Loads required libraries and initializes WebGL effects
 */

(function () {
    'use strict';

    // Check if we're on the technologies page
    const isTargetPage = document.querySelector('#heroPanorama');
    if (!isTargetPage) return;

    // Load GSAP if not already loaded
    if (typeof gsap === 'undefined') {
        loadScript('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', initGSAP);
    } else {
        initGSAP();
    }

    function initGSAP() {
        // Load Curtains.js
        if (typeof Curtains === 'undefined') {
            loadScript('https://cdn.jsdelivr.net/npm/curtainsjs@8.1.6/dist/curtains.min.js', initComplete);
        } else {
            initComplete();
        }
    }

    function initComplete() {
        console.log('Hero Panorama libraries loaded successfully');
        // Trigger custom event for initialization
        document.dispatchEvent(new Event('heroPanoramaReady'));
    }

    function loadScript(src, callback) {
        const script = document.createElement('script');
        script.src = src;
        script.async = true;
        script.onload = callback;
        script.onerror = function () {
            console.error('Failed to load script:', src);
            // Fallback: hide glitch loader
            // Note: Text elements are now always visible via CSS (opacity: 1)
            const glitchLoader = document.getElementById('glitchLoader');
            if (glitchLoader) {
                glitchLoader.style.display = 'none';
            }
            // Hero text is now static via CSS - no JS manipulation needed
        };
        document.head.appendChild(script);
    }

    // Preload hero image for better performance
    const heroImage = document.querySelector('.hero-panorama-image');
    if (heroImage && heroImage.src) {
        const img = new Image();
        img.src = heroImage.src;
    }

})();
