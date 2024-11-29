jQuery(document).ready(function ($) {
    $('.ab-banner').on('click', '.ab-button', function (e) {
        e.preventDefault();
        $(this).closest('.ab-banner').slideUp();
    });
});

function closeBanner() {
    const banner = document.querySelector('.announcement-banner');
    if (banner) banner.style.display = 'none';
}

