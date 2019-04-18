@extends('backend.layouts.master')
@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{__('web.quote_details')}}</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    @if (is_permitted('quote_view'))
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="{{route('quotes.index')}}" class="m-nav__link">
                            <span class="m-nav__link-text">{{__('web.quotes')}}</span>
                        </a>
                    </li>
                    @endif
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
                                        @if(is_permitted('quote_edit'))
                                        <li class="m-nav__item">
                                            <a href="{{route('quotes.edit', $quote)}}" class="m-nav__link">
                                                <i class="m-nav__link-icon la la-edit"></i>
                                                <span class="m-nav__link-text">{{__('web.edit')}}</span>
                                            </a>
                                        </li>
                                        @endif
                                        <li class="m-nav__item">
                                            <a href="#" class="m-nav__link"
                                                onclick="printQuote()">
                                                <i class="m-nav__link-icon la la-print"></i>
                                                <span class="m-nav__link-text">{{__('web.print')}}</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="{{route('quotes.download', $quote->id)}}" class="m-nav__link">
                                                <i class="m-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="m-nav__link-text">{{__('web.download')}}</span>
                                            </a>
                                        </li>
                                        @if(is_permitted('quote_edit'))
                                        <li class="m-nav__item">
                                            <a href="{{route('customers.email_quote', $quote->id)}}" class="m-nav__link">
                                                <i class="m-nav__link-icon la la-send"></i>
                                                <span class="m-nav__link-text">{{__('web.email_customer')}}</span>
                                            </a>
                                        </li>
                                        @if(\App\Invoice::where(['account_id' => Auth::user()->account_id, 'quote_id' => $quote->id])->count() < 1)
                                        <li class="m-nav__item">
                                            <a href="#" class="m-nav__link"
                                                onclick="presentModal('{{route('quotes.make_invoice', $quote->id)}}', '{{__('web.invoice_information')}}')">
                                                <i class="m-nav__link-icon la la-file-text"></i>
                                                <span class="m-nav__link-text">{{__('web.make_invoice')}}</span>
                                            </a>
                                        </li>
                                        @endif
                                        @endif
                                        @if(is_permitted('quote_delete'))
                                        <li class="m-nav__item">
                                            <a href="#" class="m-nav__link"
                                                onclick="confirmModal('{{route('quotes.delete', $quote->id)}}')">
                                                <i class="m-nav__link-icon la la-trash"></i>
                                                <span class="m-nav__link-text">{{__('web.delete')}}</span>
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

    @include('backend.pages.quotes.quote')

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.minicolors').minicolors({
                theme: 'bootstrap'
            });
        });
        function printQuote() {
            $('#quote-portlet').printThis({
                importStyle: true,
                pageTitle: '{{$quote->quote_no}}',
                removeInline: false
            });
        }
    </script>
@endsection