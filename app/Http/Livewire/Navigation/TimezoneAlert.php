<?php


namespace App\Http\Livewire\Navigation;


use App\Models\Timezone;
use Livewire\Component;

class TimezoneAlert extends Component
{
    public $browserTimezone;

    public $databaseTimezone;

    public $sendBrowserTimezone;

    public $showPopup;

    public function render()
    {
        return view('navigation.timezone-alert');
    }

    public function mount()
    {
        if(!\Session::get('block-timezone-alert')){
            $this->sendBrowserTimezone = true;
            $this->databaseTimezone = \Auth::user()->timezone->name;
        }
    }

    public function updatedBrowserTimezone($value)
    {
        $currentTimezoneId = Timezone::whereName($value)->value('id');
        if ($currentTimezoneId && ($currentTimezoneId !== \Auth::user()->timezone_id)) {
            $this->showPopup = true;
        }
    }

    public function hidePopup()
    {
        \Session::put('block-timezone-alert', true);
        $this->showPopup = false;
    }

    public function updateTimezone()
    {
        \Auth::user()->update(['timezone_id' => Timezone::getTimezoneId($this->browserTimezone)]);
        $this->hidePopup();
        $this->dispatchBrowserEvent(SUCCESS, 'Timezone changed to '.$this->browserTimezone);
    }
}
