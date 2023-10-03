<div class="modal fade" id="editFeatured" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="featuredmodalTitle"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <form id="editArticleFeaturedForm" name="editArticleFeaturedForm" class="form-horizontal" novalidate="">
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12  col-sm-12">
                            {{--  <label>{{ __('Article Status') }}</label>  --}}
                            <div class="input-group article_featured">
                                 <select class="custom-select" class="form-control" name="is_featured" >
                                    <option value='1'>{{ __('Yes') }}</option>
                                    <option value='0'>{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-edit-article-featured" class="btn btn-primary">{{ __("Submit") }}</button>
                    <input type="hidden" id="edit_featured_article_id" name="edit_featured_article_id" value="">
                    <button type="button" class="btn btn-light  ml-2" data-dismiss="modal">{{ __("Close") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
