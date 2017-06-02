@extends('app')

@section('htmlheader_title')
    Add Jurnal
@endsection


@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Jurnal</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border"></div><!-- /.box-header -->
                                    <!-- form start -->
                                    <form role="form">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="volume">Volume</label>
                                                <input type="text" name="volume" class="form-control" id="volume">
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor">Nomor</label>
                                                <input type="text" name="nomor" class="form-control" id="nomor">
                                            </div>
                                            <div class="form-group">
                                                <label for="judul">Judul</label>
                                                <input type="text" name="judul" class="form-control" id="judul" placeholder="Judul...">
                                            </div>
                                            <div class="form-group">
                                                <label for="penulis"></label>
                                                <input type="text" name="penulis" class="form-control" id="penulis" placeholder="Penulis...">
                                            </div>
                                            <div class="form-group">
                                                <label for="nim">NIM/NIDN</label>
                                                <input type="text" name="nim_nidn" class="form-control" id="nim" placeholder="NIM/NIDN...">
                                            </div>
                                            <div class="form-group">
                                                <label for="abstrak">Abstrak</label>
                                                <textarea name="absrak" id="abstrak" cols="30" rows="10" class="form-control" placeholder="Abstrak..."></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="jurusan">Jurusan</label>
                                                <input type="text" name="jurusan" id="jurusan" placeholder="Jurusan" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="instansi">Instansi</label>
                                                <input type="text" name="instansi" id="instansi" placeholder="Instansi..." class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <select name="kategori" id="kategori" class="form-control">
                                                    <option value="" selected disabled>Pilih Kategori...</option>
                                                    <option value="">1</option>
                                                    <option value="">1</option>
                                                    <option value="">1</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="namafile">Instansi</label>
                                                <input type="namafile" name="namafile" id="namafile" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="filecover">Cover</label>
                                                <input type="file" id="filecover" name="filecover">
                                                <p class="help-block">Format File (.img)</p>
                                            </div>
                                        </div><!-- /.box-body -->

                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div><!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
