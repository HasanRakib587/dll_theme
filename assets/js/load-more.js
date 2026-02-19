jQuery(function ($) {

    let page = 2;

    $('#load-more-btn').on('click', function (e) {

        e.preventDefault(); // ✅ prevents scroll jump

        let button = $(this);

        $.ajax({
            url: loadmore_params.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more',
                page: page
            },
            beforeSend: function () {
                button.text('Loading...');
            },
            success: function (data) {

                if (data.trim().length) {
                    $('#older-posts-container').append(data);
                    button.text('Load Previous Articles');
                    page++;
                } else {
                    button.remove(); // ✅ remove when no more posts
                }

            }
        });

    });

});
