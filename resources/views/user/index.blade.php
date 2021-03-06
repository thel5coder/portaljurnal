@extends('app')

@section('htmlheader_title')
    User Management
@endsection

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-heading">User Management</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">
                                            {{--<a href=""class="btn btn-success btn-sm pull-left">Tambah Jurnal <span class="fa fa-plus"></span></a>--}}
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                                                Launch demo modal
                                            </button>
                                        </h3>
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
                                                <th>NIM/NIDM</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Jurusan</th>
                                                <th>Instansi</th>
                                                <th>Alamat</th>
                                                <th>Tipe</th>
                                                <th>Option</th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><span class="label label-success">admin</span></td>
                                                <td>
                                                    <a href="" class="btn btn-success btn-sm"><span class="fa fa-pencil"></span></a>
                                                    <a href="" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
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

    {{--modal--}}
    <div class="example-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modal Default</h4>
                    </div>
                    <div class="modal-body">
                        <p>One fine body&hellip;</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div><!-- /.example-modal -->
@stop
@section('customscript')
    <script>

        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })
    </script>
@stop
