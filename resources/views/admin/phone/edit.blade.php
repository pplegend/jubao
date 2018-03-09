@extends('admin/admin_template')
@section('content')
    <div class="col-sm-8">
        <form method="post" action="/admin/phones/<?php echo $phone->id; ?>" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group mb-2">
                <input type="text" class="form-control" id="title" name="phone" value="<?php echo $phone->phone; ?>" />
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" id="description" name="description" class="form-control" value="<?php echo $phone->description; ?>" />
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection