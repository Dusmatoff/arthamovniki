jQuery(function ($) { // use jQuery code inside this to avoid "$ is not defined" error
    setFavoriteStatusListener($('.add-to-fav'));

    $('#page').on('contentUpdate', function () {
        setFavoriteStatusListener($('.add-to-fav'));
    });

    function setFavoriteStatusListener(button) {
        button.click(function (e) {
            e.preventDefault();
            switchFavoriteStatus($(this));
        });
    }

    function switchFavoriteStatus(button) {
        let picId = button.data('picture');
        let userId = button.data('user');
        let container = button.closest('.favorite-container');
        let data = {
            'action': 'picture_favorite_ajax_handler',
            '_ajax_nonce': Ajax.nonce,
            'Whatever': 1234,
            'picture': picId,
            'user': userId,
        };
        $.ajax({
            url: Ajax.url,
            data: data,
            type: 'POST',
            beforeSend: function (xhr) {
                container.html('Загрузка');
            },
            success: function (data) {
                if (data) {
                    container.html(data);
                    container.trigger('switchFavorite');
                } else {
                    container.html('Ошибка');
                }
                setFavoriteStatusListener(container.find('.add-to-fav'));
            },
            error: function () {
                container.html('Ошибка');
            }
        });
    }
});
