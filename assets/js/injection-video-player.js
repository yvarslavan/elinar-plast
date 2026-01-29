/**
 * Injection Molding Video Player
 * Кастомный видеоплеер с управлением
 */

(function() {
    'use strict';

    console.log('[InjectionVideoPlayer] Loading...');

    function initVideoPlayer() {
        const player = document.querySelector('.injection-video-player');
        if (!player) {
            console.log('[InjectionVideoPlayer] Player not found');
            return;
        }

        const video = player.querySelector('video');
        const playOverlay = player.querySelector('.video-play-overlay');
        const playPauseBtn = player.querySelector('.video-play-pause');
        const muteBtn = player.querySelector('.video-mute');
        const progressBar = player.querySelector('.video-progress-bar');
        const progressFill = player.querySelector('.video-progress-fill');
        const timeDisplay = player.querySelector('.video-time');

        if (!video) {
            console.error('[InjectionVideoPlayer] Video element not found');
            return;
        }

        // Форматирование времени
        function formatTime(seconds) {
            const mins = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${mins}:${secs.toString().padStart(2, '0')}`;
        }

        // Обновление времени
        function updateTime() {
            if (video.duration) {
                const current = formatTime(video.currentTime);
                const total = formatTime(video.duration);
                timeDisplay.textContent = `${current} / ${total}`;
            }
        }

        // Обновление прогресс-бара
        function updateProgress() {
            if (video.duration) {
                const percent = (video.currentTime / video.duration) * 100;
                progressFill.style.width = `${percent}%`;
            }
        }

        // Play/Pause
        function togglePlay() {
            if (video.paused) {
                video.play();
                player.classList.add('is-playing');
                if (playPauseBtn) {
                    playPauseBtn.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"/>
                        </svg>
                    `;
                }
            } else {
                video.pause();
                player.classList.remove('is-playing');
                if (playPauseBtn) {
                    playPauseBtn.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    `;
                }
            }
        }

        // Mute/Unmute
        function toggleMute() {
            video.muted = !video.muted;
            if (muteBtn) {
                muteBtn.innerHTML = video.muted ? `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 5L6 9H2v6h4l5 4V5zM23 9l-6 6M17 9l6 6"/>
                    </svg>
                ` : `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 5L6 9H2v6h4l5 4V5zM19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"/>
                    </svg>
                `;
            }
        }

        // Seek
        function seek(e) {
            const rect = progressBar.getBoundingClientRect();
            const pos = (e.clientX - rect.left) / rect.width;
            video.currentTime = pos * video.duration;
        }

        // Event Listeners
        if (playOverlay) {
            playOverlay.addEventListener('click', togglePlay);
        }

        if (playPauseBtn) {
            playPauseBtn.addEventListener('click', togglePlay);
        }

        if (muteBtn) {
            muteBtn.addEventListener('click', toggleMute);
        }

        if (progressBar) {
            progressBar.addEventListener('click', seek);
        }

        // Video Events
        video.addEventListener('timeupdate', () => {
            updateProgress();
            updateTime();
        });

        video.addEventListener('loadedmetadata', updateTime);

        video.addEventListener('ended', () => {
            player.classList.remove('is-playing');
            if (playPauseBtn) {
                playPauseBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                `;
            }
        });

        // Keyboard controls
        document.addEventListener('keydown', (e) => {
            if (!player.matches(':hover')) return;
            
            if (e.code === 'Space') {
                e.preventDefault();
                togglePlay();
            } else if (e.code === 'KeyM') {
                toggleMute();
            }
        });

        console.log('[InjectionVideoPlayer] Initialized');
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initVideoPlayer);
    } else {
        initVideoPlayer();
    }

    console.log('[InjectionVideoPlayer] Loaded');
})();
