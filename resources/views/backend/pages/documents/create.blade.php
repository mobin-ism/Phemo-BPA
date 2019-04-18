@if (is_permitted('doc_create'))
<form method="post" id="modal-form" action="{{ route('documents.store') }}">
    @csrf
    {{ Form::hidden('account_id', Auth::user()->account_id) }}
    {{ Form::hidden('folder_id', $folder_id) }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="name-group">
                <label for="name">
                    * {{__('web.name')}}
                </label>
                <input type="text" class="form-control m-input m-input--pill" id="name" name="name">
            </div>
            <div class="form-group m-form__group" id="">
                <label for="notes">
                    {{__('web.notes')}}
                </label>
                <textarea class="form-control m-input m-input--pill" id="notes" name="notes" rows="5"></textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group m-form__group" id="attachment-group">
                <label>* {{__('web.document')}}</label>
                <div></div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="attachment" accept="application/pdf" name="attachment">
                    <label class="custom-file-label" for="attachment">{{__('web.choose')}}</label>
                </div>
                <p class="filename mt-3"></p>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.modal-footer').show();
        $('input[type=file]').on('change', function() {
            $('.filename').html($(this).val());
        });
    });
</script>
@endif