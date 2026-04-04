// ============================================
// Script.js v3.0 - FIXED VERSION
// ============================================
console.log('%c Script.js v3.0 CARGADO CORRECTAMENTE', 'background:#36DBCA;color:#000;font-size:14px;padding:4px 8px;');

// ===============================
// CONSTRUCTIVA EXPERIENCE - MAIN SCRIPT
// Version: 2.2 - Fixes: Modal, Form, Overlay
// ===============================

// ===============================
// EXPERTS SLIDER
// ===============================
const track = document.querySelector('.experts-slider-track');
const cards = document.querySelectorAll('.expert-card');
const nextBtn = document.querySelector('.nav.next');
const prevBtn = document.querySelector('.nav.prev');

let currentIndex = 0;
let autoplayInterval;

function updateSlider() {
    if (!track || cards.length === 0) return;

    cards.forEach(card => card.classList.remove('active'));

    const activeCard = cards[currentIndex];
    activeCard.classList.add('active');

    const containerWidth = track.parentElement.offsetWidth;
    const cardWidth = activeCard.offsetWidth;

    const cardOffset = activeCard.offsetLeft;
    const centerOffset = (containerWidth / 2) - (cardWidth / 2);
    const translateX = centerOffset - cardOffset;

    track.style.transform = `translateX(${translateX}px)`;

    const sliderContainer = document.querySelector('.experts-slider-container');
    if (sliderContainer) {
        sliderContainer.setAttribute('aria-label', 
            `Experto ${currentIndex + 1} de ${cards.length}: ${activeCard.querySelector('h3').textContent}`
        );
    }
}

function startAutoplay() {
    autoplayInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % cards.length;
        updateSlider();
    }, 10000);
}

function stopAutoplay() {
    clearInterval(autoplayInterval);
}

function restartAutoplay() {
    stopAutoplay();
    startAutoplay();
}

if (nextBtn && prevBtn) {
    nextBtn.addEventListener('click', () => {
        stopAutoplay();
        currentIndex = (currentIndex + 1) % cards.length;
        updateSlider();
        restartAutoplay();
    });

    prevBtn.addEventListener('click', () => {
        stopAutoplay();
        currentIndex = (currentIndex - 1 + cards.length) % cards.length;
        updateSlider();
        restartAutoplay();
    });
}

// TOUCH / SWIPE SUPPORT
let touchStartX = 0;
let touchEndX = 0;

if (track) {
    track.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    track.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });
}

function handleSwipe() {
    const swipeThreshold = 50;

    if (touchEndX < touchStartX - swipeThreshold) {
        stopAutoplay();
        currentIndex = (currentIndex + 1) % cards.length;
        updateSlider();
        restartAutoplay();
    }

    if (touchEndX > touchStartX + swipeThreshold) {
        stopAutoplay();
        currentIndex = (currentIndex - 1 + cards.length) % cards.length;
        updateSlider();
        restartAutoplay();
    }
}

// KEYBOARD NAVIGATION
document.addEventListener('keydown', (e) => {
    const sliderContainer = document.querySelector('.experts-slider-container');
    if (!sliderContainer) return;

    const rect = sliderContainer.getBoundingClientRect();
    const isInViewport = rect.top >= 0 && rect.bottom <= window.innerHeight;

    if (!isInViewport) return;

    if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
        e.preventDefault();
        stopAutoplay();
    }

    if (e.key === 'ArrowLeft') {
        currentIndex = (currentIndex - 1 + cards.length) % cards.length;
        updateSlider();
    } else if (e.key === 'ArrowRight') {
        currentIndex = (currentIndex + 1) % cards.length;
        updateSlider();
    }

    restartAutoplay();
});

// INIT SLIDER
window.addEventListener('load', () => {
    if (cards.length > 0) {
        updateSlider();
        startAutoplay();
    }
});

// RESIZE OPTIMIZATION
let resizeTimer;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
        updateSlider();
    }, 250);
});

// ===============================
// MODAL DE AGRADECIMIENTO
// ===============================
const thankYouModal = document.getElementById('thankYouModal');
const closeModal = document.getElementById('closeModal');
const closeModalBtn = document.getElementById('closeModalBtn');
const modalOverlay = thankYouModal ? thankYouModal.querySelector('.modal-overlay') : null;

