function uploadPost() {
    let title = $('#title').html();
    let description = $('#description').html();
    let body = $('#body').html();
    let rubric = $('#rubric').html();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "/posts",
        data: {
            "title": title,
            "description": description,
            "body": body,
            "rubric": rubric,
        }
    });
}
