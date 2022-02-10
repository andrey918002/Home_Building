<template>
    <div
        :id="'message-' + message.id"
        :class="{ 'message-from-me': isSenderMe }"
        class="message"
    >
        <div>
            {{ message.message }}
        </div>
    </div>
</template>

<script>
    export default {
        props: ['message'],
        computed: {
            isSenderMe() {
                return window.chat_id != this.message.to
            }
        }
    }
</script>
