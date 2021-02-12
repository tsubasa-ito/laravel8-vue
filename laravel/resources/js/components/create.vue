<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body mb-3">
                        <label for="exampleFormControlTextarea" class="form-label">Example textarea</label>
                        <textarea v-model="message.content" class="form-control" rows="3"></textarea>
                    </div>
                    <button @click="addMessage()" class="btn btn-primary" type="submit">Add</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message:
                    {
                        content: ''
                    }
            }
        },
        methods: {
            addMessage(){
               console.log(this.message);
               const uri = `/api/create/`;
               axios.post(uri, {
                   message: this.message
                   })
                .then((response) => {
                   this.$router.push({name: 'index'});
               });
            },
        },
    }
</script>
