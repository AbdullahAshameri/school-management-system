<div class="modal fade" id="delete_schedule{{$schedule->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-family: 'Cairo', sans-serif;">حذف جدول</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>هل أنت متأكد من أنك تريد حذف الجدول <span class="text-danger">{{$schedule->title}}</span>؟</p>
                    <input type="hidden" name="id" value="{{$schedule->id}}">
                    <input type="hidden" name="file_name" value="{{$schedule->file_name}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-danger">حذف</button>
                </div>
            </div>
        </form>
    </div>
</div>
