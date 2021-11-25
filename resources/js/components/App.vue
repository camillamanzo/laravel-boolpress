<template>
    <div class="container">

        <!-- passing title to header -->
        <Header :title="title"/>
        <main>
            <PostList />
        </main>
    </div>
</template>

<script>

    import Header from "./Header.vue";
    import PostList from "./PostComponents/PostList.vue";

    export default {
        name: 'App',
        data(){
            return {
                title: 'Boolpress',
            }
        },
        components: {
            Header,
            PostList
        }
    }
</script>
