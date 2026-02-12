// Menu fixo ao scroll
const header = document.getElementById('header');
let lastScroll = 0;

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll > 100) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
    
    lastScroll = currentScroll;
});

// Carrossel do Hero (apenas na página principal)
const heroSlides = document.querySelectorAll('.hero-slide');
const indicators = document.querySelectorAll('.indicator');
let currentSlide = 0;
let slideInterval;

if (heroSlides.length > 0 && indicators.length > 0) {
    function showSlide(index) {
        // Remove active de todos os slides e indicadores
        heroSlides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        // Adiciona active ao slide e indicador atual
        heroSlides[index].classList.add('active');
        indicators[index].classList.add('active');
        
        currentSlide = index;
    }

    function nextSlide() {
        const next = (currentSlide + 1) % heroSlides.length;
        showSlide(next);
    }

    function startCarousel() {
        slideInterval = setInterval(nextSlide, 5000); // Troca a cada 5 segundos
    }

    function stopCarousel() {
        clearInterval(slideInterval);
    }

    // Adiciona eventos aos indicadores
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            stopCarousel();
            showSlide(index);
            startCarousel();
        });
    });

    // Pausa o carrossel quando o mouse está sobre o hero
    const hero = document.querySelector('.hero');
    if (hero) {
        hero.addEventListener('mouseenter', stopCarousel);
        hero.addEventListener('mouseleave', startCarousel);
    }

    // Inicia o carrossel
    startCarousel();
}

// Smooth scroll para links de navegação
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && href !== '#contato') {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                const headerOffset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        }
    });
});

// Botão "Solicite mais"
const soliciteMaisBtn = document.getElementById('solicite-mais');
if (soliciteMaisBtn) {
    soliciteMaisBtn.addEventListener('click', () => {
        // Pode abrir um modal de contato ou redirecionar para um formulário
        const whatsappUrl = 'https://wa.me/553125367500?text=Olá! Gostaria de solicitar mais informações sobre os serviços da Liderban.';
        window.open(whatsappUrl, '_blank');
    });
}

// Animação de entrada ao scroll (Intersection Observer)
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Aplica animação aos elementos da página principal
document.querySelectorAll('.servico-card, .partner-card, .solucoes-image, .water-content, .atuacao-text').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
});

// Aplica animação aos cards de soluções (página de soluções)
document.querySelectorAll('.solution-card').forEach((el, index) => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
    observer.observe(el);
});

// Modais de Soluções
document.querySelectorAll('.solution-card[data-modal]').forEach(card => {
    card.addEventListener('click', (e) => {
        e.preventDefault();
        const modalId = card.getAttribute('data-modal');
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    });
});

// Fechar modal ao clicar no X
document.querySelectorAll('.solucao-modal-close').forEach(btn => {
    btn.addEventListener('click', () => {
        const overlay = btn.closest('.solucao-modal-overlay');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    });
});

// Fechar modal ao clicar fora (no overlay)
document.querySelectorAll('.solucao-modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
});

// Fechar modal com tecla ESC
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        document.querySelectorAll('.solucao-modal-overlay.active').forEach(overlay => {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
});

// Adiciona comportamento ao ícone de contato flutuante
const contactIcon = document.querySelector('.floating-icon.contact');
if (contactIcon) {
    contactIcon.addEventListener('click', (e) => {
        e.preventDefault();
        const footer = document.querySelector('.footer');
        if (footer) {
            footer.scrollIntoView({ behavior: 'smooth' });
        }
    });
}
