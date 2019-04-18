@if (is_permitted('doc_view'))
@extends('backend.layouts.master')
@section('content')
    
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.documents')}}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
            </ul>
        </div>
        @if (is_permitted('doc_create'))
        <div>
            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                    <i class="la la-plus m--hide"></i>
                    <i class="la la-ellipsis-h"></i>
                </a>
                <div class="m-dropdown__wrapper" style="z-index: 101;">
                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 21.5px;"></span>
                    <div class="m-dropdown__inner">
                        <div class="m-dropdown__body">
                            <div class="m-dropdown__content">
                                <ul class="m-nav">
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link"
                                            onclick="presentModal('{{route('folders.create')}}', '{{__('web.new_folder')}}')">
                                            <i class="m-nav__link-icon la la-folder"></i>
                                            <span class="m-nav__link-text">{{__('web.new_folder')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="m-content">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <div class="row">
                @if(count($folders) > 0)
                @foreach ($folders as $folder)
                    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6 text-center mb-5">
                        <a href="{{route('folders.show', $folder->id)}}" style="color: #575962;">
                            <span><div class="folder folder-{{$folder->color}}"></div></span>
                            <p class="m--font-bolder text-center mt-3">{{$folder->name}}</p>
                        </a>
                        <span class="text-muted">
                            <i class="la la-file"></i> {{\App\Document::where('folder_id', $folder->id)->count()}}
                            &nbsp;
                            @php
                                $size = \App\Document::where('folder_id', $folder->id)->sum('size');
                            @endphp
                            <i class="la la-hdd-o"></i> {{format_bytes($size)}}
                        </span>
                        @if (is_permitted('doc_edit'))
                        <br>
                        <span>
                            <a href="#" class="m-link"
                                onclick="presentModal('{{route('folders.edit', $folder->id)}}', '{{__('web.edit_folder')}}')">
                                <i class="la la-edit"></i>
                            </a>
                        </span>
                        @endif
                    </div>
                @endforeach
                @endif
                @if(count($folders) < 1)
                    <div class="col text-center">
                        @if (is_permitted('doc_create'))
                        <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air"
                            onclick="presentModal('{{route('folders.create')}}', '{{__('web.new_folder')}}')">
                            <span>
                                <i class="la la-folder"></i>
                                <span>{{__('web.new_folder')}}</span>
                            </span>
                        </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@endif