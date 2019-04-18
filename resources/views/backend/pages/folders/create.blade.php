@if (is_permitted('doc_create'))
<form method="post" id="modal-form" action="{{ route('folders.store') }}">
    @csrf
    {{ Form::hidden('account_id',  Auth::user()->account_id) }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="name-group">
                <label for="name">
                    * {{__('web.name')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="name" name="name">
            </div>
            <div class="form-group m-form__group">
                <span class="m-type m--bg-brand label-color" id="brand"></span>
                <span class="m-type m--bg-metal label-color" id="metal"></span>
                <span class="m-type m--bg-primary label-color" id="primary"></span>
                <span class="m-type m--bg-success label-color" id="success"></span>
                <span class="m-type m--bg-info label-color" id="info"></span>
                <span class="m-type m--bg-warning label-color" id="warning"></span>
                <span class="m-type m--bg-danger label-color" id="danger"></span>
                <input type="hidden" name="color" id="color" value="">
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('.label-color').on('click', function(e) {
            var id = this.id;
            console.log(id);
            $('#color').val(id);
            var colors = document.querySelectorAll('.label-color');
            colors.forEach(function() {
                var element = $('.label-color');
                element.removeClass('opaque');
            });
            $('#' + id).addClass('opaque');
        });
    });
</script>
@endif