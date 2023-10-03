<div class="modal fade" id="editLang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form id="editQuizLangForm" name="editQuizLangForm" class="form-horizontal" novalidate="">
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12  col-sm-12">
                        <label>{{ __('Edit Language') }}</label>
                        <div class="input-group article_Lang">
                            <select class="custom-select" class="form-control" name="lang" >
                                <option value="non"></option>
                                <option value="ar">{{ __('Arabic') }}</option>
                                <option value="en">{{ __('English') }}</option>
                             </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" id="btn-edit-quiz-lang" class="btn btn-primary">{{ __("Submit") }}</button>
                <input type="hidden" id="edit_lang_id" name="edit_lang_id" value="">
                <button type="button" class="btn btn-light  ml-2" data-dismiss="modal">{{ __("Close") }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
