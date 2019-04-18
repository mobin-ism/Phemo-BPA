@php
    $customer = \App\Customer::where('id', $id)->first();
@endphp
<form method="post" id="modal-form" action="{{ route('customers.upload_photo') }}" enctype="multipart/form-data">
    @csrf
    {{ Form::hidden('id', $id) }}
    <div class="col-lg-6">
        <div class="form-group m-form__group" id="attachment-group">
            <label>* {{__('web.photo')}}</label>
            <div></div>
            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="attachment" accept=".png" name="attachment"
                    onchange="previewFile()">
                <label class="custom-file-label" for="attachment">{{__('web.choose')}}</label>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <img src="{{url('public/storage/'.$customer->photo)}}" width="150" id="profile-image">
    </div>
</form>

<script>
    function previewFile() {
        var preview = document.querySelector('#profile-image');
        var file    = document.querySelector('input[type=file]').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
</script>