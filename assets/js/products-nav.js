document.addEventListener('DOMContentLoaded', () => {
  const navLinks = document.querySelectorAll('.products-nav__link');
  const sections = document.querySelectorAll('article.product-row[id]');
  const nav = document.getElementById('products-nav');

  // Header height calculation (can be dynamic if needed)
  const getHeaderOffset = () => {
    // Try to get header height from variable or element
    const header = document.querySelector('header');
    return (header ? header.offsetHeight : 80) + (nav ? nav.offsetHeight : 60);
  };

  // 1. Smooth Scrolling on Click
  navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const targetId = link.getAttribute('href').substring(1);
      const targetSection = document.getElementById(targetId);

      if (targetSection) {
        const offsetPosition = targetSection.getBoundingClientRect().top + window.scrollY - getHeaderOffset() + 20; // +20 for breathing room

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });

        // Manually set active class immediately for responsiveness
        navLinks.forEach(l => l.classList.remove('active'));
        link.classList.add('active');
      }
    });
  });

  // 2. Scroll Spy using Intersection Observer
  const observerOptions = {
    root: null,
    rootMargin: `-${getHeaderOffset()}px 0px -50% 0px`, // Detect when section is roughly in the middle-top
    threshold: 0
  };

  const observerCallback = (entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Remove active from all
        navLinks.forEach(link => link.classList.remove('active'));

        // Add active to current
        const activeLink = document.querySelector(`.products-nav__link[data-target="${entry.target.id}"]`);
        if (activeLink) {
          activeLink.classList.add('active');

          // Scroll nav container if link is out of view (mobile)
          const container = document.querySelector('.products-sticky-nav__container');
          if (container) {
            const linkRect = activeLink.getBoundingClientRect();
            const containerRect = container.getBoundingClientRect();

            if (linkRect.left < containerRect.left || linkRect.right > containerRect.right) {
              activeLink.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
            }
          }
        }
      }
    });
  };

  const observer = new IntersectionObserver(observerCallback, observerOptions);

  sections.forEach(section => {
    observer.observe(section);
  });

});
