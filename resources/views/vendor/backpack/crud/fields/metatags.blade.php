<?php 
    $url = $entry->fnx_url ?? false;
?>
<div class="form-group col-sm-12">
    <label>{{trans('admin.meta_title')}}</label>
    <input type="text" name="metas[title]" value="{{$url->meta_title ?? ''}}" class="form-control">
</div>

<div class="form-group col-sm-12">
    <label>{{trans('admin.meta_description')}}</label>
    <input type="text" name="metas[description]" value="{{$url->meta_description ?? ''}}" class="form-control">
</div>

<div class="form-group col-sm-12">
    <label>{{trans('admin.meta_keywords')}}</label>
    <textarea name="metas[keywords]" class="form-control">{{$url->meta_keywords ?? ''}}</textarea>
</div>