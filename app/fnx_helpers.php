<?php
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Theme;


    function redirectPage($template,$msg='',$type='success',$extraparams=''){
        $page = \App\Models\Page::with('fnx_url')->where('template',$template)->first();
        if($page){
            $goto = $page->url;
        }
        else{
            $goto = '';
        }
        if($msg!=''){
            return redirect($goto.$extraparams)->with($type,$msg);
        }
        return redirect($goto.$extraparams);
    }

    function themeConfigFile(){
        return resource_path('views/themes/'.getTheme().'/config.php');
    }


    function hasModule($module){
        $path = base_path('modules/'.$module);
        return file_exists($path) && is_dir($path);
    }

    function getTheme(){
        $active = Theme::where('default',1)->first();
        if(!$active){
            $first = Theme::first();
            if($first){
                $first->default = true;
                $first->save();
                return $first->name;
            }
            else{
                return '';
            }
        }
        return $active->name;
    }

    function getThemeOption($key,$content=FALSE,$default=''){
        if($content){
            $source = Config::get('theme_content');
        }
        else{
            $source = Config::get('theme_extras');
        }

        try{
            $json = json_decode($source);
            if(isset($json->$key)){
                $decoded = json_decode($json->$key);
                if(json_last_error() == JSON_ERROR_NONE){
                    return $decoded;
                }
                else{
                    return $json->$key;
                }
            }
        }
        catch(\Exception $e){
            return $default;
        }

        return $default;


    }

    function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $paginator = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    
        $paginator->setPath(\Request::path());
    
        return $paginator;
    }

    function getSetting($key,$content=FALSE,$default=''){
        $parts = explode('_',$key);
        $settings = Config::get('fnx_settings');
        if($settings){
            $setting = $settings->where('key',$parts[0])->first();
            if($setting){
            if($content){
                return $setting->getContent($key,$default);
            }
            else{
                return $setting->getExtra($key,$default);
            }
            }
        }
        return $default;
    }

    function price($price){
        try{
            $return =number_format($price, 2, ",", ".") .' €';
        }
        catch(\Exception $e){
            return $price.' €';
        }
        
        return $return;
    }



    function getMenu($position){
        $menus = Config::get('fnx_menus');
        if($menus){
            return $menus->where('position',$position);
        }
        else{
            return [];
        }
        
    }

    //FUNCIONS INTERNES PER MENUS
    function getMenuPositions()
    {
        include(resource_path('views/themes/'.getTheme().'/menu_positions.php'));

        if (! count($positions)) {
            abort(503, trans('admin.template_not_found'));
        }
        return $positions;
    }

     function getMenuPositionsArray()
    {
       include(resource_path('views/themes/'.getTheme().'/menu_positions.php'));

        if (! count($positions)) {
            abort(503, trans('admin.template_not_found'));
        }

        return array_keys($positions);
    }

    function sort_object_by_position($a,$b){
        $pos_a = $a->position ?? 0;
        $pos_b = $b->position ?? 0;
        return $pos_a > $pos_b ;
    }

//--FI FUNCIONS INTERNES PER MENUS

//Retorna una nueva imagen con las dimensiones height i width. Si no se da alguna de las dos dimensiones se calcula segun el modo i ratio
// $mode
//        CROP => corta la imagen, haciendo zoom hasta que todo el tamaño nuevo tiene imagen
//        DISORT => distorsiona la imagen para que quepa en las nuevas medidas
//        KEEP => mantiene la imagen sin distorsionar ni recortar, ajustandola al tamaño solicitado. Puede devolver imagenes menos anchas o altas que lo solicitado

