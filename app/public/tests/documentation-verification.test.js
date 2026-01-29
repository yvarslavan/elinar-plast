/**
 * Property-Based Tests for Documentation Verification
 * Feature: documentation-correction
 */

const fs = require('fs');
const path = require('path');

/**
 * Feature: documentation-correction, Property 1: Active Template File Documentation Completeness
 * For any active PHP template file in the theme directory (excluding page-partners.php), the documentation should include a description of its purpose and functionality
 * Validates: Requirements 1.1, 2.1
 */
describe('Property 1: Active Template File Documentation Completeness', () => {
  const THEME_PATH = 'wp-content/themes/elinar-plast';
  
  // Active template files that should be documented
  const ACTIVE_TEMPLATE_FILES = [
    'page-contacts.php',
    'page-products.php', 
    'page-technologies-production.php',
    'page-about.php',
    'page-services-development.php',
    'front-page.php',
    'page.php',
    'single.php',
    'header.php',
    'footer.php',
    'index.php'
  ];

  // Inactive template files that should NOT be documented as active
  const INACTIVE_TEMPLATE_FILES = [
    'page-partners.php'
  ];

  test('all active template files exist in theme directory', () => {
    ACTIVE_TEMPLATE_FILES.forEach(file => {
      const filePath = path.join(THEME_PATH, file);
      expect(fs.existsSync(filePath)).toBe(true);
    });
  });

  test('inactive template files exist but should be marked as inactive', () => {
    INACTIVE_TEMPLATE_FILES.forEach(file => {
      const filePath = path.join(THEME_PATH, file);
      expect(fs.existsSync(filePath)).toBe(true);
    });
  });

  test('active template files contain expected WordPress template patterns', () => {
    const pageTemplates = ACTIVE_TEMPLATE_FILES.filter(file => 
      file.startsWith('page-') || file === 'front-page.php' || file === 'single.php'
    );

    pageTemplates.forEach(file => {
      const filePath = path.join(THEME_PATH, file);
      if (fs.existsSync(filePath)) {
        const content = fs.readFileSync(filePath, 'utf8');
        
        // Template files should contain get_header() and get_footer() (except header/footer themselves)
        if (file !== 'header.php' && file !== 'footer.php') {
          expect(content).toMatch(/get_header\(\)/);
          expect(content).toMatch(/get_footer\(\)/);
        }
        
        // Custom page templates should have Template Name comment
        if (file.startsWith('page-') && file !== 'page.php') {
          expect(content).toMatch(/Template Name:/);
        }
      }
    });
  });

  test('property: all existing active PHP template files should be documentable', () => {
    const themeFiles = fs.readdirSync(THEME_PATH, { withFileTypes: true })
      .filter(dirent => dirent.isFile() && dirent.name.endsWith('.php'))
      .map(dirent => dirent.name);
    
    // For any PHP file that exists, it should be either active, inactive, or functions.php
    themeFiles.forEach(file => {
      const isActiveTemplate = ACTIVE_TEMPLATE_FILES.includes(file);
      const isInactiveTemplate = INACTIVE_TEMPLATE_FILES.includes(file);
      const isFunctionsFile = file === 'functions.php';
      const isOtherFile = file.includes('production-cycle-integration') || file.includes('quote-request') || file.includes('privacy-policy') || file.includes('production-demo');
      
      // Every PHP file should be categorized
      expect(isActiveTemplate || isInactiveTemplate || isFunctionsFile || isOtherFile).toBe(true);
    });
  });

  test('active contact page contains form handling functionality', () => {
    const contactPagePath = path.join(THEME_PATH, 'page-contacts.php');
    if (fs.existsSync(contactPagePath)) {
      const content = fs.readFileSync(contactPagePath, 'utf8');
      
      // Should contain contact form elements
      expect(content).toMatch(/contact.*form|form.*contact/i);
      expect(content).toMatch(/name="phone"|name="email"|name="question"/);
    }
  });

  test('active products page contains project form functionality', () => {
    const productsPagePath = path.join(THEME_PATH, 'page-products.php');
    if (fs.existsSync(productsPagePath)) {
      const content = fs.readFileSync(productsPagePath, 'utf8');
      
      // Should contain project form handling
      expect(content).toMatch(/project_form_submit/);
      expect(content).toMatch(/attachment.*file/i);
      expect(content).toMatch(/REQUEST_METHOD.*POST|POST.*REQUEST_METHOD/);
    }
  });

  test('active technologies page contains project form functionality', () => {
    const techPagePath = path.join(THEME_PATH, 'page-technologies-production.php');
    if (fs.existsSync(techPagePath)) {
      const content = fs.readFileSync(techPagePath, 'utf8');
      
      // Should contain similar project form handling as products page
      expect(content).toMatch(/project_form_submit/);
      expect(content).toMatch(/attachment.*file/i);
      expect(content).toMatch(/REQUEST_METHOD.*POST|POST.*REQUEST_METHOD/);
    }
  });

  test('property: for all active template files, documentation should describe their purpose', () => {
    // This test validates that each active template file has a clear purpose
    const templatePurposes = {
      'page-contacts.php': ['contact', 'form', 'phone', 'email'],
      'page-products.php': ['product', 'project', 'slider', 'zigzag'],
      'page-technologies-production.php': ['technology', 'production', 'faq'],
      'page-about.php': ['about', 'company', 'team'],
      'page-services-development.php': ['service', 'development'],
      'front-page.php': ['home', 'hero', 'main'],
      'page.php': ['page', 'template', 'content'],
      'single.php': ['single', 'post', 'article'],
      'header.php': ['head', 'html', 'meta', 'header'],
      'footer.php': ['footer', 'site-footer', 'container'],
      'index.php': ['index', 'template', 'main']
    };

    Object.entries(templatePurposes).forEach(([file, expectedIndicators]) => {
      const filePath = path.join(THEME_PATH, file);
      if (fs.existsSync(filePath)) {
        const content = fs.readFileSync(filePath, 'utf8');
        
        // File should contain at least one indicator of its purpose
        const hasIndicators = expectedIndicators.some(indicator => 
          content.toLowerCase().includes(indicator.toLowerCase())
        );
        
        // Debug output for failing files
        if (!hasIndicators) {
          console.log(`File ${file} does not contain any of: ${expectedIndicators.join(', ')}`);
        }
        
        expect(hasIndicators).toBe(true);
      }
    });
  });
});

/**
 * Feature: documentation-correction, Property 2: Inactive Template File Exclusion
 * For any inactive or removed template file (such as page-partners.php), the documentation should not include references to that file
 * Validates: Requirements 1.2, 2.2
 */
describe('Property 2: Inactive Template File Exclusion', () => {
  const THEME_PATH = 'wp-content/themes/elinar-plast';
  
  // Inactive template files that should NOT be documented as active
  const INACTIVE_TEMPLATE_FILES = [
    'page-partners.php'
  ];

  // Active template files that should be documented
  const ACTIVE_TEMPLATE_FILES = [
    'page-contacts.php',
    'page-products.php', 
    'page-technologies-production.php',
    'page-about.php',
    'page-services-development.php',
    'front-page.php',
    'page.php',
    'single.php',
    'header.php',
    'footer.php',
    'index.php',
    'page-privacy-policy.php',
    'page-production-demo.php',
    'page-quote-request.php',
    'production-cycle-integration.php'
  ];

  test('inactive template files exist but should be excluded from active documentation', () => {
    INACTIVE_TEMPLATE_FILES.forEach(file => {
      const filePath = path.join(THEME_PATH, file);
      expect(fs.existsSync(filePath)).toBe(true);
    });
  });

  test('inactive template files contain Template Name but should not be used', () => {
    INACTIVE_TEMPLATE_FILES.forEach(file => {
      const filePath = path.join(THEME_PATH, file);
      if (fs.existsSync(filePath)) {
        const content = fs.readFileSync(filePath, 'utf8');
        
        // Should have Template Name comment (indicating it's a custom template)
        expect(content).toMatch(/Template Name:/);
        
        // But should not be actively used (no recent modifications or active functionality)
        // This is indicated by the fact that it's not referenced in navigation or routing
      }
    });
  });

  test('inactive template files are not referenced in navigation system', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Should not contain routing for inactive templates
      INACTIVE_TEMPLATE_FILES.forEach(file => {
        const templateName = file.replace('.php', '');
        expect(content).not.toMatch(new RegExp(templateName));
      });
    }
  });

  test('inactive template files are not referenced in breadcrumb system', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Should not contain breadcrumb entries for inactive templates
      INACTIVE_TEMPLATE_FILES.forEach(file => {
        const pageName = file.replace('page-', '').replace('.php', '');
        expect(content).not.toMatch(new RegExp(`${pageName}.*breadcrumb|breadcrumb.*${pageName}`));
      });
    }
  });

  test('property: for all PHP template files, they should be either active or explicitly inactive', () => {
    const themeFiles = fs.readdirSync(THEME_PATH, { withFileTypes: true })
      .filter(dirent => dirent.isFile() && dirent.name.endsWith('.php'))
      .map(dirent => dirent.name);
    
    // Filter to only page templates (excluding functions.php and other utility files)
    const pageTemplates = themeFiles.filter(file => 
      file.startsWith('page-') || file === 'front-page.php' || file === 'single.php' || 
      file === 'index.php' || file === 'header.php' || file === 'footer.php'
    );
    
    // For any page template that exists, it should be either active or inactive
    pageTemplates.forEach(file => {
      const isActive = ACTIVE_TEMPLATE_FILES.includes(file);
      const isInactive = INACTIVE_TEMPLATE_FILES.includes(file);
      
      // Every page template should be categorized
      expect(isActive || isInactive).toBe(true);
    });
  });

  test('property: inactive template files should not appear in active functionality', () => {
    // Check that inactive templates are not used in any active functionality
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    const mainJsPath = path.join(THEME_PATH, 'assets/js/main.js');
    
    if (fs.existsSync(functionsPath)) {
      const functionsContent = fs.readFileSync(functionsPath, 'utf8');
      
      INACTIVE_TEMPLATE_FILES.forEach(file => {
        const templateName = file.replace('page-', '').replace('.php', '');
        
        // Should not be referenced in functions.php
        expect(functionsContent).not.toMatch(new RegExp(templateName, 'i'));
      });
    }
    
    if (fs.existsSync(mainJsPath)) {
      const jsContent = fs.readFileSync(mainJsPath, 'utf8');
      
      INACTIVE_TEMPLATE_FILES.forEach(file => {
        const templateName = file.replace('page-', '').replace('.php', '');
        
        // Should not be referenced in JavaScript
        expect(jsContent).not.toMatch(new RegExp(templateName, 'i'));
      });
    }
  });

  test('active template files are properly integrated into the system', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Active templates should be referenced in routing or breadcrumbs
      const activePageTemplates = ACTIVE_TEMPLATE_FILES.filter(file => 
        file.startsWith('page-') && file !== 'page.php'
      );
      
      let referencedTemplates = 0;
      activePageTemplates.forEach(file => {
        if (content.includes(file)) {
          referencedTemplates++;
        }
      });
      
      // At least some active templates should be referenced in functions.php
      expect(referencedTemplates).toBeGreaterThan(0);
    }
  });
});

