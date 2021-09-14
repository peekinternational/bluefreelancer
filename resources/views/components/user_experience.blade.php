<div class="card-body">
    <h5 class="card-title mb-1">{{ $exp->title }}
        @if (request()->has('edit_profile'))
            <div style="float: right" class="row">
                <a href="javascript:void(0)" class="fa fa-pencil editable-btn-dark" id="exp_UpModal_btn"
                    data-toggle="modal" data-id="{{ $exp->id }}"></a>
                <form action="{{ route('experience.destory', $exp) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: transparent; border: 1px solid #fff;"><i
                            class="fa fa-times editable-btn-dark" onclick="return confirm('Are you sure you want to delete this?')"></i></button>
                </form>


            </div>
        @endif
    </h5>
    <p class="font-size-xs">{{ $exp->companyname }}</p>
    <p class="font-size-ms">{{ $exp->started_at->format('M d, Y') }} to {{ $exp->work_status ? 'Continue' : $exp->completion_at->format('M d, Y') }}</p>
    <p class="card-text">{{ $exp->summary }}</p>
</div>
{{-- Experience Update Modal --}}
<div class="modal fade" id="exp_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="experience_update_form" method="post">
                    <input type="hidden" name="exp_Id" id="exp_id">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" id="title_update">
                    <label for="companyname">Company Name:</label>
                    <input type="text" name="companyname" class="form-control" id="companyname_update">
                    <label for="started_at">Work or Job Start Date:</label>
                    <input type="date" name="started_at" class="form-control" id="started_at_update">
                    <input type="checkbox" name="work_status" id="work_status_update"
                        onclick="ShowHideCompletionUpdate(this)" value="1">
                    <span>Currently working or developing</span>
                    <div id="completion_at_row_update">
                        <label for="completion_at">Work or Job Completion Date</label>
                        <input type="date" name="completion_at" class="form-control" id="completion_at_update">
                    </div>
                    <br>
                    <label for="summary">Summary:</label>
                    <textarea name="summary" class="form-control" id="summary_update" cols="30" rows="10"></textarea>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="experience-update-btn">Save changes</button>
            </div>
        </div>
    </div>
</div>
