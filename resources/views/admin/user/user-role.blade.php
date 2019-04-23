<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">分配角色</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @if(count($roles))
                <form class="role-form" action="{{ route('admin_user_role_store',['id'=>$id]) }}" method="POST">
                    @csrf
                    @foreach($roles as $role)
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="checkbox-{{ $role->id }}" name="roles[]" class="custom-control-input" value="{{ $role->id }}" @if(in_array($role->name,$currentRoles)) checked @endif>
                            <label class="custom-control-label" for="checkbox-{{ $role->id }}">{{ $role->title }}</label>
                        </div>
                    @endforeach
                </form>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            <button type="button" class="btn btn-primary save-role" data-url="{{ route('admin_user_role_store',['id'=>$id]) }}">保存</button>
        </div>
    </div>
</div>

<script>
    $(".save-role").click(function(){
        $(".role-form").submit();
    });
</script>