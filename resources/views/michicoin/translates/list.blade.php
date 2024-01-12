@extends(backpack_view('layouts.top_left'))

@php
  $breadcrumbs = [
    trans('backpack::crud.admin') => backpack_url('dashboard'),
    trans('admin.translates') => false,
  ];
@endphp

@section('header')
    <section class="container-fluid">
      <h2>
        <span class="text-capitalize">{{ trans('admin.translates') }}</span>
      </h2>
    </section>
@endsection

@section('content')
<!-- Default box -->
 
<form id="filtertranslates" method="GET" action="{{ url(config('backpack.base.route_prefix', 'admin').'/translates/list') }}" >
<input type="hidden" name="group" value="{{Request::get('group')}}">
</form>

  <form id="savetranslates" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/translates/save') }}" >
  @csrf

  <div class="row">
  @if(count($groups) > 1)
    <div class="col-3">
        <select name="group" class="form-control js-set-translate-group">
            @foreach($groups as $tgroup)
            <option value="{{$tgroup}}" {{Request::get('group','public')==$tgroup?'selected':''}}>{{$tgroup}}</option>
            @endforeach
        </select>
    </div>
    @endif
    <div class="col-3">
        <button  type="submit" class="btn btn-success ladda-button mb-2" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-save"></i> {{ trans('translate.save_translates') }}</span></button>
    </div>
    @if(backpack_user()->root)
    <div class="col-3">
        <a  href="{{ url(config('backpack.base.route_prefix', 'admin').'/translates/scan') }}" class="btn btn-primary ladda-button mb-2" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-refresh"></i> {{ trans('translate.scan_translates') }}</span></a>
    </div>
    @endif

  </div>

  <div class="card">
    <div class="card-body p-0">
      <table class="table table-hover pb-0 mb-0">
        <thead>
          <tr>
          <th>{{ __('translate.key') }}</th>
            @foreach($languages as $olang)
            <th>{{ $olang }}</th>
            @endforeach   
          </tr>
        </thead>
        <tbody>
        @foreach($translates_keys as $key)
        <?php 
            $empty = $group.'.'.$key;
        ?>
            <tr>
                <td>{{$group}}.{{$key}}</td>
                @foreach($languages as $lkey=>$lname)
                <?php 
                    $trans = $translates[$lkey][$key] ?? $empty;
                    $form_class = '';
                    if($trans==$empty){
                        $form_class = 'is-invalid';
                    }  
                ?>
                <td>
                    <span class="d-none">{{$translates[$lkey][$key] ?? $empty}}</span>
                    <input type="text" name="translate[{{$lkey}}][{{$group}}][{{$key}}]" value="{{$trans}}" class="form-control {{$form_class}}">
                </td>             
                @endforeach
            </tr>
            @endforeach
        </tbody>
      </table>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

  </form>

@endsection

@section('after_scripts')

<script>
  jQuery(document).ready(function($) {
    jQuery('.js-set-translate-group').change(function(){
        jQuery('#filtertranslates').find('input[name=group]').val($(this).val());
        jQuery('#filtertranslates').submit();
    });


  });
</script>
@endsection
