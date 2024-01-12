@extends('themes.default.public.layouts.base')
@section('content')





     <div class="py-5">
         <div class="container py-md-5">
             <div class="row">
                 <div class="col-lg-8 mx-auto">
                 <form action="contact" method="POST">
                    @csrf
                    <input type="hidden" name="form" value="contact">
                      
                        <div class="mb-4">
                            <div class="title mb-2">{{__('public.contact_form')}}</div>
                            <p>{{__('public.contact_form_desc')}}</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert mt-4 alert-danger">
                            <i class="bi bi-exclamation-triangle"></i>  {{trans('public.contact_error')}}                    
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert mt-4 alert-danger">
                            <i class="bi bi-exclamation-triangle"></i>  {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert mt-4 alert-success">
                            <i class="bi bi-check-all"></i>  {{ session('success') }}
                            </div>
                        @endif
                      
                        <div class="form-floating mb-3">
                            <input type="text" id="formName" name="name" value="{{old('name')}}" placeholder="{{__('public.fullname')}} *" class="form-control  @error('name') is-invalid @enderror">
                            <label for="formName">{{__('public.name')}} <span class="req">*</span></label>
                            @error('name')
                            <div class="invalid-feedback">
                                {{__('public.required_field')}}
                            </div>                                    
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" id="formPhone" name="phone" value="{{old('phone')}}" placeholder="{{__('public.phone')}}" class="form-control  @error('phone') is-invalid @enderror">        
                            <label for="formPhone">{{__('public.phone')}} <span class="req">*</span></label>
                            @error('phone')
                            <div class="invalid-feedback">
                                {{__('public.required_field')}}
                            </div>                                    
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" id="formMail" name="email" value="{{old('email')}}" placeholder="{{__('public.email')}} *" class="form-control   @error('email') is-invalid @enderror">
                            <label for="formMail">{{__('public.email')}} <span class="req">*</span></label>

                            @error('email')
                            <div class="invalid-feedback">
                                {{__('public.required_field')}}
                            </div>                                    
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <textarea id="formComments" name="comments"  style="height: 100px" placeholder="{{__('public.comments')}}" rows="4" class="form-control">{{old('comments')}}</textarea>
                            <label for="formComments">{{__('public.comments')}} </label>

                        </div>

                        <div class="row align-items-center mb-lg-0 mb-4">
                            <div class="col-md-9 mb-3 mb-md-0">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="chkLegal">
                                    <label class="form-check-label" for="chkLegal">
                                    {{__('public.accept_conditions')}}
                                @if($legalpage)
                                <a href="{{$legalpage->url}}">
                                    <i class="bi bi-link-45deg" aria-hidden="true"></i>
                                </a>
                                @endif              
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-brand d-block w-100">{{__('public.send')}}</button>
                            </div>
                       </div>  

                      
                      
    
                       
    
                        
                    </form>

                 </div>
       
             </div>
         </div>
     </div>

@stop