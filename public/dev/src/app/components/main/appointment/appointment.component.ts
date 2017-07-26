import {ChangeDetectorRef, Component, OnInit} from '@angular/core';

import {HttpClientService} from '../../../services/httpClient.service';
import {DateHelperService} from '../../../services/helpers/date.helper';
import {ToastrHelperService} from '../../../services/helpers/toastr.helper';
import {DomHelperService} from '../../../services/helpers/dom.helper';

import {ConfirmationService} from 'primeng/primeng';
import {Message} from 'primeng/primeng';

@Component({
    templateUrl: './appointment.component.html',
    providers: [ConfirmationService]
})
export class AppointmentComponent implements OnInit {

    title: string;

    events: any[];

    header: any;

    event: MyEvent;

    dialogVisible: boolean = false;

    idGen: number = 100;

    constructor(private cd: ChangeDetectorRef) { }

    ngOnInit() {
        this.title = 'Appointment';

        this.events = [
            {
                "id": 1,
                "title": "All Day Event",
                "start": "2016-01-01"
            },
            {
                "id": 2,
                "title": "Long Event",
                "start": "2016-01-07",
                "end": "2016-01-10"
            },
            {
                "id": 3,
                "title": "Repeating Event",
                "start": "2016-01-09T16:00:00"
            },
            {
                "id": 4,
                "title": "Repeating Event",
                "start": "2016-01-16T16:00:00"
            },
            {
                "id": 5,
                "title": "Conference",
                "start": "2016-01-11",
                "end": "2016-01-13"
            },
            {
                "id": 6,
                "title": "Meeting",
                "start": "2016-01-12T10:30:00",
                "end": "2016-01-12T12:30:00"
            },
            {
                "id": 7,
                "title": "Lunch",
                "start": "2016-01-12T12:00:00"
            },
            {
                "id": 8,
                "title": "Meeting",
                "start": "2016-01-12T14:30:00"
            },
            {
                "id": 9,
                "title": "Happy Hour",
                "start": "2016-01-12T17:30:00"
            },
            {
                "id": 10,
                "title": "Dinner",
                "start": "2016-01-12T20:00:00"
            },
            {
                "id": 11,
                "title": "Birthday Party",
                "start": "2016-01-13T07:00:00"
            },
            {
                "id": 12,
                "title": "Click for Google",
                "url": "http://google.com/",
                "start": "2016-01-28"
            }
        ];

        this.header = {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        };
    }

    /** My Function **/
    public active_index_tabview: number = 0;
    msgs: Message[] = [];

    public changeTabpanel(event: any): void {
        this.active_index_tabview = event.index;
    }

    public showMessage(mode: string): void {
        this.msgs = [];
        this.msgs.push({severity:mode, summary:'Info Message', detail:'PrimeNG rocks'});
    }

    handleDayClick(event) {
        this.event = new MyEvent();
        this.event.start = event.date.format();
        this.dialogVisible = true;

        //trigger detection manually as somehow only moving the mouse quickly after click triggers the automatic detection
        this.cd.detectChanges();
    }

    handleEventClick(e) {
        this.event = new MyEvent();
        this.event.title = e.calEvent.title;

        let start = e.calEvent.start;
        let end = e.calEvent.end;
        if(e.view.name === 'month') {
            start.stripTime();
        }

        if(end) {
            end.stripTime();
            this.event.end = end.format();
        }

        this.event.id = e.calEvent.id;
        this.event.start = start.format();
        this.event.allDay = e.calEvent.allDay;
        this.dialogVisible = true;
    }

    saveEvent() {
        //update
        if(this.event.id) {
            let index: number = this.findEventIndexById(this.event.id);
            if(index >= 0) {
                this.events[index] = this.event;
            }
        }
        //new
        else {
            this.event.id = this.idGen++;
            this.events.push(this.event);
            this.event = null;
        }

        this.dialogVisible = false;
    }

    deleteEvent() {
        let index: number = this.findEventIndexById(this.event.id);
        if(index >= 0) {
            this.events.splice(index, 1);
        }
        this.dialogVisible = false;
    }

    findEventIndexById(id: number) {
        let index = -1;
        for(let i = 0; i < this.events.length; i++) {
            if(id == this.events[i].id) {
                index = i;
                break;
            }
        }

        return index;
    }
}

export class MyEvent {
    id: number;
    title: string;
    start: string;
    end: string;
    allDay: boolean = true;
    customer_id: number;
    item_id: number;
    quantum: number;
}