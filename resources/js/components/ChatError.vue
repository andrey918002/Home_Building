<template>
    <div
        v-if="error"
        class="alert alert-danger alert-dismissible"
    >
        {{ error }}
        <button
            @click="clear"
            type="button"
            class="btn-close"
            aria-label="Close"
        ></button>
    </div>
</template>

<script>
    export default {
        computed: {
            error() {
                return this.$store.getters['GET_ERROR']
            }
        },
        methods: {
            clear() {
                this.$store.commit('SET_ERROR', '')
            }
        }
    }
</script>
