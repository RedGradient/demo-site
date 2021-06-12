function likeIt() {
    // let like_label = document.getElementById('like_label');
    let like = document.getElementById('like');
    let like_count = document.getElementById('like_count');

    if (!like.checked) {
        let count = parseInt(like_count.innerText) + 1;
        like_count.innerText = " " + count.toString();
    } else {
        let count = parseInt(like_count.innerText) - 1;
        like_count.innerText = " " + count.toString();
    }


}
