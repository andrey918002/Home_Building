<template>
    <a
        :href="'/chat/' + chat.partner"
        class="chat"
    >
        <span>
            <strong>{{ chat.name }}: </strong>
            <span :class="{ no_read: is_read }">{{ chat.message }}</span>
        </span>
        <span>{{ date }}</span>
    </a>
</template>

<script>
    export default {
        props: ['chat'],
        computed: {
            is_read() {
                return this.chat.is_read != 1
            },
            date() {
                let date = new Date(this.chat.created_at)

                console.log(date)

                return `${date.getFullYear().toString().padStart(4, '0')}-${
                    date.getDate().toString().padStart(2, '0')}-${(date.getMonth()+1).toString().padStart(2, '0')}
                    ${date.getHours().toString().padStart(2, '0')}:${
                    date.getMinutes().toString().padStart(2, '0')}:${
                    date.getSeconds().toString().padStart(2, '0')}`
            }
        }
    }
</script>
