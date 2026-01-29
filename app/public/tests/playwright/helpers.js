/**
 * Helper функции для тестов Playwright
 */

/**
 * Закрывает cookie баннер, если он отображается
 * @param {import('@playwright/test').Page} page
 */
async function closeCookieBanner(page) {
  const cookieBanner = page.locator('#cookie-banner');
  const cookieAcceptBtn = page.locator('#cookie-accept');

  // Проверяем, виден ли баннер
  if (await cookieBanner.count() > 0) {
    const isVisible = await cookieBanner.isVisible().catch(() => false);
    if (isVisible) {
      // Ждем появления кнопки "Принять"
      await cookieAcceptBtn.waitFor({ state: 'visible', timeout: 2000 }).catch(() => {});

      // Кликаем на кнопку "Принять"
      if (await cookieAcceptBtn.count() > 0) {
        await cookieAcceptBtn.click({ force: true }).catch(() => {});
        // Ждем, пока баннер исчезнет
        await cookieBanner.waitFor({ state: 'hidden', timeout: 2000 }).catch(() => {});
      }
    }
  }
}

/**
 * Ждет полной загрузки страницы
 * @param {import('@playwright/test').Page} page
 */
async function waitForPageLoad(page) {
  await page.waitForLoadState('networkidle');
  await page.waitForLoadState('domcontentloaded');
  // Закрываем cookie баннер после загрузки
  await closeCookieBanner(page);
}

module.exports = {
  closeCookieBanner,
  waitForPageLoad,
};

