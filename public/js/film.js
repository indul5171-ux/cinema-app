$('#formFilm').submit(function(e){

    e.preventDefault();

    $.ajax({

        url: '/film',
        method: 'POST',
        data: $(this).serialize(),

        success: function(){

            alert('Film berhasil ditambahkan');

            location.reload();
        }

    });

});

$('.deleteFilm').click(function(){

    let id = $(this).data('id');

    $.ajax({

        url: '/film/' + id,
        method: 'POST',

        data: {
            _method: 'DELETE',
            _token: $('meta[name="csrf-token"]').attr('content')
        },

        success: function(){

            alert('Film berhasil dihapus');

            location.reload();
        }

    });

});