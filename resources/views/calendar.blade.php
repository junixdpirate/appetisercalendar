<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Appetiser Calendar Demo</title>
        
        <link href="/css/app.css" rel="stylesheet">

        <style>
            body {
                background-color: #0093E9;
                background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);

            }

            .ac-panel {
                border-radius: 4px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                background-color:white;
                padding:2rem;
            }

            .date-entry {
                border-bottom:1px dotted grey;
            }

            .date-entry.selected {
                background-color:green;
                color:white;
            }
        </style>

    </head>
    <body>
        

        <div class="container" id="calendarapp">

            <div class="row">
                <div class="col-12 col-md-5 p-4">

                    <div class="ac-panel">

                        <h3>Event Form</h3>

                        <hr />

                        <form v-on:submit.prevent="formSubmit" method="post">
                        <div class="form-group">
                            <label>Event</label>
                            <input type="text" class="form-control" v-model="eventdata.event" v-on:change="updateCalendarEvents" />
                        </div>

                        <div class="row form-group">
                            <div class="col">
                                <label>From:</label>
                                <input type="date" class="form-control" v-model="eventdata.dateFrom" v-on:change="updateCalendarEvents" placeholder="Date From">
                            </div>
                            <div class="col">
                                <label>To:</label>
                                <input type="date" class="form-control" v-model="eventdata.dateTo" v-on:change="updateCalendarEvents" placeholder="Date To">
                            </div>
                        </div>

                        <div class="form-group">

                            <div v-for="weekday in weekdays" class="form-check form-check-inline">
                                <input class="form-check-input" v-on:change="updateCalendarEvents" v-model="eventdata.weekdays" type="checkbox" v-bind:id="`weekday-` + weekday.day" v-bind:value="weekday.day">
                                <label class="form-check-label" v-bind:for="`weekday-` + weekday.day">@{{weekday.title}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Save</button>
                        </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-7 p-4">
                    <div class="ac-panel">
                        <div class="d-flex justify-content-between">
                            <h3>Events</h3>
                            <h3>@{{dateRange}}</h3>
                        </div>
                        <hr />

                        <div  class="calendar-events">
                            <event v-for="calendarevent in calendarEvents" v-bind:key="calendarevent.eventid" v-bind:calendarevent="calendarevent"></event>                            
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>

        
        <div class="modal dialog-alert fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Calendar Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="message"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>


        <script src="/js/app.js"></script>
        
        <script src="/js/calendarapp.js"></script>
        
    </body>
</html>