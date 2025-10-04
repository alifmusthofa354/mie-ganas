import './bootstrap';

// Checks for saved theme preference or OS setting and applies dark mode.
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  document.documentElement.classList.add('dark');
} else {
  document.documentElement.classList.remove('dark');
}

/**
 * Toggles the theme between 'light' and 'dark'.
 * Saves the preference to localStorage.
 */
window.toggleTheme = function() {
  const isDark = document.documentElement.classList.toggle('dark');
  localStorage.theme = isDark ? 'dark' : 'light';
}