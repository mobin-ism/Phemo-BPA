<div class="m-portlet">                           
    <div class="m-portlet__body">
        <!--begin::Section-->
        <div class="m-section m-section--last">
            <div class="m-section__content">
                <!--begin::Preview-->
                <div class="m-demo">
                    <div class="m-demo__preview" style="border: none;">
                        <div class="m-list-search">
                            <div class="m-list-search__results">
                                <span class="m-list-search__result-category m-list-search__result-category--first">
                                    {{ __('web.preferences') }}
                                </span>
                                <a href="{{route('configs.index')}}" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-cogwheel"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('configs.index')}}">
                                            {{__('web.system_preferences')}}
                                    </span>
                                </a>
                                {{-- <a href="#" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-email"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('configs.email_templates')}}">
                                            {{__('web.email_templates')}}
                                    </span>
                                </a> --}}
                                {{-- <a href="#" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-list-1"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text">
                                            {{__('web.invoice_templates')}}
                                    </span>
                                </a> --}}
                                <a href="{{route('configs.permissions')}}" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-user-settings"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('configs.permissions')}}">
                                            {{__('web.user_permissions')}}
                                    </span>
                                </a>
                                <a href="{{route('configs.notifications')}}" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-alert"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('configs.notifications')}}">
                                            {{__('web.reminders')}}
                                    </span>
                                </a>
                                <span class="m-list-search__result-category">
                                    {{ __('web.configurations') }}
                                </span>
                                <a href="{{route('departments.index')}}" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-network"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('departments.index')}}">
                                            {{__('web.departments')}}
                                    </span>
                                </a>
                                <a href="{{route('customer_categories.index')}}" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-layers"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('customer_categories.index')}}">
                                            {{__('web.customer_categories')}}
                                    </span>
                                </a>
                                <a href="{{route('taxes.index')}}" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-interface-9"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('taxes.index')}}">
                                            {{__('web.tax')}}
                                    </span>
                                </a>
                                <a href="{{route('leave_types.index')}}" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-app"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('leave_types.index')}}">
                                            {{__('web.leave_types')}}
                                    </span>
                                </a>
                                <a href="{{route('expense_types.index')}}" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-coins"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('expense_types.index')}}">
                                            {{__('web.expense_types')}}
                                    </span>
                                </a>
                                <a href="{{route('job_types.index')}}" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-more-v2"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('job_types.index')}}">
                                            {{__('web.job_types')}}
                                    </span>
                                </a>
                                <a href="{{route('job_statuses.index')}}" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-open-box"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('job_statuses.index')}}">
                                            {{__('web.job_status')}}
                                    </span>
                                </a>
                                <a href="{{route('training_types.index')}}" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-analytics"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('training_types.index')}}">
                                            {{__('web.training_types')}}
                                    </span>
                                </a>
                                <a href="{{route('pay_statuses.index')}}" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-piggy-bank"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('pay_statuses.index')}}">
                                            {{__('web.pay_frequency')}}
                                    </span>
                                </a>
                                <a href="{{route('salary_heads.index')}}" class="m-list-search__result-item">
                                    <span class="m-list-search__result-item-icon">
                                        <i class="flaticon-interface-11"></i>
                                    </span>
                                    <span class="m-list-search__result-item-text {{isConfigActive('salary_heads.index')}}">
                                            {{__('web.benefits_and_deductions')}}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Section-->
    </div>
</div>