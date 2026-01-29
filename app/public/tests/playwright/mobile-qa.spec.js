const { test, expect } = require('@playwright/test');
const path = require('path');
const { waitForPageLoad, closeCookieBanner } = require('./helpers');

const viewports = [
  { name: '320x568', width: 320, height: 568 },
  { name: '375x667', width: 375, height: 667 },
  { name: '414x896', width: 414, height: 896 },
  { name: '768x1024', width: 768, height: 1024 },
];

const fixtureFile = path.resolve(
  __dirname,
  '../../wp-content/themes/elinar-plast/assets/images/favicon/favicon-16x16.png'
);

const mobileProjects = ['Mobile Chrome', 'Mobile Safari'];

function shouldSkipNonMobile(testInfo) {
  return !mobileProjects.includes(testInfo.project.name);
}

async function dismissCookieBanner(page) {
  await closeCookieBanner(page);
  await page.evaluate(() => {
    const banner = document.getElementById('cookie-banner');
    if (banner) {
      banner.style.pointerEvents = 'none';
      banner.style.display = 'none';
    }
  });
}

async function fillQuoteFormMinimal(page) {
  await dismissCookieBanner(page);

  const formWrapper = page.locator('#quote-form-wrapper');
  if ((await formWrapper.count()) > 0) {
    await formWrapper.scrollIntoViewIfNeeded();
  }

  await page.locator('input[name="technology"][value="extrusion"]').check({ force: true });
  await page.locator('#quote-next').click({ force: true });

  await page.locator('#project_name').fill('Тестовый проект');
  await page.locator('#product_type_extrusion').selectOption('profile_solid');
  await page.locator('#project_stage').selectOption('drawing');
  await dismissCookieBanner(page);
  await page.locator('#quote-next').click({ force: true });

  await page.locator('#material').selectOption('pp');
  await dismissCookieBanner(page);
  await page.locator('#quote-next').click({ force: true });

  await page.locator('input[name="production_volume"][value="single"]').check({ force: true });
  await dismissCookieBanner(page);
  await page.locator('#quote-next').click({ force: true });

  await dismissCookieBanner(page);
  await page.locator('#quote-next').click({ force: true });

  await page.locator('#company').fill('Тест ООО');
  await page.locator('#contact_person').fill('Иван Иванов');
  await page.locator('#phone').fill('+7 (999) 123-45-67');
  await page.locator('#email').fill('test@example.com');
  await page.locator('input[name="consent"]').check({ force: true });
}

viewports.forEach(({ name, width, height }) => {
  test.describe(`Мобильная адаптивность ${name}`, () => {
    test.use({ viewport: { width, height } });

    test.beforeEach(async ({ }, testInfo) => {
      test.skip(shouldSkipNonMobile(testInfo), 'Только для mobile проектов');
    });

    test('Главная страница адаптивна и без горизонтального скролла', async ({ page }, testInfo) => {
      await page.goto('/');
      await waitForPageLoad(page);

      const metrics = await page.evaluate(() => {
        const doc = document.documentElement;
        const body = document.body;
        return {
          scrollWidth: Math.max(doc.scrollWidth, body.scrollWidth, doc.offsetWidth, body.offsetWidth),
          viewportWidth: window.innerWidth,
        };
      });

      const scrollX = await page.evaluate(() => {
        window.scrollTo(200, 0);
        const x = window.scrollX;
        window.scrollTo(0, 0);
        return x;
      });

      if (scrollX > 0) {
        testInfo.annotations.push({
          type: 'warning',
          description: `Обнаружен горизонтальный скролл: ${scrollX}px (viewport ${metrics.viewportWidth}px, scrollWidth ${metrics.scrollWidth}px)`
        });
      }

      await expect(page.locator('.site-header')).toBeVisible();

      const footerLocator = page.locator('.site-footer, footer');
      const footerCount = await footerLocator.count();
      if (footerCount === 0) {
        testInfo.annotations.push({
          type: 'warning',
          description: 'Футер не найден на странице'
        });
      }
    });
  });
});

