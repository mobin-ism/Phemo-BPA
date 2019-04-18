<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Route::post('/account/register', 'AccountController@register')->name('accounts.register');

Route::resource('services','ServiceController');
Route::post('services/dynamic_add', 'ServiceController@dynamic_add')->name('services.dynamic_add');
Route::get('services/delete/{id}', 'ServiceController@delete')->name('services.delete');
Route::get('services/export/pdf', 'ServiceController@pdf')->name('services.pdf');
Route::get('services/export/excel', 'ServiceController@excel')->name('services.excel');

Route::resource('products','ProductController');
Route::post('products/dynamic_add', 'ProductController@dynamic_add')->name('products.dynamic_add');
Route::get('products/delete/{id}', 'ProductController@delete')->name('products.delete');
Route::get('products/export/pdf', 'ProductController@pdf')->name('products.pdf');
Route::get('products/export/excel', 'ProductController@excel')->name('products.excel');
Route::get('products/import/excel', 'ProductController@import_excel')->name('products.import_excel');
Route::get('products/download/sample_excel', 'ProductController@download_sample_excel')->name('products.download_sample_excel');
Route::post('products/bulk/import', 'ProductController@import')->name('products.import');

Route::resource('damaged_products','DamagedProductController');
Route::get('damaged_products/delete/{id}', 'DamagedProductController@delete')->name('damaged_products.delete');
Route::post('damaged_products/filter', 'DamagedProductController@filter')->name('damaged_products.filter');

Route::resource('vendors','VendorController');
Route::post('vendors/status/change', 'VendorController@change_status')->name('vendors.change_status');

Route::resource('customers','CustomerController');
Route::get('customers/list/company', 'CustomerController@company_list')->name('customers.company_list');
Route::get('customers/list/individual', 'CustomerController@individual_list')->name('customers.individual_list');
Route::get('customers/delete/{id}', 'CustomerController@delete')->name('customers.delete');
Route::post('customers/info', 'CustomerController@getCustomerInfo')->name('customers.info');
Route::post('customers/quotes/filter', 'CustomerController@filter_quotes')->name('customers.filter_quotes');
Route::get('customers/import/excel/{type}', 'CustomerController@import_excel')->name('customers.import_excel');
Route::get('customers/download/sample_excel/{type}', 'CustomerController@download_sample_excel')->name('customers.download_sample_excel');
Route::post('customers/bulk/import', 'CustomerController@import')->name('customers.import');
Route::get('customers/photo/{id}', 'CustomerController@photo')->name('customers.photo');
Route::post('customers/photo/upload', 'CustomerController@upload_photo')->name('customers.upload_photo');
Route::post('customers/invoices/filter', 'CustomerController@filter_invoices')->name('customers.filter_invoices');
Route::post('customers/status/change', 'CustomerController@change_status')->name('customers.change_status');
Route::post('customers/statement/generate', 'CustomerController@generate_statement')->name('customers.generate_statement');
Route::get('customers/statements/list', 'CustomerController@statements')->name('customers.statements');
Route::get('customers/statements/view/{id}', 'CustomerController@statement_view')->name('customers.statement_view');
Route::post('customers/dynamic_add', 'CustomerController@dynamic_add')->name('customers.dynamic_add');

Route::resource('quotes', 'QuoteController');
Route::post('quotes/item_info', 'QuoteController@get_item_info')->name('quotes.item_info');
Route::post('quotes/items/blank', 'QuoteController@get_blank_entry')->name('quotes.item_blank');
Route::post('quotes/filter', 'QuoteController@filter')->name('quotes.filter');
Route::get('quotes/make/invoice/{id}', 'QuoteController@make_invoice')->name('quotes.make_invoice');
Route::post('quotes/save/invoice', 'QuoteController@save_invoice')->name('quotes.save_invoice');
Route::get('quotes/delete/{id}', 'QuoteController@delete')->name('quotes.delete');
Route::get('quotes/download/{id}', 'QuoteController@download')->name('quotes.download');


