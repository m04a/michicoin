@extends(backpack_view('layouts.top_left'))

@php
    $breadcrumbs = [
        trans('backpack::crud.admin') => backpack_url('dashboard'),
        trans('admin.email_cfg') => false,
    ];
@endphp

@section('header')
    <section class="container-fluid">
        <h2>
            <span class="text-capitalize">{{ trans('admin.email_cfg') }}</span>
        </h2>
    </section>
@endsection

@section('content')
    <!-- Default box -->

    <form method="post" action="{{ backpack_url('email/save') }}">
        @csrf



        <div class="card">
            <div class="card-body bold-labels">

                <div class="row">
                    <div class="col-md-6 col-xl-3 form-group">
                        <label for="mail_host" class="">{{ __('admin.mail_mailer') }}</label>
                        <select class="form-control" required name="mail_mailer">
                            <option value="sendmail" @if (getenv('MAIL_MAILER') == 'sendmail') selected @endif>
                                {{ __('admin.mail_mailer_sendmail') }}</option>
                            <option value="smtp" @if (getenv('MAIL_MAILER') == 'smtp') selected @endif>
                                {{ __('admin.mail_mailer_smtp') }}</option>
                        </select>
                        <div>
                            <small class="text-muted">
                                {{ __('admin.mail_mailer_help') }}
                            </small>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 form-group">
                        <label for="mail_host" class="">{{ __('admin.mail_host') }}</label>
                        <input type="text" required name="mail_host" id="mail_host" value="{{ getenv('MAIL_HOST') }}"
                            class="form-control">
                        <div>
                            <small class="text-muted">
                                {{ __('admin.mail_host_help') }}
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 form-group">
                        <label for="mail_port" class="">{{ __('admin.mail_port') }}</label>
                        <input type="number" required step="1" min="0" max="99999" name="mail_port" id="mail_port"
                            value="{{ getenv('MAIL_PORT') }}" class="form-control">
                        <div>
                            <small class="text-muted">
                                {{ __('admin.mail_port_help') }}
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 form-group">
                        <label for="mail_username" class="">{{ __('admin.mail_username') }}</label>
                        <input type="text" required name="mail_username" id="mail_username" value="{{ getenv('MAIL_USERNAME') }}"
                            class="form-control">
                        <div>
                            <small class="text-muted">
                                {{ __('admin.mail_username_help') }}
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 form-group">
                        <label for="mail_password" class="">{{ __('admin.mail_password') }}</label>
                        <input type="text" required name="mail_password" id="mail_password" value="{{ getenv('MAIL_PASSWORD') }}"
                            class="form-control">
                        <div>
                            <small class="text-muted">
                                {{ __('admin.mail_password_help') }}
                            </small>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 form-group">
                        <label for="mail_encryption" class="">{{ __('admin.mail_encryption') }}</label>
                        <select class="form-control" required name="mail_encryption">
                            <option value="null" @if (getenv('MAIL_ENCRYPTION') == 'null') selected @endif>
                                {{ __('admin.mail_encryption_none') }}</option>
                            <option value="SSL" @if (getenv('MAIL_ENCRYPTION') == 'SSL') selected @endif>
                                {{ __('admin.mail_encryption_ssl') }}</option>
                            <option value="TLS" @if (getenv('MAIL_ENCRYPTION') == 'TLS') selected @endif>
                                {{ __('admin.mail_encryption_tls') }}</option>

                        </select>
                        <div>
                            <small class="text-muted">
                                {{ __('admin.mail_encryption_help') }}
                            </small>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 form-group">
                        <label for="mail_from_address" class="">{{ __('admin.mail_from_address') }}</label>
                        <input type="email" name="mail_from_address" required id="mail_from_address"
                            value="{{ getenv('MAIL_FROM_ADDRESS') }}" class="form-control">
                        <div>
                            <small class="text-muted">
                                {{ __('admin.mail_from_address_help') }}
                            </small>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 form-group">
                        <label for="mail_from_name" class="">{{ __('admin.mail_from_name') }}</label>
                        <input type="text" name="mail_from_name" required id="mail_from_name"
                            value="{{ getenv('MAIL_FROM_NAME') }}" class="form-control">
                        <div>
                            <small class="text-muted">
                                {{ __('admin.mail_from_name_help') }}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                       <i class="la la-save"></i> {{ __('admin.save') }}
                    </button>
                </div>

            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </form>


    <form method="post" action="{{ backpack_url('email/test') }}">
        @csrf

        <div class="card">
            <div class="card-body bold-labels">

                @if(Session::has('error_test'))
                    <div class="alert alert-danger">
                        {{Session::get('error_test')}}
                    </div>
                @endif

                <div class="form-group">
                    <label for="mail_test" class="">{{ __('admin.mail_test') }}</label>
                    <input type="email" name="mail_test" id="mail_test" required class="form-control">
                    <div>
                        <small class="text-muted">
                            {{ __('admin.mail_test_help') }}
                        </small>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-send"></i>   {{ __('admin.test') }}
                    </button>
                </div>

            </div>
        </div>
    </form>
@endsection
