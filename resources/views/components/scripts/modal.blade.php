<script>
    /**
     * Modal Controller
     * Handles all modal functionality across the application
     */
    const ModalController = {
        // Store modal configurations
        configs: {},
        
        /**
         * Initialize a modal with configuration
         * @param {string} id - Modal element ID
         * @param {Object} config - Modal configuration
         */
        init(id, config = {}) {
            this.configs[id] = {
                type: config.type || 'info',
                title: config.title || '',
                content: config.content || '',
                formAction: config.formAction || '',
                formMethod: config.formMethod || 'POST',
                confirmText: config.confirmText || 'تأكيد',
                cancelText: config.cancelText || 'إلغاء',
                confirmClass: config.confirmClass || 'bg-blue-600 hover:bg-blue-700',
                cancelClass: config.cancelClass || 'bg-gray-200 hover:bg-gray-300 text-gray-800',
                showCancel: config.showCancel !== undefined ? config.showCancel : true,
                onConfirm: config.onConfirm || null,
                extraFields: config.extraFields || {}
            };
            
            // If it's a delete modal, set default values
            if (config.type === 'delete') {
                this.configs[id].confirmText = config.confirmText || 'تأكيد الحذف';
                this.configs[id].confirmClass = config.confirmClass || 'bg-red-600 hover:bg-red-700';
                this.configs[id].formMethod = config.formMethod || 'DELETE';
            }
        },
        
        /**
         * Open a modal with specific configuration
         * @param {string} id - Modal element ID
         * @param {Object} options - Override default configuration
         */
        open(id, options = {}) {
            const modal = document.getElementById(id);
            if (!modal) return;
            
            const config = { ...this.configs[id], ...options };
            
            // Set modal icon based on type
            const iconContainer = document.getElementById(`${id}-icon`);
            let iconHTML = '';
            
            switch(config.type) {
                case 'delete':
                case 'danger':
                    iconHTML = '<div class="bg-red-100 rounded-full p-2"><i class="fas fa-exclamation-triangle text-red-600"></i></div>';
                    break;
                case 'warning':
                    iconHTML = '<div class="bg-yellow-100 rounded-full p-2"><i class="fas fa-exclamation-circle text-yellow-600"></i></div>';
                    break;
                case 'success':
                    iconHTML = '<div class="bg-green-100 rounded-full p-2"><i class="fas fa-check-circle text-green-600"></i></div>';
                    break;
                case 'info':
                default:
                    iconHTML = '<div class="bg-blue-100 rounded-full p-2"><i class="fas fa-info-circle text-blue-600"></i></div>';
                    break;
            }
            
            iconContainer.innerHTML = iconHTML;
            
            // Set title and content
            document.getElementById(`${id}-title`).textContent = config.title;
            document.getElementById(`${id}-content`).innerHTML = config.content;
            
            // Set footer with buttons and form if needed
            const footer = document.getElementById(`${id}-footer`);
            
            let footerHTML = '';
            
            if (config.formAction) {
                // Modal with form submission
                footerHTML = `
                    <form id="${id}-form" method="POST" action="${config.formAction}">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''}">
                        ${config.formMethod !== 'GET' && config.formMethod !== 'POST' ? 
                            `<input type="hidden" name="_method" value="${config.formMethod}">` : ''}
                        
                        ${Object.entries(config.extraFields).map(([name, value]) => 
                            `<input type="hidden" name="${name}" value="${value}">`
                        ).join('')}
                        
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm ${config.confirmClass}">
                            ${config.confirmText}
                        </button>
                    </form>
                `;
            } else if (config.onConfirm) {
                // Modal with JavaScript callback
                footerHTML = `
                    <button type="button" onclick="ModalController.handleConfirm('${id}')" 
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm ${config.confirmClass}">
                        ${config.confirmText}
                    </button>
                `;
            }
            
            // Add cancel button if enabled
            if (config.showCancel) {
                footerHTML += `
                    <button type="button" onclick="closeAppModal('${id}')" 
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm ${config.cancelClass}">
                        ${config.cancelText}
                    </button>
                `;
            }
            
            footer.innerHTML = footerHTML;
            
            // Show the modal
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        },
        
        /**
         * Handle confirm button click for modals with JavaScript callbacks
         * @param {string} id - Modal element ID
         */
        handleConfirm(id) {
            if (this.configs[id].onConfirm) {
                this.configs[id].onConfirm();
            }
            this.close(id);
        },
        
        /**
         * Close the modal
         * @param {string} id - Modal element ID
         */
        close(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    };
    
    /**
     * Global function to close a modal
     * @param {string} id - Modal element ID
     */
    function closeAppModal(id) {
        ModalController.close(id);
    }
    
    /**
     * Global function to open a delete confirmation modal
     * @param {string} url - Delete action URL
     * @param {string} itemName - Name of the item to delete (optional)
     * @param {string} itemType - Type of item being deleted (optional)
     */
    function openDeleteModal(url, itemName = '', itemType = 'العنصر') {
        let content = `هل أنت متأكد من رغبتك في حذف هذا ${itemType}؟`;
        if (itemName) {
            content = `هل أنت متأكد من حذف ${itemType}: <br><strong class="text-red-600 block mt-2">${itemName}</strong>؟`;
        }
        content += '<p class="text-sm text-red-500 mt-3">هذا الإجراء لا يمكن التراجع عنه.</p>';
        
        ModalController.open('appModal', {
            type: 'delete',
            title: `حذف ${itemType}`,
            content: content,
            formAction: url,
            formMethod: 'DELETE'
        });
    }
    
    // Initialize the default modal when the DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        ModalController.init('appModal', { type: 'info' });
    });
    </script>