<template>
    <button class="btn btn-default" v-text="text" v-on:click="follow" v-bind:class="{'btn-success': followed}"></button>
</template>

<script>
    export default {
        props: ['diary', 'user'],
        mounted() {
//            console.log('Component mounted.')
            axios.post('/api/diary/follower', {'diary':this.diary,'user':this.user})
                .then(response => {
                    console.log(response.data)
                    this.followed = response.data.followed;
                });
//            this.axios.post('/api/diary/follower', {}).then(response=>{
//                console.log(response.data)
//            })
        },
        data() {
            return {
                followed: false
            }
        },
        computed: {
            text() {
                return this.followed ? '已关注' : '关注该日志'
            }
        },
        methods:{
            follow() {
                axios.post('/api/diary/follow', {'diary':this.diary,'user':this.user})
                    .then(response => {
                        console.log(response.data)
                        this.followed = response.data.followed;
                    });
            }
        }
    }
</script>
