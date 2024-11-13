// profileDropdown.js

// Toggle for Profile Dropdown
function toggleProfileMenu() {
    const profileMenu = document.getElementById('profileMenu');
    profileMenu.classList.toggle('hidden');
}

// Optional: Toggle for Language Dropdown (if needed)
function toggleDropdown() {
    const languageDropdown = document.getElementById('languageDropdown');
    if (languageDropdown) {
        languageDropdown.classList.toggle('hidden');
    }
}

// Close the dropdown if clicked outside
window.onclick = function(event) {
    const profileMenu = document.getElementById('profileMenu');
    
    if (!event.target.closest('.inline-block') && profileMenu && !profileMenu.classList.contains('hidden')) {
        profileMenu.classList.add('hidden');
    }
}