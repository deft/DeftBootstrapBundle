$(function () {
    $("body").on("submit", ".modal form", function (event) {
        event.preventDefault();

        var modalBody = $('.modal-body', $(this));
        $.post($(this).attr('action'), $(this).serialize())
            .done(function (jqXhr) {
                window.location.reload();
            })
            .fail(function (jqXhr) {
                if (jqXhr.status == 400) {
                    modalBody.html(jqXhr.responseText);
                    return;
                }

                $.error("An unknown error occurred submitting modal form");
            })
        ;
    });

    // Make sure the modal is 'fresh' when clicked
    $("body").on("click", "a[data-toggle='modal']", function (event) {
        var $this = $(this);
        var modal = $($this.data('target'));
        var modalBody = $(".modal-body", modal);
        modal.data('modal', null);
        modalBody.html(modalBody.data('loader'));
    });
});