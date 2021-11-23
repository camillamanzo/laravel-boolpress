<template>
    <header>
        <h1 class="text-center py-5">{{ title }}</h1>
    </header>
</template>

<script>
export default {
    name: 'Header',
    props: {
        'title' : String
    },
}
</script>

<style>

</style>