// ============================================================================
// UTILITY FUNCTIONS
// ============================================================================
console.log("%c ELINAR SCRIPT LOADED v2.1.3 ", "background: #FFA500; color: #000; font-size: 20px; font-weight: bold;");

/**
 * Simple Phone Mask Implementation
 * Handles dynamic inputs and uses only ES5 for maximum compatibility
 */
function initPhoneMasks() {
    function applyTo(input) {
        if (input.getAttribute('data-mask-init')) return;
        input.setAttribute('data-mask-init', 'true');

        var onInput = function (e) {
            var value = e.target.value.replace(/\D/g, '');
            var formatted = '';

            if (!value) {
                e.target.value = '';
                return;
            }

            if (["7", "8", "9"].indexOf(value[0]) > -1) {
                if (value[0] === "9") value = "7" + value;
                if (value[0] === "8") value = "7" + value.slice(1);

                formatted = "+7";
                if (value.length > 1) {
                    formatted += " (" + value.substring(1, 4);
                }
                if (value.length >= 5) {
                    formatted += ") " + value.substring(4, 7);
                }
                if (value.length >= 8) {
                    formatted += "-" + value.substring(7, 9);
                }
                if (value.length >= 10) {
                    formatted += "-" + value.substring(9, 11);
                }
            } else {
                formatted = "+" + value.substring(0, 15);
            }

            e.target.value = formatted;
        };

        input.addEventListener('input', onInput);

        input.addEventListener('focus', function (e) {
            if (!e.target.value) {
                e.target.value = '+7 (';
            }
        });

        input.addEventListener('blur', function (e) {
            if (e.target.value === '+7 (' || e.target.value === '+7') {
                e.target.value = '';
            }
        });

        console.log("[PhoneMask] Applied to:", input);
    }

    function check() {
        var phoneInputs = document.querySelectorAll('input[type="tel"]');
        for (var i = 0; i < phoneInputs.length; i++) {
            applyTo(phoneInputs[i]);
        }
    }

    check();
    setInterval(check, 1000);
}

/**
 * Debounce function - limits the rate at which a function can fire
     * @param {Function} func - Function to debounce
     * @param {number} wait - Wait time in milliseconds
     * @returns {Function} Debounced function
     */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func.apply(this, args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}


/**
 * Throttle function - ensures function is called at most once per interval
 * @param {Function} func - Function to throttle
 * @param {number} limit - Time limit in milliseconds
 * @returns {Function} Throttled function
 */
function throttle(func, limit) {
    let inThrottle;
    return function (...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

/**
 * Industry Ticker Functionality
 * Handles interactions and touch support for the logo ticker
 */
function initLogoTicker() {
    var track = document.querySelector('.logo-ticker-track');
    if (!track) return;

    var items = document.querySelectorAll('.ticker-item[data-tooltip]');
    for (var i = 0; i < items.length; i++) {
        (function () {
            var item = items[i];
            item.addEventListener('click', function (e) {
                if (window.innerWidth <= 768) {
                    var isActive = item.classList.contains('tooltip-active');
                    // Close others
                    for (var j = 0; j < items.length; j++) {
                        items[j].classList.remove('tooltip-active');
                    }
                    if (!isActive) {
                        item.classList.add('tooltip-active');
                    }
                }
            });
        })();
    }

    // Close on click outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.ticker-item')) {
            for (var i = 0; i < items.length; i++) {
                items[i].classList.remove('tooltip-active');
            }
        }
    });
}

// ============================================================================
// MAIN INITIALIZATION
// ============================================================================

