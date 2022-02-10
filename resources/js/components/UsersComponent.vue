<template>
    <div class="container">
        <div>
            <input v-model="search"
                   style="margin: 10px"
            />
            <span>Search</span>
        </div>
        <div class="users-list row"
             style="display: flex; flex-direction: row">
            <div
                class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2"
                v-for="user in filtered_users"
                :key="user.id"
                style="padding: 10px"
            >
                <img :src="img" style="width: 100%" alt="none">
                <div>{{ user.name}}</div>
                <div>{{ user.email}}</div>
                <div>{{ user.position}}</div>
            </div>
        </div>
    </div>
</template>

<script>

    import img from './placeholder.png';
    export default {
        data() {

            return {
                search: '',
                users: [],
                img
            }
        },
        computed: {
            filtered_users() {
                return this.users.filter((item) => {
                    return !this.search || item.name.match(this.search) || item.email.match(this.search)
                })
            }
        },
        async created() {
            const response = await window.axios.get('/ajax/users')
            this.users = response.data.users
        }
    }
</script>
