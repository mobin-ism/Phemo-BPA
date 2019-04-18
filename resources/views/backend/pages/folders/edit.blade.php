@if (is_permitted('doc_edit'))
<form method="post" id="modal-form" action="{{ route('folders.update') }}">
    @csrf
    {{ Form::hidden('id', $folder->id) }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="name-group">
                <label for="name">
                    * {{__('web.name')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="name" name="name"
                    value="{{$folder->name}}">
            </div>
            <div class="form-group m-form__group">
                <span class="m-type m--bg-brand label-color <?php if ($folder->color == 'brand') echo 'opaque'; ?>" id="brand"></span>
                <span class="m-type m--bg-metal label-color <?php if ($folder->color == 'metal') echo 'opaque'; ?>" id="metal"></span>
                <span class="m-type m--bg-primary label-color <?php if ($folder->color == 'primary') echo 'opaque'; ?>" id="primary"></span>
                <span class="m-type m--bg-success label-color <?php if ($folder->color == 'success') echo 'opaque'; ?>" id="success"></span>
                <span class="m-type m--bg-info label-color <?php if ($folder->color == 'info') echo 'opaque'; ?>" id="info"></span>
                <span class="m-type m--bg-warning label-color <?php if ($folder->color == 'warning') echo 'opaque'; ?>" id="warning"></span>
                <span class="m-type m--bg-danger label-color <?php if ($folder->color == 'danger') echo 'opaque'; ?>" id="danger"></span>
                <input type="hidden" name="color" id="color" value="{{$folder->color}}">
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