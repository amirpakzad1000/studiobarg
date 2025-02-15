function deleteItem(event, route) {
    event.preventDefault();
    if (confirm('آیا از این عملیات مطمئن هستید؟')) {
        $.post(route, {_method: "delete", _token: $('meta[name="_token"]').attr('content')})
            .done(function (response) {
                event.target.closest('tr').remove();
                $.toaster({
                    heading: 'عملیات موفق',
                    title: 'پیام',
                    message: response.message || 'عملیات با موفقیت انجام شد.',
                    showHideTransition: 'slide',
                    icon: 'success',
                    position: 'top-right'
                });
            })

            .fail(function (response) {
                let errorMessage = response.responseJSON ? response.responseJSON.message : 'خطای ناشناخته رخ داده است!';
                $.toaster({
                    heading: 'خطا!',
                    message: errorMessage,
                    showHideTransition: 'fade',
                    icon: 'error',
                    position: 'top-right'
                });
            })
    }
}
