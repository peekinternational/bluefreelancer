<div class="card-body">
    <h5 class="card-title mb-1">{{ $cert->name }}
        @if (request()->has('edit_profile'))
            <div style="float: right" class="row">
                <a class="fa fa-pencil editable-btn-dark" data-toggle="modal" id="cert_UpModal_btn"
                    data-id="{{ $cert->id }}"></a>
                <form action="{{ route('certification.destory', $cert) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: transparent; border: 1px solid #fff;"><i
                            class="fa fa-times editable-btn-dark" onclick="return confirm('Are you sure you want to delete this?')"></i></button>
                </form>

            </div>
        @endif
    </h5>
    <p class="font-size-xs">{{ $cert->organization }}</p>
    <p class="font-size-ms">{{ $cert->issue_date->format('M d, Y') }}</p>
    <p class="card-text bold">{{ $cert->description }}</p>
</div>

{{-- Certification update Modal --}}
<div class="modal fade" id="certification_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Certification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="certification_form" method="post">
                    <input type="hidden" name="" id="cert_id">
                    <label class="font-size-ms font-weight-bold" for="name">Certifications, Diplomas or Awards:</label>
                    <input type="text" name="name" class="form-control" id="cert_name_update">
                    <label for="organization">Conferring Organization:</label>
                    <input type="text" name="organization" class="form-control" id="organization_update">
                    <label for="subjects">Detailed description of certification:</label>
                    <textarea class="form-control" name="description" id="description_update" cols="30"
                        rows="10"></textarea>
                    <label for="issue_date">Issue Date:</label>
                    <input type="date" class="form-control" name="issue_date" id="issue_date_update">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="certification-update-btn">Save changes</button>
            </div>
        </div>
    </div>
</div>