function getImage($src, $width = '', $height = '', $mode = 'CROP', $options = array()) {
    // $enlarge => TRUE/FALSE . Segun es cierto o falso, si la imagen original es más pequeña solo se harà más grande si enlarge es true
    $enlarge = isset($options['enlarge']) ? $options['enlarge'] : TRUE;
    // $addWatermark => Indica si añadimos marca de alguna
    $addWatermark = isset($options['addWatermark']) ? $options['addWatermark'] : FALSE;
    //$watermarkfile => El fichero de marca de agua a añadir
    $watermarkfile = isset($options['watermarkfile']) ? $options['watermarkfile'] : 'watermark.png';
    //$noimage, la imagen a cargar si no tenemos la original
    $noimage = isset($options['noimage']) ? $options['noimage'] : '';

    //Si la imagen original es demasiado grande para ser tratada o las dimensiones solicitadas son demasiado grandes, retornamos la original
    $mem_max_size = 10000;
    //Como màximo permitiremos imàgenes en Full HD (1920x1080) o lo que diga la config.
    $image_max_width =  1920;
    $image_max_heigth =  1080;
    //si no es una extension permitida, ignoramos
    $allowed_extensions = ['jpg', 'jpeg','png','gif'];

    //Analizamos el $src para obtener Si nombre, extensión y ruta
    $parts = explode('/', $src);
    $filename = end($parts);
    $file_parts = explode('.', $filename);
    $extension =  strtolower(end($file_parts));
    array_pop($file_parts);

    if(!in_array($extension, $allowed_extensions))
        return $src;

    $filename = implode('_', $file_parts);
    $filename = Str::slug($filename) . '.' . $extension;

    array_pop($parts);
    $dirname = implode('_', $parts);

    //Si el fichero esta en blanco o no existe y tenemos no image, usaremos no image. Si no tenemos noimage retornaremos vacio
    if ($src == '' ?? ! file_exists($src)) {
        if ($noimage != '' && file_exists($noimage)) {
            $src = $noimage;
        } else {
            return '';
        }
    }

    $mode = strtoupper($mode);

    //Obtenemos la información de la imagen (dimensiones y tipo). Si no podemos retornamos la imagen sin retocar
    try {
        $info = getimagesize($src);
    } catch (Exception $e) {
        return $src;
    }

    if (!isset($info[1])) {//Si no podemos obtener información, retornamos el original
        return $src;
    }

    $w = $info[0];
    $h = $info[1];

    //Ratio de la imagen ORIGINAL
    $ratio = $w / $h;

    if ($width == '' && $height == '') {
        $width = $w;
        $height = $h;
    }

    //Si no sabemos el ancho sabemos el alto, asi que calculamos manteniendo la proporcion
    if ($width == '') {
        $width = round($height * $ratio);
    }

    //Si no sabemos el alto sabemos el ancho, asi que calculamos manteniendo la proporcion
    if ($height == '') {
        $height = round($width / $ratio);
    }

    if ($mode == 'DISORT') {
        //Si nos piden distorsionar, el ratio sera el ratio para las conversiones de las nuevas medidas
        $ratio = $width / $height;
    }

    if ($mode == 'KEEP') {
        //si nos piden matener, haremos las dimensones finales a proporcion al ORIGINAL

        $new_height = round($width / $ratio);
        if ($new_height > $height) {
            //si la nueva altura se passa del tamaño pedido, solo calcularemos el nuevo ancho
            $width = round($height * $ratio);
        } else {
            $height = $new_height;
        }
    }

    if (!$enlarge) {
        //Si no queremos agrandar la imagen, miraremos, conservador la proporción solicitada, los nuevos máximos

        if ($w < $width) {
            $nheight = round($w / $ratio);
            if ($nheight < $height) {
                $width = $w;
                $height = $nheight;
            }
        }

        if ($h < $height) {
            $nwidth = round($height * $ratio);
            if ($nwidth < $width) {
                $height = $h;
                $width = $nwidth;
            }

        }
    }

    //EN ESTE PUNTO TENEMOS ASEGURADOS VALORES PARA HEIGHT Y WIDTH Y ADEMAS AJUSTADOS A LA PANTALLA
    //REvisamos que cumple con los parametros màximos establecidos

    if($mem_max_size>0){
        if($w > $mem_max_size)
            return $src;

        if($h > $mem_max_size)
            return $src;

        if($width > $mem_max_size)
            return $src;

        if($height > $mem_max_size)
            return $src;
    }

    //Si no existe la carpeta la crea
    if (!file_exists('imagecache')) {
        mkdir('imagecache', 0777, true);
    }


    if ($width > $image_max_width) {
        $width = $image_max_width;
        $height = round($width / $ratio);
    }
    
    if ($height > $image_max_heigth) {
        $height = $image_max_heigth;
        $width = round($height * $ratio);
    }


    //Nuestro fichero de salida se guarda en la carpeta imagecache.
    $srcmode = '_' . strtolower($mode[0]);


    if ($addWatermark) {
        $srcmode = 'w_' . $srcmode;
    }

    //En nuestro archivo de salida tendremos la width, height i si el modo
    $outputSrc = 'imagecache/' . $dirname . '_' . $width . 'x' . $height . $srcmode . '_' . $filename;
    $outputSrc = strtolower($outputSrc);


    //Si ya existe retornaremos el que ya hemos calculado
    if (file_exists($outputSrc)) {
        return url($outputSrc);
    }


    //Segun el tipo de imagen creamos un nuevo lienzo para tratarla
    if ($info[2] == IMAGETYPE_JPEG) {
        $image = imagecreatefromjpeg($src);
    } elseif ($info[2] == IMAGETYPE_GIF) {
        $image = imagecreatefromgif($src);
    } elseif ($info[2] == IMAGETYPE_PNG) {
        $image = imagecreatefrompng($src);
    } else {
        //per qualsevol altre format, retornem la imatge sense manipular
        return $src;
    }

    //creamos el lienzo de salida
    $new_image = imagecreatetruecolor($width, $height);

    //Si la imagen puede tener transparencias las conservamos
    if ($info[2] == IMAGETYPE_PNG || $info[2] == IMAGETYPE_GIF) {
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
        $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
        imagefilledrectangle($new_image, 0, 0, $width, $height, $transparent);
    }


    //Si se ha pedido hacer crop de la imagen necesitamos calcular la altura y anchura de la seleccion
    //y las coordenadas de corte
    switch ($mode) {
        case 'CROP':
            //si la imagen debe ser cortada, buscamos las coordenadas centradas para el corte
            $newratio = $width / $height;
            $w2 = round($h * $newratio);
            if ($w2 > $w) {
                $w2 = $w;
            }
            $h2 = round($w2 / $newratio);
            $x = ($w - $w2) / 2;
            $y = ($h - $h2) / 2;

            $h = $h2;
            $w = $w2;
            break;
        case 'KEEP':
        case 'DISORT':
        default:
            $x = 0;
            $y = 0;
            break;
    }


    //copiamos la imagen original a la instancia nueva.
    imagecopyresampled($new_image, $image, 0, 0, $x, $y, $width, $height, $w, $h);

    if ($addWatermark) {
        $imgwatermark = imagecreatefrompng($watermarkfile);
        // Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
        $margen_dcho = 10;
        $margen_inf = 10;
        $ww = imagesx($imgwatermark);
        $wh = imagesy($imgwatermark);
        $wratio = $ww / $wh;
        if ($ww > $width) {
            $ww = $width;
            $wh = round($ww / $wratio);
        }
        if ($wh > $height) {
            $wh = $height;
            $ww = round($wh * $wratio);
        }
        // Copiar la imagen de la estampa sobre nuestra foto usando los índices de márgen y el
        // ancho de la foto para calcular la posición de la estampa.
        //imagecopyresized($new_image, $imgwatermark, ($width - $ww)/2 , ($height - $wh)/2, 0, 0, imagesx($imgwatermark), imagesy($imgwatermark));

        imagecopyresized($new_image, $imgwatermark, $width / 2 - $ww / 2, $height / 2 - $wh / 2, 0, 0, $ww, $wh, imagesx($imgwatermark), imagesy($imgwatermark));
    }

    //guardamos la imagen en disco segun el tipo
  //  if(session('canUseWebP') && env('WEBP')){
   //     imagewebp($new_image, $outputSrc, Fnx::get('jpg_quality', false, 85));
   // }
    
    if ($info[2] == IMAGETYPE_JPEG) {
        imagejpeg($new_image, $outputSrc, 85);
    } elseif ($info[2] == IMAGETYPE_GIF) {
        imagegif($new_image, $outputSrc);
    } elseif ($info[2] == IMAGETYPE_PNG) {
        imagepng($new_image, $outputSrc);
    }

    //retornamos la imagen generada
    return $outputSrc;
}


if (!function_exists('put_permanent_env')) {
    function put_permanent_env($key, $value, $escaped=false)
    {
        $path = app()->environmentFilePath();


        if (is_bool(env($key))) {
            $old = env($key) ? 'true' : 'false';
        } elseif (env($key) === null) {
            $old = 'null';
        } else {
            $old = env($key);
        }

        if($escaped){
            //Todo entre comillas
            $value = '"'.$value.'"';
            $old = '"'.$old.'"';
        }
        $content = str_replace(
            "$key=" . $old,
            "$key=" . $value,
            file_get_contents($path)
        );



        if (file_exists($path)) {
            file_put_contents($path, $content);
        }

    }
}