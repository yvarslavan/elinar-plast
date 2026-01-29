document.addEventListener('DOMContentLoaded', function () {
  const scrollBtns = document.querySelectorAll('.scroll-down-btn');

  scrollBtns.forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();

      // Find the parent wrapper
      const wrapper = this.closest('.scroll-down-wrapper');
      // Find the container section (hero)
      // We look for commonly used hero class names or just the closest section/header
      let currentSection = wrapper.closest('section') || wrapper.closest('.page-hero') || wrapper.closest('.hero-panorama-container') || wrapper.closest('header');

      if (currentSection) {
        // Try to find the next section sibling
        let nextSection = currentSection.nextElementSibling;

        // Skip script, style, and empty text nodes if they appear as siblings (though element sibling checks usually skip text)
        while (nextSection && (nextSection.tagName === 'SCRIPT' || nextSection.tagName === 'STYLE' || nextSection.offsetHeight === 0)) {
          nextSection = nextSection.nextElementSibling;
        }

        if (nextSection) {
          const headerOffset = 60; // Approximate header height
          const elementPosition = nextSection.getBoundingClientRect().top;
          const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

          window.scrollTo({
            top: offsetPosition,
            behavior: "smooth"
          });
        } else {
          // Fallback if no next section is found, maybe scroll by window height
          window.scrollTo({
            top: window.innerHeight,
            behavior: "smooth"
          });
        }
      } else {
        // Fallback if structure is weird
        window.scrollTo({
          top: window.innerHeight,
          behavior: "smooth"
        });
      }
    });
  });
});
