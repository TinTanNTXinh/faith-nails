import {Component, OnInit} from '@angular/core';

import {HttpClientService} from '../../../services/httpClient.service';
import {DateHelperService} from '../../../services/helpers/date.helper';
import {ToastrHelperService} from '../../../services/helpers/toastr.helper';
import {DomHelperService} from '../../../services/helpers/dom.helper';

import {ConfirmationService} from 'primeng/primeng';
import {Message} from 'primeng/primeng';
import {FormBuilder, FormGroup, Validators} from '@angular/forms'
import {isSuccess} from "@angular/http/src/http_utils";

@Component({
    templateUrl: './customer.component.html',
    providers: [ConfirmationService]
})
export class CustomerComponent implements OnInit,
    ICommon, ICrud, IUtil, IForm {


    /** My Variables **/
    public msgs: Message[] = [];
    public oneFormGroup: FormGroup;
    public customers: any[] = [];
    public positions_search: any[] = [];
    selectedRow: any;
    /** ICommon **/
    title: string;
    placeholder_code: string;
    prefix_url: string;
    active_index_tabview: number = 0;

    /** ICrud **/
    isEdit: boolean;

    /** ISearch **/
    filtering: any;
    public position_ac: any;


    constructor(private formBuilder: FormBuilder
        , private httpClientService: HttpClientService
        , private dateHelperService: DateHelperService
        , private confirmationService: ConfirmationService) {
        this.createForm();
    }

    ngOnInit() {
        this.title = 'Customers';
        this.prefix_url = 'customers';
        this.refreshData();
    }

    refreshData() {
        this.loadData();
    }

    loadData(): void {
        this.httpClientService.get(this.prefix_url).subscribe(
            (success: any) => {
                this.reloadData(success)
            },
            (error: any) => {
                this.showMessage('error', 'Notification', 'Failed!');
            }
        )
    }

    reloadData(arr_data: any[]): void {
        this.customers = arr_data['customers'];
    }

    showMessage(severity: string, summary: string, detail: string): void {
        this.msgs = [];
        this.msgs.push({severity: severity, summary: summary, detail: detail});
    }

    createForm() {
        this.oneFormGroup = this.formBuilder.group({
            id: 0,
            first_name: ['', Validators.required],
            last_name: ['', Validators.required],
            phone: ['', Validators.required],
            company: '',
            email: '',
            street_address_line_1: '',
            street_address_line_2: '',
            street_address_line_3: '',
            city: '',
            state: '',
            zip: '',
            birthday: null,
            note: '',
        });
    }

    displayEditBtn(status: boolean): void {
        this.isEdit = status;
    }

    /** My Function **/

    public actionCrud(mode): void {
        switch (mode) {
            case 'ADD':
                this.clearOne();
                this.displayEditBtn(false);
                this.active_index_tabview = 1;
                break;
            case 'EDIT':
                if (typeof this.selectedRow == "undefined" || this.selectedRow == null) {
                    this.showMessage('warn', 'Warn', 'Please choose a row!');
                    return;
                }
                this.loadOne(this.selectedRow.id);
                this.displayEditBtn(true);
                this.active_index_tabview = 1;
                break;
            case 'DELETE':
                if (typeof this.selectedRow == "undefined" || this.selectedRow == null) {
                    this.showMessage('warn', 'Warn', 'Please choose a row!');
                    return;
                }
                this.confirmDeactivateOne(this.selectedRow.id);
                break;
            default:
                break;
        }
    }

    confirmDeactivateOne(id: number): void {
        this.confirmationService.confirm({
            message: 'Are you sure to delete this customer?',
            header: 'Confirmation',
            icon: 'fa fa-question-circle',
            accept: () => {
                this.deactivateOne(id);
            },
            reject: () => {
            }
        });
    }

    deactivateOne(id: number): void {
        this.httpClientService.patch(this.prefix_url, {"id": id}).subscribe(
            (success: any) => {
                this.reloadData(success);
                this.showMessage('success', 'Notification', 'Deactivated!');
                this.clearSelectedRow();
            },
            (error: any) => {
                this.showMessage('error', 'Notification', 'Failed!');
            }
        );
    }

    clearSelectedRow(): void {
        this.selectedRow = null;
    }

    loadOne(id: number): void {
        let customer = this.customers.find(o => o.id == id);
        this.oneFormGroup.setValue({
            id: customer.id,
            first_name: customer.first_name,
            last_name: customer.last_name,
            phone: customer.phone,
            company: customer.company,
            email: customer.email,
            street_address_line_1: customer.street_address_line_1,
            street_address_line_2: customer.street_address_line_2,
            street_address_line_3: customer.street_address_line_3,
            city: customer.city,
            state: customer.state,
            zip: customer.zip,
            birthday: new Date(customer.birthday),
            note: customer.note
        });
    }

    public changeTabPanel(event: any): void {
        this.active_index_tabview = event.index;
    }


    onRowSelect(event: any): void {
        this.selectedRow = event.data;
    }

    clearOne(): void {
        this.oneFormGroup.reset({
            id: 0,
            first_name: '',
            last_name: '',
            phone: '',
            company: '',
            email: '',
            street_address_line_1: '',
            street_address_line_2: '',
            street_address_line_3: '',
            city: '',
            state: '',
            zip: '',
            birthday: '',
            note: ''
        });
    }
    addOne(): void {
        if (!this.validateOne()) return;
        this.httpClientService.post(this.prefix_url, { "customer": this.oneFormGroup.value }).subscribe(
            (success: any) => {
                this.reloadData(success);
                this.clearOne();
                this.showMessage('success', 'Notification', 'Added!');
            },
            (error: any) => {
                this.showMessage('error', 'Notification', 'Failed!');
            }
        );
    }

    updateOne(): void {
        if (!this.validateOne()) return;
        this.httpClientService.put(this.prefix_url, { "customer": this.oneFormGroup.value }).subscribe(
            (success: any) => {
                this.reloadData(success);
                this.clearOne();
                this.displayEditBtn(false);
                this.showMessage('success', 'Notification', 'Updated!');
            },
            (error: any) => {
                this.showMessage('error', 'Notification', 'Failed!');
            }
        );
    }

    deleteOne(id: number): void {
    }

    validateOne(): boolean {
        let flag: boolean = true;
        if (this.oneFormGroup.get('first_name').value == '') {
            flag = false;
            this.showMessage('warn', 'Warning', `First name not empty.`);
        }

        return flag;
    }


}