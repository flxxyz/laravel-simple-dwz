<script>
    $(function () {
        $('form').submit(function () {
            return false;
        })

        var isRequest = false;
        $('#btn').click(function () {
            if (isRequest) {
                isRequest = true;
                return;
            }

            var uri = $('#uri');
            if (!uri.val()) {
                message('请填入需要生成的链接');
                return;
            }
            var match = /^((ht|f)tps?):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/;
            if (!match.test(uri.val())) {
                message('请填入正确的链接');
                return;
            }
            //message('');

            var data = $('form').serialize();
            $.post('{{ url('api/produce') }}', data, function (result) {
                //console.log(result);
                var data = result.data;
                message(data.uri, true);
                isRequest = false;
            })
        })

        $('.short').select().focus(function () {
            $(this).select()
        })

        $('.delete').click(function () {
            $('.notification').addClass('is-hidden');
        })

        var message = function (message, bool=false) {
            $('.notification').removeClass('is-hidden');

            if (bool) {
                $('.success').removeClass('is-hidden');
                $('.short').html(message);
                $('.msg').empty();
            } else {
                $('.success').addClass('is-hidden');
                $('.msg').html(message);
            }
        }
    })
</script>