@extends(backpack_view('blank'))

@php
    $widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'heading'     => trans('admin.welcome'),
        'content'     => trans('admin.welcome_text'),
        'button_link' => backpack_url('logout'),
        'button_text' => trans('admin.logout'),
    ];

//Si no es vol tenir el total de imatges comentar aquesta linea i treure de la tradiccio there_are
    $total_files = count(Illuminate\Support\Facades\File::files(public_path('imagecache')));

    $widgets['before_content'][] = [
        'type'        => 'action',
        'header'     => trans('admin.media_items'),
        'content'     => __('admin.there_are',['total'=>$total_files]),
        'button_link' => backpack_url('clearmedia'),
        'button_text' => __('admin.clearmedia'),
    ];

@endphp

@section('content')

@endsection