function showThankYouModal() {
    if (thankYouModal) {
        thankYouModal.style.display = 'flex';
        thankYouModal.style.visibility = 'visible';
        thankYouModal.style.pointerEvents = 'auto';
        // Forzar reflow para que la transición funcione
        void thankYouModal.offsetHeight;
        thankYouModal.style.opacity = '1';
        thankYouModal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
}

function hideThankYouModal() {
    if (thankYouModal) {
        thankYouModal.style.opacity = '0';
        thankYouModal.classList.remove('show');
        document.body.style.overflow = '';
        setTimeout(() => {
            thankYouModal.style.display = 'none';
            thankYouModal.style.visibility = 'hidden';
            thankYouModal.style.pointerEvents = 'none';
        }, 300);
    }
}

if (closeModal) {
    closeModal.addEventListener('click', hideThankYouModal);
}

if (closeModalBtn) {
    closeModalBtn.addEventListener('click', hideThankYouModal);
}

// FIX: Cerrar al hacer click en el overlay (no en modal-content)
if (modalOverlay) {
    modalOverlay.addEventListener('click', hideThankYouModal);
}

// Cerrar con tecla ESC
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && thankYouModal && thankYouModal.classList.contains('show')) {
        hideThankYouModal();
    }
});

// ===============================
// FORM VALIDATION
// ===============================
const contactForm = document.getElementById('contactForm');

if (contactForm) {

    const validators = {
        nombre: (value) => {
            if (!value.trim()) return 'El nombre es requerido';
            if (value.trim().length < 3) return 'El nombre debe tener al menos 3 caracteres';
            if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(value)) return 'El nombre solo puede contener letras';
            return '';
        },
        email: (value) => {
            if (!value.trim()) return 'El email es requerido';
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) return 'Email inválido';
            return '';
        },
        tel: (value) => {
            if (!value.trim()) return 'El teléfono es requerido';
            const cleanPhone = value.replace(/\D/g, '');
            if (cleanPhone.length < 7) return 'Teléfono debe tener al menos 7 dígitos';
            if (cleanPhone.length > 15) return 'Teléfono demasiado largo';
            return '';
        },
        programa: (value) => {
            if (!value) return 'Selecciona un programa';
            return '';
        },
        profesion: (value) => {
            if (!value) return 'Selecciona tu profesión';
            return '';
        }
    };

    function showError(fieldName, message) {
        const field = document.getElementById(fieldName);
        const errorSpan = document.getElementById(fieldName + 'Error');
        if (field) {
            field.classList.add('error');
            field.setAttribute('aria-invalid', 'true');
        }
        if (errorSpan) {
            errorSpan.textContent = message;
        }
    }

    function clearError(fieldName) {
        const field = document.getElementById(fieldName);
        const errorSpan = document.getElementById(fieldName + 'Error');
        if (field) {
            field.classList.remove('error');
            field.setAttribute('aria-invalid', 'false');
        }
        if (errorSpan) {
            errorSpan.textContent = '';
        }
    }

    function showFormError(message) {
        let errorBox = document.getElementById('formGeneralError');
        if (!errorBox) {
            errorBox = document.createElement('div');
            errorBox.id = 'formGeneralError';
            errorBox.style.cssText = 'background: rgba(255,80,80,0.15); border: 1px solid rgba(255,80,80,0.5); color: #ff6b6b; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 14px; text-align: center;';
            contactForm.insertBefore(errorBox, contactForm.firstChild);
        }
        errorBox.textContent = message;
        errorBox.style.display = 'block';
        errorBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function hideFormError() {
        const errorBox = document.getElementById('formGeneralError');
        if (errorBox) errorBox.style.display = 'none';
    }

    // Validación en tiempo real
    ['nombre', 'email', 'tel', 'programa', 'profesion'].forEach(fieldName => {
        const field = document.getElementById(fieldName);
        if (!field) return;

        field.addEventListener('blur', () => {
            const error = validators[fieldName](field.value);
            if (error) {
                showError(fieldName, error);
            } else {
                clearError(fieldName);
            }
        });

        field.addEventListener('input', () => {
            if (field.classList.contains('error')) {
                const error = validators[fieldName](field.value);
                if (!error) clearError(fieldName);
            }
        });
    });

    // Formateo teléfono: solo números
    const telInput = document.getElementById('tel');
    if (telInput) {
        telInput.addEventListener('input', (e) => {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    }

    // ===============================
    // ENVÍO DEL FORMULARIO
    // ===============================
    contactForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        ['nombre', 'email', 'tel', 'programa', 'profesion'].forEach(clearError);
        hideFormError();

        let isValid = true;
        const formData = {};

        ['nombre', 'email', 'tel', 'programa', 'profesion'].forEach(fieldName => {
            const field = document.getElementById(fieldName);
            if (!field) return;
            const value = field.value;
            const error = validators[fieldName](value);
            if (error) {
                showError(fieldName, error);
                isValid = false;
            } else {
                formData[fieldName] = value;
            }
        });

        if (!isValid) {
            const firstError = contactForm.querySelector('.error');
            if (firstError) firstError.focus();
            return;
        }

        const submitBtn = document.getElementById('submitBtn');
        const btnText = submitBtn ? submitBtn.querySelector('.btn-text') : null;
        const btnLoading = submitBtn ? submitBtn.querySelector('.btn-loading') : null;

        if (btnText && btnLoading) {
            btnText.style.display = 'none';
            btnLoading.style.display = 'inline';
        }
        if (submitBtn) submitBtn.disabled = true;

        const formDataToSend = new FormData(contactForm);

        try {
            const response = await fetch('php/formulario.php', {
                method: 'POST',
                body: formDataToSend,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const contentType = response.headers.get('content-type');
            let result;

            if (contentType && contentType.includes('application/json')) {
                result = await response.json();
            } else {
                const text = await response.text();
                console.error('Respuesta no-JSON del servidor:', text);
                result = { success: false, message: 'Error del servidor. Intenta de nuevo.' };
            }

            if (btnText && btnLoading) {
                btnText.style.display = 'inline';
                btnLoading.style.display = 'none';
            }
            if (submitBtn) submitBtn.disabled = false;

            if (result.success) {
                showThankYouModal();
                contactForm.reset();
                hideFormError();
                console.log('✅ Formulario enviado:', formData);
            } else {
                showFormError(result.message || 'No se pudo enviar el formulario. Intenta de nuevo.');
            }

        } catch (error) {
            console.error('❌ Error al enviar:', error);
            if (btnText && btnLoading) {
                btnText.style.display = 'inline';
                btnLoading.style.display = 'none';
            }
            if (submitBtn) submitBtn.disabled = false;
            showFormError('No se pudo enviar el formulario en este momento. Intenta más tarde.');
        }
    });

} // fin if(contactForm)


// ===============================
// SMOOTH SCROLL FOR ANCHORS
// ===============================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        
        if (href === '#') {
            e.preventDefault();
            return;
        }

        const target = document.querySelector(href);
        
        if (target) {
            e.preventDefault();
            
            const headerOffset = 80;
            const elementPosition = target.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    });
});

