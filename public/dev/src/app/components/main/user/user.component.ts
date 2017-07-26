import {Component, OnInit} from '@angular/core';

import {HttpClientService} from '../../../services/httpClient.service';
import {DateHelperService} from '../../../services/helpers/date.helper';
import {ToastrHelperService} from '../../../services/helpers/toastr.helper';
import {DomHelperService} from '../../../services/helpers/dom.helper';

import {SelectItem} from 'primeng/primeng';
import {ConfirmationService} from 'primeng/primeng';
import {Message} from 'primeng/primeng';

@Component({
    templateUrl: './user.component.html',
    providers: [ConfirmationService]
})
export class UserComponent implements OnInit {

    title: string;
    isEdit: boolean;

    users: any[] = [
        {
            fullname: 'Eva',
            nickname: 'Eva',
            role_name: 'Employee',
            passcode: '',
            email: '',
        },
        {
            fullname: 'Hang T Pham',
            nickname: 'Hanna',
            role_name: 'Owner',
            passcode: '',
            email: '',
        },
        {
            fullname: 'Jimmy',
            nickname: 'Jimmy',
            role_name: 'Employee',
            passcode: '',
            email: '',
        },
        {
            fullname: 'Lee',
            nickname: 'Lee',
            role_name: 'Employee',
            passcode: '',
            email: '',
        },
        {
            fullname: 'Vicki',
            nickname: 'Vicki',
            role_name: 'Admin',
            passcode: '',
            email: '',
        },
    ];

    roles: SelectItem[] = [
        {label:'Select Role', value:0},
        {label:'Owner', value:{id:1, name: 'Owner'}},
        {label:'Employee', value:{id:1, name: 'Employee'}},
        {label:'Admin', value:{id:1, name: 'Admin'}}
    ];

    constructor(private confirmationService: ConfirmationService) {}

    ngOnInit() {
        this.title = 'Employees';
    }

    displayEditBtn(status: boolean): void {
        this.isEdit = status;
    }

    /** My Function **/
    public active_index_tabview: number = 0;
    msgs: Message[] = [];

    public myActionCrud(mode): void {
        switch (mode) {
            case 'ADD':
                this.displayEditBtn(false);
                this.active_index_tabview = 1;
                break;
            case 'EDIT':
                this.displayEditBtn(true);
                this.active_index_tabview = 1;
                break;
            case 'DELETE':
                this.confirmDelete();
                break;
            default:
                break;
        }
    }

    public changeTabpanel(event: any): void {
        this.active_index_tabview = event.index;
    }

    private confirmDelete(): void {
        this.confirmationService.confirm({
            message: 'Are you sure to perform this action?'
        });
    }

    public showMessage(mode: string): void {
        this.msgs = [];
        this.msgs.push({severity:mode, summary:'Info Message', detail:'PrimeNG rocks'});
    }

    public onRowSelect(event: any): void {
        console.log(event);
        console.log(event.data);
    }

    clearOne(): void {

    }
}