document.addEventListener('DOMContentLoaded', function() {
    const popupOverlay = document.querySelector('.popup-overlay');
    const popupMessage = document.querySelector('.popup-message');

    if (popupMessage) {
        popupOverlay.style.display = 'flex';
    }

    popupOverlay.addEventListener('click', function() {
        popupOverlay.style.display = 'none';
    });
});