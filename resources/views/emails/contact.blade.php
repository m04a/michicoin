@component('mail::message')

<ul>
@foreach($sendFields as $field=>$val)
<li><b>{{$field}}</b> {{$val}}</li>
@endforeach
</ul>


@endcomponent
