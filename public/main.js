const url = 'http://proyecto-laravel.com';

window.addEventListener("load", function () {


    //Boton de like
    function like() {
        $('.btn-like').unbind('click').click(function () {
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', `${url}/img/heart-red.png`);

            $.ajax({
                url: `${url}/like/save/${$(this).data('id')}`,
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('Has dado like a la publlicacion');
                    } else {
                        console.log('Error al dar like');
                    }
                }
            });

            dislike();

        });
    }
    like();


    //Boton de dislike
    function dislike() {
        $('.btn-dislike').unbind('click').click(function () {
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', `${url}/img/heart-black.png`);

            $.ajax({
                url: `${url}/dislike/save/${$(this).data('id')}`,
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('Has dado dislike a la publlicacion');
                    } else {
                        console.log('Error al dar like');
                    }
                }
            });

            like();
        });


    }
    dislike();

    // Buscador
    $('#buscador').submit(function (e) {
        $(this).attr('action', url + '/gente/' + $('#buscador #search').val());
    });

});
