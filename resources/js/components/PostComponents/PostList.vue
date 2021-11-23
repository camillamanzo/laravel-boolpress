<template>
    <section>

        <div class="loader" v-if="isLoading">
            <div class="spinner-border text-info " role="status">
                <span class="sr-only">Loading...</span>        
            </div>
        </div>

        <div v-else>
            <h3>My Posts:</h3>
            <PostCard v-for="post in posts" :key="post.id" :post="post" />
        </div>
        
    </section>
</template>

<script>

import PostCard from "./PostCard.vue";

export default {
    name: 'PostList',
    components: {
        PostCard,
    },
    data(){
        return{

            posts: [],
            baseUri: 'http://127.0.0.1:8000'
        }
    },
    methods: {
        getPostList(){
            axios.get(`${this.baseUri}/api/posts/`)
            .then((response)=>{
                console.log(response.data);
                this.posts = response.data.posts;

            })
            .catch((error)=>{
                console.error(error);
            })
        }
    },
    mounted(){
        this.getPostList()
    }

}
</script>

<style>

</style>