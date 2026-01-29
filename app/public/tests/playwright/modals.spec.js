const { test, expect } = require('@playwright/test');
const { waitForPageLoad, closeCookieBanner } = require('./helpers');

test.describe('Модальные окна', () => {
  test.beforeEach(async ({ page }) => {
    await page.goto('/');
    await waitForPageLoad(page);
  });

  test('Модальное окно "Заказать звонок" открывается и закрывается', async ({ page }) => {
    // Ищем видимую кнопку - на десктопе это #call-back-btn-header, на мобильных #call-back-btn
    // Сначала пробуем десктопную версию
    const callBackBtnHeader = page.locator('#call-back-btn-header');
    const callBackBtnMobile = page.locator('#call-back-btn');

    // Проверяем видимость обеих кнопок
    const headerVisible = await callBackBtnHeader.isVisible().catch(() => false);
    const mobileVisible = await callBackBtnMobile.isVisible().catch(() => false);

    // Выбираем видимую кнопку
    const callBackBtn = headerVisible ? callBackBtnHeader : (mobileVisible ? callBackBtnMobile : callBackBtnHeader);

    await expect(callBackBtn).toBeVisible({ timeout: 10000 });
    await callBackBtn.click();

    const modal = page.locator('#call-back-modal');
    // Модальное окно открывается через класс show
    await expect(modal).toHaveClass(/show/);

    // Проверяем наличие контактной информации
    const phoneLink = modal.locator('a[href*="tel:"]');
    await expect(phoneLink).toBeVisible();

    // Закрываем модальное окно
    const closeBtn = modal.locator('.callback-modal-close, .modal-close');
    await closeBtn.click();
    await page.waitForTimeout(300);

    // Модальное окно должно закрыться (класс show должен исчезнуть)
    await expect(modal).not.toHaveClass(/show/);
  });

  test('Модальные окна продуктов открываются', async ({ page }) => {
    // Прокручиваем к футеру, где находятся триггеры
    await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight));
    await page.waitForTimeout(500);
    await closeCookieBanner(page);

    // Ищем триггеры модальных окон продуктов в футере
    const pvcTrigger = page.locator('#pvc-modal-trigger-footer').first();

    if (await pvcTrigger.count() > 0) {
      await expect(pvcTrigger).toBeVisible();
      await pvcTrigger.click();
      await page.waitForTimeout(300);

      const pvcModal = page.locator('#pvc-modal');
      // Модальное окно открывается через класс show
      await expect(pvcModal).toHaveClass(/show/);

      // Проверяем наличие контента
      const modalTitle = pvcModal.locator('h2, .pvc-title');
      await expect(modalTitle.first()).toBeVisible();

      // Закрываем модальное окно
      const closeBtn = pvcModal.locator('.modal-close');
      await closeBtn.click();
      await page.waitForTimeout(300);

      // Модальное окно должно закрыться
      await expect(pvcModal).not.toHaveClass(/show/);
    }
  });

  test('FAB (Floating Action Button) открывает меню мессенджеров', async ({ page }) => {
    // Прокручиваем страницу, чтобы FAB был виден
    await page.evaluate(() => window.scrollTo(0, 500));
    await page.waitForTimeout(500);
    await closeCookieBanner(page);

    const fabTrigger = page.locator('#fab-trigger, .fab-trigger');

    if (await fabTrigger.count() > 0) {
      await expect(fabTrigger).toBeVisible();

      await fabTrigger.click();
      await page.waitForTimeout(300);

      // Проверяем, что меню открылось (обычно через класс active или visible)
      const fabMenu = page.locator('.fab-menu');
      await expect(fabMenu).toBeVisible();

      // Проверяем наличие ссылок на мессенджеры
      const whatsappLink = fabMenu.locator('a[href*="wa.me"], a[href*="whatsapp"]');
      const telegramLink = fabMenu.locator('a[href*="t.me"], a[href*="telegram"]');

      if (await whatsappLink.count() > 0) {
        await expect(whatsappLink.first()).toBeVisible();
      }

      if (await telegramLink.count() > 0) {
        await expect(telegramLink.first()).toBeVisible();
      }
    }
  });

  test('Модальное окно Yandex Maps открывается из футера', async ({ page }) => {
    // Прокручиваем к футеру
    await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight));
    await page.waitForTimeout(500);
    await closeCookieBanner(page);

    const mapBtn = page.locator('#footer-map-btn');

    if (await mapBtn.count() > 0) {
      await expect(mapBtn).toBeVisible();
      await mapBtn.click();
      await page.waitForTimeout(300);

      const mapModal = page.locator('#yandex-map-modal');
      // Модальное окно открывается через класс show
      await expect(mapModal).toHaveClass(/show/);

      // Проверяем наличие карты
      const mapContainer = mapModal.locator('#yandex-map');
      await expect(mapContainer).toBeVisible();

      // Закрываем модальное окно
      const closeBtn = mapModal.locator('.yandex-map-modal-close');
      await closeBtn.click();
      await page.waitForTimeout(300);

      // Модальное окно должно закрыться
      await expect(mapModal).not.toHaveClass(/show/);
    }
  });
});

