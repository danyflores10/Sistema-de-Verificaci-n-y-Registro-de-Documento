import './bootstrap';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

// Hacer Swal disponible globalmente
window.Swal = Swal;

/* ============================================
   Dark Mode System - ABC
   ============================================ */
function initTheme() {
    const saved = localStorage.getItem('abc-theme');
    if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}
// Apply immediately (before Alpine init) to prevent flash
initTheme();

document.addEventListener('alpine:init', () => {

    /* ── Theme Store ── */
    Alpine.store('theme', {
        dark: document.documentElement.classList.contains('dark'),

        toggle() {
            this.dark = !this.dark;
            document.documentElement.classList.toggle('dark', this.dark);
            localStorage.setItem('abc-theme', this.dark ? 'dark' : 'light');
        },

        init() {
            this.dark = document.documentElement.classList.contains('dark');
        }
    });

    /* ── Accent Color Store ── */
    Alpine.store('accent', {
        current: localStorage.getItem('abc-accent') || 'navy',
        presets: {
            navy:   { name: 'Navy',     primary: '#0c2340', light: '#1a3c68', dark: '#081a2f', dot: 'bg-[#0c2340]' },
            blue:   { name: 'Azul',     primary: '#1d4ed8', light: '#3b82f6', dark: '#1e3a8a', dot: 'bg-blue-600' },
            purple: { name: 'Púrpura',  primary: '#7c3aed', light: '#8b5cf6', dark: '#5b21b6', dot: 'bg-purple-600' },
            teal:   { name: 'Teal',     primary: '#0d9488', light: '#14b8a6', dark: '#0f766e', dot: 'bg-teal-600' },
            rose:   { name: 'Rosa',     primary: '#e11d48', light: '#f43f5e', dark: '#9f1239', dot: 'bg-rose-600' },
            amber:  { name: 'Ámbar',    primary: '#d97706', light: '#f59e0b', dark: '#b45309', dot: 'bg-amber-600' },
        },

        apply(key) {
            if (!this.presets[key]) return;
            this.current = key;
            localStorage.setItem('abc-accent', key);
            const p = this.presets[key];
            document.documentElement.style.setProperty('--accent-primary', p.primary);
            document.documentElement.style.setProperty('--accent-light', p.light);
            document.documentElement.style.setProperty('--accent-dark', p.dark);
        },

        init() {
            this.apply(this.current);
        }
    });

    /* ── Toast Notification System ── */
    Alpine.store('toasts', {
        items: [],
        counter: 0,

        add(message, type = 'success', duration = 4000) {
            const id = ++this.counter;
            const titles = {
                success: 'Operación Exitosa',
                error: 'Error',
                warning: 'Advertencia',
                info: 'Información'
            };
            this.items.push({
                id,
                title: titles[type] || 'Notificación',
                message,
                type,
                removing: false,
                progress: 100,
                duration
            });
            // Animate progress bar
            if (duration > 0) {
                const startTime = Date.now();
                const interval = setInterval(() => {
                    const item = this.items.find(t => t.id === id);
                    if (!item) { clearInterval(interval); return; }
                    const elapsed = Date.now() - startTime;
                    item.progress = Math.max(0, 100 - (elapsed / duration * 100));
                    if (elapsed >= duration) {
                        clearInterval(interval);
                        this.remove(id);
                    }
                }, 50);
            }
        },

        remove(id) {
            const index = this.items.findIndex(t => t.id === id);
            if (index > -1) {
                this.items[index].removing = true;
                setTimeout(() => {
                    this.items = this.items.filter(t => t.id !== id);
                }, 400);
            }
        },

        success(msg) { this.add(msg, 'success', 4000); },
        error(msg) { this.add(msg, 'error', 7000); },
        warning(msg) { this.add(msg, 'warning', 5000); },
        info(msg) { this.add(msg, 'info', 4000); }
    });
});

/* Listen for toast events dispatched from Blade */
window.addEventListener('toast', (e) => {
    if (Alpine.store('toasts')) {
        Alpine.store('toasts').add(e.detail.message, e.detail.type || 'success');
    }
});

/* ============================================
   File Upload Component - ABC
   ============================================ */
