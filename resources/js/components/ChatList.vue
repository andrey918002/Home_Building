<template>
    <div>
        <chat-list-item
            v-for="chat in chats"
            :key="chat.partner"
            :chat="chat"
        />
    </div>
</template>

<script>
    import ChatListItem from "./ChatListItem";

    export default {
        components: {
            ChatListItem
        },
        computed: {
            chats() {
                return this.$store.getters['GET_CHATS']
            }
        },
        mounted() {
            this.$store.dispatch('GET_CHATS')
        }
    }
</script>