document.addEventListener('DOMContentLoaded', function () {
    // Initialize Phone Masks
    if (typeof initPhoneMasks === 'function') {
        initPhoneMasks();
    }

    // Initialize Industry Ticker
    if (typeof initLogoTicker === 'function') {
        initLogoTicker();
    }

    if (!window.elinarCookieConsentInitialized) {
        window.elinarCookieConsentInitialized = true;

        (function () {
            const cookieBanner = document.getElementById('cookie-banner');
            const cookieAcceptAllBtn = document.getElementById('cookie-accept-all');
            const cookieSettingsBtn = document.getElementById('cookie-settings');
            const cookieDeclineBtn = document.getElementById('cookie-decline');
            const cookieSettingsPanel = cookieBanner ? cookieBanner.querySelector('.cookie-banner-settings') : null;
            const cookieAnalytics = document.getElementById('cookie-analytics');
            const cookiePersonalization = document.getElementById('cookie-personalization');
            const cookieSaveSettingsBtn = document.getElementById('cookie-save-settings');
            const cookieCancelSettingsBtn = document.getElementById('cookie-cancel-settings');

            const cookiePrefsKey = 'elinar_cookie_preferences';
            const cookieLegacyKey = 'elinar_cookie_consent';

            if (typeof window.elinarInitAnalytics !== 'function') {
                window.elinarInitAnalytics = function () { };
            }

            function readPrefs() {
                try {
                    const raw = localStorage.getItem(cookiePrefsKey);
                    if (raw) {
                        const parsed = JSON.parse(raw);
                        if (parsed && typeof parsed === 'object') {
                            return {
                                necessary: true,
                                analytics: parsed.analytics !== false,
                                personalization: parsed.personalization !== false
                            };
                        }
                    }

                    if (localStorage.getItem(cookieLegacyKey) === 'accepted') {
                        return { necessary: true, analytics: true, personalization: true };
                    }
                } catch (e) {
                }
                return null;
            }

            function writePrefs(prefs) {
                const safe = {
                    necessary: true,
                    analytics: !!(prefs && prefs.analytics),
                    personalization: !!(prefs && prefs.personalization),
                    ts: Date.now()
                };

                try {
                    localStorage.setItem(cookiePrefsKey, JSON.stringify(safe));
                } catch (e) {
                }

                const event = new CustomEvent('elinar:cookie-consent', { detail: safe });
                window.dispatchEvent(event);
                if (typeof window.elinarInitAnalytics === 'function') {
                    window.elinarInitAnalytics(safe);
                }
            }

            function showCookieBanner() {
                if (!cookieBanner) return;

                const prefs = readPrefs();
                if (!prefs) {
                    // Ensure settings panel is hidden initially
                    if (cookieSettingsPanel) {
                        cookieSettingsPanel.hidden = true;
                    }

                    setTimeout(function () {
                        cookieBanner.classList.add('show');
                    }, 500);
                    return;
                }

                writePrefs(prefs);
                cookieBanner.style.display = 'none';
            }

            function hideCookieBanner() {
                if (!cookieBanner) return;
                cookieBanner.classList.remove('show');
                setTimeout(function () {
                    cookieBanner.style.display = 'none';
                }, 400);
            }

            function openSettings() {
                if (!cookieSettingsPanel) return;
                cookieSettingsPanel.hidden = false;
                const prefs = readPrefs() || { necessary: true, analytics: true, personalization: true };
                if (cookieAnalytics) cookieAnalytics.checked = !!prefs.analytics;
                if (cookiePersonalization) cookiePersonalization.checked = !!prefs.personalization;
            }

            function closeSettings() {
                if (!cookieSettingsPanel) return;
                cookieSettingsPanel.hidden = true;
            }

            if (cookieBanner && cookieAcceptAllBtn && cookieSettingsBtn && cookieDeclineBtn) {
                showCookieBanner();

                cookieAcceptAllBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    writePrefs({ analytics: true, personalization: true });
                    hideCookieBanner();
                });

                cookieDeclineBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    writePrefs({ analytics: false, personalization: false });
                    hideCookieBanner();
                });

                cookieSettingsBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    openSettings();
                });

                if (cookieSaveSettingsBtn) {
                    cookieSaveSettingsBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        writePrefs({
                            analytics: cookieAnalytics ? cookieAnalytics.checked : true,
                            personalization: cookiePersonalization ? cookiePersonalization.checked : true
                        });
                        closeSettings();
                        hideCookieBanner();
                    });
                }

                if (cookieCancelSettingsBtn) {
                    cookieCancelSettingsBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        closeSettings();
                    });
                }
            }
        })();
    }

    // Глобальная защита от повторной инициализации всего блока
    if (window.elinarModalsInitialized) {
        console.log('Modals already initialized, skipping...');
        return;
    }
    window.elinarModalsInitialized = true;
    console.log('Initializing modals for the first time');

    // Fix logo click on mobile - используем только обработчик на самой ссылке
    const brandLogo = document.querySelector('.brand-logo-container');
    if (brandLogo) {
        const logoHref = brandLogo.getAttribute('href');
        if (logoHref) {
            // Удаляем старый overlay, если есть
            const oldOverlay = brandLogo.querySelector('.logo-click-overlay');
            if (oldOverlay) {
                oldOverlay.remove();
            }

            // Убеждаемся, что ссылка кликабельна
            brandLogo.style.pointerEvents = 'auto';
            brandLogo.style.cursor = 'pointer';

            // Убеждаемся, что изображения не блокируют клики
            const logoImages = brandLogo.querySelectorAll('img');
            logoImages.forEach(function (img) {
                img.style.setProperty('pointer-events', 'none', 'important');
                img.style.setProperty('touch-action', 'none', 'important');
                img.style.setProperty('user-select', 'none', 'important');
                img.style.setProperty('-webkit-user-select', 'none', 'important');
            });

            // Добавляем обработчик клика напрямую на ссылку
            const handleLogoClick = function (e) {
                // Если клик на изображении, все равно переходим
                if (e.target.tagName === 'IMG' || e.target.classList.contains('logo-image')) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (logoHref && logoHref !== '#' && logoHref !== '') {
                        window.location.href = logoHref;
                    }
                    return false;
                }
                // Для остальных случаев используем стандартное поведение ссылки
            };

            brandLogo.addEventListener('click', handleLogoClick, true);
            brandLogo.addEventListener('touchend', function (e) {
                if (window.innerWidth <= 1024) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (logoHref && logoHref !== '#' && logoHref !== '') {
                        window.location.href = logoHref;
                    }
                }
            }, { capture: true, passive: false });
        }
    }

    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function () {
            mainNav.classList.toggle('active');
            menuToggle.classList.toggle('active');
        });
    }

    // Mobile Submenu Toggle
    const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children > a');
    menuItemsWithChildren.forEach(function (item) {
        item.addEventListener('click', function (e) {
            // Check if we are on mobile (or if the menu is in mobile mode)
            // We can check if the menu toggle is visible or rely on window width,
            // but since we want this behavior for the mobile menu, checking width is safer
            // or just applying it always if the link is '#'

            if (window.innerWidth <= 1024) {
                e.preventDefault();
                const parent = this.parentElement;
                parent.classList.toggle('open');
            }
        });
    });

    // Highlight active menu item based on current URL
    const currentUrl = window.location.href.replace(/\/$/, ''); // Remove trailing slash
    const menuLinks = document.querySelectorAll('.main-nav a');
    let activeFound = false;

    menuLinks.forEach(link => {
        const linkUrl = link.href.replace(/\/$/, ''); // Remove trailing slash
        const parentLi = link.closest('li');

        // Check if this is the exact current page
        if (currentUrl === linkUrl) {
            if (parentLi) {
                parentLi.classList.add('current-menu-item', 'current_page_item');
                activeFound = true;

                // If this is a submenu item, also highlight the parent menu item
                const parentMenuItem = parentLi.closest('.sub-menu');
                if (parentMenuItem) {
                    const topLevelParent = parentMenuItem.closest('li.menu-item-has-children');
                    if (topLevelParent) {
                        topLevelParent.classList.add('current-menu-ancestor', 'current-page-ancestor');
                    }
                }
            }
        }
    });

    // If no exact match found, try to find parent by URL path
    if (!activeFound) {
        menuLinks.forEach(link => {
            const linkUrl = link.href.replace(/\/$/, '');
            const parentLi = link.closest('li');

            // Check if current URL starts with this link (for parent pages)
            if (linkUrl !== window.location.origin &&
                currentUrl.startsWith(linkUrl) &&
                linkUrl.length > window.location.origin.length) {

                if (parentLi) {
                    parentLi.classList.add('current-menu-ancestor', 'current-page-ancestor');
                }
            }
        });
    }

    // Sticky Header Effects on scroll
    // При загрузке: хедер ограничен по ширине (как контент hero)
    // При скролле: хедер растягивается на всю ширину страницы
    // Также переключает логотип: белый при загрузке, цветной при скролле
    const header = document.querySelector('.site-header');
    let headerScrolled = false;

    // ========== WOW-ЭФФЕКТ 1: Scroll Progress Indicator ==========
    // Создаём элемент прогресс-бара
    const scrollProgressBar = document.createElement('div');
    scrollProgressBar.className = 'scroll-progress-bar';
    document.body.appendChild(scrollProgressBar);

    let docHeight = 0;
    const updateDocHeight = () => {
        docHeight = Math.max(0, document.documentElement.scrollHeight - window.innerHeight);
    };
    updateDocHeight();

    // Функция обновления прогресс-бара
    function updateScrollProgress() {
        const scrollTop = window.scrollY;
        const scrollPercent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        scrollProgressBar.style.width = scrollPercent + '%';
    }
    // ========== КОНЕЦ WOW-ЭФФЕКТ 1 ==========

    // Функция для проверки состояния скролла
    function checkScrollState() {
        const scrollY = window.scrollY;

        // Эффект растягивания на всю ширину при скролле и смена логотипа
        if (scrollY > 50) {
            if (!headerScrolled) {
                header.classList.add('scrolled');
                headerScrolled = true;
            }
        } else {
            if (headerScrolled) {
                header.classList.remove('scrolled');
                headerScrolled = false;
            }
        }

        // Обновляем прогресс-бар при каждом скролле
        updateScrollProgress();
    }

    // Проверяем состояние при загрузке страницы
    checkScrollState();

    // Обработчик скролла (debounced для производительности)
    const debouncedScrollCheck = debounce(checkScrollState, 16); // ~60fps
    window.addEventListener('scroll', debouncedScrollCheck, { passive: true });
    window.addEventListener('resize', debounce(() => {
        updateDocHeight();
        checkScrollState();
    }, 150));

    // ============================================================================
    // MODAL WINDOWS
    // ============================================================================
    // NOTE: Код модальных окон дублируется намеренно для простоты поддержки.
    // Каждое модальное окно имеет свою специфику (CTA кнопки, разные триггеры).
    //
    // ЕСЛИ добавляете 6-е модальное окно — рассмотрите рефакторинг в класс Modal:
    //
    // class Modal {
    //     constructor(triggerId, modalId, options = {}) {
    //         this.trigger = document.getElementById(triggerId);
    //         this.modal = document.getElementById(modalId);
    //         this.options = options;
    //         this.init();
    //     }
    //     // ... методы open(), close(), init()
    // }
    //
    // Текущие модальные окна: PVC, Chamfer, Profiles, Injection, Extruded
    // ============================================================================

    // PVC Modal - Initialize close handlers first (works on all pages)
    const pvcModal = document.getElementById('pvc-modal');
    if (pvcModal) {
        const pvcClose = pvcModal.querySelector('.modal-close');

        // Именованные функции для возможности удаления
        const closePvcModal = function (e) {
            console.log('PVC modal close button clicked');
            if (e) e.stopPropagation();
            pvcModal.classList.remove('show');
            document.body.style.overflow = '';
        };

        const closePvcOnOverlay = function (e) {
            if (e.target === pvcModal) {
                console.log('PVC modal overlay clicked');
                pvcModal.classList.remove('show');
                document.body.style.overflow = '';
            }
        };

        const pvcCtaAction = function () {
            pvcModal.classList.remove('show');
            document.body.style.overflow = '';
            setTimeout(function () {
                const contactForm = document.querySelector('#contact-form');
                if (contactForm) {
                    contactForm.scrollIntoView({ behavior: 'smooth' });
                }
            }, 100);
        };

        // Удаляем старые обработчики (если были) и добавляем новые
        if (pvcClose) {
            pvcClose.removeEventListener('click', closePvcModal);
            pvcClose.addEventListener('click', closePvcModal);
        }

        pvcModal.removeEventListener('click', closePvcOnOverlay);
        pvcModal.addEventListener('click', closePvcOnOverlay);

        const pvcCtaBtn = document.getElementById('pvc-cta-btn');
        if (pvcCtaBtn) {
            pvcCtaBtn.removeEventListener('click', pvcCtaAction);
            pvcCtaBtn.addEventListener('click', pvcCtaAction);
        }
    }

    // PVC Modal Trigger (from main page)
    const pvcTrigger = document.getElementById('pvc-modal-trigger');
    if (pvcTrigger && pvcModal && !pvcTrigger.dataset.initialized) {
        pvcTrigger.dataset.initialized = 'true';
        pvcTrigger.addEventListener('click', function (e) {
            e.preventDefault();
            pvcModal.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    }

    // Chamfer Modal - Initialize close handlers first (works on all pages)
    const chamferModal = document.getElementById('chamfer-modal');
    if (chamferModal) {
        const chamferClose = chamferModal.querySelector('.modal-close');

        const closeChamferModal = function (e) {
            if (e) e.stopPropagation();
            chamferModal.classList.remove('show');
            document.body.style.overflow = '';
        };

        const closeChamferOnOverlay = function (e) {
            if (e.target === chamferModal) {
                chamferModal.classList.remove('show');
                document.body.style.overflow = '';
            }
        };

        const chamferCtaAction = function () {
            chamferModal.classList.remove('show');
            document.body.style.overflow = '';
            setTimeout(function () {
                const contactForm = document.querySelector('#contact-form');
                if (contactForm) {
                    contactForm.scrollIntoView({ behavior: 'smooth' });
                }
            }, 100);
        };

        if (chamferClose) {
            chamferClose.removeEventListener('click', closeChamferModal);
            chamferClose.addEventListener('click', closeChamferModal);
        }

        chamferModal.removeEventListener('click', closeChamferOnOverlay);
        chamferModal.addEventListener('click', closeChamferOnOverlay);

        const chamferCtaBtn = document.getElementById('chamfer-cta-btn');
        if (chamferCtaBtn) {
            chamferCtaBtn.removeEventListener('click', chamferCtaAction);
            chamferCtaBtn.addEventListener('click', chamferCtaAction);
        }
    }

    // Chamfer Modal Trigger (from main page)
    const chamferTrigger = document.getElementById('chamfer-modal-trigger');
    if (chamferTrigger && chamferModal && !chamferTrigger.dataset.initialized) {
        chamferTrigger.dataset.initialized = 'true';
        chamferTrigger.addEventListener('click', function (e) {
            e.preventDefault();
            chamferModal.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    }

    // Profiles Modal - Initialize close handlers first (works on all pages)
    const profilesModal = document.getElementById('profiles-modal');
    if (profilesModal) {
        const profilesClose = profilesModal.querySelector('.modal-close');

        const closeProfilesModal = function (e) {
            if (e) e.stopPropagation();
            profilesModal.classList.remove('show');
            document.body.style.overflow = '';
        };

        const closeProfilesOnOverlay = function (e) {
            if (e.target === profilesModal) {
                profilesModal.classList.remove('show');
                document.body.style.overflow = '';
            }
        };

        const profilesCtaAction = function () {
            profilesModal.classList.remove('show');
            document.body.style.overflow = '';
            setTimeout(function () {
                const contactForm = document.querySelector('#contact-form');
                if (contactForm) {
                    contactForm.scrollIntoView({ behavior: 'smooth' });
                }
            }, 100);
        };

        if (profilesClose) {
            profilesClose.removeEventListener('click', closeProfilesModal);
            profilesClose.addEventListener('click', closeProfilesModal);
        }

        profilesModal.removeEventListener('click', closeProfilesOnOverlay);
        profilesModal.addEventListener('click', closeProfilesOnOverlay);

        const profilesCtaBtn = document.getElementById('profiles-cta-btn');
        if (profilesCtaBtn) {
            profilesCtaBtn.removeEventListener('click', profilesCtaAction);
            profilesCtaBtn.addEventListener('click', profilesCtaAction);
        }
    }

    // Profiles Modal Trigger (from main page)
    const profilesTrigger = document.getElementById('profiles-modal-trigger');
    if (profilesTrigger && profilesModal && !profilesTrigger.dataset.initialized) {
        profilesTrigger.dataset.initialized = 'true';
        profilesTrigger.addEventListener('click', function (e) {
            e.preventDefault();
            profilesModal.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    }

    // Injection Molding Modal - Initialize close handlers first (works on all pages)
    const injectionModal = document.getElementById('injection-modal');
    if (injectionModal) {
        const injectionClose = injectionModal.querySelector('.modal-close');

        const closeInjectionModal = function (e) {
            console.log('Injection modal close button clicked');
            if (e) e.stopPropagation();
            injectionModal.classList.remove('show');
            document.body.style.overflow = '';
        };

        const closeInjectionOnOverlay = function (e) {
            if (e.target === injectionModal) {
                console.log('Injection modal overlay clicked');
                injectionModal.classList.remove('show');
                document.body.style.overflow = '';
            }
        };

        const injectionCtaAction = function () {
            injectionModal.classList.remove('show');
            document.body.style.overflow = '';
            setTimeout(function () {
                const contactForm = document.querySelector('#contact-form');
                if (contactForm) {
                    contactForm.scrollIntoView({ behavior: 'smooth' });
                }
            }, 100);
        };

        if (injectionClose) {
            injectionClose.removeEventListener('click', closeInjectionModal);
            injectionClose.addEventListener('click', closeInjectionModal);
        }

        injectionModal.removeEventListener('click', closeInjectionOnOverlay);
        injectionModal.addEventListener('click', closeInjectionOnOverlay);

        const injectionCtaBtn = document.getElementById('injection-cta-btn');
        if (injectionCtaBtn) {
            injectionCtaBtn.removeEventListener('click', injectionCtaAction);
            injectionCtaBtn.addEventListener('click', injectionCtaAction);
        }
    }

    // Injection Molding Modal Trigger (from main page)
    const injectionTrigger = document.getElementById('injection-modal-trigger');
    if (injectionTrigger && injectionModal && !injectionTrigger.dataset.initialized) {
        injectionTrigger.dataset.initialized = 'true';
        injectionTrigger.addEventListener('click', function (e) {
            e.preventDefault();
            injectionModal.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    }

    // Close on Escape key (unified handler for all modals)
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            if (pvcModal && pvcModal.classList.contains('show')) {
                pvcModal.classList.remove('show');
                document.body.style.overflow = '';
            }
            if (chamferModal && chamferModal.classList.contains('show')) {
                chamferModal.classList.remove('show');
                document.body.style.overflow = '';
            }
            if (profilesModal && profilesModal.contains('show')) {
                profilesModal.classList.remove('show');
                document.body.style.overflow = '';
            }
            if (injectionModal && injectionModal.classList.contains('show')) {
                injectionModal.classList.remove('show');
                document.body.style.overflow = '';
            }
            const truckProfileModal = document.getElementById('truck-profile-modal');
            if (truckProfileModal && truckProfileModal.classList.contains('show')) {
                truckProfileModal.classList.remove('show');
                document.body.style.overflow = '';
            }
        }
    });

    // Extruded Products Modal (Полимерные втулки)
    const extrudedModal = document.getElementById('extruded-modal');
    if (extrudedModal) {
        const extrudedClose = extrudedModal.querySelector('.modal-close');

        const closeExtrudedModal = function (e) {
            if (e) e.stopPropagation();
            extrudedModal.classList.remove('show');
            document.body.style.overflow = '';
        };

        const closeExtrudedOnOverlay = function (e) {
            if (e.target === extrudedModal) {
                extrudedModal.classList.remove('show');
                document.body.style.overflow = '';
            }
        };

        const extrudedCtaAction = function () {
            extrudedModal.classList.remove('show');
            document.body.style.overflow = '';
            setTimeout(function () {
                const contactForm = document.querySelector('#contact-form');
                if (contactForm) {
                    contactForm.scrollIntoView({ behavior: 'smooth' });
                }
            }, 100);
        };

        if (extrudedClose) {
            extrudedClose.removeEventListener('click', closeExtrudedModal);
            extrudedClose.addEventListener('click', closeExtrudedModal);
        }

        extrudedModal.removeEventListener('click', closeExtrudedOnOverlay);
        extrudedModal.addEventListener('click', closeExtrudedOnOverlay);

        const extrudedCtaBtn = document.getElementById('extruded-cta-btn');
        if (extrudedCtaBtn) {
            extrudedCtaBtn.removeEventListener('click', extrudedCtaAction);
            extrudedCtaBtn.addEventListener('click', extrudedCtaAction);
        }
    }

    // Extruded Modal Trigger (from main page)
    const extrudedTrigger = document.getElementById('extruded-modal-trigger');
    if (extrudedTrigger && extrudedModal && !extrudedTrigger.dataset.initialized) {
        extrudedTrigger.dataset.initialized = 'true';
        extrudedTrigger.addEventListener('click', function (e) {
            e.preventDefault();
            extrudedModal.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    }

    // Truck Profile Modal (Профили для фургонов)
    const truckProfileModal = document.getElementById('truck-profile-modal');
    if (truckProfileModal) {
        const truckProfileClose = truckProfileModal.querySelector('.modal-close');

        const closeTruckProfileModal = function (e) {
            if (e) e.stopPropagation();
            truckProfileModal.classList.remove('show');
            document.body.style.overflow = '';
        };

        const closeTruckProfileOnOverlay = function (e) {
            if (e.target === truckProfileModal) {
                truckProfileModal.classList.remove('show');
                document.body.style.overflow = '';
            }
        };

        if (truckProfileClose) {
            truckProfileClose.removeEventListener('click', closeTruckProfileModal);
            truckProfileClose.addEventListener('click', closeTruckProfileModal);
        }

        truckProfileModal.removeEventListener('click', closeTruckProfileOnOverlay);
        truckProfileModal.addEventListener('click', closeTruckProfileOnOverlay);
    }

    // Truck Profile Modal Trigger (from main page)
    const truckProfileTrigger = document.getElementById('truck-profile-modal-trigger');
    if (truckProfileTrigger && truckProfileModal && !truckProfileTrigger.dataset.initialized) {
        truckProfileTrigger.dataset.initialized = 'true';
        truckProfileTrigger.addEventListener('click', function (e) {
            e.preventDefault();
            truckProfileModal.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    }

    // Footer Product Links - reuse existing modals
    // Защита от повторной инициализации обработчиков футера
    if (!document.body.dataset.footerModalsInitialized) {
        document.body.dataset.footerModalsInitialized = 'true';

        const footerPvcLink = document.getElementById('pvc-modal-trigger-footer');
        const footerChamferLink = document.getElementById('chamfer-modal-trigger-footer');
        const footerProfilesLink = document.getElementById('profiles-modal-trigger-footer');
        const footerInjectionLink = document.getElementById('injection-modal-trigger-footer');
        const footerExtrudedLink = document.getElementById('extruded-modal-trigger-footer');
        const footerTruckProfileLink = document.getElementById('truck-profile-modal-trigger-footer');

        // PVC Modal from footer
        if (footerPvcLink && pvcModal) {
            footerPvcLink.addEventListener('click', function (e) {
                e.preventDefault();
                pvcModal.classList.add('show');
                document.body.style.overflow = 'hidden';
            });
        }

        // Chamfer Modal from footer
        if (footerChamferLink && chamferModal) {
            footerChamferLink.addEventListener('click', function (e) {
                e.preventDefault();
                chamferModal.classList.add('show');
                document.body.style.overflow = 'hidden';
            });
        }

        // Profiles Modal from footer
        if (footerProfilesLink && profilesModal) {
            footerProfilesLink.addEventListener('click', function (e) {
                e.preventDefault();
                profilesModal.classList.add('show');
                document.body.style.overflow = 'hidden';
            });
        }

        // Injection Modal from footer
        if (footerInjectionLink && injectionModal) {
            footerInjectionLink.addEventListener('click', function (e) {
                e.preventDefault();
                injectionModal.classList.add('show');
                document.body.style.overflow = 'hidden';
            });
        }

        // Extruded Modal from footer (Полимерные втулки)
        if (footerExtrudedLink && extrudedModal) {
            footerExtrudedLink.addEventListener('click', function (e) {
                e.preventDefault();
                extrudedModal.classList.add('show');
                document.body.style.overflow = 'hidden';
            });
        }

        // Truck Profile Modal from footer (Профили для фургонов)
        if (footerTruckProfileLink && truckProfileModal) {
            footerTruckProfileLink.addEventListener('click', function (e) {
                e.preventDefault();
                if (truckProfileModal) {
                    truckProfileModal.classList.add('show');
                    document.body.style.overflow = 'hidden';
                }
            });
        }
    } // End of footer modals initialization guard

    // ============================================================================
    // SPECIALIZED SOLUTIONS CARDS - Modal Triggers (Products Page)
    // ============================================================================
    // Обработчик кликов на карточки и кнопки "Подробнее"
    // Используем data-modal-target (приоритет) или data-modal
    // Защита от повторной инициализации
    if (!document.body.dataset.productModalsInitialized) {
        document.body.dataset.productModalsInitialized = 'true';

        const productModalTriggers = document.querySelectorAll('.product-modal-trigger, .specialized-card[data-modal]');
        productModalTriggers.forEach(function (trigger) {
            trigger.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation(); // Предотвращаем всплытие, если вложены

                const modalId = this.getAttribute('data-modal-target') || this.getAttribute('data-modal');
                if (!modalId) return;

                const modal = document.getElementById(modalId);

                if (modal) {
                    modal.classList.add('show');
                    document.body.style.overflow = 'hidden';
                } else {
                    console.warn('Modal not found:', modalId);
                }
            });
        });
    }

    // Universal Escape key handler for all modals
    // Защита от повторной инициализации
    if (!document.body.dataset.escapeHandlerInitialized) {
        document.body.dataset.escapeHandlerInitialized = 'true';

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                console.log('Escape key pressed - closing modals');
                const modalIds = ['pvc-modal', 'chamfer-modal', 'profiles-modal', 'injection-modal', 'extruded-modal', 'truck-profile-modal'];
                modalIds.forEach(function (modalId) {
                    const modal = document.getElementById(modalId);
                    if (modal && modal.classList.contains('show')) {
                        console.log('Closing modal:', modalId);
                        modal.classList.remove('show');
                        document.body.style.overflow = '';
                    }
                });
            }
        });
    }

    // --- IMAGE LIGHTBOX LOGIC ---
    const lightbox = document.getElementById('image-lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxClose = document.querySelector('.lightbox-close');

    // Target images in specific sections to avoid logos/icons
    const zoomableImages = document.querySelectorAll('.section img, .entry-content img, .split-image img');

    zoomableImages.forEach(img => {
        // Исключаем изображения, которые находятся внутри ссылок с GLightbox
        const parentLink = img.closest('a');
        if (parentLink && (parentLink.classList.contains('glightbox') || parentLink.classList.contains('certificate-glightbox') || parentLink.hasAttribute('data-gallery'))) {
            return; // Пропускаем это изображение
        }

        img.style.cursor = 'zoom-in';
        img.addEventListener('click', function () {
            lightbox.classList.add('show');
            lightboxImg.src = this.src;
            if (this.alt && lightboxCaption) {
                lightboxCaption.innerHTML = this.alt;
            } else if (lightboxCaption) {
                lightboxCaption.innerHTML = '';
            }
            document.body.style.overflow = 'hidden';
        });
    });

    if (lightboxClose) {
        lightboxClose.addEventListener('click', function () {
            lightbox.classList.remove('show');
            document.body.style.overflow = '';
        });
    }

    if (lightbox) {
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) {
                lightbox.classList.remove('show');
                document.body.style.overflow = '';
            }
        });
    }

    // Close on Escape (for Lightbox)
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && lightbox && lightbox.classList.contains('show')) {
            lightbox.classList.remove('show');
            document.body.style.overflow = '';
        }
    });

    // --- PRODUCTION GALLERY SLIDER ---
    // Инициализация слайдеров на страницах КРОМЕ страницы продукции
    // На странице продукции используется отдельный products-slider.js
    const isProductsPage = document.body.classList.contains('page-template-page-products') ||
        window.location.pathname.includes('/products');

    if (!isProductsPage) {
        const productionSliders = document.querySelectorAll('.production-gallery-slider');
        productionSliders.forEach((productionSlider) => {
            const slides = productionSlider.querySelectorAll('.slide');
            const dots = productionSlider.querySelectorAll('.slider-dot');
            const prevBtn = productionSlider.querySelector('.slider-prev');
            const nextBtn = productionSlider.querySelector('.slider-next');
            const currentSlideSpan = productionSlider.querySelector('.current-slide');
            let currentIndex = 0;
            let autoplayInterval = null;

            // Функция для показа слайда
            function showSlide(index) {
                // Убираем активный класс со всех слайдов и точек
                slides.forEach((slide, i) => {
                    slide.classList.remove('active');
                    if (dots[i]) {
                        dots[i].classList.remove('active');
                    }
                });

                // Добавляем активный класс к текущему слайду и точке
                if (slides[index]) {
                    slides[index].classList.add('active');
                }
                if (dots[index]) {
                    dots[index].classList.add('active');
                }

                // Обновляем счетчик
                if (currentSlideSpan) {
                    currentSlideSpan.textContent = index + 1;
                }

                currentIndex = index;
            }

            // Переход к следующему слайду
            function nextSlide() {
                const nextIndex = (currentIndex + 1) % slides.length;
                showSlide(nextIndex);
            }

            // Переход к предыдущему слайду
            function prevSlide() {
                const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
                showSlide(prevIndex);
            }

            // Обработчики для кнопок навигации
            if (nextBtn) {
                nextBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    nextSlide();
                    resetAutoplay();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    prevSlide();
                    resetAutoplay();
                });
            }

            // Обработчики для точек навигации
            dots.forEach((dot, index) => {
                dot.addEventListener('click', (e) => {
                    e.stopPropagation();
                    showSlide(index);
                    resetAutoplay();
                });
            });

            // Автопрокрутка (опционально, можно отключить)
            function startAutoplay() {
                autoplayInterval = setInterval(() => {
                    nextSlide();
                }, 5000); // Меняем слайд каждые 5 секунд
            }

            function stopAutoplay() {
                if (autoplayInterval) {
                    clearInterval(autoplayInterval);
                    autoplayInterval = null;
                }
            }

            function resetAutoplay() {
                stopAutoplay();
                if (slides.length > 1) {
                    startAutoplay();
                }
            }

            // Остановка автопрокрутки при наведении
            productionSlider.addEventListener('mouseenter', stopAutoplay);
            productionSlider.addEventListener('mouseleave', () => {
                if (slides.length > 1) {
                    startAutoplay();
                }
            });

            // Навигация с клавиатуры
            productionSlider.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    prevSlide();
                    resetAutoplay();
                } else if (e.key === 'ArrowRight') {
                    nextSlide();
                    resetAutoplay();
                }
            });

            // Swipe для мобильных устройств
            let touchStartX = 0;
            let touchEndX = 0;

            productionSlider.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            productionSlider.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, { passive: true });

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;

                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        // Swipe влево - следующий слайд
                        nextSlide();
                    } else {
                        // Swipe вправо - предыдущий слайд
                        prevSlide();
                    }
                    resetAutoplay();
                }
            }

            // Интеграция с lightbox - клик по изображению открывает его в lightbox
            slides.forEach((slide) => {
                const img = slide.querySelector('.slider-image');
                if (img) {
                    img.addEventListener('click', function (e) {
                        e.stopPropagation();
                        if (lightbox && lightboxImg) {
                            lightbox.classList.add('show');
                            lightboxImg.src = this.src;
                            if (this.alt && lightboxCaption) {
                                lightboxCaption.innerHTML = this.alt;
                            } else if (lightboxCaption) {
                                lightboxCaption.innerHTML = '';
                            }
                            document.body.style.overflow = 'hidden';
                        }
                    });
                }
            });

            // Запускаем автопрокрутку, если есть несколько слайдов
            if (slides.length > 1) {
                startAutoplay();
            }

            // Инициализация - показываем первый слайд
            showSlide(0);
        });
    } // Конец проверки isProductsPage

    // --- ISO CERTIFICATES SLIDER ---
    const isoSliders = document.querySelectorAll('.iso-certificates-slider');
    isoSliders.forEach((isoSlider) => {
        const slides = isoSlider.querySelectorAll('.iso-slide');
        const dots = isoSlider.querySelectorAll('.iso-slider-dot');
        const prevBtn = isoSlider.querySelector('.iso-prev');
        const nextBtn = isoSlider.querySelector('.iso-next');
        let currentIndex = 0;

        // Функция для показа слайда
        function showISOSlide(index) {
            // Убираем активный класс со всех слайдов и точек
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (dots[i]) {
                    dots[i].classList.remove('active');
                }
            });

            // Добавляем активный класс к текущему слайду и точке
            if (slides[index]) {
                slides[index].classList.add('active');
            }
            if (dots[index]) {
                dots[index].classList.add('active');
            }

            currentIndex = index;
        }

        // Переход к следующему слайду
        function nextISOSlide() {
            const nextIndex = (currentIndex + 1) % slides.length;
            showISOSlide(nextIndex);
        }

        // Переход к предыдущему слайду
        function prevISOSlide() {
            const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
            showISOSlide(prevIndex);
        }

        // Обработчики для кнопок навигации
        if (nextBtn) {
            nextBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                nextISOSlide();
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                prevISOSlide();
            });
        }

        // Обработчики для точек навигации
        dots.forEach((dot, index) => {
            dot.addEventListener('click', (e) => {
                e.stopPropagation();
                showISOSlide(index);
            });
        });

        // Навигация с клавиатуры
        isoSlider.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                prevISOSlide();
            } else if (e.key === 'ArrowRight') {
                nextISOSlide();
            }
        });

        // Swipe для мобильных устройств
        let touchStartX = 0;
        let touchEndX = 0;

        isoSlider.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        isoSlider.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleISOSwipe();
        }, { passive: true });

        function handleISOSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe влево - следующий слайд
                    nextISOSlide();
                } else {
                    // Swipe вправо - предыдущий слайд
                    prevISOSlide();
                }
            }
        }

        // Инициализация - показываем первый слайд
        if (slides.length > 0) {
            showISOSlide(0);
        }
    });

    // --- FLOATING ACTION BUTTON (FAB) ---
    const fabContainer = document.querySelector('.fab-container');
    const fabTrigger = document.getElementById('fab-trigger');

    if (fabContainer && fabTrigger) {
        // Support both click and touch events for mobile
        const toggleFab = function (e) {
            e.preventDefault();
            e.stopPropagation();
            fabContainer.classList.toggle('active');
            fabTrigger.classList.toggle('active');
        };

        fabTrigger.addEventListener('click', toggleFab);
        fabTrigger.addEventListener('touchend', toggleFab);

        // Close FAB when clicking outside
        document.addEventListener('click', function (e) {
            if (!fabContainer.contains(e.target) && fabContainer.classList.contains('active')) {
                fabContainer.classList.remove('active');
                fabTrigger.classList.remove('active');
            }
        });

        // Also close on touch outside for mobile
        document.addEventListener('touchend', function (e) {
            if (!fabContainer.contains(e.target) && fabContainer.classList.contains('active')) {
                fabContainer.classList.remove('active');
                fabTrigger.classList.remove('active');
            }
        });
    }

    // --- SCROLL TO TOP BUTTON ---
    const scrollBtn = document.getElementById('scroll-top');
    let scrollBtnVisible = false;

    const toggleScrollBtn = () => {
        if (!scrollBtn) return;
        // Show button after scrolling 200px, works on both desktop and mobile
        if (window.scrollY > 200 || window.pageYOffset > 200) {
            if (!scrollBtnVisible) {
                scrollBtn.classList.add('visible');
                scrollBtnVisible = true;
            }
        } else {
            if (scrollBtnVisible) {
                scrollBtn.classList.remove('visible');
                scrollBtnVisible = false;
            }
        }
    };

    if (scrollBtn) {
        // Use both scroll and touchmove events for better mobile support (throttled)
        const throttledScrollBtn = throttle(toggleScrollBtn, 100);
        window.addEventListener('scroll', throttledScrollBtn, { passive: true });
        window.addEventListener('touchmove', throttledScrollBtn, { passive: true });
        toggleScrollBtn();

        const scrollToTop = function (e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };

        scrollBtn.addEventListener('click', scrollToTop);
        scrollBtn.addEventListener('touchend', scrollToTop);
    }

    // --- FIX FOR OPERA ON ANDROID: Icon Sizing ---
    // Detect Opera browser on Android
    const isOperaAndroid = function () {
        const ua = navigator.userAgent || navigator.vendor || window.opera;
        return /OPR|Opera/.test(ua) && /Android/.test(ua);
    };

    // Aggressive fix for Opera on Android
    if (isOperaAndroid()) {
        // Add class to body immediately
        if (document.body) {
            document.body.classList.add('opera-android-fix');
        } else {
            document.addEventListener('DOMContentLoaded', function () {
                document.body.classList.add('opera-android-fix');
            });
        }

        // Function to fix icons using setAttribute for maximum compatibility
        const fixIcons = function () {
            if (window.innerWidth > 768) return;

            // Fix advantage card icons
            const advantageIcons = document.querySelectorAll('.advantage-card-icon');
            advantageIcons.forEach(function (icon) {
                icon.setAttribute('style', 'width: 40px !important; height: 40px !important; max-width: 40px !important; max-height: 40px !important; min-width: 40px !important; min-height: 40px !important; box-sizing: border-box !important; overflow: hidden !important; flex-shrink: 0 !important;');

                const svg = icon.querySelector('svg');
                if (svg) {
                    svg.setAttribute('style', 'width: 40px !important; height: 40px !important; max-width: 40px !important; max-height: 40px !important; min-width: 40px !important; min-height: 40px !important; box-sizing: border-box !important; display: block !important; transform: scale(1) !important; -webkit-transform: scale(1) !important; -moz-transform: scale(1) !important; -ms-transform: scale(1) !important; -o-transform: scale(1) !important;');
                    svg.setAttribute('width', '40');
                    svg.setAttribute('height', '40');
                    svg.setAttribute('preserveAspectRatio', 'xMidYMid meet');
                }
            });

            // Close advantage card descriptions by default
            const descriptions = document.querySelectorAll('.advantage-card-description');
            descriptions.forEach(function (desc) {
                desc.setAttribute('style', 'max-height: 0 !important; opacity: 0 !important; overflow: hidden !important; margin-top: 0 !important; visibility: hidden !important;');
            });

            // Fix breadcrumb icons and alignment
            const breadcrumbFigures = document.querySelectorAll('.breadcrumbs-list li a figure');
            breadcrumbFigures.forEach(function (figure) {
                figure.setAttribute('style', 'width: 16px !important; height: 16px !important; max-width: 16px !important; max-height: 16px !important; min-width: 16px !important; min-height: 16px !important; box-sizing: border-box !important; overflow: hidden !important; flex-shrink: 0 !important; margin: 0 !important; padding: 0 !important;');

                const svg = figure.querySelector('svg');
                if (svg) {
                    svg.setAttribute('style', 'width: 16px !important; height: 16px !important; max-width: 16px !important; max-height: 16px !important; min-width: 16px !important; min-height: 16px !important; box-sizing: border-box !important; display: block !important; transform: scale(1) !important; -webkit-transform: scale(1) !important; -moz-transform: scale(1) !important; -ms-transform: scale(1) !important; -o-transform: scale(1) !important; margin: 0 !important; padding: 0 !important; vertical-align: middle !important;');
                    svg.setAttribute('width', '16');
                    svg.setAttribute('height', '16');
                    svg.setAttribute('preserveAspectRatio', 'xMidYMid meet');
                }
            });

            // Fix breadcrumb list alignment
            const breadcrumbLists = document.querySelectorAll('.breadcrumbs-list');
            breadcrumbLists.forEach(function (list) {
                list.setAttribute('style', 'align-items: center !important; display: flex !important; flex-wrap: wrap !important;');
            });

            const breadcrumbItems = document.querySelectorAll('.breadcrumbs-list li');
            breadcrumbItems.forEach(function (item) {
                item.setAttribute('style', 'display: flex !important; align-items: center !important; vertical-align: middle !important;');
            });

            const breadcrumbLinks = document.querySelectorAll('.breadcrumbs-list li a');
            breadcrumbLinks.forEach(function (link) {
                link.setAttribute('style', 'display: flex !important; align-items: center !important; vertical-align: middle !important; line-height: 1 !important;');
            });
        };

        // Apply immediately if DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function () {
                requestAnimationFrame(function () {
                    fixIcons();
                    setTimeout(fixIcons, 50);
                    setTimeout(fixIcons, 200);
                    setTimeout(fixIcons, 500);
                });
            });
        } else {
            requestAnimationFrame(function () {
                fixIcons();
                setTimeout(fixIcons, 50);
                setTimeout(fixIcons, 200);
                setTimeout(fixIcons, 500);
            });
        }

        // Use MutationObserver to watch for DOM changes
        const observer = new MutationObserver(function (mutations) {
            let shouldFix = false;
            mutations.forEach(function (mutation) {
                if (mutation.addedNodes.length > 0) {
                    shouldFix = true;
                }
            });
            if (shouldFix) {
                requestAnimationFrame(fixIcons);
            }
        });

        // Start observing
        if (document.body) {
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        } else {
            document.addEventListener('DOMContentLoaded', function () {
                observer.observe(document.body, {
                    childList: true,
                    subtree: true
                });
            });
        }

        // Re-apply on window resize and orientation change
        let resizeTimeout;
        const handleResize = function () {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function () {
                if (window.innerWidth <= 768) {
                    requestAnimationFrame(fixIcons);
                }
            }, 100);
        };

        // Debounce resize для производительности
        const debouncedResize = debounce(handleResize, 150);
        window.addEventListener('resize', debouncedResize);
        window.addEventListener('orientationchange', function () {
            setTimeout(function () {
                requestAnimationFrame(fixIcons);
            }, 300);
        });

        // Use matchMedia for efficient mobile detection (no periodic checks)
        const mobileQuery = window.matchMedia('(max-width: 768px)');

        function handleMobileChange(e) {
            if (e.matches) {
                requestAnimationFrame(fixIcons);
            }
        }

        // Modern browsers
        if (mobileQuery.addEventListener) {
            mobileQuery.addEventListener('change', handleMobileChange);
        } else {
            // Fallback for older browsers
            mobileQuery.addListener(handleMobileChange);
        }

        // Initial check
        handleMobileChange(mobileQuery);

        // Add hover/click handlers for advantage cards to show/hide descriptions
        const setupCardHover = function () {
            const cards = document.querySelectorAll('.advantage-card');
            cards.forEach(function (card) {
                const description = card.querySelector('.advantage-card-description');
                if (description) {
                    let isOpen = false;
                    let touchTimeout;

                    // Function to open card
                    const openCard = function () {
                        if (window.innerWidth <= 768) {
                            isOpen = true;
                            card.classList.add('touched');
                            description.setAttribute('style', 'visibility: visible !important; max-height: 300px !important; opacity: 1 !important; margin-top: 1rem !important; overflow: hidden !important;');
                        }
                    };

                    // Function to close card
                    const closeCard = function () {
                        if (window.innerWidth <= 768) {
                            isOpen = false;
                            card.classList.remove('touched');
                            description.setAttribute('style', 'max-height: 0 !important; opacity: 0 !important; overflow: hidden !important; margin-top: 0 !important; visibility: hidden !important;');
                        }
                    };

                    // Click handler for mobile (works in Opera)
                    // Use capture phase and store reference to current card
                    const currentCard = card;
                    const currentDescription = description;
                    let currentIsOpen = false;
                    let currentTouchTimeout;

                    card.addEventListener('click', function (e) {
                        if (window.innerWidth <= 768) {
                            e.preventDefault();
                            e.stopPropagation();

                            clearTimeout(currentTouchTimeout);

                            if (currentIsOpen) {
                                currentIsOpen = false;
                                currentCard.classList.remove('touched');
                                currentDescription.setAttribute('style', 'max-height: 0 !important; opacity: 0 !important; overflow: hidden !important; margin-top: 0 !important; visibility: hidden !important;');
                            } else {
                                // Close other cards first
                                const allCards = document.querySelectorAll('.advantage-card');
                                allCards.forEach(function (otherCard) {
                                    if (otherCard !== currentCard) {
                                        const otherDesc = otherCard.querySelector('.advantage-card-description');
                                        if (otherDesc) {
                                            otherCard.classList.remove('touched');
                                            otherDesc.setAttribute('style', 'max-height: 0 !important; opacity: 0 !important; overflow: hidden !important; margin-top: 0 !important; visibility: hidden !important;');
                                        }
                                    }
                                });

                                // Open current card
                                currentIsOpen = true;
                                currentCard.classList.add('touched');
                                currentDescription.setAttribute('style', 'visibility: visible !important; max-height: 300px !important; opacity: 1 !important; margin-top: 1rem !important; overflow: hidden !important;');

                                // Auto-close after 5 seconds
                                currentTouchTimeout = setTimeout(function () {
                                    currentIsOpen = false;
                                    currentCard.classList.remove('touched');
                                    currentDescription.setAttribute('style', 'max-height: 0 !important; opacity: 0 !important; overflow: hidden !important; margin-top: 0 !important; visibility: hidden !important;');
                                }, 5000);
                            }
                        }
                    }, true);

                    // Touch support for mobile (backup)
                    card.addEventListener('touchstart', function (e) {
                        if (window.innerWidth <= 768) {
                            e.preventDefault();
                            clearTimeout(touchTimeout);
                            openCard();
                        }
                    }, { passive: false });

                    card.addEventListener('touchend', function (e) {
                        if (window.innerWidth <= 768) {
                            e.preventDefault();
                            touchTimeout = setTimeout(function () {
                                closeCard();
                            }, 5000);
                        }
                    }, { passive: false });

                    // Hover for desktop
                    card.addEventListener('mouseenter', function () {
                        if (window.innerWidth > 768) {
                            openCard();
                        }
                    });

                    card.addEventListener('mouseleave', function () {
                        if (window.innerWidth > 768) {
                            closeCard();
                        }
                    });
                }
            });
        };

        // Setup hover handlers when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function () {
                setTimeout(setupCardHover, 100);
            });
        } else {
            setTimeout(setupCardHover, 100);
        }
    }

    // Call Back Modal (Заказать звонок)
    const callBackModal = document.getElementById('call-back-modal');
    if (callBackModal) {
        const callBackModalClose = callBackModal.querySelector('.callback-modal-close');
        const callBackModalOverlay = callBackModal.querySelector('.callback-modal-overlay');

        const openCallBackModal = function () {
            callBackModal.classList.add('show');
            document.body.style.overflow = 'hidden';
            // Close mobile menu if open
            const mainNav = document.getElementById('main-nav');
            const menuToggle = document.querySelector('.menu-toggle');
            if (mainNav && mainNav.classList.contains('active')) {
                mainNav.classList.remove('active');
                if (menuToggle) {
                    menuToggle.classList.remove('active');
                }
            }
        };

        const closeCallBackModal = function () {
            callBackModal.classList.remove('show');
            document.body.style.overflow = '';
        };

        const handleCallBackClick = function (e) {
            const callBackButton = e.target.closest('#call-back-btn, #call-back-btn-header, #footer-callback-btn');
            if (callBackButton) {
                e.preventDefault();
                e.stopPropagation();
                openCallBackModal();
            }
        };

        const handleCallBackEscape = function (e) {
            if (e.key === 'Escape' && callBackModal.classList.contains('show')) {
                closeCallBackModal();
            }
        };

        // Remove old handlers and add new ones
        document.removeEventListener('click', handleCallBackClick);
        document.addEventListener('click', handleCallBackClick);

        if (callBackModalClose) {
            callBackModalClose.removeEventListener('click', closeCallBackModal);
            callBackModalClose.addEventListener('click', closeCallBackModal);
        }

        if (callBackModalOverlay) {
            callBackModalOverlay.removeEventListener('click', closeCallBackModal);
            callBackModalOverlay.addEventListener('click', closeCallBackModal);
        }

        document.removeEventListener('keydown', handleCallBackEscape);
        document.addEventListener('keydown', handleCallBackEscape);
    }

    // --- GLIGHTBOX FOR ALL GALLERIES ---
    // Initialize GLightbox for all galleries if the library is loaded
    // НЕ инициализируем на странице продукции - там свой GLightbox
    // НЕ инициализируем production-gallery - там свой GLightbox в production-slider.js
    const isProductsPageForGLightbox = document.body.classList.contains('page-template-page-products') ||
        window.location.pathname.includes('/products');

    if (typeof GLightbox !== 'undefined' && !isProductsPageForGLightbox) {
        // Исключаем production-gallery и prod-v2-gallery из глобальной инициализации
        window.globalLightbox = GLightbox({
            selector: '.glightbox:not([data-gallery="production-gallery"]):not([data-gallery="prod-v2-gallery"])',
            touchNavigation: true,
            loop: true,
            autoplayVideos: false,
            openEffect: 'zoom',
            closeEffect: 'fade',
            cssEfects: {
                fade: { in: 'fadeIn', out: 'fadeOut' },
                zoom: { in: 'zoomIn', out: 'zoomOut' }
            },
            preload: true,
            moreLength: 0,
            closeButton: true,
            // Ограничиваем размер изображения
            width: '90vw',
            height: '90vh',
            // Настройки для лучшего отображения
            zoomable: true,
            draggable: true,
            svg: {
                close: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
                next: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>',
                prev: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>'
            }
        });

        console.log('GLightbox initialized globally (excluding production-gallery):', window.globalLightbox);

        // Отдельная инициализация GLightbox для production-gallery (слайдер на главной)
        if (document.querySelector('[data-gallery="production-gallery"]')) {
            window.productionLightbox = GLightbox({
                selector: '[data-gallery="production-gallery"]',
                touchNavigation: true,
                loop: true,
                autoplayVideos: false,
                openEffect: 'zoom',
                closeEffect: 'fade',
                preload: true,
                moreLength: 0,
                closeButton: true,
                width: '90vw',
                height: '90vh',
                zoomable: true,
                draggable: true,
                svg: {
                    close: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
                    next: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>',
                    prev: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>'
                }
            });
            console.log('GLightbox initialized for production-gallery:', window.productionLightbox);
        }

        // Переопределяем инлайн-стили GLightbox для корректного отображения подписи
        if (window.globalLightbox) {
            // Обработчик при открытии lightbox
            window.globalLightbox.on('slide_changed', function () {
                fixGlightboxImageHeight();
            });

            // Обработчик при открытии
            window.globalLightbox.on('open', function () {
                // Вызываем сразу и с задержкой для надежности
                fixGlightboxImageHeight();
                setTimeout(fixGlightboxImageHeight, 100);
                setTimeout(fixGlightboxImageHeight, 300);

                // Также проверяем при изменении размера окна
                const resizeHandler = function () {
                    fixGlightboxImageHeight();
                };
                window.addEventListener('resize', resizeHandler);

                // Сохраняем обработчик для последующего удаления
                window._glightboxResizeHandler = resizeHandler;
            });

            // Обработчик при закрытии
            window.globalLightbox.on('close', function () {
                if (window._glightboxResizeHandler) {
                    window.removeEventListener('resize', window._glightboxResizeHandler);
                    window._glightboxResizeHandler = null;
                }
            });
        }

        // Функция для исправления высоты изображений в GLightbox
        function fixGlightboxImageHeight() {
            // Используем setTimeout для применения после того, как GLightbox установит свои стили
            setTimeout(function () {
                const images = document.querySelectorAll('.glightbox-container .gslide-image img');
                images.forEach(function (img) {
                    // Переопределяем инлайн-стиль max-height
                    const viewportHeight = window.innerHeight;
                    const maxHeight = Math.max(280, viewportHeight - 200); // Минимум 280px, оставляем 200px для подписи

                    // Удаляем старый max-height из style
                    if (img.style.maxHeight) {
                        img.style.removeProperty('max-height');
                    }

                    // Устанавливаем новый max-height
                    img.style.maxHeight = maxHeight + 'px';

                    // Также устанавливаем через setProperty с important для надежности
                    img.style.setProperty('max-height', maxHeight + 'px', 'important');
                });

                // Также ограничиваем контейнер изображения
                const imageContainers = document.querySelectorAll('.glightbox-container .gslide-image');
                imageContainers.forEach(function (container) {
                    const viewportHeight = window.innerHeight;
                    const maxHeight = Math.max(280, viewportHeight - 200);
                    container.style.maxHeight = maxHeight + 'px';
                    container.style.setProperty('max-height', maxHeight + 'px', 'important');
                });
            }, 50); // Небольшая задержка для применения после GLightbox
        }
    } else {
        console.warn('GLightbox library not found');
    }

    // --- PREVENT LIGHTBOX FOR CLIENT LOGOS ---
    // Prevent any lightbox from opening on client logo clicks
    document.addEventListener('click', function (e) {
        const target = e.target;

        // Check if clicked element or its parent has no-lightbox class
        if (target.classList.contains('no-lightbox') ||
            target.closest('.no-lightbox') ||
            target.hasAttribute('data-no-lightbox')) {

            // Stop any lightbox event propagation
            e.stopImmediatePropagation();

            // If it's a link, let it work normally
            const link = target.closest('a');
            if (link && link.href) {
                // Let the browser handle the link normally
                return true;
            }
        }
    }, true); // Use capture phase to intercept before other handlers

    // --- FAQ ACCORDION ---
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(function (item) {
        // Ищем кнопку вопроса - может быть .faq-question или .faq-card-header
        const question = item.querySelector('.faq-question, .faq-card-header');
        const answer = item.querySelector('.faq-answer, .faq-card-body');

        if (question && answer) {
            // Initialize aria-expanded attribute if not present
            if (!item.hasAttribute('aria-expanded')) {
                item.setAttribute('aria-expanded', 'false');
            }

            // Проверяем, не обработан ли уже этот элемент на странице
            if (question.hasAttribute('data-faq-handled')) {
                return; // Пропускаем, если уже обработан
            }

            question.addEventListener('click', function (e) {
                e.stopPropagation();
                const isExpanded = item.getAttribute('aria-expanded') === 'true';

                // Close all other items (optional - remove if you want multiple open)
                faqItems.forEach(function (otherItem) {
                    if (otherItem !== item) {
                        otherItem.setAttribute('aria-expanded', 'false');
                    }
                });

                // Toggle current item
                item.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
            });

            // Помечаем, что элемент обработан
            question.setAttribute('data-faq-handled', 'true');
        }
    });

    // Выравнивание текста по ширине заголовка в hero-блоке
    const heroTextBlock = document.querySelector('.hero-text-block');
    if (heroTextBlock) {
        const h1 = heroTextBlock.querySelector('h1');
        const leadParagraphs = heroTextBlock.querySelectorAll('.lead');

        if (h1 && leadParagraphs.length > 0) {
            let lastWidth = 0;
            const applyWidth = (width) => {
                if (!width || width === lastWidth) return;
                lastWidth = width;
                leadParagraphs.forEach(p => {
                    p.style.width = width + 'px';
                    p.style.maxWidth = width + 'px';
                });
            };

            if ('ResizeObserver' in window) {
                const observer = new ResizeObserver(entries => {
                    entries.forEach(entry => {
                        if (entry.target === h1) {
                            const measured = Math.round(entry.contentRect.width);
                            requestAnimationFrame(() => applyWidth(measured));
                        }
                    });
                });
                observer.observe(h1);
            } else {
                const setTextWidth = () => {
                    requestAnimationFrame(() => {
                        const measured = Math.round(h1.getBoundingClientRect().width);
                        applyWidth(measured);
                    });
                };

                setTextWidth();

                const debouncedSetTextWidth = debounce(setTextWidth, 150);
                window.addEventListener('resize', debouncedSetTextWidth);
            }
        }
    }

    // --- YANDEX MAP MODAL ---
    const yandexMapModal = document.getElementById('yandex-map-modal');
    const yandexMapModalClose = document.querySelector('.yandex-map-modal-close');
    const yandexMapModalOverlay = document.querySelector('.yandex-map-modal-overlay');
    const footerMapBtn = document.getElementById('footer-map-btn');
    let yandexMap = null;

    function loadScriptOnce(src, id) {
        return new Promise((resolve, reject) => {
            if (id) {
                const existing = document.getElementById(id);
                if (existing) {
                    if (existing.dataset.loaded === 'true') {
                        resolve();
                        return;
                    }
                    existing.addEventListener('load', () => resolve());
                    existing.addEventListener('error', () => reject(new Error('Failed to load script: ' + src)));
                    return;
                }
            }

            const s = document.createElement('script');
            if (id) s.id = id;
            s.src = src;
            s.async = true;
            s.defer = true;
            s.addEventListener('load', () => {
                s.dataset.loaded = 'true';
                resolve();
            });
            s.addEventListener('error', () => reject(new Error('Failed to load script: ' + src)));
            document.head.appendChild(s);
        });
    }

    function ensureYandexMapsLoaded() {
        if (typeof ymaps !== 'undefined') {
            return Promise.resolve();
        }
        const url = (window.elinarAjax && window.elinarAjax.yandexMapsUrl) ? window.elinarAjax.yandexMapsUrl : null;
        if (!url) {
            return Promise.reject(new Error('Yandex Maps URL is not provided'));
        }
        return loadScriptOnce(url, 'elinar-yandex-maps');
    }

    function initYandexMap() {
        if (typeof ymaps === 'undefined' || yandexMap) {
            return;
        }

        ymaps.ready(function () {
            if (yandexMap) {
                return;
            }

            // Данные компании
            var companyAddress = '143322, Московская область, Наро-Фоминский г.о., с. Атепцево, пл. Купца Алёшина, вл. №1';
            var companyName = 'ООО «ЭЛИНАР ПЛАСТ»';
            var companyServices = 'Производство изделий из пластмасс';
            var companyPhones = [
                { display: '+7 (496) 34-77-944', link: 'tel:+74963477944' },
                { display: '+7 (916) 978-58-14', link: 'tel:+79169785814' }
            ];
            var companyEmail = 'plast@elinar.ru';
            var workingHours = 'Работаем по будням с 8:00 до 17:00';

            // Точные координаты
            console.log("Elinar Map Init v2.1.1");
            var companyCoords = [55.325, 36.75];

            // Кастомный шаблон балуна
            var CustomBalloonLayout = ymaps.templateLayoutFactory.createClass(
                '<div class="elinar-balloon">' +
                '<button class="elinar-balloon-close" title="Закрыть">&times;</button>' +
                '<div class="elinar-balloon-content">' +
                '<div class="elinar-balloon-title">$[properties.companyName]</div>' +
                '<div class="elinar-balloon-address">$[properties.address]</div>' +
                '<ul class="elinar-balloon-contacts">' +
                '<li class="elinar-balloon-contact-item">' +
                '<svg class="elinar-balloon-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' +
                '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>' +
                '</svg>' +
                '<div class="elinar-balloon-contact-content">$[properties.phonesHtml]</div>' +
                '</li>' +
                '<li class="elinar-balloon-contact-item">' +
                '<svg class="elinar-balloon-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' +
                '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>' +
                '<polyline points="22,6 12,13 2,6"></polyline>' +
                '</svg>' +
                '<div class="elinar-balloon-contact-content">' +
                '<a href="mailto:$[properties.email]" class="elinar-balloon-email-link">$[properties.email]</a>' +
                '</div>' +
                '</li>' +
                '<li class="elinar-balloon-contact-item">' +
                '<svg class="elinar-balloon-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' +
                '<circle cx="12" cy="12" r="10"></circle>' +
                '<polyline points="12 6 12 12 16 14"></polyline>' +
                '</svg>' +
                '<div class="elinar-balloon-contact-content">$[properties.workingHours]</div>' +
                '</li>' +
                '</ul>' +
                '<a href="https://yandex.ru/maps/?rtext=~Московская%20область,%20Наро-Фоминский%20городской%20округ,%20село%20Атепцево,%20площадь%20Купца%20Алёшина,%201&rtt=auto" target="_blank" class="elinar-balloon-route">' +
                'Построить маршрут' +
                '</a>' +
                '</div>' +
                '</div>', {
                build: function () {
                    this.constructor.superclass.build.call(this);
                    this._$element = this.getParentElement().querySelector('.elinar-balloon');
                    this._$closeBtn = this._$element.querySelector('.elinar-balloon-close');
                    this._$closeBtn.addEventListener('click', this._onCloseClick.bind(this));
                },
                clear: function () {
                    if (this._$closeBtn) {
                        this._$closeBtn.removeEventListener('click', this._onCloseClick);
                    }
                    this.constructor.superclass.clear.call(this);
                },
                _onCloseClick: function (e) {
                    e.preventDefault();
                    this.events.fire('userclose');
                }
            });

            // Кастомный шаблон иконки метки (логотип в круге)
            var themeUrl = (window.elinarAjax && window.elinarAjax.themeUrl) ? window.elinarAjax.themeUrl : '/wp-content/themes/elinar-plast';
            var CustomIconLayout = ymaps.templateLayoutFactory.createClass(
                '<div class="elinar-map-pin">' +
                '<div class="elinar-map-pin-inner">' +
                '<img src="' + themeUrl + '/assets/images/logo-color-200.webp" alt="Элинар Пласт" />' +
                '</div>' +
                '<div class="elinar-map-pin-pointer"></div>' +
                '</div>'
            );

            // Инициализация карты
            yandexMap = new ymaps.Map("yandex-map", {
                center: companyCoords,
                zoom: 16,
                controls: ['zoomControl', 'fullscreenControl', 'geolocationControl']
            });

            // Подготовка HTML для телефонов
            var phonesHtml = companyPhones.map(function (p) {
                return '<a href="' + p.link + '" class="elinar-balloon-phone">' + p.display + '</a>';
            }).join('');

            // Создаем метку с кастомными layout
            var placemark = new ymaps.Placemark(companyCoords, {
                companyName: companyName,
                address: companyAddress,
                services: companyServices,
                phonesHtml: phonesHtml,
                email: companyEmail,
                workingHours: workingHours,
                coords: companyCoords[0] + ',' + companyCoords[1]
            }, {
                iconLayout: CustomIconLayout,
                iconShape: {
                    type: 'Circle',
                    coordinates: [38, 38],
                    radius: 38
                },
                iconOffset: [-38, -86],
                balloonOffset: (window.innerWidth < 768) ? [0, -100] : [-340, -150],
                balloonLayout: CustomBalloonLayout,
                balloonPanelMaxMapArea: 0,
                balloonAutoPan: true,
                hideIconOnBalloonOpen: false
            });

            yandexMap.geoObjects.add(placemark);

            // Открываем балун по умолчанию через небольшую задержку
            setTimeout(function () {
                placemark.balloon.open();
            }, 500);
        });
    }

    function openYandexMapModal() {
        if (yandexMapModal) {
            yandexMapModal.classList.add('show');
            document.body.style.overflow = 'hidden';
            ensureYandexMapsLoaded()
                .then(() => initYandexMap())
                .catch(() => {
                });
        }
    }

    function closeYandexMapModal() {
        if (yandexMapModal) {
            yandexMapModal.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    if (footerMapBtn) {
        footerMapBtn.addEventListener('click', openYandexMapModal);

        if ('IntersectionObserver' in window) {
            const preloadObserver = new IntersectionObserver(([entry]) => {
                if (!entry || !entry.isIntersecting) {
                    return;
                }
                ensureYandexMapsLoaded().finally(() => {
                    preloadObserver.disconnect();
                });
            }, { rootMargin: '600px' });

            preloadObserver.observe(footerMapBtn);
        }
    }

    if (yandexMapModalClose) {
        yandexMapModalClose.addEventListener('click', closeYandexMapModal);
    }

    if (yandexMapModalOverlay) {
        yandexMapModalOverlay.addEventListener('click', closeYandexMapModal);
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && yandexMapModal && yandexMapModal.classList.contains('show')) {
            closeYandexMapModal();
        }
    });

    // --- Обработка формы "Запросить расчет" ---
    const contactForms = document.querySelectorAll('.simple-form');

    contactForms.forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Проверка чекбокса согласия на обработку персональных данных
            const consentCheckbox = form.querySelector('input[name="consent"]');
            if (consentCheckbox && !consentCheckbox.checked) {
                // Удаляем предыдущие сообщения
                const existingMessage = form.querySelector('.form-message');
                if (existingMessage) {
                    existingMessage.remove();
                }

                // Создаем сообщение об ошибке
                const messageDiv = document.createElement('div');
                messageDiv.className = 'form-message form-message-error';
                messageDiv.textContent = 'Необходимо дать согласие на обработку персональных данных';

                const formButtons = form.querySelector('.form-buttons');
                if (formButtons) {
                    formButtons.parentNode.insertBefore(messageDiv, formButtons);
                } else {
                    form.appendChild(messageDiv);
                }

                // Прокрутка к сообщению
                messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

                // Выделяем чекбокс визуально
                if (consentCheckbox) {
                    consentCheckbox.focus();
                    consentCheckbox.style.outline = '2px solid #ef4444';
                    consentCheckbox.style.outlineOffset = '2px';
                    setTimeout(function () {
                        consentCheckbox.style.outline = '';
                        consentCheckbox.style.outlineOffset = '';
                    }, 3000);
                }

                return;
            }

            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton ? submitButton.textContent : '';

            // Добавляем nonce для безопасности
            if (typeof elinarAjax !== 'undefined') {
                formData.append('action', 'elinar_contact_form');
                formData.append('nonce', elinarAjax.nonce);
            } else {
                console.error('AJAX не настроен');
                return;
            }

            // Блокируем кнопку отправки
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Отправка...';
            }

            // Удаляем предыдущие сообщения
            const existingMessage = form.querySelector('.form-message');
            if (existingMessage) {
                existingMessage.remove();
            }

            // Отправка AJAX запроса
            fetch(elinarAjax.ajaxurl, {
                method: 'POST',
                body: formData
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    // Создаем элемент для сообщения
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'form-message';

                    if (data.success) {
                        messageDiv.className += ' form-message-success';
                        messageDiv.textContent = data.data.message;

                        // Очищаем форму при успешной отправке
                        form.reset();

                        // Автоматически скрываем сообщение через 5 секунд
                        setTimeout(function () {
                            messageDiv.style.opacity = '0';
                            setTimeout(function () {
                                messageDiv.remove();
                            }, 300);
                        }, 5000);
                    } else {
                        messageDiv.className += ' form-message-error';
                        messageDiv.textContent = data.data.message;
                    }

                    // Вставляем сообщение перед кнопками формы
                    const formButtons = form.querySelector('.form-buttons');
                    if (formButtons) {
                        formButtons.parentNode.insertBefore(messageDiv, formButtons);
                    } else {
                        form.appendChild(messageDiv);
                    }

                    // Прокрутка к сообщению
                    messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

                    // Восстанавливаем кнопку
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.textContent = originalButtonText;
                    }
                })
                .catch(function (error) {
                    console.error('Ошибка:', error);

                    // Создаем сообщение об ошибке
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'form-message form-message-error';
                    messageDiv.textContent = 'Произошла ошибка при отправке заявки. Пожалуйста, попробуйте позже или свяжитесь с нами по телефону.';

                    const formButtons = form.querySelector('.form-buttons');
                    if (formButtons) {
                        formButtons.parentNode.insertBefore(messageDiv, formButtons);
                    } else {
                        form.appendChild(messageDiv);
                    }

                    // Восстанавливаем кнопку
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.textContent = originalButtonText;
                    }
                });
        });
    });

});