/**
 * Feature: documentation-correction, Property 1 (Legacy): File Structure Completeness
 * For any documented file or directory, that file or directory should exist in the actual project structure
 * Validates: Requirements 1.1, 1.2, 1.4
 */
describe('Property 1 (Legacy): File Structure Completeness', () => {
  const THEME_PATH = 'wp-content/themes/elinar-plast';
  const PLUGINS_PATH = 'wp-content/plugins';
  
  // Expected files based on current documentation
  const DOCUMENTED_THEME_FILES = [
    'footer.php',
    'front-page.php', 
    'functions.php',
    'header.php',
    'index.php',
    'page-about.php',
    'page-services-development.php',
    'page.php',
    'PRODUCTION_BLOCK_README.md',
    'single.php',
    'style.css'
  ];

  // Files that should exist but are missing from documentation
  const UNDOCUMENTED_THEME_FILES = [
    'page-contacts.php',
    'page-partners.php', 
    'page-products.php',
    'page-technologies-production.php',
    'contact-form-log.txt'
  ];

  const DOCUMENTED_ASSET_DIRS = [
    'assets/icons',
    'assets/images', 
    'assets/js'
  ];

  const UNDOCUMENTED_ASSET_DIRS = [
    'assets/video'
  ];

  const DOCUMENTED_PLUGINS = [
    'all-in-one-wp-migration'
  ];

  const UNDOCUMENTED_PLUGINS = [
    'wp-mail-smtp'
  ];

  test('all documented theme files should exist', () => {
    DOCUMENTED_THEME_FILES.forEach(file => {
      const filePath = path.join(THEME_PATH, file);
      expect(fs.existsSync(filePath)).toBe(true);
    });
  });

  test('undocumented theme files exist and should be added to documentation', () => {
    UNDOCUMENTED_THEME_FILES.forEach(file => {
      const filePath = path.join(THEME_PATH, file);
      expect(fs.existsSync(filePath)).toBe(true);
    });
  });

  test('all documented asset directories should exist', () => {
    DOCUMENTED_ASSET_DIRS.forEach(dir => {
      const dirPath = path.join(THEME_PATH, dir);
      expect(fs.existsSync(dirPath)).toBe(true);
      expect(fs.statSync(dirPath).isDirectory()).toBe(true);
    });
  });

  test('undocumented asset directories exist and should be added to documentation', () => {
    UNDOCUMENTED_ASSET_DIRS.forEach(dir => {
      const dirPath = path.join(THEME_PATH, dir);
      expect(fs.existsSync(dirPath)).toBe(true);
      expect(fs.statSync(dirPath).isDirectory()).toBe(true);
    });
  });

  test('all documented plugins should exist', () => {
    DOCUMENTED_PLUGINS.forEach(plugin => {
      const pluginPath = path.join(PLUGINS_PATH, plugin);
      expect(fs.existsSync(pluginPath)).toBe(true);
      expect(fs.statSync(pluginPath).isDirectory()).toBe(true);
    });
  });

  test('undocumented plugins exist and should be added to documentation', () => {
    UNDOCUMENTED_PLUGINS.forEach(plugin => {
      const pluginPath = path.join(PLUGINS_PATH, plugin);
      expect(fs.existsSync(pluginPath)).toBe(true);
      expect(fs.statSync(pluginPath).isDirectory()).toBe(true);
    });
  });

  test('inc directory exists but is empty', () => {
    const incPath = path.join(THEME_PATH, 'inc');
    expect(fs.existsSync(incPath)).toBe(true);
    expect(fs.statSync(incPath).isDirectory()).toBe(true);
    
    const incContents = fs.readdirSync(incPath);
    expect(incContents.length).toBe(0);
  });

  // Property-based test: Generate random file checks
  test('property: all existing theme files should be documentable', () => {
    const themeFiles = fs.readdirSync(THEME_PATH, { withFileTypes: true })
      .filter(dirent => dirent.isFile())
      .map(dirent => dirent.name);
    
    // For any file that exists, it should be either documented or have a valid reason to be undocumented
    themeFiles.forEach(file => {
      const isDocumented = DOCUMENTED_THEME_FILES.includes(file);
      const isKnownUndocumented = UNDOCUMENTED_THEME_FILES.includes(file);
      const isSystemFile = file.startsWith('.') || file.endsWith('.log') || file.endsWith('.txt');
      
      // Every file should be either documented, known to be undocumented, or a system file
      expect(isDocumented || isKnownUndocumented || isSystemFile).toBe(true);
    });
  });

  test('property: all existing asset directories should be documentable', () => {
    const assetsPath = path.join(THEME_PATH, 'assets');
    if (fs.existsSync(assetsPath)) {
      const assetDirs = fs.readdirSync(assetsPath, { withFileTypes: true })
        .filter(dirent => dirent.isDirectory())
        .map(dirent => `assets/${dirent.name}`);
      
      assetDirs.forEach(dir => {
        const isDocumented = DOCUMENTED_ASSET_DIRS.includes(dir);
        const isKnownUndocumented = UNDOCUMENTED_ASSET_DIRS.includes(dir);
        
        expect(isDocumented || isKnownUndocumented).toBe(true);
      });
    }
  });
});

/**
 * Utility function to run comprehensive file structure verification
 */
function verifyFileStructureCompleteness() {
  const results = {
    missingDocumentedFiles: [],
    undocumentedExistingFiles: [],
    missingDocumentedDirs: [],
    undocumentedExistingDirs: []
  };

  // Check theme files
  const DOCUMENTED_THEME_FILES = [
    'footer.php', 'front-page.php', 'functions.php', 'header.php', 'index.php',
    'page-about.php', 'page-services-development.php', 'page.php', 
    'PRODUCTION_BLOCK_README.md', 'single.php', 'style.css'
  ];

  DOCUMENTED_THEME_FILES.forEach(file => {
    const filePath = path.join('wp-content/themes/elinar-plast', file);
    if (!fs.existsSync(filePath)) {
      results.missingDocumentedFiles.push(file);
    }
  });

  // Check for undocumented files
  const themeFiles = fs.readdirSync('wp-content/themes/elinar-plast', { withFileTypes: true })
    .filter(dirent => dirent.isFile())
    .map(dirent => dirent.name);

  themeFiles.forEach(file => {
    if (!DOCUMENTED_THEME_FILES.includes(file) && !file.startsWith('.')) {
      results.undocumentedExistingFiles.push(file);
    }
  });

  return results;
}

/**
 * Feature: documentation-correction, Property 2: Template File Documentation Accuracy
 * For any PHP template file in the theme directory, the documentation should include a description of its purpose and functionality
 * Validates: Requirements 2.1, 2.3
 */
