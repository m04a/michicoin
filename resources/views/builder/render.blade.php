@if(isset($fbcontent))
<?php 
  include(resource_path('views/builder/config.php'));
 include(themeConfigFile());
 $theme_widgets_path =  resource_path('views/themes/'.getTheme().'/builder').'/';
$default_widgets_path = resource_path('views/builder/').'/';
?>
@if($fbcontent && count($fbcontent))
@foreach($fbcontent as $dcont)
<?php 
    $style = '';
   
    if(isset($dcont->pt) && $dcont->pt > 0){
        $style.="padding-top:".$dcont->pt.'px; ';
    }
    if(isset($dcont->pb) && $dcont->pb > 0){
        $style.="padding-bottom:".$dcont->pb.'px; ';
    }
    if(isset($dcont->mt) && $dcont->mt > 0){
        $style.="margin-top:".$dcont->mt.'px; ';
    }
    if(isset($dcont->mb) && $dcont->mb > 0){
        $style.="margin-bottom:".$dcont->mb.'px; ';
    }
    if(isset($dcont->bgcolor) && $dcont->bgcolor !=''){
        $style.="background-color:".$dcont->bgcolor.'; ';
    }
    if(isset($dcont->image) && $dcont->image !=''){
        $style.="background-image:url(".$dcont->image.');background-size:cover;background-position:center ';
    }

?>
<div style="{{$style}}" class="{{ $dcont->class ?? ''}}">
    <?php 
        $container =$container ?? TRUE;
        if($container){
            $container_class = $dcont->dclass ?? 'container';
        }
        else{
            $container_class = '';
        }
        
    ?>
    <div class="{{$container_class}}">
        @foreach($dcont->sons as $drow)
        <div class="{{$drow->dclass ?? 'row'}}">
            @foreach($drow->sons as $wid=>$dcol)
            <?php 
                $style = '';
            
                if(isset($dcol->pt) && $dcol->pt > 0){
                    $style.="padding-top:".$dcol->pt.'px; ';
                }
                if(isset($dcol->pb) && $dcol->pb > 0){
                    $style.="padding-bottom:".$dcol->pb.'px; ';
                }
                if(isset($dcol->mt) && $dcol->mt > 0){
                    $style.="margin-top:".$dcol->mt.'px; ';
                }
                if(isset($dcol->mb) && $dcol->mb > 0){
                    $style.="margin-bottom:".$dcol->mb.'px; ';
                }
                if(isset($dcol->bgcolor) && $dcol->bgcolor !=''){
                    $style.="background-color:".$dcol->bgcolor.'; ';
                }
                if(isset($dcol->image) && $dcol->image !=''){
                    $style.="background-image:url(".$dcol->image.');background-size:cover;background-position:center ';
                }

            ?>

            <div class="{{$dcol->dclass ?? 'col-12'}} {{ $dcol->class ?? ''}}" style="{{$style}}">
                @if(isset(($dcol->sons[0]->sons)) && count($dcol->sons[0]->sons) > 0)
                    @foreach($dcol->sons[0]->sons as $wson)
                        @if(isset($wson->sons[0]->content))
                            <?php 
                                $fbcc = json_decode($wson->sons[0]->content);
                            ?>
                            @if(isset($wson->widget) && $wson->widget!='')
                                @if(file_exists($theme_widgets_path.$wson->widget))
                                    @include('themes.'.getTheme().'.builder.'.$wson->widget.'.public')
                                @elseif(file_exists($default_widgets_path.$wson->widget))
                                    @include('builder.'.$wson->widget.'.public')
                                @endif
                            @endif
                        @endif
                    @endforeach
                @endif






            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>
@endforeach
@endif
@endif