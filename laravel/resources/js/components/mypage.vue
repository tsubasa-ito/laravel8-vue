<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <v-textarea v-model="newMessage" outlined name="newmessage" label="Message" class="mb-0"></v-textarea>
                <v-btn @click="addMessage()" depressed elevation="2" plain color="primary" type="submit" class="mb-4">
                    <v-icon>mdi-plus</v-icon>Post
                </v-btn>
                <div v-for="message in messages" :key="message.id" class="mb-2">
                    <v-card elevation="2" v-if="userId == message.user_id" class="mb-4">
                        <v-card-title class="mb-2">
                            <span>{{ message.content }}</span>
                            <v-spacer></v-spacer>
                                <v-menu bottom left>
                                    <template v-slot:activator="{ on, attrs }" v-if="userId == message.user_id">
                                      <v-btn
                                        icon
                                        v-bind="attrs"
                                        v-on="on"
                                      >
                                        <v-icon>mdi-dots-vertical</v-icon>
                                      </v-btn>
                                    </template>
                                    <v-list dense>
                                      <v-list-item @click="deleteMessage(message.id)">
                                            <v-list-item-icon>
                                                <v-icon>mdi-trash-can-outline</v-icon>
                                            </v-list-item-icon>
                                        <v-list-item-title>Delete</v-list-item-title>
                                      </v-list-item>
                                    </v-list>
                                </v-menu>
                            </v-card-title>
                        <v-card-subtitle><p>{{ message.date }}</p></v-card-subtitle>
                    </v-card>
                </div>
                                <div class="text-center">
                    <v-pagination
                      v-model="page"
                      :length="lastPage"
                      @input="nowMessage"
                    ></v-pagination>
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
                newMessage: '',
                newMessage: '',
                page: 1,
                lastPage: 1,
            }
        },
        props:[
            'userId'
        ],
        created() {
            this.nowMessage(this.page);
        },
        methods: {
            nowMessage(page) {
                const uri = '/api';
                axios.get(uri, {
                    params: {
                        page: parseInt(page),
                    },
                })
                .then(response => {
                    this.messages = response.data.data;
                    this.lastPage = response.data.meta.last_page;

                    let url = '/mypage'
                    if (this.page > 1) {
                        url += '?page=' + this.page
                    }
                    window.history.pushState(null, null, url)
                    scrollTo(0, 0)
                });
            },
            deleteMessage(id){
                const uri = `/api/delete/${id}`;
                axios.delete(uri, {
                   message: this.message
                   })
                .then (response => {
                    const index = this.messages.findIndex(
                        message => message.id == id
                    );
                    this.messages.splice(index, 1);
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
                    this.nowMessage(this.page);
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
