<script type="text/javascript">
    function confirmModal(deleteUrl)
    {
        $('.modal-footer').show();
        jQuery('#confirm-delete').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , deleteUrl);
    }
</script>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                {{__('web.delete_confirmation')}}
            </h5>
            <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="m-section__content">
                <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                    <div class="m-demo__preview">
                        <p class="lead">
                            {{__('web.delete_confirm_message')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" id="delete_link" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                <span>
                    <i class="la la-trash"></i>
                    <span>{{__('web.delete')}}</span>
                </span>
            </a>
            <button type="button" class="btn btn-secondary m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air modal-close"
                data-dismiss="modal">
                {{__('web.close')}}
            </button>
        </div>
    </div>
</div>
</div>


<script type="text/javascript">
    function showAjaxModal(url)
    {
        // SHOWING AJAX PRELOADER IMAGE
        jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="{{ asset('backend/assets/images/preloader.gif') }}" /></div>');

        // LOADING THE AJAX MODAL
        jQuery('#modal_theme_danger').modal('show', {backdrop: 'true'});

        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
                jQuery('#modal_theme_danger .modal-content').html(response);
            }
        });
    }
</script>


<div id="modal_theme_danger" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>
<!-- /default modal -->

<div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal-lg-title" id="exampleModalLabel"></h5>
                <button type="button" class="close modal-close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air"
                    id="modal-submit-button">
                    <span>
                        <i class="la la-save"></i>
                        <span>{{__('web.save')}}</span>
                    </span>
                </button>
                <button type="button" class="btn btn-secondary m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air modal-close">
                    {{__('web.close')}}
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    function presentModal(url, title) {
        $('#m_modal_4 .modal-body').html('<div class="m-loader m-loader--primary" style="width: 30px; display: inline-block;"></div>');
        $('#m_modal_4').modal('show');
        $('.modal-lg-title').html(title);
        $.ajax({
            url: url
        }).done(function (response) {
           $('#m_modal_4 .modal-body').html(response);
        });
    }
</script>