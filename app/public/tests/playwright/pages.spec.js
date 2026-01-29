const { test, expect } = require('@playwright/test');
const { waitForPageLoad } = require('./helpers');

test.describe('Страницы сайта', () => {
  test('Главная страница загружается и отображает контент', async ({ page }) => {
    await page.goto('/');
    await waitForPageLoad(page);

    await expect(page).toHaveTitle(/Элинар Пласт|Elinar Plast/i);

    // Проверяем наличие hero-секции
    const heroSection = page.locator('.hero, [class*="hero"]').first();
    await expect(heroSection).toBeVisible();

    // Проверяем наличие основного контента
    const mainContent = page.locator('main, .main-content, .container').first();
    await expect(mainContent).toBeVisible();
  });

  test('Страница "О компании" загружается', async ({ page }) => {
    await page.goto('/about');
    await waitForPageLoad(page);

    await expect(page).toHaveURL(/about/);

    // Проверяем наличие заголовка страницы
    const pageTitle = page.locator('h1, .page-title, [class*="title"]').first();
    await expect(pageTitle).toBeVisible();
  });

  test('Страница "Продукция" загружается', async ({ page }) => {
    await page.goto('/products');
    await waitForPageLoad(page);

    await expect(page).toHaveURL(/products/);

    // Проверяем наличие контента продукции
    const content = page.locator('main, .main-content, .container').first();
    await expect(content).toBeVisible();
  });

  test('Страница "Контакты" загружается и содержит контактную информацию', async ({ page }) => {
    await page.goto('/contacts');
    await waitForPageLoad(page);

    await expect(page).toHaveURL(/contacts/);

    // Проверяем наличие контактной информации
    const phoneLink = page.locator('a[href*="tel:"]').first();
    const emailLink = page.locator('a[href*="mailto:"]').first();

    await expect(phoneLink).toBeVisible();
    await expect(emailLink).toBeVisible();
  });

  test('Страница "Партнеры" загружается', async ({ page }) => {
    await page.goto('/partners');
    await waitForPageLoad(page);

    await expect(page).toHaveURL(/partners/);

    const content = page.locator('main, .main-content, .container').first();
    await expect(content).toBeVisible();
  });

  test('Страница "Разработка и производство" загружается через кастомный роутинг', async ({ page }) => {
    await page.goto('/development-production');
    await waitForPageLoad(page);

    // Страница должна загрузиться (даже если через кастомный роутинг)
    await expect(page).toHaveURL(/development-production/);

    const content = page.locator('main, .main-content, .container').first();
    await expect(content).toBeVisible();
  });

  test('Страница "Технологии" загружается через кастомный роутинг', async ({ page }) => {
    await page.goto('/technologies');
    await waitForPageLoad(page);

    await expect(page).toHaveURL(/technologies/);

    const content = page.locator('main, .main-content, .container').first();
    await expect(content).toBeVisible();
  });

  test('Все страницы имеют хедер и футер', async ({ page }) => {
    const pages = ['/', '/about', '/products', '/contacts', '/partners'];

    for (const pagePath of pages) {
      await page.goto(pagePath);
      await waitForPageLoad(page);

      const header = page.locator('.site-header, header').first();
      const footer = page.locator('.site-footer, footer').first();

      await expect(header).toBeVisible();
      await expect(footer).toBeVisible();
    }
  });
});

