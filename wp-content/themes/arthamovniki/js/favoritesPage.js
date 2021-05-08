jQuery(function ($) { // use jQuery code inside this to avoid "$ is not defined" error
    $('.favorite-container').on('switchFavorite', function () {
        $(this).closest('.catalog-card').remove();
    });
});
