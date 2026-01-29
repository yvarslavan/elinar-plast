document.addEventListener('DOMContentLoaded', () => {
  // Select all counter elements
  const counters = document.querySelectorAll('.stat-number');

  // Config
  const duration = 2000; // Animation duration in ms

  const animateCounter = (counter) => {
    const target = +counter.getAttribute('data-target');
    const start = 0;
    const startTime = performance.now();

    const updateCount = (currentTime) => {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);

      // Easing function (easeOutQuart)
      const ease = 1 - Math.pow(1 - progress, 4);

      const current = Math.floor(ease * target);

      // Format number (e.g., 20+ or 500+)
      const suffix = counter.getAttribute('data-suffix') || '';
      const prefix = counter.getAttribute('data-prefix') || '';

      counter.innerText = `${prefix}${current}${suffix}`;

      if (progress < 1) {
        requestAnimationFrame(updateCount);
      } else {
        counter.innerText = `${prefix}${target}${suffix}`; // Ensure final value is exact
      }
    };

    requestAnimationFrame(updateCount);
  };

  // Intersection Observer to trigger animation
  const observerOptions = {
    threshold: 0.5 // Trigger when 50% visible
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const counter = entry.target;
        animateCounter(counter);
        observer.unobserve(counter); // Only run once
      }
    });
  }, observerOptions);

  counters.forEach(counter => {
    observer.observe(counter);
  });
});
