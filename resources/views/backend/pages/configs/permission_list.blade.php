<div class="col">
    <form action="{{route('configs.save_permission')}}" method="post">
    <div class="table-responsive">
            @csrf
            <input type="hidden" name="user_id" value="{{$user_id}}">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{__('web.modules')}}</th>
                        <th>{{__('web.view')}}</th>
                        <th>{{__('web.create')}}</th>
                        <th>{{__('web.edit')}}</th>
                        <th>{{__('web.delete')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>{{__('web.vendors')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="vendor_view" name="permissions[]"
                                        @if(is_permitted('vendor_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="vendor_create" name="permissions[]"
                                    @if(is_permitted('vendor_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="vendor_edit" name="permissions[]"
                                    @if(is_permitted('vendor_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="vendor_delete" name="permissions[]"
                                    @if(is_permitted('vendor_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{__('web.customers')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="customer_view" name="permissions[]"
                                    @if(is_permitted('customer_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="customer_create" name="permissions[]"
                                    @if(is_permitted('customer_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="customer_edit" name="permissions[]"
                                    @if(is_permitted('customer_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="customer_delete" name="permissions[]"
                                    @if(is_permitted('customer_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{__('web.products')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="product_view" name="permissions[]"
                                    @if(is_permitted('product_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="product_create" name="permissions[]"
                                    @if(is_permitted('product_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="product_edit" name="permissions[]"
                                    @if(is_permitted('product_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="product_delete" name="permissions[]"
                                    @if(is_permitted('product_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{__('web.services')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="service_view" name="permissions[]"
                                    @if(is_permitted('service_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="service_create" name="permissions[]"
                                    @if(is_permitted('service_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="service_edit" name="permissions[]"
                                    @if(is_permitted('service_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="service_delete" name="permissions[]"
                                    @if(is_permitted('service_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{__('web.damaged_products')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="damaged_product_view" name="permissions[]"
                                    @if(is_permitted('damaged_product_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="damaged_product_create" name="permissions[]"
                                    @if(is_permitted('damaged_product_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="damaged_product_edit" name="permissions[]"
                                    @if(is_permitted('damaged_product_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="damaged_product_delete" name="permissions[]"
                                    @if(is_permitted('damaged_product_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{__('web.quotations')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="quote_view" name="permissions[]"
                                    @if(is_permitted('quote_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="quote_create" name="permissions[]"
                                    @if(is_permitted('quote_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="quote_edit" name="permissions[]"
                                    @if(is_permitted('quote_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="quote_delete" name="permissions[]"
                                    @if(is_permitted('quote_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{__('web.invoices')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="invoice_view" name="permissions[]"
                                    @if(is_permitted('invoice_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="invoice_create" name="permissions[]"
                                    @if(is_permitted('invoice_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="invoice_edit" name="permissions[]"
                                    @if(is_permitted('invoice_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="invoice_delete" name="permissions[]"
                                    @if(is_permitted('invoice_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td><b>{{__('web.purchase_orders')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="po_view" name="permissions[]"
                                    @if(is_permitted('po_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="po_create" name="permissions[]"
                                    @if(is_permitted('po_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="po_edit" name="permissions[]"
                                    @if(is_permitted('po_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="po_delete" name="permissions[]"
                                    @if(is_permitted('po_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr> --}}
                    {{-- <tr>
                        <td><b>{{__('web.credit_notes')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="cn_view" name="permissions[]"
                                    @if(is_permitted('cn_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="cn_create" name="permissions[]"
                                    @if(is_permitted('cn_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="cn_edit" name="permissions[]"
                                    @if(is_permitted('cn_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="cn_delete" name="permissions[]"
                                    @if(is_permitted('cn_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr> --}}
                    <tr>
                        <td><b>{{__('web.bills')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="bill_view" name="permissions[]"
                                    @if(is_permitted('bill_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="bill_create" name="permissions[]"
                                    @if(is_permitted('bill_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="bill_edit" name="permissions[]"
                                    @if(is_permitted('bill_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="bill_delete" name="permissions[]"
                                    @if(is_permitted('bill_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{__('web.expenses')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="expense_view" name="permissions[]"
                                    @if(is_permitted('expense_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="expense_create" name="permissions[]"
                                    @if(is_permitted('expense_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="expense_edit" name="permissions[]"
                                    @if(is_permitted('expense_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="expense_delete" name="permissions[]"
                                    @if(is_permitted('expense_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{__('web.employees')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="employee_view" name="permissions[]"
                                    @if(is_permitted('employee_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="employee_create" name="permissions[]"
                                    @if(is_permitted('employee_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="employee_edit" name="permissions[]"
                                    @if(is_permitted('employee_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="employee_delete" name="permissions[]"
                                    @if(is_permitted('employee_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{__('web.leave_management')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="leave_view" name="permissions[]"
                                    @if(is_permitted('leave_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="leave_create" name="permissions[]"
                                    @if(is_permitted('leave_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="leave_edit" name="permissions[]"
                                    @if(is_permitted('leave_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="leave_delete" name="permissions[]"
                                    @if(is_permitted('leave_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{__('web.payrolls')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="payroll_view" name="permissions[]"
                                    @if(is_permitted('payroll_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="payroll_create" name="permissions[]"
                                    @if(is_permitted('payroll_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="payroll_edit" name="permissions[]"
                                    @if(is_permitted('payroll_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="payroll_delete" name="permissions[]"
                                    @if(is_permitted('payroll_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{__('web.documents')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="doc_view" name="permissions[]"
                                    @if(is_permitted('doc_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="doc_create" name="permissions[]"
                                    @if(is_permitted('doc_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="doc_edit" name="permissions[]"
                                    @if(is_permitted('doc_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="doc_delete" name="permissions[]"
                                    @if(is_permitted('doc_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><b>{{__('web.tickets')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="ticket_view" name="permissions[]"
                                    @if(is_permitted('ticket_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="ticket_create" name="permissions[]"
                                    @if(is_permitted('ticket_create', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="ticket_edit" name="permissions[]"
                                    @if(is_permitted('ticket_edit', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="ticket_delete" name="permissions[]"
                                    @if(is_permitted('ticket_delete', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td><b>{{__('web.reports')}}</b></td>
                        <td>
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" value="report_view" name="permissions[]"
                                    @if(is_permitted('report_view', $user_id)) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
            <span>
                <i class="la la-save"></i>
                <span>{{__('web.save')}}</span>
            </span>
        </button>
    </form>
</div>