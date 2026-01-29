/**
 * Диагностический скрипт для проверки слайдера профилей
 * Запустите в консоли браузера на странице /products/
 */

(function() {
    console.log('🔍 ДИАГНОСТИКА СЛАЙДЕРА ПРОФИЛЕЙ');
    console.log('================================\n');

    // Находим слайдер профилей
    const profilesSlider = document.querySelector('[data-slider="profiles"]')?.closest('.product-row__slider');
    
    if (!profilesSlider) {
        console.error('❌ Слайдер профилей не найден!');
        return;
    }

    console.log('✅ Слайдер найден');

    // Проверяем контейнеры
    const containers = {
        'product-row__slider': profilesSlider,
        'zigzag-slider': profilesSlider.querySelector('.zigzag-slider'),
        'slider-container': profilesSlider.querySelector('.slider-container'),
        'active-slide': profilesSlider.querySelector('.slide.active'),
        'slider-image': profilesSlider.querySelector('.slider-image')
    };

    console.log('\n📦 РАЗМЕРЫ КОНТЕЙНЕРОВ:');
    console.log('========================');
    
    Object.entries(containers).forEach(([name, element]) => {
        if (!element) {
            console.log(`❌ ${name}: не найден`);
            return;
        }

        const rect = element.getBoundingClientRect();
        const computed = window.getComputedStyle(element);
        
        console.log(`\n${name}:`);
        console.log(`  Размеры: ${Math.round(rect.width)}px × ${Math.round(rect.height)}px`);
        console.log(`  Position: ${computed.position}`);
        console.log(`  Overflow: ${computed.overflow}`);
        console.log(`  Display: ${computed.display}`);
        
        if (name === 'product-row__slider') {
            console.log(`  Min-height: ${computed.minHeight}`);
            console.log(`  Aspect-ratio: ${computed.aspectRatio}`);
        }
        
        if (name === 'slider-image') {
            const img = element;
            console.log(`  Natural: ${img.naturalWidth}px × ${img.naturalHeight}px`);
            console.log(`  Object-fit: ${computed.objectFit}`);
            console.log(`  Object-position: ${computed.objectPosition}`);
        }
    });

    // Проверяем загруженные CSS файлы
    console.log('\n📄 ЗАГРУЖЕННЫЕ CSS ФАЙЛЫ:');
    console.log('==========================');
    
    const cssFiles = Array.from(document.styleSheets)
        .filter(sheet => sheet.href && (
            sheet.href.includes('products-slider.css') ||
            sheet.href.includes('page-products.css')
        ))
        .map(sheet => {
            const url = new URL(sheet.href);
            const params = new URLSearchParams(url.search);
            return {
                file: url.pathname.split('/').pop(),
                version: params.get('ver') || 'no version',
                href: sheet.href
            };
        });

    if (cssFiles.length === 0) {
        console.error('❌ CSS файлы не найдены!');
    } else {
        cssFiles.forEach(file => {
            console.log(`✅ ${file.file} (ver: ${file.version})`);
        });
    }

    // Проверяем применённые стили к изображению
    console.log('\n🎨 ПРИМЕНЁННЫЕ СТИЛИ К ИЗОБРАЖЕНИЮ:');
    console.log('====================================');
    
    const img = containers['slider-image'];
    if (img) {
        const computed = window.getComputedStyle(img);
        const important Properties = [
            'width', 'height', 'object-fit', 'object-position',
            'display', 'position', 'top', 'left'
        ];
        
        importantProperties.forEach(prop => {
            console.log(`  ${prop}: ${computed[prop]}`);
        });
    }

    // Проверяем, есть ли inline-стили
    console.log('\n📝 INLINE-СТИЛИ:');
    console.log('=================');
    
    Object.entries(containers).forEach(([name, element]) => {
        if (element && element.style.cssText) {
            console.log(`${name}:`);
            console.log(`  ${element.style.cssText}`);
        }
    });

    // Проверяем CSS правила для .slider-image
    console.log('\n🔍 CSS ПРАВИЛА ДЛЯ .slider-image:');
    console.log('==================================');
    
    const img = containers['slider-image'];
    if (img) {
        const rules = [];
        
        Array.from(document.styleSheets).forEach(sheet => {
            try {
                Array.from(sheet.cssRules || []).forEach(rule => {
                    if (rule.selectorText && rule.selectorText.includes('slider-image')) {
                        rules.push({
                            selector: rule.selectorText,
                            objectFit: rule.style.objectFit || 'not set',
                            objectPosition: rule.style.objectPosition || 'not set',
                            sheet: sheet.href ? sheet.href.split('/').pop() : 'inline'
                        });
                    }
                });
            } catch (e) {
                // CORS error - skip
            }
        });
        
        if (rules.length === 0) {
            console.log('❌ Правила не найдены');
        } else {
            rules.forEach(rule => {
                console.log(`\n${rule.selector} (${rule.sheet}):`);
                console.log(`  object-fit: ${rule.objectFit}`);
                console.log(`  object-position: ${rule.objectPosition}`);
            });
        }
    }

    console.log('\n✅ Диагностика завершена');
    console.log('========================\n');
    
    // Рекомендации
    console.log('💡 РЕКОМЕНДАЦИИ:');
    console.log('================');
    console.log('1. Проверьте, что object-fit: contain применяется');
    console.log('2. Убедитесь, что контейнеры имеют правильную высоту');
    console.log('3. Проверьте, что CSS файлы загружены с правильной версией');
    console.log('4. Откройте DevTools → Elements → выберите изображение → вкладка Computed');
    console.log('5. Проверьте, нет ли конфликтующих стилей');
})();
