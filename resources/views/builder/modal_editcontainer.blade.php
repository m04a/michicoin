<div class="modal fade modal-builder " id="modalFnxContainerEdit" tabindex="-1" role="dialog" aria-labelledby="modalFnxContainerEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalFnxContainerEditLabel">{{__('builder.edit_container')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="la la-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="form-group">
                        <label for="">{{__('builder.container_class')}}</label>
                        <input type="text" class="form-control" value="" id="fbcont-class">
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="form-group">
                        <label for="">{{__('builder.container_padding_top')}}</label>
                        <input type="number" min="0" step="1" class="form-control text-right" value="0" id="fbcont-pt">
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="form-group">
                        <label for="">{{__('builder.container_padding_bottom')}}</label>
                        <input type="number" min="0" step="1" class="form-control text-right" value="0" id="fbcont-pb">
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="form-group">
                        <label for="">{{__('builder.container_margin_top')}}</label>
                        <input type="number" min="0" step="1" class="form-control text-right" value="0" id="fbcont-mt">
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="form-group">
                        <label for="">{{__('builder.container_margin_bottom')}}</label>
                        <input type="number" min="0" step="1" class="form-control text-right" value="0" id="fbcont-mb">
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="form-group">
                        <label for="">{{__('builder.bg_color')}}</label>
                        <input type="color" class="form-control" value="#FFFFFF" id="fbcont-bgcolor">
                    </div>
                </div>

                <div class="col-12">
                        <div class="form-group">
                            <label for="">{{__('builder.bg_img')}}</label>
                            <div class="controls text-center js-change-browse-image-check">
                                <img src="" id="imgfbcont-image" class="image mx-auto mb-3 img-fluid d-none" alt="">

                                <div class="input-group ">
                                    <input
                                        class="form-control"
                                        id="fbcont-image"
                                        type="text"
                                        data-baseurl="{{url('')}}/"
                                        readonly
                                    >

                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-light btn-sm popup_selector js-fnxbuilder-popup_selector" data-target="fbcont-image"><i class="la la-cloud-upload"></i> {{ trans('backpack::crud.browse_uploads') }}</button>
                                        <button type="button" class="btn btn-light btn-sm clear_elfinder_picker js-fnxbuilder-clear_elfinder_picker"  data-target="fbcont-image"><i class="la la-eraser"></i> {{ trans('backpack::crud.clear') }}</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success js-fnxbuilder-savecontainer" > <i class="la la-save"></i> {{__('builder.save')}}</button>
        </div>
        </div>
    </div>
</div>
