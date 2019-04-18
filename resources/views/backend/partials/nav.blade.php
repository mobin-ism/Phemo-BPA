{{-- <!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">Victoria Baker</span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-pin text-size-small"></i> &nbsp;Santa Ana, CA
                        </div>
                    </div>

                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li>
                                <a href="#"><i class="icon-cog3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li><a href="index.html"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                    <li class="{{ areActiveRoutes(['customers.index', 'customers.create', 'customers.edit', 'customers.company_list', 'customers.individual_list']) }}"><a href="{{ route('customers.index') }}"><i class="icon-reading"></i> <span>{{ __('web.customers') }}</span></a></li>
                    <li class="{{ areActiveRoutes(['vendors.index', 'vendors.create', 'vendors.edit', 'vendors.list']) }}"><a href="{{ route('vendors.index') }}"><i class="icon-reading"></i> <span>{{ __('web.vendors') }}</span></a></li>
                    <li class="{{ areActiveRoutes(['products.index', 'products.create', 'products.edit']) }}"><a href="{{ route('products.index') }}"><i class="icon-cart4"></i> <span>{{ __('web.products') }}</span></a></li>
                    <li class="{{ areActiveRoutes(['services.index', 'services.create', 'services.edit']) }}"><a href="{{ route('services.index') }}"><i class="icon-stack-empty"></i> <span>{{ __('web.services') }}</span></a></li>
                    <li class="{{ areActiveRoutes(['quotations.index', 'quotations.create', 'quotations.edit']) }}"><a href="{{ route('quotations.index') }}"><i class="icon-compose"></i> <span>{{ __('web.quotation_rfq') }}</span></a></li>
                   <!-- Appearance -->


                    <!-- Layout -->


                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar --> --}}