Route::resource('invoices','InvoiceController');
Route::get('invoice/delete/{id}', 'InvoiceController@delete')->name('invoices.delete');
Route::get('invoice/download/{id}', 'InvoiceController@download')->name('invoices.download');
Route::get('invoice/preview/{id}', 'InvoiceController@preview')->name('invoices.preview');
Route::post('invoice/item_info', 'InvoiceController@get_item_info')->name('invoices.item_info');
Route::post('invoice/items/blank', 'InvoiceController@get_blank_entry')->name('invoices.item_blank');
Route::post('invoice/filter', 'InvoiceController@filter')->name('invoices.filter');
Route::get('invoice/payment/{id}', 'InvoiceController@payment')->name('invoices.payment');
Route::post('invoice/payment/record', 'InvoiceController@record_payment')->name('invoices.record_payment');
Route::get('invoice/payment/delete/{id}/{invoice_id}', 'InvoiceController@delete_payment')->name('invoices.delete_payment');
Route::post('invoice/dynamic_add', 'InvoiceController@dynamic_add')->name('invoices.dynamic_add');
Route::get('invoice/payment/receipt/{id}', 'InvoiceController@receipt')->name('invoices.receipt');

Route::resource('purchase_orders','PurchaseOrderController');
Route::get('purchase_order/list', 'PurchaseOrderController@list')->name('purchase_orders.list');
Route::get('purchase_order/delete/{id}', 'PurchaseOrderController@delete')->name('purchase_orders.delete');
Route::get('purchase_order/download/{id}', 'PurchaseOrderController@download')->name('purchase_orders.download');
Route::get('purchase_order/preview/{id}', 'PurchaseOrderController@preview')->name('purchase_orders.preview');

Route::resource('tickets','TicketController');
Route::get('ticket/list', 'TicketController@list')->name('tickets.list');
Route::get('ticket/delete/{id}', 'TicketController@delete')->name('tickets.delete');
Route::post('tickets/filter', 'TicketController@filter')->name('tickets.filter');

Route::get('documents', 'DocumentController@index')->name('documents.index');
Route::get('documents/create/{folder_id}', 'DocumentController@create')->name('documents.create');
Route::post('document/upload', 'DocumentController@store')->name('documents.store');
Route::get('document/download/{id}', 'DocumentController@download')->name('documents.download');
Route::get('document/delete/{id}', 'DocumentController@delete')->name('documents.delete');
Route::get('document/preview/{id}', 'DocumentController@preview')->name('documents.preview');

Route::get('folders/create', 'FolderController@create')->name('folders.create');
Route::post('folders/store', 'FolderController@store')->name('folders.store');
Route::get('folders/show/{id}', 'FolderController@show')->name('folders.show');
Route::get('folder/delete/{id}', 'FolderController@delete')->name('folders.delete');
Route::get('folder/edit/{id}', 'FolderController@edit')->name('folders.edit');
Route::post('folder/update', 'FolderController@update')->name('folders.update');

Route::resource('bills','BillController');
Route::get('bill/payment/{id}', 'BillController@payment')->name('bills.payment');
Route::get('bill/delete/{id}', 'BillController@delete')->name('bills.delete');
Route::post('bill/items/blank', 'BillController@get_blank_entry')->name('bills.item_blank');
Route::post('bill/items', 'BillController@get_items')->name('bills.items');
Route::post('bill/item_info', 'BillController@get_item_info')->name('bills.item_info');
Route::post('bill/record', 'BillController@record_payment')->name('bills.record_payment');
Route::post('bill/dynamic_add', 'BillController@dynamic_add')->name('bills.dynamic_add');
Route::get('bill/payment/delete/{id}/{bill_id}', 'BillController@delete_payment')->name('bills.delete_payment');
Route::get('bill/attachment/download/{bill_no}', 'BillController@download_attachment')->name('bills.download');
Route::get('bill/pdf/download/{id}', 'BillController@pdf')->name('bills.pdf');
Route::post('bills/filter', 'BillController@filter')->name('bills.filter');

Route::resource('petty_cashes','PettyCashController');
Route::get('petty_cash/list', 'PettyCashController@list')->name('petty_cashes.list');
Route::get('petty_cash/delete/{id}', 'PettyCashController@delete')->name('petty_cashes.delete');
Route::get('petty_cash/reject/{id}', 'PettyCashController@reject')->name('petty_cashes.reject');
Route::get('petty_cash/approve/{id}', 'PettyCashController@approve')->name('petty_cashes.approve');

Route::resource('leaves','LeaveController');
Route::get('leave/list', 'LeaveController@list')->name('leaves.list');
Route::get('leave/delete/{id}', 'LeaveController@delete')->name('leaves.delete');
Route::get('leave/reject/{id}', 'LeaveController@reject')->name('leaves.reject');
Route::get('leave/approve/{id}', 'LeaveController@approve')->name('leaves.approve');
Route::post('leave/dynamic_add', 'LeaveController@dynamic_add')->name('leaves.dynamic_add');
Route::post('leaves/filter', 'LeaveController@filter')->name('leaves.filter');
Route::get('leaves/attachment/download/{id}', 'LeaveController@download')->name('leaves.download');

