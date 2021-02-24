<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <textarea v-model="newMessage" class="form-control mt-2" rows="3"></textarea>
                <button @click="addMessage()" class="btn btn-primary mb-2" type="submit">Add</button>
                <div v-for="message in messages" :key="message.id" class="card">
                    <div class="card-body">
                        <p>{{ message.content }}</p>
                        <p>{{ message.date }}</p>
                        <button @click="deleteMessage(message.id)" type="submit" class="btn btn-danger">記事の削除</button>
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
                    [
                        {
                        id:'',
                        content: '',
                        date: ''
                        }
                    ],
                newMessage: ''

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
                   message: this.newMessage
                   })
                .then((response) => {
                    this.messages.push(
                        {
                            'id': response.data.id,
                            'content': response.data.content
                        }
                    )
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