<nav class="navbar visible-xs">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span> 
        </button>
        <a class="navbar-brand" href="#">PHEMO</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="{{ areActiveRoutes(['home']) }}">
              <a href="{{ route('home') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_1.png')}}" alt="dashboard">
                      Dashboard
                  </span>
              </a>
          </li>

          @if(Auth::user()->role == "admin")

          <li class="{{ areActiveRoutes(['vendors.index', 'vendors.create', 'vendors.edit', 'vendors.list']) }}">
              <a href="{{ route('vendors.index') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_2.png')}}" alt="vendors">
                      {{ __('web.vendors') }}
                  </span>
              </a>
          </li>

          <li class="{{ areActiveRoutes(['customers.index', 'customers.create', 'customers.edit', 'customers.list']) }}">
              <a href="{{ route('customers.index') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_2.png')}}" alt="vendors">
                      Customers
                  </span>
              </a>
          </li>
          <li class="{{ areActiveRoutes(['products.index', 'products.create', 'products.edit', 'products.list']) }}">
              <a href="{{ route('products.index') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_3.png')}}" alt="products">
                      Products
                  </span>
              </a>
          </li>
          <li class="{{ areActiveRoutes(['services.index', 'services.create', 'services.edit', 'services.list']) }}">
              <a href="{{ route('services.index') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_4.png')}}" alt="services">
                      Services
                  </span>
              </a>
          </li>
          <li class="{{ areActiveRoutes(['quotations.index', 'quotations.create', 'quotations.edit']) }}">
              <a href="{{ route('quotations.index') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_5.png')}}" alt="page_layouts">
                      {{ __('web.quotation_rfq') }}
                  </span>
                  
              </a>
          </li>
          <li class="{{ areActiveRoutes(['invoices.index', 'invoices.create', 'invoices.edit']) }}">
              <a href="{{ route('invoices.index') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_6.png')}}" alt="layouts">
                      {{ __('web.invoice') }}
                  </span>
                  
              </a>
          </li>
          <li class="{{ areActiveRoutes(['purchase_orders.index', 'purchase_orders.create', 'purchase_orders.edit']) }}">
              <a href="{{ route('purchase_orders.index') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_8.png')}}" alt="color_system">
                      Purchase Order
                  </span>
              </a>
          </li>
          <li class="{{ areActiveRoutes(['tickets.index', 'tickets.create', 'tickets.edit']) }}">
              <a href="{{ route('tickets.index') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_8.png')}}" alt="starter_kit">
                      Tickets
                  </span>
                  
              </a>
          </li>
          <li class="{{ areActiveRoutes(['documents.index', 'documents.create', 'documents.edit']) }}">
              <a href="{{ route('documents.index') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_8.png')}}" alt="changelog">
                      Documents
                  </span>
              </a>
          </li>
          <li class="{{ areActiveRoutes(['bills.index', 'bills.create', 'bills.edit']) }}">
              <a href="{{ route('bills.index') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_10.png')}}" alt="rtl_Version">
                      Bills & Expenses 
                  </span>
              </a>
          </li>
          <li class="{{ areActiveRoutes(['petty_cashes.index', 'petty_cashes.create', 'petty_cashes.edit']) }}">
              <a href="{{ route('petty_cashes.index') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_10.png')}}" alt="rtl_Version">
                      Petty Cash 
                  </span>
              </a>
          </li>
          <li class="{{ areActiveRoutes(['employees.index', 'employees.create', 'employees.edit']) }}">
              <a href="{{ route('employees.index') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_10.png')}}" alt="rtl_Version">
                      Employee 
                  </span>
              </a>
          </li>
          <li class="{{ areActiveRoutes(['employees.payment_slip']) }}">
              <a href="{{ route('employees.payment_slip') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_10.png')}}" alt="rtl_Version">
                      Payslip
                  </span>
              </a>
          </li>
          <li class="{{ areActiveRoutes(['leaves.index', 'leaves.create', 'leaves.edit']) }}">
              <a href="{{ route('leaves.index') }}">
                  <span>
                      <img src="{{asset('backend/assets/images/icon_10.png')}}" alt="rtl_Version">
                      Leave Management 
                  </span>
              </a>
          </li>

          @elseif(Auth::user()->role == "employee")

          @php

          $permissions = json_decode(Auth::user()->userPermission->permissions);

          @endphp

          @if(in_array(1, $permissions))
              <li class="{{ areActiveRoutes(['vendors.index', 'vendors.create', 'vendors.edit', 'vendors.list']) }}">
                  <a href="{{ route('vendors.index') }}">
                      <span>
                          <img src="{{asset('backend/assets/images/icon_2.png')}}" alt="vendors">
                          {{ __('web.vendors') }}
                      </span>
                  </a>
              </li>
          @endif

          @if(in_array(2, $permissions))
              <li class="{{ areActiveRoutes(['customers.index', 'customers.create', 'customers.edit', 'customers.list']) }}">
                  <a href="{{ route('customers.index') }}">
                      <span>
                          <img src="{{asset('backend/assets/images/icon_2.png')}}" alt="vendors">
                          Customers
                      </span>
                  </a>
              </li>
          @endif

          @if(in_array(3, $permissions))
              <li class="{{ areActiveRoutes(['products.index', 'products.create', 'products.edit', 'products.list']) }}">
                  <a href="{{ route('products.index') }}">
                      <span>
                          <img src="{{asset('backend/assets/images/icon_3.png')}}" alt="products">
                          Products
                      </span>
                  </a>
              </li>
          @endif

          @if(in_array(4, $permissions))
              <li class="{{ areActiveRoutes(['services.index', 'services.create', 'services.edit', 'services.list']) }}">
                  <a href="{{ route('services.index') }}">
                      <span>
                          <img src="{{asset('backend/assets/images/icon_4.png')}}" alt="services">
                          Services
                      </span>
                  </a>
              </li>
          @endif

          @if(in_array(5, $permissions))
              <li class="{{ areActiveRoutes(['quotations.index', 'quotations.create', 'quotations.edit']) }}">
                  <a href="{{ route('quotations.index') }}">
                      <span>
                          <img src="{{asset('backend/assets/images/icon_5.png')}}" alt="page_layouts">
                          {{ __('web.quotation_rfq') }}
                      </span>
                      
                  </a>
              </li>
          @endif

          @if(in_array(6, $permissions))
              <li class="{{ areActiveRoutes(['invoices.index', 'invoices.create', 'invoices.edit']) }}">
                  <a href="{{ route('invoices.index') }}">
                      <span>
                          <img src="{{asset('backend/assets/images/icon_6.png')}}" alt="layouts">
                          {{ __('web.invoice') }}
                      </span>
                      
                  </a>
              </li>
          @endif

          @if(in_array(7, $permissions))
              <li class="{{ areActiveRoutes(['purchase_orders.index', 'purchase_orders.create', 'purchase_orders.edit']) }}">
                  <a href="{{ route('purchase_orders.index') }}">
                      <span>
                          <img src="{{asset('backend/assets/images/icon_8.png')}}" alt="color_system">
                          Purchase Order
                      </span>
                  </a>
              </li>
          @endif

          @if(in_array(8, $permissions))
              <li class="{{ areActiveRoutes(['tickets.index', 'tickets.create', 'tickets.edit']) }}">
                  <a href="{{ route('tickets.index') }}">
                      <span>
                          <img src="{{asset('backend/assets/images/icon_8.png')}}" alt="starter_kit">
                          Tickets
                      </span>
                      
                  </a>
              </li>
          @endif

          @if(in_array(9, $permissions))
              <li class="{{ areActiveRoutes(['documents.index', 'documents.create', 'documents.edit']) }}">
                  <a href="{{ route('documents.index') }}">
                      <span>
                          <img src="{{asset('backend/assets/images/icon_8.png')}}" alt="changelog">
                          Documents
                      </span>
                  </a>
              </li>
          @endif

          @if(in_array(10, $permissions))
              <li class="{{ areActiveRoutes(['bills.index', 'bills.create', 'bills.edit']) }}">
                  <a href="{{ route('bills.index') }}">
                      <span>
                          <img src="{{asset('backend/assets/images/icon_10.png')}}" alt="rtl_Version">
                          Bills & Expenses 
                      </span>
                  </a>
              </li>
          @endif

          @if(in_array(11, $permissions))
              <li class="{{ areActiveRoutes(['petty_cashes.index', 'petty_cashes.create', 'petty_cashes.edit']) }}">
                  <a href="{{ route('petty_cashes.index') }}">
                      <span>
                          <img src="{{asset('backend/assets/images/icon_10.png')}}" alt="rtl_Version">
                          Petty Cash 
                      </span>
                  </a>
              </li>
          @endif

          @if(in_array(12, $permissions))
              <li class="{{ areActiveRoutes(['employees.index', 'employees.create', 'employees.edit']) }}">
                  <a href="{{ route('employees.index') }}">
                      <span>
                          <img src="{{asset('backend/assets/images/icon_10.png')}}" alt="rtl_Version">
                          Employee 
                      </span>
                  </a>
              </li>
          @endif

          @if(in_array(13, $permissions))
              <li class="{{ areActiveRoutes(['leaves.index', 'leaves.create', 'leaves.edit']) }}">
                  <a href="{{ route('leaves.index') }}">
                      <span>
                          <img src="{{asset('backend/assets/images/icon_10.png')}}" alt="rtl_Version">
                          Leave Management 
                      </span>
                  </a>
              </li>
          @endif

          @endif
        </ul>
      </div>
    </div>
  </nav>