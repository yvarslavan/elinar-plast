/**
 * Quote Request Form JavaScript
 * Логика многошаговой формы запроса КП
 */

(function () {
    'use strict';

    // Configuration
    const CONFIG = {
        storageKey: 'elinar_quote_form_data',
        autosaveInterval: 30000, // 30 seconds
        maxFiles: 5,
        maxFileSize: 10 * 1024 * 1024, // 10MB
        allowedTypes: ['jpg', 'jpeg', 'png', 'pdf', 'dwg', 'dxf', 'step', 'stp', 'iges', 'igs', 'stl'],
        totalSteps: 6
    };

    // State
    let currentStep = 0;
    let uploadedFiles = [];
    let autosaveTimer = null;
    let selectedTechnology = null;

    // DOM Elements
    let form, steps, progressBar, progressSteps;
    let prevBtn, nextBtn, submitBtn;
    let fileDropzone, fileInput, fileList;
    let autosaveIndicator, loadingOverlay, successMessage;

    /**
     * Initialize the form
     */
    function init() {
        // Get DOM elements
        form = document.getElementById('quote-form');
        if (!form) return;

        steps = document.querySelectorAll('.quote-step');
        progressBar = document.getElementById('quote-progress-bar');
        progressSteps = document.querySelectorAll('.quote-progress-step');
        prevBtn = document.getElementById('quote-prev');
        nextBtn = document.getElementById('quote-next');
        submitBtn = document.getElementById('quote-submit');
        fileDropzone = document.getElementById('quote-file-dropzone');
        fileInput = document.getElementById('quote-files');
        fileList = document.getElementById('quote-file-list');
        autosaveIndicator = document.getElementById('quote-autosave');
        loadingOverlay = document.getElementById('quote-loading');
        successMessage = document.getElementById('quote-success');

        // Bind events
        bindEvents();

        // Load saved data
        loadSavedData();

        // Start autosave
        startAutosave();

        // Update progress bar
        updateProgressBar();
    }

    /**
     * Bind all event handlers
     */
    function bindEvents() {
        // Navigation buttons
        if (prevBtn) prevBtn.addEventListener('click', goToPrevStep);
        if (nextBtn) nextBtn.addEventListener('click', goToNextStep);

        // Form submission
        if (form) form.addEventListener('submit', handleSubmit);

        // Technology selection
        const techCards = document.querySelectorAll('.quote-tech-card input[type="radio"]');
        techCards.forEach(card => {
            card.addEventListener('change', handleTechnologyChange);
        });

        // Color type change
        const colorRadios = document.querySelectorAll('input[name="color_type"]');
        colorRadios.forEach(radio => {
            radio.addEventListener('change', handleColorTypeChange);
        });

        // Material change
        const materialSelect = document.getElementById('material');
        if (materialSelect) {
            materialSelect.addEventListener('change', handleMaterialChange);
        }

        // Production volume change
        const volumeRadios = document.querySelectorAll('input[name="production_volume"]');
        volumeRadios.forEach(radio => {
            radio.addEventListener('change', handleVolumeChange);
        });

        // File upload
        if (fileDropzone) {
            fileDropzone.addEventListener('dragover', handleDragOver);
            fileDropzone.addEventListener('dragleave', handleDragLeave);
            fileDropzone.addEventListener('drop', handleFileDrop);
        }
        if (fileInput) {
            fileInput.addEventListener('change', handleFileSelect);
        }

        // Example buttons
        const exampleBtns = document.querySelectorAll('.quote-example-btn');
        exampleBtns.forEach(btn => {
            btn.addEventListener('click', handleExampleClick);
        });

        // New request button
        const newRequestBtn = document.getElementById('quote-new');
        if (newRequestBtn) {
            newRequestBtn.addEventListener('click', resetForm);
        }

        // Phone input mask handled globally in main.js
    }

    /**
     * Navigation: Go to previous step
     */
    function goToPrevStep() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    }

    /**
     * Navigation: Go to next step
     */
    function goToNextStep() {
        if (validateCurrentStep()) {
            if (currentStep < CONFIG.totalSteps - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }
    }

    /**
     * Show specific step
     */
    function showStep(stepIndex) {
        // Hide all steps
        steps.forEach((step, index) => {
            step.classList.remove('active');
            if (index === stepIndex) {
                step.classList.add('active');
            }
        });

        // Update progress steps
        progressSteps.forEach((step, index) => {
            step.classList.remove('active', 'completed');
            if (index < stepIndex) {
                step.classList.add('completed');
            } else if (index === stepIndex) {
                step.classList.add('active');
            }
        });

        // Update buttons visibility
        prevBtn.style.display = stepIndex === 0 ? 'none' : 'flex';
        nextBtn.style.display = stepIndex === CONFIG.totalSteps - 1 ? 'none' : 'flex';
        submitBtn.style.display = stepIndex === CONFIG.totalSteps - 1 ? 'flex' : 'none';

        // Update progress bar
        updateProgressBar();

        // Scroll to top of form
        const formWrapper = document.getElementById('quote-form-wrapper');
        if (formWrapper) {
            formWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    /**
     * Update progress bar width
     */
    function updateProgressBar() {
        const progress = (currentStep / (CONFIG.totalSteps - 1)) * 100;
        if (progressBar) {
            progressBar.style.width = `${progress}%`;
        }
    }

    /**
     * Validate current step
     */
    function validateCurrentStep() {
        const currentStepEl = steps[currentStep];
        if (!currentStepEl) return true;

        const requiredFields = currentStepEl.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            // Remove previous error state
            const group = field.closest('.quote-form-group');
            if (group) group.classList.remove('has-error');

            // Check validity
            if (!field.checkValidity()) {
                isValid = false;
                if (group) group.classList.add('has-error');

                // Focus first invalid field
                if (isValid === false) {
                    field.focus();
                }
            }
        });

        // Special validation for technology selection on step 0
        if (currentStep === 0 && !selectedTechnology) {
            isValid = false;
            showError('Выберите технологию производства');
        }

        // Validate conditional fields based on technology
        if (currentStep === 1 && selectedTechnology) {
            if (selectedTechnology === 'extrusion') {
                const extrusionType = document.getElementById('product_type_extrusion');
                if (extrusionType && !extrusionType.value) {
                    const group = extrusionType.closest('.quote-form-group');
                    if (group) group.classList.add('has-error');
                    isValid = false;
                }
            } else if (selectedTechnology === 'injection') {
                const injectionType = document.getElementById('product_type_injection');
                if (injectionType && !injectionType.value) {
                    const group = injectionType.closest('.quote-form-group');
                    if (group) group.classList.add('has-error');
                    isValid = false;
                }
            }
        }

        if (!isValid) {
            showError('Пожалуйста, заполните все обязательные поля');
        }

        return isValid;
    }

    /**
     * Handle technology card selection
     */
    function handleTechnologyChange(e) {
        selectedTechnology = e.target.value;

        // Update visual state of cards
        const allCards = document.querySelectorAll('.quote-tech-card');
        allCards.forEach(card => {
            const input = card.querySelector('input[type="radio"]');
            if (input && input.checked) {
                card.classList.add('selected');
            } else {
                card.classList.remove('selected');
            }
        });

        // Show/hide technology-specific fields
        updateTechFields();

        // Save to storage
        saveFormData();
    }

    /**
     * Update visibility of technology-specific fields
     */
    function updateTechFields() {
        const extrusionFields = document.querySelectorAll('.extrusion-field');
        const injectionFields = document.querySelectorAll('.injection-field');

        extrusionFields.forEach(field => {
            field.classList.remove('show');
            if (selectedTechnology === 'extrusion') {
                field.classList.add('show');
            }
        });

        injectionFields.forEach(field => {
            field.classList.remove('show');
            if (selectedTechnology === 'injection') {
                field.classList.add('show');
            }
        });

        // For consultation - show both but mark as optional
        if (selectedTechnology === 'consultation') {
            extrusionFields.forEach(field => field.classList.add('show'));
            injectionFields.forEach(field => field.classList.add('show'));
        }
    }

    /**
     * Handle color type change
     */
    function handleColorTypeChange(e) {
        const colorValueGroup = document.getElementById('color_value_group');
        if (colorValueGroup) {
            colorValueGroup.style.display = e.target.value === 'colored' ? 'flex' : 'none';
        }
    }

    /**
     * Handle material change
     */
    function handleMaterialChange(e) {
        const materialOtherGroup = document.getElementById('material_other_group');
        if (materialOtherGroup) {
            materialOtherGroup.style.display = e.target.value === 'other' ? 'flex' : 'none';
        }
    }

    /**
     * Handle production volume change
     */
    function handleVolumeChange(e) {
        const volumeMonthlyGroup = document.getElementById('volume_monthly_group');
        if (volumeMonthlyGroup) {
            volumeMonthlyGroup.style.display = e.target.value === 'serial' ? 'flex' : 'none';
        }

        // Update unit options based on technology
        const volumeUnit = document.getElementById('volume_unit');
        if (volumeUnit && selectedTechnology) {
            if (selectedTechnology === 'extrusion') {
                volumeUnit.innerHTML = '<option value="pm">п.м.</option><option value="pcs">шт.</option>';
            } else {
                volumeUnit.innerHTML = '<option value="pcs">шт.</option><option value="pm">п.м.</option>';
            }
        }
    }

    /**
     * Handle example button click
     */
    function handleExampleClick(e) {
        e.preventDefault();
        const example = e.target.dataset.example;
        const textarea = document.getElementById('special_requirements');
        if (textarea && example) {
            if (textarea.value) {
                textarea.value += '\n' + example;
            } else {
                textarea.value = example;
            }
        }
    }

    /**
     * Phone formatting handled globally in main.js
     */

    /**
     * File upload: Handle drag over
     */
    function handleDragOver(e) {
        e.preventDefault();
        e.stopPropagation();
        fileDropzone.classList.add('dragover');
    }

    /**
     * File upload: Handle drag leave
     */
    function handleDragLeave(e) {
        e.preventDefault();
        e.stopPropagation();
        fileDropzone.classList.remove('dragover');
    }

    /**
     * File upload: Handle file drop
     */
    function handleFileDrop(e) {
        e.preventDefault();
        e.stopPropagation();
        fileDropzone.classList.remove('dragover');

        const files = e.dataTransfer.files;
        processFiles(files);
    }

    /**
     * File upload: Handle file select
     */
    function handleFileSelect(e) {
        const files = e.target.files;
        processFiles(files);
    }

    /**
     * Process uploaded files
     */
    function processFiles(files) {
        const errors = [];

        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            // Check max files
            if (uploadedFiles.length >= CONFIG.maxFiles) {
                errors.push(`Максимум ${CONFIG.maxFiles} файлов`);
                break;
            }

            // Check file size
            if (file.size > CONFIG.maxFileSize) {
                errors.push(`${file.name}: превышает 10 МБ`);
                continue;
            }

            // Check file type
            const ext = file.name.split('.').pop().toLowerCase();
            if (!CONFIG.allowedTypes.includes(ext)) {
                errors.push(`${file.name}: недопустимый формат`);
                continue;
            }

            // Check for duplicates
            if (uploadedFiles.some(f => f.name === file.name && f.size === file.size)) {
                errors.push(`${file.name}: файл уже добавлен`);
                continue;
            }

            // Add file to list
            uploadedFiles.push(file);
            renderFileItem(file);
        }

        if (errors.length > 0) {
            showError(errors.join('. '));
        }

        // Clear input
        if (fileInput) fileInput.value = '';
    }

    /**
     * Render file item in the list
     */
    function renderFileItem(file) {
        const item = document.createElement('div');
        item.className = 'quote-file-item';
        item.dataset.fileName = file.name;

        const sizeKB = (file.size / 1024).toFixed(1);
        const ext = file.name.split('.').pop().toLowerCase();

        // Check if it's an image for preview
        const isImage = ['jpg', 'jpeg', 'png'].includes(ext);
        let previewHtml = '';

        if (isImage) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = item.querySelector('.quote-file-item-preview');
                if (img) img.src = e.target.result;
            };
            reader.readAsDataURL(file);
            previewHtml = '<img class="quote-file-item-preview" src="" alt="Preview">';
        }

        item.innerHTML = `
            <div class="quote-file-item-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14,2 14,8 20,8"/>
                </svg>
            </div>
            <div class="quote-file-item-info">
                <div class="quote-file-item-name">${escapeHtml(file.name)}</div>
                <div class="quote-file-item-size">${sizeKB} КБ</div>
            </div>
            ${previewHtml}
            <button type="button" class="quote-file-item-remove" data-file="${escapeHtml(file.name)}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        `;

        // Bind remove button
        const removeBtn = item.querySelector('.quote-file-item-remove');
        if (removeBtn) {
            removeBtn.addEventListener('click', function () {
                removeFile(file.name);
                item.remove();
            });
        }

        fileList.appendChild(item);
    }

    /**
     * Remove file from uploaded list
     */
    function removeFile(fileName) {
        uploadedFiles = uploadedFiles.filter(f => f.name !== fileName);
    }

    /**
     * Handle form submission
     */
    function handleSubmit(e) {
        e.preventDefault();

        // Final validation
        if (!validateCurrentStep()) {
            return;
        }

        // Check consent
        const consent = form.querySelector('input[name="consent"]');
        if (consent && !consent.checked) {
            showError('Необходимо согласие на обработку персональных данных');
            return;
        }

        // Show loading
        showLoading(true);

        // Prepare FormData
        const formData = new FormData(form);
        formData.append('action', 'elinar_quote_form');

        // Add files
        uploadedFiles.forEach((file, index) => {
            formData.append(`files[${index}]`, file);
        });

        // Send request
        fetch(quoteFormAjax.ajaxurl, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                showLoading(false);

                if (data.success) {
                    // Clear saved data
                    clearSavedData();

                    // Show success message
                    showSuccess(data.data.message);
                } else {
                    showError(data.data.message || 'Произошла ошибка при отправке');
                }
            })
            .catch(error => {
                showLoading(false);
                showError('Ошибка сети. Пожалуйста, попробуйте позже.');
                console.error('Form submission error:', error);
            });
    }

    /**
     * Show/hide loading overlay
     */
    function showLoading(show) {
        if (loadingOverlay) {
            loadingOverlay.style.display = show ? 'flex' : 'none';
        }
    }

    /**
     * Show success message
     */
    function showSuccess(message) {
        if (successMessage) {
            const messageEl = successMessage.querySelector('p');
            if (messageEl && message) {
                messageEl.textContent = message;
            }
            form.style.display = 'none';
            document.querySelector('.quote-progress').style.display = 'none';
            document.querySelector('.quote-navigation').style.display = 'none';
            successMessage.style.display = 'block';
        }
    }

    /**
     * Show error message
     */
    function showError(message) {
        // Create toast notification
        const toast = document.createElement('div');
        toast.className = 'quote-toast quote-toast-error';
        toast.innerHTML = `
            <span class="quote-toast-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="15" y1="9" x2="9" y2="15"/>
                    <line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
            </span>
            <span class="quote-toast-message">${escapeHtml(message)}</span>
        `;

        // Add styles if not present
        if (!document.getElementById('quote-toast-styles')) {
            const styles = document.createElement('style');
            styles.id = 'quote-toast-styles';
            styles.textContent = `
                .quote-toast {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    padding: 1rem 1.5rem;
                    background: #fff;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                    z-index: 10000;
                    animation: slideIn 0.3s ease;
                    max-width: 400px;
                }
                .quote-toast-error {
                    border-left: 4px solid #ef4444;
                }
                .quote-toast-icon {
                    width: 24px;
                    height: 24px;
                    color: #ef4444;
                    flex-shrink: 0;
                }
                .quote-toast-icon svg {
                    width: 100%;
                    height: 100%;
                }
                .quote-toast-message {
                    font-size: 0.9375rem;
                    color: #334155;
                }
                @keyframes slideIn {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
            `;
            document.head.appendChild(styles);
        }

        document.body.appendChild(toast);

        // Remove after 5 seconds
        setTimeout(() => {
            toast.style.animation = 'slideIn 0.3s ease reverse';
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }

    /**
     * Reset form for new request
     */
    function resetForm() {
        // Clear form
        form.reset();

        // Clear uploaded files
        uploadedFiles = [];
        if (fileList) fileList.innerHTML = '';

        // Reset state
        currentStep = 0;
        selectedTechnology = null;

        // Hide tech-specific fields
        document.querySelectorAll('.tech-field').forEach(f => f.classList.remove('show'));

        // Show form, hide success
        form.style.display = 'block';
        document.querySelector('.quote-progress').style.display = 'block';
        document.querySelector('.quote-navigation').style.display = 'flex';
        successMessage.style.display = 'none';

        // Reset to first step
        showStep(0);

        // Clear saved data
        clearSavedData();
    }

    /**
     * Save form data to localStorage
     */
    function saveFormData() {
        try {
            const formData = new FormData(form);
            const data = {
                currentStep: currentStep,
                selectedTechnology: selectedTechnology,
                fields: {}
            };

            for (let [key, value] of formData.entries()) {
                if (key !== 'files[]' && key !== 'quote_nonce' && key !== 'website_url') {
                    data.fields[key] = value;
                }
            }

            localStorage.setItem(CONFIG.storageKey, JSON.stringify(data));

            // Show autosave indicator
            showAutosaveIndicator();
        } catch (e) {
            console.warn('Could not save form data:', e);
        }
    }

    /**
     * Load saved form data from localStorage
     */
    function loadSavedData() {
        try {
            const savedData = localStorage.getItem(CONFIG.storageKey);
            if (!savedData) return;

            const data = JSON.parse(savedData);

            // Restore fields
            if (data.fields) {
                Object.entries(data.fields).forEach(([key, value]) => {
                    const field = form.querySelector(`[name="${key}"]`);
                    if (field) {
                        if (field.type === 'radio' || field.type === 'checkbox') {
                            const fieldToCheck = form.querySelector(`[name="${key}"][value="${value}"]`);
                            if (fieldToCheck) fieldToCheck.checked = true;
                        } else {
                            field.value = value;
                        }
                    }
                });
            }

            // Restore technology selection
            if (data.selectedTechnology) {
                selectedTechnology = data.selectedTechnology;
                const techRadio = form.querySelector(`input[name="technology"][value="${selectedTechnology}"]`);
                if (techRadio) {
                    techRadio.checked = true;
                    updateTechFields();
                }
            }

            // Trigger conditional field updates
            const colorType = form.querySelector('input[name="color_type"]:checked');
            if (colorType) {
                handleColorTypeChange({ target: colorType });
            }

            const material = document.getElementById('material');
            if (material) {
                handleMaterialChange({ target: material });
            }

            const volume = form.querySelector('input[name="production_volume"]:checked');
            if (volume) {
                handleVolumeChange({ target: volume });
            }

            // Restore step (but start from beginning for better UX)
            currentStep = 0;
            showStep(currentStep);

        } catch (e) {
            console.warn('Could not load saved form data:', e);
        }
    }

    /**
     * Clear saved form data
     */
    function clearSavedData() {
        try {
            localStorage.removeItem(CONFIG.storageKey);
        } catch (e) {
            console.warn('Could not clear saved form data:', e);
        }
    }

    /**
     * Start autosave timer
     */
    function startAutosave() {
        if (autosaveTimer) clearInterval(autosaveTimer);

        autosaveTimer = setInterval(() => {
            // Only save if form has some data
            const technology = form.querySelector('input[name="technology"]:checked');
            const projectName = document.getElementById('project_name');

            if (technology || (projectName && projectName.value)) {
                saveFormData();
            }
        }, CONFIG.autosaveInterval);

        // Also save on input
        form.addEventListener('input', debounce(saveFormData, 1000));
        form.addEventListener('change', saveFormData);
    }

    /**
     * Show autosave indicator
     */
    function showAutosaveIndicator() {
        if (autosaveIndicator) {
            autosaveIndicator.classList.add('visible');
            setTimeout(() => {
                autosaveIndicator.classList.remove('visible');
            }, 2000);
        }
    }

    /**
     * Utility: Debounce function
     */
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    /**
     * Utility: Escape HTML
     */
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();

