{!! Form::open(['id' => 'DiaryPreferences']) !!}
<h2>Event Types:</h2>
<div class="form-group">
    <div class="form-check">
        {!! Form::checkbox('event_types[]', 'event', Auth::user()->isDiaryPreference('event_types', 'event'), ['id' => 'pref-event-types--event']) !!}
        <label class="form-check-label" for="pref-event-types--event">Events</label>
    </div>
    <div class="form-check">
        {!! Form::checkbox('event_types[]', 'training', Auth::user()->isDiaryPreference('event_types', 'training'), ['id' => 'pref-event-types--training']) !!}
        <label class="form-check-label" for="pref-event-types--training">Training Sessions</label>
    </div>
    <div class="form-check">
        {!! Form::checkbox('event_types[]', 'social', Auth::user()->isDiaryPreference('event_types', 'social'), ['id' => 'pref-event-types--social']) !!}
        <label class="form-check-label" for="pref-event-types--social">Socials</label>
    </div>
    <div class="form-check">
        {!! Form::checkbox('event_types[]', 'meeting', Auth::user()->isDiaryPreference('event_types', 'meeting'), ['id' => 'pref-event-types--meeting']) !!}
        <label class="form-check-label" for="pref-event-types--meeting">Meetings</label>
    </div>
    <div class="form-check">
        {!! Form::checkbox('event_types[]', 'hidden', Auth::user()->isDiaryPreference('event_types', 'hidden'), ['id' => 'pref-event-types--hidden']) !!}
        <label class="form-check-label" for="pref-event-types--hidden">Hidden / General Info</label>
    </div>
</div>
<h2>Show:</h2>
<div class="form-group">
    <div class="form-check">
        {!! Form::radio('crewing', '*', Auth::user()->isDiaryPreference('crewing', '*'), ['id' => 'pref-crewing--all']) !!}
        <label class="form-check-label" for="pref-crewing--all">All events</label>
    </div>
    <div class="form-check">
        {!! Form::radio('crewing', 'true', Auth::user()->isDiaryPreference('crewing', 'true'), ['id' => 'pref-crewing--crew']) !!}
        <label class="form-check-label" for="pref-crewing--crew">Events I'm crewing</label>
    </div>
</div>
<button class="btn btn-success"
        data-update-url="{{ route('member.update') }}"
        id="DiaryPreferences-save">
    <span>Save Preferences</span>
</button>
{!! Form::input('hidden', 'update', 'diary-preferences') !!}
{!! Form::close() !!}