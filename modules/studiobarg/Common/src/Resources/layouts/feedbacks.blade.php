@if(session()->has('feedbacks'))
    @foreach(session()->get('feedbacks') as $message)
        $.toaster({
        heading: "{{ $message["title"] }}",
        message: "{{ $message["body"] }}",
        showHideTransition: 'slide',
        icon: "{{ $message['type'] }}"
        })
    @endforeach
@endif