window.fileUpload = function (options = {}) {
    const maxMB = options.maxMB ?? 200;
    const acceptedExtensions = (options.acceptedExtensions ?? ['.pdf', '.jpg', '.jpeg', '.png'])
        .map((ext) => ext.toLowerCase());
    const acceptedLabel = options.acceptedLabel
        ?? acceptedExtensions.map((ext) => ext.replace('.', '').toUpperCase()).join(', ');
    const existingFiles = Array.isArray(options.existingFiles)
        ? options.existingFiles.map((file) => ({ ...file }))
        : [];
    const deleteUrlTemplate = options.deleteUrlTemplate ?? null;
    const csrfToken = options.csrfToken ?? null;

    return {
        files: [],
        existingFiles,
        deletingExistingIds: [],
        dragging: false,

        handleFiles(event) {
            const newFiles = Array.from(event?.target?.files ?? []);
            const maxSize = maxMB * 1024 * 1024;
            let addedCount = 0;

            for (const file of newFiles) {
                const ext = '.' + file.name.split('.').pop().toLowerCase();
                if (!acceptedExtensions.includes(ext)) {
                    if (Alpine.store('toasts')) {
                        Alpine.store('toasts').error(`"${file.name}" no es un formato válido. Solo ${acceptedLabel}.`);
                    }
                    continue;
                }
                if (file.size > maxSize) {
                    if (Alpine.store('toasts')) {
                        Alpine.store('toasts').error(`"${file.name}" excede el límite de ${maxMB}MB.`);
                    }
                    continue;
                }

                const exists = this.files.some((existingFile) =>
                    existingFile.name === file.name
                    && existingFile.size === file.size
                    && existingFile.lastModified === file.lastModified
                );
                if (exists) {
                    continue;
                }

                this.files.push(file);
                addedCount++;
            }

            // Permite volver a seleccionar el mismo archivo desde el explorador.
            if (event?.target && typeof event.target.value !== 'undefined') {
                event.target.value = '';
            }

            this.syncInput();

            if (addedCount > 0) {
                if (Alpine.store('toasts')) {
                    Alpine.store('toasts').success(`${addedCount} archivo(s) listo(s) para subir.`);
                }
            }
        },

        handleDrop(event) {
            this.dragging = false;
            const fakeEvent = { target: { files: event.dataTransfer.files } };
            this.handleFiles(fakeEvent);
        },

        removeFile(index) {
            const removed = this.files.splice(index, 1);
            this.syncInput();
            if (removed.length > 0 && Alpine.store('toasts')) {
                Alpine.store('toasts').info(`"${removed[0].name}" eliminado.`);
            }
        },

        async deleteExistingFile(attachmentId) {
            const targetId = Number.parseInt(attachmentId, 10);
            const target = this.existingFiles.find((file) => Number.parseInt(file.id, 10) === targetId);
            if (!target) {
                return;
            }

            if (this.deletingExistingIds.includes(targetId)) {
                return;
            }

            const removeFromList = () => {
                const index = this.existingFiles.findIndex((file) => Number.parseInt(file.id, 10) === targetId);
                if (index !== -1) {
                    this.existingFiles.splice(index, 1);
                }
            };

            const deleteUrl = deleteUrlTemplate
                ? String(deleteUrlTemplate).replace('__ATTACHMENT_ID__', String(targetId))
                : null;

            if (!deleteUrl) {
                removeFromList();
                if (Alpine.store('toasts')) {
                    Alpine.store('toasts').success(`"${target.name}" eliminado.`);
                }
                return;
            }

            this.deletingExistingIds.push(targetId);
            try {
                const formData = new FormData();
                formData.append('_method', 'DELETE');
                if (csrfToken) {
                    formData.append('_token', csrfToken);
                }

                const response = await fetch(deleteUrl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                    },
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }

                removeFromList();
                if (Alpine.store('toasts')) {
                    Alpine.store('toasts').success(`"${target.name}" eliminado.`);
                }
            } catch (error) {
                if (Alpine.store('toasts')) {
                    Alpine.store('toasts').error('No se pudo quitar el PDF. Inténtalo de nuevo.');
                }
            } finally {
                this.deletingExistingIds = this.deletingExistingIds.filter((id) => id !== targetId);
            }
        },

        clearAll() {
            this.files = [];
            this.syncInput();
        },

        syncInput() {
            if (!this.$refs.fileInput) {
                return;
            }
            // Rebuild the native file input with a DataTransfer
            const dt = new DataTransfer();
            this.files.forEach(f => dt.items.add(f));
            this.$refs.fileInput.files = dt.files;
        },

        formatSize(bytes) {
            if (bytes < 1024) return bytes + ' B';
            if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / 1048576).toFixed(1) + ' MB';
        },

        formatExistingSize(file) {
            if (file?.size_kb) {
                return `${file.size_kb} KB`;
            }
            if (typeof file?.size === 'number') {
                return this.formatSize(file.size);
            }
            return 'Tamaño no disponible';
        }
    };
};

window.Alpine = Alpine;
Alpine.start();
