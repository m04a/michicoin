{!! App\Models\FnxCookie::scripts('footer') !!}

@if(!Session::get('accept_cookies') )

<div id="cookie-banner" >
    <div class="container">
        <p class="text-banner">{{__('cookies.cookie_msg')}}</p>
         <div class="text-center block md:flex justify-center">
          <div>
            <button class="btn btn-success mb-3 js-accept-cookie">
                <i class="bi bi-check-all"></i> {{__('cookies.btn_accept_cookie')}}
             </button>
          </div>
          <div>
            <button class="btn btn-info mb-3" @click="openCookies = true">
                <i class="bi bi-gear"></i> {{__('cookies.btn_configure_cookie')}}
            </button>
          </div>
          <div class="mt-3 md:mt-0">
             @if($cookiespage)
                <a class="btn btn-info2 mb-3" href="{{$cookiespage->url}}"><i class="bi bi-eye"></i> {{__('cookies.btn_view_cookies')}}</a>
            @endif
          </div>
          
       </div>
    </div>
</div>

@endif

<style>
/* Copia este estilo en la hoja de estilos que quieras */
#cookie-banner{
    position:fixed;
    bottom:0;
    left:0;
    right:0;
    padding-top:1rem;
    padding-bottom:0.5rem;
    z-index:99;
    background:white;
    border-top:2px solid black;
    text-align:center;
    transition:500ms ease all;
    transform: translateY(0);
}

#cookie-banner.hide{
    transition:500ms ease all;
    transform: translateY(100%);
}

</style>




<div class="modal fade" id="modalCookies" tabindex="-1" aria-labelledby="modalCookiesLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>



      </div>
      <div class="modal-body">
      {!! __('cookies.cookies_prefrences_modal_text') !!}

      <table class="table table-stripped mt-4">
            <thead>
                <th>
                    {{__('cookies.gdpr_active')}}
                </th>
                <th class="d-none d-lg-table-cell">
                    {{__('cookies.gdpr_title')}}
                </th>
                <th class="d-none d-lg-table-cell">
                    {{__('cookies.gdpr_provider')}}
                </th>
               
                <th>
                {{__('cookies.gdpr_desc')}}
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="basic_cookies" checked disabled>
                        <label class="form-check-label" for="basic_cookies"></label>
                      </div>
                    </td>
                    <th class="d-none d-lg-table-cell">
                        {{__('cookies.gdpr_cookies_essential')}}
                    </td>
                    <th class="d-none d-lg-table-cell">
                       -
                    </td>
                    <td>
                    <div class="d-lg-none">
                    <b> {{__('cookies.gdpr_cookies_essential')}}<b><br>                   
                    </div>
                        {{__('cookies.gdpr_cookies_essential_desc')}}
                    </td>
                </tr>
                @foreach($catcookies as $cc)
                <tr>
                    <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input js-toggle-cookie" type="checkbox" {{Session::get('Fnx_Cookies_'.$cc->id)?'checked':''}} id="ck{{$cc->id}}" value="{{$cc->id}}">
                      </div>
                    </td>
                    <td class="d-none d-lg-table-cell">
                        {{$cc->provider}}
                    </td>
                    <td class="d-none d-lg-table-cell">
                        {{$cc->name}}
                    </td>
                    <td>
                    <div class="d-lg-none">
                    <b>{{$cc->name}}<b><br>
                    <i>{{$cc->provider}}</i><br>
                    </div>
                        {{$cc->description}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success js-save-cookies" data-bs-dismiss="modal" data-dismiss="modal">
            <i class="bi bi-save"></i>   {{__('cookies.btn_cookies_save_preference')}}
        </button>
      </div>
    </div>
  </div>
</div>




<script>
    var cookie_banner = document.getElementById('cookie-banner');
    var accept_cookie_class = document.getElementsByClassName("js-accept-cookie");
    var save_cookie_class = document.getElementsByClassName("js-save-cookies");


   
    for (var i = 0; i < accept_cookie_class.length; i++) {
        accept_cookie_class[i].addEventListener('click', function (e) {
            e.preventDefault();           
            cookie_banner.classList.add('hide'); 
            var request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (request.readyState == XMLHttpRequest.DONE) {
                    obj = JSON.parse(request.responseText);  
                    document.head.insertAdjacentHTML('afterend',obj.head);
                    document.body.insertAdjacentHTML('afterend',obj.footer);
                    document.body.insertAdjacentHTML('beforebegin',obj.body);
                }
            }

            request.open('GET', 'accept-cookies');
            request.send();

            
        });
    }

    for (var i = 0; i < save_cookie_class.length; i++) {
        save_cookie_class[i].addEventListener('click', function (e) {
            e.preventDefault();                       
            var selected = document.querySelectorAll('.js-toggle-cookie:checked');
            var values = '';
            for (var i = 0; i < selected.length; i++) {
                values += selected[i].value+';';
            }

            var request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (request.readyState == XMLHttpRequest.DONE) {
                    obj = JSON.parse(request.responseText);  
                    document.head.insertAdjacentHTML('afterend',obj.head);
                    document.body.insertAdjacentHTML('afterend',obj.footer);
                    document.body.insertAdjacentHTML('beforebegin',obj.body);
                }
            }
            request.open('GET', 'toggle-cookies?v='+values);
            request.send();
            cookie_banner.classList.add('hide'); 
        });

    }


</script>