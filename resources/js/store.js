import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        chats: [],
        error: '',
        messages: [],
        messagesLoading: false,
        noOldMessages: false,
        unreadChats: 0,
    }, // глобальный стейт
    getters: {
        GET_CHATS(state) {
            return state.chats
        },
        GET_ERROR(state) {
            return state.error
        },
        GET_MESSAGES_LOADING(state) {
            return state.messagesLoading
        },
        GET_MESSAGES(state) {
            const messages = Array.from(state.messages)
            return messages.reverse()
        },
        GET_NO_OLD_MESSAGES(state) {
            return state.noOldMessages
        },
        GET_UNREAD_CHATS(state) {
            return state.unreadChats
        }
    }, // получаем глобальные стейты
    mutations: {
        ADD_MESSAGE(state, message) {
            state.messages.push(message)
        },
        ADD_NEW_MESSAGE(state, message) {
            state.messages.unshift(message)
        },
        SET_CHATS(state, chats) {
            state.chats = chats
        },
        SET_ERROR(state, error) {
            state.error = error
        },
        SET_MESSAGE_LOADING(state, loading) {
            state.messagesLoading = loading
        },
        SET_NO_OLD_MESSAGES(state) {
            state.noOldMessages = true
        },
        SET_UNREAD_CHATS(state, unreadChats) {
            state.unreadChats = unreadChats
        }
    }, // меняем глобальные стейты
    actions: {
        async GET_CHATS(context) {
            try {
                const response = await window.axios.get('ajax/chats')

                if(response.data.success) {
                    context.commit('SET_CHATS', response.data.chats)
                } else {
                    context.commit('SET_ERROR', response.data.error)
                }

                console.log(response.data)
            } catch (e) {
                if(e.message != 'Request aborted') {
                    context.commit('SET_ERROR', 'Connection Error!')
                }
            }
        },
        async CHECK_UNREAD_CHATS(context) {
            async function checkChats() {
                try {
                    const response = await window.axios.get('ajax/chat-get-new-chats')

                    if(response.data.success) {
                        context.commit('SET_UNREAD_CHATS', response.data.chats)

                        setTimeout(() => {
                            checkChats()
                        }, 3000)
                    } else {
                        context.commit('SET_ERROR', response.data.error)
                    }
                } catch (e) {
                    if(e.message != 'Request aborted') {
                        context.commit('SET_ERROR', 'Connection Error!')
                    }
                }
            }

            await checkChats()
        },
        async CHECK_MESSAGE(context, payload) {
            async function checkMessage() {
                try {
                    const response = await window.axios.get('ajax/chat-get-new-messages', {
                        params: payload
                    })

                    if(response.data.success) {
                        for(let message of response.data.messages) {
                            context.commit('ADD_MESSAGE', message)
                        }

                        setTimeout(() => {
                            checkMessage()
                        }, 3000)
                    } else {
                        context.commit('SET_ERROR', response.data.error)
                    }
                } catch (e) {
                    if(e.message != 'Request aborted') {
                        context.commit('SET_ERROR', 'Connection Error!')
                    }
                }
            }

            await checkMessage()
        },
        async FETCH_MESSAGES(context, payload) {
            try {
                context.commit('SET_MESSAGE_LOADING', true)

                const response = await window.axios.get('ajax/chat-messages', {
                    params: payload
                })

                if(response.data.success) {
                    for(let message of response.data.messages) {
                        context.commit('ADD_MESSAGE', message)
                    }

                    if(!response.data.messages.length) {
                        context.commit('SET_NO_OLD_MESSAGES')
                    }

                    context.dispatch('CHECK_MESSAGE', { chat_id: payload.to })
                } else {
                    context.commit('SET_ERROR', response.data.error)
                }
            } catch (e) {
                if(e.message != 'Request aborted') {
                    context.commit('SET_ERROR', 'Connection Error!')
                }
            } finally {
                context.commit('SET_MESSAGE_LOADING', false)
            }
        },
        async SEND_MESSAGE(context, payload) {
            try {
                const response = await window.axios.post('ajax/chat-message', payload)

                if(response.data.success) {
                    context.commit('ADD_NEW_MESSAGE', response.data.message)
                } else {
                    context.commit('SET_ERROR', response.data.error)
                }
            } catch (e) {
                if(e.message != 'Request aborted') {
                    context.commit('SET_ERROR', 'Connection Error!')
                }
            }
        }
    }
})

export default store
