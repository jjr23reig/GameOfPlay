<template>
    <div>
        <button :class="classes" class="w-full text-left" v-if="as == 'button'">
            <slot></slot>
        </button>

        <inertia-link :href="href" :class="classes" v-else>
            <slot></slot>
        </inertia-link>
    </div>
</template>

<script>
    export default {
        props: ['active', 'href', 'as'],

        computed: {
            classes() {
                return this.active
                            ? 'block pl-3 pr-4 py-2 border-l-4 border-purple-600 text-base font-medium text-gray-100 bg-gray-700 focus:outline-none focus:text-gray-200 focus:bg-gray-800 focus:border-purple-700 transition'
                            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-100 hover:text-gray-100 hover:bg-gray-700 hover:border-purple-600 focus:outline-none focus:text-gray-100 focus:bg-gray-700 focus:border-purple-600 transition'
            }
        }
    }
</script>
