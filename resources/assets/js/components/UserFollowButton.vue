<template>
    <button class="btn btn-default" v-text="text" v-on:click="follow" v-bind:class="{'btn-success': followed}"></button>
</template>

<script>
    export default {
        props: ['user'],
        mounted() {
//            console.log('Component mounted.')
            axios.get('/api/user/followers/'+ this.user)
                .then(response => {
                    console.log(response.data)
                    this.followed = response.data.followed;
                });
//            this.axios.post('/api/user/follower', {}).then(response=>{
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
                return this.followed ? '已关注' : '关注Ta'
            }
        },
        methods:{
            follow() {
                axios.post('/api/user/follow', {'user':this.user})
                    .then(response => {
                        console.log(response.data)
                        this.followed = response.data.followed;
                    });
            }
        }
    }
</script>
