/**
 * Audit Form JavaScript - Modern Cloud Upload
 * Обработка формы "Получите экспертный аудит вашего изделия"
 * С поддержкой drag-and-drop и множественной загрузки файлов
 */

(function () {
    'use strict';

    // Очищаем URL от параметров формы после загрузки
    if (window.location.search.includes('form=')) {
        const cleanUrl = window.location.pathname + window.location.hash;
        window.history.replaceState({}, document.title, cleanUrl);
    }

    // Phone mask is handled globally in main.js

    // ============================================
    // MODERN CLOUD UPLOAD WITH DRAG & DROP
    // ============================================

    const uploadZone = document.getElementById('cloud-upload-zone');
    const fileInput = document.getElementById('form-file');
    const browseBtn = document.getElementById('upload-browse-btn');
    const filesList = document.getElementById('upload-files-list');
    const fileError = document.getElementById('file-error');

    if (!uploadZone || !fileInput || !filesList) {
        console.warn('Cloud upload elements not found');
        return;
    }

    // Configuration
    const allowedExtensions = ['.pdf', '.dwg', '.dxf', '.step', '.stp', '.jpg', '.jpeg', '.png', '.zip', '.iges', '.igs', '.stl'];
    const maxSize = 15 * 1024 * 1024; // 15 MB
    const maxFiles = 5; // Maximum number of files
    let uploadedFiles = [];

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Highlight drop zone when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        uploadZone.classList.add('dragover');
    }

    function unhighlight(e) {
        uploadZone.classList.remove('dragover');
    }

    // Handle dropped files
    uploadZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    // Handle browse button click
    if (browseBtn) {
        browseBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            fileInput.click();
        });
    }

    // Handle click on upload zone
    uploadZone.addEventListener('click', function (e) {
        // Don't trigger if clicking on browse button
        if (e.target !== browseBtn && !browseBtn.contains(e.target)) {
            fileInput.click();
        }
    });

    // Handle file input change
    fileInput.addEventListener('change', function () {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        if (!files || files.length === 0) return;

        // Clear previous errors
        if (fileError) fileError.textContent = '';

        // Convert FileList to Array
        const filesArray = Array.from(files);

        // Check total files limit
        if (uploadedFiles.length + filesArray.length > maxFiles) {
            if (fileError) {
                fileError.textContent = `Максимум ${maxFiles} файлов. Удалите существующие файлы перед добавлением новых.`;
            }
            return;
        }

        // Validate and add each file
        filesArray.forEach(file => {
            if (validateFile(file)) {
                addFile(file);
            }
        });

        // Reset file input
        fileInput.value = '';
    }

    function validateFile(file) {
        const ext = '.' + file.name.split('.').pop().toLowerCase();

        // Check extension
        if (!allowedExtensions.includes(ext)) {
            if (fileError) {
                fileError.textContent = `Недопустимый формат файла: ${file.name}`;
            }
            return false;
        }

        // Check size
        if (file.size > maxSize) {
            if (fileError) {
                fileError.textContent = `Файл слишком большой: ${file.name}. Максимум 15 МБ.`;
            }
            return false;
        }

        // Check if file already added
        if (uploadedFiles.some(f => f.name === file.name && f.size === file.size)) {
            if (fileError) {
                fileError.textContent = `Файл уже добавлен: ${file.name}`;
            }
            return false;
        }

        return true;
    }

    function addFile(file) {
        // Add to uploaded files array
        uploadedFiles.push(file);

        // Create file item element
        const fileItem = createFileItem(file);
        filesList.appendChild(fileItem);

        // Simulate upload progress
        simulateUpload(fileItem, file);
    }

    function createFileItem(file) {
        const item = document.createElement('div');
        item.className = 'upload-file-item';
        item.dataset.fileName = file.name;

        const sizeMB = (file.size / 1024 / 1024).toFixed(2);

        item.innerHTML = `
            <div class="file-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14,2 14,8 20,8"/>
                </svg>
            </div>
            <div class="file-info-content">
                <p class="file-name">${escapeHtml(file.name)}</p>
                <p class="file-size">${sizeMB} МБ</p>
                <div class="file-progress">
                    <div class="file-progress-bar" style="width: 0%"></div>
                </div>
            </div>
            <div class="file-status uploading">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" opacity="0.25"/>
                    <path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round">
                        <animateTransform attributeName="transform" type="rotate" from="0 12 12" to="360 12 12" dur="1s" repeatCount="indefinite"/>
                    </path>
                </svg>
            </div>
            <button type="button" class="file-remove-btn" aria-label="Удалить файл">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        `;

        // Add remove button handler
        const removeBtn = item.querySelector('.file-remove-btn');
        removeBtn.addEventListener('click', function () {
            removeFile(file.name, item);
        });

        return item;
    }

    function simulateUpload(fileItem, file) {
        const progressBar = fileItem.querySelector('.file-progress-bar');
        const statusIcon = fileItem.querySelector('.file-status');
        let progress = 0;

        // Simulate upload progress
        const interval = setInterval(() => {
            progress += Math.random() * 30;
            if (progress > 100) progress = 100;

            progressBar.style.width = progress + '%';

            if (progress >= 100) {
                clearInterval(interval);
                completeUpload(fileItem);
            }
        }, 200);
    }

    function completeUpload(fileItem) {
        const progressBar = fileItem.querySelector('.file-progress-bar');
        const statusIcon = fileItem.querySelector('.file-status');

        // Mark as complete
        progressBar.classList.add('complete');
        statusIcon.classList.remove('uploading');
        statusIcon.classList.add('complete');

        // Replace spinner with checkmark
        statusIcon.innerHTML = `
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
        `;
    }

    function removeFile(fileName, fileItem) {
        // Remove from array
        uploadedFiles = uploadedFiles.filter(f => f.name !== fileName);

        // Remove from DOM with animation
        fileItem.style.opacity = '0';
        fileItem.style.transform = 'translateX(20px)';
        setTimeout(() => {
            fileItem.remove();
        }, 300);

        // Clear error if any
        if (fileError) fileError.textContent = '';
    }

    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    // ============================================
    // FORM SUBMISSION
    // ============================================

    const projectForm = document.getElementById('project-form');
    const submitBtn = document.getElementById('submit-btn');

    if (projectForm && submitBtn) {
        projectForm.addEventListener('submit', function (e) {
            // Проверяем валидность формы перед показом индикации
            if (!projectForm.checkValidity()) {
                return; // Браузер покажет стандартные ошибки валидации
            }

            // Предотвращаем повторную отправку
            if (submitBtn.classList.contains('is-submitting')) {
                e.preventDefault();
                return;
            }

            // Если есть загруженные файлы, нужно их прикрепить к форме
            if (uploadedFiles.length > 0) {
                e.preventDefault();

                // Create FormData
                const formData = new FormData(projectForm);

                // Remove old attachment field
                formData.delete('attachment[]');

                // Add all uploaded files
                uploadedFiles.forEach((file, index) => {
                    formData.append('attachment[]', file);
                });

                // Add loading state
                submitBtn.classList.add('is-submitting');
                submitBtn.disabled = true;
                const originalContent = submitBtn.innerHTML;
                submitBtn.setAttribute('data-original-content', originalContent);
                submitBtn.innerHTML = `
                    <span class="submit-spinner"></span>
                    <span>Заявка отправляется...</span>
                `;

                // Submit form via AJAX
                fetch(projectForm.action || window.location.href, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        // Allow form to submit normally
                        projectForm.submit();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Restore button
                        submitBtn.classList.remove('is-submitting');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalContent;
                        if (fileError) {
                            fileError.textContent = 'Ошибка отправки. Попробуйте снова.';
                        }
                    });
            } else {
                // No files, submit normally
                submitBtn.classList.add('is-submitting');
                submitBtn.disabled = true;
                const originalContent = submitBtn.innerHTML;
                submitBtn.setAttribute('data-original-content', originalContent);
                submitBtn.innerHTML = `
                    <span class="submit-spinner"></span>
                    <span>Заявка отправляется...</span>
                `;
            }
        });

        // Восстанавливаем кнопку при возврате на страницу (bfcache)
        window.addEventListener('pageshow', function (e) {
            if (e.persisted && submitBtn.classList.contains('is-submitting')) {
                submitBtn.classList.remove('is-submitting');
                submitBtn.disabled = false;
                const originalContent = submitBtn.getAttribute('data-original-content');
                if (originalContent) {
                    submitBtn.innerHTML = originalContent;
                }
            }
        });
    }
})();
