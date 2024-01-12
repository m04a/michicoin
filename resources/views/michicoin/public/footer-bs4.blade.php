{!! App\Models\FnxCookie::scripts('footer') !!}

@if(!Session::get('accept_cookies') )

<div id="cookie-banner" >
    <div class="container">
        <p class="text-banner">{{__('cookies.cookie_msg')}}</p>
        <div class="text-center">
            <button class="btn btn-success mb-3 js-accept-cookie">
               <i class="la la-check"></i> {{__('cookies.btn_accept_cookie')}}
            </button>
            <button class="btn btn-info mb-3" data-toggle="modal" data-target="#modalCookies">
               <i class="la la-cogs"></i> {{__('cookies.btn_configure_cookie')}}
            </button>
            @if($cookiespage)
            <a class="btn btn-primary mb-3" href="{{$cookiespage->url}}"><i class="la la-eye"></i> {{__('cookies.btn_view_cookies')}}</a> 
            @endif
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

.toggle input {
    height: 40px;
    left: 0;
    opacity: 0;
    position: absolute;
    top: 0;
    width: 40px;
  }
  .toggle {
    position: relative;
    display: inline-block;
  }
  
  label.toggle-item {
    width: 2em;
    background: #2e394d;
    height: 1em;
    display: inline-block;
    border-radius: 50px;
    margin: 0px;
    position: relative;
    transition: all .3s ease;
    transform-origin: 20% center;
    cursor: pointer;
  }
  label.toggle-item:before {
    content: '';
    position: absolute;
    display: block;
    transition: all .2s ease;
    width: 2.3em;
    height: 2.3em;
    top: .1em;
    left: .1em;
    border-radius: 2em;
    border: 2px solid #88cf8f;
    transition: .3s ease;
  }
  
  .toggle label {
    background: #af4c4c;
    border: 0.5px solid rgba(117, 117, 117, 0.31);
   /* box-shadow: inset 0px 0px 4px 0px rgba(0, 0, 0, 0.2), 0 -3px 4px rgba(0, 0, 0, 0.15);*/
  }
  .toggle label:before {
    content: '';
    position: absolute;
    border: none;
    width: 0.7em;
    height: 0.7em;
    box-shadow: inset 0.5px -1px 1px rgba(0, 0, 0, 0.35);
    background: #fff;
    transform: rotate(-25deg);
  }
  .toggle label:after {
    content: '';
    position: absolute;
    background: transparent;
    height: calc(100% + 8px);
    border-radius: 30px;
    top: -5px;
    width: calc(100% + 8px);
    left: -4px;
    z-index: 0;
    box-shadow: inset 0px 2px 4px -2px rgba(0, 0, 0, 0.2), 0px 1px 2px 0px rgba(151, 151, 151, 0.2);
  }
  
  .toggle input:checked + label {
    background: #4caf50;
  }
 .toggle input:checked + label:before {
    left: 1.25rem;
  }

  .toggle.readonly input + label {
    background: #145c82;
  }
  
  .toggle.readonly input + label:before {
    left: 1.25rem;
  }
</style>




<div class="modal fade" id="modalCookies" tabindex="-1" aria-labelledby="modalCookiesLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCookiesLabel"> {{__('cookies.cookies_prefrences_modal')}}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

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
                        <div class="toggle readonly">
                            <input ckecked readonly type="checkbox" id="basic_cookies" value="1"/>
                            <label class="toggle-item" for="basic_cookies"></label>
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
                        <div class="toggle">
                            <input id="ck{{$cc->id}}" {{Session::get('Fnx_Cookies_'.$cc->id)?'checked':''}} type="checkbox" class="js-toggle-cookie" value="{{$cc->id}}"/>
                            <label class="toggle-item" for="ck{{$cc->id}}"></label>
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
            <i class="la la-save"></i>   {{__('cookies.btn_cookies_save_preference')}}
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
            request.open('GET', 'toggle-cookies?v='+values);
            request.send();
            cookie_banner.classList.add('hide'); 
        });

    }


</script>