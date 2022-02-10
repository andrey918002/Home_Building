<template>
    <div>
        <form @submit.prevent="submit">
            <textarea v-model="message"></textarea>
            <button type="submit" class="btn btn-success">Send</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            }
        },
        methods: {
            submit() {
                this.$store.dispatch('SEND_MESSAGE', {
                    id: window.chat_id,
                    message: this.message // передача методу аргументов: id и само сообщение
                }).then(() => {
                    this.message = '' // обуление сообщения после нажатия на кнопку отправ
                })
            }
        }
    }
</script>
