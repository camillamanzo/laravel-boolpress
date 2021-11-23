<template>
    <div class="container">
        <Header :title="title" />
        <main>
            <PostList />
        </main>
    </div>
</template>

<script>
    import Header from "./Header.vue";
    import PostList from "./posts/PostList.vue"

    export default {
        name: 'App',
        data(){
            return {
                title : 'Boolpress v2.5',
            }
        },
    }
</script>
