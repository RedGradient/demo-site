function setSortParam() {
    let sort = document.getElementById('date').checked ? 'sort=date' : 'sort=popularity';
    let order = document.getElementById('asc').checked ? 'order=asc' : 'order=desc';

    let sort_btn = document.getElementById('sort');

    // словарь с параметрами
    let params_dict = {
        'page': '',
        'rubric': '',
        'sort': sort,
        'order': order,
    };

    // заполняем словарь
    if (window.location.href.includes('?')) {
        let params_array = window.location.href.split('?')[1].split('&');
        for (let i = 0; i < params_array.length; i++) {
            if (params_array[i].includes('rubric')) params_dict['rubric'] = params_array[i]; else
            if (params_array[i].includes('sort')) params_dict['sort'] = params_array[i]; else
            if (params_array[i].includes('order')) params_dict['order'] = params_array[i]; else
            if (params_array[i].includes('page')) params_dict['page'] = params_array[i];
        }
    }

    // console.log(params_dict['rubric'])
    // console.log(params_dict['sort'])
    // console.log(params_dict['order'])
    // console.log(params_dict['page'])

    let href = '/?';

    for (const[param, value] of Object.entries(params_dict)) {
        if (value) href += value + '&';
    }
    href[href.length - 1] = '';

    sort_btn.setAttribute('href', href);
}
