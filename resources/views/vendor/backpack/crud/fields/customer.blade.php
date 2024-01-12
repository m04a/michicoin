<?php 
    $customer = $field['value'] ?? false;

?>
@if($customer)
    <div class="col-md-12 text-right">
        <a href="{{backpack_url('shop/customer/'.$customer->id.'/edit')}}" target="_blank" class="btn btn-info">
            <i class="la la-edit"></i> {{__('shop.edit_customer')}}
        </a>
    </div>
    <div class="col-md-4 form-group">
        <label for="">{{__('shop.customer_name')}}</label>
        <div>{{$customer->fullname}}</div>
    </div>
    <div class="col-md-4  form-group">
        <label for="">{{__('shop.customer_email')}}</label>
        <div>{{$customer->email}}</div>
    </div>
    <div class="col-md-4  form-group">
        <label for="">{{__('shop.customer_phone')}}</label>
        <div>{{$customer->phone}}</div>
    </div>

@endif