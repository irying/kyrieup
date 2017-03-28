<template>
    <div>
        <button
                class="btn btn-default"
                @click="showSendMessageForm">
            发送私信
        </button>
        <div class="modal fade" id="modal-send-message" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            发送私信
                        </h4>
                    </div>

                    <div class="modal-body">
                        <textarea name="body" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
o
                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="store">发送私信</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods:{
            store() {
//                axios.post('/api/user/follow', {'user':this.user})
//                    .then(response => {
//                        console.log(response.data)
//                        this.followed = response.data.followed;
//                    });
            },
            showSendMessageForm() {
                $('#modal-send-message').modal('show')
            }
        }
    }
</script>
