
const monthNames = ["January", "February", "March", "April", "May", "June",
"July", "August", "September", "October", "November", "December"
];

function dialogAlert(message)
{
    $('.dialog-alert').find('.message').html(message);
    $('.dialog-alert').modal('show');
}

var EventComponent = {
    props : ['calendarevent'],
   
    template : `<div v-bind:class="{selected : calendarevent.selected}" class="date-entry d-flex">
                    <div class="p-2">{{calendarevent.date}}</div> 
                    <div class="flex-grow-1 p-2"><span v-if=calendarevent.selected>{{calendarevent.event}}</span></div> 
                </div>`
};


var calendarApp = new Vue({
    el : '#calendarapp',
    data : {

        eventdata : {
            event : "",
            dateFrom : "",
            dateTo : "",
            weekdays : []
        },

        weekdays : [
            { 
                day : 1,
                title : 'Mon'
            },
            { 
                day : 2,
                title : 'Tue'
            },
            { 
                day : 3,
                title : 'Wed'
            },
            { 
                day : 4,
                title : 'Thu'
            },
            { 
                day : 5,
                title : 'Fri'
            },
            { 
                day : 6,
                title : 'Sat'
            },
            { 
                day : 0,
                title : 'Sun'
            },
        ],

        calendarEvents : []
    },

    computed : {
        dateRange() {

            var objDateFrom;
            var objDateTo;
            var dateRange = "";

            if(this.eventdata.dateFrom.length > 0)
            {
                objDateFrom = new Date(this.eventdata.dateFrom);
            }

            if(this.eventdata.dateTo.length > 0)
            {
                objDateTo = new Date(this.eventdata.dateTo);
            }
            
            if(objDateFrom !== undefined && objDateTo !== undefined)
            {
                if(objDateFrom.getMonth() === objDateTo.getMonth())
                {
                    dateRange = monthNames[objDateFrom.getMonth()] + ' ' + objDateFrom.getFullYear();
                }
                else
                {
                    dateRange = monthNames[objDateFrom.getMonth()] + ' ' + objDateFrom.getFullYear() + ' - ' + monthNames[objDateTo.getMonth()] + ' ' + objDateTo.getFullYear();
                }
            }

            return dateRange;
        }
    },

    methods : {

        formSubmit()
        {

            axios
            .post( '/event/add', this.eventdata)
            .then(function(response) 
            {
               if(response.data.status === 'ok')
               {
                    dialogAlert('Calendar Event Saved!');
               }
               else
               {
                    dialogAlert('Opps! something went wrong. Please try again.');
               }

            })
            .catch(function(error)
            {			
                dialogAlert('Opps! something went wrong. Please try again.');
            });
        },

        isWeekdaySelected(day)
        {
            return this.eventdata.weekdays.includes(day);
        },

        hasCalendarEvents()
        {
            return this.calendarEvents.length > 0;
        },

        updateCalendarEvents()
        {
            var objDateFrom;
            var objDateTo;

            this.calendarEvents = [];

            if(this.eventdata.dateFrom.length > 0)
            {
                objDateFrom = new Date(this.eventdata.dateFrom);
            }

            if(this.eventdata.dateTo.length > 0)
            {
                objDateTo = new Date(this.eventdata.dateTo);
            }
            
            if(objDateFrom !== undefined && objDateTo !== undefined)
            {                                
                if(objDateFrom.getTime() <= objDateTo.getTime())
                {   
                    var id = 0;
                    while(objDateFrom.getTime() <= objDateTo.getTime())
                    {
                        
                        this.calendarEvents.push(
                            {
                                eventid : id, 
                                date : monthNames[objDateFrom.getMonth()] + ' ' + objDateFrom.getDate(),
                                event : this.eventdata.event,
                                selected : this.isWeekdaySelected(objDateFrom.getDay())
                            });

                            objDateFrom.setDate(objDateFrom.getDate()+1);
                            id++;
                    }
                }
                else
                {
                    this.calendarEvents = [];
                }
                                
            }
        }
    },

    mounted() {

        var objCurrentDate = new Date();
        var objLastDayDate = new Date(objCurrentDate.getFullYear(), objCurrentDate.getMonth() + 1, 0);

        this.eventdata.dateFrom = objCurrentDate.toISOString().substring(0, 7) + '-' + '01';
        this.eventdata.dateTo = objLastDayDate.toISOString().substring(0, 10);

        this.updateCalendarEvents();
    },
    components : {
        'event' : EventComponent,
    }

});