<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/frontpages/_form_data.';

$yes_no = ['0' => trans($VN . 'no'), '1' => trans($VN . 'yes')];

?>
<div class="panel-body">
    <div class="form-horizontal">
        <div class="form-group ">
            <!--- code Field --->
            {!! Form::label('code',  trans($VN.'code'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('code','has-error')}}">
                {!! Form::text('code', $model->code, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_code'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('code', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            <!--- edition Field --->
            {!! Form::label('edition',  trans($VN.'edition'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-1 {{$errors->first('edition','has-error')}}">
                {!! Form::text('edition', $model->edition, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_edition'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('edition', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <div class="form-group ">
            <!--- status Field --->
            {!! Form::label('status',  trans($VN.'status'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('code','has-error')}}">
                {!! Form::select('status',App\Library\Status::getFrontPageStatus(), $model->status,
                                ['class' => 'form-control input-sm',
                                'style' => 'width:100%;']+
                                ($readonly?['disabled']:[])) !!}
                {!! $errors->first('status', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            <!--- total_pages Field --->
            {!! Form::label('total_pages',  trans($VN.'total_pages'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-1 {{$errors->first('total_pages','has-error')}}">
                {!! Form::text('total_pages', $model->total_pages, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_total_pages'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('total_pages', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- title Field --->
        <div class="form-group ">
            {!! Form::label('title',  trans($VN.'title'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10 {{$errors->first('title','has-error')}}">
                {!! Form::text('title', $model->title, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_title'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('title', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- reason_for_revision Field --->
        <div class="form-group ">
            {!! Form::label('reason_for_revision',  trans($VN.'reason_for_revision'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10 {{$errors->first('reason_for_revision','has-error')}}">
                {!! Form::text('reason_for_revision', $model->reason_for_revision, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_reason_for_revision'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('reason_for_revision', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>


        <div class="form-group ">
            <!--- author_id Field --->
            {!! Form::label('author_id', trans($VN.'author'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('author_id','has-error')}}">
                {!! Form::select('author_id',$users, $model->author_id,
                                ['class' => 'form-control input-sm',
                                'style' => 'width:100%;']+
                                ($readonly?['disabled']:[])) !!}
                {!! $errors->first('author_id', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            <!--- creation_date Field --->
            {!! Form::label('creation_date',  trans($VN.'creation_date'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::text('creation_date',$model->creation_date, [
                    'class' => 'form-control input-sm ' .($readonly?'readonly':''),
                    'placeholder' => trans($VN.'placeholder_creation_date'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('creation_date', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <div class="form-group ">
            <!--- reviewer_id Field --->
            {!! Form::label('reviewer_id', trans($VN.'reviewer'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('reviewer_id','has-error')}}">
                {!! Form::select('reviewer_id',$users, $model->reviewer_id,
                                ['class' => 'form-control input-sm',
                                'style' => 'width:100%;']+
                                ($readonly?['disabled']:[])) !!}
                {!! $errors->first('reviewer_id', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            <!--- review_date Field --->
            {!! Form::label('review_date',  trans($VN.'review_date'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::text('review_date',$model->review_date, [
                    'class' => 'form-control input-sm ' .($readonly?'readonly':''),
                    'placeholder' => trans($VN.'placeholder_review_date'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('review_date', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <div class="form-group ">
            <!--- approver_id Field --->
            {!! Form::label('approver_id', trans($VN.'approver'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('approver_id','has-error')}}">
                {!! Form::select('approver_id',$users, $model->approver_id,
                                ['class' => 'form-control input-sm',
                                'style' => 'width:100%;']+
                                ($readonly?['disabled']:[])) !!}
                {!! $errors->first('approver_id', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            <!--- approval_date Field --->
            {!! Form::label('approval_date',  trans($VN.'approval_date'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::text('approval_date',$model->approval_date, [
                    'class' => 'form-control input-sm ' .($readonly?'readonly':''),
                    'placeholder' => trans($VN.'placeholder_approval_date'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('approval_date', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <div class="form-group ">
            <!--- publisher_id Field --->
            {!! Form::label('publisher_id', trans($VN.'author'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('publisher_id','has-error')}}">
                {!! Form::select('publisher_id',$users, $model->publisher_id,
                                ['class' => 'form-control input-sm',
                                'style' => 'width:100%;']+
                                ($readonly?['disabled']:[])) !!}
                {!! $errors->first('publisher_id', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            <!--- publishing_date Field --->
            {!! Form::label('publishing_date',  trans($VN.'publishing_date'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::text('publishing_date',$model->publishing_date, [
                    'class' => 'form-control input-sm ' .($readonly?'readonly':''),
                    'placeholder' => trans($VN.'placeholder_publishing_date'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('publishing_date', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <!--- description Field --->
        <div class="form-group">
            {!! Form::label('description', trans($VN.'description'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10 {{$errors->first('description','has-error')}}">
                @if ($readonly)
                    <div class="textarea">
                            {!! ($model->description?$model->description:'<br/><br>') !!}
                    </div>
                @else
                    {!! Form::textarea('description',$model->description, [
                            'class' => 'form-control input-sm',
                            'placeholder' => trans($VN.'description'),
                            'style' => 'width:100%;']) !!}
                    {!! $errors->first('description', '<p class="help-block error-msg">:message</p>') !!}
                @endif
            </div>
         </div>

         @include('partials.crud.timestamps',['model'=>$model])
    </div>
</div>
