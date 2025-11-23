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
  const modal = document.getElementById("modal");
  const modalPanel = document.getElementById("modalPanel");
  const openModalBtn = document.getElementById("openModal");
  const closeModalBtn = document.getElementById("modalClose");
  const cancelModalBtn = document.getElementById("modalCancel");

  function openModal() {
    modal.classList.remove("opacity-0", "pointer-events-none");
    modalPanel.classList.remove("scale-95");
    modalPanel.classList.add("scale-100");
  }

  function closeModal() {
    modal.classList.add("opacity-0", "pointer-events-none");
    modalPanel.classList.remove("scale-100");
    modalPanel.classList.add("scale-95");
  }

  openModalBtn?.addEventListener("click", openModal);
  [closeModalBtn, cancelModalBtn].forEach((el) => {
    el?.addEventListener("click", closeModal);
  });

  modal?.addEventListener("click", (e) => {
    if (e.target === modal) closeModal();
  });
});
