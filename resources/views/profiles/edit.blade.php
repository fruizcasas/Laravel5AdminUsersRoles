<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/profiles/edit.';

?>

@extends('app')

@section('headings')
    <h1>{{trans($VN.'profile')}} {{ App\Profile::loginProfile()->user->name }}</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('profile') !!}
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        {!! Form::model($model,['method' => 'PUT',
        'route'  => ['profile.update'],
        'class'=>'form-horizontal']) !!}
            <div class="panel panel-primary">
                <div class="panel-footer">
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-4">
                            {!! link_to_route('home',trans($VN.'cancel'),[],['class'=>"btn btn-primary"])!!}
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-warning">{{trans($VN.'update')}}</button>
                        </div>
                    </div>
                    @include('partials.errors')
                </div>
                <div class="panel-body">
                    @include('profiles._form')
                <div id="carousel-themes" class="carousel slide" data-ride="carousel" data-interval="">
                    <!-- Indicators -->
                    <?php $counter = 0 ?>
                    <ol class="carousel-indicators">
                        @foreach($themes as $theme)
                        <li data-target="#carousel-themes" data-slide-to="{{$counter++}}" {!! (strtolower($model->theme) == strtolower($theme)) ?'class="active"':'' !!}></li>
                        @endforeach
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        @foreach($themes as $theme)
                            <div class="item {{ (strtolower($model->theme) == strtolower($theme))?'active':'' }}">
                                <img src="{{asset('/images/themes/'.strtolower($theme).'.png')}}" alt="{{$theme}}">
                            </div>
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-themes" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-themes" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>

@stop

@section('scripts')
    <script>
        var themes = [
        @foreach($themes as $theme)
            "{{strtolower($theme)}}",
        @endforeach
        ];

        function theme_changed()
        {
            $('#carousel-themes').carousel(themes.indexOf(document.getElementById('theme').value));
        }
    </script>
@endsection
