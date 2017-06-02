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
                                    <h3 class="box-title">Horizontal Button Group</h3>
                                </div>
                                <div class="box-body table-responsive pad">
                                    <p>
                                        Horizontal button groups are easy to create with bootstrap. Just add your buttons
                                        inside <code>&lt;div class="btn-group"&gt;&lt;/div&gt;</code>
                                    </p>

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Button</th>
                                            <th>Icons</th>
                                            <th>Flat</th>
                                            <th>Dropdown</th>
                                        </tr>
                                        <!-- Default -->
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default">Left</button>
                                                    <button type="button" class="btn btn-default">Middle</button>
                                                    <button type="button" class="btn btn-default">Right</button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-align-left"></i></button>
                                                    <button type="button" class="btn btn-default"><i class="fa fa-align-center"></i></button>
                                                    <button type="button" class="btn btn-default"><i class="fa fa-align-right"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-flat"><i class="fa fa-align-left"></i></button>
                                                    <button type="button" class="btn btn-default btn-flat"><i class="fa fa-align-center"></i></button>
                                                    <button type="button" class="btn btn-default btn-flat"><i class="fa fa-align-right"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default">1</button>
                                                    <button type="button" class="btn btn-default">2</button>

                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">Dropdown link</a></li>
                                                            <li><a href="#">Dropdown link</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr><!-- ./default -->
                                        <!-- Info -->
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Left</button>
                                                    <button type="button" class="btn btn-info">Middle</button>
                                                    <button type="button" class="btn btn-info">Right</button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info"><i class="fa fa-align-left"></i></button>
                                                    <button type="button" class="btn btn-info"><i class="fa fa-align-center"></i></button>
                                                    <button type="button" class="btn btn-info"><i class="fa fa-align-right"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-flat"><i class="fa fa-align-left"></i></button>
                                                    <button type="button" class="btn btn-info btn-flat"><i class="fa fa-align-center"></i></button>
                                                    <button type="button" class="btn btn-info btn-flat"><i class="fa fa-align-right"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">1</button>
                                                    <button type="button" class="btn btn-info">2</button>

                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">Dropdown link</a></li>
                                                            <li><a href="#">Dropdown link</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>  <!-- /. info -->
                                        <!-- /.danger -->
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger">Left</button>
                                                    <button type="button" class="btn btn-danger">Middle</button>
                                                    <button type="button" class="btn btn-danger">Right</button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger"><i class="fa fa-align-left"></i></button>
                                                    <button type="button" class="btn btn-danger"><i class="fa fa-align-center"></i></button>
                                                    <button type="button" class="btn btn-danger"><i class="fa fa-align-right"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger btn-flat"><i class="fa fa-align-left"></i></button>
                                                    <button type="button" class="btn btn-danger btn-flat"><i class="fa fa-align-center"></i></button>
                                                    <button type="button" class="btn btn-danger btn-flat"><i class="fa fa-align-right"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger">1</button>
                                                    <button type="button" class="btn btn-danger">2</button>

                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">Dropdown link</a></li>
                                                            <li><a href="#">Dropdown link</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>  <!-- /.danger -->
                                        <!-- warning -->
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-warning">Left</button>
                                                    <button type="button" class="btn btn-warning">Middle</button>
                                                    <button type="button" class="btn btn-warning">Right</button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-warning"><i class="fa fa-align-left"></i></button>
                                                    <button type="button" class="btn btn-warning"><i class="fa fa-align-center"></i></button>
                                                    <button type="button" class="btn btn-warning"><i class="fa fa-align-right"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-warning btn-flat"><i class="fa fa-align-left"></i></button>
                                                    <button type="button" class="btn btn-warning btn-flat"><i class="fa fa-align-center"></i></button>
                                                    <button type="button" class="btn btn-warning btn-flat"><i class="fa fa-align-right"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-warning">1</button>
                                                    <button type="button" class="btn btn-warning">2</button>

                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">Dropdown link</a></li>
                                                            <li><a href="#">Dropdown link</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>  <!-- /.warning -->
                                        <!-- success -->
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success">Left</button>
                                                    <button type="button" class="btn btn-success">Middle</button>
                                                    <button type="button" class="btn btn-success">Right</button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success"><i class="fa fa-align-left"></i></button>
                                                    <button type="button" class="btn btn-success"><i class="fa fa-align-center"></i></button>
                                                    <button type="button" class="btn btn-success"><i class="fa fa-align-right"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success btn-flat"><i class="fa fa-align-left"></i></button>
                                                    <button type="button" class="btn btn-success btn-flat"><i class="fa fa-align-center"></i></button>
                                                    <button type="button" class="btn btn-success btn-flat"><i class="fa fa-align-right"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success">1</button>
                                                    <button type="button" class="btn btn-success">2</button>

                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">Dropdown link</a></li>
                                                            <li><a href="#">Dropdown link</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>  <!-- /.success -->
                                    </table>
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