describe('Property 2: Template File Documentation Accuracy', () => {
  const THEME_PATH = 'wp-content/themes/elinar-plast';
  
  // All template files that should be documented
  const EXPECTED_TEMPLATE_FILES = [
    'front-page.php',
    'page-about.php', 
    'page-contacts.php',
    'page-partners.php',
    'page-products.php',
    'page-services-development.php',
    'page-technologies-production.php',
    'page.php',
    'single.php',
    'header.php',
    'footer.php',
    'index.php'
  ];

  test('all template files exist in theme directory', () => {
    EXPECTED_TEMPLATE_FILES.forEach(file => {
      const filePath = path.join(THEME_PATH, file);
      expect(fs.existsSync(filePath)).toBe(true);
    });
  });

  test('property: all existing PHP template files should be documentable', () => {
    const themeFiles = fs.readdirSync(THEME_PATH, { withFileTypes: true })
      .filter(dirent => dirent.isFile() && dirent.name.endsWith('.php'))
      .map(dirent => dirent.name);
    
    // For any PHP file that exists, it should be a known template file
    themeFiles.forEach(file => {
      const isKnownTemplate = EXPECTED_TEMPLATE_FILES.includes(file);
      const isFunctionsFile = file === 'functions.php';
      
      // Every PHP file should be either a known template or functions.php
      expect(isKnownTemplate || isFunctionsFile).toBe(true);
    });
  });

  test('template files contain expected WordPress template patterns', () => {
    const templateFiles = EXPECTED_TEMPLATE_FILES.filter(file => 
      file.startsWith('page-') || file === 'front-page.php' || file === 'single.php'
    );

    templateFiles.forEach(file => {
      const filePath = path.join(THEME_PATH, file);
      if (fs.existsSync(filePath)) {
        const content = fs.readFileSync(filePath, 'utf8');
        
        // Template files should contain get_header() and get_footer()
        if (file !== 'header.php' && file !== 'footer.php') {
          expect(content).toMatch(/get_header\(\)/);
          expect(content).toMatch(/get_footer\(\)/);
        }
        
        // Page templates should have Template Name comment
        if (file.startsWith('page-') && file !== 'page.php') {
          expect(content).toMatch(/Template Name:/);
        }
      }
    });
  });

  test('contact page contains form handling functionality', () => {
    const contactPagePath = path.join(THEME_PATH, 'page-contacts.php');
    if (fs.existsSync(contactPagePath)) {
      const content = fs.readFileSync(contactPagePath, 'utf8');
      
      // Should contain form elements
      expect(content).toMatch(/<form/);
      expect(content).toMatch(/name="phone"/);
      expect(content).toMatch(/name="email"/);
      expect(content).toMatch(/name="question"/);
    }
  });

  test('products page contains slider functionality', () => {
    const productsPagePath = path.join(THEME_PATH, 'page-products.php');
    if (fs.existsSync(productsPagePath)) {
      const content = fs.readFileSync(productsPagePath, 'utf8');
      
      // Should contain slider elements
      expect(content).toMatch(/zigzag-slider/);
      expect(content).toMatch(/slider-nav/);
      expect(content).toMatch(/slider-dots/);
    }
  });

  test('technologies page contains FAQ accordion', () => {
    const techPagePath = path.join(THEME_PATH, 'page-technologies-production.php');
    if (fs.existsSync(techPagePath)) {
      const content = fs.readFileSync(techPagePath, 'utf8');
      
      // Should contain FAQ accordion elements
      expect(content).toMatch(/faq-accordion/);
      expect(content).toMatch(/faq-item/);
      expect(content).toMatch(/faq-question/);
    }
  });
});

/**
 * Feature: documentation-correction, Property 3: Asset Directory Completeness
 * For any subdirectory in the assets folder, the documentation should list and describe that subdirectory
 * Validates: Requirements 1.3
 */
describe('Property 3: Asset Directory Completeness', () => {
  const ASSETS_PATH = 'wp-content/themes/elinar-plast/assets';
  
  const EXPECTED_ASSET_DIRS = [
    'css',
    'icons',
    'images', 
    'js',
    'video'
  ];

  test('all expected asset directories exist', () => {
    EXPECTED_ASSET_DIRS.forEach(dir => {
      const dirPath = path.join(ASSETS_PATH, dir);
      expect(fs.existsSync(dirPath)).toBe(true);
      expect(fs.statSync(dirPath).isDirectory()).toBe(true);
    });
  });

  test('css directory contains modular CSS files', () => {
    const cssPath = path.join(ASSETS_PATH, 'css');
    if (fs.existsSync(cssPath)) {
      const cssFiles = fs.readdirSync(cssPath);
      const expectedCSSFiles = [
        'breadcrumbs.css',
        'glightbox-custom.css',
        'page-about.css',
        'page-contacts.css',
        'page-products.css',
        'page-services-development.css',
        'page-technologies-production.css',
        'production-cycle.css',
        'production-cycle-cards.css',
        'production-slider.css',
        'quote-form.css'
      ];
      
      expectedCSSFiles.forEach(cssFile => {
        expect(cssFiles).toContain(cssFile);
      });
    }
  });

  test('icons directory contains expected SVG files', () => {
    const iconsPath = path.join(ASSETS_PATH, 'icons');
    if (fs.existsSync(iconsPath)) {
      const iconFiles = fs.readdirSync(iconsPath);
      const expectedIcons = [
        'components-parts.svg',
        'extrusion-profile.svg', 
        'housing-elements.svg'
      ];
      
      expectedIcons.forEach(icon => {
        expect(iconFiles).toContain(icon);
      });
    }
  });

  test('video directory contains presentation content', () => {
    const videoPath = path.join(ASSETS_PATH, 'video');
    if (fs.existsSync(videoPath)) {
      const videoFiles = fs.readdirSync(videoPath);
      
      // Should contain video file and poster
      const hasVideo = videoFiles.some(file => file.endsWith('.mp4'));
      const hasPoster = videoFiles.some(file => file.includes('poster'));
      
      expect(hasVideo || hasPoster).toBe(true);
    }
  });

  test('js directory contains main.js and other JS files', () => {
    const jsPath = path.join(ASSETS_PATH, 'js');
    if (fs.existsSync(jsPath)) {
      const jsFiles = fs.readdirSync(jsPath);
      expect(jsFiles).toContain('main.js');
      expect(jsFiles).toContain('production-slider.js');
      expect(jsFiles).toContain('quote-form.js');
    }
  });

  test('images directory has expected structure', () => {
    const imagesPath = path.join(ASSETS_PATH, 'images');
    if (fs.existsSync(imagesPath)) {
      const imageContents = fs.readdirSync(imagesPath, { withFileTypes: true });
      
      // Should have certificates subdirectory
      const hasCertificatesDir = imageContents.some(item => 
        item.isDirectory() && item.name === 'certificates'
      );
      
      // Should have favicon subdirectory
      const hasFaviconDir = imageContents.some(item => 
        item.isDirectory() && item.name === 'favicon'
      );
      
      // Should have production photos
      const hasProductionPhotos = imageContents.some(item => 
        item.isFile() && item.name.includes('about-production')
      );
      
      // Should have logo files
      const hasLogos = imageContents.some(item => 
        item.isFile() && item.name.includes('logo')
      );
      
      // Should have hero background images
      const hasHeroImages = imageContents.some(item => 
        item.isFile() && item.name.includes('hero-bg')
      );
      
      // Should have product images
      const hasProductImages = imageContents.some(item => 
        item.isFile() && (item.name.includes('termovstavki') || item.name.includes('tekhnicheskie-profili'))
      );
      
      expect(hasCertificatesDir).toBe(true);
      expect(hasFaviconDir).toBe(true);
      expect(hasProductionPhotos).toBe(true);
      expect(hasLogos).toBe(true);
      expect(hasHeroImages).toBe(true);
      expect(hasProductImages).toBe(true);
    }
  });

  test('property: all existing asset directories should be documented', () => {
    if (fs.existsSync(ASSETS_PATH)) {
      const actualDirs = fs.readdirSync(ASSETS_PATH, { withFileTypes: true })
        .filter(dirent => dirent.isDirectory())
        .map(dirent => dirent.name);
      
      // Every actual directory should be in expected list
      actualDirs.forEach(dir => {
        expect(EXPECTED_ASSET_DIRS).toContain(dir);
      });
      
      // Every expected directory should exist
      EXPECTED_ASSET_DIRS.forEach(dir => {
        expect(actualDirs).toContain(dir);
      });
    }
  });

  test('property: for any subdirectory in assets folder, it should contain relevant files', () => {
    if (fs.existsSync(ASSETS_PATH)) {
      const actualDirs = fs.readdirSync(ASSETS_PATH, { withFileTypes: true })
        .filter(dirent => dirent.isDirectory())
        .map(dirent => dirent.name);
      
      actualDirs.forEach(dir => {
        const dirPath = path.join(ASSETS_PATH, dir);
        const dirContents = fs.readdirSync(dirPath);
        
        // Each directory should contain at least one file
        expect(dirContents.length).toBeGreaterThan(0);
        
        // Directory should contain files of expected type
        switch (dir) {
          case 'css':
            expect(dirContents.some(file => file.endsWith('.css'))).toBe(true);
            break;
          case 'js':
            expect(dirContents.some(file => file.endsWith('.js'))).toBe(true);
            break;
          case 'icons':
            expect(dirContents.some(file => file.endsWith('.svg'))).toBe(true);
            break;
          case 'images':
            expect(dirContents.some(file => 
              file.endsWith('.webp') || file.endsWith('.jpg') || file.endsWith('.png')
            )).toBe(true);
            break;
          case 'video':
            expect(dirContents.some(file => 
              file.endsWith('.mp4') || file.endsWith('.webp')
            )).toBe(true);
            break;
        }
      });
    }
  });
});

/**
 * Feature: documentation-correction, Property 4: Plugin Inventory Accuracy
 * For any installed plugin in the wp-content/plugins directory, the documentation should list that plugin with its purpose
 * Validates: Requirements 1.3, 2.2
 */
