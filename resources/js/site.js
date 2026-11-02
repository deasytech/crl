// Progressive enhancement only: the site is fully usable without this script.
const root = document.documentElement;

if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches && 'IntersectionObserver' in window) {
    root.classList.add('js');

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { rootMargin: '0px 0px -8% 0px', threshold: 0.05 },
    );

    document.querySelectorAll('[data-reveal]').forEach((el) => observer.observe(el));
}

// Mobile navigation.
const toggle = document.querySelector('[data-nav-toggle]');
const panel = document.querySelector('[data-nav-panel]');

if (toggle && panel) {
    const setOpen = (open) => {
        toggle.setAttribute('aria-expanded', String(open));
        panel.hidden = !open;
        document.body.classList.toggle('overflow-hidden', open);
    };

    toggle.addEventListener('click', () => setOpen(toggle.getAttribute('aria-expanded') !== 'true'));
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
            setOpen(false);
            toggle.focus();
        }
    });
    panel.querySelectorAll('a').forEach((a) => a.addEventListener('click', () => setOpen(false)));
}

// Project image viewer: a native <dialog> gives focus trapping and Escape-to-close.
const dialog = document.querySelector('[data-lightbox-dialog]');

if (dialog && typeof dialog.showModal === 'function') {
    const photos = JSON.parse(dialog.querySelector('[data-lightbox-data]').textContent);
    const image = dialog.querySelector('[data-lightbox-image]');
    const caption = dialog.querySelector('[data-lightbox-caption]');
    let index = 0;
    let opener = null;

    const show = (i) => {
        index = (i + photos.length) % photos.length;
        image.src = photos[index].src;
        image.alt = photos[index].alt;
        caption.textContent = photos[index].caption ?? '';
    };

    document.querySelectorAll('[data-lightbox]').forEach((button) => {
        button.addEventListener('click', () => {
            opener = button;
            show(Number(button.dataset.lightbox));
            dialog.showModal();
        });
    });

    dialog.querySelector('[data-lightbox-prev]').addEventListener('click', () => show(index - 1));
    dialog.querySelector('[data-lightbox-next]').addEventListener('click', () => show(index + 1));
    dialog.querySelector('[data-lightbox-close]').addEventListener('click', () => dialog.close());
    dialog.addEventListener('click', (e) => e.target === dialog && dialog.close());
    dialog.addEventListener('close', () => opener?.focus());
    dialog.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') show(index - 1);
        if (e.key === 'ArrowRight') show(index + 1);
    });
}

// Move focus to the form feedback so screen reader and keyboard users land on it.
document.querySelector('[data-form-errors]')?.focus();
if (document.querySelector('[role="status"]')?.closest('#enquiry')) {
    document.getElementById('enquiry').focus();
}
