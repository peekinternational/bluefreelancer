<div class="card-body">
    <h5 class="card-title mb-1">{{ $pub->title }}
        @if (request()->has('edit_profile'))
            <div style="float: right" class="row">
                <a class="fa fa-pencil editable-btn-dark" data-toggle="modal" id="pub_UpModal_btn"
                    data-id="{{ $pub->id }}"></a>
                <form action="{{ route('publication.destory', $pub) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: transparent; border: 1px solid #fff;"><i
                            class="fa fa-times editable-btn-dark"
                            onclick="return confirm('Are you sure you want to delete this?')"></i></button>
                </form>

            </div>
        @endif
    </h5>
    <p class="font-size-xs">by <b>{{ $pub->name }}</b></p>
    <p class="card-text bold">{{ $pub->summary }}</p>
</div>


{{-- Publication Modal --}}
<div class="modal fade" id="publication_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Publication</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="publication_update_form" method="post">
                    <input type="hidden" name="" id="pub_id">
                    <label class="font-size-ms font-weight-bold" for="pub_title">Publication Title:</label>
                    <input type="text" name="pub_title" class="form-control" id="pub_title_update">
                    <label for="pub_name">Publisher:</label>
                    <input type="text" name="pub_name" class="form-control" id="pub_name_update">
                    <label for="pub_summary">Summary:</label>
                    <textarea class="form-control" name="description" id="pub_summary_update" cols="30" rows="10"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="publication-update-btn">Save changes</button>
            </div>
        </div>
    </div>
</div>  