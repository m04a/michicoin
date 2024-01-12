
@foreach(getMenuPositionsArray() as $pname)
<a href="{{ url($crud->route.'/reorder') }}?p={{$pname}}" class="btn btn-outline-primary" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-arrows"></i> {{ trans('backpack::crud.reorder') }} {{$pname}}</span></a>
@endforeach