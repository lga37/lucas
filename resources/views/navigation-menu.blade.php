<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-2">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links for desktop-->
                <div class="flex items-center space-x-0 sm:-my-px sm:ms-10 sm:flex hidden inline-block print:hidden">
                    <x-nav-link 
                    class="px-2 py-1 h-9 border border-blue-200 rounded-md text-blue-800 hover:bg-blue-200 mr-2"
                    href="{{ route('home') }}" :active="request()->routeIs('home')">
                        BRASIL
                    </x-nav-link>

                 

                    @php
                        $ufs = collect([
                            ['uf' => 'AC', 'regiao_id' => 1],
                            ['uf' => 'AL', 'regiao_id' => 2],
                            ['uf' => 'AM', 'regiao_id' => 1],
                            ['uf' => 'AP', 'regiao_id' => 1],
                            ['uf' => 'BA', 'regiao_id' => 2],
                            ['uf' => 'CE', 'regiao_id' => 2],
                            ['uf' => 'DF', 'regiao_id' => 3],
                            ['uf' => 'ES', 'regiao_id' => 4],
                            ['uf' => 'GO', 'regiao_id' => 3],
                            ['uf' => 'MA', 'regiao_id' => 2],
                            ['uf' => 'MG', 'regiao_id' => 4],
                            ['uf' => 'MS', 'regiao_id' => 3],
                            ['uf' => 'MT', 'regiao_id' => 3],
                            ['uf' => 'PA', 'regiao_id' => 1],
                            ['uf' => 'PB', 'regiao_id' => 2],
                            ['uf' => 'PE', 'regiao_id' => 2],
                            ['uf' => 'PI', 'regiao_id' => 2],
                            ['uf' => 'PR', 'regiao_id' => 5],
                            ['uf' => 'RJ', 'regiao_id' => 4],
                            ['uf' => 'RN', 'regiao_id' => 2],
                            ['uf' => 'RO', 'regiao_id' => 1],
                            ['uf' => 'RR', 'regiao_id' => 1],
                            ['uf' => 'RS', 'regiao_id' => 5],
                            ['uf' => 'SC', 'regiao_id' => 5],
                            ['uf' => 'SE', 'regiao_id' => 2],
                            ['uf' => 'SP', 'regiao_id' => 4],
                            ['uf' => 'TO', 'regiao_id' => 1],
                        ])
                        ->map(fn($uf) => (object) $uf)
                        ;

                        $ufsGrouped = $ufs->sortBy('uf')->sortByDesc('regiao_id')->groupBy('regiao_id');

                        #dump($ufsGrouped);

                    @endphp


                    <div class="ml-2 flex gap-1 items-center ">
                        @foreach ($ufsGrouped as $regiao_id => $ufs)
                            @php
                                $qtd = ceil($ufs->count() / 2) ;
                                #echo $qtd;
                                if($qtd == 5){
                                    $qtd = 6;
                                }
                                
                            @endphp
                            <div class="grid grid-cols-{{ $qtd }} gap-1 border border-gray-300 rounded-md shadow-sm bg-white p-1 dark:bg-gray-700">
                                @foreach ($ufs as $uf)
                                    @php
                                        $isActive = request()->route('uf') === $uf->uf;
                                    @endphp
                                    <a 
                                        href="{{ route('byuf', ['uf' => $uf->uf]) }}" 
                                        class="text-center text-sm px-1 h-5 py-0.5 items-center border border-gray-200 rounded 
                                        leading-none {{ $isActive ? 'font-bold border-blue-900 text-blue-900 bg-blue-200' : 'hover:bg-green-200 hover:text-green-800 hover:border-green-800' }}"
                                        >
                                        {{ $uf->uf }}
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    @guest
                    <div class="flex items-center ml-4 space-x-2">
                        <a
                        href="{{ route('login') }}"
                        class="px-2 py-1 h-9 border border-blue-300 rounded-md text-blue-800 hover:bg-blue-200 ml-2 dark:text-white"
                        >
                            Login
                        </a>
                        <a
                            href="{{ route('register') }}"
                            class="px-2 py-1 h-9 border border-blue-300 rounded-md text-blue-800 hover:bg-blue-200 mr-2 dark:text-white"
                        >
                            Register
                        </a>
                    

                    </div>

                    @endguest
                    <!-- With Alpine.js -->
                    <button
                        x-data="{ dark: document.documentElement.classList.contains('dark') }"
                        @click="dark = !dark;
                                document.documentElement.classList.toggle('dark');
                                localStorage.setItem('theme', dark ? 'dark' : 'light')"
                        class="px-3 py-1 px-2 bg-gray-200 dark:bg-gray-700 text-black dark:text-white rounded"
                    >
                        <span x-show="!dark">🌞 Light</span>
                        <span x-show="dark">🌙 Dark</span>
                    </button>
                    @adm
                    <div class="flex items-center ml-4 space-x-2">
                    <x-nav-link class="px-2 py-1 h-9 border border-red-200 rounded-md text-red-800 hover:bg-red-200" href="#">Admin</x-nav-link>
                    <x-nav-link class="px-2 py-1 h-9 border border-red-200 rounded-md text-red-800 hover:bg-red-200" href="#">Admin</x-nav-link>
                    <x-nav-link class="px-2 py-1 h-9 border border-red-200 rounded-md text-red-800 hover:bg-red-200" href="#">Admin</x-nav-link>
                    <x-nav-link class="px-2 py-1 h-9 border border-red-200 rounded-md text-red-800 hover:bg-red-200" href="#">Admin</x-nav-link>
                    <x-nav-link class="px-2 py-1 h-9 border border-red-200 rounded-md text-red-800 hover:bg-red-200" href="#">Admin</x-nav-link>


                    </div>
                    @endadm        
                </div>
            </div>
            @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                {{ __('home') }}
            </x-responsive-nav-link>

             @guest
                  <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    {{ __('login') }}
                </x-responsive-nav-link>
                 <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                    {{ __('register') }}
                </x-responsive-nav-link>
            @endguest

                @adm
                    @for ($i = 0; $i < 5; $i++)
                       <x-responsive-nav-link href="#">
                    {{ __('admin') }}
                    </x-responsive-nav-link>
                    @endfor
                @endadm

        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
        @endauth

    </div>
</nav>
