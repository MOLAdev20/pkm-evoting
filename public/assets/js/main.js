document.addEventListener("DOMContentLoaded", () => {
  // Sidebar
  const sidebar = document.getElementById("sidebar");
  const sidebarToggle = document.getElementById("sidebarToggle");
  const sidebarClose = document.getElementById("sidebarClose");
  const sidebarBackdrop = document.getElementById("sidebarBackdrop");

  function openSidebar() {
    sidebar.classList.remove("-translate-x-full");
    sidebar.classList.add("translate-x-0");
    sidebarBackdrop.classList.remove("hidden");
    sidebarBackdrop.style.opacity = 1;
  }

  function closeSidebar() {
    sidebar.classList.add("-translate-x-full");
    sidebar.classList.remove("translate-x-0");
    sidebarBackdrop.classList.add("hidden");
    sidebarBackdrop.style.opacity = 0;
  }

  sidebarToggle?.addEventListener("click", openSidebar);
  [sidebarClose, sidebarBackdrop].forEach((el) => {
    el?.addEventListener("click", closeSidebar);
  });

  // Submenu
  document.querySelectorAll("[data-submenu-toggle]").forEach((btn) => {
    btn.addEventListener("click", () => {
      const target = document.querySelector(btn.dataset.submenuToggle);
      const arrow = btn.querySelector("[data-submenu-arrow]");

      target?.classList.toggle("hidden");
      arrow?.classList.toggle("rotate-180");
    });
  });

  // Modal
  function openModal(modal) {
    const panel = modal.querySelector("[data-modal-panel]");

    modal.classList.remove("opacity-0", "pointer-events-none");
    if (panel) {
      panel.classList.remove("scale-95");
      panel.classList.add("scale-100");
    }
  }

  function closeModal(modal) {
    const panel = modal.querySelector("[data-modal-panel]");

    modal.classList.add("opacity-0", "pointer-events-none");
    if (panel) {
      panel.classList.remove("scale-100");
      panel.classList.add("scale-95");
    }
  }

  document.addEventListener("click", (e) => {
    // 1) Buka modal
    const openBtn = e.target.closest("[data-modal-target]");
    if (openBtn) {
      const selector = openBtn.getAttribute("data-modal-target"); // contoh: "#editElectionModal"
      const modal = document.querySelector(selector);
      if (modal) openModal(modal);
      return;
    }

    // 2) Tutup modal lewat tombol dalam modal
    const closeBtn = e.target.closest("[data-modal-dismiss]");
    if (closeBtn) {
      const modal = closeBtn.closest("[data-modal]");
      if (modal) closeModal(modal);
      return;
    }

    // 3) Klik backdrop (area gelap)
    if (e.target.matches("[data-modal]")) {
      closeModal(e.target);
      return;
    }
  });
});
