<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- <button type="button" class="btn btn-secondary"> -->
                    <!-- <router-link to='/create' class="create-btn">記事作成</router-link> -->

                    <textarea v-model="messages.content" class="form-control mt-2" rows="3"></textarea>
                    <button @click="addMessage()" class="btn btn-primary mb-2" type="submit">Add</button>

                <!-- </button> -->
                <div v-for="message in messages" :key="message.id" class="card">
                    <div class="card-body">
                        {{ message.content }}
                        <button @click="deleteMessage(message.id).prevent" type="submit" class="btn btn-danger">記事の削除</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                messages:
                    {
                        content: ''
                    }

            }
        },
        created() {
            const uri = '/api';
            axios.get(uri).then(response => {
               this.messages = response.data;
            });
        },
        methods: {
            deleteMessage(id){
               const uri = `/api/delete/${id}`;
               axios.delete(uri, {
                   message: this.message
                   })
                .then((response) => {
                    this.$router.go({ name: 'index' })
               });
            },
            addMessage(){
               const uri = `/api/create/`;
               axios.post(uri, {
                   message: this.message
                   })
                .then((response) => {
                   this.$router.go({name: 'index'});
               });
            },
        },
    }
</script>
<style lang="scss" scoped>
    .create-btn {
        color: white;
    }
</style>
