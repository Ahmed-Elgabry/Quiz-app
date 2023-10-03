<div class="modal fade" id="DeleteOptionImgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __("Delete Option Image") }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form action="" id="OptionImg" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">
                    {{ __("Are you sure you want to delete this image?") }} <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __("Close") }}</button>
                    <button type="submit" name="" class="btn btn-danger" onclick="OptionImgSubmit()">{{ __("Delete") }}</button>
                </div>
            </form>


        </div>
    </div>
</div>
