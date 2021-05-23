<template>
    <inertia-link :href="href" :class="classes">
        <slot></slot>
    </inertia-link>
</template>

<script>
    export default {
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-purple-600 text-sm font-medium leading-5 text-gray-100 focus:outline-none focus:border-purple-700 transition'
                            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-100 hover:text-gray-200 hover:border-purple-600 focus:outline-none focus:text-gray-200 focus:border-purple-700 transition'
            }
        }
    }
</script>
