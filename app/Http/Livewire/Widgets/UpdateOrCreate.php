<?php

namespace App\Http\Livewire\Widgets;

use App\Models\CallWidget;
use App\Rules\Domain;
use Livewire\Component;

class UpdateOrCreate extends Component
{
    public $state;

    /**
     * @var CallWidget
     */
    public $model;

    public $positionCode;

    public $buttonScript;

    public function mount()
    {
        $this->buttonScript = $this->minimizeJavascript($this->buttonScript);

        if(!$this->model){
            $this->state = [
                'id'=> null,
                'identifier'=> \Str::uuid(),
                'call_center_number'=> '',
                'domains'=> ['']
            ];

        } else {
            $this->state = $this->model->toArray();
        }

        $this->populateWidgetCode();
    }

    public function populateWidgetCode()
    {
        $this->positionCode = '<div id="click-to-call-frame"></div>';
        $clickToCallUrl =  route('click-to-call');
        $identifier = $this->state['identifier'];
        $this->buttonScript = "
        <script>
            (function (){
                let iframe = document.createElement('iframe');
                const urlParams = new URLSearchParams(window.location.search);
                let phoneNumber = urlParams.get('phone_number')
                iframe.src = '$clickToCallUrl?phone_number=' + phoneNumber + '&identifier=$identifier';
                iframe.setAttribute('frameborder', '0');
                iframe.height = '70';
                iframe.width = '250';
                document.getElementById('click-to-call-frame').appendChild(iframe);
            }())
        </script>
        ";
    }

    public function render()
    {
        return view('widgets.update-or-create');
    }

    public function addDomain()
    {
        $this->state['domains'][] = '';
    }

    public function removeDomain($index)
    {
        unset($this->state['domains'][$index]);
        array_unshift($this->state['domains']);
    }

    public function submit()
    {
        \Validator::make($this->state, [
            'call_center_number'=> 'required',
            'domains.*'=> ['required', new Domain()]
        ])->validate();

        $this->model = CallWidget::updateOrCreate(['identifier' => $this->state['identifier']], $this->state);

        $this->dispatchBrowserEvent(SUCCESS, 'Saved Successfully');
    }

    public function minimizeJavascript($javascript){
        return preg_replace(array("/\s+\n/", "/\n\s+/", "/ +/"), array("\n", "\n ", " "), $javascript);
    }
}
