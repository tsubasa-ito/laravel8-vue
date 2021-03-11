<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <v-textarea v-model="newMessage" outlined name="newmessage" label="Message" class="mb-2"></v-textarea>
                <v-btn @click="addMessage()" depressed elevation="2" plain color="primary" type="submit" class="mb-4">Post</v-btn>
                <div v-for="message in messages" :key="message.id" class="mb-2">
                    <v-card elevation="2" class="mb-2">
                        <v-card-text>
                            <p>{{ message.content }}</p>
                            <p>{{ message.date }}</p>
                        </v-card-text>
                        <v-card-actions>
                            <v-btn v-if="userId == message.user_id" depressed elevation="2" plain color="error" @click="deleteMessage(message.id)" type="submit">Delete</v-btn>
                        </v-card-actions>
                    </v-card>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                messages: [
                    {
                    id:'',
                    content: '',
                    date: '',
                    user_id: ''
                    }
                ],
                newMessage: ''
            }
        },
        props:[
            'userId'
        ],
        created() {
            const uri = '/api';
            axios.get(uri).then(response => {
               this.messages = response.data.data;
            });
        },
        methods: {
            nowMessage() {
                const uri = '/api';
                axios.get(uri).then(response => {
                    this.messages = response.data.data;
                });
            },
            deleteMessage(id){
                const uri = `/api/delete/${id}`;
                axios.delete(uri, {
                   message: this.message
                   })
                .then (response => {
                    this.nowMessage();
                })
                .catch( error => {
                    console.log(error);
                });
            },
            addMessage(){
                if (this.newMessage == "") {
                    alert("入力してください");
                    return;
                }

                const uri = `/api/create/`;
                axios.post(uri, {
                   message: this.newMessage,
                   user_id: this.userId
                })
                .then((response) => {
                    this.messages.push(
                        {
                            'id': response.data.id,
                            'content': response.data.content,
                            'user_id': response.data.user_id,
                        }
                    )
                    this.nowMessage();
                    this.newMessage = ''
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
