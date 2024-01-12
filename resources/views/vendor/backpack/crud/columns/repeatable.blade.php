<?php 
    $values = $entry->{$column['name']};
?>
<div class="row">
@foreach((array)$values as $val)
<div class="col-md-6 col-lg-4">
    <div class="card bg-light">
        <div class="card-body">
            @foreach($column['fields'] as $f)
            <?php 
                $k = $f['name'];             
                $v = $val->$k ?? '';
                $t =  $f['type'] ?? '';   
                $show_class = $f['show_class'] ?? '';   
            ?>
            <div class="mb-3">
                <b class="d-block">{{$f['label'] ?? ''}}</b>
                @if($t=='browse_image')
                <img src="{{url($v)}}" alt="" class="img-fluid">
                @elseif($t=='icon_picker')
                <i class="{{$show_class}} {{$v}}"></i>
                @else
                <!-- {{$t}} -->
                {{$v}}
                @endif
            </div>
      

            @endforeach
        </div>
    </div>
</div>

@endforeach
</div>


<?php 
    $css = '';
    foreach($column['fields'] as $f){
        $t =  $f['type'] ?? '';
        if($t=='icon_picker'){
            $css = $f['css'] ?? '';
        }
    }
?>
@if($css!='')
<link rel="stylesheet" type="text/css" href="{{ $css }}">
@endif
