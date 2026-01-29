(function () {
  // Detect Opera on Android
  var ua = navigator.userAgent || navigator.vendor || window.opera;
  var isOperaAndroid = /OPR|Opera/.test(ua) && /Android/.test(ua);

  if (isOperaAndroid) {
    // Add class to body immediately
    if (document.body) {
      document.body.classList.add('opera-android-fix');
    } else {
      document.addEventListener('DOMContentLoaded', function () {
        if (document.body) {
          document.body.classList.add('opera-android-fix');
        }
      });
    }

    // Function to aggressively fix icon sizes and close cards
    var fixOperaIcons = function () {
      if (window.innerWidth > 768) return;

      // Fix advantage card icons
      var icons = document.querySelectorAll('.advantage-card-icon');
      for (var i = 0; i < icons.length; i++) {
        var icon = icons[i];
        icon.style.cssText = 'width: 40px !important; height: 40px !important; max-width: 40px !important; max-height: 40px !important; min-width: 40px !important; min-height: 40px !important; box-sizing: border-box !important; overflow: hidden !important; flex-shrink: 0 !important;';

        var svg = icon.querySelector('svg');
        if (svg) {
          svg.style.cssText = 'width: 40px !important; height: 40px !important; max-width: 40px !important; max-height: 40px !important; min-width: 40px !important; min-height: 40px !important; box-sizing: border-box !important; display: block !important; transform: scale(1) !important;';
          svg.setAttribute('width', '40');
          svg.setAttribute('height', '40');
        }
      }

      // Close advantage card descriptions by default
      var descriptions = document.querySelectorAll('.advantage-card-description');
      for (var j = 0; j < descriptions.length; j++) {
        var desc = descriptions[j];
        desc.style.cssText = 'max-height: 0 !important; opacity: 0 !important; overflow: hidden !important; margin-top: 0 !important; visibility: hidden !important;';
      }

      // Fix breadcrumb icons and alignment
      var figures = document.querySelectorAll('.breadcrumbs-list li a figure');
      for (var k = 0; k < figures.length; k++) {
        var figure = figures[k];
        figure.style.cssText = 'width: 16px !important; height: 16px !important; max-width: 16px !important; max-height: 16px !important; min-width: 16px !important; min-height: 16px !important; box-sizing: border-box !important; overflow: hidden !important; flex-shrink: 0 !important; margin: 0 !important; padding: 0 !important;';

        var figureSvg = figure.querySelector('svg');
        if (figureSvg) {
          figureSvg.style.cssText = 'width: 16px !important; height: 16px !important; max-width: 16px !important; max-height: 16px !important; min-width: 16px !important; min-height: 16px !important; box-sizing: border-box !important; display: block !important; transform: scale(1) !important; margin: 0 !important; padding: 0 !important; vertical-align: middle !important;';
          figureSvg.setAttribute('width', '16');
          figureSvg.setAttribute('height', '16');
        }
      }

      // Fix breadcrumb list alignment
      var breadcrumbLists = document.querySelectorAll('.breadcrumbs-list');
      for (var l = 0; l < breadcrumbLists.length; l++) {
        breadcrumbLists[l].style.cssText = 'align-items: center !important; display: flex !important; flex-wrap: wrap !important;';
      }

      var breadcrumbItems = document.querySelectorAll('.breadcrumbs-list li');
      for (var m = 0; m < breadcrumbItems.length; m++) {
        breadcrumbItems[m].style.cssText = 'display: flex !important; align-items: center !important; vertical-align: middle !important;';
      }

      var breadcrumbLinks = document.querySelectorAll('.breadcrumbs-list li a');
      for (var n = 0; n < breadcrumbLinks.length; n++) {
        breadcrumbLinks[n].style.cssText = 'display: flex !important; align-items: center !important; vertical-align: middle !important; line-height: 1 !important;';
      }
    };

    // Apply immediately when DOM is ready
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', function () {
        setTimeout(fixOperaIcons, 0);
        setTimeout(fixOperaIcons, 100);
        setTimeout(fixOperaIcons, 500);
      });
    } else {
      setTimeout(fixOperaIcons, 0);
      setTimeout(fixOperaIcons, 100);
      setTimeout(fixOperaIcons, 500);
    }

    // Watch for changes
    if (document.body) {
      var observer = new MutationObserver(function () {
        fixOperaIcons();
      });
      observer.observe(document.body, {
        childList: true,
        subtree: true
      });
    }

    // Setup card click handlers for Opera Android
    var setupOperaCardHandlers = function () {
      var cards = document.querySelectorAll('.advantage-card');
      for (var p = 0; p < cards.length; p++) {
        // Use IIFE to create proper closure for each card
        (function (currentCard) {
          var card = currentCard;
          var description = card.querySelector('.advantage-card-description');
          if (description) {
            var isOpen = false;
            var touchTimeout;

            var openCard = function () {
              if (window.innerWidth <= 768) {
                isOpen = true;
                card.classList.add('touched');
                description.style.cssText = 'visibility: visible !important; max-height: 300px !important; opacity: 1 !important; margin-top: 1rem !important; overflow: hidden !important;';
              }
            };

            var closeCard = function () {
              if (window.innerWidth <= 768) {
                isOpen = false;
                card.classList.remove('touched');
                description.style.cssText = 'max-height: 0 !important; opacity: 0 !important; overflow: hidden !important; margin-top: 0 !important; visibility: hidden !important;';
              }
            };

            // Click handler
            card.addEventListener('click', function (e) {
              if (window.innerWidth <= 768) {
                e.preventDefault();
                e.stopPropagation();

                clearTimeout(touchTimeout);

                if (isOpen) {
                  closeCard();
                } else {
                  // Close other cards
                  var allCards = document.querySelectorAll('.advantage-card');
                  for (var q = 0; q < allCards.length; q++) {
                    if (allCards[q] !== card) {
                      var otherDesc = allCards[q].querySelector('.advantage-card-description');
                      if (otherDesc) {
                        allCards[q].classList.remove('touched');
                        otherDesc.style.cssText = 'max-height: 0 !important; opacity: 0 !important; overflow: hidden !important; margin-top: 0 !important; visibility: hidden !important;';
                      }
                    }
                  }
                  openCard();

                  touchTimeout = setTimeout(function () {
                    closeCard();
                  }, 5000);
                }
              }
            }, true);
          }
        })(cards[p]);
      }
    };

    // Setup handlers when DOM is ready
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', function () {
        setTimeout(setupOperaCardHandlers, 100);
        setTimeout(setupOperaCardHandlers, 500);
      });
    } else {
      setTimeout(setupOperaCardHandlers, 100);
      setTimeout(setupOperaCardHandlers, 500);
    }
  }
})();
