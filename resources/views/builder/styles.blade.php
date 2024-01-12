<link href="{{ asset('packages/jquery-colorbox/example2/colorbox.css') }}" rel="stylesheet" type="text/css" />

<style>

    #cboxContent, #cboxLoadedContent, .cboxIframe {
        background: transparent;
    }
    .modal-builder .modal-header, .modal-builder .modal-footer{
        border: none;
    }
    .modal-builder .modal-header{
        background: #2f353a;
        color: white;
        border-radius: 0;
        padding:0.5rem 1rem;
    }
    .modal-builder .modal-header .close{
        opacity:1;
        text-shadow: none;
        color: white;
    }

    .fnx-builder-col .single-item{
        height: 100%;
        align-items: center;
        justify-content: center;
    }

    .modal-builder .modal-content{
        border-radius:0;
        border:none;
    }
    .fnx-builder-row-head {
        margin-top:20px;
        background-color:#2f353a;
        padding:0;
    }

    .fnxbuilder-action{
        font-size:1.5rem;
        color:#aaa;
    }

    .fnxbuilder-action:hover{
            color:#666;
            text-decoration:none;
    }

    .fnx-builder-row-head div{
        padding:0;
    }
    .fnx-builder-col{
        border-left:1px solid #dedede;
        background-color:white;
        padding: 0 !important;
        text-align:center;
        margin: 0 auto !important;
    }

    .fnx-builder-col-header{
        text-align:left;        
        background-color: #903188;
        padding:0 15px;
    }

    .fnx-builder-col-header a{
       color:white;  
    }

    .fnx-builder-btn-container{
        border:none;
        color:white;
        padding:5px;
        height:100%;
        display:inline-block;
        background-color:transparent;
    }
    .fnx-builder-delete-row{
        display: inline-block;
        border:none;
        background-color: #df4759;
        color:white;
        padding:5px;
        height:100%;
        display:inline-block;
        border: 1px solid #df4759;
    }

    .fnbuilder_widget_name{
        font-weight:500;
        font-size: 1rem;
        color: #2f353a;
    }

    .fnxbuilder-bg-tools{
        background-color:#2f353a;
        color:white;
        font-size:1rem;
        width: 100%;
        margin: 0;
    }
    .fnxbuilder-tool{
        color:white;
        font-size:1rem;
        padding: 0.25rem;
    }

    .fnxbuilder-tool:hover{
        text-decoration:none;
        color:#ddd;
    }

    .fnx-builder-move{
        display: inline-block;
        cursor:pointer;
        padding: 5px;
        padding-left:15px;
        height:100%;
       color:white;
    }

    .fnxbuilder-widget-title{
        color: #2f353a;
        font-weight: 300;
        font-size: 1.25rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        border-bottom: 1px solid #2f353a;
        display: inline-block;
        padding-bottom: 0px;
        margin-bottom: 10px;
      
    }
    .fnxbuilder-widget-desc{
        color: #888;
        font-weight:400;
        font-size:0.75rem;
        line-height: 0.85rem;
        font-style:italic;
    }
    .fnxbuilder-pickwidget{
        display:flex;
        align-items:center;
        justify-content:center;
        padding:0.75rem 1.25rem;
        background-color:white;
        height:100%;
        box-shadow: 0 .3rem 1rem rgba(22,28,45,.15)!important;
    }
    .fnxbuilder-pickwidget:hover{
        text-decoration:none;
        background-color:#f6f6f6;
    }

    .fnxbuilder-pickwidget .border{
        height:50px;
        padding: 0 !important;
        margin: 0 !important;
    }

    .widgets_col_area{
        min-height:72px;
        background-color:#efefef;
        margin-bottom:1rem;
    }
    .widget_container{
        background-color:white;
        padding-top:8px;
        border-bottom:1px solid #efefef;
    }

    .widget_container .preview small{
        display:block;
        border:1px solid #efefef;
        padding:5px;
        max-width:400px;
        margin:0 auto;
        background-color:#f6f6f6;
    }

    .widget_container .preview ul{
        margin:0;
    }

    .widget_container .preview img{
        display:inline-block;
        margin-right:5px;
        height:25px;
    }


</style>



@if(file_exists(resource_path('views/themes/'.getTheme().'/builder/styles.blade.php')))
@include('themes/'.getTheme().'/builder/styles')
@endif