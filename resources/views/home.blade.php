@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="row panel panel-default">
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a data-toggle="tab" href="#form-sedekah">Sedekah</a></li>
            <li><a data-toggle="tab" href="#form-bayar">Pembayaran</a></li>
        </ul>

        <div class="tab-content">
            <div id="form-sedekah" class="tab-pane fade in active">
                <div class="page-header">
                    <h3>Masukkan nominal sedekah</h3>
                </div>

                <form action="" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <select name="" id="sedekah" class="form-control">
                                <option disabled selected>Pilih jumlah</option>
                                <option value="50000">50.000</option>
                                <option value="100000">100.000</option>
                                <option value="500000">500.000</option>
                                <option value="1000000">1.000.000</option>
                                <option value="custom">Masukkan jumlah lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="customSedekah">
                        <div class="col-md-offset-4 col-md-4">
                            <input type="text" class="form-control" id="inputCustomSedekah" placeholder="Masukkan jumlah sedekah anda">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <textarea id="note" class="form-control" rows="5" placeholder="Tulis disini"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <a class="btn btn-primary form-control" href="#" id="btnContinue">Lanjut</a>
                        </div>
                    </div>
                </form>
            </div>

            <div id="form-bayar" class="tab-pane fade in">
                <div class="page-header">
                    <h3>Biodata</h3>
                </div>

                <form action="" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <input type="text" class="form-control" id="noHP" placeholder="Masukkan no HP anda">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <input type="text" class="form-control" id="nama" placeholder="Masukkan nama anda">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <input type="email" class="form-control" id="email" placeholder="Masukkan email anda">
                        </div>
                    </div>

                    <div class="page-header">
                        <h4>Metode pembayaran</h4>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <div class="radio">
                                <label><input type="radio" value="bank">Bank Transfer</label>
                            </div>

                            <div class="radio">
                                <label><input type="radio" value="cc">Kartu Kredit</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <a class="btn btn-primary form-control" href="#" id="btnSubmit">Kirim Sedekah</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function() {
        var sedekah = 0;
        var note = '';

        $('#customSedekah').hide();
        $('#inputCustomSedekah, #noHP').keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });

        $('select').on('change', function() {
            if (this.value == 'custom') {
                $('#customSedekah').show();
            } else {
                $('#customSedekah').hide();
            }
        });

        $('#btnContinue').click(function() {
            var cont = false;
            sedekah = $('#sedekah').val();

            if (sedekah == null) {
                swal({
                    title: "Error!",
                    text: "Silahkan pilih jumlah sedekah!",
                    type: "error",
                    confirmButtonText: "Ok"
                });
            } else {
                if (sedekah == 'custom') {
                    sedekah = $('#inputCustomSedekah').val();

                    if (sedekah == null || sedekah == '') {
                        swal({
                            title: "Error!",
                            text: "Silahkan masukkan jumlah sedekah anda!",
                            type: "error",
                            confirmButtonText: "Ok"
                        });
                    } else {
                        if (sedekah < 2000000) {
                            swal({
                                title: "Error!",
                                text: "Jumlah sedekah minimal 2 juta!",
                                type: "error",
                                confirmButtonText: "Ok"
                            });
                        } else {
                            cont = true;
                        }
                    }
                } else {
                    cont = true;
                }
            }

            if (cont) {
                note = $('#note').val();
                $('.nav-pills > .active').next('li').find('a').trigger('click');
            }
        });

        $('#btnSubmit').click(function() {
            sedekah = $('#sedekah').val();

            if (sedekah == 'custom') {
                sedekah = $('#inputCustomSedekah').val();

                if (sedekah == null || sedekah == '') {
                    $('.nav-pills > .active').prev('li').find('a').trigger('click');

                    swal({
                        title: "Error!",
                        text: "Silahkan masukkan jumlah sedekah anda!",
                        type: "error",
                        confirmButtonText: "Ok"
                    });
                } else {
                    if (sedekah < 2000000) {
                        $('.nav-pills > .active').prev('li').find('a').trigger('click');

                        swal({
                            title: "Error!",
                            text: "Jumlah sedekah minimal 2 juta!",
                            type: "error",
                            confirmButtonText: "Ok"
                        });
                    }
                }
            }

            if (sedekah == 0 || sedekah == null) {
                $('.nav-pills > .active').prev('li').find('a').trigger('click');

                swal({
                    title: "Error!",
                    text: "Silahkan masukkan jumlah sedekah anda!",
                    type: "error",
                    confirmButtonText: "Ok"
                });
            } else {
                var send = false;
                const noHP = $('#noHP').val();
                const nama = $('#nama').val();
                const email = $('#email').val();
                const pay = $('input:radio:checked').val();

                if (noHP == '' || nama == '' || email == '' || !pay) {
                    swal({
                        title: "Error!",
                        text: "Silahkan lengkapi data anda!",
                        type: "error",
                        confirmButtonText: "Ok"
                    });
                } else {
                    send = true;
                }

                if (send) {
                    swal({
                        title: "Terima kasih!",
                        text: "Sedekah anda telah tercatat!",
                        type: "success",
                        confirmButtonText: "Ok"
                    });
                }
            }
        });
    });
</script>
@endsection
