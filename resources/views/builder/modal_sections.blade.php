<div class="modal modal-builder fade" id="sectionsBuilderModal" tabindex="-1" role="dialog" aria-labelledby="sectionsBuilderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="sectionsBuilderModalLabel">{{__('builder.add_section')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="la la-times"></i>
            </button>
        </div>
        <div class="modal-body">
           

            @foreach($rows as $row_type=>$crows)
                <div class="mb-5">
                    <h4>{{$row_type}}</h4>      
                    <div class="row">      
                        @foreach($crows as $row_name=>$row_options)
                        <div class="col-12 col-md-6 col-lg-4 text-center mb-3 " >
                            <a href="#{{$row_name}}" role="button" class="js-fnx-builder-add-row fnxbuilder-pickwidget " data-dismiss="modal" data-options="{{json_encode($row_options)}}"">
                                <div>
                                    <div class="row mb-2">
                                        @foreach($row_options['columns'] as $rcol)
                                            <div class="{{$rcol}} border py-4"></div>
                                        @endforeach
                                    </div>
                                {{$row_name}}
                                </div>                    
                            </a>               
                        </div>        

                        @endforeach
                    </div>
                </div>


            @endforeach

        </div>

        </div>
    </div>
</div>