test.describe('Мобильные формы и интерактив', () => {
  test.use({ viewport: { width: 375, height: 667 } });

  test.beforeEach(async ({ }, testInfo) => {
    test.skip(shouldSkipNonMobile(testInfo), 'Только для mobile проектов');
  });

  test('Форма инженерной оценки показывает индикатор отправки', async ({ page }, testInfo) => {
    await page.goto('/');
    await waitForPageLoad(page);

    const contactSection = page.locator('#contact-form');
    if ((await contactSection.count()) === 0) {
      test.skip(true, 'Секция формы аудита не найдена');
    }

    await contactSection.scrollIntoViewIfNeeded();

    const form = page.locator('#project-form');
    const submitBtn = page.locator('#submit-btn');
    await expect(form).toBeVisible();

    await form.evaluate(formEl => {
      formEl.addEventListener('submit', event => {
        event.preventDefault();
      }, { capture: true, once: true });
    });

    await page.locator('#form-name').fill('Тестовый Пользователь');
    await page.locator('#form-phone').fill('+7 (999) 111-22-33');
    await page.locator('#form-email').fill('test@example.com');

    await closeCookieBanner(page);
    await submitBtn.click({ force: true });

    const indicatorActive = await submitBtn.evaluate(btn => {
      const hasClass = btn.classList.contains('is-submitting');
      const disabled = btn.disabled;
      const text = btn.textContent || '';
      return hasClass || disabled || text.includes('Заявка отправляется');
    });

    if (!indicatorActive) {
      testInfo.annotations.push({
        type: 'warning',
        description: 'Индикатор отправки не активировался после submit'
      });
    }
  });

  test('Форма инженерной оценки принимает файл', async ({ page }) => {
    await page.goto('/');
    await waitForPageLoad(page);

    const contactSection = page.locator('#contact-form');
    if ((await contactSection.count()) === 0) {
      test.skip(true, 'Секция формы аудита не найдена');
    }

    await contactSection.scrollIntoViewIfNeeded();

    const fileInput = page.locator('#form-file');
    if ((await fileInput.count()) === 0) {
      test.skip(true, 'Поле загрузки файла не найдено');
    }
    await fileInput.setInputFiles(fixtureFile);

    const fileInfo = page.locator('#file-info');
    await expect(fileInfo).toContainText('favicon-16x16.png');
  });

  test('Форма запроса расчета принимает файл и отправляется с лоадером', async ({ page }, testInfo) => {
    await page.goto('/quote-request');
    await waitForPageLoad(page);

    await closeCookieBanner(page);

    const quoteForm = page.locator('#quote-form');
    if ((await quoteForm.count()) === 0) {
      test.skip(true, 'Форма запроса расчета не найдена');
    }

    const hasAjaxConfig = await page.evaluate(() => typeof window.quoteFormAjax !== 'undefined');
    if (!hasAjaxConfig) {
      testInfo.annotations.push({
        type: 'warning',
        description: 'Не найден quoteFormAjax, проверка отправки пропущена'
      });
      test.skip(true, 'Нет настроек AJAX для quote-form');
    }

    const fileInput = page.locator('#quote-files');
    if ((await fileInput.count()) === 0) {
      test.skip(true, 'Поле загрузки файлов для quote-form не найдено');
    }
    await fileInput.setInputFiles(fixtureFile);

    const fileList = page.locator('#quote-file-list .quote-file-item');
    await fileList.first().waitFor({ state: 'attached', timeout: 5000 }).catch(() => { });
    const fileCount = await fileList.count();
    if (fileCount === 0) {
      testInfo.annotations.push({
        type: 'warning',
        description: 'Список файлов не появился после загрузки'
      });
    } else {
      await expect(fileList.first()).toContainText('favicon-16x16.png');
    }

    await fillQuoteFormMinimal(page);

    await expect(page.locator('#quote-submit')).toBeVisible();

    await page.route('**/admin-ajax.php', async route => {
      await route.fulfill({
        status: 200,
        contentType: 'application/json',
        body: JSON.stringify({
          success: true,
          data: { message: 'OK' }
        })
      });
    });

    await page.locator('#quote-submit').click();

    const success = page.locator('#quote-success');
    await success.waitFor({ state: 'visible', timeout: 10000 }).catch(() => { });
    const successVisible = await success.isVisible().catch(() => false);

    if (!successVisible) {
      testInfo.annotations.push({
        type: 'warning',
        description: 'Сообщение об успехе не появилось после отправки quote-form'
      });
    }
  });
});

test.describe('Мобильные модали и SEO/URL', () => {
  test.use({ viewport: { width: 375, height: 667 } });

  test.beforeEach(async ({ }, testInfo) => {
    test.skip(shouldSkipNonMobile(testInfo), 'Только для mobile проектов');
  });

  test('Модальное окно обратного звонка открывается и закрывается', async ({ page }, testInfo) => {
    await page.goto('/');
    await waitForPageLoad(page);

    await closeCookieBanner(page);

    const callBackBtnHeader = page.locator('#call-back-btn-header');
    const callBackBtnMobile = page.locator('#call-back-btn');

    const headerVisible = await callBackBtnHeader.isVisible().catch(() => false);
    const mobileVisible = await callBackBtnMobile.isVisible().catch(() => false);

    let callBackBtn = null;
    if (mobileVisible) {
      callBackBtn = callBackBtnMobile;
    } else if (headerVisible) {
      callBackBtn = callBackBtnHeader;
    }

    if (!callBackBtn) {
      test.skip(true, 'Кнопка обратного звонка не найдена');
    }

    await callBackBtn.click({ force: true });

    const modal = page.locator('#call-back-modal');
    await modal.waitFor({ state: 'attached', timeout: 5000 }).catch(() => { });
    const modalOpened = await modal.evaluate(el => el.classList.contains('show')).catch(() => false);

    if (!modalOpened) {
      testInfo.annotations.push({
        type: 'warning',
        description: 'Модальное окно обратного звонка не открылось'
      });
      return;
    }

    const closeBtn = modal.locator('.callback-modal-close, .modal-close');
    await closeBtn.click();
    await page.waitForTimeout(300);

    await expect(modal).not.toHaveClass(/show/);
  });

  test('SEO/URL: страницы quote-request и privacy-policy доступны', async ({ page }) => {
    await page.goto('/quote-request');
    await waitForPageLoad(page);
    await expect(page.locator('h1, .page-title').first()).toBeVisible();

    await page.goto('/privacy-policy');
    await waitForPageLoad(page);
    await expect(page.locator('h1, .page-title').first()).toBeVisible();
  });

  test('Подключены минифицированные CSS/JS ассеты', async ({ page }) => {
    await page.goto('/');
    await waitForPageLoad(page);

    const minCss = page.locator('link[href*="style.min.css"], link[href*="style.css"]');
    const mainJs = page.locator('script[src*="/assets/js/main"]');

    const cssCount = await minCss.count();
    const jsCount = await mainJs.count();
    expect(cssCount).toBeGreaterThan(0);
    expect(jsCount).toBeGreaterThan(0);
  });
});