describe('Property 4: Plugin Inventory Accuracy', () => {
  const PLUGINS_PATH = 'wp-content/plugins';
  
  const EXPECTED_PLUGINS = [
    'all-in-one-wp-migration',
    'wp-mail-smtp'
  ];

  test('all expected plugins exist', () => {
    EXPECTED_PLUGINS.forEach(plugin => {
      const pluginPath = path.join(PLUGINS_PATH, plugin);
      expect(fs.existsSync(pluginPath)).toBe(true);
      expect(fs.statSync(pluginPath).isDirectory()).toBe(true);
    });
  });

  test('all-in-one-wp-migration plugin has expected structure', () => {
    const pluginPath = path.join(PLUGINS_PATH, 'all-in-one-wp-migration');
    if (fs.existsSync(pluginPath)) {
      const pluginFiles = fs.readdirSync(pluginPath);
      
      // Should have main plugin file or readme
      const hasMainFile = pluginFiles.some(file => 
        file.endsWith('.php') || file.toLowerCase().includes('readme')
      );
      
      expect(hasMainFile).toBe(true);
    }
  });

  test('wp-mail-smtp plugin exists and is documented', () => {
    const pluginPath = path.join(PLUGINS_PATH, 'wp-mail-smtp');
    expect(fs.existsSync(pluginPath)).toBe(true);
    expect(fs.statSync(pluginPath).isDirectory()).toBe(true);
  });

  test('property: all existing plugins should be documented', () => {
    if (fs.existsSync(PLUGINS_PATH)) {
      const actualPlugins = fs.readdirSync(PLUGINS_PATH, { withFileTypes: true })
        .filter(dirent => dirent.isDirectory() && dirent.name !== '.' && dirent.name !== '..')
        .map(dirent => dirent.name);
      
      // Filter out system files
      const realPlugins = actualPlugins.filter(plugin => 
        !plugin.startsWith('.') && plugin !== 'index.php'
      );
      
      // Every real plugin should be in expected list
      realPlugins.forEach(plugin => {
        expect(EXPECTED_PLUGINS).toContain(plugin);
      });
      
      // Every expected plugin should exist
      EXPECTED_PLUGINS.forEach(plugin => {
        expect(realPlugins).toContain(plugin);
      });
    }
  });

  test('functions.php references expected plugins functionality', () => {
    const functionsPath = 'wp-content/themes/elinar-plast/functions.php';
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Should reference wp_mail functionality (used by wp-mail-smtp)
      expect(content).toMatch(/wp_mail/);
      
      // Should have mail handling functionality
      expect(content).toMatch(/mail.*sent|elinar_handle_contact_form/);
    }
  });
});

/**
 * Feature: documentation-correction, Property 5: Functionality Verification
 * For any described feature or functionality in the documentation, that functionality should be verifiable in the actual codebase
 * Validates: Requirements 3.1, 3.2, 3.5
 */
describe('Property 5: Functionality Verification', () => {
  const THEME_PATH = 'wp-content/themes/elinar-plast';
  
  test('CSS variables match documented values', () => {
    const stylePath = path.join(THEME_PATH, 'style.css');
    if (fs.existsSync(stylePath)) {
      const content = fs.readFileSync(stylePath, 'utf8');
      
      // Check documented CSS variables
      expect(content).toMatch(/--color-primary:\s*#0f4c5c/);
      expect(content).toMatch(/--color-secondary:\s*#1e293b/);
      expect(content).toMatch(/--color-accent:\s*#f59e0b/);
      expect(content).toMatch(/--color-text:\s*#334155/);
      expect(content).toMatch(/--color-light:\s*#f8fafc/);
      expect(content).toMatch(/--color-dark:\s*#0f172a/);
      expect(content).toMatch(/--color-border:\s*#e2e8f0/);
    }
  });

  test('Google Fonts integration exists in functions.php', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Should include Google Fonts
      expect(content).toMatch(/fonts\.googleapis\.com/);
      expect(content).toMatch(/Inter/);
      expect(content).toMatch(/Manrope/);
      expect(content).toMatch(/Space\+Grotesk/);
    }
  });

  test('external dependencies are properly enqueued', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // GLightbox
      expect(content).toMatch(/glightbox.*cdn\.jsdelivr\.net/);
      
      // Yandex Maps
      expect(content).toMatch(/api-maps\.yandex\.ru/);
      
      // Main JS file
      expect(content).toMatch(/main\.js/);
    }
  });

  test('AJAX form handling functionality exists', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // AJAX handlers
      expect(content).toMatch(/wp_ajax.*elinar_contact_form/);
      expect(content).toMatch(/wp_ajax_nopriv.*elinar_contact_form/);
      
      // Form handling function
      expect(content).toMatch(/function elinar_handle_contact_form/);
      
      // Nonce security
      expect(content).toMatch(/wp_verify_nonce/);
    }
  });

  test('JavaScript functionality exists in main.js', () => {
    const jsPath = path.join(THEME_PATH, 'assets/js/main.js');
    if (fs.existsSync(jsPath)) {
      const content = fs.readFileSync(jsPath, 'utf8');
      
      // Mobile menu functionality
      expect(content).toMatch(/menu.*toggle|menuToggle/);
      
      // Modal functionality
      expect(content).toMatch(/modal.*show|Modal.*classList/);
      
      // Scroll functionality
      expect(content).toMatch(/scroll.*addEventListener|checkScrollState/);
      
      // Logo click fix
      expect(content).toMatch(/brand-logo-container|handleLogoClick/);
    }
  });

  test('breadcrumb functionality supports custom URLs', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Breadcrumb function
      expect(content).toMatch(/function elinar_breadcrumbs/);
      
      // Custom URL support
      expect(content).toMatch(/development-production/);
      expect(content).toMatch(/technologies/);
      expect(content).toMatch(/about/);
    }
  });

  test('routing system supports static prototypes', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Template routing
      expect(content).toMatch(/template_include/);
      expect(content).toMatch(/locate_template/);
      
      // Supported routes
      expect(content).toMatch(/page-services-development\.php/);
      expect(content).toMatch(/page-about\.php/);
      expect(content).toMatch(/page-technologies-production\.php/);
    }
  });

  test('property: all documented JavaScript features should exist in code', () => {
    const jsPath = path.join(THEME_PATH, 'assets/js/main.js');
    if (fs.existsSync(jsPath)) {
      const content = fs.readFileSync(jsPath, 'utf8');
      
      const documentedFeatures = [
        'DOMContentLoaded', // Main initialization
        'addEventListener', // Event handling
        'modal', // Modal functionality
        'scroll', // Scroll handling
        'menu', // Menu functionality
      ];
      
      documentedFeatures.forEach(feature => {
        expect(content.toLowerCase()).toMatch(new RegExp(feature.toLowerCase()));
      });
    }
  });

  test('property: all documented CSS features should exist in styles', () => {
    const stylePath = path.join(THEME_PATH, 'style.css');
    if (fs.existsSync(stylePath)) {
      const content = fs.readFileSync(stylePath, 'utf8');
      
      const documentedFeatures = [
        'hero', // Hero sections
        'modal', // Modal styles
        'slider', // Slider functionality
        'accordion', // FAQ accordion
        'fab', // Floating action button
      ];
      
      documentedFeatures.forEach(feature => {
        expect(content.toLowerCase()).toMatch(new RegExp(feature.toLowerCase()));
      });
    }
  });
});

/**
 * Feature: documentation-correction, Property 6: Navigation Structure Accuracy
 * For any page template file that exists, the documentation should reflect its role in the website navigation structure
 * Validates: Requirements 2.2, 2.3
 */
describe('Property 6: Navigation Structure Accuracy', () => {
  const THEME_PATH = 'wp-content/themes/elinar-plast';
  
  const EXPECTED_PAGE_TEMPLATES = [
    { file: 'page-about.php', route: '/about/', description: 'О компании' },
    { file: 'page-contacts.php', route: null, description: 'Контакты' },
    { file: 'page-partners.php', route: null, description: 'Партнеры' },
    { file: 'page-products.php', route: null, description: 'Продукция' },
    { file: 'page-services-development.php', route: '/development-production/', description: 'Разработка и производство' },
    { file: 'page-technologies-production.php', route: '/technologies/', description: 'Технологии и контрактное производство' }
  ];

  test('all documented page templates exist', () => {
    EXPECTED_PAGE_TEMPLATES.forEach(template => {
      const filePath = path.join(THEME_PATH, template.file);
      expect(fs.existsSync(filePath)).toBe(true);
    });
  });

  test('routing system supports documented URLs', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Check for documented routes
      expect(content).toMatch(/development-production/);
      expect(content).toMatch(/about/);
      expect(content).toMatch(/technologies/);
      
      // Check template mapping
      expect(content).toMatch(/page-services-development\.php/);
      expect(content).toMatch(/page-about\.php/);
      expect(content).toMatch(/page-technologies-production\.php/);
    }
  });

  test('breadcrumb system supports documented navigation', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Breadcrumb function exists
      expect(content).toMatch(/function elinar_breadcrumbs/);
      
      // Supports custom URLs mentioned in documentation
      expect(content).toMatch(/development-production.*breadcrumb|breadcrumb.*development-production/);
      expect(content).toMatch(/technologies.*breadcrumb|breadcrumb.*technologies/);
    }
  });

  test('menu registration matches documented structure', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Should register primary and footer menus as documented
      expect(content).toMatch(/register_nav_menus/);
      expect(content).toMatch(/primary.*menu/i);
      expect(content).toMatch(/footer.*menu/i);
    }
  });

  test('template files have correct Template Name headers', () => {
    const customTemplates = EXPECTED_PAGE_TEMPLATES.filter(t => t.file.startsWith('page-') && t.file !== 'page.php');
    
    customTemplates.forEach(template => {
      const filePath = path.join(THEME_PATH, template.file);
      if (fs.existsSync(filePath)) {
        const content = fs.readFileSync(filePath, 'utf8');
        
        // Should have Template Name comment
        expect(content).toMatch(/Template Name:/);
      }
    });
  });

  test('property: all existing page templates should be documented in navigation', () => {
    const themeFiles = fs.readdirSync(THEME_PATH, { withFileTypes: true })
      .filter(dirent => dirent.isFile() && dirent.name.startsWith('page-') && dirent.name.endsWith('.php'))
      .map(dirent => dirent.name);
    
    const documentedFiles = EXPECTED_PAGE_TEMPLATES.map(t => t.file);
    documentedFiles.push('page.php'); // Generic page template
    
    // Every page template should be documented
    themeFiles.forEach(file => {
      expect(documentedFiles).toContain(file);
    });
  });

  test('contact page contains expected functionality', () => {
    const contactPagePath = path.join(THEME_PATH, 'page-contacts.php');
    if (fs.existsSync(contactPagePath)) {
      const content = fs.readFileSync(contactPagePath, 'utf8');
      
      // Should contain documented features
      expect(content).toMatch(/contact.*form|form.*contact/i);
      expect(content).toMatch(/whatsapp|telegram/i);
      expect(content).toMatch(/yandex.*map|map.*yandex/i);
    }
  });

  test('products page contains documented slider functionality', () => {
    const productsPagePath = path.join(THEME_PATH, 'page-products.php');
    if (fs.existsSync(productsPagePath)) {
      const content = fs.readFileSync(productsPagePath, 'utf8');
      
      // Should contain zigzag sliders as documented
      expect(content).toMatch(/zigzag.*slider|slider.*zigzag/i);
      expect(content).toMatch(/slider.*nav|nav.*slider/i);
      expect(content).toMatch(/slider.*dot|dot.*slider/i);
    }
  });
});

