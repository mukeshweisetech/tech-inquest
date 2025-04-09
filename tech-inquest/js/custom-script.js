jQuery(document).ready(function ($) {
    $('#topStroyPag').on('click', '.page-link', function (e) {
        e.preventDefault();

        var $link = $(this);
        var $container = $('#top-stories-container');
        var currentPage = parseInt($('#topStroyPag .pagination .active .page-link').data('page'));
        var authorId = $container.data('author');
        var catSlug = $container.data('catslug'); 
        var clicked = $link.data('page');

        let targetPage;
        if (clicked === 'prev') {
            targetPage = currentPage > 1 ? currentPage - 1 : 1;
        } else if (clicked === 'next') {
            targetPage = currentPage + 1;
        } else {
            targetPage = parseInt(clicked);
        }

        // Show overlay
        $('#loading-overlay').addClass('show');

        $.ajax({
            type: 'POST',
            url: my_ajax_object.ajax_url,
            dataType: 'json',
            data: {
                action: 'loadPostpagAjax',
                paged: targetPage,
                author_id: authorId,
                catslug: catSlug,
            },
            success: function (res) {
                setTimeout(function () {
                    $('#top-stories-list').html(res.content);

                    var pagination = res.pagination || '';
                    $('#topStroyPag .pagination').html(pagination);

                    $('#loading-overlay').removeClass('show');
                }, 300);
            },
            error: function () {
                $('#loading-overlay').removeClass('show');
                alert("Something went wrong. Please try again.");
            }
        });
    });

    $('#allPostsPag').on('click', '.page-link', function (e) {
        e.preventDefault();

        var $link = $(this);
        var $container = $('#authorAllPosts');
        var currentPage = parseInt($('#allPostsPag .allpagination .active .page-link').data('page'));
        var authorId = $container.data('author');
        var clicked = $link.data('page');

        var targetPage;
        if (clicked === 'prev') {
            targetPage = currentPage > 1 ? currentPage - 1 : 1;
        } else if (clicked === 'next') {
            targetPage = currentPage + 1;
        } else {
            targetPage = parseInt(clicked);
        }

        // Show overlay
        $('#loading-overlay').addClass('show');

        $.ajax({
            type: 'POST',
            url: my_ajax_object.ajax_url,
            dataType: 'json',
            data: {
                action: 'loadPostpagAjax',
                paged: targetPage,
                author_id: authorId,
            },
            success: function (res) {
                setTimeout(function () {
                    $('#all-post-list').html(res.content);

                    var pagination = res.pagination || '';
                    $('#allPostsPag .pagination').html(pagination);
                    // $('#authorAllPosts .pagination').empty().append(pagination);

                    $('#loading-overlay').removeClass('show');
                }, 300);
            },
            error: function () {
                $('#loading-overlay').removeClass('show');
                alert("Something went wrong. Please try again.");
            }
        });
    });

    $('#contactUsForm').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let messageBox = $('#contactMessage');
        messageBox.html('').removeClass('text-danger text-success');
        let submitBtn = form.find('button[type="submit"]');

        let firstName = $.trim(form.find('[name="first_name"]').val());
        let lastName = $.trim(form.find('[name="last_name"]').val());
        let email = $.trim(form.find('[name="email"]').val());
        let phone = $.trim(form.find('[name="phone"]').val());
        let message = $.trim(form.find('[name="message"]').val());

        if (!firstName || !lastName || !email) {
            messageBox.addClass('text-danger').text('Please fill in all required fields.');
            return;
        }

        if (!validateEmail(email)) {
            messageBox.addClass('text-danger').text('Please enter a valid email address.');
            return;
        }

        messageBox.removeClass('text-danger').addClass('text-info').text('Sending...');
        submitBtn.prop('disabled', true).text('Submitting...');

        $.ajax({
            type: 'POST',
            url: my_ajax_object.ajax_url,
            data: {
                action: 'submit_contact_form',
                first_name: firstName,
                last_name: lastName,
                email: email,
                phone: phone,
                message: message
            },
            success: function (response) {
                submitBtn.prop('disabled', false).text('Submit');
                if (response.success) {
                    messageBox.removeClass('text-danger text-info').addClass('text-success').text(response.data);
                    form[0].reset();
                } else {
                    messageBox.removeClass('text-info').addClass('text-danger').text(response.data || 'Something went wrong.');
                }
            },
            error: function () {
                messageBox.removeClass('text-info').addClass('text-danger').text('Error sending message. Try again.');
            }
        });
    });

    function validateEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    $('.videoLink').on('click', function(e) {
        e.preventDefault();

        var videoUrl = $(this).data('video-url');
        var videoTitle = $(this).data('video-title');

        $('#videoIframe').attr('src', videoUrl);
        $('#videoModalLabel').text(videoTitle);

    });

    $('#videoModal').on('hidden.bs.modal', function () {
        $('#videoIframe').attr('src', '');
    });
});



