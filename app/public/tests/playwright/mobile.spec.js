const { test, expect } = require('@playwright/test');
const { waitForPageLoad, closeCookieBanner } = require('./helpers');

test.describe('Мобильная версия', () => {
  test.use({
    viewport: { width: 375, height: 667 }, // iPhone размер
  });

  test('Мобильное меню работает корректно', async ({ page }) => {
    await page.goto('/');
    await waitForPageLoad(page);

    const menuToggle = page.locator('.menu-toggle');
    const mainNav = page.locator('.main-nav');

    await expect(menuToggle).toBeVisible();

    // Открываем меню
    await menuToggle.click();
    await expect(mainNav).toHaveClass(/active/);

    // Проверяем, что меню видно
    await expect(mainNav).toBeVisible();

    // Закрываем меню
    await menuToggle.click();
    await expect(mainNav).not.toHaveClass(/active/);
  });

  test('Подменю открывается на мобильных устройствах', async ({ page }) => {
    await page.goto('/');
    await waitForPageLoad(page);

    const menuToggle = page.locator('.menu-toggle');
    await menuToggle.click();

    // Ищем пункт меню с подменю
    const menuItemWithChildren = page.locator('.menu-item-has-children > a').first();

    if (await menuItemWithChildren.count() > 0) {
      await menuItemWithChildren.click();

      // Подменю должно открыться
      const subMenu = menuItemWithChildren.locator('~ .sub-menu, + .sub-menu').first();
      if (await subMenu.count() > 0) {
        await expect(subMenu).toBeVisible();
      }
    }
  });

  test('Сайт адаптивен на мобильных устройствах', async ({ page }) => {
    await page.goto('/');
    await waitForPageLoad(page);

    // Проверяем, что контент не выходит за границы экрана
    const body = page.locator('body');
    const bodyWidth = await body.evaluate(el => el.offsetWidth);

    expect(bodyWidth).toBeLessThanOrEqual(375);

    // Проверяем наличие мобильных элементов
    const mobileMenuToggle = page.locator('.menu-toggle');
    await expect(mobileMenuToggle).toBeVisible();
  });

  test('FAB виден на мобильных устройствах', async ({ page }) => {
    await page.goto('/');
    await waitForPageLoad(page);

    // Прокручиваем страницу
    await page.evaluate(() => window.scrollTo(0, 500));
    await page.waitForTimeout(500);

    const fabTrigger = page.locator('#fab-trigger, .fab-trigger');

    if (await fabTrigger.count() > 0) {
      await expect(fabTrigger).toBeVisible();
    }
  });

  test('Кнопка "Вернуться наверх" работает на мобильных', async ({ page }) => {
    await page.goto('/');
    await waitForPageLoad(page);

    // Прокручиваем вниз достаточно далеко
    await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight / 2));
    await page.waitForTimeout(1000); // Даем время для появления кнопки

    const scrollTopBtn = page.locator('#scroll-top');

    if (await scrollTopBtn.count() > 0) {
      // Ждем, пока кнопка станет видимой (через класс visible)
      await page.waitForFunction(() => {
        const btn = document.getElementById('scroll-top');
        return btn && btn.classList.contains('visible');
      }, { timeout: 5000 });

      await expect(scrollTopBtn).toBeVisible();

      // Убеждаемся, что cookie баннер не мешает
      await closeCookieBanner(page);

      // Получаем начальную позицию скролла
      const initialScroll = await page.evaluate(() => window.scrollY);
      expect(initialScroll).toBeGreaterThan(200); // Должны быть прокручены достаточно

      // Кликаем на кнопку
      await scrollTopBtn.click({ force: true });

      // Ждем завершения плавной прокрутки (smooth scroll)
      // Проверяем, что скролл действительно начал уменьшаться
      await page.waitForFunction(
        () => window.scrollY < initialScroll * 0.5,
        { timeout: 2000 }
      ).catch(() => {}); // Игнорируем ошибку, если уже прокрутилось

      // Ждем завершения прокрутки до верха
      await page.waitForFunction(
        () => window.scrollY < 100,
        { timeout: 3000 }
      );

      // Проверяем финальную позицию
      const scrollPosition = await page.evaluate(() => window.scrollY);
      expect(scrollPosition).toBeLessThan(100);
    }
  });
});

