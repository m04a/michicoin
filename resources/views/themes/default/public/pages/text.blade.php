@extends('themes.default.public.layouts.base')
@section('content')
@include('builder.render',['fbcontent'=>$page->getContent('builder')])


@stop