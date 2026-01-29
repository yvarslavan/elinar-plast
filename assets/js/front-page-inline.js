document.addEventListener('DOMContentLoaded', function () {
  // 1. Открытие модальных окон
  var triggers = document.querySelectorAll('.product-modal-trigger');
  triggers.forEach(function (trigger) {
    trigger.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      var targetId = this.getAttribute('data-modal-target');
      if (targetId) {
        var modal = document.getElementById(targetId);
        if (modal) {
          modal.classList.add('show');
          document.body.style.overflow = 'hidden';
        } else {
          console.error('Modal not found:', targetId);
        }
      }
    });
  });

  // 2. Закрытие модальных окон (крестик)
  var closeButtons = document.querySelectorAll('.modal-close');
  closeButtons.forEach(function (button) {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      var modal = this.closest('.modal');
      if (modal) {
        modal.classList.remove('show');
        document.body.style.overflow = '';
      }
    });
  });

  // 3. Закрытие по клику вне контента (на затемненный фон)
  var modals = document.querySelectorAll('.modal');
  modals.forEach(function (modal) {
    modal.addEventListener('click', function (e) {
      if (e.target === this) {
        this.classList.remove('show');
        document.body.style.overflow = '';
      }
    });
  });
});

(function () {
  'use strict';

  // Очищаем URL от параметров формы после загрузки
  if (window.location.search.includes('form=')) {
    var cleanUrl = window.location.pathname + window.location.hash;
    window.history.replaceState({}, document.title, cleanUrl);
  }

  // Маска телефона +7 (999) 999-99-99
  var phoneInput = document.getElementById('form-phone');
  if (phoneInput) {
    phoneInput.addEventListener('input', function (e) {
      var value = e.target.value.replace(/\D/g, '');
      if (value.length > 0) {
        if (value[0] === '8') value = '7' + value.slice(1);
        if (value[0] !== '7') value = '7' + value;
      }
      var formatted = '';
      if (value.length > 0) formatted = '+7';
      if (value.length > 1) formatted += ' (' + value.slice(1, 4);
      if (value.length > 4) formatted += ') ' + value.slice(4, 7);
      if (value.length > 7) formatted += '-' + value.slice(7, 9);
      if (value.length > 9) formatted += '-' + value.slice(9, 11);
      e.target.value = formatted;
    });
    phoneInput.addEventListener('focus', function () {
      if (!this.value) this.value = '+7 (';
    });
    phoneInput.addEventListener('blur', function () {
      if (this.value === '+7 (' || this.value === '+7') this.value = '';
    });
  }

  // Обработка файла
  var fileInput = document.getElementById('form-file');
  var fileInfo = document.getElementById('file-info');
  if (fileInput && fileInfo) {
    var allowedExtensions = ['.pdf', '.dwg', '.dxf', '.jpg', '.jpeg', '.png', '.zip'];
    var maxSize = 15 * 1024 * 1024;

    fileInput.addEventListener('change', function () {
      var file = this.files[0];
      var fileError = document.getElementById('file-error');
      if (!file) {
        fileInfo.classList.remove('show');
        fileInfo.innerHTML = '';
        return;
      }
      var ext = '.' + file.name.split('.').pop().toLowerCase();
      if (!allowedExtensions.includes(ext)) {
        if (fileError) fileError.textContent = 'Недопустимый формат файла.';
        this.value = '';
        fileInfo.classList.remove('show');
        return;
      }
      if (file.size > maxSize) {
        if (fileError) fileError.textContent = 'Файл слишком большой. Максимум 15 МБ.';
        this.value = '';
        fileInfo.classList.remove('show');
        return;
      }
      if (fileError) fileError.textContent = '';
      var sizeMB = (file.size / 1024 / 1024).toFixed(2);
      fileInfo.innerHTML = '<span>' + file.name + ' (' + sizeMB + ' МБ)</span><span class="remove-file" onclick="removeFile()">✕</span>';
      fileInfo.classList.add('show');
    });
  }

  window.removeFile = function () {
    if (fileInput) fileInput.value = '';
    if (fileInfo) {
      fileInfo.classList.remove('show');
      fileInfo.innerHTML = '';
    }
  };
})();

// === FAQ CROSS-PROMO BANNER FUNCTIONALITY ===
(function () {
  'use strict';

  // Закрытие баннера с сохранением в localStorage
  function closeBanner(bannerId) {
    var banner = document.getElementById(bannerId);
    if (banner) {
      banner.classList.add('hidden');
      localStorage.setItem('faq_banner_' + bannerId + '_closed', 'true');

      // Отслеживание закрытия для аналитики
      if (typeof gtag !== 'undefined') {
        gtag('event', 'faq_banner_closed', {
          'event_category': 'FAQ Banner',
          'event_label': bannerId + '_home',
          'value': 1
        });
      }
    }
  }

  // Обработчик закрытия баннера
  var closeButton = document.querySelector('[data-close-banner="faq-cross-promo"]');
  if (closeButton) {
    closeButton.addEventListener('click', function (e) {
      e.preventDefault();
      closeBanner('faq-cross-promo');
    });
  }

  // Проверка localStorage при загрузке страницы
  var banner = document.getElementById('faq-cross-promo');
  if (banner && localStorage.getItem('faq_banner_faq-cross-promo_closed') === 'true') {
    banner.classList.add('hidden');
  }

  // Отслеживание клика на кнопку тизера
  var promoBtn = document.querySelector('[data-faq-teaser="cross-promo-home"]');
  if (promoBtn) {
    promoBtn.addEventListener('click', function () {
      if (typeof gtag !== 'undefined') {
        gtag('event', 'faq_teaser_click', {
          'event_category': 'FAQ Teaser',
          'event_label': 'cross-promo-home',
          'value': 1
        });
      }
      if (typeof ym !== 'undefined') {
        ym(window.yaCounterId || 0, 'reachGoal', 'faq_teaser_click', {
          teaser_type: 'cross-promo-home'
        });
      }
    });
  }
})();
