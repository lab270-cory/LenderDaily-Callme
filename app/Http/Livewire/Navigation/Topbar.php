<?php


namespace App\Http\Livewire\Navigation;


use Carbon\Carbon;
use Livewire\Component;
use Auth;

class Topbar extends Component
{
    /**
     * Array of notifications
     *
     * @var array
     */
    public $notifications;

    /**
     * Count of new notifications
     *
     * @var int
     */
    public $newNotificationCount;

    /**
     * records in single batch of notifications
     *
     * @var int
     */
    public $recordsPerPage = 6;

    public function render()
    {
        $this->notifications = [];
        $this->newNotificationCount = 0;

        Auth::user()->notifications()->orderBy('created_at', 'desc')
            ->limit($this->recordsPerPage)
            ->get()->map(function ($notification) {
                $this->notifications[] = $this->getFormattedNotification($notification);
            });

        $this->newNotificationCount = Auth::user()->notifications()->where('new', 1)->count();

        Auth::user()->notifications()->where('new', 1)
            ->where('popped_up', false)
            ->where('created_at', '>', Carbon::now()->subMinutes(2))
            ->get()
            ->map(function ($notification) {
                $this->emit('showNotification', $this->getFormattedNotification($notification));
                $notification->popped_up = true;
                $notification->save();
            });

        return view('navigation.topbar');
    }


    /**
     * Formats notification in a format required by frontend
     *
     * @param $notification
     * @return array
     */
    public function getFormattedNotification($notification): array
    {
        $formattedNotification['id'] = $notification->id;
        $formattedNotification['message'] = $notification->data['message'];

        if(isset($notification->data['icon'])){
            $formattedNotification['icon'] = $notification->data['icon'];
        }

        if(isset($notification->data['picture'])){
            $formattedNotification['picture'] = $notification->data['picture'];
        }

        $formattedNotification['new'] = $notification->new;
        $formattedNotification['unread'] = !$notification->read_at;
        $formattedNotification['href'] = $notification->data['href'] ?? 'null';
        $formattedNotification['time'] = Carbon::createFromTimeStamp(strtotime($notification->created_at))->diffForHumans();

        return $formattedNotification;
    }

    /**
     * Marks all notification of logged in user as read
     */
    public function markAllAsRead()
    {
        Auth::user()->notifications()->where('read_at', null)->update(['new'=> 0, 'read_at'=> Carbon::now()]);
    }

    /**
     * Marks a notification as read
     *
     * @param $notificationId
     */
    public function markAsRead($notificationId)
    {
        Auth::user()->notifications()->where('id',$notificationId)->where('read_at', null)
            ->update(['read_at'=> Carbon::now(), 'new'=> 0]);
    }

    /**
     * marks notification as old
     */
    public function markAsOld()
    {
        Auth::user()->notifications()->update(['new'=> 0]);
    }

    /**
     * Loads more records
     */
    public function seeMore()
    {
        $this->recordsPerPage += 5;
    }
}