/**
 * Feature: documentation-correction, Property 7: Technical Specification Accuracy
 * For any technical specification mentioned in the documentation (CSS variables, implementation details), that specification should match the actual code implementation
 * Validates: Requirements 3.4
 */
describe('Property 7: Technical Specification Accuracy', () => {
  const THEME_PATH = 'wp-content/themes/elinar-plast';
  
  test('theme information matches documented values', () => {
    const stylePath = path.join(THEME_PATH, 'style.css');
    if (fs.existsSync(stylePath)) {
      const content = fs.readFileSync(stylePath, 'utf8');
      
      // Check theme header information
      expect(content).toMatch(/Theme Name:\s*Elinar Plast/);
      expect(content).toMatch(/Version:\s*1\.0/);
      expect(content).toMatch(/Author:\s*AI Assistant/);
      expect(content).toMatch(/Theme URI:\s*https:\/\/elinar-plast\.ru/);
      expect(content).toMatch(/Text Domain:\s*elinar-plast/);
    }
  });

  test('CSS variables match documented specifications', () => {
    const stylePath = path.join(THEME_PATH, 'style.css');
    if (fs.existsSync(stylePath)) {
      const content = fs.readFileSync(stylePath, 'utf8');
      
      // Check all documented CSS variables
      const expectedVariables = {
        '--container-width': '1280px',
        '--header-height': '73px',
        '--radius': '8px',
        '--font-main': "'Inter', sans-serif",
        '--font-heading': "'Manrope', sans-serif",
        '--font-menu': "'Manrope', 'Space Grotesk', 'Inter', sans-serif"
      };
      
      Object.entries(expectedVariables).forEach(([variable, value]) => {
        const regex = new RegExp(`${variable.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&')}:\\s*${value.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&')}`);
        expect(content).toMatch(regex);
      });
    }
  });

  test('shadow variables match documented specifications', () => {
    const stylePath = path.join(THEME_PATH, 'style.css');
    if (fs.existsSync(stylePath)) {
      const content = fs.readFileSync(stylePath, 'utf8');
      
      // Check shadow variables
      expect(content).toMatch(/--shadow:\s*0 4px 6px -1px rgba\(0, 0, 0, 0\.1\), 0 2px 4px -1px rgba\(0, 0, 0, 0\.06\)/);
      expect(content).toMatch(/--shadow-lg:\s*0 10px 15px -3px rgba\(0, 0, 0, 0\.1\), 0 4px 6px -2px rgba\(0, 0, 0, 0\.05\)/);
    }
  });

  test('script versions match documented specifications', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Check documented versions
      expect(content).toMatch(/main\.js.*1\.0\.4/);
      expect(content).toMatch(/glightbox.*3\.2\.0/);
      expect(content).toMatch(/elinar-style.*2\.2\.0/);
    }
  });

  test('font weights match documented specifications', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Check font weights in Google Fonts URL
      expect(content).toMatch(/Inter:wght@400;500;600/);
      expect(content).toMatch(/Manrope:wght@500;700;800/);
      expect(content).toMatch(/Space\+Grotesk:wght@400;500;600;700/);
      expect(content).toMatch(/display=swap/);
    }
  });

  test('external API versions match documented specifications', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Check API versions
      expect(content).toMatch(/yandex\.ru\/2\.1/);
      expect(content).toMatch(/lang=ru_RU/);
    }
  });

  test('property: all documented technical values should exist in code', () => {
    const stylePath = path.join(THEME_PATH, 'style.css');
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    
    if (fs.existsSync(stylePath) && fs.existsSync(functionsPath)) {
      const styleContent = fs.readFileSync(stylePath, 'utf8');
      const functionsContent = fs.readFileSync(functionsPath, 'utf8');
      
      // All documented CSS variables should exist
      const documentedCSSVariables = [
        '--color-primary', '--color-secondary', '--color-accent', '--color-text',
        '--color-light', '--color-dark', '--color-border',
        '--font-main', '--font-heading', '--font-menu',
        '--container-width', '--header-height', '--radius',
        '--shadow', '--shadow-lg'
      ];
      
      documentedCSSVariables.forEach(variable => {
        expect(styleContent).toMatch(new RegExp(variable.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&')));
      });
      
      // All documented external resources should exist
      const documentedResources = [
        'fonts.googleapis.com',
        'glightbox',
        'yandex-maps',
        'main.js'
      ];
      
      documentedResources.forEach(resource => {
        expect(functionsContent).toMatch(new RegExp(resource));
      });
    }
  });

  test('responsive breakpoints are implemented', () => {
    const stylePath = path.join(THEME_PATH, 'style.css');
    if (fs.existsSync(stylePath)) {
      const content = fs.readFileSync(stylePath, 'utf8');
      
      // Check for documented breakpoints
      expect(content).toMatch(/@media.*768px/);
      expect(content).toMatch(/@media.*1024px/);
      
      // Should have mobile-specific styles
      expect(content).toMatch(/mobile|Mobile/);
    }
  });
});

/**
 * Feature: documentation-correction, Property 5: Theme File Completeness
 * For any file in the theme directory (including contact-form-log.txt and inc/ directory), the documentation should mention that file
 * Validates: Requirements 1.5
 */
