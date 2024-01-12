@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.list') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
  <div class="container-fluid">
    <h2>
      <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
      <small id="datatable_info_stack">{!! $crud->getSubheading() ?? '' !!}</small>
    </h2>
  </div>
@endsection

@section('content')
  <!-- Default box -->
  <div class="row">

    <!-- THE ACTUAL CONTENT -->
    <div class="{{ $crud->getListContentClass() }}">

        <div class="row mb-0">
          <div class="col-sm-6">
            @if ( $crud->buttons()->where('stack', 'top')->count() ||  $crud->exportButtons())
              <div class="d-print-none {{ $crud->hasAccess('create')?'with-border':'' }}">

                @include('crud::inc.button_stack', ['stack' => 'top'])

              </div>
            @endif
          </div>
          <div class="col-sm-6">
            <div id="datatable_search_stack" class="mt-sm-0 mt-2 d-print-none"></div>
          </div>
        </div>

        {{-- Backpack List Filters --}}
        @if ($crud->filtersEnabled())
          @include('crud::inc.filters_navbar')
        @endif


        <ul class="nav mt-4 nav-tabs" id="myTab" role="tablist">
            @foreach($crud->getEntries() as $pos=>$entry)
            <li class="nav-item" role="presentation">
                <a class="nav-link {{$pos==0?'active':''}}" id="tabnav{{$pos}}" data-toggle="tab" href="#tab{{$pos}}" role="tab" aria-controls="tab{{$pos}}" aria-selected="true">{{__('settings.'.$entry->key)}}</a>
            </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
            @foreach($crud->getEntries() as $pos=>$entry)
            <div class="tab-pane fade show {{$pos==0?'active':''}}" id="tab{{$pos}}" role="tabpanel" aria-labelledby="tabnav{{$pos}}">
               
            {{__('settings.desc_'.$entry->key)}}             
  @include('crud::inc.button_stack', ['stack' => 'line'])
  <hr>

                    <div>
                  

                    <div class="row">
	<div class="col-12">

	<!-- Default box -->
	  <div class="">

	    <div class="card no-padding no-border">
			<table class="table table-striped mb-0">
		        <tbody>
		        @foreach ($crud->columns() as $column)
            <?php 
              $cname = $column['name'];
              $cparts = explode('_',$cname);
              $value = getSetting( $cname );
              if(!is_string($value)){
                $value = json_encode($value);
              }

            ?>
            @if($cparts[0]==$entry->key)
		            <tr>
		                <td>
		                    <strong>{!! $column['label'] !!}:</strong>
		                </td>
                        <td>
							@if (!isset($column['type']))
                        {!! $value !!}
		                    @else
		                      @if(view()->exists('vendor.backpack.crud.columns.'.$column['type']))
		                        @include('vendor.backpack.crud.columns.'.$column['type'])
		                      @else
		                        @if(view()->exists('crud::columns.'.$column['type']))
		                          @include('crud::columns.'.$column['type'])
		                        @else
                              {!! $value !!}
		                        @endif
		                      @endif
		                    @endif
                        </td>
		            </tr>
                @endif
		        @endforeach

		        </tbody>
			</table>
	    </div><!-- /.box-body -->
	  </div><!-- /.box -->

	</div>
</div>


                    </div>
                
            </div>
            @endforeach
        </div>



          @if ( $crud->buttons()->where('stack', 'bottom')->count() )
          <div id="bottom_buttons" class="d-print-none text-center text-sm-left">
            @include('crud::inc.button_stack', ['stack' => 'bottom'])

            <div id="datatable_button_stack" class="float-right text-right hidden-xs"></div>
          </div>
          @endif

    </div>

  </div>

@endsection

@section('after_styles')
  <!-- DATA TABLES -->
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css').'?v='.config('backpack.base.cachebusting_string') }}">
  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/form.css').'?v='.config('backpack.base.cachebusting_string') }}">
  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/list.css').'?v='.config('backpack.base.cachebusting_string') }}">

  <!-- CRUD LIST CONTENT - crud_list_styles stack -->
  @stack('crud_list_styles')
@endsection

@section('after_scripts')
  @include('crud::inc.datatables_logic')
  <script src="{{ asset('packages/backpack/crud/js/crud.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>
  <script src="{{ asset('packages/backpack/crud/js/form.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>
  <script src="{{ asset('packages/backpack/crud/js/list.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>

  <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
  @stack('crud_list_scripts')
@endsection
