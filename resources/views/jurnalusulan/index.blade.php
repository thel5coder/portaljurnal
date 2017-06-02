@extends('app')

@section('htmlheader_title')
    Jurnal Usulan
@endsection


@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-heading">Jurnal Usulan</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title"></h3>
                                        <div class="box-tools">
                                            <div class="input-group" style="width: 250px;">
                                                <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body table table-responsive table-striped table-condensed no-padding ">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Jurusan</th>
                                                <th>Instansi</th>
                                                <th>Kategori</th>
                                                <th>Judul</th>
                                                <th>Volume</th>
                                                <th>Nomor</th>
                                                <th>Tgl Upload</th>
                                                <th>Jurnal</th>
                                                <th>Status</th>
                                                <th>Tahap</th>
                                                <th>Aksi</th>
                                            </tr>
                                            <tr>

                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><span class="label label-success">Received</span></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                Pilih <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="#">Blind Review</a></li>
                                                                <li><a href="#">Revisi</a></li>
                                                                <li><a href="#">ACC</a></li>
                                                                <li><a href="#">Kirim ke Mb</a></li>
                                                                <li><a href="#">Kirim ke Admin</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer clearfix">
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                            <li><a href="#">&laquo;</a></li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">&raquo;</a></li>
                                        </ul>
                                    </div>
                                </div><!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
