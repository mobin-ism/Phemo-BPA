<?php
    if (isset($employee))
        $id = $employee->id;
    else
        $id = $employee_id;
?>
@foreach (App\Employee::find($id)->documents as $document)
    <div class="m-widget4__item">
        <div class="m-widget4__img m-widget4__img--icon">
            <img src="{{asset('public/backend/massets/app/media/img/files/'.$document->type.'.svg')}}" alt="">
        </div>
        <div class="m-widget4__info">
            <span class="m-widget4__text">
                {{$document->file}}
            </span>
            @if ($document->label != null)
            <br>
            <span class="m-badge m-badge--metal m-badge--wide">
                {{ $document->label }}
            </span>
            @endif
        </div>
        <div class="m-widget4__ext">
            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push" 
                m-dropdown-toggle="hover" aria-expanded="true">
                <a href="#" class="m-portlet__nav-link m-dropdown__toggle btn btn-secondary m-btn m-btn--icon m-btn--pill">
                    <i class="la la-ellipsis-h"></i>
                </a>
                <div class="m-dropdown__wrapper" style="z-index: 101;">
                    <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust" style="right: auto; left: 29.5px;"></span>
                    <div class="m-dropdown__inner">
                        <div class="m-dropdown__body">
                            <div class="m-dropdown__content">
                                <ul class="m-nav">
                                    <li class="m-nav__section m-nav__section--first">
                                        <span class="m-nav__section-text">
                                            {{ __('web.quick_actions') }}
                                        </span>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="{{route('employees.download', $document->file)}}" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-download"></i>
                                            <span class="m-nav__link-text">
                                                {{ __('web.download') }}
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link"
                                            onclick="presentModal('{{route('employees.edit_label', $document->id)}}', '{{__('web.edit_label')}}')">
                                            <i class="m-nav__link-icon flaticon-edit"></i>
                                            <span class="m-nav__link-text">
                                                {{ __('web.edit_label') }}
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link"
                                            onclick="confirmModal('{{route('employees.trash', $document->file)}}')">
                                            <i class="m-nav__link-icon flaticon-cancel"></i>
                                            <span class="m-nav__link-text">
                                                {{ __('web.delete') }}
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach