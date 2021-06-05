<template>
    <div>
        <div class="min-h-screen bg-gray-800">
            <nav class="bg-gray-900 border-b border-gray-700 ">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                    <jet-application-mark class="block h-9 w-auto" />
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex ">
                                <jet-nav-link :href="route('games')" :active="route().current('games')" class="text-gray-100">
                                    Games
                                </jet-nav-link>
                                <jet-nav-link :href="route('information')" :active="route().current('information')" class="text-gray-100">
                                    News
                                </jet-nav-link>
                            </div>
                        </div>

                        <div class=" flex items-top justify-center min-h-screen sm:items-center sm:pt-0 text-gray-100">
                            <div v-if="$page.props.canLogin" class="hidden absolute top-0 right-0 px-6 py-4 sm:block">
                                <inertia-link v-if="$page.props.user" href="/dashboard" class="text-lg text-purple-500 font-black">
                                    {{ $page.props.user.nick }}
                                </inertia-link>

                                <template v-else>
                                    <inertia-link :href="route('login')" class="text-lg text-purple-500 font-black">
                                        Log in
                                    </inertia-link>

                                    <inertia-link v-if="$page.props.canRegister" :href="route('register')" class="ml-4 text-lg text-purple-500 font-black">
                                        Register
                                    </inertia-link>
                                </template>
                            </div>
                        </div>

                        

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-100 hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-gray-100 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>



                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <jet-responsive-nav-link :href="route('games')" :active="route().current('games')">
                            Games
                        </jet-responsive-nav-link>
                    </div>
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div v-if="$page.props.canLogin" class="mt-3 space-y-1">
                            
                                <jet-responsive-nav-link v-if="$page.props.user" href="/dashboard">
                                    {{ $page.props.user.nick }}
                                </jet-responsive-nav-link>
                                <template v-else>
                                    <jet-responsive-nav-link :href="route('login')">
                                        Log in
                                    </jet-responsive-nav-link>
                                    <jet-responsive-nav-link v-if="$page.props.canRegister" :href="route('register')">
                                        Register
                                    </jet-responsive-nav-link>
                                </template>
                            
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-gray-900 shadow " v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">
                    <slot name="header"></slot>
                </div>
            </header>
            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
        </div>

    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetCountProducts from '@/Jetstream/CountProducts'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

    export default {
        props:['count'],
        components: {
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            JetCountProducts
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>

