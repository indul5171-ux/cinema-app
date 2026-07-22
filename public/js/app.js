alert('JavaScript berhasil');

$('#formFilm').submit(function(e){

    e.preventDefault();

    $.ajax({
        url: '/film',
        method: 'POST',
        data: $(this).serialize(),

        success: function(){
            alert('berhasil');
        }
    });

});