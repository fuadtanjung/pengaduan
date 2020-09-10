<!DOCTYPE html>
<html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ url('assets/images/logo3.png')}}">


    <title>Buku Pengaduan</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('assets/images/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ url('assets/images/sign-in/signin.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('assets/css/pnotify.custom.css') }}">


</head>
<body>
<form id="form_pengaduan" role="form" method="POST">
    @csrf

    <img class="mb-4" src="{{ url('assets/images/logo.png')}}" alt="" width="325" height="130">
    <h1 class="h3 mb-3 font-weight-normal text-center">Buku Pengaduan</h1>

    <div class="form-group" >
        <input type="text" name="nama_pengguna" class="form-control" placeholder="Nama Pengguna/Institusi">
        <input type="number" name="kontak_pengguna"  class="form-control" placeholder="No. Telepon">
        <input type="hidden" name="waktu_pelaporan"  class="form-control">
        <input type="text" name="status" class="form-control" value="diajukan" READONLY hidden>
        <input type="text" name="media_pelaporan" class="form-control" value="aplikasi" READONLY hidden>
    </div>

    <div class="form-group"><br>
        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="pengaduan"></textarea>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="button" aksi="input" id="submit">Isi Buku Pengaduan</button>
</form>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="{{ url('assets/js/pnotify.custom.js') }}"></script>
<script type="text/javascript">
    $(window).on('load', function () {
        $('#submit').click(function () {
            var aksi = $("#submit").attr("aksi");
            if (aksi == "input") {
                $.ajax({
                    url: "{{ url('/input') }}",
                    type: "post",
                    data: new FormData($('#form_pengaduan')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (response) {
                        var pesan = JSON.parse(response);
                        if (pesan.error != null) {
                            new PNotify({
                                title: 'Error notice',
                                text: pesan.error,
                                type: 'error',
                                hide: true
                            });
                        } else if (pesan.success != null) {
                            setTimeout(function () {
                            window.location.reload(1);
                            },2000);
                            new PNotify({
                                title: 'Success notice',
                                text: pesan.success,
                                type: 'success'
                            });
                        } else {
                            new PNotify({
                                title: 'Warning',
                                text: "Can't retrieve any data from server",
                                hide: true
                            });
                            $('#submit').attr("data-aksi", "input");
                        }


                    },
                    fail: function () {
                        new PNotify({
                            title: 'Error notice',
                            text: 'Can\'t retrieve any data from server, please contact your administrator',
                        });
                    }
                });
            }
        });
    });
</script>
</html>
