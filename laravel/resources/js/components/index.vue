<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <router-link to='/create'>記事作成</router-link>
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        this is index.vue
                        <div v-for="message in messages" :key="message.id">
                            <div class="blog-card" >
                                {{ message.content }}
                            </div>
                        </div>

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
                messages: [
                    {
                        content: ''
                    }
                ]
            }
        },
        created() {
            const uri = '/api';
            axios.get(uri).then(response => {
               this.messages = response.data;
        });
       },

    }
</script>