// ===============================
// PERFORMANCE OPTIMIZATION
// ===============================
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }
                observer.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}

// ===============================
// VIEWPORT HEIGHT FIX FOR MOBILE
// ===============================
function setVH() {
    const vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}

setVH();
window.addEventListener('resize', debounce(setVH, 250));

// ===============================
// REDUCED MOTION SUPPORT
// ===============================
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

if (prefersReducedMotion.matches) {
    stopAutoplay();
}

// ===============================
// KEYBOARD NAVIGATION VISUAL FEEDBACK
// ===============================
document.addEventListener('keydown', function(e) {
    if (e.key === 'Tab') {
        document.body.classList.add('keyboard-navigation');
    }
});

document.addEventListener('mousedown', function() {
    document.body.classList.remove('keyboard-navigation');
});

// ===============================
// ERROR HANDLING
// ===============================
window.addEventListener('error', function(e) {
    console.error('JavaScript error:', e.error);
});

// ===============================
// CONSOLE MESSAGE
// ===============================
console.log('%c🏗️ Constructiva Experience', 'font-size: 20px; font-weight: bold; color: #36DBCA;');
console.log('%cLa plataforma para ingenieros y arquitectos', 'font-size: 14px; color: #1D756C;');
console.log('%cDesarrollado con ❤️', 'font-size: 12px; color: #36DBCA;');

// ===============================
// PAGE LOAD PERFORMANCE TRACKING
// ===============================
window.addEventListener('load', function() {
    document.body.classList.add('loaded');
    
    if ('performance' in window) {
        const perfData = window.performance.timing;
        const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
        console.log(`⚡ Página cargada en ${pageLoadTime}ms`);
    }
});

// ===============================
// PREVENT FORM RESUBMISSION ON RELOAD
// ===============================
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}