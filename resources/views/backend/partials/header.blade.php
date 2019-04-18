<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">

            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-light">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo"
                        style="background-color: white;">
                        <a href="{{route('home')}}" class="m-brand__logo-wrapper">
                            <img width="80" src="{{asset('public/backend/assets/images/phemo_white_t.png')}}" />
                        </a>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-brand__tools">

                        <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Responsive Header Menu Toggler -->
                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Topbar Toggler -->
                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                            <i class="flaticon-more"></i>
                        </a>

                        <!-- BEGIN: Topbar Toggler -->
                    </div>
                </div>
            </div>

            <!-- END: Brand -->
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                <div class="m-header__title">
                    <h3 class="m-header__title-text">
                        @if(Auth::user()->role != 'superadmin')
                        {{ \App\Config::where('account_id', Auth::user()->account_id)->first()->company_name }}
                        @endif
                    </h3>
                </div>

                <!-- BEGIN: Horizontal Menu -->
                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                    <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                        {{-- <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">Dashboard</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " aria-haspopup="true"><a href="index.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-diagram"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Generate
                                                        Reports</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--success">2</span></span> </span></span></a></li>
                                    <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i class="m-menu__link-icon flaticon-business"></i><span
                                                class="m-menu__link-text">Manage Orders</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>
                                            <ul class="m-menu__subnav">
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Latest Orders</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Pending Orders</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Processed Orders</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Delivery Reports</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Payments</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Customers</span></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i class="m-menu__link-icon flaticon-chat-1"></i><span
                                                class="m-menu__link-text">Customer Feedbacks</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>
                                            <ul class="m-menu__subnav">
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Customer Feedbacks</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Supplier Feedbacks</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Reviewed Feedbacks</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Resolved Feedbacks</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Feedback Reports</span></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Register Member</span></a></li>
                                </ul>
                            </div>
                        </li> --}}
                        {{-- <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span
                                    class="m-menu__item-here"></span><span class="m-menu__link-text">Reports</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:600px"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                <div class="m-menu__subnav">
                                    <ul class="m-menu__content">
                                        <li class="m-menu__item">
                                            <h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">Finance Reports</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>
                                            <ul class="m-menu__inner">
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-map"></i><span class="m-menu__link-text">Annual Reports</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">HR Reports</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-clipboard"></i><span class="m-menu__link-text">IPO Reports</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-graphic-1"></i><span class="m-menu__link-text">Finance Margins</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Revenue Reports</span></a></li>
                                            </ul>
                                        </li>
                                        <li class="m-menu__item">
                                            <h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">Project Reports</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>
                                            <ul class="m-menu__inner">
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Coca Cola CRM</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Delta
                                                            Airlines Booking Site</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Malibu
                                                            Accounting</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Vineseed
                                                            Website Rewamp</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Zircon Mobile
                                                            App</span></a></li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Mercury CMS</span></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li> --}}
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'employee')
                        <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                            <a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link">
                                <span class="m-menu__item-here"></span>
                                <span class="m-menu__link-text">{{__('web.add')}}</span>
                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                <div class="m-menu__subnav p-4">
                                    <ul class="m-menu__content">
                                        <li class="m-menu__item">
                                            <h3 class="m-menu__heading m-menu__toggle">
                                                <span class="m-menu__link-text">{{__('web.general')}}</span>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </h3>
                                            <ul class="m-menu__inner">
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="#" class="m-menu__link "
                                                        onclick="presentModal('{{route('vendors.create')}}', '{{__('web.new_vendor')}}')">
                                                        <i class="m-menu__link-icon flaticon-user"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_vendor')}}</span>
                                                    </a>
                                                </li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="#" class="m-menu__link "
                                                    onclick="presentModal('{{route('customers.create')}}', '{{__('web.new_customer')}}')">
                                                        <i class="m-menu__link-icon flaticon-user-ok"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_customer')}}</span>
                                                    </a>
                                                </li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="#" class="m-menu__link "
                                                    onclick="presentModal('{{route('employees.create')}}', '{{__('web.new_employee')}}')">
                                                        <i class="m-menu__link-icon flaticon-users"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_employee')}}</span>
                                                    </a>
                                                </li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="#" class="m-menu__link "
                                                    onclick="presentModal('{{route('products.create')}}', '{{__('web.new_product')}}')">
                                                        <i class="m-menu__link-icon flaticon-bag"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_product')}}</span>
                                                    </a>
                                                </li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="#" class="m-menu__link "
                                                    onclick="presentModal('{{route('services.create')}}', '{{__('web.new_service')}}')">
                                                        <i class="m-menu__link-icon flaticon-lifebuoy"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_service')}}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="m-menu__item">
                                            <h3 class="m-menu__heading m-menu__toggle">
                                                <span class="m-menu__link-text">{{__('web.accounting')}}</span>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </h3>
                                            <ul class="m-menu__inner">
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="{{route('invoices.create')}}" class="m-menu__link ">
                                                        <i class="m-menu__link-icon flaticon-list"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_invoice')}}</span>
                                                    </a>
                                                </li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="{{route('quotes.create')}}" class="m-menu__link ">
                                                        <i class="m-menu__link-icon flaticon-interface-10"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_quote')}}</span>
                                                    </a>
                                                </li>
                                                {{-- <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="inner.html" class="m-menu__link ">
                                                        <i class="m-menu__link-icon flaticon-open-box"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_purchase_order')}}</span>
                                                    </a>
                                                </li> --}}
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="{{route('bills.create')}}" class="m-menu__link ">
                                                        <i class="m-menu__link-icon flaticon-file-1"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_bill')}}</span>
                                                    </a>
                                                </li>
                                                {{-- <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="inner.html" class="m-menu__link ">
                                                        <i class="m-menu__link-icon flaticon-notes"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_credit_note')}}</span>
                                                    </a>
                                                </li> --}}
                                            </ul>
                                        </li>
                                        <li class="m-menu__item">
                                            <h3 class="m-menu__heading m-menu__toggle">
                                                <span class="m-menu__link-text">{{__('web.administrative')}}</span>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </h3>
                                            <ul class="m-menu__inner">
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="#" class="m-menu__link "
                                                    onclick="presentModal('{{route('expenses.create')}}', '{{__('web.new_expense')}}')">
                                                        <i class="m-menu__link-icon flaticon-mark"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_expense')}}</span>
                                                    </a>
                                                </li>
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="{{route('payrolls.create')}}" class="m-menu__link ">
                                                        <i class="m-menu__link-icon flaticon-list-2"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_payroll')}}</span>
                                                    </a>
                                                </li>
                                                {{-- <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="inner.html" class="m-menu__link ">
                                                        <i class="m-menu__link-icon flaticon-list-1"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_leave_request')}}</span>
                                                    </a>
                                                </li> --}}
                                                {{-- <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="inner.html" class="m-menu__link ">
                                                        <i class="m-menu__link-icon flaticon-file-2"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_document')}}</span>
                                                    </a>
                                                </li> --}}
                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                    <a href="#" class="m-menu__link "
                                                    onclick="presentModal('{{route('tickets.create')}}', '{{__('web.new_ticket')}}')">
                                                        <i class="m-menu__link-icon flaticon-interface-9"></i>
                                                        <span class="m-menu__link-text">{{__('web.new_ticket')}}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>

                <!-- END: Horizontal Menu -->

                <!-- BEGIN: Topbar -->
                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline">
                            @if (Auth::user()->role == 'admin')
                            <li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" 
                                m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                                    <span class="m-nav__link-icon"><span class="m-nav__link-icon-wrapper"><i class="flaticon-cogwheel"></i></span></span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__section m-nav__section--first">
                                                        <span class="m-nav__section-text">
                                                            {{ __('web.preferences') }}
                                                        </span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('configs.index')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-cogwheel"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.system_preferences')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    {{-- <li class="m-nav__item">
                                                        <a href="{{route('configs.email_templates')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-email"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.email_templates')}}
                                                            </span>
                                                        </a>
                                                    </li> --}}
                                                    {{-- <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-list-1"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.invoice_templates')}}
                                                            </span>
                                                        </a>
                                                    </li> --}}
                                                    <li class="m-nav__item">
                                                        <a href="{{route('configs.permissions')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-user-settings"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.user_permissions')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('configs.notifications')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-alert"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.reminders')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__section m-nav__section--first">
                                                        <span class="m-nav__section-text">
                                                            {{ __('web.configurations') }}
                                                        </span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('departments.index')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-network"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.departments')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('customer_categories.index')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-layers"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.customer_categories')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('taxes.index')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-interface-9"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.tax')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('leave_types.index')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-app"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.leave_types')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('expense_types.index')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-coins"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.expense_types')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('job_types.index')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-more-v2"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.job_types')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('job_statuses.index')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-open-box"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.job_status')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('training_types.index')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-analytics"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.training_types')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('pay_statuses.index')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-piggy-bank"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.pay_frequency')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('salary_heads.index')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-interface-11"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.benefits_and_deductions')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item m-topbar__quick-actions m-dropdown m-dropdown--skin-light m-dropdown--large m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" 
                                m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
                                    <span class="m-nav__link-icon"><span class="m-nav__link-icon-wrapper"><i class="flaticon-share"></i></span></span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center">
                                            <span class="m-dropdown__header-title">
                                                {{ __('web.quick_actions') }}
                                            </span>
                                            <span class="m-dropdown__header-subtitle">
                                                    {{ __('web.shortcuts') }}
                                            </span>
                                        </div>
                                        <div class="m-dropdown__body m-dropdown__body--paddingless">
                                            <div class="m-dropdown__content">
                                                <div class="m-scrollable" data-scrollable="false" data-height="380" data-mobile-height="200">
                                                    <div class="m-nav-grid m-nav-grid--skin-light">
                                                        <div class="m-nav-grid__row">
                                                            <a href="#" class="m-nav-grid__item"
                                                                onclick="presentModal('{{route('products.create')}}', '{{__('web.new_product')}}')">
                                                                <i class="m-nav-grid__icon flaticon-bag"></i>
                                                                <span class="m-nav-grid__text">
                                                                        {{ __('web.add_new_product') }}
                                                                </span>
                                                            </a>
                                                            <a href="#" class="m-nav-grid__item"
                                                                onclick="presentModal('{{route('vendors.create')}}', '{{__('web.new_vendor')}}')">
                                                                <i class="m-nav-grid__icon flaticon-user"></i>
                                                                <span class="m-nav-grid__text">
                                                                        {{ __('web.add_new_vendor') }}
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="m-nav-grid__row">
                                                            <a href="#" class="m-nav-grid__item"
                                                                onclick="presentModal('{{route('customers.create')}}', '{{__('web.new_customer')}}')">
                                                                <i class="m-nav-grid__icon flaticon-user-ok"></i>
                                                                <span class="m-nav-grid__text">
                                                                        {{ __('web.add_new_customer') }}
                                                                </span>
                                                            </a>
                                                            <a href="#" class="m-nav-grid__item"
                                                                onclick="presentModal('{{route('employees.create')}}', '{{__('web.new_employee')}}')">
                                                                <i class="m-nav-grid__icon flaticon-users"></i>
                                                                <span class="m-nav-grid__text">
                                                                        {{ __('web.add_new_employee') }}
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                            <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-topbar__userpic m--hide">
                                        <img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt="" />
                                    </span>
                                    <span class="m-nav__link-icon m-topbar__usericon">
                                        <span class="m-nav__link-icon-wrapper"><i class="flaticon-user-ok"></i></span>
                                    </span>
                                    <span class="m-topbar__username m--hide"></span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center">
                                            <div class="m-card-user m-card-user--skin-light">
                                                <div class="m-card-user__pic">
                                                    @php
                                                        if (Auth::user()->role == 'customer') {
                                                            $customer_id = \App\Customer::where('user_id', Auth::user()->id)->first()->id;
                                                            $photo = profile_photo('customer', $customer_id);
                                                            $profile = route('customer.profile');
                                                        } else if (Auth::user()->role == 'vendor') {
                                                            $vendor_id = \App\Vendor::where('user_id', Auth::user()->id)->first()->id;
                                                            $photo = '';
                                                            $profile = route('vendor.profile');
                                                        } else if (Auth::user()->role == 'employee') {
                                                            $employee_id = \App\Employee::where('user_id', Auth::user()->id)->first()->id;
                                                            $photo = profile_photo('employee', $employee_id);
                                                            $profile = route('employees.show', $employee_id);
                                                        } else {
                                                            $photo = '';
                                                            $profile = '#';
                                                        }
                                                    @endphp
                                                    <img src="{{$photo}}" class="m--img-rounded m--marginless" alt="" />
                                                </div>
                                                <div class="m-card-user__details">
                                                    <span class="m-card-user__name m--font-weight-500">
                                                        {{Auth::user()->name}}
                                                    </span>
                                                    <a href="#" class="m-card-user__email m--font-weight-300 m-link">
                                                        {{Auth::user()->email}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
                                                    <li class="m-nav__item">
                                                        <a href="{{$profile}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                            <span class="m-nav__link-title">
                                                                <span class="m-nav__link-wrap">
                                                                    <span class="m-nav__link-text">{{__('web.profile')}}</span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="m-nav__link"
                                                            onclick="presentModal('{{route('profiles.change_password')}}', '{{__('web.change_password')}}')">
                                                            <i class="m-nav__link-icon flaticon-lock"></i>
                                                            <span class="m-nav__link-text">
                                                                {{__('web.change_password')}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit">
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ url('logout') }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                            {{__('web.logout')}}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            {{-- <li id="m_quick_sidebar_toggle" class="m-nav__item">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-icon m-nav__link-icon-alt"><span class="m-nav__link-icon-wrapper"><i class="flaticon-grid-menu"></i></span></span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </div>

                <!-- END: Topbar -->
            </div>
        </div>
    </div>
</header>