@extends('admin/admin_template')

@section('content')
    <div class='row'>
        <div class='col-md-5'>
            <!-- Box -->

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">电话列表</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>id</th><th>号码</th><th>部门</th><th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($phones as $phone)
                            <tr>
                                <td>{{$phone->id}}</td>
                                <td>{{$phone->phone}}</td>
                                <td>{{$phone->description}}</td>
                                <td>
                                    @if($active == 'audit')
                                        <a class="btn btn-primary" href="{{ route('phone.aduit',$phone->id) }}">通过</a>
                                        <a class="btn btn-primary" href="{{ route('phone.notaduit',$phone->id) }}">不通过</a>
                                    @else
                                        <a class="btn btn-primary" href="{{ route('phone.edit',$phone->id) }}">编辑</a>
                                        <a class="btn btn-primary" href="{{ route('phone.notaduit',$phone->id) }}">删除</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $phones->render(); ?>
                    @include('admin/phone/createphone_form')
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class='col-md-7'>
            <!-- Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">QQ列表</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>id</th><th>号码</th><th>描述</th><th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($qqs as $phone)
                            <tr>
                                <td>{{$phone->id}}</td>
                                <td>{{$phone->qq}}</td>
                                <td>{{$phone->body}}</td>
                                <td style="width: 140px;">
                                    @if($active == 'audit')
                                        <a class="btn btn-primary" href="{{ route('qq.show',$phone->id) }}">查看</a>

                                    @else
                                        <a class="btn btn-primary" href="{{ route('qq.edit',$phone->id) }}">编辑</a>
                                        <a class="btn btn-primary" href="{{ route('qq.notaduit',$phone->id) }}">删除</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $qqs->render(); ?>
                    @include('admin/phone/createphone_form')
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection