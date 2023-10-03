<div class="modal fade" id="showDetails" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12  col-sm-12">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                <td>{{ __("Name") }}</td>
                                <td id="name"></td>
                                </tr>

                                <tr>
                                <td>{{ __("Username") }}</td>
                                <td id="username"></td>
                                </tr>

                                <tr>
                                <td>{{ __("Email") }}</td>
                                <td id="email"></td>
                                </tr>

                                <tr>
                                <td>{{ __("created_at") }}</td>
                                <td id="created_at"></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light  ml-2" data-dismiss="modal">{{ __("Close") }}</button>
            </div>
        </div>
    </div>
</div>
