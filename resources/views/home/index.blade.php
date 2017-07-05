<script src="{{ asset('js/jquery.min.js') }}"></script>
<form>
    <div>
        <input type="url" name="uri" id="uri">
    </div>
    <div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="button" id="btn">生成</button>
    </div>
</form>
<p id="res"></p>
<br>
<br>
<br>
<br>
<hr>
@foreach($data as $item)
    <article>
        <h3>{{ $item['hash'] }}</h3>
        <p><a href="{{$item['hash'] }}">生成链接</a></p>
        <p>链接：{{ $item['uri'] }}</p>
    </article>
@endforeach

<script>
    $('form').submit(function () {
        return false;
    })
    var isRequest = false;
    $('#btn').click(function () {
        if(isRequest) {
            isRequest = true;
            return;
        }

        var uri = $('#uri');

        if(!uri.val()) {
            resHTML('请填入需要生成的链接');
            return;
        }

        var match = /^((ht|f)tps?):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/;
        if(!match.test(uri.val())) {
            resHTML('请填入正确的链接');
            return;
        }

        resHTML('');

        var data = $('form').serialize();
        $.post('{{ url('api/produce') }}', data, function (result) {
            console.log(result);
            var data = result.data;
            resHTML(data.uri);
            isRequest = false;
        })
    });

    var resHTML = function (el) {
        $('#res').html(el);
    }
</script>