// ============================================================================
// TECHNOLOGY SLIDER FUNCTIONALITY
// ============================================================================

class TechnologySlider {
    constructor() {
        this.currentSlide = 0;
        this.slides = document.querySelectorAll('.slide');
        this.bullets = document.querySelectorAll('.bullet');
        this.totalSlides = this.slides.length;
        this.autoplayInterval = null;
        this.autoplayDelay = 5000; // 5 секунд

        this.init();
    }

    init() {
        // Если нет буллетов, считаем, что это не тот слайдер (или слайдера вообще нет)
        // и выходим, чтобы не ломать другие скрипты и не вызывать ошибки на других страницах
        if (!this.bullets.length) return;

        if (!this.slides.length) return;

        // Назначаем обработчики событий
        const prevBtn = document.querySelector('.prev-slide');
        const nextBtn = document.querySelector('.next-slide');

        if (prevBtn) prevBtn.addEventListener('click', () => this.prevSlide());
        if (nextBtn) nextBtn.addEventListener('click', () => this.nextSlide());

        // Обработчики для буллетов
        this.bullets.forEach((bullet, index) => {
            bullet.addEventListener('click', () => this.goToSlide(index));
        });

        // Обработчики для lightbox
        this.initLightbox();

        // Запуск автоплея
        this.startAutoplay();

        // Пауза автоплея при наведении
        const sliderContainer = document.querySelector('.slider-container');
        if (sliderContainer) {
            sliderContainer.addEventListener('mouseenter', () => this.stopAutoplay());
            sliderContainer.addEventListener('mouseleave', () => this.startAutoplay());
        }

        // Обработка свайпов для мобильных устройств
        this.initSwipeGestures();

        // Обработка клавиатуры
        this.initKeyboardNavigation();
    }

