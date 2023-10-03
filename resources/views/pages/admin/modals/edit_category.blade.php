<div class="modal fade" id="editCategory" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle2"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form id="editQuizCategoryForm" name="editQuizCategoryForm" class="form-horizontal" novalidate="">
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12  col-sm-12">
                        <label>{{ __('Edit Category') }}</label>
                        <div class="input-group ">
                            <select class="custom-select" class="form-control" id ="category" name="category" style="width:100%" >
                             </select>
                        </div>

                        {{--  <div class="input-group">
                             <select id='category' class="custom-select" class="form-control" name="category">
                            </select>
                        </div>  --}}
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" id="btn-edit-quiz-category" class="btn btn-primary">{{ __("Submit") }}</button>
                <input type="hidden" id="edit_category_id" name="edit_category_id" value="">
                <button type="button" class="btn btn-light  ml-2" data-dismiss="modal">{{ __("Close") }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
