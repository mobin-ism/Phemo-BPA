@extends('backend.layouts.master')
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.system_preferences')}}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="m-content">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12">
            @include('backend.partials.settings')
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{__('web.email_templates')}}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col">
                            <div class="m-portlet m-portlet--mobile">
                                <div class="m-portlet__head" style="border: none;">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <h3 class="m-portlet__head-text" onclick="toggleSection('account_opening_email')" style="cursor: pointer;">
                                                <span class="account_opening_email"><i class="la la-plus"></i></span> &nbsp; &nbsp; {{__('web.account_opening_email')}}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__body account_opening_email m--hide">
                                    <div class="alert m-alert--default mb-5" role="alert">
                                        <strong>Hello World!</strong> This is default alert message box style.
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group m-form__group">
                                            <div class="summernote" id="m_summernote_1">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group">
                                            <button type="submit" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                                <span>
                                                    <i class="la la-save"></i>
                                                    <span>{{__('web.save')}}</span>
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        function toggleSection(section) {
            if ($('div.' + section).hasClass('m--hide')) {
                $('div.' + section).removeClass('m--hide');
                $('span.'+ section).html('<i class="la la-minus"></i>');
            } else {
                $('div.' + section).addClass('m--hide');
                $('span.'+ section).html('<i class="la la-plus"></i>');
            }            
        }
    </script>
@endsection