<li class="nav-item dropdown" wire:poll.8000ms wire:ignore.self>
    <a id="notifications" class="nav-link" role="button" data-toggle="dropdown" aria-expanded="false" x-data="{}" x-on:click="setTimeout(() => {$wire.markAsOld()}, 1500)" wire:ignore.self>
        <div class="pr-2">
            <i class="fas fa-bell" style="font-size: large"></i>
            @if($newNotificationCount)
                <span class="badge badge-danger rounded-circle noti-icon-badge">{{$newNotificationCount}}</span>
            @endif
        </div>
    </a>

    <div class="dropdown-menu dropdown-menu-right animate slideIn w-auto" aria-labelledby="notifications" wire:ignore.self>

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
                                <span class="{{$notification['icon']}} bg-primary p-2 rounded-circle" style="color: white; font-size: large"></span>
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

    </div>
</li>