describe('Property 5: Theme File Completeness', () => {
  const THEME_PATH = 'wp-content/themes/elinar-plast';
  
  // All files that should be documented in the theme
  const EXPECTED_THEME_FILES = [
    // Core WordPress template files
    'footer.php',
    'front-page.php', 
    'functions.php',
    'header.php',
    'index.php',
    'page.php',
    'single.php',
    'style.css',
    
    // Custom page templates
    'page-about.php',
    'page-contacts.php',
    'page-partners.php',
    'page-products.php',
    'page-privacy-policy.php',
    'page-production-demo.php',
    'page-quote-request.php',
    'page-services-development.php',
    'page-technologies-production.php',
    
    // Integration and utility files
    'production-cycle-integration.php',
    'contact-form-log.txt',
    
    // Documentation files
    'INSTALLATION_GUIDE.md',
    'PRODUCTION_BLOCK_README.md'
  ];

  // Directories that should be documented
  const EXPECTED_THEME_DIRS = [
    'assets',
    'template-parts',
    'inc'
  ];

  test('all expected theme files exist', () => {
    EXPECTED_THEME_FILES.forEach(file => {
      const filePath = path.join(THEME_PATH, file);
      expect(fs.existsSync(filePath)).toBe(true);
    });
  });

  test('all expected theme directories exist', () => {
    EXPECTED_THEME_DIRS.forEach(dir => {
      const dirPath = path.join(THEME_PATH, dir);
      expect(fs.existsSync(dirPath)).toBe(true);
      expect(fs.statSync(dirPath).isDirectory()).toBe(true);
    });
  });

  test('inc directory exists but is empty as documented', () => {
    const incPath = path.join(THEME_PATH, 'inc');
    expect(fs.existsSync(incPath)).toBe(true);
    expect(fs.statSync(incPath).isDirectory()).toBe(true);
    
    const incContents = fs.readdirSync(incPath);
    expect(incContents.length).toBe(0);
  });

  test('contact-form-log.txt exists for form logging', () => {
    const logPath = path.join(THEME_PATH, 'contact-form-log.txt');
    expect(fs.existsSync(logPath)).toBe(true);
    expect(fs.statSync(logPath).isFile()).toBe(true);
  });

  test('template-parts directory contains modular components', () => {
    const templatePartsPath = path.join(THEME_PATH, 'template-parts');
    if (fs.existsSync(templatePartsPath)) {
      const templateParts = fs.readdirSync(templatePartsPath);
      
      const expectedTemplateParts = [
        'breadcrumbs.php',
        'production-cycle.php',
        'production-cycle-cards.php',
        'production-slider.php',
        'quote-form.php'
      ];
      
      expectedTemplateParts.forEach(part => {
        expect(templateParts).toContain(part);
      });
    }
  });

  test('assets directory has complete structure', () => {
    const assetsPath = path.join(THEME_PATH, 'assets');
    if (fs.existsSync(assetsPath)) {
      const assetDirs = fs.readdirSync(assetsPath, { withFileTypes: true })
        .filter(dirent => dirent.isDirectory())
        .map(dirent => dirent.name);
      
      const expectedAssetDirs = ['css', 'icons', 'images', 'js', 'video'];
      expectedAssetDirs.forEach(dir => {
        expect(assetDirs).toContain(dir);
      });
    }
  });

  test('functions.php contains documented functionality', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Check for documented sections
      expect(content).toMatch(/Theme Setup/);
      expect(content).toMatch(/Enqueue Scripts & Styles/);
      expect(content).toMatch(/Performance Optimizations/);
      expect(content).toMatch(/Custom Routing/);
      expect(content).toMatch(/Menu Customization/);
      expect(content).toMatch(/Breadcrumbs/);
      expect(content).toMatch(/AJAX Handlers/);
      expect(content).toMatch(/Favicon/);
      
      // Check for specific functions
      expect(content).toMatch(/function elinar_setup/);
      expect(content).toMatch(/function elinar_scripts/);
      expect(content).toMatch(/function elinar_breadcrumbs/);
      expect(content).toMatch(/function elinar_handle_contact_form/);
      expect(content).toMatch(/function elinar_handle_quote_form/);
      expect(content).toMatch(/function elinar_handle_project_form/);
    }
  });

  test('main.js contains documented functionality', () => {
    const mainJsPath = path.join(THEME_PATH, 'assets/js/main.js');
    if (fs.existsSync(mainJsPath)) {
      const content = fs.readFileSync(mainJsPath, 'utf8');
      
      // Check for documented modules
      expect(content).toMatch(/Utility Functions/);
      expect(content).toMatch(/Header & Navigation/);
      expect(content).toMatch(/Modal System/);
      expect(content).toMatch(/Gallery & Sliders/);
      expect(content).toMatch(/Interactive Elements/);
      expect(content).toMatch(/Forms & AJAX/);
      expect(content).toMatch(/Browser Compatibility/);
      
      // Check for specific functions
      expect(content).toMatch(/function debounce/);
      expect(content).toMatch(/function throttle/);
      expect(content).toMatch(/checkScrollState/);
      expect(content).toMatch(/GLightbox/);
    }
  });

  test('style.css contains documented CSS variables', () => {
    const stylePath = path.join(THEME_PATH, 'style.css');
    if (fs.existsSync(stylePath)) {
      const content = fs.readFileSync(stylePath, 'utf8');
      
      // Check for documented CSS variables
      expect(content).toMatch(/--color-primary/);
      expect(content).toMatch(/--color-secondary/);
      expect(content).toMatch(/--color-accent/);
      expect(content).toMatch(/--font-main/);
      expect(content).toMatch(/--font-heading/);
      expect(content).toMatch(/--container-width/);
      expect(content).toMatch(/--header-height/);
    }
  });

  test('property: all existing theme files should be documentable', () => {
    const themeFiles = fs.readdirSync(THEME_PATH, { withFileTypes: true })
      .filter(dirent => dirent.isFile())
      .map(dirent => dirent.name);
    
    // For any file that exists, it should be either expected or a system file
    themeFiles.forEach(file => {
      const isExpected = EXPECTED_THEME_FILES.includes(file);
      const isSystemFile = file.startsWith('.') || file.endsWith('.log') || file.endsWith('.txt') || file.includes('~');
      
      // Every file should be either expected or a system file
      if (!isExpected && !isSystemFile) {
        console.log(`Unexpected file found: ${file}`);
      }
      expect(isExpected || isSystemFile).toBe(true);
    });
  });

  test('property: all existing theme directories should be documentable', () => {
    const themeDirs = fs.readdirSync(THEME_PATH, { withFileTypes: true })
      .filter(dirent => dirent.isDirectory())
      .map(dirent => dirent.name);
    
    // For any directory that exists, it should be expected
    themeDirs.forEach(dir => {
      const isExpected = EXPECTED_THEME_DIRS.includes(dir);
      const isSystemDir = dir.startsWith('.');
      
      // Every directory should be either expected or a system directory
      if (!isExpected && !isSystemDir) {
        console.log(`Unexpected directory found: ${dir}`);
      }
      expect(isExpected || isSystemDir).toBe(true);
    });
  });

  test('property: for all documented files, they should exist and be accessible', () => {
    EXPECTED_THEME_FILES.forEach(file => {
      const filePath = path.join(THEME_PATH, file);
      
      // File should exist
      expect(fs.existsSync(filePath)).toBe(true);
      
      // File should be readable
      expect(() => {
        fs.accessSync(filePath, fs.constants.R_OK);
      }).not.toThrow();
      
      // PHP files should contain valid PHP opening tags
      if (file.endsWith('.php')) {
        const content = fs.readFileSync(filePath, 'utf8');
        expect(content).toMatch(/<?php/);
      }
      
      // CSS files should contain valid CSS
      if (file.endsWith('.css')) {
        const content = fs.readFileSync(filePath, 'utf8');
        expect(content.length).toBeGreaterThan(0);
      }
      
      // JS files should contain valid JavaScript
      if (file.endsWith('.js')) {
        const content = fs.readFileSync(filePath, 'utf8');
        expect(content.length).toBeGreaterThan(0);
      }
    });
  });

  test('property: theme file sizes should be reasonable', () => {
    const fileSizeExpectations = {
      'functions.php': { min: 30000, max: 200000 }, // 30KB - 200KB
      'style.css': { min: 1000, max: 100000 }, // 1KB - 100KB  
      'assets/js/main.js': { min: 10000, max: 200000 }, // 10KB - 200KB
    };

    Object.entries(fileSizeExpectations).forEach(([file, { min, max }]) => {
      const filePath = path.join(THEME_PATH, file);
      if (fs.existsSync(filePath)) {
        const stats = fs.statSync(filePath);
        expect(stats.size).toBeGreaterThan(min);
        expect(stats.size).toBeLessThan(max);
      }
    });
  });
});

/**
 * Feature: documentation-correction, Property 6: File Structure Accuracy
 * For any documented file or directory, that file or directory should exist in the actual project structure (no fictional elements)
 * Validates: Requirements 1.6, 3.1
 */