    showSlide(index) {
        if (index < 0 || index >= this.totalSlides) return;

        // Скрываем все слайды
        this.slides.forEach(slide => slide.classList.remove('active'));
        this.bullets.forEach(bullet => bullet.classList.remove('active'));

        // Показываем текущий слайд
        this.slides[index].classList.add('active');
        this.bullets[index].classList.add('active');

        this.currentSlide = index;
    }

    nextSlide() {
        const nextIndex = (this.currentSlide + 1) % this.totalSlides;
        this.showSlide(nextIndex);
    }

    prevSlide() {
        const prevIndex = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        this.showSlide(prevIndex);
    }

    goToSlide(index) {
        this.showSlide(index);
        this.restartAutoplay();
    }

    startAutoplay() {
        this.stopAutoplay();
        this.autoplayInterval = setInterval(() => {
            this.nextSlide();
        }, this.autoplayDelay);
    }

    stopAutoplay() {
        if (this.autoplayInterval) {
            clearInterval(this.autoplayInterval);
            this.autoplayInterval = null;
        }
    }

    restartAutoplay() {
        this.stopAutoplay();
        this.startAutoplay();
    }

    initLightbox() {
        const lightbox = document.getElementById('technology-lightbox');
        const lightboxImage = document.getElementById('lightbox-image');
        const lightboxClose = document.querySelector('.lightbox-close');

        if (!lightbox || !lightboxImage || !lightboxClose) return;

        // Обработчики для изображений
        this.slides.forEach(slide => {
            const img = slide.querySelector('img');
            if (img) {
                img.addEventListener('click', (e) => {
                    e.preventDefault();
                    const lightboxSrc = img.getAttribute('data-lightbox');
                    const alt = img.getAttribute('alt');

                    if (lightboxSrc) {
                        lightboxImage.src = lightboxSrc;
                        lightboxImage.alt = alt;
                        lightbox.classList.add('active');
                        document.body.style.overflow = 'hidden';
                    }
                });
            }
        });

        // Закрытие lightbox
        const closeLightbox = () => {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        };

        lightboxClose.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                closeLightbox();
            }
        });

        // Закрытие по ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && lightbox.classList.contains('active')) {
                closeLightbox();
            }
        });
    }

    initSwipeGestures() {
        let touchStartX = 0;
        let touchEndX = 0;
        const sliderWrapper = document.querySelector('.slider-wrapper');

        if (!sliderWrapper) return;

        sliderWrapper.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        sliderWrapper.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe(touchStartX, touchEndX);
        }, { passive: true });
    }

    handleSwipe(startX, endX) {
        const swipeThreshold = 50;
        const diff = startX - endX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                this.nextSlide(); // Свайп влево
            } else {
                this.prevSlide(); // Свайп вправо
            }
            this.restartAutoplay();
        }
    }

    initKeyboardNavigation() {
        document.addEventListener('keydown', (e) => {
            const lightbox = document.getElementById('technology-lightbox');

            // Если lightbox открыт, не обрабатываем навигацию слайдера
            if (lightbox && lightbox.classList.contains('active')) return;

            switch (e.key) {
                case 'ArrowLeft':
                    e.preventDefault();
                    this.prevSlide();
                    this.restartAutoplay();
                    break;
                case 'ArrowRight':
                    e.preventDefault();
                    this.nextSlide();
                    this.restartAutoplay();
                    break;
            }
        });
    }
}

// Инициализация слайдера при загрузке страницы
document.addEventListener('DOMContentLoaded', () => {
    new TechnologySlider();
});

// Для WordPress: переинициализация при динамической загрузке контента
if (typeof jQuery !== 'undefined') {
    jQuery(document).on('ready', function () {
        new TechnologySlider();
    });
}

// ============================================================================
// PRODUCT PAGE SLIDERS - Moved to products-slider.js
// ============================================================================
// Код слайдеров страницы Продукция перенесен в отдельный файл:
// /assets/js/products-slider.js
// Этот файл подключается только на странице /products/
