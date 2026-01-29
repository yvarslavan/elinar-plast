const { test, expect } = require('@playwright/test');

test.describe('Production Slider Layout', () => {
    test.beforeEach(async ({ page }) => {
        await page.goto('/');
    });

    test('Slider track should have flex-wrap: nowrap', async ({ page }) => {
        const sliderTrack = page.locator('.slider-track').first();
        await expect(sliderTrack).toBeVisible();

        const flexWrap = await sliderTrack.evaluate((el) => {
            return window.getComputedStyle(el).flexWrap;
        });
        expect(flexWrap).toBe('nowrap');
    });

    test('Slider slides should have correct sizing properties', async ({ page }) => {
        const slide = page.locator('.slider-slide').first();
        await expect(slide).toBeVisible();

        const styles = await slide.evaluate((el) => {
            const computed = window.getComputedStyle(el);
            return {
                minWidth: computed.minWidth,
                flexGrow: computed.flexGrow,
                flexShrink: computed.flexShrink,
                flexBasis: computed.flexBasis,
                maxWidth: computed.maxWidth
            };
        });

        // Check if flex shorthand expands to: grow shrink basis
        // flex: 0 0 100% -> grow: 0, shrink: 0, basis: 100%
        expect(styles.flexGrow).toBe('0');
        expect(styles.flexShrink).toBe('0');
        expect(styles.flexBasis).toBe('100%');
        expect(styles.maxWidth).toBe('100%');
    });

    test('Slider height should adapt to viewport size', async ({ page }) => {
        const slider = page.locator('.production-slider').first();
        await expect(slider).toBeVisible();

        // Desktop (1280x720 default)
        // Check if height matches one of the desktop rules (e.g., 400px or 420px)
        // Note: Playwright viewport size might affect this.
        await page.setViewportSize({ width: 1300, height: 800 });
        let height = await slider.evaluate((el) => window.getComputedStyle(el).height);
        // Expect 420px for 1200px+
        expect(height).toBe('420px');

        await page.setViewportSize({ width: 1450, height: 800 });
        height = await slider.evaluate((el) => window.getComputedStyle(el).height);
        // Expect 450px for 1400px+
        expect(height).toBe('450px');

        // Mobile
        await page.setViewportSize({ width: 375, height: 667 });
        height = await slider.evaluate((el) => window.getComputedStyle(el).height);
        // Expect 280px for < 768px
        expect(height).toBe('280px');
    });
});
