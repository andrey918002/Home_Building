<template>
    <div>
        <div
            v-if="messages.length"
            class="messages"
            @scroll="scroll"
        >
            <div class="messages-inner">
                <chat-messages-message
                    v-for="message in messages"
                    :key="message.id"
                    :message="message"
                />
            </div>
        </div>
        <div v-else>
            No messages
        </div>

        <button
            v-show="scrollPosition > 400"
            @click="goDawn"
            type="button"
            class="btn btn-primary"
        >Go down</button>
    </div>
</template>

<script>
    import ChatMessagesMessage from "./ChatMessagesMessage";

    export default {
        components: {
            ChatMessagesMessage
        },
        data() {
            return {
                page: 1,
                scrollPosition: 0
            }
        },
        computed: {
            loading() {
                return this.$store.getters['GET_MESSAGES_LOADING']
            },
            messages() {
                return this.$store.getters['GET_MESSAGES']
            },
            noOldMessages() {
                return this.$store.getters['GET_NO_OLD_MESSAGES']
            }
        },
        methods: {
            goDawn() {
                const container = this.$el.querySelector('.messages')
                container.scrollTop = container.scrollHeight
            },
            scroll(e) {
                this.scrollPosition = e.target.scrollHeight - e.target.scrollTop

                if(this.noOldMessages || this.loading || e.target.scrollTop > 0) {
                    return;
                }

                this.page++

                this.$store.dispatch('FETCH_MESSAGES', {
                    to: window.chat_id,
                    page: this.page
                })
            }
        },
        watch: {
            messages(newVal, oldVal) {
                if(!newVal.length) return

                setTimeout(() => {
                    if(this.page == 1) {

                        const container = this.$el.querySelector('.messages')

                        if(container.scrollHeight <= container.offsetHeight) {
                            container.querySelector('.messages-inner').style.minHeight = (container.offsetHeight + 1) + 'px'
                        }

                        container.scrollTop = container.scrollHeight

                    } else {
                        const newLastItem = newVal[newVal.length - 1]
                        const oldLastItem = oldVal[oldVal.length - 1]

                        const container = this.$el.querySelector('.messages')

                        if(newLastItem.id != oldLastItem.id) {
                            container.scrollTop = container.scrollHeight
                        } else {
                            const message = document.getElementById('message-' + newVal[newVal.length - oldVal.length - 1].id)

                            container.scrollTop = message.offsetTop - container.offsetTop + message.offsetHeight - 10
                        }

                    }
                }, 50)
            }
        }
    }
</script>
