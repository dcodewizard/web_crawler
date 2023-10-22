<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="space-y-1">
                <form method="POST" class="row justify-content-end" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); 
                                        this.closest('form').submit();">
                        <button type="button" class="btn btn-danger">{{ __('Log Out') }}</button>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