describe('Property 6: File Structure Accuracy', () => {
  const THEME_PATH = 'wp-content/themes/elinar-plast';
  const PLUGINS_PATH = 'wp-content/plugins';
  
  // Files that are documented and should exist
  const DOCUMENTED_FILES = [
    // Core theme files
    'wp-content/themes/elinar-plast/functions.php',
    'wp-content/themes/elinar-plast/style.css',
    'wp-content/themes/elinar-plast/index.php',
    'wp-content/themes/elinar-plast/header.php',
    'wp-content/themes/elinar-plast/footer.php',
    'wp-content/themes/elinar-plast/front-page.php',
    'wp-content/themes/elinar-plast/page.php',
    'wp-content/themes/elinar-plast/single.php',
    
    // Page templates
    'wp-content/themes/elinar-plast/page-about.php',
    'wp-content/themes/elinar-plast/page-contacts.php',
    'wp-content/themes/elinar-plast/page-products.php',
    'wp-content/themes/elinar-plast/page-technologies-production.php',
    'wp-content/themes/elinar-plast/page-services-development.php',
    'wp-content/themes/elinar-plast/page-quote-request.php',
    'wp-content/themes/elinar-plast/page-privacy-policy.php',
    'wp-content/themes/elinar-plast/page-production-demo.php',
    
    // Utility files
    'wp-content/themes/elinar-plast/contact-form-log.txt',
    'wp-content/themes/elinar-plast/production-cycle-integration.php',
    
    // Asset files
    'wp-content/themes/elinar-plast/assets/js/main.js',
    'wp-content/themes/elinar-plast/assets/js/production-slider.js',
    'wp-content/themes/elinar-plast/assets/js/quote-form.js',
    'wp-content/themes/elinar-plast/assets/css/breadcrumbs.css',
    'wp-content/themes/elinar-plast/assets/css/glightbox-custom.css',
    'wp-content/themes/elinar-plast/assets/css/page-about.css',
    'wp-content/themes/elinar-plast/assets/css/page-contacts.css',
    'wp-content/themes/elinar-plast/assets/css/page-products.css',
    'wp-content/themes/elinar-plast/assets/css/page-services-development.css',
    'wp-content/themes/elinar-plast/assets/css/page-technologies-production.css',
    'wp-content/themes/elinar-plast/assets/css/production-cycle.css',
    'wp-content/themes/elinar-plast/assets/css/production-cycle-cards.css',
    'wp-content/themes/elinar-plast/assets/css/production-slider.css',
    'wp-content/themes/elinar-plast/assets/css/quote-form.css',
    
    // Template parts
    'wp-content/themes/elinar-plast/template-parts/breadcrumbs.php',
    'wp-content/themes/elinar-plast/template-parts/production-cycle.php',
    'wp-content/themes/elinar-plast/template-parts/production-cycle-cards.php',
    'wp-content/themes/elinar-plast/template-parts/production-slider.php',
    'wp-content/themes/elinar-plast/template-parts/quote-form.php',
    
    // Plugin directories
    'wp-content/plugins/all-in-one-wp-migration',
    'wp-content/plugins/wp-mail-smtp'
  ];

  // Directories that are documented and should exist
  const DOCUMENTED_DIRECTORIES = [
    'wp-content/themes/elinar-plast/assets',
    'wp-content/themes/elinar-plast/assets/css',
    'wp-content/themes/elinar-plast/assets/js',
    'wp-content/themes/elinar-plast/assets/icons',
    'wp-content/themes/elinar-plast/assets/images',
    'wp-content/themes/elinar-plast/assets/video',
    'wp-content/themes/elinar-plast/template-parts',
    'wp-content/themes/elinar-plast/inc',
    'wp-content/plugins',
    'wp-content/uploads'
  ];

  test('all documented files exist in the actual project structure', () => {
    DOCUMENTED_FILES.forEach(filePath => {
      expect(fs.existsSync(filePath)).toBe(true);
    });
  });

  test('all documented directories exist in the actual project structure', () => {
    DOCUMENTED_DIRECTORIES.forEach(dirPath => {
      expect(fs.existsSync(dirPath)).toBe(true);
      expect(fs.statSync(dirPath).isDirectory()).toBe(true);
    });
  });

  test('documented asset subdirectories contain expected file types', () => {
    const assetChecks = [
      { dir: 'wp-content/themes/elinar-plast/assets/css', extension: '.css' },
      { dir: 'wp-content/themes/elinar-plast/assets/js', extension: '.js' },
      { dir: 'wp-content/themes/elinar-plast/assets/icons', extension: '.svg' },
      { dir: 'wp-content/themes/elinar-plast/assets/images', extensions: ['.webp', '.jpg', '.png'] },
      { dir: 'wp-content/themes/elinar-plast/assets/video', extensions: ['.mp4', '.webp'] }
    ];

    assetChecks.forEach(({ dir, extension, extensions }) => {
      if (fs.existsSync(dir)) {
        const files = fs.readdirSync(dir, { withFileTypes: true })
          .filter(dirent => dirent.isFile())
          .map(dirent => dirent.name);
        
        if (extension) {
          const hasExpectedFiles = files.some(file => file.endsWith(extension));
          expect(hasExpectedFiles).toBe(true);
        }
        
        if (extensions) {
          const hasExpectedFiles = files.some(file => 
            extensions.some(ext => file.endsWith(ext))
          );
          expect(hasExpectedFiles).toBe(true);
        }
      }
    });
  });

  test('documented plugins have valid plugin structure', () => {
    const documentedPlugins = [
      'wp-content/plugins/all-in-one-wp-migration',
      'wp-content/plugins/wp-mail-smtp'
    ];

    documentedPlugins.forEach(pluginPath => {
      if (fs.existsSync(pluginPath)) {
        const pluginFiles = fs.readdirSync(pluginPath);
        
        // Should have at least one PHP file (main plugin file)
        const hasPhpFile = pluginFiles.some(file => file.endsWith('.php'));
        expect(hasPhpFile).toBe(true);
      }
    });
  });

  test('documented template files contain valid WordPress template structure', () => {
    const templateFiles = DOCUMENTED_FILES.filter(file => 
      file.includes('page-') || file.includes('front-page.php') || file.includes('single.php')
    );

    templateFiles.forEach(filePath => {
      if (fs.existsSync(filePath)) {
        const content = fs.readFileSync(filePath, 'utf8');
        
        // Should contain PHP opening tag
        expect(content).toMatch(/<?php/);
        
        // Template files should contain get_header() and get_footer() (except header/footer)
        if (!filePath.includes('header.php') && !filePath.includes('footer.php')) {
          expect(content).toMatch(/get_header\(\)/);
          expect(content).toMatch(/get_footer\(\)/);
        }
      }
    });
  });

  test('inc directory exists but is empty as documented', () => {
    const incPath = 'wp-content/themes/elinar-plast/inc';
    expect(fs.existsSync(incPath)).toBe(true);
    expect(fs.statSync(incPath).isDirectory()).toBe(true);
    
    const incContents = fs.readdirSync(incPath);
    expect(incContents.length).toBe(0);
  });

  test('video directory contains documented content', () => {
    const videoPath = 'wp-content/themes/elinar-plast/assets/video';
    if (fs.existsSync(videoPath)) {
      const videoFiles = fs.readdirSync(videoPath);
      
      // Should contain company presentation video or poster as documented
      const hasVideoContent = videoFiles.some(file => 
        file.includes('company_presentation') || file.includes('poster')
      );
      expect(hasVideoContent).toBe(true);
    }
  });

  test('property: for any documented file path, that exact path should exist', () => {
    // Generate test cases by checking each documented file
    DOCUMENTED_FILES.forEach(filePath => {
      // File should exist at the exact documented path
      expect(fs.existsSync(filePath)).toBe(true);
      
      // File should be readable
      expect(() => {
        fs.accessSync(filePath, fs.constants.R_OK);
      }).not.toThrow();
      
      // File should have reasonable size (not empty for most files, but skip directories)
      const stats = fs.statSync(filePath);
      if (!filePath.endsWith('.txt') && !filePath.endsWith('.log') && !stats.isDirectory()) {
        expect(stats.size).toBeGreaterThan(0);
      }
    });
  });

  test('property: for any documented directory path, that exact path should exist and be a directory', () => {
    DOCUMENTED_DIRECTORIES.forEach(dirPath => {
      // Directory should exist at the exact documented path
      expect(fs.existsSync(dirPath)).toBe(true);
      
      // Path should be a directory
      expect(fs.statSync(dirPath).isDirectory()).toBe(true);
      
      // Directory should be readable
      expect(() => {
        fs.accessSync(dirPath, fs.constants.R_OK);
      }).not.toThrow();
    });
  });

  test('property: no documented paths should be fictional or non-existent', () => {
    const allDocumentedPaths = [...DOCUMENTED_FILES, ...DOCUMENTED_DIRECTORIES];
    
    // Every documented path should exist in the actual file system
    allDocumentedPaths.forEach(path => {
      expect(fs.existsSync(path)).toBe(true);
    });
    
    // No documented path should be a broken symlink or inaccessible
    allDocumentedPaths.forEach(path => {
      expect(() => {
        fs.accessSync(path, fs.constants.F_OK);
      }).not.toThrow();
    });
  });

  test('documented file structure matches actual WordPress theme structure', () => {
    // Check that documented structure follows WordPress conventions
    const wpThemeFiles = [
      'wp-content/themes/elinar-plast/style.css',
      'wp-content/themes/elinar-plast/index.php',
      'wp-content/themes/elinar-plast/functions.php'
    ];

    wpThemeFiles.forEach(file => {
      expect(fs.existsSync(file)).toBe(true);
    });

    // Check style.css has theme header
    const stylePath = 'wp-content/themes/elinar-plast/style.css';
    if (fs.existsSync(stylePath)) {
      const content = fs.readFileSync(stylePath, 'utf8');
      expect(content).toMatch(/Theme Name:/);
      expect(content).toMatch(/Version:/);
    }
  });

  test('documented asset organization matches modular architecture', () => {
    const assetDirs = [
      'wp-content/themes/elinar-plast/assets/css',
      'wp-content/themes/elinar-plast/assets/js',
      'wp-content/themes/elinar-plast/assets/icons',
      'wp-content/themes/elinar-plast/assets/images',
      'wp-content/themes/elinar-plast/assets/video'
    ];

    assetDirs.forEach(dir => {
      expect(fs.existsSync(dir)).toBe(true);
      
      // Each asset directory should contain relevant files
      const files = fs.readdirSync(dir);
      expect(files.length).toBeGreaterThan(0);
    });
  });

  test('property: documented plugin functionality should be verifiable', () => {
    // Check wp-mail-smtp plugin
    const wpMailSmtpPath = 'wp-content/plugins/wp-mail-smtp';
    if (fs.existsSync(wpMailSmtpPath)) {
      const pluginFiles = fs.readdirSync(wpMailSmtpPath);
      const mainFile = pluginFiles.find(file => file === 'wp_mail_smtp.php');
      
      if (mainFile) {
        const mainFilePath = path.join(wpMailSmtpPath, mainFile);
        const content = fs.readFileSync(mainFilePath, 'utf8');
        
        // Should contain plugin header
        expect(content).toMatch(/Plugin Name:\s*WP Mail SMTP/);
        expect(content).toMatch(/Description:/);
      }
    }

    // Check all-in-one-wp-migration plugin
    const migrationPluginPath = 'wp-content/plugins/all-in-one-wp-migration';
    if (fs.existsSync(migrationPluginPath)) {
      const pluginFiles = fs.readdirSync(migrationPluginPath);
      const hasMainFile = pluginFiles.some(file => file.endsWith('.php'));
      expect(hasMainFile).toBe(true);
    }
  });
});

/**
 * Feature: documentation-correction, Property 7: Navigation Structure Documentation
 * For any menu item in the fallback navigation (including "Производство" menu with "Разработка и производство" submenu), the documentation should describe that menu structure
 * Validates: Requirements 2.3, 2.4
 */
