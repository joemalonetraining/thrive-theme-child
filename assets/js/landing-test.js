(function () {
  const root = document.querySelector(".landing-test-page");
  if (!root) return;

  const icons = {
    award: '<circle cx="12" cy="8" r="5"></circle><path d="M8.5 12.5 7 22l5-3 5 3-1.5-9.5"></path>',
    "calendar-check": '<path d="M8 2v4"></path><path d="M16 2v4"></path><rect x="3" y="4" width="18" height="18" rx="2"></rect><path d="M3 10h18"></path><path d="m9 16 2 2 4-5"></path>',
    "clipboard-check": '<rect x="8" y="2" width="8" height="4" rx="1"></rect><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><path d="m9 14 2 2 4-5"></path>',
    crosshair: '<circle cx="12" cy="12" r="8"></circle><path d="M22 12h-4"></path><path d="M6 12H2"></path><path d="M12 6V2"></path><path d="M12 22v-4"></path>',
    "key-round": '<path d="M2 18a5 5 0 1 0 8.9-3.1L22 3l-3-1-2 2-2-1-2 2 1 2-5.1 5.1A5 5 0 0 0 2 18Z"></path><circle cx="7" cy="18" r="1"></circle>',
    "map-pin": '<path d="M12 22s7-5.2 7-12a7 7 0 1 0-14 0c0 6.8 7 12 7 12Z"></path><circle cx="12" cy="10" r="2.5"></circle>',
    "map-pinned": '<path d="M9 18 3 21V6l6-3 6 3 6-3v15l-6 3-6-3Z"></path><path d="M9 3v15"></path><path d="M15 6v15"></path><path d="M12 13s3-2.3 3-5a3 3 0 0 0-6 0c0 2.7 3 5 3 5Z"></path>',
    "monitor-play": '<rect x="3" y="4" width="18" height="13" rx="2"></rect><path d="M8 21h8"></path><path d="M12 17v4"></path><path d="m10 8 5 3-5 3V8Z"></path>',
    phone: '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.4 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2Z"></path>',
    route: '<circle cx="6" cy="19" r="3"></circle><circle cx="18" cy="5" r="3"></circle><path d="M9 19h4a5 5 0 0 0 0-10H9a3 3 0 0 1 0-6h6"></path>',
    send: '<path d="m22 2-7 20-4-9-9-4 20-7Z"></path><path d="M22 2 11 13"></path>',
    shield: '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"></path>',
    target: '<circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle>',
    "users-round": '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.9"></path><path d="M16 3.1a4 4 0 0 1 0 7.8"></path>'
  };

  root.querySelectorAll("[data-lucide]").forEach((node) => {
    const name = node.getAttribute("data-lucide");
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute("viewBox", "0 0 24 24");
    svg.setAttribute("fill", "none");
    svg.setAttribute("stroke", "currentColor");
    svg.setAttribute("stroke-linecap", "round");
    svg.setAttribute("stroke-linejoin", "round");
    svg.setAttribute("aria-hidden", "true");
    svg.innerHTML = icons[name] || icons.target;
    node.replaceWith(svg);
  });

  const stickyCta = root.querySelector(".mobile-sticky-cta");
  const hero = root.querySelector(".program-hero");
  const finalCta = root.querySelector(".cta-section");

  const updateStickyCta = () => {
    if (!stickyCta || !hero) return;

    const trigger = Math.max(280, hero.offsetHeight * 0.55);
    const finalCtaVisible = finalCta && finalCta.getBoundingClientRect().top < window.innerHeight * 0.9;
    stickyCta.classList.toggle("is-visible", window.scrollY > trigger && !finalCtaVisible);
  };

  updateStickyCta();
  window.addEventListener("scroll", updateStickyCta, { passive: true });
  window.addEventListener("resize", updateStickyCta);
})();
