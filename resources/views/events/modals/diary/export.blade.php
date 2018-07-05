<div data-type="modal-template" data-id="export">
    <div class="modal-header">
        <h1>Export Events Diary</h1>
    </div>
    <div class="modal-body">
        {!! Form::open(['class' => 'export']) !!}
        <div class="input-group">
            <input class="form-control export-url"
                   data-base-url="{{ route('event.export') }}"
                   id="export_url"
                   name="export_url"
                   value="{{ route('event.export') }}"
                   readonly>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" data-clipboard-target="#export_url" title="Copy to clipboard" type="button">
                    <span class="fa fa-clipboard"></span>
                </button>
            </div>
        </div>
        @if(Auth::check() && Auth::user()->hasExportToken())
            <div class="customise-export">
                <div>
                    Show:
                </div>
                <div class="inputs">
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" id="event-type--event" name="event_types" type="checkbox" value="event" checked disabled>
                            <label class="form-check-label" for="event-type--event">Events</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" id="event-type--training" name="event_types" type="checkbox" value="training">
                            <label class="form-check-label" for="event-type--training">Training</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" id="event-type--social" name="event_types" type="checkbox" value="social">
                            <label class="form-check-label" for="event-type--social">Socials</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" id="event-type--meeting" name="event_types" type="checkbox" value="meeting">
                            <label class="form-check-label" for="event-type--meeting">Meetings</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="crewing" id="event-crewing--false" type="radio" value="*" checked>
                            <label class="form-check-label" for="event-crewing--false">Show all events</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="crewing" id="event-crewing--true" type="radio" value="true">
                            <label class="form-check-label" for="event-crewing--true">Only show events I'm crewing</label>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p class="form-text">To customise which events are exported, please enable this in {!! link_to_route('member.profile', 'your profile') !!}.</p>
        @endif
        <h2>Importing to Google Calendar:</h2>
        <ol>
            <li>Open <a href="http://calendar.google.com/" target="_blank">Google Calendar</a></li>
            <li>Go to the <strong>Other Calendars</strong> menu on the left-hand side and click the down arrow</li>
            <li>Choose <strong>Add by URL</strong></li>
            <li>Enter the URL above into the pop-up box</li>
            <li>Click <strong>Add Calendar</strong></li>
        </ol>
        <p class="form-text"><strong>Please note:</strong> The frequency of calendar updates is determined by Google and cannot be
            configured.</p>
        {!! Form::close() !!}
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" data-toggle="modal" data-target="#modal" type="button">
            <span class="fa fa-thumbs-up"></span>
            <span>Ok, got it</span>
        </button>
    </div>
</div>