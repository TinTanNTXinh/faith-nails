import {Component,AfterViewInit,ElementRef,Renderer,ViewChild} from '@angular/core';

import {Router, NavigationStart} from '@angular/router';
import {Subscription} from 'rxjs';

import {AuthenticationService} from './services/authentication.service';
import {LoggingService} from './services/logging.service';

enum MenuOrientation {
    STATIC,
    OVERLAY,
    HORIZONTAL
};

declare var jQuery: any;

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements AfterViewInit {

    /** MY VARIABLE **/
    private authenticate: boolean = false;
    private _authSubscription: Subscription;

    constructor(public renderer: Renderer, private router: Router, private authenticationService: AuthenticationService, private loggingService: LoggingService) {
        this._authSubscription = this.authenticationService.authenticate$.subscribe(
            status => {
                this.loggingService.consoleLog("%c AppComponent", "color: blue");
                this.loggingService.consoleLog(status);
                this.loggingService.consoleLog("%c ------------", "color: blue");
                this.authenticate = Boolean(status);
                if (!status) {
                    if (this.router.url != '/commissions') {
                        router.navigate(['/login']);
                    }
                }
            }
        );

        router.events.subscribe(
            event => {
                if (event instanceof NavigationStart) {
                    switch (event.url) {
                        case '/login':
                            if (this.authenticate) {
                                this.router.navigate(['/dashboards']);
                            }
                            break;
                        case '/commissions':
                            break;
                        default:
                            if (!this.authenticate) {
                                this.router.navigate(['/login']);
                            }
                            break;
                    }
                }
                // NavigationEnd
                // NavigationCancel
                // NavigationError
                // RoutesRecognized
            }
        );
    }

    public isNotRouteLogin(): boolean {
        return !(this.router.url == '/login' || this.router.url == '/commissions');
    }

    /** DEFAULT **/
    layoutCompact: boolean = false;

    layoutMode: MenuOrientation = MenuOrientation.STATIC;
    
    darkMenu: boolean = false;
    
    profileMode: string = 'inline';

    rotateMenuButton: boolean;

    topbarMenuActive: boolean;

    overlayMenuActive: boolean;

    staticMenuDesktopInactive: boolean;

    staticMenuMobileActive: boolean;

    layoutContainer: HTMLDivElement;

    layoutMenuScroller: HTMLDivElement;

    menuClick: boolean;

    topbarItemClick: boolean;

    activeTopbarItem: any;

    documentClickListener: Function;

    resetMenu: boolean;

    @ViewChild('layoutContainer') layourContainerViewChild: ElementRef;

    @ViewChild('layoutMenuScroller') layoutMenuScrollerViewChild: ElementRef;

    ngAfterViewInit() {
        // this.layoutContainer = <HTMLDivElement> this.layourContainerViewChild.nativeElement;
        // this.layoutMenuScroller = <HTMLDivElement> this.layoutMenuScrollerViewChild.nativeElement;

        //hides the horizontal submenus or top menu if outside is clicked
        this.documentClickListener = this.renderer.listenGlobal('body', 'click', (event) => {            
            if(!this.topbarItemClick) {
                this.activeTopbarItem = null;
                this.topbarMenuActive = false;
            }

            if(!this.menuClick && this.isHorizontal()) {
                this.resetMenu = true;
            }

            this.topbarItemClick = false;
            this.menuClick = false;
        });
        
        // setTimeout(() => {
        //     jQuery(this.layoutMenuScroller).nanoScroller({flash:true});
        // }, 10);
    }

    onMenuButtonClick(event) {
        this.rotateMenuButton = !this.rotateMenuButton;
        this.topbarMenuActive = false;

        if(this.layoutMode === MenuOrientation.OVERLAY) {
            this.overlayMenuActive = !this.overlayMenuActive;
        }
        else {
            if(this.isDesktop())
                this.staticMenuDesktopInactive = !this.staticMenuDesktopInactive;
            else
                this.staticMenuMobileActive = !this.staticMenuMobileActive;
        }

        event.preventDefault();
    }

    onMenuClick($event) {
        this.menuClick = true;
        this.resetMenu = false;

        if(!this.isHorizontal()) {
            setTimeout(() => {
                jQuery(this.layoutMenuScroller).nanoScroller();
            }, 500);
        }
    }

    onTopbarMenuButtonClick(event) {
        this.topbarItemClick = true;
        this.topbarMenuActive = !this.topbarMenuActive;
        
        if(this.overlayMenuActive || this.staticMenuMobileActive) {
            this.rotateMenuButton = false;
            this.overlayMenuActive = false;
            this.staticMenuMobileActive = false;
        }
        
        event.preventDefault();
    }

    onTopbarItemClick(event, item) {
        this.topbarItemClick = true;

        if(this.activeTopbarItem === item)
            this.activeTopbarItem = null;
        else
            this.activeTopbarItem = item;

        event.preventDefault();
    }

    isTablet() {
        let width = window.innerWidth;
        return width <= 1024 && width > 640;
    }

    isDesktop() {
        return window.innerWidth > 1024;
    }

    isMobile() {
        return window.innerWidth <= 640;
    }

    isOverlay() {
        return this.layoutMode === MenuOrientation.OVERLAY;
    }

    isHorizontal() {
        return this.layoutMode === MenuOrientation.HORIZONTAL;
    }

    changeToStaticMenu() {
        this.layoutMode = MenuOrientation.STATIC;
    }

    changeToOverlayMenu() {
        this.layoutMode = MenuOrientation.OVERLAY;
    }

    changeToHorizontalMenu() {
        this.layoutMode = MenuOrientation.HORIZONTAL;
    }

    ngOnDestroy() {
        if(this.documentClickListener) {
            this.documentClickListener();
        }  

        jQuery(this.layoutMenuScroller).nanoScroller({flash:true});
    }

}