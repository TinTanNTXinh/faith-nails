import { Component, OnInit } from '@angular/core';

import { HttpClientService } from '../../../services/httpClient.service';
import { DateHelperService } from '../../../services/helpers/date.helper';

import { ConfirmationService } from 'primeng/primeng';
import { Message } from 'primeng/primeng';

import { FormBuilder, FormGroup, Validators } from '@angular/forms'

@Component({
    templateUrl: './category.component.html',
    providers: [ConfirmationService]
})
export class CategoryComponent implements OnInit
    , ICommon, ICrud, ISearch, IUtil {

    /** My Variables **/
    public msgs: Message[] = [];
    public oneFormGroup: FormGroup;
    public categories: any[] = [];
    public categories_search: any[] = [];

    /** ICommon **/
    title: string;
    placeholder_code: string;
    prefix_url: string;
    active_index_tabview: number = 0;

    /** ICrud **/
    isEdit: boolean;

    /** ISearch **/
    filtering: any;
    public category_ac: any;
    constructor(private fb: FormBuilder
        , private httpClientService: HttpClientService
        , private dateHelperService: DateHelperService
        , private confirmationService: ConfirmationService) {
        this.createForm();
    }

    ngOnInit(): void {
        this.title = 'Categories';
        this.prefix_url = 'categories';
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
        // this.categories = [];
        this.categories = arr_data['categories'];
        this.categories_search = arr_data['categories'];
        this.placeholder_code = arr_data['placeholder_code'];
    }

    refreshData(): void {
        this.clearOne();
        this.clearSearch();
        this.loadData();
    }

    /** ICrud **/
    loadOne(id: number): void {
        let category = this.categories.find(o => o.id == id);
        this.oneFormGroup.setValue({
            id: category.id,
            code: category.code,
            name: category.name,
            description: category.description
        });
    }

    clearOne(): void {
        this.oneFormGroup.reset({
            id: 0,
            code: '',
            name: '',
            description: ''
        });
    }

    addOne(): void {
        if (!this.validateOne()) return;
        this.httpClientService.post(this.prefix_url, { "category": this.oneFormGroup.value }).subscribe(
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

        this.httpClientService.put(this.prefix_url, { "category": this.oneFormGroup.value }).subscribe(
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
                this.search();
                this.showMessage('success', 'Notification', 'Deactivated!');
                this.clearSelectedRow();
            },
            (error: any) => {
                this.showMessage('error', 'Notification', 'Failed!');
            }
        );
    }

    deleteOne(id: number): void {
        this.httpClientService.delete(`${this.prefix_url}/${id}`).subscribe(
            (success: any) => {
                this.reloadData(success);
                this.showMessage('success', 'Notification', 'Deleted!');
                this.clearSelectedRow();
            },
            (error: any) => {
                this.showMessage('error', 'Notification', 'Failed!');
            }
        );
    }

    confirmDeactivateOne(id: number): void {
        this.confirmationService.confirm({
            message: 'Are you sure to delete this category?',
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
            this.showMessage('warn', 'Warning', `Tên ${this.title} không được để trống.`);
        }
        return flag;
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

    /** ISearch **/
    search(): void {
        this.filtering.category_id= this.category_ac ? this.category_ac.id : 0;
        this.httpClientService.get(`${this.prefix_url}/search?query=${JSON.stringify(this.filtering)}`).subscribe(
            (success: any) => {
                this.reloadDataSearch(success);
            },
            (error: any) => {
                this.showMessage('error', 'Notification', 'Failed!');
            }
        );
    }

    reloadDataSearch(arr_data: any[]): void {
         this.categories = arr_data['categories'];
    }

    clearSearch(): void {
        this.filtering = {
            from_date: '',
            to_date: '',
            range: '',
            category_id: 0
        };
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

    /** IForm **/
    selectedRow: any;

    createForm(): void {
        this.oneFormGroup = this.fb.group({
            id: 0,
            code: '',
            name: ['', Validators.required],
            description: ''
        });
    }

    clearSelectedRow(): void {
        this.selectedRow = null;
    }

    /** MY FUNCTION **/
    private filterdCategories: any[] = [];

    public searchCategory(event: any): void {
        let query = event.query;
        // this.filterdCategories = this.categories_search.filter(function (o) {
        //     return o.name.toLowerCase().indexOf(query.toLowerCase()) > -1;
        // });
        this.filterdCategories = this.categories_search.filter(o => o.name.toLowerCase().indexOf(query.toLowerCase()) > -1);
    }

    public handleDropdownClickCategory(event: any): void {
        this.filterdCategories = [];

        setTimeout(() => {
            this.filterdCategories = this.categories;
        }, 100);
    }

}