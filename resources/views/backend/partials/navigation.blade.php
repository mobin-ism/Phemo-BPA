<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">

    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " data-menu-vertical="true" m-menu-scrollable="1" 
        m-menu-dropdown-timeout="500">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'employee')
            <li class="m-menu__item {{isActiveRoute('home')}}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{route('home')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-dashboard"></i>
                    <span class="m-menu__link-text">{{__('web.dashboard')}}</span>
                </a>
            </li>

            @if(is_permitted('vendor_view'))
                <li class="m-menu__item {{areActiveRoutes(['vendors.index', 'vendors.show'])}}" aria-haspopup="true" m-menu-link-redirect="1">
                    <a href="{{route('vendors.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-user"></i>
                        <span class="m-menu__link-text">{{__('web.vendors')}}</span>
                    </a>
                </li>
            @endif
            
            @if(is_permitted('customer_view'))
            <li class="m-menu__item  m-menu__item--submenu {{open_for_submenu(['customers.company_list', 'customers.individual_list', 'customers.show', 'customers.import_excel'])}}" 
                aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-user-ok"></i>
                    <span class="m-menu__link-text">{{__('web.customers')}}</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link"><span class="m-menu__link-text">{{__('web.customers')}}</span></span>
                        </li>
                        <li class="m-menu__item {{areActiveRoutes(['customers.company_list', 'customers.import_excel'])}}" aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{route('customers.company_list')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('web.company')}}</span>
                            </a>
                        </li>
                        <li class="m-menu__item {{areActiveRoutes(['customers.individual_list', 'customers.import_excel'])}}" aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{route('customers.individual_list')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('web.individual')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif

            @if(is_permitted('product_view') || is_permitted('service_view') || is_permitted('damaged_product_view'))
            <li class="m-menu__item  m-menu__item--submenu {{ open_for_submenu(['products.index', 'services.index', 'damaged_products.index', 'products.import_excel']) }}" 
                aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-apps"></i>
                    <span class="m-menu__link-text">{{__('web.items')}}</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link"><span class="m-menu__link-text">{{__('web.items')}}</span></span>
                        </li>
                        @if(is_permitted('product_view'))
                        <li class="m-menu__item {{areActiveRoutes(['products.index', 'products.import_excel'])}}" aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{ route('products.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-bag"></i>
                                <span class="m-menu__link-text">{{__('web.products')}}</span>
                            </a>
                        </li>
                        @endif
                        @if(is_permitted('service_view'))
                        <li class="m-menu__item {{isActiveRoute('services.index')}}" aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{ route('services.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-lifebuoy"></i>
                                <span class="m-menu__link-text">{{__('web.services')}}</span>
                            </a>
                        </li>
                        @endif
                        @if(is_permitted('damaged_product_view'))
                        <li class="m-menu__item {{isActiveRoute('damaged_products.index')}}" aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{ route('damaged_products.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-close"></i>
                                <span class="m-menu__link-text">{{__('web.damaged_products')}}</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            @if(is_permitted('quote_view'))
            <li class="m-menu__item {{areActiveRoutes(['quotes.index', 'quotes.show', 'quotes.create', 'quotes.edit'])}}" aria-haspopup="true" 
                m-menu-link-redirect="1">
                <a href="{{route('quotes.index')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-interface-10"></i>
                    <span class="m-menu__link-text">{{__('web.quotes')}}</span>
                </a>
            </li>
            @endif

            @if(is_permitted('invoice_view'))
            <li class="m-menu__item {{areActiveRoutes(['invoices.index', 'invoices.show', 'invoices.create', 'invoices.edit'])}}" aria-haspopup="true" 
                m-menu-link-redirect="1">
                <a href="{{route('invoices.index')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list"></i>
                    <span class="m-menu__link-text">{{__('web.invoice')}}</span>
                </a>
            </li>
            @endif

            {{-- @if(is_permitted('cn_view'))
            <li class="m-menu__item {{areActiveRoutes(['credit_notes.index', 'credit_notes.show', 'credit_notes.create', 'credit_notes.edit'])}}" aria-haspopup="true" 
                m-menu-link-redirect="1">
                <a href="{{route('credit_notes.index')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-notes"></i>
                    <span class="m-menu__link-text">{{__('web.credit_notes')}}</span>
                </a>
            </li>
            @endif --}}

            {{-- @if(is_permitted('po_view'))
            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                <a href="inner.html" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-open-box"></i>
                    <span class="m-menu__link-text">{{__('web.purchase_order')}}</span>
                </a>
            </li>
            @endif --}}

            {{-- @if(is_permitted('cn_view'))
            <li class="m-menu__item  m-menu__item--submenu {{ open_for_submenu(['credit_notes.index', 'credit_notes.create']) }}" 
                aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-piggy-bank"></i>
                    <span class="m-menu__link-text">{{__('web.sales')}}</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link"><span class="m-menu__link-text">{{__('web.sales')}}</span></span>
                        </li>
                        {{-- <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-interface-4"></i>
                                <span class="m-menu__link-text">{{__('web.recurring_invoice')}}</span>
                            </a>
                        </li> --}}
                        {{-- @if(is_permitted('cn_view'))
                        <li class="m-menu__item {{ areActiveRoutes(['credit_notes.index', 'credit_notes.create']) }}" aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{route('credit_notes.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-notes"></i>
                                <span class="m-menu__link-text">{{__('web.credit_notes')}}</span>
                            </a>
                        </li>
                        @endif --}}
            
                        {{-- <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-download"></i>
                                <span class="m-menu__link-text">{{__('web.payments_in')}}</span>
                            </a>
                        </li> --}}
                    {{-- </ul>
                </div>
            </li>
            @endif --}}

            @if(is_permitted('bill_view') || is_permitted('expense_view'))
            <li class="m-menu__item  m-menu__item--submenu {{open_for_submenu(['bills.index', 'bills.show', 'bills.create', 'bills.edit', 'expenses.index'])}}" 
                aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-coins"></i>
                    <span class="m-menu__link-text">{{__('web.purchases')}}</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link"><span class="m-menu__link-text">{{__('web.purchase')}}</span></span>
                        </li>
                        @if(is_permitted('bill_view'))
                        <li class="m-menu__item {{areActiveRoutes(['bills.index', 'bills.show', 'bills.create', 'bills.edit'])}}" 
                            aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{route('bills.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-file-1"></i>
                                <span class="m-menu__link-text">{{__('web.bills')}}</span>
                            </a>
                        </li>
                        @endif
                        
                        @if(is_permitted('expense_view'))
                        <li class="m-menu__item {{isActiveRoute('expenses.index')}}" aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{route('expenses.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-mark"></i>
                                <span class="m-menu__link-text">{{__('web.expenses')}}</span>
                            </a>
                        </li>
                        @endif
                        {{-- <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="inner.html" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-upload-1"></i>
                                <span class="m-menu__link-text">{{__('web.payments_out')}}</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            @endif

            @if(is_permitted('employee_view') || is_permitted('leave_view') || is_permitted('payroll_view'))
            <li class="m-menu__item  m-menu__item--submenu {{open_for_submenu(['employees.index', 'employees.show', 'payrolls.index', 'payrolls.create', 'payrolls.edit', 'payrolls.show', 'leaves.index'])}}" 
                aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-network"></i>
                    <span class="m-menu__link-text">{{__('web.hr_and_payroll')}}</span><i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link"><span class="m-menu__link-text">{{__('web.hr_and_payroll')}}</span></span>
                        </li>
                        @if (is_permitted('employee_view'))
                        <li class="m-menu__item {{areActiveRoutes(['employees.index', 'employees.show'])}}" aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{route('employees.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-users"></i>
                                <span class="m-menu__link-text">{{__('web.employees')}}</span>
                            </a>
                        </li>
                        @endif
                        @if (is_permitted('leave_view'))
                        <li class="m-menu__item {{isActiveRoute('leaves.index')}}" aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{route('leaves.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-list-1"></i>
                                <span class="m-menu__link-text">{{__('web.leave_management')}}</span>
                            </a>
                        </li>
                        @endif
                        @if (is_permitted('payroll_view'))
                        <li class="m-menu__item {{areActiveRoutes(['payrolls.index', 'payrolls.create', 'payrolls.edit', 'payrolls.show'])}}" aria-haspopup="true" m-menu-link-redirect="1">
                            <a href="{{route('payrolls.index')}}" class="m-menu__link ">
                                <i class="m-menu__link-icon flaticon-list-2"></i>
                                <span class="m-menu__link-text">{{__('web.payroll')}}</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif
            
            @if(is_permitted('doc_view'))
            <li class="m-menu__item {{areActiveRoutes(['documents.index', 'folders.show'])}}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{route('documents.index')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-file-2"></i>
                    <span class="m-menu__link-text">{{__('web.documents')}}</span>
                </a>
            </li>
            @endif

            @if(is_permitted('ticket_view'))
            <li class="m-menu__item {{isActiveRoute('tickets.index')}}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{route('tickets.index')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-interface-9"></i>
                    <span class="m-menu__link-text">{{__('web.tickets')}}</span>
                </a>
            </li>
            @endif

            {{-- @if(is_permitted('report_view'))
            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                <a href="inner.html" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-diagram"></i>
                    <span class="m-menu__link-text">{{__('web.reports')}}</span>
                </a>
            </li>
            @endif --}}

            <li class="m-menu__item" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="https://ndams.zendesk.com/hc/en-us/requests/new" class="m-menu__link " target="_blank">
                    <i class="m-menu__link-icon flaticon-lifebuoy"></i>
                    <span class="m-menu__link-text">{{__('web.support')}}</span>
                </a>
            </li>
            @endif

            @if (Auth::user()->role == 'customer')
            <li class="m-menu__item {{isActiveRoute('home')}}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{route('home')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-dashboard"></i>
                    <span class="m-menu__link-text">{{__('web.dashboard')}}</span>
                </a>
            </li>
            <li class="m-menu__item {{areActiveRoutes(['customer.quotes', 'customer.show_quote', 'customer.edit_quote'])}}" aria-haspopup="true" 
                m-menu-link-redirect="1">
                <a href="{{route('customer.quotes')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-interface-10"></i>
                    <span class="m-menu__link-text">{{__('web.quotes')}}</span>
                </a>
            </li>
            <li class="m-menu__item {{areActiveRoutes(['customer.invoices', 'customer.show_invoice'])}}" aria-haspopup="true" 
                m-menu-link-redirect="1">
                <a href="{{route('customer.invoices')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list"></i>
                    <span class="m-menu__link-text">{{__('web.invoice')}}</span>
                </a>
            </li>
            <li class="m-menu__item {{isActiveRoute('customer.tickets')}}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{route('customer.tickets')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-interface-9"></i>
                    <span class="m-menu__link-text">{{__('web.tickets')}}</span>
                </a>
            </li>
            <li class="m-menu__item {{isActiveRoute('customer.statements')}}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{route('customer.statements')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-2"></i>
                    <span class="m-menu__link-text">{{__('web.statements')}}</span>
                </a>
            </li>
            <li class="m-menu__item {{isActiveRoute('customer.profile')}}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{route('customer.profile')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-profile-1"></i>
                    <span class="m-menu__link-text">{{__('web.profile')}}</span>
                </a>
            </li>
            @endif
            @if (Auth::user()->role == 'vendor')
            <li class="m-menu__item {{isActiveRoute('home')}}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{route('home')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-dashboard"></i>
                    <span class="m-menu__link-text">{{__('web.dashboard')}}</span>
                </a>
            </li>
            <li class="m-menu__item {{areActiveRoutes(['vendor.bills', 'vendor.show_bill'])}}" 
                aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{route('vendor.bills')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-file-1"></i>
                    <span class="m-menu__link-text">{{__('web.bills')}}</span>
                </a>
            </li>
            <li class="m-menu__item {{isActiveRoute('vendor.profile')}}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{route('vendor.profile')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-profile-1"></i>
                    <span class="m-menu__link-text">{{__('web.profile')}}</span>
                </a>
            </li>
            @endif
            @if (Auth::user()->role == 'superadmin')
            <li class="m-menu__item {{isActiveRoute('home')}}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{route('home')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-dashboard"></i>
                    <span class="m-menu__link-text">{{__('web.dashboard')}}</span>
                </a>
            </li>
            <li class="m-menu__item {{areActiveRoutes(['scompanies.index', 'scompanies.show'])}}" aria-haspopup="true" m-menu-link-redirect="1">
                <a href="{{route('scompanies.index')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-like"></i>
                    <span class="m-menu__link-text">{{__('web.companies')}}</span>
                </a>
            </li>
            @endif
        </ul>
    </div>

    <!-- END: Aside Menu -->
</div>

<!-- END: Left Aside -->