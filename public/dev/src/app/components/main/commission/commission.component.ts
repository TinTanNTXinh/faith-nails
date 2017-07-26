import {Component, OnInit} from '@angular/core';

import {HttpClientService} from '../../../services/httpClient.service';
import {DateHelperService} from '../../../services/helpers/date.helper';
import {ToastrHelperService} from '../../../services/helpers/toastr.helper';
import {DomHelperService} from '../../../services/helpers/dom.helper';

import {ConfirmationService} from 'primeng/primeng';
import {Message} from 'primeng/primeng';

@Component({
    templateUrl: './commission.component.html',
    providers: [ConfirmationService]
})
export class CommissionComponent implements OnInit {

    title: string;
    isEdit: boolean;

    commissions: any[] = [
        {
            date: '16/06/2017',
            customer_name: 'KASSANDRA WILDES',
            item_name: '3D Acrylic Nail Art Full Set',
            money: '3'
        },
        {
            date: '16/06/2017',
            customer_name: 'KATHERINE R FORD',
            item_name: 'Abs and Chest',
            money: '6'
        }
    ];

    constructor(private confirmationService: ConfirmationService) {}

    ngOnInit() {
        this.title = 'Commissions';
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