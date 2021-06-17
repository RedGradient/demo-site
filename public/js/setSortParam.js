document.addEventListener("DOMContentLoaded", function(){
    // setSortParam();
    showCurrentSort();
});


function showCurrentSort() {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());

    if (window.location.href.includes('sort')) {
        for (const[param, value] of Object.entries(params)) {
            document.getElementById(value).click();
        }
    }
}


function setSortParam() {

    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());

    let sort_btn = document.getElementById('sort');

    let sort = document.getElementById('date').checked ? 'date' : 'popularity';
    let order = document.getElementById('asc').checked ? 'asc' : 'desc';

    params.sort = sort;
    params.order = order;

    let href = '/?';

    for (const[param, value] of Object.entries(params)) {
        href += param + '=' + value + '&';
    }

    sort_btn.setAttribute('href', href);
}
