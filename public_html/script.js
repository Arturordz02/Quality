/**
 * QUALITY CONSULTING SOLUTIONS - COMPORTAMIENTO INTERACTIVO (script.js)
 * Manejo de navegación responsive con Bootstrap 5, auto-cierre de menú móvil,
 * soporte de submenús táctiles, selector flotante de WhatsApp y validación de formularios.
 */

document.addEventListener('DOMContentLoaded', () => {
    // --- 1. REFERENCIAS AL DOM ---
    const mainHeader = document.getElementById('mainHeader');
    const mobileToggleBtn = document.getElementById('mobileToggleBtn');
    const navbarCollapse = document.getElementById('navbarQuality');
    const mobileOverlay = document.getElementById('mobileOverlay');
    const dropdownToggles = document.querySelectorAll('.nav-item.dropdown > .dropdown-toggle');
    const submenuToggles = document.querySelectorAll('.dropdown-submenu > .submenu-toggle');
    const navLinks = document.querySelectorAll('#navbarQuality a:not(.dropdown-toggle):not(.submenu-toggle), .nav-menu a:not(.dropdown-toggle):not(.submenu-toggle)');

    // --- 2. GESTIÓN DEL MENÚ RESPONSIVE CON BOOTSTRAP 5 ---
    if (navbarCollapse) {
        // Sincronizar animación del botón hamburguesa y overlay con eventos nativos de Bootstrap
        navbarCollapse.addEventListener('show.bs.collapse', () => {
            if (mobileToggleBtn) {
                mobileToggleBtn.classList.add('is-active');
                mobileToggleBtn.setAttribute('aria-expanded', 'true');
            }
            if (mobileOverlay) mobileOverlay.classList.add('active');
            document.body.classList.add('mobile-nav-open');
        });

        navbarCollapse.addEventListener('hide.bs.collapse', () => {
            if (mobileToggleBtn) {
                mobileToggleBtn.classList.remove('is-active');
                mobileToggleBtn.setAttribute('aria-expanded', 'false');
            }
            if (mobileOverlay) mobileOverlay.classList.remove('active');
            document.body.classList.remove('mobile-nav-open');

            // Cerrar submenús abiertos al colapsar
            document.querySelectorAll('.dropdown-submenu.is-open, .dropdown-submenu.show').forEach(el => {
                el.classList.remove('is-open', 'show');
                const lat = el.querySelector('.dropdown-menu-lateral');
                if (lat) lat.classList.remove('show');
            });
        });
    }

    // Cerrar menú móvil al hacer clic en el overlay
    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', () => {
            if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse) || new bootstrap.Collapse(navbarCollapse, { toggle: false });
                    bsCollapse.hide();
                } else {
                    navbarCollapse.classList.remove('show');
                    if (mobileToggleBtn) mobileToggleBtn.classList.remove('is-active');
                    mobileOverlay.classList.remove('active');
                }
            }
        });
    }

    // --- 3. CIERRE AUTOMÁTICO AL HACER CLIC EN ENLACES EN MÓVIL ---
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 992 && navbarCollapse && navbarCollapse.classList.contains('show')) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse) || new bootstrap.Collapse(navbarCollapse, { toggle: false });
                    bsCollapse.hide();
                } else {
                    navbarCollapse.classList.remove('show');
                    if (mobileToggleBtn) mobileToggleBtn.classList.remove('is-active');
                    if (mobileOverlay) mobileOverlay.classList.remove('active');
                }
            }
        });
    });

    // --- 4. GESTIÓN DE DROPDOWNS Y SUBMENÚS (TÁCTIL & ESCRITORIO) ---
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            if (window.innerWidth < 992) {
                // En móviles, permitir que actúe como acordeón sin interferir
                const parentDropdown = this.closest('.dropdown');
                if (parentDropdown) {
                    document.querySelectorAll('.nav-item.dropdown').forEach(item => {
                        if (item !== parentDropdown) {
                            item.classList.remove('show', 'is-open');
                            const otherToggle = item.querySelector('.dropdown-toggle');
                            if (otherToggle) otherToggle.setAttribute('aria-expanded', 'false');
                            const otherMenu = item.querySelector('.dropdown-menu');
                            if (otherMenu) otherMenu.classList.remove('show');
                        }
                    });
                }
            }
        });
    });

    // Submenú lateral (MÁS... -> INVESTIGACION)
    submenuToggles.forEach(subToggle => {
        subToggle.addEventListener('click', function (e) {
            if (window.innerWidth < 992) {
                e.preventDefault();
                e.stopPropagation();
                const parentSubmenu = this.closest('.dropdown-submenu');
                if (parentSubmenu) {
                    const isOpen = parentSubmenu.classList.contains('is-open') || parentSubmenu.classList.contains('show');
                    if (isOpen) {
                        parentSubmenu.classList.remove('is-open', 'show');
                        const latMenu = parentSubmenu.querySelector('.dropdown-menu-lateral');
                        if (latMenu) latMenu.classList.remove('show');
                    } else {
                        parentSubmenu.classList.add('is-open', 'show');
                        const latMenu = parentSubmenu.querySelector('.dropdown-menu-lateral');
                        if (latMenu) latMenu.classList.add('show');
                    }
                }
            }
        });
    });

    // --- 5. EFECTO DE SCROLL EN EL HEADER (GLASSMORPHISM DINÁMICO) ---
    const handleScroll = () => {
        if (!mainHeader) return;
        if (window.scrollY > 20) {
            mainHeader.classList.add('scrolled');
        } else {
            mainHeader.classList.remove('scrolled');
        }
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll(); // Ejecutar al cargar

    // --- 6. GESTIÓN DE ACCESIBILIDAD Y REDIMENSIONAMIENTO ---
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse) || new bootstrap.Collapse(navbarCollapse, { toggle: false });
                    bsCollapse.hide();
                }
            }
            const floatingWidget = document.getElementById('whatsappFloatingWidget');
            if (floatingWidget && floatingWidget.classList.contains('is-open')) {
                floatingWidget.classList.remove('is-open');
            }
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992 && navbarCollapse && navbarCollapse.classList.contains('show')) {
            if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse) || new bootstrap.Collapse(navbarCollapse, { toggle: false });
                bsCollapse.hide();
            }
        }
    });

    // --- 7. SELECTOR FLOTANTE MULTIPAÍS DE WHATSAPP (Zero Dead-Space) ---
    let floatingWidget = document.getElementById('whatsappFloatingWidget');
    if (!floatingWidget) {
        const widgetHTML = `
        <div class="whatsapp-floating-widget" id="whatsappFloatingWidget">
            <div class="whatsapp-floating-menu" id="whatsappFloatingMenu" aria-hidden="true">
                <div class="whatsapp-menu-header">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fab fa-whatsapp fs-5 text-white"></i>
                            <span class="fw-bold text-white font-montserrat" style="font-size: 0.95rem;">Atención WhatsApp</span>
                        </div>
                        <button class="whatsapp-close-btn" id="whatsappCloseBtn" aria-label="Cerrar ventana de WhatsApp">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <span class="small text-light text-opacity-75" style="font-size: 0.78rem;">Selecciona tu país de contacto:</span>
                </div>
                <div class="whatsapp-menu-body">
                    <a href="https://api.whatsapp.com/send?phone=51993463118&text=Buen%20d%C3%ADa%20Quality%20Consulting%20Solutions,%20deseo%20informaci%C3%B3n%20de%20sus%20servicios/cursos" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                        <span class="country-flag">🇵🇪</span>
                        <div class="country-info">
                            <span class="country-name">Perú (Central)</span>
                            <span class="country-phone">+51 993 463 118</span>
                        </div>
                        <i class="fas fa-chevron-right arrow-go"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=56990760986&text=Buen%20d%C3%ADa%20Quality%20Consulting%20Solutions,%20deseo%20informaci%C3%B3n%20de%20sus%20servicios/cursos" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                        <span class="country-flag">🇨🇱</span>
                        <div class="country-info">
                            <span class="country-name">Chile</span>
                            <span class="country-phone">+56 9 9076 0986</span>
                        </div>
                        <i class="fas fa-chevron-right arrow-go"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=573152276029&text=Buen%20d%C3%ADa%20Quality%20Consulting%20Solutions,%20deseo%20informaci%C3%B3n%20de%20sus%20servicios/cursos" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                        <span class="country-flag">🇪🇨</span>
                        <div class="country-info">
                            <span class="country-name">Ecuador</span>
                            <span class="country-phone">+57 315 227 6029</span>
                        </div>
                        <i class="fas fa-chevron-right arrow-go"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=50768195911&text=Buen%20d%C3%ADa%20Quality%20Consulting%20Solutions,%20deseo%20informaci%C3%B3n%20de%20sus%20servicios/cursos" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                        <span class="country-flag">🇵🇦</span>
                        <div class="country-info">
                            <span class="country-name">Panamá</span>
                            <span class="country-phone">+507 6819 5911</span>
                        </div>
                        <i class="fas fa-chevron-right arrow-go"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=525537208429&text=Buen%20d%C3%ADa%20Quality%20Consulting%20Solutions,%20deseo%20informaci%C3%B3n%20de%20sus%20servicios/cursos" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                        <span class="country-flag">🇲🇽</span>
                        <div class="country-info">
                            <span class="country-name">México</span>
                            <span class="country-phone">+52 55 3720 8429</span>
                        </div>
                        <i class="fas fa-chevron-right arrow-go"></i>
                    </a>
                </div>
            </div>
            <button class="whatsapp-floating-btn" id="whatsappFloatingBtn" aria-label="Contactar por WhatsApp" aria-expanded="false">
                <i class="fab fa-whatsapp"></i>
                <span class="whatsapp-floating-pulse"></span>
            </button>
        </div>`;
        document.body.insertAdjacentHTML('beforeend', widgetHTML);
        floatingWidget = document.getElementById('whatsappFloatingWidget');
    }

    const floatingBtn = document.getElementById('whatsappFloatingBtn');
    const closeBtn = document.getElementById('whatsappCloseBtn');
    const floatingMenu = document.getElementById('whatsappFloatingMenu');

    if (floatingBtn && floatingWidget) {
        const toggleWidget = (forceState) => {
            const shouldOpen = typeof forceState === 'boolean' 
                ? forceState 
                : !floatingWidget.classList.contains('is-open');
            
            if (shouldOpen) {
                floatingWidget.classList.add('is-open');
                floatingBtn.setAttribute('aria-expanded', 'true');
                if (floatingMenu) floatingMenu.setAttribute('aria-hidden', 'false');
            } else {
                floatingWidget.classList.remove('is-open');
                floatingBtn.setAttribute('aria-expanded', 'false');
                if (floatingMenu) floatingMenu.setAttribute('aria-hidden', 'true');
            }
        };

        floatingBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            toggleWidget();
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                toggleWidget(false);
            });
        }

        document.addEventListener('click', (e) => {
            if (floatingWidget.classList.contains('is-open') && !floatingWidget.contains(e.target)) {
                toggleWidget(false);
            }
        });

        if (floatingMenu) {
            floatingMenu.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        }
    }

    // --- 8. INTERACCIÓN DEL STEPPER (PROCESO DE HOMOLOGACIÓN) ---
    const stepperNodes = document.querySelectorAll('.stepper-node');
    const stepperCards = document.querySelectorAll('.stepper-card');

    if (stepperNodes.length > 0 && stepperCards.length > 0) {
        stepperNodes.forEach((node, index) => {
            node.addEventListener('mouseenter', () => {
                stepperNodes.forEach(n => n.classList.remove('active'));
                node.classList.add('active');
                if (stepperCards[index]) {
                    stepperCards[index].style.transform = 'translateY(-8px)';
                    stepperCards[index].style.borderColor = 'var(--accent-gold)';
                    stepperCards[index].style.boxShadow = '0 16px 36px rgba(15, 52, 96, 0.16)';
                }
            });

            node.addEventListener('mouseleave', () => {
                if (stepperCards[index]) {
                    stepperCards[index].style.transform = '';
                    stepperCards[index].style.borderColor = '';
                    stepperCards[index].style.boxShadow = '';
                }
            });

            node.addEventListener('click', () => {
                stepperNodes.forEach(n => n.classList.remove('active'));
                node.classList.add('active');
                if (stepperCards[index]) {
                    stepperCards[index].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            });
        });

        stepperCards.forEach((card, index) => {
            card.addEventListener('mouseenter', () => {
                if (stepperNodes[index]) {
                    stepperNodes.forEach(n => n.classList.remove('active'));
                    stepperNodes[index].classList.add('active');
                }
            });
        });
    }

    // --- 9. GESTIÓN ASÍNCRONA DE FORMULARIOS (CONTACTO Y LIBRO DE RECLAMACIONES) ---
    
    // Función auxiliar para mostrar alertas animadas sin alterar el diseño existente
    const showFormAlert = (containerEl, type, message, details = []) => {
        if (!containerEl) return;
        
        const iconClass = type === 'success' ? 'fa-check-circle text-success' : 'fa-exclamation-triangle text-danger';
        const alertClass = type === 'success' ? 'alert-success border-success' : 'alert-danger border-danger';
        
        let detailsHtml = '';
        if (details && details.length > 0) {
            detailsHtml = '<ul class="mb-0 mt-2 ps-3 small text-start">' + 
                details.map(err => `<li>${err}</li>`).join('') + 
                '</ul>';
        }

        containerEl.innerHTML = `
            <div class="alert ${alertClass} alert-dismissible fade show shadow-sm rounded-3 py-3 px-4" role="alert">
                <div class="d-flex align-items-start gap-3">
                    <i class="fas ${iconClass} fs-4 mt-1"></i>
                    <div class="flex-grow-1">
                        <div class="fw-semibold">${message}</div>
                        ${detailsHtml}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            </div>
        `;
        containerEl.style.display = 'block';
        containerEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    };

    const toggleButtonLoading = (btnEl, isLoading, loadingText = '') => {
        if (!btnEl) return;
        const textSpan = btnEl.querySelector('.btn-text');
        const loadingSpan = btnEl.querySelector('.btn-loading');
        
        if (isLoading) {
            btnEl.disabled = true;
            if (textSpan) textSpan.classList.add('d-none');
            if (loadingSpan) {
                loadingSpan.classList.remove('d-none');
                if (loadingText) loadingSpan.innerHTML = `<i class="fas fa-spinner fa-spin me-2"></i> ${loadingText}`;
            }
        } else {
            btnEl.disabled = false;
            if (textSpan) textSpan.classList.remove('d-none');
            if (loadingSpan) loadingSpan.classList.add('d-none');
        }
    };

    // A. Formulario de Contacto ("ENVÍANOS TU CONSULTA")
    const contactForm = document.getElementById('contactForm');
    const contactAlert = document.getElementById('contactFormAlert');
    const contactBtn = document.getElementById('contactSubmitBtn');

    if (contactForm) {
        contactForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            // Limpieza previa de alerta
            if (contactAlert) {
                contactAlert.innerHTML = '';
                contactAlert.style.display = 'none';
            }

            // Validaciones de cliente
            const nombre = document.getElementById('contactNombre')?.value.trim();
            const telefono = document.getElementById('contactTelefono')?.value.trim();
            const empresa = document.getElementById('contactEmpresa')?.value.trim();
            const email = document.getElementById('contactEmail')?.value.trim();
            const consulta = document.getElementById('contactConsulta')?.value.trim();

            const clientErrors = [];
            if (!nombre || nombre.length < 2) clientErrors.push('Ingrese su nombre y apellido.');
            if (!telefono || telefono.length < 6) clientErrors.push('Ingrese un teléfono de contacto válido.');
            if (!empresa || empresa.length < 2) clientErrors.push('Ingrese el nombre de su empresa o institución.');
            if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) clientErrors.push('Ingrese un correo electrónico válido.');
            if (!consulta || consulta.length < 5) clientErrors.push('Ingrese el detalle de su consulta (mínimo 5 caracteres).');

            if (clientErrors.length > 0) {
                showFormAlert(contactAlert, 'danger', 'Por favor, revise los siguientes campos obligatorios:', clientErrors);
                return;
            }

            // Estado cargando
            toggleButtonLoading(contactBtn, true, 'ENVIANDO CONSULTA...');

            try {
                const formData = new FormData(contactForm);
                const response = await fetch(contactForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showFormAlert(contactAlert, 'success', data.message || '¡Tu consulta ha sido recibida con éxito! Nos comunicaremos contigo a la brevedad.');
                    contactForm.reset();
                } else {
                    const serverErrors = data.errors ? Object.values(data.errors) : [];
                    showFormAlert(contactAlert, 'danger', data.message || 'Ocurrió un error al procesar su consulta.', serverErrors);
                }
            } catch (err) {
                console.error('[QCS Contact Form Error]', err);
                showFormAlert(contactAlert, 'danger', 'No se pudo conectar con el servidor para enviar la consulta. Por favor, verifique su conexión o contáctenos por WhatsApp.');
            } finally {
                toggleButtonLoading(contactBtn, false);
            }
        });
    }

    // B. Formulario de Libro de Reclamaciones Virtual
    const claimForm = document.getElementById('claimForm');
    const claimAlert = document.getElementById('claimFormAlert');
    const claimBtn = document.getElementById('claimSubmitBtn');

    if (claimForm) {
        claimForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            // Limpieza previa de alerta
            if (claimAlert) {
                claimAlert.innerHTML = '';
                claimAlert.style.display = 'none';
            }

            // Validaciones de cliente
            const nombre = document.getElementById('claimNombre')?.value.trim();
            const documento = document.getElementById('claimDocumento')?.value.trim();
            const email = document.getElementById('claimEmail')?.value.trim();
            const telefono = document.getElementById('claimTelefono')?.value.trim();
            const tipo = document.getElementById('claimTipo')?.value.trim();
            const servicio = document.getElementById('claimServicio')?.value.trim();
            const detalle = document.getElementById('claimDetalle')?.value.trim();

            const clientErrors = [];
            if (!nombre || nombre.length < 3) clientErrors.push('Ingrese su nombre y apellido completo.');
            if (!documento || documento.length < 4) clientErrors.push('Ingrese su documento de identidad (DNI, CE o RUC).');
            if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) clientErrors.push('Ingrese un correo electrónico válido.');
            if (!telefono || telefono.length < 6) clientErrors.push('Ingrese su teléfono o celular.');
            if (!tipo) clientErrors.push('Seleccione el tipo de registro (Queja o Reclamo).');
            if (!servicio || servicio.length < 2) clientErrors.push('Indique el servicio o curso contratado.');
            if (!detalle || detalle.length < 8) clientErrors.push('Describa claramente los hechos ocurridos.');

            if (clientErrors.length > 0) {
                showFormAlert(claimAlert, 'danger', 'Por favor, complete todos los campos obligatorios:', clientErrors);
                return;
            }

            // Estado cargando
            toggleButtonLoading(claimBtn, true, 'Procesando registro...');

            try {
                const formData = new FormData(claimForm);
                const response = await fetch(claimForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    const codeBadge = data.claim_code ? `<div class="mt-2 p-2 bg-light rounded border border-success text-dark font-monospace fw-bold small"><i class="fas fa-ticket-alt me-1 text-success"></i> Código de Seguimiento: ${data.claim_code}</div>` : '';
                    const successMessage = `
                        <div>${data.message || 'Su registro en el Libro de Reclamaciones ha sido enviado con éxito.'}</div>
                        ${codeBadge}
                    `;
                    showFormAlert(claimAlert, 'success', successMessage);
                    claimForm.reset();
                } else {
                    const serverErrors = data.errors ? Object.values(data.errors) : [];
                    showFormAlert(claimAlert, 'danger', data.message || 'No fue posible registrar su hoja de reclamación.', serverErrors);
                }
            } catch (err) {
                console.error('[QCS Claim Form Error]', err);
                showFormAlert(claimAlert, 'danger', 'No se pudo conectar con el servidor para procesar su registro. Por favor, intente nuevamente o comuníquese a contacto@quality-consulting.org.');
            } finally {
                toggleButtonLoading(claimBtn, false);
            }
        });
    }

    /* ----------------------------------------------------
       7. BANNER FLOTANTE DE TÉRMINOS Y CONDICIONES (Esquina Inferior Izquierda)
       ---------------------------------------------------- */
    (function initTermsConsentBanner() {
        const CONSENT_KEY = 'qcs_terms_and_privacy_accepted';
        
        // Si ya aceptó previamente o rechazó en esta sesión, no volvemos a mostrar el card
        if (localStorage.getItem(CONSENT_KEY) === 'true' || sessionStorage.getItem('qcs_terms_rejected') === 'true') {
            return;
        }

        // Crear dinámicamente el card flotante
        const termsCard = document.createElement('div');
        termsCard.id = 'qcsTermsFloatingCard';
        termsCard.className = 'qcs-terms-floating-card';
        termsCard.setAttribute('role', 'dialog');
        termsCard.setAttribute('aria-live', 'polite');
        termsCard.setAttribute('aria-label', 'Consentimiento de Términos y Condiciones');

        const termsUrl = '/terminos-y-condiciones';

        termsCard.innerHTML = `
            <div class="qcs-terms-header">
                <i class="fas fa-shield-halved"></i>
                <span>Términos y Privacidad</span>
            </div>
            <div class="qcs-terms-body">
                Al navegar en este sitio web, usted acepta nuestros 
                <a href="${termsUrl}" target="_blank" rel="noopener">Términos y Condiciones</a> 
                y el tratamiento de datos conforme a nuestra 
                <a href="${termsUrl}#clausula-6" target="_blank" rel="noopener">Política de Privacidad</a>.
            </div>
            <div class="qcs-terms-actions">
                <button type="button" id="qcsBtnAcceptTerms" class="qcs-terms-btn-accept">Aceptar</button>
                <button type="button" id="qcsBtnRejectTerms" class="qcs-terms-btn-reject">Rechazar</button>
            </div>
        `;

        document.body.appendChild(termsCard);
        document.body.classList.add('has-terms-banner');

        // Medir altura real del banner para sincronizar el desplazamiento de WhatsApp
        const syncBannerHeight = () => {
            if (termsCard && termsCard.offsetHeight > 0) {
                document.documentElement.style.setProperty('--qcs-terms-height', `${termsCard.offsetHeight}px`);
            }
        };
        requestAnimationFrame(syncBannerHeight);
        window.addEventListener('resize', syncBannerHeight);

        // Cierre y transición de retorno del botón de WhatsApp a su posición original
        const closeBanner = (accepted) => {
            if (accepted) {
                localStorage.setItem(CONSENT_KEY, 'true');
            } else {
                sessionStorage.setItem('qcs_terms_rejected', 'true');
            }
            document.body.classList.remove('has-terms-banner');
            window.removeEventListener('resize', syncBannerHeight);
            termsCard.classList.add('hiding');
            setTimeout(() => {
                if (termsCard.parentNode) {
                    termsCard.parentNode.removeChild(termsCard);
                }
            }, 350);
        };

        // Evento Aceptar
        const btnAccept = document.getElementById('qcsBtnAcceptTerms');
        if (btnAccept) {
            btnAccept.addEventListener('click', () => closeBanner(true));
        }

        // Evento Rechazar (Cierra el banner y regresa WhatsApp a su posición original)
        const btnReject = document.getElementById('qcsBtnRejectTerms');
        if (btnReject) {
            btnReject.addEventListener('click', () => closeBanner(false));
        }
    })();

    /* ----------------------------------------------------
       8. OPTIMIZACIÓN DE RENDIMIENTO FRONTEND
       - Lazy Loading nativo para imágenes fuera de pantalla
       - Decodificación asíncrona de imágenes
       - InstantClick / Prefetch en hover para enlaces internos
       ---------------------------------------------------- */
    (function initFrontendPerformanceBooster() {
        // 1. Aplicar loading="lazy" y decoding="async" a todas las imágenes
        const images = document.querySelectorAll('img:not([loading])');
        images.forEach(img => {
            // No diferir logos de cabecera ni imágenes above-the-fold inmediatas
            if (!img.classList.contains('brand-logo') && !img.closest('.main-header')) {
                img.setAttribute('loading', 'lazy');
                img.setAttribute('decoding', 'async');
            }
        });

        // 2. Prefetch inteligente de páginas internas al hacer hover en enlaces
        if ('IntersectionObserver' in window) {
            const prefetchedUrls = new Set();
            const internalLinks = document.querySelectorAll('a[href$=".html"]');

            internalLinks.forEach(link => {
                link.addEventListener('mouseenter', () => {
                    const href = link.getAttribute('href');
                    if (href && !href.startsWith('#') && !href.startsWith('mailto:') && !prefetchedUrls.has(href)) {
                        prefetchedUrls.add(href);
                        const linkEl = document.createElement('link');
                        linkEl.rel = 'prefetch';
                        linkEl.href = href;
                        document.head.appendChild(linkEl);
                    }
                }, { passive: true });
            });
        }
    })();
});
