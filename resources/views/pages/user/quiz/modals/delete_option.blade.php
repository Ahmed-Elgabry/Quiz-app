<!-- Option Modal -->
<div class="modal fade" id="DeleteOptionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __("Delete Option") }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="Option" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    {{ __("Are you sure you want to delete this Option?") }} <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __("Close") }}</button>
                    <button type="submit" name="" class="btn btn-danger" onclick="OptionSubmit()">{{ __("Delete") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
