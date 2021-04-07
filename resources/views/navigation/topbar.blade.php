<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand mr-4" href="/">
            <x-jet-application-mark width="36" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                    {{ __('Users') }}
                </x-jet-nav-link>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto align-items-baseline">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <x-jet-dropdown id="teamManagementDropdown">
                    <x-slot name="trigger">
                        {{ Auth::user()->currentTeam->name }}

                        <svg class="ml-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Team Management -->
                        <h6 class="dropdown-header">
                            {{ __('Manage Team') }}
                        </h6>

                        <!-- Team Settings -->
                        <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                            {{ __('Team Settings') }}
                        </x-jet-dropdown-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                            {{ __('Create New Team') }}
                        </x-jet-dropdown-link>
                        @endcan

                        <hr class="dropdown-divider">

                        <!-- Team Switcher -->
                        <h6 class="dropdown-header">
                            {{ __('Switch Teams') }}
                        </h6>

                        @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" />
                        @endforeach
                    </x-slot>
                </x-jet-dropdown>
                @endif

                <!-- Settings Dropdown -->
                @auth
                <div wire:poll.8000ms wire:ignore.self>
                    <x-jet-dropdown id="notifications">
                    <x-slot name="trigger">
                        <div class="pr-2">
                            <i class="fas fa-bell" style="font-size: large"></i>
                            @if($newNotificationCount)
                                <span class="badge badge-danger rounded-circle noti-icon-badge">{{$newNotificationCount}}</span>
                            @endif
                        </div>
                    </x-slot>

                    <x-slot name="content">

                        <h5 class="m-0 px-3 pb-2 dropdown-header small text-muted">
                            <span class="float-right">
                                <a href="#" class="text-dark" wire:click="markAllAsRead">
                                    <small>Mark all as read</small>
                                </a>
                            </span>Notifications
                        </h5>

                        <div class="slimscroll noti-scroll shadow pt-2">

                            @foreach($notifications as $notification)

                                <x-jet-dropdown-link class="px-2" href="{{$notification['href'] ?? 'javascript:void(0);'}}" wire:click="markAsRead('{{$notification['id']}}')" class="{{$notification['unread'] ? 'bg-white':''}}">

                                    <div class="d-flex">
                                        <div class="w-10" style="width: 30px; height: 30px;">
                                            @if(isset($notification['icon']))
                                                <span class="{{$notification['icon']}} bg-primary p-2 rounded-circle" style="color: white; font-size: x-large"></span>
                                            @elseif(isset($notification['picture']))
                                                <img src="{{$notification['picture']}}" class="img-fluid rounded-circle" alt=""/>
                                            @endif
                                        </div>

                                        <p class="notify-details user-msg mb-0 pl-3" style="width: 320px; white-space: pre-wrap">{!! $notification['message'] !!}</p>
                                    </div>
                                    <p class="text-muted mb-0 user-msg" style="margin-left: 30px">
                                        <small class="text-muted pl-3">{{$notification['time']}}</small>
                                        @if($notification['new'])
                                            <i class="float-right fas fa-circle mt-1" style="color: var(--primary)"></i>
                                        @endif
                                    </p>
                                </x-jet-dropdown-link>
                            @endforeach
                        </div>

                        <a href="javascript:void(0);" wire:click="seeMore" class="dropdown-item text-center text-primary notify-item notify-all">
                            See more
                            <i class="fi-arrow-right"></i>
                        </a>

                    </x-slot>
                </x-jet-dropdown>
                </div>

                <x-jet-dropdown id="settingsDropdown">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="rounded-circle" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        @else
                        {{ Auth::user()->name }}

                        <svg class="ml-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <h6 class="dropdown-header small text-muted">
                            {{ __('Manage Account') }}
                        </h6>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-jet-dropdown-link>
                        @endif

                        <hr class="dropdown-divider">

                        <!-- Authentication -->
                        <x-jet-dropdown-link href="{{ route('logout') }}"
                                             onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            {{ __('Log out') }}
                        </x-jet-dropdown-link>
                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </x-slot>
                </x-jet-dropdown>
                @endauth
            </ul>
        </div>
    </div>
</nav>
