{!! App\Models\FnxCookie::scripts('body') !!}

@if(backpack_user() && isset($url) && $url->item)

<style>
    .fnx-public-admin-bar{
        background-color:#2f353a;
        color:white;
        padding:0.5rem 0;
        font-size:0.8rem;
        position:fixed;
        bottom:0;
        width:100%;
        left:0;
        z-index: 9999;
    }
    .btn-fnx-admin-edit{
        background-color:#903188;
        color:white;
        padding: 5px 10px;
        font-size: 0.8rem;
        border:1px solid #903188;
    }
    .btn-fnx-admin-edit:hover{
        color:white;
        background-color:#2f353a;
    }
</style>

<div class="fnx-public-admin-bar">
    <div class="container " >
        <div class="row align-items-center">
            <div class="col">
                <a href="{{backpack_url('')}}" class="btn-fnx-admin-edit d-flex-inline align-items-center">
                <i class="bi bi-speedometer"></i>
                    {{__('admin.go_admin')}}
                </a>        
            </div>
            <div class="col me-auto text-center">
                <a href="{{$url->item->adminEditUrl()}}" class="btn-fnx-admin-edit">
                    <i class="bi bi-pencil"></i>
                    {{$url->item->adminName()}} {{$url->item->id}} <small>{{$url->item->title}}</small>
                </a>
            </div>

            <div class="col me-auto text-end">
                <a href="{{backpack_url('logout')}}" class="btn-fnx-admin-edit">
                    <i class="bi bi-box-arrow-right"></i>
                    {{backpack_user()->name}} 
                </a>
            </div>
        </div>
        
    </div>
</div>

@endif