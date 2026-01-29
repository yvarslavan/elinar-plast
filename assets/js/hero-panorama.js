/**
 * Interactive Hero Panorama v4.0
 * Features: Synchronous Dual-Layer Panning, Crossfade Loop, Glitch Transition
 *
 * Key requirements:
 * - Both images move TOGETHER (synchronized panning)
 * - Crossfade every 10 seconds with 3s transition
 * - Glitch effect at peak of crossfade (when opacity ~0.5)
 */

(function () {
    'use strict';

    // Configuration per spec
    const CONFIG = {
        panDuration: 25,           // Duration of one pan cycle (seconds)
        panRange: 8,               // Pan range in percent (subtle movement)
        crossfadeInterval: 10,     // Seconds between crossfades (per spec: 10s)
        crossfadeDuration: 3,      // Duration of crossfade (per spec: 3s)
        glitchDuration: 0.6,       // Glitch effect duration (0.5-1s per spec)
        mouseParallaxStrength: 15, // Mouse parallax strength in pixels
        preloadDelay: 500          // Delay before starting animations (ms)
    };

    // Launcher that handles GSAP dependencies safely
    function runSafeInit() {
        // Use the global wrapper if available (handles defer loading)
        if (typeof window.elinarGsapReady === 'function') {
            window.elinarGsapReady(function (gsapInstance) {
                init(gsapInstance);
            });
        }
        // Fallback for immediate availability
        else if (typeof gsap !== 'undefined') {
            init(gsap);
        }
        // Legacy fallback
        else {
            console.warn('[HeroPanorama] GSAP not found and wrapper missing. Waiting...');
            const checkInterval = setInterval(() => {
                if (typeof gsap !== 'undefined') {
                    clearInterval(checkInterval);
                    init(gsap);
                }
            }, 100);

            // Stop checking after 10 seconds
            setTimeout(() => clearInterval(checkInterval), 10000);
        }
    }

    function init(gsap) {
        // Double check GSAP availability
        if (!gsap) {
            console.error('[HeroPanorama] GSAP instance missing');
            return;
        }

        const panoramaWrapper = document.getElementById('panoramaWrapper');
        const img1 = document.querySelector('.panorama-1');
        const img2 = document.querySelector('.panorama-2');
        const glitchLoader = document.getElementById('glitchLoader');
        const heroContainer = document.getElementById('heroPanorama');

        if (!panoramaWrapper || !img1) {
            // Silently fail if elements are missing (maybe not on home page)
            return;
        }

        console.log('[HeroPanorama] v4.0 Initializing with Safe GSAP Loader...');

        // State
        let currentImage = 1;
        let isImg2Loaded = false;
        let panTimeline = null;
        let crossfadeTimeline = null;

        // ============================================
        // 1. PRELOAD SECOND IMAGE
        // ============================================
        function preloadImage2() {
            return new Promise((resolve) => {
                if (!img2) {
                    resolve(false);
                    return;
                }

                // Check if already loaded
                if (img2.complete && img2.naturalHeight !== 0) {
                    isImg2Loaded = true;
                    resolve(true);
                    return;
                }

                // Force eager loading
                img2.loading = 'eager';

                img2.onload = () => {
                    isImg2Loaded = true;
                    resolve(true);
                };

                img2.onerror = () => {
                    console.error('[HeroPanorama] Image 2 failed to load');
                    resolve(false);
                };

                // Trigger load if src exists but not loading
                if (img2.src && !img2.complete) {
                    const tempImg = new Image();
                    tempImg.src = img2.src;
                }
            });
        }

        // ============================================
        // 2. INITIAL SETUP
        // ============================================
        function setupInitialState() {
            // Image 1: fully visible
            gsap.set(img1, { opacity: 1 });

            // Image 2: hidden but ready
            if (img2) {
                gsap.set(img2, { opacity: 0 });
            }

            // Wrapper: centered position
            gsap.set(panoramaWrapper, { xPercent: 0 });

            // Glitch loader: hidden
            if (glitchLoader) {
                gsap.set(glitchLoader, { opacity: 0, display: 'none' });
            }
        }

        // ============================================
        // 3. CONTINUOUS PANNING ANIMATION
        // Both images move together as one unit
        // ============================================
        function startPanning() {
            if (panTimeline) {
                panTimeline.kill();
            }

            // Smooth back-and-forth panning
            panTimeline = gsap.timeline({
                repeat: -1,
                yoyo: true,
                defaults: { ease: "sine.inOut" }
            });

            panTimeline.fromTo(panoramaWrapper,
                { xPercent: -CONFIG.panRange / 2 },
                { xPercent: CONFIG.panRange / 2, duration: CONFIG.panDuration }
            );
        }

        // ============================================
        // 4. MOUSE PARALLAX
        // ============================================
        function setupMouseParallax() {
            if (!heroContainer) return;

            let mouseX = 0;
            let mouseY = 0;
            let currentX = 0;
            let currentY = 0;
            let heroRect = null;
            let isRectTicking = false;

            const updateHeroRect = () => {
                isRectTicking = false;
                heroRect = heroContainer.getBoundingClientRect();
            };

            const scheduleRectUpdate = () => {
                if (isRectTicking) return;
                isRectTicking = true;
                requestAnimationFrame(updateHeroRect);
            };

            updateHeroRect();

            heroContainer.addEventListener('mousemove', (e) => {
                if (!heroRect || !heroRect.width || !heroRect.height) return;
                mouseX = (e.clientX - heroRect.left) / heroRect.width - 0.5;
                mouseY = (e.clientY - heroRect.top) / heroRect.height - 0.5;
            });

            heroContainer.addEventListener('mouseenter', scheduleRectUpdate);
            window.addEventListener('resize', scheduleRectUpdate, { passive: true });

            heroContainer.addEventListener('mouseleave', () => {
                mouseX = 0;
                mouseY = 0;
            });

            // Use GSAP ticker for better performance and sync
            gsap.ticker.add(() => {
                currentX += (mouseX * CONFIG.mouseParallaxStrength - currentX) * 0.05;
                currentY += (mouseY * CONFIG.mouseParallaxStrength * 0.5 - currentY) * 0.05;

                // Simple set without creating new tweens constantly
                if (Math.abs(currentX) > 0.01 || Math.abs(currentY) > 0.01) {
                    gsap.set(panoramaWrapper, {
                        x: currentX,
                        y: currentY,
                        overwrite: "auto" // Prevent conflict with panning? No, panning uses xPercent, this uses x/y pixels. They stack.
                    });
                }
            });
        }

        // ============================================
        // 5. GLITCH EFFECT
        // Triggered at peak of crossfade (opacity ~0.5)
        // ============================================
        function triggerGlitch() {
            if (!glitchLoader) return;

            // Show glitch loader
            glitchLoader.style.display = 'block';

            const tl = gsap.timeline({
                onComplete: () => {
                    glitchLoader.style.display = 'none';
                    gsap.set(glitchLoader, { opacity: 0 });
                }
            });

            // Rapid flicker effect
            tl.to(glitchLoader, { opacity: 0.7, duration: 0.05, ease: "steps(2)" })
                .to(glitchLoader, { opacity: 0.2, duration: 0.08, ease: "steps(3)" })
                .to(glitchLoader, { opacity: 0.9, duration: 0.06, ease: "steps(2)" })
                .to(glitchLoader, { opacity: 0.3, duration: 0.1, ease: "steps(4)" })
                .to(glitchLoader, { opacity: 0.8, duration: 0.05, ease: "steps(2)" })
                .to(glitchLoader, { opacity: 0.1, duration: 0.08, ease: "steps(3)" })
                .to(glitchLoader, { opacity: 0.6, duration: 0.06, ease: "steps(2)" })
                .to(glitchLoader, { opacity: 0, duration: 0.12, ease: "power2.out" });
        }

        // ============================================
        // 6. CROSSFADE WITH GLITCH
        // ============================================
        function performCrossfade() {
            if (!img2 || !isImg2Loaded) return;

            const targetImage = currentImage === 1 ? 2 : 1;
            const targetOpacity = targetImage === 2 ? 1 : 0;

            // Create crossfade timeline
            if (crossfadeTimeline) {
                crossfadeTimeline.kill();
            }

            crossfadeTimeline = gsap.timeline();

            // Crossfade animation
            crossfadeTimeline.to(img2, {
                opacity: targetOpacity,
                duration: CONFIG.crossfadeDuration,
                ease: "power2.inOut",
                onUpdate: function () {
                    // Trigger glitch at midpoint (when progress is ~50%)
                    const progress = this.progress();
                    if (progress >= 0.45 && progress <= 0.55 && !this._glitchTriggered) {
                        this._glitchTriggered = true;
                        triggerGlitch();
                    }
                },
                onComplete: () => {
                    currentImage = targetImage;
                }
            });
        }

        // ============================================
        // 7. START CROSSFADE LOOP
        // ============================================
        function startCrossfadeLoop() {
            if (!img2 || !isImg2Loaded) return;

            // First crossfade after interval
            setTimeout(() => {
                performCrossfade();

                // Then repeat
                setInterval(performCrossfade, CONFIG.crossfadeInterval * 1000);
            }, CONFIG.crossfadeInterval * 1000);
        }

        // ============================================
        // 9. MAIN INITIALIZATION
        // ============================================
        async function start() {
            // Setup initial state immediately
            setupInitialState();

            // Start panning immediately
            startPanning();

            // Setup mouse parallax
            setupMouseParallax();

            // Preload second image
            const img2Ready = await preloadImage2();

            if (img2Ready) {
                console.log('[HeroPanorama] Loop activated');
                startCrossfadeLoop();
            }
        }

        // Start with small delay to ensure DOM is ready
        setTimeout(start, CONFIG.preloadDelay);
    }

    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', runSafeInit);
    } else {
        runSafeInit();
    }

})();
