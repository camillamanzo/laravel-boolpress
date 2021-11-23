<template>
    <section>
        
    </section>
</template>

<script>
export default {
    name: 'PostList',
    data(){
        return{

            posts: [],
            baseUri: 'http://127.0.0.1:8000'
        }
    },
    methods: {
        getPostList(){
            console.log('chiamata');
            axios.get(`${this.baseUri}/api/posts/`)
            .then((response)=>{
                console.log(response.data);
                this.posts = response.data;

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