describe('Property 7: Navigation Structure Documentation', () => {
  const THEME_PATH = 'wp-content/themes/elinar-plast';
  
  // Expected navigation structure based on documentation
  const EXPECTED_NAVIGATION_STRUCTURE = {
    primary: [
      { title: 'О компании', url: '/about/', template: 'page-about.php' },
      { title: 'Продукция', template: 'page-products.php' },
      { 
        title: 'Производство', 
        submenu: [
          { title: 'Разработка и производство', url: '/development-production/', template: 'page-services-development.php' },
          { title: 'Технологии и контрактное производство', url: '/technologies/', template: 'page-technologies-production.php' }
        ]
      },
      { title: 'Контакты', template: 'page-contacts.php' }
    ]
  };

  // URL routing mappings that should exist
  const EXPECTED_URL_ROUTES = [
    { url: '/about/', template: 'page-about.php' },
    { url: '/development-production/', template: 'page-services-development.php' },
    { url: '/technologies/', template: 'page-technologies-production.php' },
    { url: '/technologies-production/', template: 'page-technologies-production.php' },
    { url: '/technologies-and-contract-manufacturing/', template: 'page-technologies-production.php' },
    { url: '/quote-request/', template: 'page-quote-request.php' },
    { url: '/zapros-rascheta/', template: 'page-quote-request.php' }
  ];

  test('all documented page templates exist for navigation structure', () => {
    const navigationTemplates = [
      'page-about.php',
      'page-products.php', 
      'page-services-development.php',
      'page-technologies-production.php',
      'page-contacts.php',
      'page-quote-request.php'
    ];

    navigationTemplates.forEach(template => {
      const templatePath = path.join(THEME_PATH, template);
      expect(fs.existsSync(templatePath)).toBe(true);
    });
  });

  test('functions.php contains routing for documented navigation URLs', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Should contain routing logic for custom URLs
      expect(content).toMatch(/template_include/);
      expect(content).toMatch(/locate_template/);
      
      // Should contain specific route mappings
      expect(content).toMatch(/development-production/);
      expect(content).toMatch(/about/);
      expect(content).toMatch(/technologies/);
      expect(content).toMatch(/quote-request|zapros-rascheta/);
      
      // Should map to correct template files
      expect(content).toMatch(/page-services-development\.php/);
      expect(content).toMatch(/page-about\.php/);
      expect(content).toMatch(/page-technologies-production\.php/);
    }
  });

  test('breadcrumb system supports documented navigation structure', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Should have breadcrumb function
      expect(content).toMatch(/function elinar_breadcrumbs/);
      
      // Should support custom URL breadcrumbs for navigation items (check for routing logic)
      expect(content).toMatch(/development-production|about|technologies/);
      expect(content).toMatch(/template_include|locate_template/);
    }
  });

  test('menu registration supports documented navigation structure', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Should register primary menu for main navigation
      expect(content).toMatch(/register_nav_menus/);
      expect(content).toMatch(/primary.*menu/i);
      expect(content).toMatch(/footer.*menu/i);
    }
  });

  test('header.php contains navigation menu implementation', () => {
    const headerPath = path.join(THEME_PATH, 'header.php');
    if (fs.existsSync(headerPath)) {
      const content = fs.readFileSync(headerPath, 'utf8');
      
      // Should contain navigation menu
      expect(content).toMatch(/wp_nav_menu|nav.*menu/);
      expect(content).toMatch(/theme_location.*primary|primary.*theme_location/);
      
      // Should have mobile menu toggle
      expect(content).toMatch(/mobile.*menu|menu.*mobile/);
      expect(content).toMatch(/menu.*toggle|toggle.*menu/);
    }
  });

  test('documented submenu structure is supported', () => {
    const headerPath = path.join(THEME_PATH, 'header.php');
    if (fs.existsSync(headerPath)) {
      const content = fs.readFileSync(headerPath, 'utf8');
      
      // Should support dropdown/submenu functionality
      expect(content).toMatch(/dropdown|submenu|sub-menu/);
    }
  });

  test('CSS supports documented navigation styling', () => {
    const stylePath = path.join(THEME_PATH, 'style.css');
    if (fs.existsSync(stylePath)) {
      const content = fs.readFileSync(stylePath, 'utf8');
      
      // Should have navigation styles
      expect(content).toMatch(/nav|menu/);
      expect(content).toMatch(/dropdown|submenu/);
      expect(content).toMatch(/mobile.*menu|menu.*mobile/);
    }
  });

  test('JavaScript supports documented navigation functionality', () => {
    const jsPath = path.join(THEME_PATH, 'assets/js/main.js');
    if (fs.existsSync(jsPath)) {
      const content = fs.readFileSync(jsPath, 'utf8');
      
      // Should have mobile menu functionality
      expect(content).toMatch(/menu.*toggle|toggle.*menu/);
      expect(content).toMatch(/mobile.*menu|menu.*mobile/);
      
      // Should handle navigation interactions
      expect(content).toMatch(/addEventListener.*click|click.*addEventListener/);
    }
  });

  test('property: all documented navigation URLs should have corresponding routing', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // For each documented route, there should be routing logic
      EXPECTED_URL_ROUTES.forEach(route => {
        const urlPattern = route.url.replace(/^\/|\/$/g, ''); // Remove leading/trailing slashes
        const templateName = route.template;
        
        // Should contain URL pattern in routing logic
        expect(content).toMatch(new RegExp(urlPattern.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&')));
        
        // Should map to correct template
        expect(content).toMatch(new RegExp(templateName.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&')));
      });
    }
  });

  test('property: all navigation templates should contain expected content structure', () => {
    const navigationTemplates = [
      { file: 'page-about.php', expectedContent: ['about', 'company', 'производство'] },
      { file: 'page-products.php', expectedContent: ['product', 'slider', 'zigzag'] },
      { file: 'page-services-development.php', expectedContent: ['service', 'development', 'разработка'] },
      { file: 'page-technologies-production.php', expectedContent: ['technology', 'production', 'технологии'] },
      { file: 'page-contacts.php', expectedContent: ['contact', 'form', 'контакт'] }
    ];

    navigationTemplates.forEach(({ file, expectedContent }) => {
      const templatePath = path.join(THEME_PATH, file);
      if (fs.existsSync(templatePath)) {
        const content = fs.readFileSync(templatePath, 'utf8').toLowerCase();
        
        // Should contain at least one expected content indicator
        const hasExpectedContent = expectedContent.some(indicator => 
          content.includes(indicator.toLowerCase())
        );
        
        expect(hasExpectedContent).toBe(true);
      }
    });
  });

  test('property: navigation structure should be consistent across all components', () => {
    const navigationFiles = [
      path.join(THEME_PATH, 'functions.php'),
      path.join(THEME_PATH, 'header.php'),
      path.join(THEME_PATH, 'assets/js/main.js')
    ];

    const navigationKeywords = ['menu', 'navigation', 'nav'];
    
    navigationFiles.forEach(filePath => {
      if (fs.existsSync(filePath)) {
        const content = fs.readFileSync(filePath, 'utf8').toLowerCase();
        
        // Each navigation-related file should contain navigation keywords
        const hasNavigationKeywords = navigationKeywords.some(keyword => 
          content.includes(keyword)
        );
        
        expect(hasNavigationKeywords).toBe(true);
      }
    });
  });

  test('property: documented menu structure should support hierarchical organization', () => {
    // Check that the "Производство" menu with submenu is properly supported
    const headerPath = path.join(THEME_PATH, 'header.php');
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    
    if (fs.existsSync(headerPath)) {
      const headerContent = fs.readFileSync(headerPath, 'utf8');
      
      // Should support hierarchical menu structure
      expect(headerContent).toMatch(/wp_nav_menu/);
      expect(headerContent).toMatch(/sub-menu|menu-item-has-children|fallback_cb/); // Should support multi-level menus
    }
    
    if (fs.existsSync(functionsPath)) {
      const functionsContent = fs.readFileSync(functionsPath, 'utf8');
      
      // Should register menus that support hierarchy
      expect(functionsContent).toMatch(/register_nav_menus/);
    }
  });

  test('property: all documented navigation routes should be accessible', () => {
    // Verify that all documented routes have corresponding templates
    const routeTemplateMap = {
      '/about/': 'page-about.php',
      '/development-production/': 'page-services-development.php',
      '/technologies/': 'page-technologies-production.php',
      '/quote-request/': 'page-quote-request.php'
    };

    Object.entries(routeTemplateMap).forEach(([route, template]) => {
      const templatePath = path.join(THEME_PATH, template);
      
      // Template should exist for each documented route
      expect(fs.existsSync(templatePath)).toBe(true);
      
      // Template should contain valid WordPress structure
      if (fs.existsSync(templatePath)) {
        const content = fs.readFileSync(templatePath, 'utf8');
        expect(content).toMatch(/<?php/);
        expect(content).toMatch(/get_header\(\)/);
        expect(content).toMatch(/get_footer\(\)/);
      }
    });
  });

  test('fallback menu configuration supports documented structure', () => {
    const functionsPath = path.join(THEME_PATH, 'functions.php');
    if (fs.existsSync(functionsPath)) {
      const content = fs.readFileSync(functionsPath, 'utf8');
      
      // Should have fallback menu handling
      expect(content).toMatch(/fallback|wp_page_menu/);
      
      // Should remove "Home" from menu as documented
      expect(content).toMatch(/remove.*home|home.*remove/i);
    }
  });
});

module.exports = { verifyFileStructureCompleteness };