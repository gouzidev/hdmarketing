// resources/js/notification.js
class MinimalNotify {
    constructor() {
        // Create style element
        const style = document.createElement('style');
        style.textContent = `
        .mini-notify {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 15px;
            border-radius: 4px;
            color: white;
            font-weight: 500;
            z-index: 9999;
            box-shadow: 0 3px 6px rgba(0,0,0,0.16);
            transition: 0.3s ease;
            opacity: 0;
            display: flex;
            align-items: center;
            direction: rtl;
            min-width: 250px;
            text-align: right;
        }
        .mini-notify.success { background-color: #4caf50; }
        .mini-notify.error { background-color: #f44336; }
        .mini-notify.show { opacity: 1; }
        .mini-notify-icon {
            margin-left: 8px;
            font-weight: bold;
        }
        .mini-notify-close {
            margin-right: auto;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.2s;
        }
        .mini-notify-close:hover {
            opacity: 1;
        }`;
        document.head.appendChild(style);
    }

    show(message, type = 'success') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `mini-notify ${type}`;
        
        // Add icon based on type
        const icon = document.createElement('span');
        icon.className = 'mini-notify-icon';
        icon.textContent = type === 'success' ? '✓' : '✕';
        
        // Add message
        const text = document.createElement('span');
        text.textContent = message;
        
        // Add close button
        const close = document.createElement('span');
        close.className = 'mini-notify-close';
        close.textContent = '×';
        close.addEventListener('click', () => this.hide(notification));
        
        // Build notification
        notification.appendChild(icon);
        notification.appendChild(text);
        notification.appendChild(close);
        document.body.appendChild(notification);
        
        // Show notification
        setTimeout(() => notification.classList.add('show'), 10);
        
        // Auto-hide after duration
        const timer = setTimeout(() => this.hide(notification), 3000);
        
        // Store timer reference
        notification._timer = timer;
    }
    
    hide(notification) {
        // Clear timeout if it exists
        if (notification._timer) {
            clearTimeout(notification._timer);
        }
        
        // Hide notification
        notification.classList.remove('show');
        
        // Remove from DOM after transition
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }
    
    success(message) {
        this.show(message, 'success');
    }
    
    error(message) {
        this.show(message, 'error');
    }
}

// Create global instance
window.minimalNotify = new MinimalNotify();

// Auto-handle Laravel flash messages
document.addEventListener('DOMContentLoaded', function() {
    // Try to parse Laravel messages from a hidden element or data attribute
    const laravelMessages = document.getElementById('laravel-messages');
    if (laravelMessages) {
        try {
            const messages = JSON.parse(laravelMessages.textContent || laravelMessages.getAttribute('data-messages'));
            
            if (messages.success) {
                window.minimalNotify.success(messages.success);
            }
            
            if (messages.error) {
                window.minimalNotify.error(messages.error);
            }
            
            if (messages.errors && Array.isArray(messages.errors)) {
                messages.errors.forEach(error => {
                    window.minimalNotify.error(error);
                });
            }
        } catch (e) {
            console.error('Error parsing Laravel messages', e);
        }
    }
});