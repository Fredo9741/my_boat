/**
 * My Boat - Favorites System
 * Uses localStorage to store favorite boats across sessions
 */

// Toggle favorite for boat cards (prevents navigation)
window.toggleCardFavorite = function(event, slug) {
    event.preventDefault();
    event.stopPropagation();

    let favorites = JSON.parse(localStorage.getItem('myboat_favorites') || '[]');
    const favoriteIcon = document.querySelector(`.favorite-icon-${slug}`);

    if (!favoriteIcon) return;

    if (favorites.includes(slug)) {
        // Remove from favorites
        favorites = favorites.filter(item => item !== slug);
        favoriteIcon.classList.remove('fas', 'text-red-500');
        favoriteIcon.classList.add('far', 'text-gray-400');
    } else {
        // Add to favorites
        favorites.push(slug);
        favoriteIcon.classList.remove('far', 'text-gray-400');
        favoriteIcon.classList.add('fas', 'text-red-500');
    }

    localStorage.setItem('myboat_favorites', JSON.stringify(favorites));
};

// Initialize favorites icons on page load
document.addEventListener('DOMContentLoaded', function() {
    const favorites = JSON.parse(localStorage.getItem('myboat_favorites') || '[]');

    favorites.forEach(function(slug) {
        const favoriteIcon = document.querySelector(`.favorite-icon-${slug}`);
        if (favoriteIcon) {
            favoriteIcon.classList.remove('far', 'text-gray-400');
            favoriteIcon.classList.add('fas', 'text-red-500');
        }
    });
});

// Get all favorites
window.getFavorites = function() {
    return JSON.parse(localStorage.getItem('myboat_favorites') || '[]');
};

// Get favorites count
window.getFavoritesCount = function() {
    const favorites = JSON.parse(localStorage.getItem('myboat_favorites') || '[]');
    return favorites.length;
};

// Clear all favorites
window.clearFavorites = function() {
    localStorage.removeItem('myboat_favorites');
    // Refresh all favorite icons
    document.querySelectorAll('[class*="favorite-icon-"]').forEach(function(icon) {
        icon.classList.remove('fas', 'text-red-500');
        icon.classList.add('far', 'text-gray-400');
    });
};
