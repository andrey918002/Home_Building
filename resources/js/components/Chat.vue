<template>
    <div>
        <chat-error/>
        <chat-messages/>
        <chat-form/>
    </div>
</template>

<script>
    import ChatError from "./ChatError";
    import ChatForm from "./ChatForm";
    import ChatMessages from "./ChatMessages";

    export default {
        components: {
            ChatError,
            ChatForm,
            ChatMessages
        },
        mounted() {
            this.$store.dispatch('FETCH_MESSAGES', { to: window.chat_id }) // подтягивание истории сообщений
        }
    }
</script>

