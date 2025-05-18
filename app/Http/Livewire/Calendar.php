<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class Calendar extends Component
{
    public $events = '';

    public function getevent()
    {
        $events = Event::select('id', 'title', 'start')->get();
        return json_encode($events);
    }

    public function addevent($event)
    {
        $input['title'] = $event['title'];
        $input['start'] = $event['start'];
        Event::create($input);
        $this->emit('refreshCalendar');
    }

    public function eventDrop($event, $oldEvent)
    {
        $eventdata = Event::find($event['id']);
        if ($eventdata) {
            $eventdata->start = $event['start'];
            $eventdata->save();
            $this->emit('refreshCalendar');
        }
    }

    public function deleteEvent($eventId)
    {
        $event = Event::find($eventId);
        if ($event) {
            $event->delete();
            $this->emit('refreshCalendar');
        }
    }

    public function render()
    {
        $events = Event::select('id', 'title', 'start')->get();
        $this->events = json_encode($events);
        return view('livewire.calendar');
    }
}