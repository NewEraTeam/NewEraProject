// languageDropdown.js

function toggleDropdown() {
    const languageMenu = document.getElementById('languageMenu');
    languageMenu.classList.toggle('hidden');
}

// Close the dropdown if clicked outside
window.onclick = function(event) {
    const languageMenu = document.getElementById('languageMenu');
    if (!event.target.closest('.relative')) {
        languageMenu.classList.add('hidden');
    }
};