document.addEventListener('click', (event) => {
  const openBtn = event.target.closest('[data-modal-open]');
  const closeBtn = event.target.closest('[data-modal-close]');

  if (openBtn) {
    const targetId = openBtn.getAttribute('data-modal-open');
    const modal = document.getElementById(targetId);
    if (modal) {
      modal.classList.add('is-open');
    }
  }

  if (closeBtn || event.target.classList.contains('modal')) {
    const modal = event.target.closest('.modal') || document.querySelector('.modal.is-open');
    if (modal) {
      modal.classList.remove('is-open');
    }
  }
});
