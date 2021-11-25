<template>
    <div class="card my-4">

        <div class="card-header">
            <h4> {{ post.title }} </h4>
        </div>

        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p class="card-body"> {{ post.content }}</p>
                <footer class="blockquote-footer">
                    <!-- <cite title="Source Title">{{ post.user() }}</cite> -->
                    <time>{{ post.date }}</time>
                </footer>
            </blockquote>
        </div>
        
    </div>
</template>

<script>

export default {
    name: 'PostCard',
    props: ['post']
}
</script>

<style>

</style>