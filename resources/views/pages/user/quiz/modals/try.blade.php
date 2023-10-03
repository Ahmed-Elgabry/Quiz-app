<div class="modal fade" id="showDetails" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <br>
                <div class="form-group has-error">
                    <div class="col-lg-12">
                        <label class="control-label" for="firstname">{{ __('Enter your name Please') }} :</label>
                        <input type="text" class="form-control required" id="guest">
                        <p id="red_msg" style="color: red;"></p>
                        </div>
                    </div>
                <br>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary open-modal-do-try-quiz">{{ __("Submit") }}</button>
                <input type="hidden" id="quizIdforTry" name="quizIdforTry" value="">
                <button type="button" class="btn btn-light  ml-2" data-dismiss="modal">{{ __("Close") }}</button>
            </div>
        </div>
    </div>
</div>
