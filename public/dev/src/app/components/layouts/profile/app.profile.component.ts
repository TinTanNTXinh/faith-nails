import {Component,Input,OnInit,EventEmitter,ViewChild,trigger,state,transition,style,animate,Inject,forwardRef} from '@angular/core';
import {Location} from '@angular/common';
import {Router} from '@angular/router';
import {MenuItem} from 'primeng/primeng';

import {Subscription} from 'rxjs';

import {AuthenticationService} from '../../../services/authentication.service';
import {HttpClientService} from '../../../services/httpClient.service';
import {LoggingService} from '../../../services/logging.service';

@Component({
    selector: 'inline-profile',
    templateUrl: './app.profile.component.html',
    animations: [
        trigger('menu', [
            state('hidden', style({
                height: '0px'
            })),
            state('visible', style({
                height: '*'
            })),
            transition('visible => hidden', animate('400ms cubic-bezier(0.86, 0, 0.07, 1)')),
            transition('hidden => visible', animate('400ms cubic-bezier(0.86, 0, 0.07, 1)'))
        ])
    ]
})
export class InlineProfileComponent {

    /** MY VARIABLE **/
    private _httpClientSubscription: Subscription;
    public fullname: string = '';
    public position_name: string = '';
    public user_image: string = '';

    constructor(private httpClientService: HttpClientService, private authenticationService: AuthenticationService, private router: Router, private loggingService: LoggingService) {
        this._httpClientSubscription = this.httpClientService.httpClient$.subscribe(
            status => {
                this.loggingService.consoleLog("%c Profile", "background: green; color: white");
                this.loggingService.consoleLog(status);

                if (status) {
                    this.fullname = this.authenticationService.authenticateUser.fullname;
                    this.position_name = this.authenticationService.authenticateUser.position_name;
                    this.user_image = this.authenticationService.authenticateUser.file_path;
                } else {
                    this.fullname = '';
                    this.position_name = '';
                    this.user_image = '';
                }

                this.loggingService.consoleLog("%c ----------", "background: green; color: white");
            }
        )
    }

    public logOut(): void {
        this.authenticationService.clearAuthLocalStorage();
        this.authenticationService.notifyAuthenticate(false);
        this.router.navigate(['/login']);
    }

    /** DEFAULT **/
    active: boolean;

    onClick(event) {
        this.active = !this.active;
        event.preventDefault();
    }
}