function setSortParam(e) {
    let name = e.getAttribute('name');
    let id = e.getAttribute('id');

    let sort_btn = document.getElementById('sort');
    let href = sort_btn.getAttribute('href');

    let params = href.split('?')[1].split('&');

    switch (name) {
        case 'sort':
            params[0] = name + '=' + id;
            break;
        case 'order':
            params[1] = name + '=' + id;
    }


    href = '?' + params[0] + '&' + params[1];
    sort_btn.setAttribute('href', href);
}
