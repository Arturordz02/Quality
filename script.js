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
            const href = this.getAttribute('href');

            if (window.innerWidth < 992) {
                // En móviles, permitir que actúe como acordeón sin interferir
                const parentDropdown = this.closest('.dropdown');
                if (parentDropdown) {
                    // Cerrar otros dropdowns hermanos
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
            } else {
                // En escritorio (> 992px), navegación suave si es ancla #
                if (href && href.startsWith('#') && href.length > 1) {
                    const targetEl = document.querySelector(href);
                    if (targetEl) {
                        e.preventDefault();
                        targetEl.scrollIntoView({ behavior: 'smooth' });
                    }
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

    // --- 7. SELECTOR FLOTANTE MULTIPAÍS DE WHATSAPP ---
    let floatingWidget = document.getElementById('whatsappFloatingWidget');
    if (!floatingWidget) {
        // Inyectar dinámicamente si no existe en el DOM
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
                    <a href="https://api.whatsapp.com/send?phone=51993463118&text=Buen%20d%C3%ADa%20deseo%20informaci%C3%B3n%20de%20cursos/consultor%C3%ADa" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                        <span class="country-flag">🇵🇪</span>
                        <div class="country-info">
                            <span class="country-name">Perú (Central)</span>
                            <span class="country-phone">+51 993 463 118</span>
                        </div>
                        <i class="fas fa-chevron-right arrow-go"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=56990760986&text=Buen%20d%C3%ADa%20deseo%20informaci%C3%B3n%20de%20cursos/consultor%C3%ADa" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                        <span class="country-flag">🇨🇱</span>
                        <div class="country-info">
                            <span class="country-name">Chile</span>
                            <span class="country-phone">+56 9 9076 0986</span>
                        </div>
                        <i class="fas fa-chevron-right arrow-go"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=573152276029&text=Buen%20d%C3%ADa%20deseo%20informaci%C3%B3n%20de%20cursos/consultor%C3%ADa" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                        <span class="country-flag">🇪🇨</span>
                        <div class="country-info">
                            <span class="country-name">Ecuador</span>
                            <span class="country-phone">+57 315 227 6029</span>
                        </div>
                        <i class="fas fa-chevron-right arrow-go"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=50768195911&text=Buen%20d%C3%ADa%20deseo%20informaci%C3%B3n%20de%20cursos/consultor%C3%ADa" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                        <span class="country-flag">🇵🇦</span>
                        <div class="country-info">
                            <span class="country-name">Panamá</span>
                            <span class="country-phone">+507 6819 5911</span>
                        </div>
                        <i class="fas fa-chevron-right arrow-go"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=525537208429&text=Buen%20d%C3%ADa%20deseo%20informaci%C3%B3n%20de%20cursos/consultor%C3%ADa" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
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

        // Click o toque en el botón flotante
        floatingBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            toggleWidget();
        });

        // Click en el botón de cerrar
        if (closeBtn) {
            closeBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                toggleWidget(false);
            });
        }

        // Click fuera del widget para cerrarlo
        document.addEventListener('click', (e) => {
            if (floatingWidget.classList.contains('is-open') && !floatingWidget.contains(e.target)) {
                toggleWidget(false);
            }
        });

        // Prevenir que clics dentro del menú cierren el widget
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

    // --- 9. MEJORA DE FOCO INMEDIATO EN RECUADROS DE FORMULARIOS (Área 100% Activa) ---
    document.addEventListener('click', (e) => {
        const inputGroup = e.target.closest('.input-group');
        if (inputGroup) {
            const input = inputGroup.querySelector('input, textarea, select');
            if (input && document.activeElement !== input) {
                input.focus();
            }
        }
    });

    document.querySelectorAll('.input-group-text').forEach(addon => {
        addon.addEventListener('click', (e) => {
            e.preventDefault();
            const input = addon.parentElement.querySelector('input, textarea, select');
            if (input) input.focus();
        });
    });

    // --- 10. GESTIÓN ASÍNCRONA DE FORMULARIOS (CONTACTO Y LIBRO DE RECLAMACIONES) ---
    
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
});
