/**
 * Interatividade do blog — filtros, compartilhar e animações.
 */
(function () {
    'use strict';

    const filters = document.querySelectorAll('.blog-filter');

    function syncFilterAria(filter) {
        const summary = filter.querySelector('.blog-filter__toggle');
        if (!summary) {
            return;
        }

        summary.setAttribute('aria-expanded', filter.open ? 'true' : 'false');
    }

    function closeFilter(filter) {
        if (!filter.hasAttribute('open')) {
            return;
        }

        filter.removeAttribute('open');
        syncFilterAria(filter);
    }

    function initBlogFilters() {
        if (!filters.length) {
            return;
        }

        filters.forEach((filter) => {
            const summary = filter.querySelector('.blog-filter__toggle');
            const options = filter.querySelectorAll('.blog-filter__option');

            syncFilterAria(filter);

            filter.addEventListener('toggle', () => {
                if (filter.open) {
                    filters.forEach((other) => {
                        if (other !== filter) {
                            closeFilter(other);
                        }
                    });
                }

                syncFilterAria(filter);
            });

            filter.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && filter.open) {
                    event.preventDefault();
                    closeFilter(filter);
                    summary.focus();
                }
            });

            options.forEach((option, index) => {
                option.addEventListener('keydown', (event) => {
                    if (!filter.open) {
                        return;
                    }

                    if (event.key === 'ArrowDown') {
                        event.preventDefault();
                        options[Math.min(index + 1, options.length - 1)].focus();
                    } else if (event.key === 'ArrowUp') {
                        event.preventDefault();
                        options[Math.max(index - 1, 0)].focus();
                    } else if (event.key === 'Home') {
                        event.preventDefault();
                        options[0].focus();
                    } else if (event.key === 'End') {
                        event.preventDefault();
                        options[options.length - 1].focus();
                    }
                });
            });
        });

        document.addEventListener('click', (event) => {
            if (event.target.closest('.blog-filter')) {
                return;
            }

            filters.forEach(closeFilter);
        });
    }

    function showShareFeedback(button, message) {
        const originalLabel = button.getAttribute('aria-label');
        button.setAttribute('aria-label', message);
        button.classList.add('is-share-feedback');

        window.setTimeout(() => {
            button.setAttribute('aria-label', originalLabel);
            button.classList.remove('is-share-feedback');
        }, 2000);
    }

    async function sharePost(button) {
        const url = button.dataset.shareUrl;
        const title = button.dataset.shareTitle || document.title;

        if (!url) {
            return;
        }

        const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(`${title} ${url}`)}`;

        if (navigator.share) {
            try {
                await navigator.share({ title, url });
                return;
            } catch (error) {
                if (error && error.name === 'AbortError') {
                    return;
                }
            }
        }

        if (navigator.clipboard && navigator.clipboard.writeText) {
            try {
                await navigator.clipboard.writeText(url);
                showShareFeedback(button, 'Link copiado!');
                return;
            } catch (error) {
                // Fallback para WhatsApp abaixo.
            }
        }

        window.open(whatsappUrl, '_blank', 'noopener,noreferrer');
    }

    function initBlogShare() {
        document.querySelectorAll('[data-share-url]').forEach((button) => {
            button.addEventListener('click', () => {
                sharePost(button);
            });
        });
    }

    function initBlogAnimations() {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            return;
        }

        const animatedElements = document.querySelectorAll(
            '.blog-card, .blog-midia-card, .blog-conformidades-card, .blog-featured__grid'
        );

        if (!animatedElements.length) {
            return;
        }

        const blogObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) {
                        return;
                    }

                    entry.target.classList.add('is-visible');
                    blogObserver.unobserve(entry.target);
                });
            },
            {
                threshold: 0.12,
                rootMargin: '0px 0px -40px 0px',
            }
        );

        animatedElements.forEach((element, index) => {
            element.classList.add('blog-animate');
            element.style.transitionDelay = `${(index % 3) * 0.08}s`;
            blogObserver.observe(element);
        });
    }

    initBlogFilters();
    initBlogShare();
    initBlogAnimations();
})();
