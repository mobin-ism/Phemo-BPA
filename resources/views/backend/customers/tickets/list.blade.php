@php
    if (isset($filtered_tickets))
        $ticket_data = $filtered_tickets;
    else
        $ticket_data = $tickets;
@endphp
<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
                {{__('web.all_tickets')}}
            </h3>
        </div>
    </div>
</div>
<div class="m-portlet__body">

    <!--begin: Datatable -->
    <table class="table table-striped- table-bordered table-hover" id="m_table_1">
        <thead>
        <tr>
            <th>#</th>
            <th>{{__('web.title')}}</th>
            <th>{{__('web.assigned_employee')}}</th>
            <th>{{__('web.status')}}</th>
            <th>{{__('web.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ticket_data as $key => $ticket)
            <?php
                if ($ticket->priority == 'high')
                    $dot = 'danger';
                else if ($ticket->priority == 'medium')
                    $dot = 'warning';
                else 
                    $dot = 'metal';
                
                // get customer name
                $customer_id = $ticket->customer_id;
                $row = \App\Customer::where('id', $customer_id)->first();
                $name = $row->customer_type == 'company' ? $row->company_name : $row->customer_name;
            ?>
            <tr>
                <td>{{$key + 1}}</td>
                <td>
                    <span class="m-badge m-badge--{{$dot}} m-badge--dot"></span> &nbsp; {{$ticket->title}}
                </td>
                <td>
                    @if ($ticket->employee_id != null)
                    {{$ticket->employee->user->name}}
                    @endif
                </td>
                <td>
                    <span class="m-badge m-badge--{{$ticket->resolve_status == 'pending' ? 'warning' : 'success'}} m-badge--wide">
                        {{__('web.'.$ticket->resolve_status)}}
                    </span>
                </td>
                <td nowrap>
                    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
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
                                                    {{__('web.quick_actions')}}
                                                </span>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link"
                                                    onclick="presentModal('{{route('customer.show_ticket', $ticket->id)}}', '{{__('web.ticket_details')}}')">
                                                    <i class="m-nav__link-icon flaticon-info"></i>
                                                    <span class="m-nav__link-text">
                                                            {{__('web.details')}}
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    var DatatablesBasicBasic = {
        init: function() {
            $("#m_table_1").DataTable({
                responsive: !0,
                order: [
                    [0, "asc"]
                ]
            });
        }
    };
    $(document).ready(function() {
        DatatablesBasicBasic.init()
    });
</script>