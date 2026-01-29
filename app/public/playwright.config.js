// @ts-check
const { defineConfig, devices } = require('@playwright/test');

/**
 * Конфигурация Playwright для тестирования сайта Elinar Plast
 * @see https://playwright.dev/docs/test-configuration
 */
module.exports = defineConfig({
  testDir: './tests/playwright',
  /* Максимальное время выполнения одного теста */
  timeout: 30 * 1000,
  expect: {
    /* Максимальное время ожидания для expect */
    timeout: 5000
  },
  /* Запуск тестов в параллель */
  fullyParallel: true,
  /* Не запускать тесты в CI */
  forbidOnly: !!process.env.CI,
  /* Повторные попытки при падении тестов */
  retries: process.env.CI ? 2 : 0,
  /* Количество воркеров */
  workers: process.env.CI ? 1 : undefined,
  /* Репортер */
  reporter: [
    ['html'],
    ['list'],
    ['json', { outputFile: 'test-results/results.json' }]
  ],
  /* Общие настройки для всех проектов */
  use: {
    /* Базовый URL */
    baseURL: 'http://localhost:10004',
    /* Максимальное время для действий (click, fill и т.д.) */
    actionTimeout: 10 * 1000,
    /* Скриншоты при падении тестов */
    screenshot: 'only-on-failure',
    /* Видео при падении тестов */
    video: 'retain-on-failure',
    /* Трейс при падении тестов */
    trace: 'on-first-retry',
    /* Отключаем прокси по умолчанию для локальной разработки */
    ignoreHTTPSErrors: true,
    /* Явно отключаем прокси для локального тестирования */
    proxy: undefined,
  },

  /* Настройки проектов для разных браузеров */
  projects: [
    {
      name: 'chromium',
      use: { ...devices['Desktop Chrome'] },
    },
    {
      name: 'firefox',
      use: { ...devices['Desktop Firefox'] },
    },
    {
      name: 'webkit',
      use: {
        ...devices['Desktop Safari'],
        // Отключаем прокси для WebKit
        ignoreHTTPSErrors: true,
        proxy: undefined,
      },
    },
    /* Мобильные устройства */
    {
      name: 'Mobile Chrome',
      use: {
        ...devices['Pixel 5'],
        // Отключаем прокси для мобильных
        ignoreHTTPSErrors: true,
        proxy: undefined,
      },
    },
    {
      name: 'Mobile Safari',
      use: {
        ...devices['iPhone 12'],
        // Отключаем прокси для Mobile Safari
        ignoreHTTPSErrors: true,
        proxy: undefined,
      },
    },
  ],

  /* Веб-сервер для запуска перед тестами (опционально) */
  // webServer: {
  //   command: 'npm run start',
  //   url: 'http://localhost:10004',
  //   reuseExistingServer: !process.env.CI,
  // },
});

