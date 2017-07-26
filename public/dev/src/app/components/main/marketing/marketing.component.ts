import {Component, OnInit} from '@angular/core';

import {HttpClientService} from '../../../services/httpClient.service';
import {DateHelperService} from '../../../services/helpers/date.helper';
import {ToastrHelperService} from '../../../services/helpers/toastr.helper';
import {DomHelperService} from '../../../services/helpers/dom.helper';

import {ConfirmationService} from 'primeng/primeng';
import {Message} from 'primeng/primeng';

@Component({
    templateUrl: './marketing.component.html',
    providers: [ConfirmationService]
})
export class MarketingComponent implements OnInit {

    customer: any;
    item: any;
    user: any;

    customers = [
        {"name": "Afghanistan", "code": "AF"},
        {"name": "Åland Islands", "code": "AX"},
        {"name": "Albania", "code": "AL"},
        {"name": "Algeria", "code": "DZ"},
        {"name": "American Samoa", "code": "AS"},
        {"name": "Andorra", "code": "AD"},
        {"name": "Angola", "code": "AO"},
    ];
    items = [
        {"name": "Afghanistan", "code": "AF"},
        {"name": "Åland Islands", "code": "AX"},
        {"name": "Albania", "code": "AL"},
        {"name": "Algeria", "code": "DZ"},
        {"name": "American Samoa", "code": "AS"},
        {"name": "Andorra", "code": "AD"},
        {"name": "Angola", "code": "AO"},
    ];
    users = [
        {"name": "Afghanistan", "code": "AF"},
        {"name": "Åland Islands", "code": "AX"},
        {"name": "Albania", "code": "AL"},
        {"name": "Algeria", "code": "DZ"},
        {"name": "American Samoa", "code": "AS"},
        {"name": "Andorra", "code": "AD"},
        {"name": "Angola", "code": "AO"},
    ];

    filteredCustomers: any[] = [];
    filteredItems: any[] = [];
    filteredUsers: any[] = [];

    marketings: any[] = [
        {
            date: '16/06/2017',
            customer_name: 'KASSANDRA WILDES',
            item_name: '3D Acrylic Nail Art Full Set',
            user_name: 'Eva',
            quantum: 1,
            total_price: 20,
            total_commission: 3
        },
        {
            date: '16/06/2017',
            customer_name: 'KATHERINE R FORD',
            item_name: 'Abs And Chest',
            user_name: 'Lee',
            quantum: 1,
            total_price: 45,
            total_commission: 6
        }
    ];
    title: string;
    isEdit: boolean;

    ngOnInit() {
        this.title = 'Marketing';
    }

    constructor(private confirmationService: ConfirmationService) {}

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

    // Customer
    filterCustomer(event) {
        let query = event.query;
        this.filteredCustomers = this.searchCustomer(query, this.customers);
    }

    searchCustomer(query, customers: any[]):any[] {
        //in a real application, make a request to a remote url with the query and return filtered results, for demo we filter at client side
        let filtered : any[] = [];
        for(let i = 0; i < customers.length; i++) {
            let customer = customers[i];
            if(customer.name.toLowerCase().indexOf(query.toLowerCase()) == 0) {
                filtered.push(customer);
            }
        }
        return filtered;
    }

    handleACDropdownClickCustomer() {
        this.filteredCustomers = [];

        //mimic remote call
        setTimeout(() => {
            this.filteredCustomers = this.customers;
        }, 100)
    }

    // Item
    filterItem(event) {
        let query = event.query;
        this.filteredItems = this.searchItem(query, this.items);
    }

    searchItem(query, items: any[]):any[] {
        //in a real application, make a request to a remote url with the query and return filtered results, for demo we filter at client side
        let filtered : any[] = [];
        for(let i = 0; i < items.length; i++) {
            let item = items[i];
            if(item.name.toLowerCase().indexOf(query.toLowerCase()) == 0) {
                filtered.push(item);
            }
        }
        return filtered;
    }

    handleACDropdownClickItem() {
        this.filteredItems = [];

        //mimic remote call
        setTimeout(() => {
            this.filteredItems = this.items;
        }, 100)
    }

    // User
    filterUser(event) {
        let query = event.query;
        this.filteredUsers = this.searchUser(query, this.users);
    }

    searchUser(query, users: any[]):any[] {
        //in a real application, make a request to a remote url with the query and return filtered results, for demo we filter at client side
        let filtered : any[] = [];
        for(let i = 0; i < users.length; i++) {
            let user = users[i];
            if(user.name.toLowerCase().indexOf(query.toLowerCase()) == 0) {
                filtered.push(user);
            }
        }
        return filtered;
    }

    handleACDropdownClickUser() {
        this.filteredUsers = [];

        //mimic remote call
        setTimeout(() => {
            this.filteredUsers = this.users;
        }, 100)
    }
}