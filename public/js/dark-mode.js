/**
 * Dark Mode System - Anti-Flash Version
 * Fix: Apply theme BEFORE page renders
 */

// 🚨 CRITICAL: Apply theme IMMEDIATELY (before DOM ready)
(function() {
    const storedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    const theme = storedTheme || (prefersDark ? 'dark' : 'light');
    document.documentElement.setAttribute('data-theme', theme);
})();

// Normal initialization after DOM ready
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.theme-toggle, .theme-toggle-login');
    
    toggleButtons.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            // Add animation class
            btn.classList.add('toggling');
            setTimeout(() => btn.classList.remove('toggling'), 400);
        });
    });
    
    // Listen for system theme changes
    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
            if (!localStorage.getItem('theme')) {
                const newTheme = e.matches ? 'dark' : 'light';
                document.documentElement.setAttribute('data-theme', newTheme);
            }
        });
    }
});

// Expose globally
window.toggleDarkMode = function() {
    const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
};