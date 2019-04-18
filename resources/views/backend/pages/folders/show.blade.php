@if (is_permitted('doc_view'))
@extends('backend.layouts.master')
@section('content')
    
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                {{\App\Folder::where('id', $folder_id)->first()->name}}
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="{{route('documents.index')}}" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('web.documents')}}</span>
                    </a>
                </li>
            </ul>
        </div>
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
                                    @if (is_permitted('doc_create'))
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link"
                                            onclick="presentModal('{{route('documents.create', $folder_id)}}', '{{__('web.new_document')}}')">
                                            <i class="m-nav__link-icon la la-file"></i>
                                            <span class="m-nav__link-text">{{__('web.new_document')}}</span>
                                        </a>
                                    </li>
                                    @endif
                                    @if (is_permitted('doc_delete'))
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link"
                                            onclick="confirmModal('{{route('folders.delete', $folder_id)}}')">
                                            <i class="m-nav__link-icon la la-trash"></i>
                                            <span class="m-nav__link-text">{{__('web.delete_this_folder')}}</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="m-content">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('web.document')}}</th>
                                    <th>{{__('web.uploaded_by')}}</th>
                                    <th>{{__('web.created_at')}}</th>
                                    <th>{{__('web.file_size')}}</th>
                                    <th>{{__('web.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Document::where('folder_id', $folder_id)->orderBy('created_at', 'desc')->get() as $doc)
                                <tr>
                                    <td>
                                        <img src="{{asset('public/backend/massets/app/media/img/files/'. $doc->extension . '.svg')}}" width="20">
                                        &nbsp;
                                        <a href="{{route('documents.preview', $doc->id)}}" class="m-link" data-container="body" data-toggle="m-tooltip" data-placement="top" 
                                            data-original-title="{{$doc->notes}}">
                                            {{$doc->name}}
                                        </a>
                                    </td>
                                    <td>{{\App\User::where('id', $doc->user_id)->first()->name}}</td>
                                    <td>{{$doc->created_at}}</td>
                                    <td>{{format_bytes($doc->size)}}</td>
                                    <td>
                                        @if (is_permitted('doc_view'))
                                        <a href="{{route('documents.preview', $doc->id)}}" class="btn btn-metal m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                                            <i class="la la-eye"></i>
                                        </a>
                                        <a href="{{route('documents.download', $doc->id)}}" class="btn btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air">
                                            <i class="la la-download"></i>
                                        </a>
                                        @endif
                                        @if (is_permitted('doc_delete'))
                                        <a href="#" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--pill m-btn--air"
                                            onclick="confirmModal('{{route('documents.delete', $doc->id)}}')">
                                            <i class="la la-trash"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@endif