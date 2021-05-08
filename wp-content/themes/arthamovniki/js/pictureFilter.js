jQuery(function ($) { // use jQuery code inside this to avoid "$ is not defined" error
    let filterForm = $('#pictures-filter-form');
    filterForm.submit(function (e) {
        e.preventDefault();
        let data = filterForm.serializeAssoc();
        data['action'] = 'pictures_filter_ajax_handler';
        data['_ajax_nonce'] = Ajax.nonce;
        data['Whatever'] = 1234;
        let catalogCards = $('.catalog-cards');

        $.ajax({
            url: Ajax.url,
            data: data,
            type: 'POST',
            beforeSend: function (xhr) {
                catalogCards.html('Загрузка');
            },
            success: function (data) {
                if (data) {
                    catalogCards.html(data);
                    catalogCards.trigger('contentUpdate');
                    let pathname = document.location.pathname;
                    pathname = pathname.replace(/page.+/, '');
                    window.history.pushState({}, "", pathname + '?' + filterForm.serialize());
                } else {
                    catalogCards.html('Нет результатов');
                }
            },
            error: function () {
                catalogCards.html('Ошибка');
            }
        });
    });

    filterForm.on('change', function () {
        filterForm.submit();
    });

    $.fn.serializeAssoc = function () {
        var data = {};
        $.each(this.serializeArray(), function (key, obj) {
            var a = obj.name.match(/(.*?)\[(.*?)\]/);
            if (a !== null) {
                var subName = a[1];
                var subKey = a[2];

                if (!data[subName]) {
                    data[subName] = [];
                }

                if (!subKey.length) {
                    subKey = data[subName].length;
                }

                if (data[subName][subKey]) {
                    if ($.isArray(data[subName][subKey])) {
                        data[subName][subKey].push(obj.value);
                    } else {
                        data[subName][subKey] = [];
                        data[subName][subKey].push(obj.value);
                    }
                } else {
                    data[subName][subKey] = obj.value;
                }
            } else {
                if (data[obj.name]) {
                    if ($.isArray(data[obj.name])) {
                        data[obj.name].push(obj.value);
                    } else {
                        data[obj.name] = [];
                        data[obj.name].push(obj.value);
                    }
                } else {
                    data[obj.name] = obj.value;
                }
            }
        });
        return data;
    };
});
