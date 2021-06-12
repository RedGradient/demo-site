function likeIt() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // let like_label = document.getElementById('like_label');
    let like = document.getElementById('like');
    let like_count = document.getElementById('like_count');

    let href = window.location.href.split('/');
    let post_id = href[href.length - 1];

    if (!like.checked) {
        let count = parseInt(like_count.innerText) + 1;
        like_count.innerText = " " + count.toString();

        $.ajax({
            type: "POST",
            url: "/like",
            data: {
                "post_id": post_id,
            }
        });
    } else {
        let count = parseInt(like_count.innerText) - 1;
        like_count.innerText = " " + count.toString();

        $.ajax({
            type: "POST",
            url: "/unlike",
            data: {
                "post_id": post_id,
            }
        });
    }


}
