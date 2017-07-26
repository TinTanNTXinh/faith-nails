import {Component, OnInit} from '@angular/core';

import {HttpClientService} from '../../../services/httpClient.service';
import {DateHelperService} from '../../../services/helpers/date.helper';

import {ConfirmationService} from 'primeng/primeng';
import {Message} from 'primeng/primeng';
import {FormBuilder, FormGroup, Validators} from '@angular/forms'
@Component({
    templateUrl: './item.component.html',
    providers: [ConfirmationService]
})
export class ItemComponent implements OnInit,
    ICommon, ICrud,IUtil,IForm {


    public msgs: Message[] = [];
    public oneFormGroup: FormGroup;
    public items: any[] = [];
    public categories_auto: any[] = [];
    public active_index_tabview: number = 0;
    private filterdCategories: any[] = [];
    /** ICommon **/
    title: string;
    placeholder_code: string;
    prefix_url: string;

    /** ICrud **/
    isEdit: boolean;

    /** ISearch **/
    filtering: any;


    constructor(private formBuilder: FormBuilder
        , private httpClientService: HttpClientService
        , private dateHelperService: DateHelperService
        , private confirmationService: ConfirmationService) {
        this.createForm();
    }
    ngOnInit() {
        this.title = 'Items';
        this.prefix_url = 'items';
        this.refreshData();
    }



    /** ICommon **/
    loadData(): void {
        this.httpClientService.get(this.prefix_url).subscribe(
            (success: any) => {
                this.reloadData(success);
            },
            (error: any) => {
                this.showMessage('error', 'Notification', 'Failed!');
            }
        );
    }

    reloadData(arr_data: any[]): void {
        this.items = arr_data['items'];
        this.categories_auto = arr_data['categories'];
        this.placeholder_code = arr_data['placeholder_code'];
    }

    refreshData(): void {
        this.clearOne();
        // this.clearSearch();
        this.loadData();
    }

    /** IForm **/
    selectedRow:any;
    createForm(): void {
        this.oneFormGroup = this.formBuilder.group({
            id: 0,
            category: null,
            name: ['', Validators.required],
            product_code: '',
            sku: '',
            price: 0,
            commission: 0,
            note:''
        });
    }
    clearSelectedRow(): void {
        this.selectedRow = null;
    }
    /** ICrud **/

    clearOne(): void {
        this.oneFormGroup.reset({
            id: 0,
            category: '',
            name: '',
            product_code: '',
            sku: '',
            price: 0,
            commission: 0,
            note:''
        });
    }
    displayEditBtn(status: boolean): void {
        this.isEdit = status;
    }

    actionCrud(mode: string): void {
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

    loadOne(id: number): void {
        let item = this.items.find(o => o.id == id);
        let category = this.categories_auto.find(o => o.id == item.category_id);
        this.oneFormGroup.setValue({
            id: item.id,
            name: item.name,
            category:category,
            product_code:item.product_code,
            sku:item.sku,
            price:item.price,
            commission:item.commission,
            note: item.note
        });
    }

    addOne(): void {
        if (!this.validateOne()) return;
        this.httpClientService.post(this.prefix_url, { "item": this.oneFormGroup.value }).subscribe(
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
        this.httpClientService.put(this.prefix_url, { "item": this.oneFormGroup.value }).subscribe(
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

    deactivateOne(id: number): void {
        this.httpClientService.patch(this.prefix_url, { "id": id }).subscribe(
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
    deleteOne(id: number): void {
    }

    confirmDeactivateOne(id: number): void {
        this.confirmationService.confirm({
            message: 'Are you sure to delete this item?',
            header: 'Confirmation',
            icon: 'fa fa-question-circle',
            accept: () => {
                this.deactivateOne(id);
            },
            reject: () => {

            }
        });
    }

    validateOne(): boolean {
        let flag: boolean = true;
        if (this.oneFormGroup.get('name').value == '') {
            flag = false;
            this.showMessage('warn', 'Warning', `${this.title} name not empty.`);
        }
        if(this.oneFormGroup.get('category').value == null || typeof this.oneFormGroup.get('category').value != 'object' ){
            flag = false;
            this.showMessage('warn','Warning','Please choose a Category');
        }

        return flag;
    }

    /** IUtil **/
    changeTabPanel(event: any): void {
        this.active_index_tabview = event.index;
    }


    showMessage(severity: string, summary: string, detail: string): void {
        this.msgs = [];
        this.msgs.push({ severity: severity, summary: summary, detail: detail });
    }

    onRowSelect(event: any): void {
        this.selectedRow = event.data;
    }
    public autoCategory(event: any): void {
        let query = event.query;
        this.filterdCategories = this.categories_auto.filter(o => o.name.toLowerCase().indexOf(query.toLowerCase()) > -1);
    }

    public handleDropdownClickCategory(event: any): void {
        this.filterdCategories = [];

        setTimeout(() => {
            this.filterdCategories = this.categories_auto;
        }, 100);
    }
}