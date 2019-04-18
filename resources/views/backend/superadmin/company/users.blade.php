
@php
    if (!isset($data)) {
        $user_data = $users;
        $type = 'user';
    } else {
        $user_data = $data;
        $type = $type;
    }
@endphp
<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
                {{__('web.'.$type.'s')}}
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
            @if($type == 'customer')
            <th>{{__('web.customer_type')}}</th>
            <th>{{__('web.company_name')}}</th>
            <th>{{__('web.primary_contact')}}</th>
            @endif
            <th>{{__('web.name')}}</th>
            @if($type == 'vendor')
            <th>{{__('web.contact_person')}}</th>
            @endif
            <th>{{__('web.email')}}</th>
            @if($type == 'user')
            <th>{{__('web.role')}}</th>
            @endif
            <th>{{__('web.created_at')}}</th>
            <th>{{__('web.actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user_data as $key => $user)
            <tr>
                <td>{{$key + 1}}</td>
                @if($type == 'customer')
                <td>{{__('web.'.$user->customer_type)}}</td>
                <td>{{$user->company_name}}</td>
                <td>{{$user->primary_contact}}</td>
                @endif
                <td>
                    @if($type == 'customer') {{$user->customer_name}} @else {{$user->name}} @endif
                </td>
                @if($type == 'vendor')
                <td>{{$user->contact_person}}</td>
                @endif
                <td>
                    @if($type == 'employee') {{$user->user->email}} @elseif($type == 'vendor') {{$user->contact_email}} @else {{$user->email}} @endif
                </td>
                @if($type == 'user')
                <td>{{__('web.'.$user->role)}}</td>
                @endif
                <td>{{$user->created_at}}</td>
                @php
                    if ($type == 'user') $id = $user->id; else $id = $user->user_id;
                @endphp
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
                                                <a href="" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-info"></i>
                                                    <span class="m-nav__link-text">
                                                            {{__('web.details')}}
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link"
                                                    onclick="presentModal('{{route('scompanies.credentials', $id)}}', '{{__('web.change_email_password')}}')">
                                                    <i class="m-nav__link-icon flaticon-edit"></i>
                                                    <span class="m-nav__link-text">
                                                        {{__('web.change_email_password')}}
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link"
                                                    onclick="confirmModal('{{route('scompanies.delete_user', $id)}}')">
                                                    <i class="m-nav__link-icon flaticon-cancel"></i>
                                                    <span class="m-nav__link-text">
                                                            {{__('web.delete')}}
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