document.addEventListener('DOMContentLoaded', function() {
    const privacyToggle = document.getElementById('is_private');

    // Debugging del estado del toggle
    if (privacyToggle) {
        privacyToggle.addEventListener('change', function() {
            console.log('Toggle changed. Checked:', this.checked);
            console.log('Toggle value:', this.value);
        });
    }
});
