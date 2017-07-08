function handle(res) {
    $.each(res.result.data, function (i, e) {
        var is_class = isClass(i);
        if(res.type == 'new') {
            var body = $('<div class="notification">').addClass(is_class).append($('<a></a>').attr('href', e.uri).text(e.title));
        }else {
            var body = $('<div class="notification">').addClass(is_class).append($('<a></a>').attr('href', e.uri).text(e.title), $('<span class="tag is-black"></span>').text(e.num + '次'));
        }
        $('#top').append(body);
    })
}

function isClass($index) {
    switch ($index) {
        case 0:
            return 'is-info';
            break;
        case 1:
            return 'is-primary';
            break;
        case 2:
            return 'is-success';
            break;
        case 3:
            return 'is-warning';
            break;
        case 4:
            return 'is-danger';
            break;
        case 5:
            return 'is-info';
            break;
        case 6:
            return 'is-primary';
            break;
        case 7:
            return 'is-success';
            break;
        case 8:
            return 'is-warning';
            break;
        case 9:
            return 'is-danger';
            break;
    }
}