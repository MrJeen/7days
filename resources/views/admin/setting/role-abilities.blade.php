
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">分配权限</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <ul id="permission" class="ztree"></ul>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            <button type="button" class="btn btn-primary save-abilities" data-url="{{ route('admin_role_ability_store',['id'=>$roleId]) }}">保存</button>
        </div>
    </div>
</div>


<script>
    var zTreeObj,
        setting = {
            check: {
                enable: true,
            },
            view: {
                selectedMulti: false
            },
        },
        zTreeNodes = {!! $abilities !!}

        $(document).ready(function () {
            zTreeObj = $.fn.zTree.init($("#permission"), setting, zTreeNodes);
        });


    $(".save-abilities").click(function(){
        var nodes = zTreeObj.getCheckedNodes(true);
        var abilities = [];
        for(var i=0;i<nodes.length;i++) {
            abilities.push(nodes[i].id);
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).data('url'),
            method: 'POST',
            data: {
                abilities: abilities,
            },
            success:function(res){
                window.location.reload();
            },
            error: function(res){
                alert(res.responseJSON.message);
            }
        });
    });

</script>