Route::resource('configs','ConfigController');
Route::post('config/system_preference', 'ConfigController@system_preferences')->name('configs.system_preferences');
Route::get('config/notifications', 'ConfigController@notifications')->name('configs.notifications');
Route::post('config/update_notifications', 'ConfigController@update_notifications')->name('configs.update_notifications');
Route::get('config/user/permission', 'UserPermissionController@index')->name('configs.permissions');
Route::post('config/user/permission/list', 'UserPermissionController@permission_list')->name('configs.permission_list');
Route::post('config/user/permission/save', 'UserPermissionController@save')->name('configs.save_permission');
Route::get('config/email/templates', 'ConfigController@email_templates')->name('configs.email_templates');
Route::post('config/colors/bill', 'ConfigController@bill_color')->name('configs.bill_color');
Route::post('config/colors/quote', 'ConfigController@quote_color')->name('configs.quote_color');
Route::post('config/colors/invoice', 'ConfigController@invoice_color')->name('configs.invoice_color');
Route::post('config/colors/payslip', 'ConfigController@payslip_color')->name('configs.payslip_color');

// Route::post('config/user_permissions/permissions', 'UserPermissionController@getUserPermissions')->name('user_permissions.permissions');
// Route::post('config/user_permissions/permissions/store', 'UserPermissionController@storeUserPermissions')->name('user_permissions.permissions.store');


Route::resource('taxes','TaxController');
Route::get('tax/delete/{id}', 'TaxController@delete')->name('taxes.delete');

Route::resource('additional_costs','AdditionalCostController');
Route::get('additional_cost/delete/{id}', 'AdditionalCostController@delete')->name('additional_costs.delete');

Route::resource('departments','DepartmentController');
Route::get('department/delete/{id}', 'DepartmentController@delete')->name('departments.delete');

Route::resource('customer_categories','CustomerCategoryController');
Route::get('customer_category/delete/{id}', 'CustomerCategoryController@delete')->name('customer_categories.delete');

Route::resource('expenses','ExpenseController');
Route::post('expenses/dynamic_add', 'ExpenseController@dynamic_add')->name('expenses.dynamic_add');
Route::get('expenses/delete/{id}', 'ExpenseController@delete')->name('expenses.delete');
Route::post('expenses/filter', 'ExpenseController@filter')->name('expenses.filter');
Route::get('expenses/attachment/download/{id}', 'ExpenseController@download')->name('expenses.download');

Route::resource('expense_types','ExpenseTypeController');
Route::get('expense_type/delete/{id}', 'ExpenseTypeController@delete')->name('expense_types.delete');

Route::resource('job_types','JobTypeController');
Route::get('job_type/delete/{id}', 'JobTypeController@delete')->name('job_types.delete');

Route::resource('leave_types','LeaveTypeController');
Route::get('leave_type/delete/{id}', 'LeaveTypeController@delete')->name('leave_types.delete');

Route::resource('job_statuses','JobStatusController');
Route::get('job_status/delete/{id}', 'JobStatusController@delete')->name('job_statuses.delete');

Route::resource('pay_statuses','PayStatusController');
Route::get('pay_status/delete/{id}', 'PayStatusController@delete')->name('pay_statuses.delete');

Route::resource('training_types','TrainingTypeController');
Route::get('training_type/delete/{id}', 'TrainingTypeController@delete')->name('training_types.delete');

Route::resource('salary_heads','SalaryHeadController');
Route::get('salary_head/delete/{id}', 'SalaryHeadController@delete')->name('salary_heads.delete');

Route::resource('payrolls','PayrollController');
Route::post('payrolls/filter', 'PayrollController@filter')->name('payrolls.filter');
Route::post('payrolls/filter/employees', 'PayrollController@filter_employee')->name('payrolls.filter_employee');
Route::post('payrolls/heads', 'PayrollController@get_salary_heads')->name('payrolls.heads');
Route::get('payrolls/delete/{id}', 'PayrollController@delete')->name('payrolls.delete');

Route::get('quotation/email/{id}', 'EmailController@sendQuotationEmail')->name('emails.quotation');
Route::get('invoice/email/{id}', 'EmailController@sendInvoiceEmail')->name('emails.invoice');
Route::get('po/email/{id}', 'EmailController@sendPoEmail')->name('emails.po');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');


