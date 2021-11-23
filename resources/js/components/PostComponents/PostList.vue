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
            baseUri: 'http://127.0.0.1:8000',
            posts: [],
            isLoading: false,
        }
    },
    methods: {
        getPostList(){
            this.isLoading = true;

            axios.get(`${this.baseUri}/api/posts/`)
            .then((response)=>{
                console.log(response.data);
                this.posts = response.data.posts;

            })
            .catch((error)=>{
                console.error(error);
            })
            .then(()=>{
                // eseguo sempre indipendemente dall'andamento della chiamata axios
                this.isLoading = false;
            });
        }
    },
    mounted(){
        this.getPostList()
    }

}
</script>

<style lang="scss" scoped>
    .loader{
        width: 100%;
        position: fixed;
        top : 0;
        left : 0;
        right : 0;
        bottom : 0;
        background-color: rgb(255, 255, 255);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index : 8;
    }
    .spinner-border{
        width: 200px;
        height: 200px;
    }
</style>