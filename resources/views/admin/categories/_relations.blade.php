<div class="panel-body">
    <div class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-2 ">
                {!! Form::label('parent', 'Parent:',['class' =>'col-sm-2 control-label text-right']) !!}
            </div>
            <div class="col-sm-10">
                <table class="table table-hover table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Display Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($model->parent()->get() as $parent)
                        <tr>
                            <td>
                                {!! link_to_route('admin.categories.show',$parent->name,['id'=>$parent->id]) !!}
                            </td>
                            <td>
                                {!! link_to_route('admin.categories.show',$parent->display_name,['id'=>$parent->id]) !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 ">
                {!! Form::label('children', 'Childrens:',['class' =>'col-sm-2 control-label text-right']) !!}
            </div>
            <div class="col-sm-10">
                <table class="table table-hover table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Display Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($model->children()->get() as $children)
                        <tr>
                            <td>
                                {!! link_to_route('admin.categories.show',$children->name,['id'=>$children->id]) !!}
                            </td>
                            <td>
                                {!! link_to_route('admin.categories.show',$children->display_name,['id'=>$children->id]) !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