Route::get('profile/change/password', 'ProfileController@change_password')->name('profiles.change_password');
Route::post('profile/update/password', 'ProfileController@update_password')->name('profiles.update_password');

Route::resource('credit_notes', 'CreditNoteController');

Route::get('customers/statement/notify/{id}', 'CustomerController@email_statement')->name('customers.email_statement');
Route::get('customers/invoice/notify/{id}', 'InvoiceController@send_email_to_customer')->name('customers.email_invoice');
Route::get('customers/quote/notify/{quote_id}', 'QuoteController@send_email_to_customer')->name('customers.email_quote');

// customer portal routes
Route::get('customer/quotes', 'Customer\CustomerPortalQuoteController@quotes')->name('customer.quotes');
Route::post('customer/quotes/filter', 'Customer\CustomerPortalQuoteController@filter')->name('customer.filter_quote');
Route::get('customer/quote/show/{id}', 'Customer\CustomerPortalQuoteController@show')->name('customer.show_quote');
Route::get('customer/quote/edit/{id}', 'Customer\CustomerPortalQuoteController@edit')->name('customer.edit_quote');
Route::post('customer/quote/update/{id}', 'Customer\CustomerPortalQuoteController@update')->name('customer.update_quote');
Route::get('customer/quote/approve/{id}', 'Customer\CustomerPortalQuoteController@approve')->name('customer.approve_quote');
Route::get('customer/quote/reject/{id}', 'Customer\CustomerPortalQuoteController@reject')->name('customer.reject_quote');
Route::get('customer/quote/download/{id}', 'Customer\CustomerPortalQuoteController@download')->name('customer.download_quote');

Route::get('customer/invoices', 'Customer\CustomerPortalInvoiceController@invoices')->name('customer.invoices');
Route::post('customer/invoices/filter', 'Customer\CustomerPortalInvoiceController@filter')->name('customer.filter_invoice');
Route::get('customer/invoice/show/{id}', 'Customer\CustomerPortalInvoiceController@show')->name('customer.show_invoice');
Route::get('customer/invoice/payment/receipt/{id}', 'Customer\CustomerPortalInvoiceController@receipt')->name('customer.invoice_payment_receipt');
Route::get('customer/invoice/download/{id}', 'Customer\CustomerPortalInvoiceController@download')->name('customer.download_invoice');

Route::get('customer/tickets', 'Customer\CustomerPortalTicketController@tickets')->name('customer.tickets');
Route::post('customer/tickets/filter', 'Customer\CustomerPortalTicketController@filter')->name('customer.filter_ticket');
Route::get('customer/ticket/create', 'Customer\CustomerPortalTicketController@create')->name('customer.create_ticket');
Route::post('customer/ticket/store', 'Customer\CustomerPortalTicketController@store')->name('customer.store_ticket');
Route::get('customer/ticket/show/{id}', 'Customer\CustomerPortalTicketController@show')->name('customer.show_ticket');

Route::get('customer/statements', 'Customer\CustomerPortalStatementController@statements')->name('customer.statements');
Route::get('customer/statement/show/{id}', 'Customer\CustomerPortalStatementController@show')->name('customer.show_statement');

Route::get('customer/profile', 'Customer\CustomerPortalProfileController@profile')->name('customer.profile');
Route::post('customer/profile/update', 'Customer\CustomerPortalProfileController@update')->name('customer.update_profile');
Route::get('customer/photo/edit', 'Customer\CustomerPortalProfileController@photo')->name('customer.edit_photo');
Route::post('customer/photo/update', 'Customer\CustomerPortalProfileController@update_photo')->name('customer.update_photo');

// vendor portal routes
Route::get('vendor/bills', 'Vendor\VendorPortalBillController@bills')->name('vendor.bills');
Route::post('vendor/bills/filter', 'Vendor\VendorPortalBillController@filter')->name('vendor.filter_bill');
Route::get('vendor/bill/show/{id}', 'Vendor\VendorPortalBillController@show')->name('vendor.show_bill');
Route::get('vendor/bill/attachment/download/{bill_no}', 'Vendor\VendorPortalBillController@download_attachment')->name('vendor.download_bill_attachment');
Route::get('vendor/profile', 'Vendor\VendorPortalProfileController@profile')->name('vendor.profile');
Route::post('vendor/profile/update', 'Vendor\VendorPortalProfileController@update')->name('vendor.update_profile');
